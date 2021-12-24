<?php

namespace App\Http\Livewire\Cms;

use App\Models\ApplyLoan as ModelsApplyLoan;
use App\Models\CompanyStructure;

use App\Models\LoanCompanyDetail;
use App\Models\LoanDocument;
use App\Models\LoanPersonShareHolder;
use App\Models\LoanReason;
use App\Models\LoanStatement;
use App\Models\LoanType;
use App\Models\MainType;
use App\Models\Sector;
use App\Models\ShareHolderDetail;
use App\Models\UserLoanReason;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\LoanGernalInfo;
use App\Models\LoanLender;
use App\Models\LoanLenderDetail;
use App\Models\Media;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Config;

use File;
class ApplyLoan extends Component
{
    use WithFileUploads;
    public $images=[];
    public $lenderflag;
    public $gernal;
    public $main_type;
    public $mainTypes;
    public $comDisable;
    public $shareholderCompany;
    public $documentDisable;
    public $shareDisable;
    public $loan_type_id;
    public $loanReasons = [];
    public $saveCompanyDetail;
    public $reasonDisable;
    public $values = [];
    public $reasonValue = [];
    public $amount;
    public $tab = '1';
    public $all_share_holder;

    public $listed_company_check = 0;





    public $apply_loan;
    public $statement;
    public $latest_year;
    public $year_before;
    public $profitable_latest_year;
    public $profitable_before_year;
    public $current_year;
    // public $optional_revenuee;
    public $errorMessage;
    public $photo;
    public $errorArray = [];
    public $draft;
    protected $queryString = ['draft'];

    public $nric_front;
    public $nric_back;
    public $passport;
    public $nao_latest;
    public $nao_older;
    public $not_proof;
    public $subtab = '1';

    public $country;

    public $subsidiary;
    public $get_share_holder_type = [];

    public $share_holder_optional_revenuee;
    public $getNumberOfCompanyYears;
    public $reason_id;
    public $checkShareHolder;


    public $lender = [];

    public $financial_institute = false;
    public $cbs_member = false;
    public $cbs_member_image;
    public $enable;
    public $share_holder;
    ////
    public $gernalinfo;

    public $hideTabs = false;
    protected $listeners = [
        'changeTab', 'hideTabs'
    ];

    public function hideTabs($value)
    {
        if($value == true){
            $this->hideTabs = true;
        }
    }

    public function changeTab(ModelsApplyLoan $apply_loan, $id)
    {
        $this->apply_loan = $apply_loan;
        $this->comDisable = true;
        $this->tab = $id;
        if($this->tab == 4)
        {
            $this->enable['companyDetail'] = true;
        }

        if($this->tab == 5)
        {
            $this->enable['companyDocuments'] = true;
        }

        if($this->tab == 7)
        {
            $this->enable['companyShareHolder'] = true;
        }

        if($this->tab == 9)
        {
            $this->enable['lender'] = true;
        }

    }
    public function mount()
    {

        $this->share_holder = 0;
        $this->mainTypes = [];
        $this->loanReasons = [];
        if($this->draft)
        {
            $this->apply_loan = ModelsApplyLoan::find($this->draft);
            $this->main_type = $this->apply_loan->profile;
            $this->getMainType();
            $this->values[$this->apply_loan->loan_type_id] = $this->apply_loan->loan_type_id;
            // array_push($this->values[0], $this->apply_loan->loan_type_id);
            // dd($this->values);
            // $this->values[$this->apply_loan->loan_type_id] = $this->apply_loan->loan_type_id;
            $this->getLoanReason($this->apply_loan->loan_type_id);
            $this->pushReason($this->apply_loan->reason_id);

        }
    }

    public function pushReason($id)
    {
        $this->reasonValue = [];
        $this->reason_id = $id;
        $this->reasonValue[$id] = $id;
        // if($this->reasonValue[$id]){
        //     $this->reasonValue = [];
        //     $this->reasonValue[$id] = $id;
        //     $this->apply_loan->reason_id = $id;
        //     if($this->reasonValue[$id] == true){
        //        $this->apply_loan->update();
        //     //    $this->tab = 4;
        //        $this->comDisable = true;
        //     }else{
        //         return;
        //     }
        // }else{

        // }

    }
    public function getLoanReason($loan_type_id)
    {
        if(!$this->values[$loan_type_id]){
            $this->values[$loan_type_id] =  true;
        }
        $this->reasonValue = [];
        if(!$this->values[$loan_type_id]){
            return;
        }
        $this->errorMessage = '';
        $test = $this->values[$loan_type_id];
        $this->values = [];
        if($test){
            $this->loan_type_id = $loan_type_id;
            $this->values = [$loan_type_id => true];

        }else{
            $this->loan_type_id = null;
        }
        if($this->main_type == 1){
            $this->loanReasons = LoanReason::where('profile', $this->main_type)->where('status', 1)->get();
        }else{
            $this->loanReasons = LoanReason::where('profile', $this->main_type)->where('loan_type_id', $this->loan_type_id)->where('status', 1)->get();
        }

        // dd($this->values);

        // $this->goToReasons();
    }

    public function storeReasonLoanType()
    {
        // dd($this->values);
        $consumerarray = [20,21,22,23,24];
        if (in_array($this->loan_type_id, $consumerarray)) {
            if($this->apply_loan){
                $this->apply_loan->profile = $this->main_type;
                $this->apply_loan->loan_type_id = $this->loan_type_id;
                $this->apply_loan->reason_id = 0;
                $this->apply_loan->update();
             }
             else{
                 $this->apply_loan= ModelsApplyLoan::forceCreate([
                     'profile' =>  $this->main_type,
                     'user_id' => Auth::user()->id,
                     'loan_type_id' =>  $this->loan_type_id,
                     'reason_id' =>  0,
                 ]);
                 $this->apply_loan->enquiry_id = date('Y').date('m').$this->apply_loan->id;
                 $this->apply_loan->update();
             }
             $this->tab = 8;
             return;
        }
        if(sizeof($this->reasonValue) == 0 || sizeof($this->values) == 0){
            $this->emit('danger', ['type' => 'success', 'message' => 'Loan reason required.']);
            return;
        }
        foreach($this->reasonValue as $item){
            $reason = $item;
        }

        if($this->apply_loan){
            $this->apply_loan->profile = $this->main_type;
            $this->apply_loan->loan_type_id = $this->loan_type_id;
            $this->apply_loan->reason_id = $reason;
            $this->apply_loan->update();
         }
         else{
             $this->apply_loan= ModelsApplyLoan::forceCreate([
                 'profile' =>  $this->main_type,
                 'user_id' => Auth::user()->id,
                 'loan_type_id' =>  $this->loan_type_id,
                 'reason_id' =>  $reason,
             ]);
             $this->apply_loan->enquiry_id = date('Y').date('m').$this->apply_loan->id;
             $this->apply_loan->update();
         }
         $this->tab = 8;
    }

    public function render()
    {
        return view('livewire.cms.apply-loan')->layout('cms.layouts.master');
    }

    public function getMainType()
    {

        $this->reasonValue = [];
        $this->loan_type_id = '';
        $this->loanReasons = [];
        $this->mainTypes = MainType::where('profile_id', $this->main_type)->get();
    }
    public function goToReasons()
    {
        $this->errorMessage = '';
        $this->loanReasons = LoanReason::where('profile', $this->main_type)->where('status', 1)->get();
        $this->tab = 2;
    }



    public function storeReason()
    {
        if($this->apply_loan)
        {
            UserLoanReason::where('apply_loan_id', $this->apply_loan->id)->delete();
            foreach($this->reasonValue as $key => $item)
            {
                if($item){
                    UserLoanReason::forceCreate([
                        'apply_loan_id' => $this->apply_loan->id,
                        'loan_reason_id' => $key,
                        'loan_type_id' => $this->loan_type_id,
                    ]);
                }
            }
        }
        if(sizeof($this->reasonValue) == 0){
            session()->flash('gernalMessage', 'Please select loan reasons');
            return;
        }
        foreach($this->reasonValue as $item)
        {
            if($item){
                $this->tab = 3;
                // $this->emit('alert', ['type' => 'success', 'message' => 'Loan Reason selected.']);
                return;
            }else{
                session()->flash('gernalMessage', 'Please select loan reasons');
                return;
            }

        }

    }

    public function companyDetail()
    {

        if(!$this->amount){
           session()->flash('sessionMessage', 'Please select amnount');
            return;
        }

        if($this->apply_loan){
            $this->apply_loan->amount = $this->amount;
            $this->apply_loan->loan_type_id = $this->loan_type_id;
            $this->apply_loan->update();

        }
        foreach($this->reasonValue as $item)
        {
            if($item){
                $this->errorMessage = '';
                // $this->emit('alert', ['type' => 'success', 'message' => 'Amount added.']);
                $this->tab = 4;
                return;
            }
        }

    }




    // public function share_holder_detail()
    // {
    //     $this->get_share_holder_type = [];
    //     if(!isset($this->all_share_holder)){
    //         $this->errorMessage  = 'Share holder type required';
    //         return;
    //     }
    //     if(sizeof($this->all_share_holder) == $this->apply_loan->parentCompany->number_of_share_holder){
    //         ShareHolderDetail::where('apply_loan_id', $this->apply_loan->id)->delete();
    //         foreach($this->all_share_holder as $item)
    //         {

    //             $data = ShareHolderDetail::forceCreate([
    //                 'apply_loan_id' => $this->apply_loan->id,
    //                 'share_holder_type' => $item
    //             ]);
    //             $this->get_share_holder_type[] = $data;
    //         }
    //         $this->errorMessage = '';
    //         $this->tab = 7;
    //     }else{
    //         $this->errorMessage  = 'Share holder type required';
    //         return;
    //     }
    // }




    ///////gernalinfo
    public function store()
    {
        // dd('asda');
        // dd(Config::get("gernalinfo.".$this->loan_type_id));
        foreach(Config::get("gernalinfo.".$this->loan_type_id)  as $key => $item){
            $this->validate([
                'gernalinfo.'.$item['key'] =>  $item['required'].$item['regax'].$item['image_formart'],
            ]);
        }
        if(!$this->reason_id){
            $this->errorMessage = 'Select Reason';
            return;
        }
        if($this->apply_loan){
            $this->updateGernalInfo();
            return;
        }
        $AL=ModelsApplyLoan::forceCreate([
            'amount' => $this->gernalinfo['amount'],
            'loan_type_id' => $this->loan_type_id,
            'reason_id' => $this->reason_id,
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


        // $this->goToReasons();
        $this->tab = 4;
        $this->comDisable = true;

    }

    public function updateGernalInfo()
    {

        $udpateapply_loan  = ModelsApplyLoan::where('id', $this->apply_loan->id)->first();
        $udpateapply_loan->profile = $this->main_type;
        $udpateapply_loan->reason_id = $this->reason_id;
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

        $this->tab = 4;

    }









    public function getMap()
    {
        dd('asd');
    }




}
