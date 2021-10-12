<?php


namespace App\Http\Livewire\Widget;

use App\Models\ApplyLoan;
use App\Models\LoanGernalInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;


class NewLoan extends Component
{
    
    use WithFileUploads;
    public $main_type;
    public $loan_type_id;
    public $agreement;
  
    public $lot_number;
    public $address;
    public $unit;
    public $building_name;
    public $lease_remaining_year;
    public $free_hold;
    public $fllor_area;
    public $useable_area;
    public $square_feet;
    public $square_meter;
    public $preferred_tenure_year;
    public $preferred_tenure_month;
    public $as_long_as_possiable;
    //
    public $completed;
    public $construction_year;
    public $construction_year_time;
    public $check_offer;
    //
    public $amount;
    public $apply_loan;
    public $gernalInfo;
    protected $listeners = [
        'getAddress'
    ];
    public function getAddress($value)
    {
    if(!is_null($value))
        $this->address = $value;
    }
    public function mount()
    {
        if($this->apply_loan){
         
            $this->unit = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'unit')->first();
            $this->free_hold = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'free_hold')->first();
            $this->amount = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'amount')->first();
            $this->lot_number = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'lot_number')->first();
            $this->address = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'address')->first();
            $this->building_name = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'building_name')->first();
            $this->lease_remaining_year = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'lease_remaining_year')->first();
            $this->fllor_area = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'fllor_area')->first();
            $this->useable_area = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'useable_area')->first();
            $this->square_feet = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'square_feet')->first();
            $this->square_meter = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'square_meter')->first();
            $this->preferred_tenure_month = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'preferred_tenure_month')->first();
            $this->preferred_tenure_year = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'preferred_tenure_year')->first();
            $this->as_long_as_possiable = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'as_long_as_possiable')->first();
            $this->completed = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'completed')->first();
           
            $this->construction_year = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'construction_year')->first();
            $this->construction_year_time = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'construction_year_time')->first();
            $this->check_offer = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'check_offer')->first();
            ///
           
            $this->unit = $this->unit->value;
            $this->amount = $this->amount->value;
            $this->free_hold = $this->free_hold->value;
            $this->address = $this->address->value;
            $this->lot_number = $this->lot_number->value;
            $this->building_name = $this->building_name->value;
            $this->lease_remaining_year = $this->lease_remaining_year->value;
            $this->fllor_area = $this->fllor_area->value;
            $this->useable_area = $this->useable_area->value;
            $this->square_feet = $this->square_feet->value;
            $this->square_meter = $this->square_meter->value;
            $this->preferred_tenure_month = $this->preferred_tenure_month->value;
            $this->preferred_tenure_year = $this->preferred_tenure_year->value;
            $this->completed = $this->completed->value;
            $this->construction_year = $this->construction_year->value;
            $this->construction_year_time = $this->construction_year_time->value;
            $this->check_offer = $this->check_offer->value;
            
            if(isset($this->as_long_as_possiable->value)){
                $this->as_long_as_possiable = $this->as_long_as_possiable->value;
            }  
                    
        }
    }
    public function render()
    {
        return view('livewire.widget.new-loan');
    }

    public function store()
    {
       $this->validate([
           'amount' => 'required|integer|min:1',
           'agreement' =>  $this->agreement ? 'mimes:jpg,jpeg,png,pdf' : '',
           'lot_number' => $this->address ?  '' : 'required',
           'address' => $this->lot_number ?  '' : 'required',
           'lease_remaining_year' => 'required|integer|min:1',
           'useable_area' => 'required|integer|min:1',
           'preferred_tenure_year' => 'required|integer|min:1',
           'preferred_tenure_month' => 'required|integer|min:1',
           'check_offer' => 'required',
       ]);
       $data = [
             ['type' => 'file', 'value' => $this->agreement, 'key' => 'agreement'], 
          
             ['type' => 'number', 'value' => $this->lot_number, 'key' => 'lot_number'], 
             ['type' => 'text', 'value' => $this->address, 'key' => 'address'], 
             ['type' => 'text', 'value' => $this->unit, 'key' => 'unit'], 
             ['type' => 'text', 'value' => $this->building_name, 'key' => 'building_name'], 
             ['type' => 'number', 'value' => $this->lease_remaining_year, 'key' => 'lease_remaining_year'], 
             ['type' => 'checkbox', 'value' => $this->free_hold, 'key' => 'free_hold'], 
             ['type' => 'text', 'value' => $this->fllor_area, 'key' => 'fllor_area'], 
             ['type' => 'text', 'value' => $this->useable_area, 'key' => 'useable_area'], 
             ['type' => 'checkbox', 'value' => $this->square_feet, 'key' => 'square_feet'], 
             ['type' => 'checkbox', 'value' => $this->square_meter, 'key' => 'square_meter'], 
             ['type' => 'number', 'value' => $this->preferred_tenure_year, 'key' => 'preferred_tenure_year'], 
             ['type' => 'number', 'value' => $this->preferred_tenure_month, 'key' => 'preferred_tenure_month'], 
             ['type' => 'number', 'value' => $this->amount, 'key' => 'amount'], 
             ['type' => 'checkbox', 'value' => $this->completed, 'key' => 'completed'], 
             ['type' => 'option', 'value' => $this->construction_year, 'key' => 'construction_year'], 
             ['type' => 'option', 'value' => $this->construction_year_time, 'key' => 'construction_year_time'], 
             ['type' => 'radio', 'value' => $this->check_offer, 'key' => 'check_offer'], 
       ];
      
       if($this->apply_loan){
            LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->delete();
            $this->apply_loan->profile = $this->main_type;
            $this->apply_loan->loan_type_id = $this->loan_type_id;
            $this->apply_loan->amount = $this->amount;
            $this->apply_loan->update();
       }
       else
       {
            $this->apply_loan = ApplyLoan::forceCreate([
            'loan_type_id' => $this->loan_type_id,
            'amount' => $this->amount,
            'profile' => $this->main_type,
            'user_id' => Auth::guard('web')->user()->id,
            ]);
        }
       
       foreach($data as $key => $item)
       {
            
            $LGI = new LoanGernalInfo();
            $LGI->apply_loan_id = $this->apply_loan->id;
            $LGI->type = $item['type'];
            $LGI->key = $item['key'];
            if($item['type'] == 'file'){
               
                $LGI->value = isset($item['value']) && \File::extension($item['value']) == 'tmp' ? $item['value']->store('documents') : isset($item['value']);
            }else{
                $LGI->value = isset($item['value']) ? $item['value'] : '';
            }
            $LGI->save();
       }
       $this->gernalInfo = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->get();
       $this->emit('changeTab',$this->apply_loan->id, 4);
    }

    public function changeAreaType()
    {
        $this->square_feet = '';
    }
    public function changeAreaTypee()
    {
        $this->square_meter = '';
    }
}
