<?php

namespace App\Http\Livewire\Widget;

use App\Models\ApplyLoan;
use App\Models\LoanGernalInfo;
use App\Models\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
class ProjectFinance extends Component
{
    use WithFileUploads;
    public $main_type;
    public $loan_type_id;
    public $document = "";
    public $saveImages=[];
    public $tenure;
    public $amount;
    public $apply_loan;
    public $gernalInfo;
    public $images = [];
   

    protected $listeners = [
        'documentReq'
    ];

    public function documentReq($value)
    {
        $this->document = $value;
    }

    public function mount()
    {
        if($this->apply_loan){
            $this->amount = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'amount')->first()->value ?? '';
            $this->tenure = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'tenure')->first()->value ?? '';
        }
    }
    public function render()
    {
        return view('livewire.widget.project-finance');
    }
   
    
   
    public function store()
    {  

        $exist =  Media::where('apply_loan_id', $this->apply_loan->id)->first();
       
        if(!$exist){
            $this->validate([
               'amount' => 'required|integer|min:1',
               'tenure' => 'required|integer|min:1',
               'document' => 'required',
           ],[
               'document.required' => "The document is required.",
           ]);
        }

       $data = [
             ['type' => 'number', 'value' => $this->tenure, 'key' => 'tenure'], 
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
       $media = Media::where('apply_loan_id', null)->get();
       foreach($media as $md)
       {
           $mediaIds[] = $md->id;
           $md->apply_loan_id = $this->apply_loan->id;
           $md->update();
       }
        LoanGernalInfo::forceCreate([
            'type' => 'file',
            'apply_loan_id' => $this->apply_loan->id,
            'key' => 'document',
            'value' => isset($mediaIds) ? json_encode($mediaIds) : '',
        ]);
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
       $this->emit('changeTab',$this->apply_loan->id, 4);
    }
}
