<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoreDocRequireRequest extends Model
{
    use HasFactory;

    protected $table = "more_docs_require_requests";

    protected $fillable = ['user_id','partner_id','apply_loan_id'];

    public function loan_application()
    {
        return $this->belongsTo(ApplyLoan::class,'apply_loan_id','id')->with('loan_user','loan_type','loan_reason');
    }

    public function loan_company_detail(){
        return $this->hasOne(LoanCompanyDetail::class,'apply_loan_id','id')->with(['loan_company_sector','loan_company_structure']);
    }

    public function more_doc_msg_desc(){
        return $this->hasMany(MoreDocMsgDesc::class,'more_doc_request_id','id')->with('quote_additional_doc');
    }

    public function finance_partner(){
        return $this->belongsTo(FinancePartner::class,'partner_id','id');
    }

    public function replied_doc_details()
    {
        return $this->hasOne(RepliedWithDocs::class,'more_doc_request_id','id');
    }

}
