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
use Monarobase\CountryList\CountryListFacade;
use File;
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
    public $share_holder_profitable_latest_year;
    public $share_holder_profitable_before_year;
    public $share_holder_current_year;
    public $country;
    public $countries;
    public $subsidiary;
    public $company_years;
    public $company_months;
    public $share_holder_optional_revenuee;
    public $getNumberOfCompanyYears;
    public $checkShareHolder;
   
    public function mount()
    {
        
        $this->mainTypes = [];
        $this->loanReasons = [];
        $this->reasonValue = [];
        $this->company_structure_types = CompanyStructure::where('status', 1)->get();
        $this->sectors = Sector::where('status', 1)->get();
        $this->countries = CountryListFacade::getList('en');

        // $this->get_share_holder_type = ShareHolderDetail::where('apply_loan_id', 2)->get();
    }
    public function getShareholderTypeId($id)
    {
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
        // dd($this->checkShareHolder);
        // dd($id);
    }
    public function  resetComapny()
    {
        $this->company_years = '';
        $this->company_months = '';
    }
    public function  shareHolderResetComapny($shreholder)
    {
        $this->share_holder_company_years[$shreholder] = '';
        $this->share_holder_company_months[$shreholder] = '';
    }
    public function saveCompanyDocuments()
    {
        
        $this->errorArray = [];
        if(!isset($this->statement)){
            for ($x = 2; $x < 8; $x++) {
                $montn = date("M", strtotime( date( 'Y-m-01' )." -$x months"));
                if(isset($this->photo[$montn])){
                    if($montn == $this->photo[$montn]){
                    }
                }
                else{
                    array_push($this->errorArray, $montn);
                }
            }
        }
        if(sizeof($this->errorArray) > 0){
            return;
        }
        $this->validate([
            'statement' =>  isset($this->photo)  > 0 ? '' : 'image|required',
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
        $LD = LoanDocument::where('apply_loan_id', $this->apply_loan->id)->where('share_holder', 0)->first();
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
            'statement' => isset($this->statement) ?  $this->statement->store('documents') : '',
            'latest_year' => $this->latest_year->store('documents'),
            'year_before' => $this->company_year >= 3 ? $this->year_before->store('documents') : '',
            'current_year' => isset($this->current_year) ? $this->current_year->store('documents') : '',
        ]);
        if(sizeof($this->errorArray) == 0 && !isset($this->statement)){
            foreach($this->photo as $key =>  $item){
                $LSI = LoanStatement::where('apply_loan_id', $this->apply_loan->id)->where('month', $key)->where('share_holder', 0)->first();
                if($LSI && Storage::exists($LSI->statement)) {
                    Storage::delete($LSI->statement);
                }
                if($LSI){
                    $LSI->delete();
                }
                LoanStatement::forceCreate([
                    'apply_loan_id' => $this->apply_loan->id,
                    'month' => $key,
                    'statement' => $item->store('documents'),
                ]);
            }
        }

       
        $this->tab = 7;
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
        $this->errorMessage = '';
        $test = $this->values[$loan_type_id];
        $this->values = [];
        if($test){
            $this->loan_type_id = $loan_type_id;
            $this->values = [$loan_type_id => true];
        }else{
            $this->loan_type_id = null;
        }
        $this->goToReasons();

    }

    public function goToReasons()
    {
        $this->errorMessage = '';
       
        $this->loanReasons = LoanReason::where('profile', $this->main_type)->where('status', 1)->get();
       
        // $this->emit('alert', ['type' => 'success', 'message' => 'Loan Type has been selected.']);
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
   
    public function updateCompanyDetal()
    {
        
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
    }
    public function companyDetailStore()
    {
        if($this->listed_company_check){
            $this->validate([
                'subsidiary' => 'image|required',
                'company_name' => 'required',
                'country' => 'required'
            ]);
            if($this->apply_loan){
                $this->apply_loan->amount = $this->amount;
                $this->apply_loan->loan_type_id = $this->loan_type_id;
                $this->apply_loan->update();
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
            }else{
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

            }

            if($this->apply_loan){
                $companyDetail = LoanCompanyDetail::where('share_holder', 0)->where('apply_loan_id', $this->apply_loan->id)->first();
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
                    'apply_loan_id' => $applyLoan->id,
                    'company_name' => $this->company_name,
                    "listed_company_check" => $this->listed_company_check,
                    'country' => $this->country,
                    'subsidiary' => $this->subsidiary->store('documents'),
                ]);
                $this->apply_loan = $applyLoan;
                $this->emit('alert', ['type' => 'success', 'message' => 'Company Detail has been saved.']);
            }
            
            return;
        }
        $this->validate([
            'amount' => 'required',
            'loan_type_id' => 'required',
            // 'reasons' => 'required',
            'company_name' => 'required',
            'company_year' =>  $this->company_months || $this->company_years ? '' : 'required',
            'company_month' =>  $this->company_months || $this->company_years ? '' : 'required',
            'company_years' =>  $this->company_months  ? 'required' : '',
            'company_months' =>  $this->company_years  ? 'required' : '',
            'number_of_share_holder' => 'required|numeric|max:10',
            'sector_id' => 'required',
            'revenue' => 'required|numeric',
            'percentage_shareholder' => 'required',
            'company_structure_type_id' => 'required',
            'number_of_employees' => 'required',
            'website' => 'nullable',

        ]);
        if($this->apply_loan){
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
        // $company_start_date = $this->company_year.'/'.$this->company_month;
        $data = LoanCompanyDetail::forceCreate([
            'apply_loan_id' => $applyLoan->id,
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
                    'apply_loan_id' => $applyLoan->id,
                    'share_holder_type' => 1,
                ]);
            }
        }
        $this->apply_loan = $applyLoan;
        $this->getNumberOfCompanyYears = current(explode("/", $data->company_start_date));
        $this->emit('alert', ['type' => 'success', 'message' => 'Company Detail has been saved.']);
        $this->tab = 5;
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
        // dd($this->nric_front[$id]);
        // foreach($this->get_share_holder_type as $item){
            // if($item['share_holder_type'] == 1){
                // dd($id);
                 $getsholder = ShareHolderDetail::where('id', $id)->first();
                //  dd( $getsholder);
                if($getsholder->share_holder_type == 1){
                //    dd($this->not_proof[$getsholder->id]);
                    $this->validate([
                        "nric_front.$id" => isset($this->passport[$getsholder->id])  ? '' : 'image|required',
                        "nric_back.$id" => isset($this->passport[$getsholder->id])  ? '' : 'image|required',
                        "passport.$id" => isset($this->nric_front[$getsholder->id]) && isset($this->nric_back[$id]) ? '' : 'image|required',
                        "not_proof.$id" => isset($this->nao_latest[$getsholder->id]) && isset($this->nao_older[$id]) ? '' : 'required',
                        "nao_latest.$id" => isset($this->not_proof[$getsholder->id])  ? '' : 'image|required',
                        "nao_older.$id" => isset($this->not_proof[$getsholder->id])  ? '' : 'image|required',
                    ]);
                    // dd($this->passport[$getsholder->id]);
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
                }
                if($getsholder->share_holder_type == 2)
                {
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
                    LoanCompanyDetail::forceCreate([
                        "apply_loan_id" => $this->apply_loan->id,
                        "share_holder" => $getsholder->id,
                        "listed_company_check" => $this->listed_company_check,
                        // "company_start_date" =>  $this->share_holder_company_year[$getsholder->id].'/'.$this->share_holder_company_month[$getsholder->id],
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

    public function company_share_holder_documents_store($id)
    {
        $getsholder = ShareHolderDetail::where('id', $id)->first();
        if($getsholder->share_holder_type == 2){
            $this->share_errorArray = [];
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
            if(sizeof($this->share_errorArray) > 0){
                return;
            }
            $this->validate([
                "share_holder_statement.$getsholder->id" => 'image|required',
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
            LoanDocument::forceCreate([
                'apply_loan_id' => $this->apply_loan->id,
                'share_holder' => $getsholder->id,
                
                'statement' => $this->share_holder_statement[$getsholder->id]->store('documents'),
                'latest_year' => $this->share_holder_latest_year[$getsholder->id]->store('documents'),
                'year_before' => $this->share_holder_company_year[$getsholder->id] >= 3 ? $this->share_holder_year_before[$getsholder->id]->store('documents') : '',
                'current_year' => isset($this->share_holder_current_year[$getsholder->id]) ? $this->share_holder_current_year[$getsholder->id]->store('documents') : '',

            ]);


            if(sizeof($this->share_errorArray) == 0){

                foreach($this->share_holder_photo[$getsholder->id] as $key =>  $item){
                    // dd($item->getClientOriginalExtension());
                    LoanStatement::forceCreate([
                        'apply_loan_id' => $this->apply_loan->id,
                        'share_holder' => $id,
                        'month' => $key,
                        'statement' => $item->store('documents'),

                    ]);
                }
            }
            // $this->tab = 6;
        }
    }
}
