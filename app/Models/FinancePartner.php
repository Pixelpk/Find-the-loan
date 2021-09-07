<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancePartner extends Model
{
    use HasFactory;

    protected $table = 'finance_partners';
    protected $fillable = ['image','name','description'];
}
