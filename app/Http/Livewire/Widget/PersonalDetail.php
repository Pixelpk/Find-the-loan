<?php

namespace App\Http\Livewire\Widget;

use App\Models\Media;
use App\Models\PersonalDetail as ModelsPersonalDetail;
use Livewire\Component;
use Livewire\WithFileUploads;
class PersonalDetail extends Component
{
    use WithFileUploads;
    public $main_type;
    public $loan_type_id;
    public $apply_loan;
    public $personalDetail = [];
    public $income_proof;
    public $relation;
 
    public function mount()
    {
        
    }
    public function render()
    {
        return view('livewire.widget.personal-detail');
    }

    public function store()
    {

       $personalDetail=ModelsPersonalDetail::where('apply_loan_id', $this->apply_loan->id)->get();
       if($personalDetail->count() > 0){
            $PD = PersonalDetail::forceCreate([
                'apply_loan_id' => $this->apply_loan->id,
                'type' => 'Joint Applicant',
                'income_proof' => $this->income_proof,
                'relation' => $this->relation
            ]);
       }else{

            $PD = ModelsPersonalDetail::forceCreate([
                'apply_loan_id' => $this->apply_loan->id,
                'type' => 'Applicant',
            ]);   
       }
    //    $this->emit('changeTab',$this->apply_loan->id, 4);
       Media::where('model', '\App\Models\PersonalDetail')
    //    ->where('key', 'over_draft_benifit_illustration')
       ->where('share_holder', 0)
       ->where('model_id', 0)
       ->update([
           'model_id' => $PD->id,
       ]);
       $this->emit('getImage');       
       $this->getData();
    }

    public function getData(){
        $this->personalDetail = ModelsPersonalDetail::where('apply_loan_id', $this->apply_loan->id)->get();
    }

    public function deleteRecord(ModelsPersonalDetail $PersonalDetail)
    {
        $PersonalDetail->delete();
      
        $this->getData();
    }
}
