<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\FinancePartner as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class FinancePartner extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guard = 'partners';
    protected $hidden = [
        'password',
    ];

    protected $table = 'finance_partners';
    protected $fillable = ['partner_id','parent_id','role_id','terms_condition','requested_terms_condition','designation','type','name','email','password','phone','description',
        'min_quantum','max_quantum','company_structure_id','loan_type_id','length_of_incorporation','equipment_types','property_types',
        'local_shareholding','subsidiaries','cbs_member','image','status'];

    public function assigned_application(){
        return $this->hasMany(AssignedApplication::class,'user_id','id');
    }

    public function viewed_applications(){
        return $this->hasMany(AssignedApplication::class,'user_id','id')->whereNotNull('viewed_at');
    }

    public function assigned_out_application(){
        return $this->hasMany(AssignedApplication::class,'assigned_by','id');
    }

    public function user_all_rejected_applications()
    {
        return $this->hasMany(UserLoanReject::class,'user_id','id');
    }

    public function user_all_quoted_applications()
    {
        return $this->hasMany(LoanQuotations::class,'quoted_by','id');
    }

    public function user_all_more_doc_requests()
    {
        return $this->hasMany(MoreDocRequireRequest::class,'user_id','id');
    }

}
