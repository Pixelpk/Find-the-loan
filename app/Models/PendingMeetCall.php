<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingMeetCall extends Model
{
    use HasFactory;

    protected $table = "pending_meet_call";
    protected $fillable = ['partner_id','partner_user_id','apply_loan_id','meet_call_date'];
}
