<?php

namespace App\Http\Livewire\Loan;

use App\Models\LoanCompanyDetail;
use Livewire\Component;

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
    }
    
    public function render()
    {

        return view('livewire.loan.company-documents');
    
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
