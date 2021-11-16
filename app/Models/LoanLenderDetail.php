<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanLenderDetail extends Model
{
    use HasFactory;

    public function application_rejected(){
        return $this->belongsTo(UserLoanReject::class,'lender_id','partner_id');
    }

    public function application_quote(){
        return $this->belongsTo(LoanQuotations::class,'lender_id','partner_id');
    }

    public function application_more_doc(){
        return $this->belongsTo(MoreDocRequireRequest::class,'lender_id','partner_id');
    }

}
