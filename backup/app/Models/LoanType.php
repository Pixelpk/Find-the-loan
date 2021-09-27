<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanType extends Model
{
    use HasFactory;
    protected $table = 'loan_types';
    public function mainType()
    {
        return $this->belongsTo(MainType::class, 'main_type_id', 'id');
    }
}
