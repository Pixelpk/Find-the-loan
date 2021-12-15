<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerMetaRequest extends Model
{
    use HasFactory;
    protected $table = "partner_meta_requests";

    protected $casts = ['requested_data'=>'array']; 

    // public function setRequestedDataAttribute($value){
    //     $this->attributes['requested_data'] = json_encode($value);
    // }
    
    // public function getRequestedDataAttribute($value)
    // {
    //     return json_decode($value);
    // }

    public function finance_partner(){
        return $this->belongsTo(FinancePartner::class,'partner_id','id');
    }
}
