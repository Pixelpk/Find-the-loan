<?php

namespace App\Http\Livewire\Customer;

use App\Models\ApplyLoan;
use App\Models\LoanQuotations;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Quotations extends Component
{

    public $user;
    public function mount()
    {
        $this->user = Auth::user();
    }

    public function render()
    {
        $user_id = $this->user->id;

        $quotations = LoanQuotations::Query()
        ->whereHas('loan_application',function($query) use($user_id){
            $query->where('user_id',$user_id);
        })
        ->whereDate('quote_validity','>=',date('Y-m-d'))
        ->with(['loan_application','quotation_finance_partner:id,name'])->paginate(20);

        return view('livewire.customer.quotations',['quotations'=>$quotations])->layout('customer.layouts.master');
    }

    public function quoteDetails($quote_id)
    {
        $route = route('quotation-details',['quote_id'=>$quote_id]);
        return redirect($route);
    }
}
