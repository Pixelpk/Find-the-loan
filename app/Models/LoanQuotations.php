<?php

namespace App\Models;

use App\Http\Controllers\Admin\LoanApplications;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanQuotations extends Model
{
    use HasFactory;
    protected $table = "loan_quotations";
     
    //defining mutators for column values that we want to store as json
    public function setQuantumInterestAttribute($value){
        $this->attributes['quantum_interest'] = json_encode($value);
    }

    public function setMonthlyFeeAttribute($value)
    {
        $this->attributes['monthly_fee'] = json_encode($value);
    }

    public function setAnnualFeeAttribute($value)
    {
        $this->attributes['annual_fee'] = json_encode($value);
    }

    public function setLegalFeeAttribute($value)
    {
        $this->attributes['legal_fee'] = json_encode($value);
    }

    public function setIfInsuranceRequiredAttribute($value)
    {
        $this->attributes['if_insurance_required'] = json_encode($value);
    }

    public function setEirAttribute($value)
    {
        $this->attributes['eir'] = json_encode($value);
    }

    public function setRepaymentAttribute($value)
    {
        $this->attributes['repayment'] = json_encode($value);
    }

    public function setOneTimeFeeAttribute($value)
    {
        $this->attributes['one_time_fee'] = json_encode($value);
    }

    //end mutators

    // defining accessors for column values that have json serialized data
    public function getQuantumInterestAttribute($value){
        return json_decode($value);
    }

    public function getMonthlyFeeAttribute($value)
    {
        return json_decode($value);
    }

    public function getAnnualFeeAttribute($value)
    {
        return json_decode($value);
    }

    public function getLegalFeeAttribute($value)
    {
        return json_decode($value);
    }

    public function getIfInsuranceRequiredAttribute($value)
    {
        return json_decode($value);
    }

    public function getEirAttribute($value)
    {
        return json_decode($value);
    }

    public function getRepaymentAttribute($value)
    {
        return json_decode($value);
    }

    public function getOneTimeFeeAttribute($value)
    {
        return json_decode($value);
    }
    // end accessors
    // protected $casts = [
    //     'quantum_interest' => 'array',
    //     'monthly_fee' => 'array',
    //     'annual_fee' => 'array',
    //     'legal_fee' => 'array',
    //     'if_insurance_required' => 'array',
    //     'eir' => 'array',
    //     'repayment' => 'array',
    //     'one_time_fee' => 'array',
    // ];
    protected $fillable = [
        'apply_loan_id','partner_id','quoted_by','quantum_interest','one_time_fee',
        'monthly_fee','annual_fee','legal_fee','if_insurance_required','eir',
        'repayment','quote_validity'
    ];

    public function loan_application()
    {
        return $this->belongsTo(ApplyLoan::class,'apply_loan_id')->with('loan_user','loan_type');
    }
}
