<?php

namespace App\Http\Livewire\Widget;

use App\Http\Livewire\Cms\ApplyLoan;
use App\Models\ApplyLoan as ModelsApplyLoan;
use App\Models\BusinessOverDraft;
use App\Models\LoanGernalInfo;
use App\Models\OverDraftDeposit;
use App\Models\OverDraftInsurance;
use App\Models\OverDraftPropertyLand;
use App\Models\OverDraftStockBond;
use App\Models\OverDraftTrustFund;
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
    public $enableButtons  = true;
    
    
    protected $listeners = [
        'enableButton'
    ];
    public function mount()
    {
        $this->getData();
        // dd($this->apply_loan);
      
    }
    public function enableButton($value)
    {
        $sizeof = sizeof($this->overdraft['security_type']);
        $sum = 0;
        $this->enableButtons= true;
        foreach($this->overdraft['security_type'] as $key => $item){
            if($key == 2){
               
                $trustFund=OverDraftTrustFund::where('apply_loan_id', $this->apply_loan->id)->where('type', 2)->count();
                if($trustFund > 0){
                    $sum++;
                }
            }
            if($key == 3){
                $stock=OverDraftStockBond::where('apply_loan_id', $this->apply_loan->id)->where('type', 3)->count();
                if($stock > 0){
                    $sum++;
                }
            }
            if($key == 1){
                $stock=OverDraftInsurance::where('apply_loan_id', $this->apply_loan->id)->where('type', 1)->count();
                if($stock > 0){
                    $sum++;
                }
            }
            if($key == 4){
                $bond=OverDraftStockBond::where('apply_loan_id', $this->apply_loan->id)->where('type', 4)->count();
                if($bond > 0){
                    $sum++;
                }
            }
            if($key == 5){
                $stock=OverDraftDeposit::where('apply_loan_id', $this->apply_loan->id)->where('deposit_type', 5)->count();
                if($stock > 0){
                    $sum++;
                }
            }
            if($key == 8){
                $stock=OverDraftDeposit::where('apply_loan_id', $this->apply_loan->id)->where('deposit_type', 8)->count();
                if($stock > 0){
                    $sum++;
                }
            }
            if($key == 6){
                $stock=OverDraftDeposit::where('apply_loan_id', $this->apply_loan->id)->where('deposit_type', 6)->count();
                if($stock > 0){
                    $sum++;
                }
            }
            if($key == 7){
                $stock=OverDraftPropertyLand::where('apply_loan_id', $this->apply_loan->id)->where('type', 7)->count();
                if($stock > 0){
                    $sum++;
                }
            }
        }
        if($sizeof  ==  $sum){
            $this->enableButtons  = false;
        }
        
    }
    public function render()
    {
      
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
                $this->overdraft['security_type'] =  $overDraft->security_type;
                $this->enableButtons  = false;
            }
        }
        if($amount){
            $this->amount = $amount;
        }
    }

    public function tabChange(){
       
        $this->emit('changeTab',$this->apply_loan->id, 4);
    }
    
    public function store()
    {
        // dd($this->overdraft);
        $min=min(array_keys($this->overdraft['security_type']));   
        $this->tab = $min;
    }
    public function removeIndexInSecurityType($value)
    {
        BusinessOverDraft::where('apply_loan_id', $this->apply_loan->id)->delete();
        $overDraftType = new BusinessOverDraft();
        $overDraftType->type = 2; 
        $overDraftType->type_value = $this->overdraft['secure']; 
        $overDraftType->apply_loan_id = $this->apply_loan->id; 
        $overDraftType->security_type = $this->overdraft['security_type'];
        $overDraftType->save(); 
        if(!$this->overdraft['security_type'][$value]){
            unset($this->overdraft['security_type'][$value]);
        }
        $this->emit('enableButton', true);
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
                $overDraftType->security_type = $this->overdraft['sc']; 

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
