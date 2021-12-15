<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancePartnerMeta extends Model
{
    use HasFactory;

    protected $table = 'finance_partner_meta';
    protected $casts = ['value'=>'array'];
}
