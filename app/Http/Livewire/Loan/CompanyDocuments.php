<?php

namespace App\Http\Livewire\Loan;

use App\Models\LoanCompanyDetail;
use App\Models\Media;
use Livewire\Component;
use Monarobase\CountryList\CountryListFacade;

class CompanyDocuments extends Component
{
    public $apply_loan;
    
    public $main_type;
    
    public $loan_type_id;
    
    public $listed_company_check  = 0;
    
    public $images;
    
    public $getNumberOfCompanyYears;

    public $profitable_latest_year;

    public $profitable_before_year;

    public $optional_revenuee;

    public $share_holder;

    public $countries;


    public function mount()
    {
        

        $this->main_type = $this->apply_loan->main_type; 
        
        $this->loan_type_id = $this->apply_loan->loan_type_id;
        
        $companyDetail = LoanCompanyDetail::where('apply_loan_id', $this->apply_loan->id)->first();

        if($companyDetail){

            $this->profitable_latest_year = $companyDetail->profitable_latest_year;

            $this->profitable_before_year = $companyDetail->profitable_before_year;

            $this->optional_revenuee = $companyDetail->optional_revenuee;
        }
        $this->countries = CountryListFacade::getList('en');
    }
    
    public function render()
    {

        return view('livewire.loan.company-documents');
    
    }


    public function confirmationMessage()
    {
        $combine_statement = Media::where('share_holder', 0)->where('apply_loan_id', $this->apply_loan->id)->where('key', 'parent_company_combine_statement')->first();

        $current_year = Media::where('share_holder', 0)->where('apply_loan_id', $this->apply_loan->id)->where('key', 'parent_company_current_year_statement')->first();
        
        $latest_year = Media::where('share_holder', 0)->where('apply_loan_id', $this->apply_loan->id)->where('key', 'parent_company_latest_year_statement')->first();
        
        $before_year = Media::where('share_holder', 0)->where('apply_loan_id', $this->apply_loan->id)->where('key', 'parent_company_before_year_statement')->first();


        for ($x = 1; $x < 8; $x++){
             $montName = date("M", strtotime( date( 'Y-m-01' )." -$x months"));

             $this->getImages = Media::where('apply_loan_id', $this->apply_loan->id)
            ->where('key', $montName)
            ->where('share_holder', $this->share_holder)
            ->first();

            // dd($this->getImages);
            if(empty($this->getImages)){
                $this->dispatchBrowserEvent('confirmation', ['message' => 'Please note you have uploaded less than the standard set of documents required. Unless yours is a new company, and therefore you are unable to produce these documents yet,  the Financing Partner will be contacting you for the missing documents', "function" => "saveCompanyDocuments"]);
                return;
            }
        }

        if(empty($combine_statement) || empty($current_year) || empty($latest_year) || empty($before_year)){
            $this->dispatchBrowserEvent('confirmation', ['message' => 'Please note you have uploaded less than the standard set of documents required. Unless yours is a new company, and therefore you are unable to produce these documents yet,  the Financing Partner will be contacting you for the missing documents', "function" => "saveCompanyDocuments"]);
            return;
        }else{
            $this->saveCompanyDocuments();
        }

       
    }

    public function saveCompanyDocuments()
    {
        $loanComanyDetaol = LoanCompanyDetail::where('apply_loan_id', $this->apply_loan->id)->where('share_holder', 0 )->first();
        $loanComanyDetaol->profitable_latest_year  = $this->profitable_latest_year ?? '';
        $loanComanyDetaol->profitable_before_year  = $this->profitable_before_year ?? '';
        $loanComanyDetaol->optional_revenuee  = $this->optional_revenuee;
        $loanComanyDetaol->update();
        $this->emit('changeTab',$this->apply_loan->id, 7);
        // $this->shareDisable = true;
        $this->emit('alert', ['type' => 'success', 'message' => 'Company documents added successfully.']);
        
    }
    
}
