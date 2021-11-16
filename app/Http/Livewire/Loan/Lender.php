<?php

namespace App\Http\Livewire\Loan;

use App\Models\FinancePartner;
use App\Models\LoanLender;
use App\Models\LoanLenderDetail;
use Livewire\Component;

class Lender extends Component
{
    public $apply_loan;
    public $financePartners = [];
    public $lender;
    public $cbs_member_image;
    public $cbs_member;
    public $loan_type_id;
    public $financial_institute;
    public $main_type;
    // public $checkSelect;
    public $checkSelect= [];
    // public $loan_type_id;
    public function mount()
    {
        $this->loan_type_id = $this->apply_loan->loan_type_id;
        $this->main_type = $this->apply_loan->main_type;
        $this->financePartners = FinancePartner::where('status', 1)->whereRaw("find_in_set('".$this->apply_loan->loan_type_id."',loan_type_id)")
        ->where('min_quantum', '<=', $this->apply_loan->amount)
        ->where('max_quantum', '>=', $this->apply_loan->amount)
        ->where('parent_id', 0)
        ->get();
        // dd($this->financePartners );
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
        $this->financePartners = FinancePartner::where('status', 1)
        ->whereRaw("find_in_set('".$this->apply_loan->loan_type_id."',loan_type_id)")
        ->where('min_quantum', '<=', $this->apply_loan->amount)
        ->where('max_quantum', '>=', $this->apply_loan->amount)
        ->where('parent_id', 0)
        ->get();
    }


    public function Selectall($id)
    {
        // dd($id);
    //    dd($this->lender);
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
        
        // if($this->checkSelect[$id]){
        //     foreach($FP as $key => $item){
        //         $key = $item['id'];
        //         $this->lender[$key] = true;
        //     }
        // }
        // else{
            foreach($FP as $key => $item){
                $key = $item['id'];
                $this->lender[$key] = false;
            }
        // }
       
        // dd($this->lender);
        // dd($this->lender[13]);
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
}
