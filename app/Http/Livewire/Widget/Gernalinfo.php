<?php

namespace App\Http\Livewire\Widget;

use App\Http\Livewire\Cms\ApplyLoan;
use App\Models\ApplyLoan as ModelsApplyLoan;
use App\Models\LoanGernalInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
class Gernalinfo extends Component
{
    use WithFileUploads;
    public $gernalinfo;
    public $main_type;
    public $loan_type_id;
    public $apply_loan;
    public $apply_loan_id;
    
    
    public function render()
    {
        return view('livewire.widget.gernalinfo');
    }
    
    public function store()
    {
        // dd($this->apply_loan);
        foreach(Config::get("gernalinfo.".$this->loan_type_id)  as $key => $item){
            $this->validate([
                'gernalinfo.'.$item['key'] =>  $item['required'],
            ]);
        }
        if($this->apply_loan){
            $this->updateGernalInfo();
            return;
        }
        $AL=ModelsApplyLoan::forceCreate([
            'amount' => $this->gernalinfo['amount'],
            'loan_type_id' => $this->loan_type_id,
            'user_id' => Auth::guard('web')->user()->id,
            'profile' => $this->main_type,
        ]);
        $AL->enquiry_id = date('Y').date('m').$AL->id;
        $AL->update();
        foreach(Config::get("gernalinfo.".$this->loan_type_id)  as $key => $item){
            $name = $item['key']; 
            $gernalInfo = new LoanGernalInfo();
            $gernalInfo->key = $item['key'];
            $gernalInfo->type = $item['type'];
            $gernalInfo->apply_loan_id = $AL->id;
            if($item['type'] == 'file'){
                $gernalInfo->value = $this->gernalinfo[$name]->store('documents');
            }
            if($item['type'] == 'number'){
                $gernalInfo->value = $this->gernalinfo[$name];
            }
            if($item['type'] == 'checkbox'){
                if(!isset($this->gernalinfo[$name])){
                    $gernalInfo->value = 0;
                }else{
                    $gernalInfo->value = $this->gernalinfo[$name];
                }
            }
            $gernalInfo->save();
        }
        $this->apply_loan = $AL;
        $this->emit('getApplyLoan', $this->apply_loan->id);
    }

    public function updateGernalInfo()
    {
        dd('asd');
        $udpateapply_loan  = ModelsApplyLoan::where('id', $this->apply_loan->id)->first();
        $udpateapply_loan->profile = $this->main_type;
        $udpateapply_loan->loan_type_id = $this->loan_type_id;
        $udpateapply_loan->amount = $this->gernalinfo['amount'];
        $udpateapply_loan->update();
        $LGI=LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->get();
        if($LGI->count() > 0){
            foreach($LGI as $item){
                if($item['type'] == 'file'){
                    if($item && Storage::exists($item['value'])) {
                        Storage::delete($item['value']);
                    }
                }
            }
            LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->delete();
        }
        foreach(Config::get("gernalinfo.".$this->loan_type_id)  as $key => $item){
            $name = $item['key']; 
            $gernalInfo = new LoanGernalInfo();
            $gernalInfo->key = $item['key'];
            $gernalInfo->type = $item['type'];
            $gernalInfo->apply_loan_id = $this->apply_loan->id;
            if($item['type'] == 'file'){
                $gernalInfo->value = $this->gernalinfo[$name]->store('documents');
            }
            if($item['type'] == 'number'){
                $gernalInfo->value = $this->gernalinfo[$name];
            }
            if($item['type'] == 'checkbox'){
                if(!isset($this->gernalinfo[$name])){
                    $gernalInfo->value = 0;
                }else{
                    $gernalInfo->value = $this->gernalinfo[$name];
                }
            }
            $gernalInfo->save();
        }
        
    }

   
}
