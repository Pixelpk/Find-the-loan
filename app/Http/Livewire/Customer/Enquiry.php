<?php

namespace App\Http\Livewire\Customer;

use App\Models\ApplyLoan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Enquiry extends Component
{
    public $user;
    public $getLoans;
    public $profile;

    protected $queryString = ['profile'];

    public function mount()
    {
        $this->user = Auth::user();
        $this->getLoan();
    }

    public function getLoan()
    {
        if($this->profile == 1 || $this->profile == 2){

            $this->getLoans = ApplyLoan::where('user_id', $this->user->id)->where('profile', $this->profile)->get();

        }

    }

    public function render()
    {
        return view('livewire.customer.enquiry')->layout('customer.layouts.master');;
    }

}