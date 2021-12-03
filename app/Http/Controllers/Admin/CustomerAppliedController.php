<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoanQuotations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomerAppliedController extends Controller
{

    public function customerApplied(Request $request)
    {
        $partner_id = Session::get('partner_id');        
        $data['quotations'] = $this->getCustomerAppliedQuotations(partner_id: $partner_id, status:1);
        return view('admin.customer_applied.customer_applied',$data);
    }

    public function getCustomerAppliedQuotations($status,$partner_id)
    {
        return LoanQuotations::Query()
        ->where('partner_id',$partner_id)
        ->where('status',$status)
        ->with(['loan_application'])->paginate(20);
    }

    public function loanOfferSigned()
    {
        $partner_id = Session::get('partner_id');
        $data['quotations'] = $this->getCustomerAppliedQuotations(partner_id: $partner_id, status:3);

        // return $data;
        return view('admin.customer_applied.loan_offer_signed',$data);
    }

    public function loanOfferDisbursed(Request $request)
    {
        $partner_id = Session::get('partner_id');
        $data['quotations'] = $this->getCustomerAppliedQuotations(partner_id: $partner_id, status:4);
        return view('admin.customer_applied.loan_offer_disbursed',$data);

    }

    public function loanOfferSignAndDisbursed(Request $request){
        $loggedin_user = $request->user();
        $partner_id = Session::get('partner_id');

        $quote_id = $request->quote_id ?? null;
        $status = $request->status ?? null;
        if(($quote_id == null || $status == null) || !in_array($status,['3','4'])){
            return redirect()->back('error','Oops. something went wrong.');
        }
        
        $quotation = LoanQuotations::Query()
        ->where('partner_id',$partner_id)
        ->where('id',$request->quote_id)
        ->whereNotNull('status') //if quotation is accepted
        ->first();

        if((!$quotation || $quotation->status == $status) || (($status == '3' && $quotation->status != '1') || ($status == '4' && $quotation->status != '3'))){
            return redirect()->back()->with('error','Oops. something went wrong');
        }

        if($status == 3){
            $quotation->offer_signed_at = date('Y-m-d H:i');
            $message = "Enquiry status is changed to Loan Offer signed.";
        }else{
            $message = "Enquiry status is changed to Loan Offer disbursed.";
            $quotation->offer_disbursed_at = date('Y-m-d H:i');
        }

        // return "i am here";

        $quotation->status = $status; //3=loan offer signed, 4=loan offer disbursed
        $quotation->save();

        return redirect()->back()->with('success',$message); 


    }
}
