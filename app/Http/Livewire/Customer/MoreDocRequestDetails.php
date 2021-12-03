<?php

namespace App\Http\Livewire\Customer;

use App\Models\MoreDocRequireRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MoreDocRequestDetails extends Component
{
    public $user;
    public $more_doc_request_id;
    public $more_doc_request_detail;
    protected $queryString = ['more_doc_request_id']; 

    public function mount()
    {
        $this->user = Auth::user();
        $this->more_doc_request_detail = MoreDocRequireRequest::where('id',$this->more_doc_request_id)
        ->with('more_doc_msg_desc')
        ->first();
        if(!$this->more_doc_request_detail){
            return redirect(route('customer-more-doc-requests'))->with('error','Oops. something went wrong');
        }

    }

    public function render()
    {
        // dd($this->more_doc_request_detail);

        return view('livewire.customer.more-doc-request-details')->layout('customer.layouts.master');
    }
}
