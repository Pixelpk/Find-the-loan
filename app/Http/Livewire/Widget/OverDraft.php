<?php

namespace App\Http\Livewire\Widget;

use App\Http\Livewire\Cms\ApplyLoan;
use App\Models\ApplyLoan as ModelsApplyLoan;
use App\Models\BusinessOverDraft;
use App\Models\LoanGernalInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
class OverDraft extends Component
{
    use WithFileUploads;
    public $overdraft;
    public $main_type;
    public $loan_type_id;
    public $apply_loan;
    public $apply_loan_id;
    public $tab='9';
    public $securityShow;
    public $amount;
    
    
    
    public function render()
    {
       $this->getData();
        return view('livewire.widget.over-draft');
    }
    public function getData()
    {
       
        $amount = ModelsApplyLoan::where('id', $this->apply_loan->id)->first()->amount;
        $overDraft = BusinessOverDraft::where('apply_loan_id', $this->apply_loan->id)->first();
        if($overDraft){
            if($overDraft->type == 1){
                $this->overdraft['unsecured'] = true;
            }else{
                $this->overdraft['secure'] = true;
            }
        }
        if($amount){
            $this->amount = $amount;
        }
    }
    
    public function store()
    {
        // dd($this->overdraft);
        $this->tab = 2;
    }
    public function removeIndexInSecurityType($value)
    {
        
        if(!$this->overdraft['security_type'][$value]){
            
            unset($this->overdraft['security_type'][$value]);
        }
    }
    public function ChnageTab($key)
    {
      
       $this->tab = $key;
      
    }
    public function changeType()
    {
        // && $this->overdraft['unsecured']
        $overDraftType = BusinessOverDraft::where('apply_loan_id', $this->apply_loan->id)->first();
        if($overDraftType)
        {
            if(isset($this->overdraft['unsecured']) && $this->overdraft['unsecured'])
            {
               
                $overDraftType->type = 1; 
                $overDraftType->type_value = $this->overdraft['unsecured']; 
            }
            if(isset($this->overdraft['secure']) && $this->overdraft['secure'])
            {
            
                $overDraftType->type = 2; 
                $overDraftType->type_value = $this->overdraft['secure']; 
            }
            $loan = ModelsApplyLoan::where('id', $this->apply_loan->id)->first();
            $loan->amount = $this->amount;
            $loan->update();
            $overDraftType->update();
           
        }else{
            
            $overDraftType = new BusinessOverDraft();
            // dd();
            if(isset($this->overdraft['unsecured']) && $this->overdraft['unsecured'])
            {
               
                $overDraftType->type = 1; 
                $overDraftType->apply_loan_id = $this->apply_loan->id; 

                $overDraftType->type_value = $this->overdraft['unsecured']; 
            }
            if(isset($this->overdraft['secure']) && $this->overdraft['secure'])
            {
            
                $overDraftType->type = 2; 
                $overDraftType->type_value = $this->overdraft['secure']; 
                $overDraftType->apply_loan_id = $this->apply_loan->id; 

            }
            $loan = ModelsApplyLoan::where('id', $this->apply_loan->id)->first();
            $loan->amount = $this->amount;
            $loan->update();
            $overDraftType->save();
            
        }
    }
   
   

   
}
