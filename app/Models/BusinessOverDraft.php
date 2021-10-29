<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessOverDraft extends Model
{
    use HasFactory;
    protected $casts = [
        'security_type' => 'array',
    ];
}
