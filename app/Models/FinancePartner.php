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
}
