<?php

namespace App\Http\Livewire\Cms;

use Livewire\Component;

class QuotationComparisonCalculator extends Component
{
    public $quantum1;
    public $tenure_years1;
    public $interest_per_year_percent1;
    public $processing_fee1;

    public $interest_per_year1;
    public $total_interest1;
    public $total_pi1;
    public $fee_in_dollar1;
    public $pi_fee1;
    public $monthly_installment1;
    public $yearly_installment1;
    public $fee_plus_i1;

    public $quantum2;
    public $tenure_years2;
    public $interest_per_year_percent2;
    public $processing_fee2;

    public $interest_per_year2;
    public $total_interest2;
    public $total_pi2;
    public $fee_in_dollar2;
    public $pi_fee2;
    public $monthly_installment2;
    public $yearly_installment2;
    public $fee_plus_i2;

    public $difference;
    public $expense_message;

    public function render()
    {
        return view('livewire.customer.quotation-comparison-calculator')->layout('cms.layouts.master');
    }

    public function calculateDifference(){
        $this->validate([
            'quantum1' => 'required|integer',
            'tenure_years1' => 'required|integer',
            'interest_per_year_percent1' => 'required|integer',
            'processing_fee1' => 'required|integer',
            'quantum2' => 'required|integer',
            'tenure_years2' => 'required|integer',
            'interest_per_year_percent2' => 'required|integer',
            'processing_fee2' => 'required|integer',
        ]);
        //loan one
        $this->interest_per_year1 = round(($this->quantum1 * $this->interest_per_year_percent1)/100,2);
        $this->total_interest1 = $this->interest_per_year1 * $this->tenure_years1;
        $this->total_pi1 = $this->quantum1 + $this->total_interest1;
        $this->fee_in_dollar1 = round(($this->quantum1 * $this->processing_fee1)/100,2);
        $this->pi_fee1 = $this->total_pi1 + $this->fee_in_dollar1;
        $this->yearly_installment1 = round($this->pi_fee1 / $this->tenure_years1);
        $this->monthly_installment1 = round($this->yearly_installment1 / 12 , 2);

        $this->fee_plus_i1 = $this->fee_in_dollar1 + $this->total_interest1;

        $this->interest_per_year2 = round(($this->quantum2 * $this->interest_per_year_percent2)/100,2);
        $this->total_interest2 = $this->interest_per_year2 * $this->tenure_years2;
        $this->total_pi2 = $this->quantum2 + $this->total_interest2;
        $this->fee_in_dollar2 = round(($this->quantum2 * $this->processing_fee2)/100 ,2);
        $this->pi_fee2 = $this->total_pi2 + $this->fee_in_dollar2;
        $this->yearly_installment2 = $this->pi_fee2 / $this->tenure_years2;
        $this->monthly_installment2 = round($this->yearly_installment2 / 12 ,2);

        $this->fee_plus_i2 = round($this->fee_in_dollar2 + $this->total_interest2);

        $this->difference = round($this->monthly_installment1 - $this->monthly_installment2,2);
        $this->expensive_percentage = round(100 - ($this->fee_plus_i1 / $this->fee_plus_i2) * 100);
        
        if($this->monthly_installment1 > $this->monthly_installment2){
            $this->expense_message = "Loan 1 is ".abs($this->expensive_percentage)." percent more expensive Than Loan 2";
        }elseif($this->monthly_installment2 > $this->monthly_installment1){
            $this->expense_message = "Loan 2 is ".abs($this->expensive_percentage)." percent more expensive Than Loan 1";
        }else{
            $this->expense_message = "Loan 1 and Loan 2 are equally expensive.";
        }
        return;
    }


}
