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

    public function customer_reject_reason()
    {
        return $this->belongsTo(RejectReason::class,'customer_reject_reason_id','id')->select('id','reason');
    }

    public function internal_reject_reason()
    {
        return $this->belongsTo(RejectReason::class,'internal_reject_reason_id','id')->select('id','reason');
    }
}
