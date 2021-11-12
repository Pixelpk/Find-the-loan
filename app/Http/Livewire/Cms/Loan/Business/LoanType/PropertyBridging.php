<?php
namespace App\Http\Livewire\Cms\Loan\Business\LoanType;
use App\Models\ApplyLoan;
use App\Models\LoanGernalInfo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
class PropertyBridging extends Component
{
    
    use WithFileUploads;
    //parent component data
    public $main_type;
    public $loan_type_id;
    public $agreement;
   ///sold///
    public $sold_agreement;
    public $sold_tmonth_statement;
    public $sold_statement;
    public $sold_lot_number;
    public $sold_address;
    public $sold_unit;
    public $sold_building_name;
    public $sold_lease_remaining_year;
    public $sold_fllor_area;
    public $sold_useable_area;
    public $sold_square_feet;
    public $sold_free_hold;
    public $sold_square_meter;
    /// new
    public $new_lot_number;
    public $new_address;
    public $new_unit;
    public $new_building_name;
    public $new_lease_remaining_year;
    public $new_free_hold;
    public $new_useable_area;
    public $new_square_feet;
    public $new_square_meter;
    public $completed;
    public $construction_year;
    public $construction_year_time;
    public $letter_of_loan_new_agreement;
    public $new_sale_purchase_agreement;
    // public $preferred_tenure_year;
    // public $preferred_tenure_month;
    public $as_long_as_possiable;
    public $new_floor_area;
    public $preferred_tenure_year;
    public $preferred_tenure_month;
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
            // sold property information 
            $this->sold_lot_number = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'sold_lot_number')->first()->value ?? '';
            $this->sold_address =  LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'sold_address')->first()->value ?? '';
            $this->sold_unit = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'sold_unit')->first()->value ?? '';
            $this->sold_building_name = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'sold_building_name')->first()->value ?? '';
            $this->sold_lease_remaining_year = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'sold_lease_remaining_year')->first()->value ?? '';
            $this->sold_free_hold = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'sold_free_hold')->first()->value ?? '';
            $this->sold_fllor_area = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'sold_fllor_area')->first()->value ?? '';
            $this->sold_useable_area = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'sold_useable_area')->first()->value ?? '';
            $this->sold_square_feet = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'sold_square_feet')->first()->value ?? '';      
            $this->new_lot_number = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'new_lot_number')->first()->value ?? '';      
            $this->new_address = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'new_address')->first()->value ?? '';      
            $this->new_unit = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'new_unit')->first()->value ?? '';      
            $this->new_building_name = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'new_building_name')->first()->value ?? '';      
            $this->new_lease_remaining_year = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'new_lease_remaining_year')->first()->value ?? '';      
            $this->new_free_hold = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'new_free_hold')->first()->value ?? '';      
            $this->new_square_feet = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'new_square_feet')->first()->value ?? '';      
            $this->new_square_meter = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'new_square_meter')->first()->value ?? '';      
            $this->completed = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'completed')->first()->value ?? '';      
            $this->construction_year = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'construction_year')->first()->value ?? '';      
            $this->construction_year_time = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'construction_year_time')->first()->value ?? '';      
            $this->preferred_tenure_year = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'preferred_tenure_year')->first()->value ?? '';      
            $this->preferred_tenure_month = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'preferred_tenure_month')->first()->value ?? '';      
            $this->amount = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'amount')->first()->value ?? '';      
            $this->new_floor_area = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'new_floor_area')->first()->value ?? '';      
            $this->new_useable_area = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'new_useable_area')->first()->value ?? '';      
            $this->as_long_as_possiable = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'as_long_as_possiable')->first()->value ?? '';      
                 
        }
    }
    public function render()
    {
        return view('livewire.cms.loan.business.loan-type.property-bridging');
    }

    public function store()
    {
       
       $this->validate([
           'amount' => 'required|integer|min:1',
        //    'sold_agreement' =>  $this->sold_agreement ? 'mimes:jpg,jpeg,png,pdf' : '',
        //    'sold_tmonth_statement' =>  $this->sold_tmonth_statement ? 'mimes:jpg,jpeg,png,pdf' : '',
        //    'sold_statement' =>  $this->sold_statement ? 'mimes:jpg,jpeg,png,pdf' : '',
        //    'sold_lot_number' => $this->sold_address ?  '' : 'required',
        //    'sold_address' => $this->sold_lot_number ?  '' : 'required',
        //    'sold_lease_remaining_year' => $this->sold_free_hold ? '' : 'required|integer|min:1',
        //    'sold_free_hold' => $this->sold_lease_remaining_year ? '' : 'required',
        //    'sold_useable_area' => 'required|integer',
        //    'sold_square_meter' => $this->sold_square_feet ? '' : 'required',
        //    'sold_square_feet' => $this->sold_square_meter ? '' : 'required',
       ]);
       $data = [

            //  ['type' => 'file', 'value' => $this->sold_agreement, 'key' => 'sold_agreement'],           
            //  ['type' => 'file', 'value' => $this->sold_tmonth_statement, 'key' => 'sold_tmonth_statement'],           
            //  ['type' => 'file', 'value' => $this->sold_statement, 'key' => 'sold_statement'],   
             ['type' => 'number', 'value' => $this->sold_lot_number, 'key' => 'sold_lot_number'],         
             ['type' => 'text', 'value' => $this->sold_address, 'key' => 'sold_address'],         
             ['type' => 'text', 'value' => $this->sold_unit, 'key' => 'sold_unit'],         
             ['type' => 'text', 'value' => $this->sold_building_name, 'key' => 'sold_building_name'],         
             ['type' => 'text', 'value' => $this->sold_lease_remaining_year, 'key' => 'sold_lease_remaining_year'],         
             ['type' => 'text', 'value' => $this->sold_free_hold, 'key' => 'sold_free_hold'],         
             ['type' => 'text', 'value' => $this->sold_fllor_area, 'key' => 'sold_fllor_area'],         
             ['type' => 'text', 'value' => $this->sold_square_feet, 'key' => 'sold_square_feet'],         
             ['type' => 'text', 'value' => $this->sold_square_meter, 'key' => 'sold_square_meter'],         
             ['type' => 'text', 'value' => $this->sold_useable_area, 'key' => 'sold_useable_area'],  
            //  new property information        
            //  ['type' => 'file', 'value' => $this->letter_of_loan_new_agreement, 'key' => 'letter_of_loan_new_agreement'],           
            //  ['type' => 'file', 'value' => $this->new_sale_purchase_agreement, 'key' => 'new_sale_purchase_agreement'],           
             ['type' => 'number', 'value' => $this->new_lot_number, 'key' => 'new_lot_number'], 
             ['type' => 'text', 'value' => $this->new_address, 'key' => 'new_address'], 
             ['type' => 'text', 'value' => $this->new_unit, 'key' => 'new_unit'], 
             ['type' => 'text', 'value' => $this->new_building_name, 'key' => 'new_building_name'], 
             ['type' => 'number', 'value' => $this->new_lease_remaining_year, 'key' => 'new_lease_remaining_year'], 
             ['type' => 'checkbox', 'value' => $this->new_free_hold, 'key' => 'new_free_hold'], 
             ['type' => 'text', 'value' => $this->new_floor_area, 'key' => 'new_floor_area'], 
             ['type' => 'text', 'value' => $this->new_useable_area, 'key' => 'new_useable_area'], 
             ['type' => 'checkbox', 'value' => $this->new_square_feet, 'key' => 'new_square_feet'], 
             ['type' => 'checkbox', 'value' => $this->new_square_meter, 'key' => 'new_square_meter'], 
             ['type' => 'checkbox', 'value' => $this->completed, 'key' => 'completed'], 
             ['type' => 'option', 'value' => $this->construction_year, 'key' => 'construction_year'], 
             ['type' => 'option', 'value' => $this->construction_year_time, 'key' => 'construction_year_time'],
             ['type' => 'number', 'value' => $this->preferred_tenure_year, 'key' => 'preferred_tenure_year'], 
             ['type' => 'number', 'value' => $this->preferred_tenure_month, 'key' => 'preferred_tenure_month'], 
             ['type' => 'number', 'value' => $this->amount, 'key' => 'amount'], 
             
            //  ['type' => 'checkbox', 'value' => $this->float_rate, 'key' => 'float_rate'], 
            //  ['type' => 'checkbox', 'value' => $this->fix_rate, 'key' => 'fix_rate'], 
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
