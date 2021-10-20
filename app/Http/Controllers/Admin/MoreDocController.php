<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApplyLoan;
use App\Models\QuoteAdditionalDocs;
use Illuminate\Http\Request;

class MoreDocController extends Controller
{
    public function moreDocRequired(Request $request){
        $data['apply_loan_id'] = $request->apply_loan_id ?? null;
        $apply_loan = ApplyLoan::where('id','=',$data['apply_loan_id'])
        ->first();
        if(!$apply_loan || ($data['apply_loan_id'] == null)){
            return redirect()->back()->with('error','Oops. something went wrong.');
        }
        $data['additional_docs'] = QuoteAdditionalDocs::all()->groupBy('info_type');
        // foreach($additional_docs as $key =>$info){
        //     echo $key."<pre>";
        // }
        // return $additional_docs;
        return view('admin.loan_applications.more_doc_required',$data);
    }
}
