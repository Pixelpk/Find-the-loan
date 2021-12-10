<?php

namespace App\Http\Livewire\Customer;

use App\Models\ApplyLoan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public $user_enquiries = 0;
    public $user;

    public function mount()
    {
        $this->user = Auth::user();
        $this->user_enquiries = ApplyLoan::where('user_id',$this->user->id)->count();
    }
    public function render()
    {
        return view('livewire.customer.dashboard')->layout('customer.layouts.master');
    }

}
