<?php

namespace App\Http\Livewire\Cms\Loan\Business\LoanType;

use App\Models\ApplyLoan;
use App\Models\LoanGernalInfo;
use App\Models\Media;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
class BusinessPurchaseOrder extends Component
{ 
    use WithFileUploads;
    public $apply_loan;
    public $main_type;
    public $loan_type_id;
    public $documents;
    public $document;
    public $settlement_notice;
    public $amount;
    public $notified;
    public $unnotified;
  
    protected $listeners = [
        'documentReq'
    ];

    public function documentReq($value)
    {
       
        $this->documents = $value;
        $this->settlement_notice = $value;
    }
    public function mount()
    {
     
        $media  = Media::where('model', '\App\Models\OverDraftInsurance')
        ->whereIn('key', ['debt_consolidation_settlement_notice', 'debt_consolidation_documents'])
        ->where('apply_loan_id', $this->apply_loan->id)
        ->where('model_id', 0)
        ->where('share_holder', 0)
        ->get();
        if($media->count() > 0){
            // dd($media);
            $this->documents = 'pass';
            $this->document = 'pass';
            $this->settlement_notice = 'pass';
        }
        if($this->apply_loan){

            $this->amount = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'amount')->first()->value ?? ''; 
            $this->notified = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'notified')->first()->value ?? ''; 
            $this->unnotified = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->where('key', 'unnotified')->first()->value ?? ''; 
        }
    }
    public function render()
    {
        return view('livewire.cms.loan.business.loan-type.business-purchase-order');
    }

    public function store()
    {
      
       $this->validate([
           'amount' => 'required|integer|min:1',
        //    'documents' =>  $this->settlement_notice   ? '' : 'required',
        //    'settlement_notice' =>  $this->documents  ? '' : 'required',
       ],[
           'amount.integer'=>'Amount must be number',
        //    'documents.required'=>'The documents is required.',
        //    'settlement_notice.required'=>'The settlement notice  is required.',
       ]);
       $data = [
             ['type' => 'checkbox', 'value' => $this->notified, 'key' => 'notified'], 
             ['type' => 'checkbox', 'value' => $this->unnotified, 'key' => 'unnotified'], 
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
            // if($item['type'] == 'file'){
            //     $LGI->value = isset($item['value']) && \File::extension($item['value']) == 'tmp' ? $item['value']->store('documents') : $item['value'];
            // }
            // else{
                $LGI->value = isset($item['value']) ? $item['value'] : '';
            // }
            $LGI->save();
       }
       $this->gernalInfo = LoanGernalInfo::where('apply_loan_id', $this->apply_loan->id)->get();
       $this->emit('changeTab',$this->apply_loan->id, 4);
    }
}
