<?php
namespace App\Http\Livewire\Cms\Loan\Business\LoanType;
use App\Models\ApplyLoan;
use App\Models\BusinessHirePurchase;
use App\Models\LoanGernalInfo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
class HirePurchase extends Component
{
    
    use WithFileUploads;
    public $hirePurchase;
    
    //parent component data
    public $main_type;
    public $loan_type_id;
    public $agreement;
    public $apply_loan;
    public $hirePurchaseGet=[];
  
    protected $listeners = [
        'getAddress'
    ];
    protected $rules = [
        'hirePurchase.amount' => 'required|integer|min:1',
        'hirePurchase.address' =>  'required',
        'hirePurchase.type' =>  'required',
        'hirePurchase.distributer' =>  'nullable',
        'hirePurchase.hire_purchase_type' =>  'nullable',
        'hirePurchase.agreement' =>  'nullable',
        'hirePurchase.manufacturer' =>  'nullable',
        'hirePurchase.model' =>  'nullable',
        'hirePurchase.number_of_units' =>  'nullable',
        'hirePurchase.country_of_origin' =>  'nullable',
        'hirePurchase.price_per_unit' =>  'nullable',
        'hirePurchase.remark' =>  'nullable',
        'hirePurchase.brochure' =>  'nullable',
        'hirePurchase.preferred_tenure_year' =>  'nullable',
        'hirePurchase.preferred_tenure_month' =>  'nullable',
        'hirePurchase.as_long_as_possiable' =>  'nullable',
        'hirePurchase.unit' =>  'nullable',
        'hirePurchase.building_name' =>  'nullable',
        'hirePurchase.property_type' =>  'required',
        'hirePurchase.lender_name' =>  "required_if:hirePurchase.property_type,Rented",
        'hirePurchase.gearup_or_refinancing' =>  "required_if:loan_type_id,10,11",
    ];
    public function mount()
    {
        $this->hirePurchase = new BusinessHirePurchase();
        $this->hirePurchase['amount'] = $this->apply_loan->amount ?? '';
    }
    public function getAddress($value)
    {
        if(!is_null($value))
            $this->hirePurchase['address'] = $value;
        }
   
    public function render()
    {
        return view('livewire.cms.loan.business.loan-type.hire-purchase');
    }

    public function store()
    {
        $this->validate();
        $this->hirePurchase['apply_loan_id'] = $this->apply_loan->id;
        $this->hirePurchase->save();
        $oldValue = $this->hirePurchase['hire_purchase_type'];
        $applyloan= ApplyLoan::where('id', $this->apply_loan->id)->first();
        $applyloan->amount = $this->hirePurchase['amount'];
        $applyloan->update();
        $this->hirePurchase = new BusinessHirePurchase();
        $this->hirePurchase['hire_purchase_type'] =  $oldValue;
        $this->hirePurchase['amount'] =  $applyloan->amount;
        $this->getHirePurchase();
    }

    public function getHirePurchase()
    {
        $this->hirePurchaseGet = BusinessHirePurchase::where('apply_loan_id', $this->apply_loan->id)->get();
    }
}
