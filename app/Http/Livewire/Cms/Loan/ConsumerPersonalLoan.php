<?php

namespace App\Http\Livewire\Cms\Loan;

use App\Models\ApplyLoan;
use App\Models\LoanGernalInfo;
use App\Models\Media;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
class ConsumerPersonalLoan extends Component
{ 
    use WithFileUploads;
    public $apply_loan;
    public $main_type;
    public $loan_type_id;
  
    public $amount;
  
  

    
    public function mount()
    {
     
       
        if($this->apply_loan){

            $this->amount = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'amount')->first()->value ?? ''; 
        }
    }
    public function render()
    {
        return view('livewire.cms.loan.consumer-personal-loan');
    }

    public function store()
    {
      
       $this->validate([
           'amount' => 'required|integer|min:1',
       ],[
           'amount.integer'=>'Amount must be number',
       ]);
       $data = [
           
             ['type' => 'number', 'value' => $this->amount, 'key' => 'amount'], 
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
    //    dd($data);
       foreach($data as $key => $item)
       {
            
            $LGI = new LoanGernalInfo();
            $LGI->apply_loan_id = $this->apply_loan->id;
            $LGI->type = $item['type'];
            $LGI->key = $item['key'];
           
                $LGI->value = isset($item['value']) ? $item['value'] : '';
         
            $LGI->save();
       }
       $this->gernalInfo = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->get();
       if($this->main_type == 2){
        $this->emit('changeTab',$this->apply_loan->id, 10);
        return;
       }
       $this->emit('changeTab',$this->apply_loan->id, 4);
    }
}
