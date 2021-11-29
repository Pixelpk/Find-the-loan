<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\RequestMoreDoc;
use App\Models\ApplyLoan;
use App\Models\FinancePartner;
use App\Models\MoreDocMsgDesc;
use App\Models\MoreDocRequireRequest;
use App\Models\QuoteAdditionalDocs;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class MoreDocController extends Controller
{
    public function moreDocRequired(Request $request){
        $loggedin_user = $request->user();
        $partner_id = Session::get('partner_id');
        
        $data['apply_loan_id'] = $request->apply_loan_id ?? null;
        $apply_loan = ApplyLoan::where('id','=',$data['apply_loan_id'])
        ->whereHas('loan_lender_details',function($query) use ($partner_id){
            $query->where('lender_id','=',$partner_id)->where('status',1);
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
        $doc_req = new MoreDocRequireRequest();
        $doc_req->apply_loan_id = $request->apply_loan_id;
        $doc_req->partner_id = Session::get('partner_id');
        $doc_req->user_id = $request->user()->id;
        $doc_req->save();

        $msg_desc_section = $request->msg_desc_section;
        foreach($msg_desc_section as $msg){
            
            $more_doc_msg = new MoreDocMsgDesc();
            $more_doc_msg->more_doc_request_id = $doc_req->id;
            $more_doc_msg->if_any = intval($msg['if_any']);
            $more_doc_msg->from = $msg['from'] ?? null;
            $more_doc_msg->to = $msg['to'] ?? null;
            $more_doc_msg->within_days = $msg['within_days'] ?? null;
            $more_doc_msg->past_months = $msg['past_months'] ?? null;
            $more_doc_msg->valid_for = $msg['valid_for'] ?? null;
            $more_doc_msg->more_doc_reasons = $msg['more_doc_reasons'];
            $more_doc_msg->document_of = $msg['document_of'];
            $more_doc_msg->quote_additional_doc_id = $msg['quote_additional_doc_id'];
            $more_doc_msg->save();
        }

        $finance_partner = FinancePartner::select('id','name','email')->where('id',Session::get('partner_id'))->first();
        $apply_loan = ApplyLoan::where("id", "=", $request->apply_loan_id)
        ->with('loan_user:id,first_name,last_name,email')
        ->first();
        
        try
        {
            Mail::to($apply_loan->loan_user->email)->send(new RequestMoreDoc(['user'=>$apply_loan->loan_user, 'apply_loan'=>$apply_loan,'finance_partner'=>$finance_partner]));
        }
        catch(Exception $ex)
        {
            // dd($ex->getMessage());
        }

        $request->session()->flash('success', "Request for more doc is submitted");
        return array('success'=>1,'redirect'=>route('loan-applications',['profile'=>1]));
    }
}
