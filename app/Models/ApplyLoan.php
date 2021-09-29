<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    public function assigned_application(){
        $user = Auth::user();
        $partner_id = "";
        if ($user->parent_id == 0){
            $partner_id = $user->id;
        }else{
            $partner_id = $user->parent_id;
        }
        return $this->hasOne(AssignedApplication::class,'apply_loan_id','id')->where('partner_id','=',$partner_id)->with('user');
    }
}
