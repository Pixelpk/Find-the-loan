<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoreDocMsgDesc extends Model
{
    use HasFactory;

    protected $table = "more_doc_msg_desc";
    protected $fillable = [
        'more_doc_request_id',
        'if_any',
        'from',
        'to',
        'within_days',
        'past_months',
        'valid_for',
        'more_doc_reasons',
        'document_of',
        'quote_additional_doc_id',
    ];

    protected $casts = ['more_doc_reasons'=>'array'];

    public function quote_additional_doc(){
        return $this->belongsTo(QuoteAdditionalDocs::class,'quote_additional_doc_id','id');
    }
}
