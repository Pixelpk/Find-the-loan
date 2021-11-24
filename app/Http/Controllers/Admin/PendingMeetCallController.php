<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApplyLoan;
use App\Models\PendingMeetCall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PendingMeetCallController extends Controller
{
    public function pendingMeetCall(Request $request)
    {
        // return $request->all();
        $request->validate(['apply_loan_id'=>'required|integer']);
        $data = $request->all();
        $data['partner_id'] = Session::get('partner_id');
        $logged_in_user = $request->user();
        $data['partner_user_id'] = $logged_in_user->id;

        $if_application = ApplyLoan::where('id',$data['apply_loan_id'])
        ->whereHas('loan_lender_details',function($query) use ($data){
            $query->where('lender_id',$data['partner_id']);
        })
        ->first();
        if(!$if_application){
            return redirect()->back()->with('error','Oops somthing went wrong');
        }

        $if_already_pending = PendingMeetCall::where('apply_loan_id',$data['apply_loan_id'])
        ->where('partner_id',$data['partner_id'])
        ->first();
        if($if_already_pending){
            return redirect()->back()->with('error','This enquiry is already in your pending meet call list.');
        }
        $pending_meet_call = new PendingMeetCall();
        $pending_meet_call->fill($data)->save();
        return redirect(route('loan-application-summary',['apply_loan_id'=>$data['apply_loan_id']]))
        ->with('success',"Enquiry is successfully added in you pending meet call list.");


    }
}
