<?php

namespace App\Http\Livewire\Loan;

use App\Models\CompanyStructure;
use App\Models\LoanCompanyDetail;
use App\Models\LoanDocument;
use App\Models\LoanPersonShareHolder;
use App\Models\LoanStatement;
use App\Models\Sector;
use App\Models\ShareHolderDetail;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Monarobase\CountryList\CountryListFacade;

class CompanyDetail extends Component
{
    use WithFileUploads;
    public $apply_loan;
    public $company_months;
    public $company_years;
    public $company_name;
    public $company_year;
    public $company_month;
    public $number_of_share_holder;
    public $company_structure_type_id;
    public $percentage_shareholder;
    public $sector_id;
    public $company_structure_types;
    public $sectors;
    public $country;
    public $number_of_employees;
    public $revenue;
    public $website;
    public $subsidiary;
    public $listed_company_check = false;
    public $countries;
    public $get_share_holder_type = [];
    public $main_type;
    public $loan_type_id;
    

    public function mount()
    {
        $this->company_structure_types = CompanyStructure::where('status', 1)->get();

        $this->sectors = Sector::where('status', 1)->get();

        $this->main_type == $this->apply_loan->main_type;
        $this->loan_type_id == $this->apply_loan->loan_type_id;

        $this->countries = CountryListFacade::getList('en');

        $companyDetail = LoanCompanyDetail::where('apply_loan_id', $this->apply_loan->id)->first();
        if($companyDetail){

            $this->percentage_shareholder = $companyDetail->percentage_shareholder;

            $this->number_of_share_holder = $companyDetail->number_of_share_holder;
            
            $this->company_structure_type_id = $companyDetail->company_structure_type_id;
            
            $this->sector_id = $companyDetail->sector_id;
            
            $this->company_name = $companyDetail->company_name;
            
            $this->number_of_employees = $companyDetail->number_of_employees;
            
            $this->revenue = $companyDetail->revenue;
            
            $this->website = $companyDetail->website;
            
            $this->listed_company_check = $companyDetail->listed_company_check;
            
            $this->country = $companyDetail->country;
            
            $company_motnh = explode("/", $companyDetail->company_start_date);

            $this->company_year = substr($companyDetail->company_start_date, 0, strpos($companyDetail->company_start_date, "/"));
            
            $this->company_months = $company_motnh[1];
            
            $this->resetComapny();

            $this->company_month = $company_motnh[1];
            
            
            
            
        }

    }


    public function render()
    {
        return view('livewire.loan.company-detail');
    }



    public function confirmationMessage()
    {
       
        $LCD= LoanCompanyDetail::where('apply_loan_id', $this->apply_loan->id)->where('share_holder', 0)->first();
        if($LCD && $LCD->listed_company_check != $this->listed_company_check){
            $this->dispatchBrowserEvent('confirmation', ['message' => "Company detail will be deleted if update", "function" => "companyDetailStore"]);
        }else{
            $this->companyDetailStore();
        }
       
    }



    public function companyDetailStore()
    {
      
        if($this->listed_company_check){
            
            $this->validate([
                'company_name' => 'required',
                'country' => 'required'
            ]);
          
            $companyDetail = LoanCompanyDetail::where('share_holder', 0)->where('apply_loan_id', $this->apply_loan->id)->first();
           
            if($companyDetail && $companyDetail->listed_company_check == 0){
               
               $SHCD = LoanCompanyDetail::where('share_holder', '!=', 0)->where('apply_loan_id', $this->apply_loan->id)->delete();

            }
            if($this->apply_loan && $companyDetail){
                $companyDetail->company_name = $this->company_name;
                $companyDetail->country = $this->country;
                $companyDetail->listed_company_check = $this->listed_company_check;
                $companyDetail->update();
                $this->emit('alert', ['type' => 'success', 'message' => 'Company Detail has been udpate.']);
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
            $this->emit('changeTab',$this->apply_loan->id, 9);
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
            'number_of_share_holder' => 'numeric|max:10|integer|gt:0',
            'sector_id' => 'required',
            'revenue' => 'required|integer|gt:0',
            'percentage_shareholder' => 'required|integer|gt:0|max:100',
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
        
            // $this->tab = 5;
            $this->emit('changeTab',$this->apply_loan->id, 5);
            $this->documentDisable = true;
        
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
            // $this->tab = 5;
            $this->emit('changeTab',$this->apply_loan->id, 5);
            $this->documentDisable = true;
        }
    }



    public function getnoofYear()
    {
       $interval = date('Y')-$this->company_years;
        if($this->company_years){
            $this->company_year = $interval;
        } 
        if($this->company_months){
            $this->company_month = $this->company_months; 
        }
    
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
        $this->emit('changeTab',$this->apply_loan->id, 5);
    }



}
