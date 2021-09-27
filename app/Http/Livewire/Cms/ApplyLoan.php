<?php

namespace App\Http\Livewire\Cms;

use App\Models\ApplyLoan as ModelsApplyLoan;
use App\Models\CompanyStructure;
use App\Models\LoanCompanyDetail;
use App\Models\LoanDocument;
use App\Models\LoanPersonShareHolder;
use App\Models\LoanReason;
use App\Models\LoanStatement;
use App\Models\MainType;
use App\Models\Sector;
use App\Models\ShareHolderDetail;
use App\Models\UserLoanReason;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class ApplyLoan extends Component
{
    use WithFileUploads;
    public $main_type;
    public $mainTypes;
    public $loan_type_id;
    public $loanReasons;
    public $values;
    public $reasonValue;
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
    public $listed_company_check;
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
    public $get_share_holder_type;
    public $nric_front;
    public $nric_back;
    public $passport;
    public $nao_latest;
    public $nao_older;
    public $not_proof;
    public $subtab = '1';
    public $share_holder_company_name;
    public $share_holder_company_year;
    public $share_holder_company_month;
    public $share_holder_percentage_shareholder;
    public $share_holder_number_of_share_holder;
    public $share_holder_company_structure_type_id;
    public $share_holder_sector_id;
    public $share_holder_number_of_employees;
    public $share_holder_revenue;
    public $share_holder_website;
    public function mount()
    {
        $this->mainTypes = [];
        $this->loanReasons = [];
        $this->reasonValue = [];
        $this->company_structure_types = CompanyStructure::where('status', 1)->get();
        $this->sectors = Sector::where('status', 1)->get();
        // $this->get_share_holder_type = ShareHolderDetail::where('apply_loan_id', 2)->get();
    }
    public function saveCompanyDocuments()
    {
        $this->errorArray = [];
        for ($x = 2; $x <= 7; $x++){
            $montn = date('M', strtotime( "-".$x."month"));
            if(isset($this->photo[$montn])){
                if($montn == $this->photo[$montn]){
                }
            }
            else{
                array_push($this->errorArray, $montn);
            }
        }
        if(sizeof($this->errorArray) > 0){
            return;
        }
        $this->validate([
            'statement' => 'image|required',
            'latest_year' => 'image|required',
            'year_before' => $this->company_year >= 3 ?  'image|required' : '',
            'profitable_latest_year' => 'required',
            'profitable_before_year' => 'required',
            // 'current_year' => 'image',
        ]);
        $loanComanyDetaol = LoanCompanyDetail::where('apply_loan_id', $this->apply_loan->id)->where('share_holder', 0 )->first();
        $loanComanyDetaol->profitable_latest_year  = $this->profitable_latest_year;
        $loanComanyDetaol->profitable_before_year  = $this->profitable_before_year;
        $loanComanyDetaol->optional_revenuee  = $this->optional_revenuee;
        $loanComanyDetaol->update();
        LoanDocument::forceCreate([
            'apply_loan_id' => $this->apply_loan->id,
            'statement' => $this->statement->store('documents'),
            'latest_year' => $this->latest_year->store('documents'),
            'year_before' => $this->company_year >= 3 ? $this->year_before->store('documents') : '',
            'current_year' => isset($this->current_year) ? $this->current_year->store('documents') : '',

        ]);


        if(sizeof($this->errorArray) == 0){

            foreach($this->photo as $key =>  $item){
                // dd($item->getClientOriginalExtension());
                LoanStatement::forceCreate([
                    'apply_loan_id' => $this->apply_loan->id,
                    'month' => $key,
                    'statement' => $item->store('documents'),

                ]);
            }
        }
        $this->tab = 6;
    }
    public function render()
    {
        return view('livewire.cms.apply-loan')->layout('cms.layouts.master');
    }

    public function getMainType()
    {
     
        $this->mainTypes = MainType::where('profile_id', $this->main_type)->get();
    }

    public function getLoanReason($loan_type_id, $key)
    {
       
        $test = $this->values[$loan_type_id];
        $this->values = [];
        if($test){
            $this->loan_type_id = $loan_type_id;
            $this->values = [$loan_type_id => true];
        }else{
            $this->loan_type_id = null;
        }

    }

    public function goToReasons()
    {
       
        $this->loanReasons = LoanReason::where('loan_type_id', $this->loan_type_id)->where('status', 1)->get();
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
        foreach($this->reasonValue as $item)
        {
            if($item){
                $this->tab = 3;
                return;
            }
        }

    }

    public function companyDetail()
    {
        if(!$this->amount){
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
                $this->tab = 4;
                return;
            }
        }

    }
    public function updateCompanyDetal()
    {
        $company_start_date = $this->company_year.'/'.$this->company_month;
        $ParentCompany = LoanCompanyDetail::where('apply_loan_id', $this->apply_loan->id)->where('share_holder', 0)->first();
        $ParentCompany->company_start_date = $company_start_date;
        $ParentCompany->revenue = $this->revenue;
        $ParentCompany->number_of_share_holder = $this->number_of_share_holder;
        $ParentCompany->sector_id = $this->sector_id;
        $ParentCompany->percentage_shareholder = $this->percentage_shareholder;
        $ParentCompany->company_structure_type_id = $this->company_structure_type_id;
        $ParentCompany->number_of_employees = $this->number_of_employees;
        $ParentCompany->company_name = $this->company_name;
        $ParentCompany->website = $this->website;
        $ParentCompany->update();
        $this->tab = 5;
    }
    public function companyDetailStore()
    {
        $this->validate([
            'amount' => 'required',
            'loan_type_id' => 'required',
            // 'reasons' => 'required',
            'company_name' => 'required',
            'company_year' => 'required',
            'company_month' => 'required',
            'number_of_share_holder' => 'required',
            'sector_id' => 'required',
            'revenue' => 'required',
            'percentage_shareholder' => 'required',
            'company_structure_type_id' => 'required',
            'number_of_employees' => 'required',
            'website' => 'url',

        ]);
        if($this->apply_loan){
            $this->updateCompanyDetal();
            return;
        }
        $company_start_date = $this->company_year.'/'.$this->company_month;
        // $revenue = $this->revenue_amount1.'.'.$this->revenue_amount2;
        $applyLoan=ModelsApplyLoan::forceCreate([
            'amount' => $this->amount,
            'loan_type_id' => $this->loan_type_id,
            'user_id' => Auth::guard('web')->user()->id,

        ]);

        foreach($this->reasonValue as $key => $item)
        {
            if($item){
                UserLoanReason::forceCreate([
                    'apply_loan_id' => $applyLoan->id,
                    'loan_reason_id' => $key,
                    'loan_type_id' => $this->loan_type_id,
                ]);
            }
        }
        $company_start_date = $this->company_year.'/'.$this->company_month;
        LoanCompanyDetail::forceCreate([
            'apply_loan_id' => $applyLoan->id,
            'company_start_date' => $company_start_date,
            'revenue' => $this->revenue,
            'number_of_share_holder' => $this->number_of_share_holder,
            'sector_id' => $this->sector_id,
            'percentage_shareholder' => $this->percentage_shareholder,
            'company_structure_type_id' => $this->company_structure_type_id,
            'number_of_employees' => $this->number_of_employees,
            'company_name' => $this->company_name,
            'website' => $this->website,
        ]);
        $this->apply_loan = $applyLoan;
        $this->tab = 5;
    }

    public function share_holder_detail()
    {
        
        if(!isset($this->all_share_holder)){
            $this->errorMessage  = 'Share holder type required';
            return;
        }
        if(sizeof($this->all_share_holder) == 3){
            ShareHolderDetail::where('apply_loan_id', 2)->delete();
            foreach($this->all_share_holder as $item)
            {

                $data = ShareHolderDetail::forceCreate([
                    'apply_loan_id' => 2,
                    'share_holder_type' => $item
                ]);
                $this->get_share_holder_type[] = $data;
            }
            $this->errorMessage = '';
            $this->tab = 7;
        }else{
            $this->errorMessage  = 'Share holder type required';
            return;  
        }
    }

    public function share_holder_document_store()
    {
       
        foreach($this->get_share_holder_type as $item){
            if($item['share_holder_type'] == 1){
                 $getsholder = ShareHolderDetail::where('id', $item['id'])->first();
                 $this->validate([
                     "nric_front.$getsholder->id" => isset($this->passport[$getsholder->id])  ? '' : 'image|required',
                     "nric_back.$getsholder->id" => isset($this->passport[$getsholder->id])  ? '' : 'image|required',
                     "passport.$getsholder->id" => isset($this->nric_front[$getsholder->id]) && isset($this->nric_front[$getsholder->id]) ? '' : 'image|required',
                     "not_proof.$getsholder->id" => isset($this->nao_latest[$getsholder->id]) && isset($this->nao_older[$getsholder->id]) ? '' : 'image|required',
                     "nao_latest.$getsholder->id" => isset($this->not_proof[$getsholder->id])  ? '' : 'image|required',
                     "nao_older.$getsholder->id" => isset($this->not_proof[$getsholder->id])  ? '' : 'image|required',
                 ]);
                
             }
             
        }
        foreach($this->get_share_holder_type as $item){
            if($item['share_holder_type'] == 2){
                $getsholder = ShareHolderDetail::where('id', $item['id'])->first();
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
                    "share_holder_website.$getsholder->id" => 'url',
                ]);
                
            }
            
        }
        foreach($this->get_share_holder_type as $item){
        if($item['share_holder_type'] == 1){
            $getsholder = ShareHolderDetail::where('id', $item['id'])->first();
            
            LoanPersonShareHolder::forceCreate([
                'apply_loan_id' => 2,
                'share_holder_detail_id' => $getsholder->id,
                "nric_front" => isset($this->nric_front[$getsholder->id]) ?  $this->nric_front[$getsholder->id]->store('documents') : '',
                "nric_back" => isset($this->nric_back[$getsholder->id]) ?  $this->nric_back[$getsholder->id]->store('documents') : '',
                "passport" => isset($this->passport[$getsholder->id]) ?  $this->passport[$getsholder->id]->store('documents') : '',
                "nao_latest" => isset($this->nao_latest[$getsholder->id]) ?  $this->nao_latest[$getsholder->id]->store('documents') : '',
                "nao_older" => isset($this->nao_older[$getsholder->id]) ?  $this->nao_older[$getsholder->id]->store('documents') : '',
            ]);
        }
            
       }
       
       foreach($this->get_share_holder_type as $item){
            if($item['share_holder_type'] == 2){
                $getsholder = ShareHolderDetail::where('id', $item['id'])->first();
               
                LoanCompanyDetail::forceCreate([
                    "apply_loan_id" => 2,
                    "share_holder" => $getsholder->id,
                    "company_start_date" =>  $this->share_holder_company_year[$getsholder->id].'/'.$this->share_holder_company_month[$getsholder->id],
                    "revenue" => $this->share_holder_revenue[$getsholder->id],
                    "number_of_share_holder" => $this->share_holder_number_of_share_holder[$getsholder->id],
                    "sector_id" => $this->share_holder_sector_id[$getsholder->id],
                    "percentage_shareholder" => $this->share_holder_percentage_shareholder[$getsholder->id],
                    "company_structure_type_id" => $this->share_holder_company_structure_type_id[$getsholder->id],
                    "number_of_employees" => $this->share_holder_number_of_employees[$getsholder->id],
                    "company_name" => $this->share_holder_company_name[$getsholder->id],
                    "website" => $this->share_holder_website[$getsholder->id],
                ]);
                $this->subtab = '2';
                
            }
            
        }
        
    }
}
