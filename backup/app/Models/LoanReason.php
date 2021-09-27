<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanReason extends Model
{
    use HasFactory;
    protected $table = 'loan_reasons';
    protected $fillable = ['reason', 'main_type', 'loan_type_id'];
    public function loanType()
    {
        return $this->belongsTo(LoanType::class);
    }
}
