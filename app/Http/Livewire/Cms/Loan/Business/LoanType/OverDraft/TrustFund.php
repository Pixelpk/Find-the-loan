<?php
namespace App\Http\Livewire\Cms\Loan\Business\LoanType\OverDraft;
use App\Models\ApplyLoan;
use App\Models\FinancePartner;
use App\Models\LoanGernalInfo;
use App\Models\OverDraftDeposit;
use App\Models\OverDraftPropertyLand;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
class TrustFund extends Component
{
    
    use WithFileUploads;
    //parent component data
    public $main_type;
    public $loan_type_id;
    public $apply_loan;
   ///sold///
    public $bank;
    public $other_bank_name;
    public $currency;
    public $deposit_amount;
    public $deposit_ac_number;
    public $tranche;
    public $fd_sd;
    public $tab;
    // list
    public $Deposits;
    //
    protected $listeners = [
        'getCurrency'
    ];
    public function getCurrency($value)
    {
    if(!is_null($value))
        $this->currency = $value;
    }

    public function render()
    {
        $this->getDeposit();
        $this->getFinancePartner();
        return view('livewire.cms.loan.business.loan-type.over-draft.trust-fund');
    }
    public function getFinancePartner()
    {
        $this->financePartners = FinancePartner::where('status', 1)->get();
    }

    public function store()
    {
       
       $this->validate([
           'currency' => 'required',
           'total_indicative_value' => 'required',
           'indicative_nav' => 'required',
           'deposit_ac_number' => 'required',
           'other_bank_name' => $this->bank == "other" ?  'required' : '',
           
       ]);
       
       OverDraftDeposit::forceCreate([
           'apply_loan_id' => $this->apply_loan->id,
           'deposit_type' => $this->tab,
           'currency' => $this->currency,
           'deposit_amount' => $this->deposit_amount,
           'deposit_ac_number' => $this->deposit_ac_number,
           'bank' => $this->bank,
           'other_bank_name' => $this->other_bank_name,
           'tranche' => $this->tranche,
           'fd_sd' => $this->fd_sd,
       ]);
      
       $this->getDeposit();
       $this->emit('alert', ['type' => 'success', 'message' => 'Deposit added successfully.']);
       $this->resetInput();
    }
    public function resetInput()
    {
        $this->currency = '';
        $this->deposit_amount = '';
        $this->deposit_ac_number = '';
        $this->bank = '';
        $this->other_bank_name = '';
        $this->tranche = '';
        $this->fd_sd = '';
    }

    public function changeAreaType()
    {
        $this->square_feet = '';
    }
    public function changeAreaTypee()
    {
        $this->square_meter = '';
    }
    

    public function getDeposit()
    {
        $this->Deposits = OverDraftDeposit::where('apply_loan_id', $this->apply_loan->id)
        ->where('deposit_type', $this->tab)
        ->get();
    }
    public function deleteRecord(OverDraftDeposit $OverDraftDeposit)
    {
       
        $OverDraftDeposit->delete();
        $this->getDeposit();
    }
}
