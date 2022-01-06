<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignedApplication extends Model
{
    use HasFactory;

    protected $table = "assigned_applications";

    public static function updateViewedStatus($apply_loan_id,$user_id,$previous_status,$new_status){
        AssignedApplication::where('apply_loan_id', $apply_loan_id)
        ->where('user_id', $user_id)
        ->where('status','=',$previous_status) //0=not viewed, 1= viewed, 2=action performed
        ->update(['status'=>$new_status]);
    }

    public function user(){
        return $this->belongsTo(FinancePartner::class,'user_id','id')->select('id','name');
    }

    public function assigned_by(){
        return $this->belongsTo(FinancePartner::class,'assigned_by','id')->select('id','name');
    }

    public function reject_application(){
        return $this->hasOne(UserLoanRejectReason::class,'partner_id','id');
    }


}
