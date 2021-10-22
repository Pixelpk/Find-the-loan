<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoreDocRequireRequest extends Model
{
    use HasFactory;

    protected $table = "more_docs_require_requests";

    protected $fillable = ['msg_desc_section','quote_additional_doc_idz','user_id','partner_id','apply_loan_id'];
    protected $casts = [
        'msg_desc_section' => 'array',
        'quote_additional_doc_idz' => 'array',
    ];
}
