<?php

namespace App\Http\Livewire\Customer;

use App\Models\MoreDocRequireRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MoreDocRequests extends Component
{    
    public $user;

    public function mount()
    {
        $this->user = Auth::user();
    }
    public function render()
    {
        $user_id = $this->user->id;
        $more_doc_requests = MoreDocRequireRequest::whereHas('loan_application',function($query) use($user_id){
            $query->where('user_id',$user_id);
        })
        ->with(
            [
                'loan_application',
                'finance_partner:id,name',
            ])->paginate(20);

        // dd($more_doc_requests[0]->loan_application);
        return view('livewire.customer.more-doc-requests',['applications'=>$more_doc_requests])->layout('customer.layouts.master');
    }
}
