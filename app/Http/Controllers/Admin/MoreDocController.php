<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApplyLoan;
use App\Models\MoreDocRequireRequest;
use App\Models\QuoteAdditionalDocs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MoreDocController extends Controller
{
    public function moreDocRequired(Request $request){
        $loggedin_user = $request->user();
        $partner_id = Session::get('partner_id');
        
        $data['apply_loan_id'] = $request->apply_loan_id ?? null;
        $apply_loan = ApplyLoan::where('id','=',$data['apply_loan_id'])
        ->whereHas('loan_lender_details',function($query) use ($partner_id){
            $query->where('lender_id','=',$partner_id);
        })
        ->first();
        if(!$apply_loan || ($data['apply_loan_id'] == null)){
            return redirect()->back()->with('error','Oops. something went wrong.');
        }
        $data['additional_docs'] = QuoteAdditionalDocs::all()->groupBy('info_type');

        return view('admin.loan_applications.more_doc_required',$data);
    }

    public function moreDocRequest(Request $request)
    {
        // dd($request->all());
        // return MoreDocRequireRequest::where('id',14)->first();
        $doc_req = new MoreDocRequireRequest();
        $doc_req->apply_loan_id = $request->apply_loan_id;
        // $doc_req->quote_additional_doc_idz = $request->quote_additional_doc_idz;
        $doc_req->msg_desc_section = $request->msg_desc_section;
        $doc_req->partner_id = Session::get('partner_id');
        $doc_req->user_id = $request->user()->id;
        $doc_req->save();
        $request->session()->flash('success', "Request for more doc is submitted");
        return array('success'=>1,'redirect'=>route('loan-applications',['profile'=>1]));
    }
}
