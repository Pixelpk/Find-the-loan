<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLoanReject extends Model
{
    use HasFactory;
    protected $table = "user_loan_reject";

    public function rejected_by()
    {
        return $this->belongsTo(FinancePartner::class,'user_id','id')->select('id','name');
    }

    public function reject_finance_partner(){
        return $this->belongsTo(FinancePartner::class,'partner_id','id');
    }

    public function customer_reject_reason()
    {
        return $this->belongsTo(RejectReason::class,'customer_reject_reason_id','id')->select('id','reason');
    }

    public function internal_reject_reason()
    {
        return $this->belongsTo(RejectReason::class,'internal_reject_reason_id','id')->select('id','reason');
    }

    public function loan_application(){
        return $this->belongsTo(ApplyLoan::class,'apply_loan_id','id');
    }
}
