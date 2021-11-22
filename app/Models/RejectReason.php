<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RejectReason extends Model
{
    use HasFactory;

    protected $table = "reject_reasons";

    public function user_loan_reject(){
        return $this->hasMany(UserLoanReject::class,'internal_reject_reason_id','id');
    }

}
