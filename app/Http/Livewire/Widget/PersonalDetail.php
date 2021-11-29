<?php

namespace App\Http\Livewire\Widget;

use App\Http\Controllers\CommonController;
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
    public $customValidation;
    public $employee_type = "self_employee";
    public function mount()
    {
        $this->getData();
       $personalDetail = ModelsPersonalDetail::where('apply_loan_id', $this->apply_loan->id)->first();
       $this->income_proof = $personalDetail->income_proof  ?? '';
       $this->relation = $personalDetail->relation  ?? '';
       $this->employee_type = $personalDetail->employee_type  ?? 'self_employee';
    }
    public function render()
    {
        return view('livewire.widget.personal-detail');
    }

    public function store()
    {
        // $this->customValidation = '';
        $this->customValidation['personal_document_nric_front'] = '';
        $this->customValidation['personal_document_nric_back'] = '';
        $this->customValidation['personal_document_passport_or_identity_card'] = '';
        $this->customValidation['personal_document_pay_slip'] = '';
        $this->customValidation['personal_document_notice_assessment'] = '';
        $this->customValidation['personal_document_personal_noa_latest'] = '';
        $this->customValidation['personal_document_personal_noa_older'] = '';
        $this->customValidation['personal_document_cpf_contribution_history'] = '';
        $this->customValidation['bill'] = '';
        $personal_document_nric_front = CommonController::vali('App\Models\PersonalDetail', 'personal_document_nric_front', $this->apply_loan->id, 0);
        $personal_document_nric_back = CommonController::vali('App\Models\PersonalDetail', 'personal_document_nric_back', $this->apply_loan->id, 0);
        $personal_document_passport_or_identity_card = CommonController::vali('App\Models\PersonalDetail', 'personal_document_passport_or_identity_card', $this->apply_loan->id, 0);
        $nao_latest = CommonController::vali('App\Models\PersonalDetail', 'personal_document_personal_noa_latest', $this->apply_loan->id, 0);
        $nao_older = CommonController::vali('App\Models\PersonalDetail', 'personal_document_personal_noa_older', $this->apply_loan->id, 0);
        $cpf_contribution_history = CommonController::vali('App\Models\PersonalDetail', 'personal_document_cpf_contribution_history', $this->apply_loan->id, 0);
        $notice_accessment = CommonController::vali('App\Models\PersonalDetail', 'personal_document_notice_assessment', $this->apply_loan->id, 0);
        $payslip = CommonController::vali('App\Models\PersonalDetail', 'personal_document_pay_slip', $this->apply_loan->id, 0);
        
        
        
        if(!$payslip && $this->employee_type == "for_employee"){
            
            $this->customValidation['personal_document_pay_slip'] = "Pay slip is required";
        }

        if(!$notice_accessment && $this->employee_type == "for_employee"){

            $this->customValidation['personal_document_notice_assessment'] = "Notice accessment is required";
        }

        if(!$cpf_contribution_history && $this->employee_type == "for_employee"){
            $this->customValidation['personal_document_cpf_contribution_history'] = "CPF contribution history is required";
        }

        if(!$nao_latest && $this->employee_type == "self_employee"){

            $this->customValidation['personal_document_personal_noa_latest'] = "NOA latest is required";

        }

        if(!$nao_older && $this->employee_type == "self_employee"){
            
            $this->customValidation['personal_document_personal_noa_older'] = "NOA old is required";

        }
        if(!$personal_document_passport_or_identity_card && !$personal_document_nric_front){
            
            $this->customValidation['personal_document_nric_front'] = "NRIC front is required";

        }

        if(!$personal_document_passport_or_identity_card && !$personal_document_nric_back){
            $this->customValidation['personal_document_nric_back'] = "NRIC back is required";
        }
        
        if((!$personal_document_nric_front && !$personal_document_nric_back) && !$personal_document_passport_or_identity_card){

            $this->customValidation['personal_document_passport_or_identity_card'] = "Passport  is required";
        }
      
        if(array_filter($this->customValidation)){
           
            return;
        }
        $passportImage = Media::where('model','App\Models\PersonalDetail')
        ->where('key', 'personal_document_passport_or_identity_card')
        ->where('apply_loan_id', $this->apply_loan->id)
        ->first();

        $proof_of_address = Media::where('model','App\Models\PersonalDetail')
        ->where('key', 'personal_document_proof_of_address')
        ->where('apply_loan_id', $this->apply_loan->id)
        ->first();

        $personal_document_employement_pass_front = Media::where('model','App\Models\PersonalDetail')
        ->where('key', 'personal_document_employement_pass_front')
        ->where('apply_loan_id', $this->apply_loan->id)
        ->first();

        $personal_document_employement_pass_front = Media::where('model','App\Models\PersonalDetail')
        ->where('key', 'personal_document_employement_pass_back')
        ->where('apply_loan_id', $this->apply_loan->id)
        ->first();
       
        if($passportImage && !$proof_of_address && !$personal_document_employement_pass_front && !$personal_document_employement_pass_front){
            $this->customValidation = [
                'bill' => 'Proof of address & employment pass is required',
            ];
            return;
        }
        $personalDetail=ModelsPersonalDetail::where('apply_loan_id', $this->apply_loan->id)->get();
        if($personalDetail->count() > 0){
           
            $this->validate([
                'income_proof' => 'required',
                'relation' => 'required',
            ]);
            $PD = ModelsPersonalDetail::forceCreate([
                'apply_loan_id' => $this->apply_loan->id,
                'type' => 'Joint Applicant',
                'income_proof' => $this->income_proof,
                'relation' => $this->relation,
                'employee_type' => $this->employee_type
            ]);
            $this->income_proof = '';
            $this->relation = '';
        }else{

            $PD = ModelsPersonalDetail::forceCreate([
                'apply_loan_id' => $this->apply_loan->id,
                'type' => 'Applicant',
                'employee_type' => $this->employee_type,
            ]);   
       }
    //    $this->emit('changeTab',$this->apply_loan->id, 4);
       Media::where('model', 'App\Models\PersonalDetail')
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

    public function goTolender()
    {
        $this->store();
    }

    public function deleteRecord(ModelsPersonalDetail $PersonalDetail)
    {
        $PersonalDetail->delete();
      
        $this->getData();
    }
}