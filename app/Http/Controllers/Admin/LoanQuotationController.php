<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ReceiveQuote;
use App\Models\ApplyLoan;
use App\Models\AssignedApplication;
use App\Models\FinancePartner;
use Illuminate\Http\Request;
use App\Models\LoanQuotations;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use function GuzzleHttp\Promise\all;

class LoanQuotationController extends Controller
{
    public function fixedOrFloating(Request $request)
    {
        
        $data['loan_type'] = ApplyLoan::where('id',$request->apply_loan_id)
        ->first()->loan_type_id;

        $data['fixed_or_floating'] = $request->fixed_or_floating;
        return view('admin.loan_applications.fixed_or_floating',$data);
    }
    
    // public function putQuotation(Request $request){
    //     $data['apply_loan_id'] = $request->apply_loan_id ?? '';
    //     $data['apply_loan'] = ApplyLoan::where("id", "=", $data['apply_loan_id'])
    //         ->first();
    //     if (!$data['apply_loan']){
    //         return redirect()->back()->with('error','Oops something went wrong');
    //     }

    //     return view('admin.loan_applications.put_quotation',$data);
    // }

    public function quotedCustomer(Request $request)
    {
        $loggedin_user = $request->user();
        $partner_id = Session::get('partner_id');
        
        $data['quotations'] = LoanQuotations::Query()
        ->where('partner_id',$partner_id)
        ->with(['loan_application'])->paginate(20);
        // return $data; 
        return view('admin.loan_applications.quotations',$data);
    }

    public function submitQuotation(Request $request)
    {
        $data = $request->all();
        $loggedin_user = $request->user();
        // return $data;
        $apply_loan = ApplyLoan::where("id", "=", $data['apply_loan_id'])
        ->with('loan_user:id,first_name,last_name,email')
        ->first();

        //for invoice financing and purchase order financing
        if($apply_loan->loan_type_id == 5 || $apply_loan->loan_type_id == 6){
            $fill = $this->quotedInvoiceFinancingData($request->all());
        }else{
            $fill = $this->quotedAllLoanData($request->all());
        }

        $fill['apply_loan_id'] = $request->apply_loan_id;
        $fill['partner_id'] = Session::get('partner_id'); // id of finance partner
        $fill['quoted_by'] = Auth::user()->id; // id of loggedin finance partner user
        $fill['status'] = 0; // 0=quoted, 1=proceeded, 2=loan no longer required, 3=offer signed, 4=loan_disbursed
        $quote = new LoanQuotations();
        $quote->fill($fill)->save();
        $finance_partner = FinancePartner::select('id','name','email')->where('id',Session::get('partner_id'))->first();
        
        if ($loggedin_user->parent_id != 0) {
            //updating status to opertion_performed 
            AssignedApplication::updateViewedStatus($request->apply_loan_id,$loggedin_user->id,1,2);
        }

        try
        {
            Mail::to($apply_loan->loan_user->email)->send(new ReceiveQuote(['user'=>$apply_loan->loan_user, 'apply_loan'=>$apply_loan,'finance_partner'=>$finance_partner]));
        }
        catch(Exception $ex)
        {
            // dd($ex->getMessage());
        }
        return redirect(route('quoted-customer'))->with('success','Quotation is submitted.');

    }


    public function quotedInvoiceFinancingData($data)
    {
        $quantum_interest = [
            'quantum'=> $data['quantum'],
            'advance_percentage'=> $data['advance_percentage'],
            'is_notified'=> $data['is_notified'] ?? 0,
            'interest_calculated_by'=> $data['interest_calculated_by'] ?? null, //1=per year, 2=per month, 3=per week, 4=per day
            'is_joint_account_required'=> $data['is_joint_account_required'] ?? 0, //0-not required, 1=joint account required
            'joint_account'=> [
                'joint_account_days'=>$data['joint_account_days'] ?? "",
                'joint_account_cost_from'=>$data['joint_account_cost_from'] ?? "",
                'joint_account_cost_to'=>$data['joint_account_cost_to'] ?? "",
            ],
        ];

        $one_time_fee = [
            'value_type'=>1, //1 for flat value, 2 for percentage, 3 if entered both
            'flat_value'=> $data['one_time_fee_value'] ?? "",
            'percentage'=> $data['one_time_fee_percent'] ?? "",
            'which_higher'=>1
        ];
        $monthly_fee = [
            'value_type'=>1, //1 for flat value, 2 for percentage, 3 if entered both
            'flat_value'=> $data['monthly_fee_value'] ?? "",
            'percentage'=> $data['monthly_fee_percent'] ?? "",'which_higher'=>1
        ];
        $annual_fee = [
            'value_type'=>1, //1 for flat value, 2 for percentage, 3 if entered both
            'flat_value'=> $data['annual_fee_value'] ?? "",
            'percentage'=> $data['annual_fee_percent'] ?? "",'which_higher'=>1
        ];

        $legal_fee = ['range_from'=> $data['legal_fee_start_range'] ?? "",'range_to'=> $data['legal_fee_end_range'] ?? ""];

        $if_insurance_required = [
            'value_type'=>1, //1 for flat value, 2 for percentage, 3 if entered both
            'range_value_from'=> $data['if_insurance_start_value'] ?? "",'range_value_to'=> $data['if_insurance_end_value'] ?? "",
            'range_percentage_from'=> $data['if_insurance_start_percent'] ?? "",'range_percentage_to'=> $data['if_insurance_end_value'] ?? "",
            'which_higher'=>1
        ];
        $eir = [
            'value_type'=>1, //1 for p_a_percentage, 2 for p_a_percentage
            'pa_percentage'=> $data['eir_pa'] ?? "",'pm_percentage'=> $data['eir_pm'] ?? ""
        ];

        $repayment = [
            'repayment_terms'=>$data['repayment_terms'] ?? "",
            'deffered_after'=>$data['deffered_after'] ?? "", //months
            'balloon_on'=>$data['balloon_on'] ?? "", //months
            // 'amortized_period'=>$data['quantum'], //months
            'remarks'=>$data['remarks'] ?? "",
            'personal_notepad'=>$data['personal_notepad'] ?? ""
        ];
        $quote_validity = $data['quote_validity'];
        // return $fill;

        return array(
            "quantum_interest"=>$quantum_interest,
            "one_time_fee"=>$one_time_fee,
            "monthly_fee"=>$monthly_fee,
            "annual_fee"=>$annual_fee,
            "legal_fee"=>$legal_fee,
            "if_insurance_required"=>$if_insurance_required,
            "eir"=>$eir,
            "repayment"=>$repayment,
            "quote_validity"=>$quote_validity 
        );
    }



    protected function quotedAllLoanData($data){
        $quantum_interest = [
            'quantum'=> $data['quantum'] ?? "",
            'fixed_or_floating'=> $data['fixed_or_floating'],
        ];
        //if interest is fixed
        if($data['fixed_or_floating'] == 1){
            $quantum_interest['fixed'] = [
                'interest'=>[
                    'interest_pa'=> $data['interest_pa'] ?? "",
                    'interest_pm'=> $data['interest_pm'] ?? "",
                ],
                'tenure'=> [
                    'years'=>$data['tenure_years'] ?? "",
                    'months'=>$data['tenure_months'] ?? "",
                ],
                'lock_in'=> [
                    'years'=>$data['lock_in_years'] ?? "",
                    'months'=>$data['lock_in_months'] ?? "",
                ],
            ];
        }else{
            $quantum_interest['floating'] = [
                "reference_rate"=> $data['reference_rate'] ?? "",
                "other_financial_rates"=> $data['other_financial_rates'] ?? "",
                "months_if_any"=> $data['months_if_any'] ?? "",
                "currency"=> $data['currency'] ?? "",
                "current_value_indicative"=> $data['current_value_indicative'] ?? "",
                "current_value_indicative"=> $data['current_value_indicative'] ?? "",
                'pa'=>array_values($data['pa']) ?? "",
                "thereafter_pa"=>$data['thereafter_pa'] ?? "",
                "thereafter_spread"=>$data['thereafter_spread'] ?? "",
                "thereafter_spread_pa"=>$data['thereafter_spread_pa'] ?? "",
            ];
        }

        $one_time_fee = [
            // 'value_type'=>1, //1 for flat value, 2 for percentage, 3 if entered both
            'flat_value'=> $data['one_time_fee_value'] ?? "",
            'percentage'=> $data['one_time_fee_percent'] ?? "",
        ];
        $monthly_fee = [
            // 'value_type'=>1, //1 for flat value, 2 for percentage, 3 if entered both
            'flat_value'=> $data['monthly_fee_value'] ?? "",
            'percentage'=> $data['monthly_fee_percent'] ?? "",'which_higher'=>1
        ];
        $annual_fee = [
            // 'value_type'=>1, //1 for flat value, 2 for percentage, 3 if entered both
            'flat_value'=> $data['annual_fee_value'] ?? "",
            'percentage'=> $data['annual_fee_percent'] ?? "",
            // 'which_higher'=>1
        ];

        $legal_fee = ['range_from'=> $data['legal_fee_start_range'] ?? "",'range_to'=> $data['legal_fee_end_range'] ?? ""];

        $if_insurance_required = [
            'range_value_from'=> $data['if_insurance_start_value'] ?? "",
            'range_value_to'=> $data['if_insurance_end_value'] ?? "",
            'range_percentage_from'=> $data['if_insurance_start_percent'] ?? "",
            'range_percentage_to'=> $data['if_insurance_end_percent'] ?? "",
        ];
        $eir = [
            // 'value_type'=>1, //1 for p_a_percentage, 2 for p_a_percentage
            'pa_percentage'=> $data['eir_pa'] ?? "",'pm_percentage'=> $data['eir_pm'] ?? ""
        ];

        $repayment = [
            'repayment_terms'=>$data['repayment_terms'] ?? "",
            'deffered_after'=>$data['deffered_after'] ?? "", //months
            'balloon_on'=>$data['balloon_on'] ?? "", //months
            // 'amortized_period'=>$data['quantum'], //months
            'remarks'=>$data['remarks'] ?? "",
            'personal_notepad'=>$data['personal_notepad'] ?? ""
        ];
        $quote_validity = $data['quote_validity'];
        // return $fill;

        return array(
            "quantum_interest"=>$quantum_interest,
            "one_time_fee"=>$one_time_fee,
            "monthly_fee"=>$monthly_fee,
            "annual_fee"=>$annual_fee,
            "legal_fee"=>$legal_fee,
            "if_insurance_required"=>$if_insurance_required,
            "eir"=>$eir,
            "repayment"=>$repayment,
            "quote_validity"=>$quote_validity 
        );
    }
}
