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
    public $vali;
 
    protected $listeners = [
        'documentReq'
    ];

    public function documentReq($value)
    {
        // dd($value);
        // $this->vali['personal_document_nric_front'] = $value;
        // $this->vali['personal_document_nric_back'] = $value;
        // $this->vali['personal_document_passport_or_identity_card'] = $value;
    }

    protected $rules = [
        'vali.personal_document_nric_front' =>  'required_without:vali.personal_document_passport_or_identity_card',
        'vali.personal_document_nric_back' =>'required_without:vali.personal_document_passport_or_identity_card',
        'vali.personal_document_passport_or_identity_card' => 'required_without:vali.personal_document_passport_or_identity_card,personal_document_passport_or_identity_card',
        'vali.personal_document_personal_noa_latest' => 'required',
        'vali.personal_document_personal_noa_older' => 'required',
        'vali.personal_document_cpf_contribution_history' => 'required',
        'vali.personal_document_notice_assessment' => 'required',
        'vali.personal_document_pay_slip' => 'required',
        'vali.personal_document_birth_certificate' => 'required',
    ];

    public function mount()
    {
        
    }
    public function render()
    {
        return view('livewire.widget.personal-detail');
    }

    public function store()
    {
        $this->validate($this->rules, [
            'vali.personal_document_nric_front.required_without' => 'NRIC front is required',
            'vali.personal_document_nric_back.required_without' => 'NRIC back is required',
            'vali.personal_document_passport_or_identity_card.required_without' => 'Passport is required',
        ]);
        $passportImage = Media::where('model','App\Models\PersonalDetail')
        ->where('key', 'personal_document_passport_or_identity_card')
        ->where('apply_loan_id', $this->apply_loan->id)
        ->first();
        if($passportImage){
            $this->customValidation = [
                'bill' => 'Proof of address & employment pass is required',
            ];
            return;
        }
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
