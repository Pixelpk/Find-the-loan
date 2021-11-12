<?php


namespace App\Http\Livewire\Widget;

use App\Models\ApplyLoan;
use App\Models\LoanGernalInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;


class PropertyLoan extends Component
{
    
    use WithFileUploads;
    public $main_type;
    public $loan_type_id;
    public $agreement;
    public $tmonth_statement;
    public $statement;
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
    public $amount;
    public $apply_loan;
    public $gernalInfo;
    public $property_land_advanced_property_type;
    public $property_land_advanced_graphical_location;
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
         
            $this->unit = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'unit')->first()->value ?? '';
            $this->free_hold = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'free_hold')->first()->value ?? '';
            $this->amount = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'amount')->first()->value ?? '';
            $this->lot_number = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'lot_number')->first()->value ?? '';
            $this->address = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'address')->first()->value ?? '';
            $this->building_name = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'building_name')->first()->value ?? '';
            $this->lease_remaining_year = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'lease_remaining_year')->first()->value ?? '';
            $this->fllor_area = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'fllor_area')->first()->value ?? '';
            $this->useable_area = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'useable_area')->first()->value ?? '';
            $this->square_feet = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'square_feet')->first()->value ?? '';
            $this->square_meter = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'square_meter')->first()->value ?? '';
            $this->preferred_tenure_month = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'preferred_tenure_month')->first()->value ?? '';
            $this->preferred_tenure_year = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'preferred_tenure_year')->first()->value ?? '';
            $this->as_long_as_possiable = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'as_long_as_possiable')->first()->value ?? '';
            $this->property_land_advanced_property_type = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'property_land_advanced_property_type')->first()->value ?? '';
            $this->property_land_advanced_graphical_location = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'property_land_advanced_graphical_location')->first()->value ?? '';
            ///
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
           
            // if(isset($this->as_long_as_possiable->value)){
            //     $this->as_long_as_possiable = $this->as_long_as_possiable->value;
            // }  
                    
        }
    }
    public function render()
    {
        return view('livewire.widget.property-loan');
    }

    public function store()
    {
       
       $this->validate([
           'amount' => 'required|integer|min:1',
        //    'agreement' =>  $this->apply_loan ? '' : 'required|mimes:jpg,jpeg,png,pdf',
        //    'tmonth_statement' => $this->tmonth_statement ?  'mimes:jpg,jpeg,png,pdf' : '',
        //    'statement' => $this->statement ?  'mimes:jpg,jpeg,png,pdf' : '',
           'lot_number' => $this->address ?  '' : 'required',
           'address' => $this->lot_number ?  '' : 'required',
           'lease_remaining_year' => 'required|integer|min:1',
           'useable_area' => 'required|integer|min:1',
           'preferred_tenure_year' => 'required|integer|min:1',
           'preferred_tenure_month' => 'required|integer|min:1',
           'property_land_advanced_property_type' => 'required',
           'property_land_advanced_graphical_location' => 'required',
          
           
       ]);
       $data = [
            //  ['type' => 'file', 'value' => $this->agreement, 'key' => 'agreement'], 
            //  ['type' => 'file', 'value' => $this->tmonth_statement, 'key' => 'tmonth_statement'], 
            //  ['type' => 'file', 'value' => $this->statement, 'key' => 'statement'], 
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
             ['type' => 'text', 'value' => $this->as_long_as_possiable, 'key' => 'as_long_as_possiable'], 
             ['type' => 'radio', 'value' => $this->property_land_advanced_property_type, 'key' => 'property_land_advanced_property_type'], 
             ['type' => 'radio', 'value' => $this->property_land_advanced_graphical_location, 'key' => 'property_land_advanced_graphical_location'], 
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
