<?php

namespace App\Http\Livewire\Widget;

use App\Models\ApplyLoan;
use App\Models\LoanGernalInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
class Renovation extends Component
{
    use WithFileUploads;
    public $main_type;
    public $loan_type_id;
    public $tanancy_agreement;
    public $renovation_quotation;
    public $user_owned;
    public $amount;
    public $address;
    public $unit;
    public $building_name;
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
            
            $this->tanancy_agreement = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'tanancy_agreement')->first()->value ?? '';
            $this->user_owned = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'user_owned')->first()->value ?? '';
            $this->renovation_quotation = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'renovation_quotation')->first()->value ?? '';
            $this->amount = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'amount')->first()->value ?? '';
            $this->address = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'address')->first()->value ?? '';
            $this->unit = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'unit')->first()->value ?? '';
            $this->building_name = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'building_name')->first()->value ?? '';
            // $this->user_owned = $this->user_owned->value;
            // $this->renovation_quotation = $this->renovation_quotation->value;
            // $this->amount = $this->amount->value;
            // $this->address = $this->address->value;
            // $this->unit = $this->unit->value;
            // $this->building_name = $this->building_name->value;
            // $this->tanancy_agreement = $this->tanancy_agreement->value;
                    
        }
    }
    public function render()
    {
        return view('livewire.widget.renovation');
    }

    public function store()
    {
       $this->validate([
           'amount' => 'required|integer|min:1',
           'tanancy_agreement' => $this->user_owned  ? '' : 'required|mimes:jpg,jpeg,png,pdf',
           'user_owned' => $this->user_owned ? 'required' : '',
           'renovation_quotation' => $this->apply_loan ? '' : 'required|mimes:jpg,jpeg,png,pdf',
           'address' => $this->user_owned ? 'required' : '',
       ]);  
       
       $data = [
             ['type' => 'file', 'value' => $this->tanancy_agreement, 'key' => 'tanancy_agreement'], 
             ['type' => 'checkbox', 'value' => $this->user_owned, 'key' => 'user_owned'], 
             ['type' => 'file', 'value' => $this->renovation_quotation, 'key' => 'renovation_quotation'], 
             ['type' => 'number', 'value' => $this->amount, 'key' => 'amount'], 
             ['type' => 'text', 'value' => $this->address, 'key' => 'address'], 
             ['type' => 'text', 'value' => $this->unit, 'key' => 'unit'], 
             ['type' => 'text', 'value' => $this->building_name, 'key' => 'building_name'], 
           
       ];
       if($this->apply_loan){
            // $LGI=LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->get();
            // foreach($LGI as $item){
                
            //     if($item['type'] == 'file'){
            //         if(Storage::exists($item['value'])) {
            //             Storage::delete($item['value']);
            //         }
            //     }
            // }
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
}
