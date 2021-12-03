<?php

namespace App\Http\Livewire\Customer;

use App\Models\ApplyLoan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Enquiry extends Component
{
    public $user;
    // public $getLoans;
    public $profile;

    protected $queryString = ['profile'];

    public function mount()
    {
        $this->user = Auth::user();
        if($this->profile != 1 && $this->profile != 2){
            return redirect(route('customer-dashboard'));
        }

    }


    public function render()
    {
        $getLoans = ApplyLoan::where('user_id', $this->user->id)
        ->with(['loan_type','loan_company_detail','loan_reason'])
        ->where('profile', $this->profile)
        ->orderBy('id','desc')
        ->paginate(20);

        return view('livewire.customer.enquiry',['getLoans' => $getLoans])->layout('customer.layouts.master');;
    }

}
