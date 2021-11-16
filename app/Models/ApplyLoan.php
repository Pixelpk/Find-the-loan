<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ApplyLoan extends Model
{
    use HasFactory;


    public function loan_user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function loan_type(){
        return $this->belongsTo(LoanType::class,'loan_type_id');
    }

    public function loan_company_detail(){
        return $this->hasOne(LoanCompanyDetail::class,'apply_loan_id','id')->with(['loan_company_sector','loan_company_structure']);
    }

    public function user_loan_reasons(){
        return $this->hasMany(UserLoanReason::class,'apply_loan_id','id')->with('loan_reason');
    }

    public function loan_reason(){
        return $this->belongsTo(LoanReason::class,'reason_id','id');
    }


    public function loan_documents(){
        return $this->hasMany(LoanDocument::class,'apply_loan_id','id');
    }

    public function loan_person_share_holder(){
        return $this->hasMany(LoanPersonShareHolder::class,'apply_loan_id','id');
    }

    public function loan_statements(){
        return $this->hasMany(LoanStatement::class,'apply_loan_id','id');
    }

    public function assigned_application(){
        return $this->hasOne(AssignedApplication::class,'apply_loan_id','id')->with(['user']);
    }

    public function assigned_by_application(){
        $loggedin_user = Auth::user();
        return $this->hasOne(AssignedApplication::class,'apply_loan_id','id')
            ->where('assigned_by','=',$loggedin_user->id)->with('user');
    }

    public function parentCompany(){
        return $this->belongsTo(LoanCompanyDetail::class,'id', 'apply_loan_id')->where('share_holder', 0);
    }

    public function getNnumberOfShareHolder(){
        return $this->hasMany(ShareHolderDetail::class,'apply_loan_id', 'id');
    }

    public function application_rejected(){
        return $this->hasOne(UserLoanReject::class,'apply_loan_id','id')->with(['rejected_by','customer_reject_reason','internal_reject_reason']);
    }

    public function application_quote(){
        return $this->hasOne(LoanQuotations::class,'apply_loan_id','id');
    }

    public function quotations_of_application(){
        return $this->hasMany(LoanQuotations::class,'apply_loan_id','id');
    }

    public function loan_lenders_cbs_member_image(){
        return $this->hasOne(LoanLender::class,'apply_loan_id','id');
    }

    public function loan_lender_details(){
        return $this->hasOne(LoanLenderDetail::class,'apply_loan_id','id');
    }

    public function loan_all_lender_details(){
        return $this->hasMany(LoanLenderDetail::class,'apply_loan_id','id')
        ->with(['application_rejected','application_quote','application_more_doc']);
    }

    public function application_more_doc(){
        return $this->hasMany(MoreDocRequireRequest::class,'apply_loan_id','id')->with('more_doc_msg_desc');
    }

}
