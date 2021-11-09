<?php
namespace App\Http\Livewire\Cms\Loan\Business\LoanType\OverDraft;
use App\Models\ApplyLoan;
use App\Models\LoanGernalInfo;
use App\Models\Media;
use App\Models\OverDraftPropertyLand;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
class PropertyLand extends Component
{
    
    use WithFileUploads;
    //parent component data
    public $main_type;
    public $loan_type_id;
    public $apply_loan;
    public $tab;
   
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
    public $media = [];
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
    public function mount()
    {
        if($this->apply_loan){
         
            // $this->unit = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'unit')->first();
            // $this->free_hold = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'free_hold')->first();
            // $this->amount = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'amount')->first();
            // $this->lot_number = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'lot_number')->first();
            // $this->address = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'address')->first();
            // $this->building_name = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'building_name')->first();
            // $this->lease_remaining_year = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'lease_remaining_year')->first();
            // $this->fllor_area = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'fllor_area')->first();
            // $this->useable_area = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'useable_area')->first();
            // $this->square_feet = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'square_feet')->first();
            // $this->square_meter = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'square_meter')->first();
            // $this->preferred_tenure_month = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'preferred_tenure_month')->first();
            // $this->preferred_tenure_year = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'preferred_tenure_year')->first();
            // $this->as_long_as_possiable = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'as_long_as_possiable')->first();
            // $this->completed = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'completed')->first();
            // $this->construction_year = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'construction_year')->first();
            // $this->construction_year_time = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'construction_year_time')->first();
            // $this->fix_rate = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'fix_rate')->first();
            // $this->float_rate = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'float_rate')->first();
            // ///
            // $this->unit = $this->unit->value;
            // $this->amount = $this->amount->value;
            // $this->free_hold = $this->free_hold->value;
            // $this->address = $this->address->value;
            // $this->lot_number = $this->lot_number->value;
            // $this->building_name = $this->building_name->value;
            // $this->lease_remaining_year = $this->lease_remaining_year->value;
            // $this->fllor_area = $this->fllor_area->value;
            // $this->useable_area = $this->useable_area->value;
            // $this->square_feet = $this->square_feet->value;
            // $this->square_meter = $this->square_meter->value;
            // $this->preferred_tenure_month = $this->preferred_tenure_month->value;
            // $this->preferred_tenure_year = $this->preferred_tenure_year->value;
            // $this->completed = $this->completed->value;
            // $this->construction_year = $this->construction_year->value;
            // $this->construction_year_time = $this->construction_year_time->value;
            // $this->float_rate = $this->float_rate->value;
            // $this->fix_rate = $this->fix_rate->value;
            
            // if(isset($this->as_long_as_possiable->value)){
            //     $this->as_long_as_possiable = $this->as_long_as_possiable->value;
            // }  
                    
        }
    }
    public function render()
    {
        $this->getProperLand();
        return view('livewire.cms.loan.business.loan-type.over-draft.property-land');
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
       $overDraft = OverDraftPropertyLand::forceCreate([
           'apply_loan_id' => $this->apply_loan->id,
           'address' => $this->address,
           'unit' => $this->unit,
           'useable_area' => $this->useable_area,
           'building_name' => $this->building_name,
           'lease_remaining_year' => $this->lease_remaining_year,
           'free_hold' => $this->free_hold,
           'floor_area' => $this->floor_area,
           'square_feet' => $this->square_feet,
           'square_meter' => $this->square_meter,
           'completed' => $this->completed,
           'construction_year' => $this->construction_year,
           'construction_year_time' => $this->construction_year_time,
           'float_rate' => $this->float_rate,
           'fix_rate' => $this->fix_rate,
           'type' => $this->tab,
       ]);

       Media::where('model', 'App\Models\OverDraftPropertyLand')
       ->where('apply_loan_id', $this->apply_loan->id)
       ->where('share_holder', 0)
       ->where('model_id', 0)
       ->update([
           'model_id' => $overDraft->id,
       ]);
       $this->emit('getImage'); 
       $this->emit('enableButton', true);
       $apply_loan = ApplyLoan::find($this->apply_loan->id);
       $apply_loan->amount = $this->amount;
       $apply_loan->update();
       $this->getProperLand();
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

    public function getProperLand()
    {
        $this->propertyLands = OverDraftPropertyLand::where('apply_loan_id', $this->apply_loan->id)->get();
    }

    public function deleteRecord(OverDraftPropertyLand $overDraftPropertyLand)
    {
       
        $overDraftPropertyLand->delete();
        $this->getProperLand();
    }

    public function showDocuments($id)
    {
        $this->media = Media::where('model_id', $id)->get();
    }
}
