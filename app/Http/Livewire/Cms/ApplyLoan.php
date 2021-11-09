<?php

namespace App\Http\Livewire\Cms;

use App\Models\ApplyLoan as ModelsApplyLoan;
use App\Models\CompanyStructure;
use App\Models\FinancePartner;
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
use Monarobase\CountryList\CountryListFacade;
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
    public $company_name;
    public $company_year;
    public $company_month;
    public $number_of_share_holder;
    public $company_structure_type_id;
    public $sector_id;
    public $company_structure_types;
    public $sectors;
    public $number_of_employees;
    public $revenue;
    public $website;
    public $listed_company_check = 0;
    public $percentage_shareholder;
    public $apply_loan;
    public $statement;
    public $latest_year;
    public $year_before;
    public $profitable_latest_year;
    public $profitable_before_year;
    public $current_year;
    public $optional_revenuee;
    public $errorMessage;
    public $photo;
    public $errorArray = [];
    public $get_share_holder_type = [];
    public $nric_front;
    public $nric_back;
    public $passport;
    public $nao_latest;
    public $nao_older;
    public $not_proof;
    public $subtab = '1';
    public $share_holder_company_name;
    public $share_holder_company_year;
    public $share_holder_company_years;
    public $share_holder_company_month;
    public $share_holder_company_months;
    public $share_holder_percentage_shareholder;
    public $share_holder_number_of_share_holder;
    public $share_holder_company_structure_type_id;
    public $share_holder_sector_id;
    public $share_holder_number_of_employees;
    public $share_holder_revenue;
    public $share_holder_website;
    public $share_holder_photo;
    public $share_errorArray = [];
    public $share_holder_statement;
    public $share_holder_latest_year;
    public $share_holder_year_before;
    public $share_holder_listed_company_check;
    public $share_holder_profitable_latest_year;
    public $share_holder_profitable_before_year;
    public $share_holder_current_year;
    public $share_holder_subsidiary;
    public $share_holder_country;
    public $country;
    public $countries;
    public $subsidiary;
    public $company_years;
    public $company_months;
    public $share_holder_optional_revenuee;
    public $getNumberOfCompanyYears;
    public $reason_id;
    public $checkShareHolder;
    public $chklsit=[];
    public $financePartners = [];
    public $lender = [];
    public $checkSelect= [];
    public $financial_institute = false;
    public $cbs_member = false;
    public $cbs_member_image;
   
    ////
    public $gernalinfo;
    protected $listeners = [
        'changeTab'
    ];
    public function changeTab(ModelsApplyLoan $apply_loan, $id)
    {
        $this->apply_loan = $apply_loan;
        $this->comDisable = true;
       
        $this->tab = $id;
        
    }
    public function mount()
    {
        
        // dd($this->financePartners);
        $this->mainTypes = [];
        $this->loanReasons = [];
        // $this->reasonValue = [];
        $this->company_structure_types = CompanyStructure::where('status', 1)->get();
        $this->sectors = Sector::where('status', 1)->get();
        $this->countries = CountryListFacade::getList('en');
        // $this->get_share_holder_type = ShareHolderDetail::where('apply_loan_id', 2)->get();
    }
    public function Selectall($id)
    {
        if($this->cbs_member_image){
            $FP= FinancePartner::where('type', $id)
            ->where('cbs_member', 1)
            ->where('loan_type_id', $this->loan_type_id)
            ->get();
        }else{
            $FP= FinancePartner::where('type', $id)
            ->where('loan_type_id', $this->loan_type_id)
            ->get();
        }
        
        if($this->checkSelect[$id]){
            foreach($FP as $key => $item){
                $key = $item['id'];
                $this->lender[$key] = true;
            }
        }
        else{
            foreach($FP as $key => $item){
                $key = $item['id'];
                $this->lender[$key] = false;
            }
        }
       
        // dd($this->lender);
        // dd($this->lender[13]);
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
    public function getLoanReason($loan_type_id, $key)
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
         }
         $this->tab = 8;
    }
   
    public function getShareholderTypeId($id)
    {
        // $this->dispatchBrowserEvent('name-updated', ['newName' => 'All shareholder will be deleted if you update']);
        if($this->checkShareHolder[$id]){
            $LPSH=LoanPersonShareHolder::where('share_holder_detail_id', $id)->Where('apply_loan_id', $this->apply_loan->id)->first();
            if($LPSH){
                if($LPSH && Storage::exists($LPSH->nric_front)) {
                    Storage::delete($LPSH->nric_front);
                }
                if($LPSH && Storage::exists($LPSH->nric_back)) {
                    Storage::delete($LPSH->nric_back);
                }
                if($LPSH && Storage::exists($LPSH->nao_latest)) {
                    Storage::delete($LPSH->nao_latest);
                }
                if($LPSH && Storage::exists($LPSH->nao_older)) {
                    Storage::delete($LPSH->nao_older);
                }
                if($LPSH && Storage::exists($LPSH->passport)) {
                    Storage::delete($LPSH->passport);
                }
                $LPSH->delete();
            }
        }
        if(!$this->checkShareHolder[$id]){
            $LD = LoanDocument::where('share_holder', $id)->where('apply_loan_id', $this->apply_loan->id)->first();
            $LS = LoanStatement::where('share_holder', $id)->where('apply_loan_id', $this->apply_loan->id)->get();
            if($LS->count() > 0){
                foreach($LS as $LSDetail){
                    if(Storage::exists($LSDetail->statement)) {
                        Storage::delete($LSDetail->statement);
                    }
                }
                LoanStatement::where('share_holder', $id)->where('apply_loan_id', $this->apply_loan->id)->delete();
            }
            if($LD){
                if(Storage::exists($LD->statement)) {
                    Storage::delete($LD->statement);
                }
                if(Storage::exists($LD->latest_year)) {
                    Storage::delete($LD->latest_year);
                }
                if(Storage::exists($LD->year_before)) {
                    Storage::delete($LD->year_before);
                }
                if(Storage::exists($LD->current_year)) {
                    Storage::delete($LD->current_year);
                }
              
                $LD->delete();
            }
        }
        if($this->checkShareHolder[$id]){
            $shareholder = ShareHolderDetail::where('id', $id)->first();
            $shareholder->share_holder_type = 2;
            $shareholder->update();
        }else{
            $shareholder = ShareHolderDetail::where('id', $id)->first();
            $shareholder->share_holder_type = 1;
            $shareholder->update();
        }
        $this->get_share_holder_type = ShareHolderDetail::where('apply_loan_id', $this->apply_loan->id)->get();
        // dd($this->chklsit);
       
        // if($this->checkShareHolder[$id] == 1){

            if(sizeof($this->get_share_holder_type) > 0){
               
                foreach($this->get_share_holder_type as $key => $item){
                   
                    // if($id != $item->id){
                        // dd($key);
                        $this->chklsit[$item->id] = false;
                    // }
                }
                // dd($this->chklsit);
            }
           
            // dd($this->chklsit);
            
            
        // }
        
        // dd($this->checkShareHolder);
        // dd($id);
    }
    public function  resetComapny()
    {
        if($this->company_year > 31 || strlen($this->company_year) > 3){
            $this->company_year = '';
        }
        $this->company_month = ltrim($this->company_month, '0');
        if($this->company_month > 11){
            $this->company_month = '';
            $this->company_months = '';
        }
        if($this->company_year){
            $this->company_years =  date('Y') - $this->company_year;
        }
        if($this->company_month){
            $this->company_months =   $this->company_month;
        }
    }
    public function  shareHolderResetComapny($shreholder)
    {
        $this->share_holder_company_years[$shreholder] = '';
        $this->share_holder_company_months[$shreholder] = '';
    }
    public function saveCompanyDocuments()
    {
        
        $loanStatement = Media::where('model', '\App\Models\LoanStatement')
        ->where('share_holder', 0)
        ->where('apply_loan_id', $this->apply_loan->id)
        ->get()
        ->groupBy('key');
        if($loanStatement->count() < 6 && $loanStatement->count() > 1){
           
             $this->emit('danger', ['type' => 'success', 'message' => 'Bank Statement Month Wise Or Consolidated Statement Required.']);
            return;
        }
        $this->validate([
            'profitable_latest_year' => 'required',
            'profitable_before_year' => 'required',
        ]);
      
        $loanComanyDetaol = LoanCompanyDetail::where('apply_loan_id', $this->apply_loan->id)->where('share_holder', 0 )->first();
        $loanComanyDetaol->profitable_latest_year  = $this->profitable_latest_year;
        $loanComanyDetaol->profitable_before_year  = $this->profitable_before_year;
        $loanComanyDetaol->optional_revenuee  = $this->optional_revenuee;
        $loanComanyDetaol->update();

        $this->emit('alert', ['type' => 'success', 'message' => 'Company documents added successfully.']);
        if($this->apply_loan->parentCompany && (int)$this->apply_loan->parentCompany->number_of_share_holder){
            $this->tab = 7;
            $this->shareDisable = true;
        }else{
            $this->tab = 9;
            $this->lenderflag = true;
        }
    }
    public function render()
    {
        return view('livewire.cms.apply-loan')->layout('cms.layouts.master');
    }

    public function getMainType()
    {
        $this->reasonValue = [];
        $this->mainTypes = MainType::where('profile_id', $this->main_type)->get();
       
    }

    

    public function goToReasons()
    {
        $this->errorMessage = '';
        $this->loanReasons = LoanReason::where('profile', $this->main_type)->where('status', 1)->get();
        $this->tab = 2;
    }
    
    public function get_company_listed($id)
    {
        if($this->share_holder_listed_company_check[$id]){
            $this->chklsit[$id] = true;
        }else{
            $this->chklsit[$id] = false;
        }
        // dd($this->chklsit[$id]);
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
    public function shareholderDelete()
    {
        $SHD = ShareHolderDetail::where('apply_loan_id', $this->apply_loan->id)->get();
        foreach($SHD as $item)
        {
            $LPSH = LoanPersonShareHolder::where('share_holder_detail_id', $item->id)->where('apply_loan_id', $this->apply_loan->id)->first();
            $LD = LoanDocument::where('share_holder', $item->id)->where('apply_loan_id', $this->apply_loan->id)->first();
            $LS = LoanStatement::where('share_holder', $item->id)->where('apply_loan_id', $this->apply_loan->id)->get();
            if($LS->count() > 0){
                foreach($LS as $LSDetail){
                    if(Storage::exists($LSDetail->statement)) {
                        Storage::delete($LSDetail->statement);
                    }
                }
                LoanStatement::where('share_holder', $item->id)->where('apply_loan_id', $this->apply_loan->id)->delete();
            }
            if($LD){
                if(Storage::exists($LD->statement)) {
                    Storage::delete($LD->statement);
                }
                if(Storage::exists($LD->latest_year)) {
                    Storage::delete($LD->latest_year);
                }
                if(Storage::exists($LD->year_before)) {
                    Storage::delete($LD->year_before);
                }
                if(Storage::exists($LD->current_year)) {
                    Storage::delete($LD->current_year);
                }
              
                $LD->delete();
            }
            if($LPSH){
                if(Storage::exists($LPSH->nric_front)) {
                    Storage::delete($LPSH->nric_front);
                }
                if(Storage::exists($LPSH->nric_back)) {
                    Storage::delete($LPSH->nric_back);
                }
                if(Storage::exists($LPSH->nao_latest)) {
                    Storage::delete($LPSH->nao_latest);
                }
                if(Storage::exists($LPSH->nao_older)) {
                    Storage::delete($LPSH->nao_older);
                }
                if(Storage::exists($LPSH->passport)) {
                    Storage::delete($LPSH->passport);
                }
                $LPSH->delete();
            }
        }
        ShareHolderDetail::where('apply_loan_id', $this->apply_loan->id)->delete();
        $this->get_share_holder_type = [];
        if($this->company_year && $this->company_month)
        {
            $company_start_date = $this->company_year.'/'.$this->company_month;
        }
        else
        {
            $then_ts = strtotime("$this->company_years-01-01");
            $then_year = date('Y', $then_ts);
            $diff = date('Y') - $then_year;
            if(strtotime('+' . $diff . ' years', $then_ts) > time()) $diff--;
            $company_start_date = $diff.'/'.$this->company_months;
           
        }
        $ParentCompany = LoanCompanyDetail::where('apply_loan_id', $this->apply_loan->id)->where('share_holder', 0)->first();
        $ParentCompany->company_start_date = $company_start_date;
        $ParentCompany->revenue = $this->revenue;
        $ParentCompany->listed_company_check = $this->listed_company_check;
        $ParentCompany->number_of_share_holder = $this->number_of_share_holder;
        $ParentCompany->sector_id = $this->sector_id;
        $ParentCompany->percentage_shareholder = $this->percentage_shareholder;
        $ParentCompany->company_structure_type_id = $this->company_structure_type_id;
        $ParentCompany->number_of_employees = $this->number_of_employees;
        $ParentCompany->company_name = $this->company_name;
        $ParentCompany->website = $this->website;
        $ParentCompany->update();
        $this->getNumberOfCompanyYears = current(explode("/",  $ParentCompany->company_start_date));
        if($ParentCompany->number_of_share_holder > 0){
            for($count = 1; $count <= $ParentCompany->number_of_share_holder; $count++){
                $this->get_share_holder_type[] =  ShareHolderDetail::forceCreate([
                    'apply_loan_id' => $this->apply_loan->id,
                    'share_holder_type' => 1,
                ]);
            }
        }
        $this->emit('alert', ['type' => 'success', 'message' => 'Company Detail has been updated.']);
        $this->tab = 5;
    }
    public function updateCompanyDetal()
    {
      
        $SHD = ShareHolderDetail::where('apply_loan_id', $this->apply_loan->id)->get();
        // dd($this->number_of_share_holder);
        if($SHD->count() != (int)$this->number_of_share_holder){
            $this->dispatchBrowserEvent('name-updated', ['newName' => 'All shareholder will be deleted if you update']);
            return;
        }else{
        if($this->company_year && $this->company_month){
            $company_start_date = $this->company_year.'/'.$this->company_month;
        }else{
            $then_ts = strtotime("$this->company_years-01-01");
            $then_year = date('Y', $then_ts);
            $diff = date('Y') - $then_year;
            if(strtotime('+' . $diff . ' years', $then_ts) > time()) $diff--;
            $company_start_date = $diff.'/'.$this->company_months;
           
        }
            $ParentCompany = LoanCompanyDetail::where('apply_loan_id', $this->apply_loan->id)->where('share_holder', 0)->first();
            $ParentCompany->company_start_date = $company_start_date;
            $ParentCompany->revenue = $this->revenue;
            $ParentCompany->listed_company_check = $this->listed_company_check;
            $ParentCompany->number_of_share_holder = $this->number_of_share_holder;
            $ParentCompany->sector_id = $this->sector_id;
            $ParentCompany->percentage_shareholder = $this->percentage_shareholder;
            $ParentCompany->company_structure_type_id = $this->company_structure_type_id;
            $ParentCompany->number_of_employees = $this->number_of_employees;
            $ParentCompany->company_name = $this->company_name;
            $ParentCompany->website = $this->website;
            $ParentCompany->update();
            $this->getNumberOfCompanyYears = current(explode("/",  $ParentCompany->company_start_date));
            $this->emit('alert', ['type' => 'success', 'message' => 'Company Detail has been updated.']);
            $this->tab = 5;
            $this->documentDisable = true;
        }
    }
    public function companyDetailStore()
    {
        
        if($this->listed_company_check){
            $this->validate([
                'subsidiary' => 'image|required',
                'company_name' => 'required',
                'country' => 'required'
            ]);
            $companyDetail = LoanCompanyDetail::where('share_holder', 0)->where('apply_loan_id', $this->apply_loan->id)->first();
            if($companyDetail && $companyDetail->listed_company_check == 0){
               
               $LD = LoanDocument::where('apply_loan_id', $this->apply_loan->id)->first();
               $LS = LoanStatement::where('apply_loan_id', $this->apply_loan->id)->get();
               if($LD){
                    if(Storage::exists($LD->statement)) {
                        Storage::delete($LD->statement);
                    }
                    if(Storage::exists($LD->latest_year)) {
                        Storage::delete($LD->latest_year);
                    }
                    if(Storage::exists($LD->year_before)) {
                        Storage::delete($LD->year_before);
                    }
                    if(Storage::exists($LD->current_year)) {
                        Storage::delete($LD->current_year);
                    }
                    $LD->delete();
               }
               if($LS->count() > 0){
                   foreach($LS as $item){
                        if(Storage::exists($item->statement)) {
                            Storage::delete($item->statement);
                        }  
                   }
                   LoanStatement::where('apply_loan_id', $this->apply_loan->id)->delete();
               }
               $SHCD = LoanCompanyDetail::where('share_holder', '!=', 0)->where('apply_loan_id', $this->apply_loan->id)->delete();

            }
            if($this->apply_loan && $companyDetail){
                
                $companyDetail->company_name = $this->company_name;
                $companyDetail->country = $this->country;
                $companyDetail->listed_company_check = $this->listed_company_check;
                if(Storage::exists($companyDetail->subsidiary)) {
                    Storage::delete($companyDetail->subsidiary);
                }
                $companyDetail->subsidiary = $this->subsidiary->store('documents');
                $companyDetail->update();
                $this->emit('alert', ['type' => 'success', 'message' => 'Company Detail has been udpate.']);
                // $companyDetail->subsidiary = $this->company_name;
            }
            else{
                LoanCompanyDetail::forceCreate([
                    'apply_loan_id' => $this->apply_loan->id,
                    'company_name' => $this->company_name,
                    "listed_company_check" => $this->listed_company_check,
                    'country' => $this->country,
                    'subsidiary' => $this->subsidiary->store('documents'),
                ]);
                $this->apply_loan = $this->apply_loan;
                $this->emit('alert', ['type' => 'success', 'message' => 'Company Detail has been saved.']);
            }
            $this->tab = 9;
            $this->lenderflag = true;
            return;
        }
        $this->validate([
            // 'amount' => 'required',
            // 'loan_type_id' => 'required',
            // 'reasons' => 'required',
            'company_name' => 'required',
            'company_year' =>  $this->company_months || $this->company_years ? '' : 'required|numeric|max:100|integer|gt:0',
            'company_month' =>  $this->company_months || $this->company_years ? '' : 'required|numeric|max:11|integer|gt:0',
            'company_years' =>  $this->company_months  ? 'required|integer|gt:0' : '',
            'company_months' =>  $this->company_years  ? 'required|integer|gt:0' : '',
            'number_of_share_holder' => 'numeric|max:10|integer|gt:-1',
            'sector_id' => 'required',
            'revenue' => 'required|integer|gt:0',
            'percentage_shareholder' => 'required|integer|gt:0',
            'company_structure_type_id' => 'required',
            'number_of_employees' => 'required|numeric|max:50000|integer|gt:0',
            'website' => 'nullable',

        ]);
        $LCD=LoanCompanyDetail::where('apply_loan_id', $this->apply_loan->id)->where('share_holder', 0)->first();
        if($LCD){
            $this->updateCompanyDetal();
            return;
        }
        if($this->company_year && $this->company_month){
            $company_start_date = $this->company_year.'/'.$this->company_month;
        }else{
            $then_ts = strtotime("$this->company_years-01-01");
            $then_year = date('Y', $then_ts);
            $diff = date('Y') - $then_year;
            if(strtotime('+' . $diff . ' years', $then_ts) > time()) $diff--;
            $company_start_date = $diff.'/'.$this->company_months;
        }
        // $revenue = $this->revenue_amount1.'.'.$this->revenue_amount2;
        // $company_start_date = $this->company_year.'/'.$this->company_month;
        $data = LoanCompanyDetail::forceCreate([
            'apply_loan_id' => $this->apply_loan->id,
            'company_start_date' => $company_start_date,
            'revenue' => $this->revenue,
            'number_of_share_holder' => $this->number_of_share_holder,
            'sector_id' => $this->sector_id,
            'listed_company_check' => $this->listed_company_check,
            'percentage_shareholder' => $this->percentage_shareholder,
            'company_structure_type_id' => $this->company_structure_type_id,
            'number_of_employees' => $this->number_of_employees,
            'company_name' => $this->company_name,
            'website' => $this->website,
        ]);
        if($data->number_of_share_holder > 0){
            for($count = 1; $count <= $data->number_of_share_holder; $count++){
                $this->get_share_holder_type[] =  ShareHolderDetail::forceCreate([
                    'apply_loan_id' => $this->apply_loan->id,
                    'share_holder_type' => 1,
                ]);
            }
        }
        $this->getNumberOfCompanyYears = current(explode("/", $data->company_start_date));
        $this->emit('alert', ['type' => 'success', 'message' => 'Company Detail has been saved.']);
        
            $this->tab = 5;
            $this->documentDisable = true;
        
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

    public function share_holder_document_store($id)
    {
       
        // foreach($this->get_share_holder_type as $item){
            // if($item['share_holder_type'] == 1){
                // dd($id);
                 $getsholder = ShareHolderDetail::where('id', $id)->first();
                //  dd( $getsholder);
                if($getsholder->share_holder_type == 1){
               
                    $this->validate([
                        "nric_front.$id" => isset($this->passport[$getsholder->id])  ? '' : 'image|required',
                        "nric_back.$id" => isset($this->passport[$getsholder->id])  ? '' : 'image|required',
                        "passport.$id" => isset($this->nric_front[$getsholder->id]) && isset($this->nric_back[$id]) ? '' : 'image|required',
                        "not_proof.$id" => isset($this->nao_latest[$getsholder->id]) && isset($this->nao_older[$id]) ? '' : 'required',
                        "nao_latest.$id" => isset($this->not_proof[$getsholder->id])  ? '' : 'image|required',
                        "nao_older.$id" => isset($this->not_proof[$getsholder->id])  ? '' : 'image|required',
                    ]);
                    // dd($this->passport[$getsholder->id]);
                    $LPSH = LoanPersonShareHolder::where('share_holder_detail_id',$getsholder->id)->where('apply_loan_id', $this->apply_loan->id)->first();
                    if($LPSH){
                        if($LPSH && Storage::exists($LPSH->nric_front)) {
                            Storage::delete($LPSH->nric_front);
                        }
                        if($LPSH && Storage::exists($LPSH->nric_back)) {
                            Storage::delete($LPSH->nric_back);
                        }
                        if($LPSH && Storage::exists($LPSH->nao_latest)) {
                            Storage::delete($LPSH->nao_latest);
                        }
                        if($LPSH && Storage::exists($LPSH->nao_older)) {
                            Storage::delete($LPSH->nao_older);
                        }
                        if($LPSH && Storage::exists($LPSH->passport)) {
                            Storage::delete($LPSH->passport);
                        }
                       
                        if($LPSH){
                            $LPSH->delete();
                        }
                    }
                    LoanPersonShareHolder::forceCreate([
                        'apply_loan_id' => $this->apply_loan->id,
                        'share_holder_detail_id' => $getsholder->id,
                        "nric_front" => isset($this->nric_front[$getsholder->id]) ?  $this->nric_front[$getsholder->id]->store('documents') : '',
                        "nric_back" => isset($this->nric_back[$getsholder->id]) ?  $this->nric_back[$getsholder->id]->store('documents') : '',
                        "passport" => isset($this->passport[$getsholder->id]) ?  $this->passport[$getsholder->id]->store('documents') : '',
                        "nao_latest" => isset($this->nao_latest[$getsholder->id]) ?  $this->nao_latest[$getsholder->id]->store('documents') : '',
                        "nao_older" => isset($this->nao_older[$getsholder->id]) ?  $this->nao_older[$getsholder->id]->store('documents') : '',
                        "not_proof" => isset($this->not_proof[$getsholder->id]) ?  $this->not_proof[$getsholder->id] : '',
                    ]);
                    $this->gernal['change_color'] = 'success';
                    $this->emit('alert', ['type' => 'success', 'message' => 'Shareholder person data saved.']);
                    $this->lenderflag = true;
                }
                if($getsholder->share_holder_type == 2)
                {
                    if(isset($this->share_holder_listed_company_check[$id]) && $this->share_holder_listed_company_check[$id]){
                        $this->validate([
                            "share_holder_company_name.$getsholder->id" => 'required',
                            "share_holder_country.$getsholder->id" => 'required',
                            "share_holder_subsidiary.$getsholder->id" => 'required|mimes:jpg,jpeg,png,pdf',
                           
                        ]);
                        $LCD = LoanCompanyDetail::where('share_holder',$getsholder->id)->where('apply_loan_id', $this->apply_loan->id)->first();
                        if($LCD){
                            $LCD->delete();
                        }
                        $LD = LoanDocument::where('apply_loan_id', $this->apply_loan->id)->where('share_holder', $getsholder->id)->first();
                        if($LD && Storage::exists($LD->statement)) {
                            Storage::delete($LD->statement);
                        }
                        if($LD && Storage::exists($LD->latest_year)) {
                            Storage::delete($LD->latest_year);
                        }
                        if($LD && Storage::exists($LD->year_before)) {
                            Storage::delete($LD->year_before);
                        }
                        if($LD && Storage::exists($LD->current_year)) {
                            Storage::delete($LD->current_year);
                        }
                        if($LD){
                            $LD->delete();
                        }
                        $LS = LoanStatement::where('apply_loan_id', $this->apply_loan->id)->where('share_holder', $getsholder->id)->get();
                        if($LS->count() > 0){
                            foreach($LS as $item){
                                if($item && Storage::exists($item->statement)) {
                                    Storage::delete($LD->statement);
                                }
                            }
                            LoanStatement::where('apply_loan_id', $this->apply_loan->id)->where('share_holder', $getsholder->id)->delete();
                        }
                      
                        LoanCompanyDetail::forceCreate([
                            "apply_loan_id" => $this->apply_loan->id,
                            "share_holder" => $getsholder->id,
                            "company_name" => $this->share_holder_company_name[$getsholder->id],
                            "country" => $this->share_holder_country[$getsholder->id],
                            "subsidiary" => $this->share_holder_subsidiary[$getsholder->id]->store('documents'),
                        ]);
                        $this->emit('alert', ['type' => 'success', 'message' => 'Shareholder company data saved.']);
                        $this->lenderflag = true;
                        // $this->subtab = '2';
                        return;
                       
                    }
                    
                    // dd('asd');
                    $this->validate([
                        "share_holder_company_name.$getsholder->id" => 'required',
                        "share_holder_company_year.$getsholder->id" => 'required',
                        "share_holder_company_month.$getsholder->id" => 'required',
                        "share_holder_number_of_share_holder.$getsholder->id" => 'required',
                        "share_holder_sector_id.$getsholder->id" => 'required',
                        "share_holder_revenue.$getsholder->id" => 'required',
                        "share_holder_percentage_shareholder.$getsholder->id" => 'required',
                        "share_holder_company_structure_type_id.$getsholder->id" => 'required',
                        "share_holder_number_of_employees.$getsholder->id" => 'required',
                        "share_holder_website.$getsholder->id" => 'nullable',
                    ]);
                    if($this->share_holder_company_year[$getsholder->id] && $this->share_holder_company_month[$getsholder->id]){
                        $company_start_date = $this->share_holder_company_year[$getsholder->id].'/'.$this->share_holder_company_month[$getsholder->id];
                    }else{
                        $then_ts = strtotime($this->share_holder_company_years[$getsholder->id]."-01-01");
                        $then_year = date('Y', $then_ts);
                        $diff = date('Y') - $then_year;
                        if(strtotime('+' . $diff . ' years', $then_ts) > time()) $diff--;
                        $company_start_date = $diff.'/'.$this->share_holder_company_months[$getsholder->id];
                       
                    }
                    $LCD = LoanCompanyDetail::where('share_holder',$getsholder->id)->where('apply_loan_id', $this->apply_loan->id)->first();
                    if($LCD){
                        $LCD->delete();
                    }
                    LoanCompanyDetail::forceCreate([
                        "apply_loan_id" => $this->apply_loan->id,
                        "share_holder" => $getsholder->id,
                        "listed_company_check" => $this->listed_company_check,
                        // "company_start_date" =>  $this->share_holder_company_year[$getsholder->id].'/'.$this->share_holder_company_month[$getsholder->id],
                        "company_start_date" =>  $company_start_date,
                        "revenue" => $this->share_holder_revenue[$getsholder->id],
                        "number_of_share_holder" => $this->share_holder_number_of_share_holder[$getsholder->id],
                        "sector_id" => $this->share_holder_sector_id[$getsholder->id],
                        "percentage_shareholder" => $this->share_holder_percentage_shareholder[$getsholder->id],
                        "company_structure_type_id" => $this->share_holder_company_structure_type_id[$getsholder->id],
                        "number_of_employees" => $this->share_holder_number_of_employees[$getsholder->id],
                        "company_name" => $this->share_holder_company_name[$getsholder->id],
                        "website" => isset($this->share_holder_website[$getsholder->id]) ? $this->share_holder_website[$getsholder->id] : '',
                    ]);
                    $this->emit('alert', ['type' => 'success', 'message' => 'Shareholder company data saved.']);
                    $this->lenderflag = true;
                    $this->subtab = '2';
                }
                $this->lenderflag = true;
                $this->shareholderCompany = true;
    }

    public function company_share_holder_documents_store($id)
    {
        $getsholder = ShareHolderDetail::where('id', $id)->first();
        if($getsholder->share_holder_type == 2){
            $this->share_errorArray = [];
            if(!isset($this->share_holder_statement[$getsholder->id])){
                for ($x = 2; $x <= 7; $x++){
                    $montn = date("M", strtotime( date( 'Y-m-01' )." -$x months"));
                    if(isset($this->share_holder_photo[$getsholder->id][$montn])){
                        if($montn == $this->share_holder_photo[$getsholder->id][$montn]){
                        }
                    }
                    else{
                        array_push($this->share_errorArray, $montn);
                    }
                }
            }
            if(sizeof($this->share_errorArray) > 0){
                return;
            }
            $this->validate([
                "share_holder_statement.$getsholder->id" => isset($this->share_holder_photo[$getsholder->id])  > 0 ? '' : 'image|required',
                // "share_holder_statement.$getsholder->id" => 'image|required',
                "share_holder_latest_year.$getsholder->id" => 'image|required',
                "share_holder_year_before.$getsholder->id" => $this->share_holder_company_year[$getsholder->id] >= 3 ?  'image|required' : '',
                "share_holder_profitable_latest_year.$getsholder->id" => 'required',
                "share_holder_profitable_before_year.$getsholder->id" => 'required',
                // 'current_year' => 'image',
            ]);
            $loanComanyDetaol = LoanCompanyDetail::where('apply_loan_id', $this->apply_loan->id)
            ->where('share_holder',$getsholder->id)
            ->first();
            // dd($this->share_holder_profitable_latest_year[$getsholder->id]);
            $loanComanyDetaol->profitable_latest_year  = $this->share_holder_profitable_latest_year[$getsholder->id];
            $loanComanyDetaol->profitable_before_year  = $this->share_holder_profitable_before_year[$getsholder->id];
            $loanComanyDetaol->optional_revenuee  = isset($this->share_holder_optional_revenuee[$getsholder->id]) ?  $this->share_holder_optional_revenuee[$getsholder->id] : '';
            $loanComanyDetaol->update();
            $LD = LoanDocument::where('apply_loan_id', $this->apply_loan->id)->where('share_holder', $getsholder->id)->first();
            if($LD && Storage::exists($LD->statement)) {
                Storage::delete($LD->statement);
            }
            if($LD && Storage::exists($LD->latest_year)) {
                Storage::delete($LD->latest_year);
            }
            if($LD && Storage::exists($LD->year_before)) {
                Storage::delete($LD->year_before);
            }
            if($LD && Storage::exists($LD->current_year)) {
                Storage::delete($LD->current_year);
            }
            if($LD){
                $LD->delete();
            }
            LoanDocument::forceCreate([
                'apply_loan_id' => $this->apply_loan->id,
                'share_holder' => $getsholder->id,
                'statement' => isset($this->share_holder_statement[$getsholder->id]) ?  $this->share_holder_statement[$getsholder->id]->store('documents') : '',
                'latest_year' => $this->share_holder_latest_year[$getsholder->id]->store('documents'),
                'year_before' => $this->share_holder_company_year[$getsholder->id] >= 3 ? $this->share_holder_year_before[$getsholder->id]->store('documents') : '',
                'current_year' => isset($this->share_holder_current_year[$getsholder->id]) ? $this->share_holder_current_year[$getsholder->id]->store('documents') : '',

            ]);
            if(isset($this->share_holder_statement[$getsholder->id])){
                $LSI = LoanStatement::where('apply_loan_id', $this->apply_loan->id)->get();
                if($LSI->count() > 0){
                    foreach($LSI as $item){
                        if($item && Storage::exists($item->statement)) {
                            Storage::delete($item->statement);
                        }
                    }
                    LoanStatement::where('apply_loan_id', $this->apply_loan->id)->delete();
                }
            }
            if(sizeof($this->share_errorArray) == 0 && !isset($this->share_holder_statement[$getsholder->id])){
                foreach($this->share_holder_photo[$getsholder->id] as $key =>  $item){
                    $LSI = LoanStatement::where('apply_loan_id', $this->apply_loan->id)->where('month', $key)->where('share_holder',  $getsholder->id)->first();
                    if($LSI && Storage::exists($LSI->statement)) {
                        Storage::delete($LSI->statement);
                    }
                    if($LSI){
                        $LSI->delete();
                    }
                    LoanStatement::forceCreate([
                        'apply_loan_id' => $this->apply_loan->id,
                        'month' => $key,
                        'share_holder' => $id,
                        'statement' => $item->store('documents'),
                    ]);
                }
            }
            $this->emit('alert', ['type' => 'success', 'message' => 'Shareholder Company documents added successfully.']);

           
            
        }
    }
    ///////gernalinfo
    public function store()
    {
        // dd($this->gernalinfo['user_owned']);
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
        $this->financePartners = FinancePartner::where('status', 1)->whereRaw("find_in_set('".$this->apply_loan->loan_type_id."',loan_type_id)")
        ->where('min_quantum', '<=', $this->apply_loan->amount)
        ->where('max_quantum', '>=', $this->apply_loan->amount)
        ->where('parent_id', 0)
        ->get();
      
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
        $this->financePartners = FinancePartner::where('status', 1)->whereRaw("find_in_set('".$this->apply_loan->loan_type_id."',loan_type_id)")
        ->where('min_quantum', '<=', $this->apply_loan->amount)
        ->where('max_quantum', '>=', $this->apply_loan->amount)
        ->where('parent_id', 0)
        ->get();
        $this->tab = 4;
        
    }

    public function getnoofYear()
    {
        // dd($this->company_years);
       
        // dd($this->company_years."-".$this->company_months);
       $interval = date('Y')-$this->company_years;
        if($this->company_years){
            $this->company_year = $interval;
        } 
        if($this->company_months){
            $this->company_month = $this->company_months; 
        }
      
        // dd($this->company_years);
    }

    public function confirmationMessage()
    {

        $LCD=LoanCompanyDetail::where('apply_loan_id', $this->apply_loan->id)->where('share_holder', 0)->first();
        if($LCD && $LCD->listed_company_check != $this->listed_company_check){
            $this->dispatchBrowserEvent('confirmation', ['message' => "Company detail will be deleted if update", "function" => "companyDetailStore"]);
        }else{
            $this->companyDetailStore();
        }
       
    }

    public function getCbsLender()
    {
       
        $this->lender = [];
        $this->checkSelect = [];
        if($this->cbs_member){
            $this->financePartners = FinancePartner::where('status', 1)->whereRaw("find_in_set('".$this->apply_loan->loan_type_id."',loan_type_id)")
            ->where('min_quantum', '<=', $this->apply_loan->amount)
            ->where('max_quantum', '>=', $this->apply_loan->amount)
            ->where('parent_id', 0)
            ->where('cbs_member', "1")->get();
           
        }else{
            
            $this->financePartners = FinancePartner::where('status', 1)->whereRaw("find_in_set('".$this->apply_loan->loan_type_id."',loan_type_id)")
            ->where('min_quantum', '<=', $this->apply_loan->amount)
            ->where('max_quantum', '>=', $this->apply_loan->amount)
            ->where('parent_id', 0)
            ->get();
        }
       
       
    }

    public function storeLender()
    {
        $this->validate([
            'cbs_member_image' => $this->cbs_member ?  'required|mimes:jpg,jpeg,png,pdf' : 'nullable',
        ]);
        if(sizeof($this->lender) == 0){
            $this->emit('danger', ['type' => 'success', 'message' => 'Select lenders.']);
            return;
        }
        LoanLender::where('apply_loan_id', $this->apply_loan->id)->delete();
        LoanLenderDetail::where('apply_loan_id', $this->apply_loan->id)->delete();
        $LL=LoanLender::forceCreate([
            'apply_loan_id' => $this->apply_loan->id,
            'cbs_member' => $this->cbs_member,
            'cbs_member_image' => $this->cbs_member ? $this->cbs_member_image->store('documents') : '',
            'financial_institute' => $this->financial_institute,
        ]);
        foreach($this->lender as $key => $item){
            LoanLenderDetail::forceCreate([
                'loan_lender_id' => $LL->id,
                'apply_loan_id' => $this->apply_loan->id,
                'lender_id' => $key,
            ]);
        }
        return redirect()->route('home');
    }

    public function getMap()
    {
        dd('asd');
    }

   
}
