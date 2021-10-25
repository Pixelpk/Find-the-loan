<?php

namespace App\Http\Livewire\Cms\Loan\Business\LoanType;

use App\Models\ApplyLoan;
use App\Models\LoanGernalInfo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
class BusinessDebtConsolidation extends Component
{ 
    use WithFileUploads;
    public $apply_loan;
    public $main_type;
    public $loan_type_id;
    public $document;
    public $settlement_notice;
    public $amount;
  
   
    public function mount()
    {
        if($this->apply_loan){
            $this->settlement_notice = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'settlement_notice')->first()->value ?? '';
            $this->document = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'document')->first()->value ?? '';
            $this->amount = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'amount')->first()->value ?? '';
            ///
           
            // $this->settlement_notice = $this->settlement_notice ? $this->settlement_notice->value : '';
            // $this->document = $this->document ?  $this->document->value : '';
            // $this->amount = $this->amount ?  $this->amount->value : '';    
        }
    }
    public function render()
    {
        return view('livewire.cms.loan.business.loan-type.business-debt-consolidation');
    }

    public function store()
    {
       
       $this->validate([
           'amount' => 'required|integer|min:1',
           'document' =>  $this->settlement_notice || $this->apply_loan  ? '' : 'required|mimes:jpg,jpeg,png,pdf',
           'settlement_notice' =>  $this->document || $this->apply_loan ? '' : 'required|mimes:jpg,jpeg,png,pdf',
       ]);
       $data = [
             ['type' => 'file', 'value' => $this->document, 'key' => 'document'], 
             ['type' => 'file', 'value' => $this->settlement_notice, 'key' => 'settlement_notice'], 
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
            if($item['type'] == 'file'){
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
