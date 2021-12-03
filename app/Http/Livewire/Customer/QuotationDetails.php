<?php

namespace App\Http\Livewire\Customer;

use App\Models\LoanQuotations;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class QuotationDetails extends Component
{
    public $user;
    public $quote_id;
    public $quotation_details;
    protected $queryString = ['quote_id'];
    public function mount()
    {
        $this->user = Auth::user();

        $user_id = $this->user->id;

        $this->quotation_details = LoanQuotations::Query()
        ->where('id',$this->quote_id)
        ->whereHas('loan_application',function($query) use($user_id){
            $query->where('user_id',$user_id);
        })
        ->whereDate('quote_validity','>',date('Y-m-d'))
        ->with(['loan_application','quotation_finance_partner:id,name'])->first();
        if(!$this->quotation_details){
            return redirect(route('customer-quotations'))->with('error','Oops. Something went wrong.');
        }
    }

    public function render()
    {
        // dd($this->quotation_details);
        return view('livewire.customer.quotation-details')->layout('customer.layouts.master');
    }

    public function proceedAlert(){

        $this->dispatchBrowserEvent('proceed_with_quotation', ['message' => "I give consent to selected financing partner to contact me to complete the loan application.", "function" => "proceedWithQuotation"]);

    }

    public function proceedWithQuotation()
    {
        try{
            LoanQuotations::where('id',$this->quote_id)->whereNull('status')->update(['status'=>1,'proceeded_at'=>date('Y-m-d H:i')]); //status=>1=Customer Applied
            $this->emit('alert', ['type' => 'success', 'message' => 'Quotation is accepted successfully.']);
            $this->mount();
        }catch(Exception $exception){
            $this->emit('alert', ['type' => 'success', 'message' => 'Oops. something went wrong.']);

            $this->mount();
        }
    }

}
