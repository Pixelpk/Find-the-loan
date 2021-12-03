<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteAdditionalDocs extends Model
{
    use HasFactory;
    protected $table = "quote_additional_docs";
    protected $fillable  = ['info_type','input_key','info','doc_type','additional_description'];
}
