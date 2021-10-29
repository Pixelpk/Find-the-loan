<?php
namespace App\Http\Livewire\Cms\Loan\Business\LoanType\OverDraft;
use App\Models\ApplyLoan;
use App\Models\FinancePartner;
use App\Models\LoanGernalInfo;
use App\Models\OverDraftDeposit;
use App\Models\OverDraftPropertyLand;
use App\Models\OverDraftStockBond;
use App\Models\OverDraftTrustFund;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
class StockBond extends Component
{
    
    use WithFileUploads;
    //parent component data
    public $main_type;
    public $loan_type_id;
    public $apply_loan;
   ///sold///
    public $total_indicative_value;
    public $name;
    public $currency;
    public $company_purchased;
    public $indicative_bid_price;
    public $tab;
    // list
    public $stockBonds;
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
        $this->getStockBond();
        $this->getFinancePartner();
        return view('livewire.cms.loan.business.loan-type.over-draft.stock-bond');
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
           'name' => 'required',
         
           'company_purchased' => 'required',
           'indicative_bid_price' => 'required',  
       ]);
       
       OverDraftStockBond::forceCreate([
           'apply_loan_id' => $this->apply_loan->id,
           'total_indicative_value' => $this->total_indicative_value,
           'currency' => $this->currency,
           'indicative_bid_price' => $this->indicative_bid_price,
           
           'company_purchased' => $this->company_purchased,
           'name' => $this->name,
           'type' => $this->tab,
          
       ]);
      
       $this->getStockBond();
       $this->emit('enableButton', true);
       $this->emit('alert', ['type' => 'success', 'message' => 'Deposit added successfully.']);
       $this->resetInput();
    }
    public function resetInput()
    {
        $this->currency = '';
        $this->total_indicative_value = '';
       
        $this->indicative_bid_price = '';
        $this->fd_sd_date = '';
        $this->company_purchased = '';
        $this->name = '';
    }

    public function changeAreaType()
    {
        $this->square_feet = '';
    }
    public function changeAreaTypee()
    {
        $this->square_meter = '';
    }
    

    public function getStockBond()
    {
        $this->stockBonds = OverDraftStockBond::where('apply_loan_id', $this->apply_loan->id)
        ->where('type', $this->tab)
        ->get();
    }
    public function deleteRecord(OverDraftStockBond $stockBond)
    {
       
        $stockBond->delete();
        $this->emit('enableButton', true);
        $this->getStockBond();
    }
}
