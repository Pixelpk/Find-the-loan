<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLoanReason extends Model
{
    use HasFactory;
    protected $table = 'user_loan_reasons';

    public function loan_reason(){
        return $this->belongsTo(LoanReason::class,'loan_reason_id','id');
    }
}
