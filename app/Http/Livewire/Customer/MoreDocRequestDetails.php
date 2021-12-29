<?php

namespace App\Http\Livewire\Customer;

use App\Models\MoreDocRequireRequest;
use App\Models\RepliedWithDocs;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class MoreDocRequestDetails extends Component
{
    use WithFileUploads;
    public $user;
    public $quote_additional_doc_idz;
    public $form = [];
    public $more_doc_request_id;
    public $more_doc_request_detail;
    public $dont_have_doc;
    protected $queryString = ['more_doc_request_id'];

    //personal loan list counter
    public $i = 1; 
    //company loan list counter
    public $j = 1;
    //personal asset list => insurance asset counter
    public $insurance_counter = 1;
    public $investment_counter = 1;
    public $cd_counter = 1;
    public $p_counter = 1;
    public $o_counter = 1;

    //variable for personal_loan_list
    public $personal_loan_list = [];
    public $pl_bank_institution;
    public $pl_facility_type;
    public $pl_original_loan_amount;
    public $pl_interest_per_year;
    public $pl_outstanding_loan_amount;
    public $pl_monthly_installment_amount;
    public $pl_start_date;
    public $pl_duration;

    //variable for company_loan_list
    public $company_loan_list = [];
    public $cl_bank_institution;
    public $cl_facility_type;
    public $cl_original_loan_amount;
    public $cl_interest_per_year;
    public $cl_outstanding_loan_amount;
    public $cl_monthly_installment_amount;
    public $cl_start_date;
    public $cl_duration;

    //variable for Personal asset list
    public $personal_assets_list = [], $insurance_asset_list = [], $investment_asset_list = [], $cash_and_deposit_asset_list = [], $property_asset_list = [], $others_asset_list = [];

    public $insurance_type = "Regular Premium";
    public $insurance_details;
    public $insurance_current_value;
    public $insurance_maturity_date;
    public $insurance_year_purchased;

    public $investment_type = "Unit Trust";
    public $investment_details;
    public $investment_current_value;

    public $cash_and_deposit_type;
    public $cash_and_deposit_details;
    public $cash_and_deposit_current_value;

    public $asset_property_type = "Main resident";
    public $asset_property_details;
    public $asset_property_current_value;

    public $asset_others_type;
    public $asset_others_details;
    public $asset_others_current_value;


    public function mount()
    {
        $this->user = Auth::user();
        $this->more_doc_request_detail = MoreDocRequireRequest::where('id', $this->more_doc_request_id)
            ->with('more_doc_msg_desc')
            ->first();
        $this->quote_additional_doc_idz = $this->more_doc_request_detail->more_doc_msg_desc->pluck('quote_additional_doc_id')->toArray();
        if (!$this->more_doc_request_detail) {
            return redirect(route('customer-more-doc-requests'))->with('error', 'Oops. something went wrong');
        }

        $preselectionIds = [131, 132];
        foreach ($this->more_doc_request_detail->more_doc_msg_desc as $key => $item) {
            if (in_array($item->quote_additional_doc->id, $preselectionIds)) {
                $this->form[$item->quote_additional_doc->id][$item->quote_additional_doc->info]['area_parameter'] = 'Square Feet';

            }
            if($item->quote_additional_doc->id == 101){
                $this->form[$item->quote_additional_doc->id][$item->quote_additional_doc->info][$item->quote_additional_doc->doc_type] = 1;
            }elseif($item->quote_additional_doc->id == 102 ){
                $this->form[$item->quote_additional_doc->id][$item->quote_additional_doc->info][$item->quote_additional_doc->doc_type] = "Fully paid";
            }
            elseif($item->quote_additional_doc->id == 104 ){
                $this->form[$item->quote_additional_doc->id][$item->quote_additional_doc->info][$item->quote_additional_doc->doc_type] = "No formal education";
            }
            elseif($item->quote_additional_doc->id == 105 ){
                $this->form[$item->quote_additional_doc->id][$item->quote_additional_doc->info][$item->quote_additional_doc->doc_type] = "Single";
            }
            elseif($item->quote_additional_doc->id == 107 ){
                $this->form[$item->quote_additional_doc->id][$item->quote_additional_doc->info][$item->quote_additional_doc->doc_type] = "1";
            }
            elseif($item->quote_additional_doc->id == 108 ){
                $this->form[$item->quote_additional_doc->id][$item->quote_additional_doc->info][$item->quote_additional_doc->doc_type] = "No";

            }
        }
    }

    public function render()
    {
        // dd($this->more_doc_request_detail);

        return view('livewire.customer.more-doc-request-details')->layout('customer.layouts.master');
    }

    public function chk($id){
        
        if($id == 99){
            $this->personal_loan_list = [];
            $this->pl_bank_institution = "";
            $this->pl_facility_type = "";
            $this->pl_original_loan_amount = "";
            $this->pl_interest_per_year = "";
            $this->pl_outstanding_loan_amount = "";
            $this->pl_monthly_installment_amount = "";
            $this->pl_start_date = "";
            $this->pl_duration = "";
        }

        if($id == 4){
            $this->company_loan_list = [];
            $this->cl_bank_institution = "";
            $this->cl_facility_type = "";
            $this->cl_original_loan_amount = "";
            $this->cl_interest_per_year = "";
            $this->cl_outstanding_loan_amount = "";
            $this->cl_monthly_installment_amount = "";
            $this->cl_start_date = "";
            $this->cl_duration = "";
        }

        if($id == 100){
            $this->personal_assets_list = [];
            $this->insurance_asset_list = [];
            $this->investment_asset_list = [];
            $this->cash_and_deposit_asset_list = [];
            $this->property_asset_list = [];
            $this->others_asset_list = [];
        }

        if($this->dont_have_doc[$id] == false){
            unset($this->dont_have_doc[$id]);
            
        }
        // dd($this->personal_loan_list);
    }


    public function addPersonalLoan($i)
    {
        $this->validate([
            'pl_bank_institution'=>'required',
            'pl_facility_type'=>'required',
            'pl_original_loan_amount'=>'required',
            'pl_interest_per_year'=>'required',
            'pl_outstanding_loan_amount'=>'required',
            'pl_monthly_installment_amount'=>'required',
            'pl_start_date'=>'required',
            'pl_duration'=>'required',
        ]);
        $this->i = $i + 1;

        $p_loan_detail = [
            'bank_institution'=> $this->pl_bank_institution,
            'facility_type'=> $this->pl_facility_type,
            'original_loan_amount'=> $this->pl_original_loan_amount,
            'interest_per_year'=> $this->pl_interest_per_year,
            'outstanding_loan_amount'=> $this->pl_outstanding_loan_amount,
            'monthly_installment_amount'=> $this->pl_monthly_installment_amount,
            'start_date'=> $this->pl_start_date,
            'duration'=> $this->pl_duration,
        ];
        array_push($this->personal_loan_list ,$p_loan_detail);
        $this->pl_bank_institution = "";
        $this->pl_facility_type = "";
        $this->pl_original_loan_amount = "";
        $this->pl_interest_per_year = "";
        $this->pl_outstanding_loan_amount = "";
        $this->pl_monthly_installment_amount = "";
        $this->pl_start_date = "";
        $this->pl_duration = "";
        // dd($this->personal_loan_list);
    }

    public function addCompanyLoan($j)
    {
        $this->validate([
            'cl_bank_institution'=>'required',
            'cl_facility_type'=>'required',
            'cl_original_loan_amount'=>'required',
            'cl_interest_per_year'=>'required',
            'cl_outstanding_loan_amount'=>'required',
            'cl_monthly_installment_amount'=>'required',
            'cl_start_date'=>'required',
            'cl_duration'=>'required',
        ]);

        $this->j = $j + 1;
        $loan_detail = [
            'bank_institution'=> $this->cl_bank_institution,
            'facility_type'=> $this->cl_facility_type,
            'original_loan_amount'=> $this->cl_original_loan_amount,
            'interest_per_year'=> $this->cl_interest_per_year,
            'outstanding_loan_amount'=> $this->cl_outstanding_loan_amount,
            'monthly_installment_amount'=> $this->cl_monthly_installment_amount,
            'start_date'=> $this->cl_start_date,
            'duration'=> $this->cl_duration,
        ];
        array_push($this->company_loan_list ,$loan_detail);
        $this->cl_bank_institution = "";
        $this->cl_facility_type = "";
        $this->cl_original_loan_amount = "";
        $this->cl_interest_per_year = "";
        $this->cl_outstanding_loan_amount = "";
        $this->cl_monthly_installment_amount = "";
        $this->cl_start_date = "";
        $this->cl_duration = "";

    }

    public function addInsuranceAsset($insurance_counter)
    {
        $this->validate([
            'insurance_type'=>'required',
            'insurance_details'=>'required',
            'insurance_current_value'=>'required',
            'insurance_maturity_date'=>'required',
            'insurance_year_purchased'=>'required',
        ]);

        $this->insurance_counter = $insurance_counter + 1;
        $detail = [
            'insurance_type'=> $this->insurance_type,
            'insurance_details'=> $this->insurance_details,
            'insurance_current_value'=> $this->insurance_current_value,
            'insurance_maturity_date'=> $this->insurance_maturity_date,
            'insurance_year_purchased'=> $this->insurance_year_purchased,
        ];
        array_push($this->insurance_asset_list ,$detail);
    }

    public function addInvestmentAsset($investment_counter)
    {
        $this->validate([
            'investment_type'=>'required',
            'investment_details'=>'required',
            'investment_current_value'=>'required',
        ]);
        $this->investment_counter = $investment_counter + 1;
        $detail = [
            'investment_type'=> $this->investment_type,
            'investment_details'=> $this->investment_details,
            'investment_current_value'=> $this->investment_current_value,
        ];
        array_push($this->investment_asset_list ,$detail);
    }

    public function addCashDepositAsset($cd_counter)
    {
        $this->validate([
            'cash_and_deposit_type'=>'required',
            'cash_and_deposit_details'=>'required',
            'cash_and_deposit_current_value'=>'required',
        ]);
        $this->cd_counter = $cd_counter + 1;
        $detail = [
            'cash_and_deposit_type'=> $this->cash_and_deposit_type,
            'cash_and_deposit_details'=> $this->cash_and_deposit_details,
            'cash_and_deposit_current_value'=> $this->cash_and_deposit_current_value,
        ];
        array_push($this->cash_and_deposit_asset_list ,$detail);
    }

    public function addPropertyAsset($p_counter)
    {
        $this->validate([
            'asset_property_type'=>'required',
            'asset_property_details'=>'required',
            'asset_property_current_value'=>'required',
        ]);
        $this->p_counter = $p_counter + 1;
        $detail = [
            'asset_property_type'=> $this->asset_property_type,
            'asset_property_details'=> $this->asset_property_details,
            'asset_property_current_value'=> $this->asset_property_current_value,
        ];
        array_push($this->property_asset_list ,$detail);
    }

    public function addOthersAsset($o_counter)
    {
        $this->validate([
            'asset_others_type'=>'required',
            'asset_others_details'=>'required',
            'asset_others_current_value'=>'required',
        ]);
        $this->o_counter = $o_counter + 1;
        $detail = [
            'asset_others_type'=> $this->asset_others_type,
            'asset_others_details'=> $this->asset_others_details,
            'asset_others_current_value'=> $this->asset_others_current_value,
        ];
        array_push($this->others_asset_list ,$detail);
    }

    public function removePersonalLoan($i)
    {
        unset($this->personal_loan_list[$i]);
    }

    public function removeCompanyLoan($j)
    {
        unset($this->company_loan_list[$j]);
    }

    public function removeInsuranceAsset($j)
    {
        unset($this->insurance_asset_list[$j]);
    }

    public function removeInvestmentAsset($j)
    {
        unset($this->investment_asset_list[$j]);
    }

    public function removeCashDepositAsset($j)
    {
        unset($this->cash_and_deposit_asset_list[$j]);
    }

    public function removePropertyAsset($j)
    {
        unset($this->property_asset_list[$j]);
    }

    public function removeOthersAsset($j)
    {
        unset($this->others_asset_list[$j]);
    }

    public function submitMoreDocRequestReply()
    {

        $empty = true;
        // $file = "replied_with_doc\/20211203-081717\/gQT98FyyYkvWqMSZE5tEK4fh5B2lDLrZIovZyR2o.jpg";
        // dd(storage_path("app/".$file));
        if(in_array(100,$this->quote_additional_doc_idz)){
            $personal_assets_list ['insurance_asset_list'] = $this->insurance_asset_list;
            $personal_assets_list ['investment_asset_list'] = $this->investment_asset_list;
            $personal_assets_list ['cash_and_deposit_asset_list'] = $this->cash_and_deposit_asset_list;
            $personal_assets_list ['property_asset_list'] = $this->property_asset_list;
            $personal_assets_list ['others_asset_list'] = $this->others_asset_list;
        }

        
        $replied_docs = [];
        $i = 0;
        foreach ($this->form as $key1 => $value) {

            foreach ($value as $key2 => $value2) {
                // dd($value2);
                if (isset($value2['text'])) {
                    $replied_docs[$i]['quote_additional_docs_id'] = $key1;
                    $replied_docs[$i]['lable'] = $key2;

                    $empty = false;
                    $replied_docs[$i]['doc_type'] = "text";
                    $replied_docs[$i]['value'] = $value2['text'];
                } elseif (isset($value2['file'])) {
                    $replied_docs[$i]['quote_additional_docs_id'] = $key1;
                    $replied_docs[$i]['lable'] = $key2;

                    $empty = false;
                    $replied_docs[$i]['doc_type'] = "file";
                    $replied_docs[$i]['value'] = $value2['file']->store('public/replied_with_doc');
                } elseif (isset($value2['number']) && ($value2['number'] != "")) {
                    $replied_docs[$i]['quote_additional_docs_id'] = $key1;
                    $replied_docs[$i]['lable'] = $key2;

                    $empty = false;
                    $replied_docs[$i]['doc_type'] = "number";
                    $replied_docs[$i]['value'] = $value2['number'];
                    if(isset($value2['area_parameter'])){
                        $replied_docs[$i]['area_parameter'] = $value2['area_parameter'];
                    }
                } elseif (isset($value2['dropdown'])) {
                    $replied_docs[$i]['quote_additional_docs_id'] = $key1;
                    $replied_docs[$i]['lable'] = $key2;

                    $empty = false;
                    $replied_docs[$i]['doc_type'] = "dropdown";
                    $replied_docs[$i]['value'] = $value2['dropdown'];
                }
            }
            $i++;
        }

        $empty = ($empty == true) && count($this->personal_loan_list) < 1 ? true : false;
        $empty = ($empty == true) && count($this->company_loan_list) < 1 ? true : false;
        $empty = ($empty == true) && count($this->dont_have_doc) < 1 ? true : false;
        if ( $empty == true) {
            $this->emit('danger', ['type' => 'success', 'message' => 'Oops. You have not given any details.']);
            return;
        }


        $reply = new RepliedWithDocs();
        $reply->more_doc_request_id = $this->more_doc_request_id;
        $reply->apply_loan_id = $this->more_doc_request_detail->apply_loan_id;
        $reply->replied_docs = $replied_docs;
        $reply->dont_have_doc = $this->dont_have_doc;
        $reply->personal_loan_list = $this->personal_loan_list;
        $reply->company_loan_list = $this->company_loan_list;
        $reply->personal_assets_list = $this->personal_assets_list;
        $reply->save();
        $this->emit('alert', ['type' => 'success', 'message' => 'Requested documents are submitted successfully.']);
        
        $this->form = [];
        $this->personal_loan_list = [];
        $this->company_loan_list = [];
        $this->insurance_asset_list = [];
        $this->dont_have_doc = [];
        $this->investment_asset_list = [];
        $this->cash_and_deposit_asset_list = [];
        $this->property_asset_list = [];
        $this->others_asset_list = [];
        $this->i = 1;
        $this->j = 1;
        $this->insurance_counter = 1;
        $this->investment_counter = 1;
        $this->cd_counter = 1;
        $this->p_counter = 1;
        $this->o_counter = 1;
        $this->reset('form');
        $this->mount();
        return;
    }
}
