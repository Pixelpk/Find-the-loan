<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $table = 'user_details';
    protected $fillable = ['user_id','is_vaccinated','vaccination_updated','covid_test_amount','work_description','hourly_rate'];
}
