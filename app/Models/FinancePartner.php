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
        'min_quantum','max_quantum','company_structure_id','loan_type_id','length_of_incorporation',
        'local_shareholding','subsidiaries','cbs_member','image','status'];
}
