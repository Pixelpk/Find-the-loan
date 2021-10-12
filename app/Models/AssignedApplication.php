<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignedApplication extends Model
{
    use HasFactory;

    protected $table = "assigned_applications";

    public function user(){
        return $this->belongsTo(FinancePartner::class,'user_id','id')->select('id','name');
    }

    public function reject_application(){
        return $this->hasOne(UserLoanRejectReason::class,'partner_id','id');
    }
}
