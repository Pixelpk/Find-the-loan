<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepliedWithDocs extends Model
{
    use HasFactory;

    protected $fillable = ['more_doc_request_id','apply_loan_id','replied_docs','dont_have_doc'];

    protected $table = "replied_with_docs";

    protected $appends = ['dont_have_doc_list'];

    public function setRepliedDocsAttribute($value){
        $this->attributes['replied_docs'] = json_encode($value);
    }
    public function getRepliedDocsAttribute($value){
        return json_decode($value);
    }

    public function setDontHaveDocAttribute($value){
        $this->attributes['dont_have_doc'] = json_encode($value);
    }
    public function getDontHaveDocAttribute($value){
        return json_decode($value);
    }

    public function getDontHaveDocListAttribute(){
        return QuoteAdditionalDocs::whereIn('id',$this->dont_have_doc)->get();
    }

    public function loan_application(){
        return $this->belongsTo(ApplyLoan::class,'apply_loan_id','id');
    }

    public function more_doc_request_details()
    {
        return $this->belongsTo(MoreDocRequireRequest::class,'more_doc_request_id','id');
    }

}
