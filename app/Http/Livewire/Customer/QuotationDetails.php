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
    public $no_loan_reason;
    public $no_loan_reason_ellaborate;
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
        ->whereDate('quote_validity','>=',date('Y-m-d'))
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

    public function proceedAlert($message,$function,$confirmBtnText){

        $this->dispatchBrowserEvent('proceed_with_quotation', ['message' =>$message, "function" => $function,'confirmButtonText'=>$confirmBtnText]);

    }

    public function proceedWithQuotation()
    {
        try{
            LoanQuotations::where('id',$this->quote_id)->where('status',0)->update(['status'=>1,'proceeded_at'=>date('Y-m-d H:i')]); //status=>1=Customer Applied
            $this->emit('alert', ['type' => 'success', 'message' => 'Quotation is accepted successfully.']);
            $this->mount();
        }catch(Exception $exception){
            $this->emit('danger', ['type' => 'error', 'message' => 'Oops. something went wrong.']);

            $this->mount();
        }
    }

    public function loanNoLongerRequiredReason(){

        // dd($this->no_loan_reason);

        $this->validate([
            'no_loan_reason' => 'required',
            'no_loan_reason_ellaborate' => $this->no_loan_reason == 'Other' ? 'required': ''
            ],[
            'no_loan_reason.required' => 'The reason field is required',
            'no_loan_reason_ellaborate.required' => 'The field is required'
        ]);

        try{
            LoanQuotations::where('id', $this->quote_id)->where('status', 0)->update([
                'status' => 2,
                'loan_not_required_at' => date('Y-m-d H:i'),
                'no_loan_reason' => $this->no_loan_reason,
                'no_loan_reason_ellaborate' => $this->no_loan_reason_ellaborate,
            ]);

            $this->emit('alert', ['type' => 'success', 'message' => 'Loan no longer required is successfully done.']);
            $this->mount();

        }catch(Exception $exception){
            $this->emit('danger', ['type' => 'error', 'message' => 'Oops. something went wrong.']);
            $this->mount();
        }
    }

    // public function loanNoLongerRequired()
    // {
    //     try{
    //         LoanQuotations::where('id',$this->quote_id)->where('status',0)->update(['status'=>2,'loan_not_required_at'=>date('Y-m-d H:i')]); //status=>2=Loan no longer required
    //         $this->emit('alert', ['type' => 'success', 'message' => 'Loan no longer required is successfully done.']);
    //         $this->mount();
    //     }catch(Exception $exception){
    //         $this->emit('danger', ['type' => 'error', 'message' => 'Oops. something went wrong.']);

    //         $this->mount();
    //     }
    // }

}
