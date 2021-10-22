<?php
namespace App\Http\Livewire\Cms\Loan\Business\LoanType\OverDraft;
use App\Models\ApplyLoan;
use App\Models\LoanGernalInfo;
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
   
   ///sold///
    public $address;
    public $unit;
    public $building_name;
    public $lease_remaining_year;
    public $free_hold;
    public $floor_area;
    public $useable_area;
    public $square_feet;
    public $square_meter;
    public $completed;
    public $construction_year;
    public $construction_year_time;
    public $float_rate;
    public $fix_rate;
    public $amount;
    //
    protected $listeners = [
        'getAddress'
    ];
    public $propertyLands;
    public function getAddress($value)
    {
    if(!is_null($value))
        $this->address = $value;
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
           'address' => 'required',
           'lease_remaining_year' => $this->free_hold ? '' : 'required',
           'free_hold' => $this->lease_remaining_year ? '' : 'required',
           'useable_area' => 'required',
           'square_feet' => $this->square_meter ? '' : 'required',
           'square_meter' => $this->square_feet ? '' : 'required',
       ]);
     
       OverDraftPropertyLand::forceCreate([
           'apply_loan_id' => $this->apply_loan->id,
           'address' => $this->address,
           'unit' => $this->unit,
           'useable_area' => $this->useable_area,
           'building_name' => $this->building_name,
           'lease_remaining_year' => $this->lease_remaining_year,
           'free_hold' => $this->free_hold,
           'floor_area' => $this->floor_area,
        //    'user_able_area' => $this->user_able_area,
           'square_feet' => $this->square_feet,
           'square_meter' => $this->square_meter,
           'completed' => $this->completed,
           'construction_year' => $this->construction_year,
           'construction_year_time' => $this->construction_year_time,
         
           'float_rate' => $this->float_rate,
           'fix_rate' => $this->fix_rate,
       ]);
      
       $apply_loan = ApplyLoan::find($this->apply_loan->id);
       $apply_loan->amount = $this->amount;
       $apply_loan->update();
       $this->getInsurance();
       $this->emit('alert', ['type' => 'success', 'message' => 'Property Land added successfully.']);
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
        $this->address = '';
        $this->unit = '';
        $this->building_name = '';
        $this->lease_remaining = '';
        $this->free_hold = '';
        $this->floor_area = '';
        $this->user_able_area = '';
        $this->square_feet = '';
        $this->square_meter = '';
        $this->completed = '';
        $this->construction_year = '';
        $this->construction_year_time = '';
        $this->fix_rate = '';
        $this->float_rate = '';
    }

    public function getInsurance()
    {
        $this->propertyLands = OverDraftPropertyLand::where('apply_loan_id', $this->apply_loan->id)->get();
    }
    public function deleteRecord(OverDraftPropertyLand $overDraftPropertyLand)
    {
       
        $overDraftPropertyLand->delete();
        $this->getInsurance();
    }
}
