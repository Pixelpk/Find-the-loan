<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApplyLoan;
use Illuminate\Http\Request;
use App\Models\LoanQuotations;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use function GuzzleHttp\Promise\all;

class LoanQuotationController extends Controller
{
    
    public function putQuotation(Request $request){
        $data['apply_loan_id'] = $request->apply_loan_id ?? '';
        $data['apply_loan'] = ApplyLoan::where("id", "=", $data['apply_loan_id'])
            ->first();
        if (!$data['apply_loan']){
            return redirect()->back()->with('error','Oops something went wrong');
        }

        return view('admin.loan_applications.put_quotation',$data);
    }

    public function quotedCustomer(Request $request)
    {
        $data['quotations'] = LoanQuotations::Query()
        ->with(['loan_application'])->paginate(20);
        // return $data; 
        return view('admin.loan_applications.quotations',$data);
    }

    public function submitQuotation(Request $request)
    {
        $data = $request->all();
        $apply_loan = ApplyLoan::where("id", "=", $data['apply_loan_id'])
        ->first();
        //for invoice financing and purchase order financing
        if($apply_loan->loan_type_id == 5 || $apply_loan->loan_type_id == 6){
            $fill = $this->quotedInvoiceFinancingData($request->all());
        }else{
            $fill = $this->quotedAllLoanData($request->all());
        }
        // print_r($fill);
        $fill['apply_loan_id'] = $request->apply_loan_id;
        $fill['partner_id'] = Session::get('partner_id'); // id of finance partner
        $fill['quoted_by'] = Auth::user()->id; // id of loggedin finance partner user
        $quote = new LoanQuotations();
        $quote->fill($fill)->save();
        return $fill;
    }

    // public function quoteAllOtherLoan(Request $request)
    // {
    //     $data = $request->all();
    //     $fill = $this->quotedAllLoanData($request->all());
    //     $fill['apply_loan_id'] = '1';
    //     $fill['partner_id'] = '13'; // id of finance partner
    //     $fill['quoted_by'] = '13'; // id of loggedin finance partner user
    //     $quote = new LoanQuotations();
    //     $quote->fill($fill)->save();
    //     return $fill;
    // }

    // public function quotePropertyLand($data)
    // {
    //     $data = $request->all();
    //     $fill = $this->quotedPropertyLandData($data);
    //     $fill['apply_loan_id'] = '1';
    //     $fill['partner_id'] = '13'; // id of finance partner
    //     $fill['quoted_by'] = '13'; // id of loggedin finance partner user
    //     $quote = new LoanQuotations();
    //     $quote->fill($fill)->save();
    //     return $fill;
    // }

    // public function quoteInvoiceFinancing(Request $request)
    // {
    //     $data = $request->all();
    //     $fill = $this->quotedInvoiceFinancingData($data);
    //     $fill['apply_loan_id'] = '1';
    //     $fill['partner_id'] = '13'; // id of finance partner
    //     $fill['quoted_by'] = '13'; // id of loggedin finance partner user
    //     $quote = new LoanQuotations();
    //     $quote->fill($fill)->save();
    //     return $fill;
    // }

    public function quotedInvoiceFinancingData($data)
    {
        $quantum_interest = [
            'facility_limit'=> $data['facility_limit'],
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
            'range_value_from'=> $data['if_insurance_start_value'] ?? "",'range_value_from'=> $data['if_insurance_end_value'] ?? "",
            'range_percentage_from'=> $data['if_insurance_start_percent'] ?? "",'range_percentage_from'=> $data['if_insurance_end_value'] ?? "",
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

    public function quotedPropertyLandData($data)
    {
        $quantum_interest = [
            'fixed_or_floating'=> '1', //1 for fixed, 2 for floating/variable
            'quantum'=> '2333',
            'fixed'=>[
                'interest'=> [
                    'value_type' => '1', //1 for p_a, 2 for p_m
                    'p_a'=>'23',
                    'p_m'=>'23',
                ],
                'reducing_type'=>'1', //1=Simple/Flat, 2=Reducing weekly, 3=Reducing monthly, 4=Reducing yearly
                'tenure'=> [
                    'years'=>'23',
                    'months'=>'2',
                ],
                'lock_in'=> [
                    'years'=>'23',
                    'months'=>'2',
                ],
            ],
            'floating'=>[
                'reference_rate'=>'SORA',
                'publicly_financial_indicator'=> "accept only letters",
                'current_value'=> "2",
                'months_if_any'=> "2",
                "month_p_a_or_spread"=>'1', //1=Month vise p.a, 2=spread
                "month_pa"=>[
                    [
                        'from_month'=> '1',
                        'to_month'=> '12',
                        'p_a'=> '2', //in percentage
                    ],
                    [
                        'from_month'=> '13',
                        'to_month'=> '24',
                        'p_a'=> '2', //in percentage
                    ]
                ],
                'spread'=>[
                    [
                        'spread_value'=>'12',
                        'p_a'=>'12' // current_value + the spread they enter is p_a
                    ],
                    [
                        'spread_value'=>'12',
                        'p_a'=>'12' // current_value + the spread they enter is p_a
                    ]
                ]
                
            ]
        ];

        $one_time_fee = [
            'value_type'=>'1', //1 for flat value, 2 for percentage, 3 if entered both
            'flat_value'=> '23','percentage'=> '3','which_higher'=>1
        ];
        $monthly_fee = [
            'value_type'=>1, //1 for flat value, 2 for percentage, 3 if entered both
            'flat_value'=> '23','percentage'=> '3','which_higher'=>1
        ];
        $annual_fee = [
            'value_type'=>1, //1 for flat value, 2 for percentage, 3 if entered both
            'flat_value'=> '23','percentage'=> '3','which_higher'=>1
        ];

        $legal_fee = ['range_from'=> '23','range_to'=> '344'];

        $if_insurance_required = [
            'value_type'=>1, //1 for flat value, 2 for percentage, 3 if entered both
            'range_value_from'=> '23','range_value_from'=> '344',
            'range_percentage_from'=> '23','range_percentage_from'=> '344',
            'which_higher'=>1
        ];
        $eir = [
            'value_type'=>1, //1 for p_a_percentage, 2 for p_a_percentage
            'pa_percentage'=> '23','pm_percentage'=> '344'
        ];

        $repayment = [
            'repayment_terms'=>'P+I',
            'deffered_after'=>'11', //months
            'balloon_on'=>'11', //months
            'amortized_period'=>'11', //months
            'remarks'=>'optional depends on cost',
            'personal_notepad'=>'optional depends on cost'
        ];
        $quote_validity = null;
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
            // "quote_validity"=>$quote_validity 
        );
    }

    protected function quotedAllLoanData($data){
        $quantum_interest = [
            'quantum'=> $data['quantum'] ?? "",
            'interest_flat'=> [
                'pa'=>$data['interest_flat_pa'] ?? "",
                'pm'=>$data['interest_flat_pm'] ?? "",
            ],
            'interest_reducing_balance'=> [
                'pa'=>$data['interest_reducing_pa'] ?? "",
                'pm'=>$data['interest_reducing_pm'] ?? "",
            ],
            'interest_and_board_rate'=> [
                'interest_pa'=>$data['interest_pa'] ?? "",
                'board_rate_pa'=>$data['board_rate_pa'] ?? "",
            ],
            'flat_fee_regardless_tenure'=> [
                'falt_value'=>$data['flat_fee_value'] ?? "",
                'percentage'=>$data['flat_fee_percent'] ?? "",
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
            'range_value_from'=> $data['if_insurance_start_value'] ?? "",'range_value_from'=> $data['if_insurance_end_value'] ?? "",
            'range_percentage_from'=> $data['if_insurance_start_percent'] ?? "",'range_percentage_from'=> $data['if_insurance_end_value'] ?? "",
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
}
