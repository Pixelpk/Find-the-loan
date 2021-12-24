<?php
namespace App\Http\Livewire\Cms\Loan\Business\LoanType\OverDraft;
use App\Models\ApplyLoan;
use App\Models\FinancePartner;
use App\Models\LoanGernalInfo;
use App\Models\OverDraftDeposit;
use App\Models\OverDraftPropertyLand;
use App\Models\OverDraftTrustFund;
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
    public $security_type;
   ///sold///
    public $total_indicative_value;
    public $fund_name;
    public $currency = "SGD";
    public $company_purchased;
    public $deposit_ac_number;
    public $indicative_nav;
    public $fd_sd_date;
    public $tab;
    // list
    public $trustFunds;
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
        $this->getTrustFund();
        $this->getFinancePartner();
        return view('livewire.cms.loan.business.loan-type.over-draft.trust-fund');
    }
    public function getFinancePartner()
    {
        $this->financePartners = FinancePartner::where('status', 1)->get();
    }

    public function store()
    {
        
        try{
            $rules = [
               'currency' => 'required',
               'total_indicative_value' => 'required',
               'indicative_nav' => 'required',
               'deposit_ac_number' => 'required',
               'company_purchased' => 'required',
               'fund_name' => 'required',
               'fd_sd_date' => 'required',
             ];
            $this->validate($rules);
        }catch(\Exception $exc){
            $this->emit('required_fields_error');
            $this->validate($rules);
        }
 
       OverDraftTrustFund::forceCreate([
           'apply_loan_id' => $this->apply_loan->id,
           'total_indicative_value' => $this->total_indicative_value,
           'currency' => $this->currency,
           'indicative_nav' => $this->indicative_nav,
           'deposit_ac_number' => $this->deposit_ac_number,
           'company_purchased' => $this->company_purchased,
           'fund_name' => $this->fund_name,
           'fd_sd_date' => $this->fd_sd_date,
           'type' => $this->tab,
       ]);
       $this->getTrustFund();
       $this->emit('enableButton', true);
        
       $this->emit('alert', ['type' => 'success', 'message' => 'Trust/Fund added successfully.']);
       $this->resetInput();
    }
    public function resetInput()
    {
        $this->currency = '';
        $this->total_indicative_value = '';
        $this->deposit_ac_number = '';
        $this->indicative_nav = '';
        $this->fd_sd_date = '';
        $this->company_purchased = '';
        $this->fund_name = '';
    }

    public function changeAreaType()
    {
        $this->square_feet = '';
    }
    public function changeAreaTypee()
    {
        $this->square_meter = '';
    }
    

    public function getTrustFund()
    {
        $this->trustFunds = OverDraftTrustFund::where('apply_loan_id', $this->apply_loan->id)
        ->get();
    }
    public function deleteRecord(OverDraftTrustFund $trustFund)
    {
       
        $trustFund->delete();
        $this->emit('enableButton', true);
        $this->getTrustFund();
    }
}
