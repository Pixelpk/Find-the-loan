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
    public $form = [];
    public $more_doc_request_id;
    public $more_doc_request_detail;
    public $dont_have_doc;
    protected $queryString = ['more_doc_request_id'];
    public $i = 1; 

    //variable for personal_loan_list
    public $personal_loan_list = [];
    public $not_have_personal_loan_list = false;
    public $pl_bank_institution = "";
    public $pl_facility_type = "";
    public $pl_original_loan_amount = "";
    public $pl_interest_per_year = "";
    public $pl_outstanding_loan_amount = "";
    public $pl_monthly_installment_amount = "";
    public $pl_start_date = "";
    public $pl_duration = "";


    public function mount()
    {
        $this->user = Auth::user();
        $this->more_doc_request_detail = MoreDocRequireRequest::where('id', $this->more_doc_request_id)
            ->with('more_doc_msg_desc')
            ->first();
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

    public function not_have_personal_loan_list(){
        $this->not_have_personal_loan_list = true;
    } 

    public function chk($id){
        
        if($id == 100){
            $this->personal_loan_list = [];
        }

        if($this->dont_have_doc[$id] == false){
            unset($this->dont_have_doc[$id]);
            
        }
        // dd($this->personal_loan_list);
    }


    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        $loan_detail = [
            'bank_institution'=> $this->pl_bank_institution,
            'facility_type'=> $this->pl_facility_type,
            'original_loan_amount'=> $this->pl_original_loan_amount,
            'interest_per_year'=> $this->pl_interest_per_year,
            'outstanding_loan_amount'=> $this->pl_outstanding_loan_amount,
            'monthly_installment_amount'=> $this->pl_monthly_installment_amount,
            'start_date'=> $this->pl_start_date,
            'duration'=> $this->pl_duration,
        ];
        array_push($this->personal_loan_list ,$loan_detail);
    }

    public function remove($i)
    {
        unset($this->personal_loan_list[$i]);
    }

    public function submitMoreDocRequestReply()
    {
        // dd($this->personal_loan_list);
        // dd($this->dont_have_doc, $this->form);
        // if (!sizeof($this->form)) {
        //     $this->emit('danger', ['type' => 'success', 'message' => 'Oops. something went wrong. kindly upload data again.']);
        //     return;
        // }
        $empty = true;
        // $file = "replied_with_doc\/20211203-081717\/gQT98FyyYkvWqMSZE5tEK4fh5B2lDLrZIovZyR2o.jpg";
        // dd(storage_path("app/".$file));
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
        if ( $empty == true) {
            $this->emit('danger', ['type' => 'success', 'message' => 'Oops. something went wrong. kindly upload data again.']);
            return;
        }


        $reply = new RepliedWithDocs();
        $reply->more_doc_request_id = $this->more_doc_request_id;
        $reply->apply_loan_id = $this->more_doc_request_detail->apply_loan_id;
        $reply->replied_docs = $replied_docs;
        $reply->dont_have_doc = $this->dont_have_doc;
        $reply->personal_loan_list = $this->personal_loan_list;
        $reply->save();
        $this->emit('alert', ['type' => 'success', 'message' => 'Requested documents are submitted successfully.']);
        $this->form = [];
        $this->personal_loan_list = [];
        $this->reset('form');
        $this->mount();
        return;
    }
}
