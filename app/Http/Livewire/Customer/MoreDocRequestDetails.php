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
    protected $queryString = ['more_doc_request_id'];

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

    public function submitMoreDocRequestReply()
    {
        // dd($this->form);
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
                $replied_docs[$i]['quote_additional_docs_id'] = $key1;
                $replied_docs[$i]['lable'] = $key2;
                if (isset($value2['text'])) {
                    $empty = false;
                    $replied_docs[$i]['doc_type'] = "text";
                    $replied_docs[$i]['value'] = $value2['text'];
                } elseif (isset($value2['file'])) {
                    $empty = false;
                    $replied_docs[$i]['doc_type'] = "file";
                    $replied_docs[$i]['value'] = $value2['file']->store('replied_with_doc/' . date("Ymd-his"));
                } elseif (isset($value2['number'])) {
                    $empty = false;
                    $replied_docs[$i]['doc_type'] = "number";
                    $replied_docs[$i]['value'] = $value2['number'];
                } elseif (isset($value2['dropdown'])) {
                    $empty = false;
                    $replied_docs[$i]['doc_type'] = "dropdown";
                    $replied_docs[$i]['value'] = $value2['dropdown'];
                }
            }
            $i++;
        }

        if ( $empty == true) {
            $this->emit('danger', ['type' => 'success', 'message' => 'Oops. something went wrong. kindly upload data again.']);
            return;
        }

        $reply = new RepliedWithDocs();
        $reply->more_doc_request_id = $this->more_doc_request_id;
        $reply->replied_docs = $replied_docs;
        $reply->save();
        $this->emit('alert', ['type' => 'success', 'message' => 'Requested documents are submitted successfully.']);
        // $this->emit('clearInput', ['class' => 'replied_docs']);
        $this->form = [];
        $this->reset('form');
        $this->mount();
        return;
    }
}
