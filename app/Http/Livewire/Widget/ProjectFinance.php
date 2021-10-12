<?php

namespace App\Http\Livewire\Widget;

use App\Models\ApplyLoan;
use App\Models\LoanGernalInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
class ProjectFinance extends Component
{
    use WithFileUploads;
    public $main_type;
    public $loan_type_id;
    public $document;
    public $tenure;
    public $amount;
    public $apply_loan;
    public $gernalInfo;
   
    public function mount()
    {
        if($this->apply_loan){
            $this->document = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'document')->first();
            $this->amount = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'amount')->first();
            $this->tenure = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'tenure')->first();
            $this->document = $this->document->value;
            $this->amount = $this->amount->value;
            $this->tenure = $this->tenure->value;
         
        }
    }
    public function render()
    {
        return view('livewire.widget.project-finance');
    }

    public function store()
    {
       $this->validate([
           'amount' => 'required|integer|min:1',
           'tenure' => 'required|integer|min:1',
           'document' => $this->apply_loan ? '' : 'required|mimes:jpg,jpeg,png,pdf',
       ]);
       $data = [
             ['type' => 'file', 'value' => $this->document, 'key' => 'document'], 
             ['type' => 'number', 'value' => $this->tenure, 'key' => 'tenure'], 
             ['type' => 'number', 'value' => $this->amount, 'key' => 'amount'], 
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
                // dd($item['value']);
                $LGI->value = isset($item['value']) && \File::extension($item['value']) == 'tmp' ? $item['value']->store('documents') : $item['value'];
            }else{
                $LGI->value = isset($item['value']) ? $item['value'] : '';
            }
            $LGI->save();
       }
       $this->gernalInfo = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->get();
       $this->emit('changeTab',$this->apply_loan->id, 4);
    }
}
