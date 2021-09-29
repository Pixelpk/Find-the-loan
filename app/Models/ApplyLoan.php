<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function loan_documents(){
        return $this->hasMany(LoanDocument::class,'apply_loan_id','id');
    }

    public function loan_person_share_holder(){
        return $this->hasMany(LoanPersonShareHolder::class,'apply_loan_id','id');
    }

    public function loan_statements(){
        return $this->hasMany(LoanStatement::class,'apply_loan_id','id');
    }

    public function parentCompany(){
        return $this->belongsTo(LoanCompanyDetail::class,'id', 'apply_loan_id')->where('share_holder', 0);
    }
}
