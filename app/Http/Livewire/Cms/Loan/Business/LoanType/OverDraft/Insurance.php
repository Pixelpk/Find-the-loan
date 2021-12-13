<?php
namespace App\Http\Livewire\Cms\Loan\Business\LoanType\OverDraft;
use App\Models\ApplyLoan;
use App\Models\LoanGernalInfo;
use App\Models\Media;
use App\Models\OverDraftInsurance;
use App\Models\OverDraftPropertyLand;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
class Insurance extends Component
{
    
    use WithFileUploads;
    //parent component data
    public $main_type;
    public $loan_type_id;
    public $apply_loan;
    public $insurance;
    public $type_of_policy;
    public $policy_start_date;
    public $name_of_policy_owner;
    public $company_purchased_from;
    public $other_purchased_from;
    public $insurer;
    public $surrender_value;
    public $currency = "SGD";
    public $images;
    public $above;
    public $tab;
   ///sold///
    public $amount;
    //
   
    public $insurances;
    protected $listeners = [
        'getCurrency'
    ];
    public function getCurrency($value)
    {
    if(!is_null($value))
        $this->currency = $value;
    }
  
    public function getSameName()
    {
        
        if($this->above){
            $this->name_of_policy_owner = $this->insurance;
        }else{
            $this->name_of_policy_owner = '';
        }
       
    }
    public function render()
    {
        $this->getInsurance();
        return view('livewire.cms.loan.business.loan-type.over-draft.insurance');
    }

    public function store()
    {
       
       $this->validate([
           'amount' => 'required|integer|min:1',
           'insurance' => 'required',
           'type_of_policy' => 'required',
           'policy_start_date' => 'required',
           'name_of_policy_owner' => 'required',
           'insurer' => 'required',
           'surrender_value' => 'required',
           'currency' => 'required',
           'other_purchased_from' => $this->company_purchased_from == "other" ?  'required' : '',
           'name_of_policy_owner' => 'required',
       ]);
     
       $overDraft = OverDraftInsurance::forceCreate([
           'apply_loan_id' => $this->apply_loan->id,
           'insurance' => $this->insurance,
           'type_of_policy' => $this->type_of_policy,
           'policy_start_date' => $this->policy_start_date,
           'company_purchased_from' => $this->company_purchased_from,
           'other_purchased_from' => $this->other_purchased_from,
           'name_of_policy_owner' => $this->name_of_policy_owner,
           'above' => $this->above,
           'insurer' => $this->insurer,
           'surrender_value' => $this->surrender_value,
           'currency' => $this->currency,
           'type' => $this->tab,
       ]);
       Media::where('model', '\App\Models\OverDraftInsurance')->where('key', 'over_draft_benifit_illustration')
       ->where('share_holder', 0)
       ->where('model_id', 0)
       ->update([
           'model_id' => $overDraft->id,
       ]);
       $this->emit('getImage');       
       $apply_loan = ApplyLoan::find($this->apply_loan->id);
       $apply_loan->amount = $this->amount;
       $apply_loan->update();
       $this->emit('enableButton', true);
       $this->getInsurance();
    //    $this->emit('alert', ['type' => 'success', 'message' => 'Property Land added successfully.']);
       $this->resetInput();
    }
    public function changeAreaType()
    {
        $this->square_feet = '';
    }
    public function changeAreaTypee()
    {
        $this->square_meter = '';
    }
    public function resetInput()
    {
        $this->insurance = '';
        $this->type_of_policy = '';
        $this->policy_start_date= '';
        $this->name_of_policy_owner= '';
        $this->above= '';
        $this->insurer= '';
        $this->surrender_value= '';
        $this->currency= '';
    }
    public function getInsurance()
    {
        $this->insurances = OverDraftInsurance::where('apply_loan_id', $this->apply_loan->id)->get();
    }
    public function deleteRecord(OverDraftInsurance $OverDraftInsurance)
    {
        $OverDraftInsurance->delete();
        $this->emit('enableButton', true);
        $this->getInsurance();
    }
}
