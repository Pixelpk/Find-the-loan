<?php

namespace App\Http\Livewire\Customer;

use App\Models\UserLoanReject;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RejectedEnquiries extends Component
{
    public $user;

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function render()
    {
        $user_id = $this->user->id;
        $reject_enquiries = UserLoanReject::Query()
        ->whereHas('loan_application',function($query) use($user_id){
            $query->where('user_id',$user_id);
        })
        ->with(
            [
                'loan_application'=>function($query){
                    $query->with('loan_type');
                },
                'reject_finance_partner:id,name','customer_reject_reason',
                'customer_reject_reason'
            ])->paginate(20);

        // dd($reject_enquiries);
        return view('livewire.customer.rejected-enquiries',['reject_enquiries'=>$reject_enquiries])->layout('customer.layouts.master');
    }
}
