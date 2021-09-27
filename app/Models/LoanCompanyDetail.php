<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanCompanyDetail extends Model
{
    use HasFactory;
    protected $table = 'loan_company_details';

    public function loan_company_sector(){
        return $this->belongsTo(Sector::class,'sector_id','id')->select('id','name');
    }

    public function loan_company_structure(){
        return $this->belongsTo(CompanyStructure::class,'company_structure_type_id','id')->select('id','structure_type');
    }
}
