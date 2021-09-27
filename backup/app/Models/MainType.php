<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainType extends Model
{
    use HasFactory;
    public function subTypes()
    {
        return $this->hasMany(LoanType::class);
    }
}
