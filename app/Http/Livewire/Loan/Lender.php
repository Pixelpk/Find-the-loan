<?php

namespace App\Http\Livewire\Loan;

use App\Models\FinancePartner;
use App\Models\LoanCompanyDetail;
use App\Models\LoanLender;
use App\Models\LoanLenderDetail;
use App\Models\ApplyLoan;
use App\Models\BusinessHirePurchase;
use Livewire\Component;
use Livewire\WithFileUploads;

class Lender extends Component
{
    use WithFileUploads;
    public $apply_loan;
    public $financePartners = [];
    public $lender =  [];
    public $cbs_member_image;
    public $cbs_member;
    public $loan_type_id;
    public $financial_institute;
    public $main_type;
    public $selectall;
    public $policy;
    // public $checkSelect;
    public $checkSelect= [];
    public $thank_you_message = false;

    public function mount()
    {
        $this->getFinancePartner();
        
        foreach($this->financePartners as $item){
            
            $this->lender[$item->id] = false;
        }
       
    }

    public function getFinancePartner()
    {
        $loancompanyDetail = LoanCompanyDetail::where('apply_loan_id', $this->apply_loan->id)
        ->where('share_holder', 0)
        ->where('listed_company_check', 0)
        ->first();     

        $hirePurchase = BusinessHirePurchase::where('apply_loan_id', $this->apply_loan->id)
        ->first();  
        $propertType = $hirePurchase->hire_purchase_type;
        // dd($propertType);

        $this->loan_type_id = $this->apply_loan->loan_type_id;
        $this->main_type = $this->apply_loan->main_type;
        $query = FinancePartner::where('status', 1)
        ->whereRaw("find_in_set('".$this->apply_loan->loan_type_id."',loan_type_id)")
        ->whereRaw("find_in_set('".$propertType."',property_types)")
        ->orWhereRaw("find_in_set('".$propertType."',equipment_types)")
        ->where('min_quantum', '<=', $this->apply_loan->amount)
        ->where('max_quantum', '>=', $this->apply_loan->amount)
        ->where('parent_id', 0);

        // dd($query);

        
        if($loancompanyDetail){
            $lengthOfIncorporation = substr($loancompanyDetail->company_start_date, 0, strpos($loancompanyDetail->company_start_date, "/"));
            $query->whereRaw("find_in_set('".$loancompanyDetail->company_structure_type_id."',company_structure_id)")
            ->where('length_of_incorporation', '<=', $lengthOfIncorporation)
            ->where('local_shareholding', '<=', $loancompanyDetail->percentage_shareholder);
        }
        if($this->cbs_member){
            $query->where('cbs_member', 1);
        }
        
        $this->financePartners = $query->get();
    }

    

    public function render()
    {

        return view('livewire.loan.lender');
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


    public function findLender()
    {
        // foreach($this->)
        $this->financePartners = FinancePartner::where('status', 1)
        ->whereRaw("find_in_set('".$this->apply_loan->loan_type_id."',loan_type_id)")
        ->where('min_quantum', '<=', $this->apply_loan->amount)
        ->where('max_quantum', '>=', $this->apply_loan->amount)
        ->where('parent_id', 0)
        ->get();
    }


    public function Selectall($id)
    {

        if($this->selectall[$id]){
            foreach($this->lender as $key => $item){
                
                $FP = FinancePartner::find($key);
                if($FP->type == $id){
                    $this->lender[$key] = true;
                }
            }
        }else{

            foreach($this->lender as $key => $item){

                $FP = FinancePartner::find($key);
                if($FP->type == $id){
                    $this->lender[$key] = false;
                }
            }
        }
       
    }


    public function storeLender()
    {
        // dd($this->cbs_member_image);
        $error = false;
        foreach($this->lender as $key => $item){           
            if($item){
                $error = true;
            }
        }
        if(!$error){
            $this->emit('danger', ['type' => 'success', 'message' => 'Please select lenders.']);
            return;
        }
        $this->validate([
            'cbs_member_image' => $this->cbs_member ?  'required|mimes:jpg,jpeg,png,pdf' : 'nullable',
        ]);
        if(sizeof($this->lender) == 0){
            $this->emit('danger', ['type' => 'success', 'message' => 'Select lenders.']);
            return;
        }
        if(!$this->policy){
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
        // dd($this->lender);
        foreach($this->lender as $key => $item){
            if($item){
                LoanLenderDetail::forceCreate([
                    'loan_lender_id' => $LL->id,
                    'apply_loan_id' => $this->apply_loan->id,
                    'lender_id' => $key,
                ]);
            }
        }

        $applyloan= ApplyLoan::where('id', $this->apply_loan->id)->first();
        $applyloan->status = 1;
        $applyloan->update();

        $this->thank_you_message = true;
        $this->emit('hideTabs', true);
        // if($LL){
        //     $this->dispatchBrowserEvent('enquiry_submit', ['title' => 'Thank You!','message' => 'Now just sit back and give the Financing Partners a couple of moments to look through your documents and make their offers on your dashboard – we’ll email you when an offer has been made.', 'function' => 'redirectAfterSuccess']);
        //     return;
        // }


        // return redirect()->route('home');
    }

    public function redirectAfterSuccess(){
        return redirect()->route('home');
    }
}
