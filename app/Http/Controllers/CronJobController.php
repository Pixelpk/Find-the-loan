<?php

namespace App\Http\Controllers;

use App\Mail\IncompleteSignupReminder;
use App\Mail\NoQuoteDueToCredit;
use Illuminate\Http\Request;
use App\Models\ApplyLoan;
use App\Models\LoanLenderDetail;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Mail;

class CronJobController extends Controller
{
    public function applicationsNoActionCronJob(Request $request)
    {
        // return Carbon::today()->subDays(14);
        //Lead will be removed after 14 days if no action is taken 
        $fourteen_day_applications = ApplyLoan::whereHas('loan_all_lender_details') //where status is 1
        ->whereDate('created_at', '<', Carbon::today()->subDays(14))
        ->with('loan_all_lender_details',function($query){
            $query->where('status',1)->whereDoesntHave('application_rejected')
            ->whereDoesntHave('application_quote')
            ->whereDoesntHave('application_more_doc');
        })
        ->get();
        foreach($fourteen_day_applications as $application){
            foreach($application->loan_all_lender_details as $loan_lender){
                $loan_lender_details = LoanLenderDetail::where('id',$loan_lender->id)
                ->first();
                $loan_lender_details->status = 2; //deleted
                // $loan_lender_details->save();
            }
        }
        //---------------------------------

        // echo Carbon::today()->subDays(30);exit;
        //30 days after last action -  Leads in Loan Disbursed folder will be available for 12 months
        $thirty_day_applications = ApplyLoan::whereHas('loan_all_lender_details') //where status is 1
        
        ->with('loan_all_lender_details',function($query){
            $query->where('status',1)->whereHas('application_rejected',function($query){
                $query->whereDate('created_at', '<', Carbon::today()->subDays(30));
            });
        })
        ->get();
        foreach($thirty_day_applications as $application){
            foreach($application->loan_all_lender_details as $loan_lender){
                $loan_lender_details = LoanLenderDetail::where('id',$loan_lender->id)
                ->first();
                $loan_lender_details->status = 2; //deleted
                $loan_lender_details->save();
            }
        }
        // return $thirty_day_applications;
        //-----------------------------------------------------

        //Send email to user if it's been 3 days loan is applied but no on quoted on his Loan application
        $no_one_quoted_applications = ApplyLoan::whereDate('created_at', '<', Carbon::today()->subDays(3))
        ->whereNull('no_quoted_mail')
        ->with('loan_user:id,first_name,last_name,email')
        ->whereHas('loan_all_lender_details')
        // ->whereDoesntHave('application_rejected')
        ->whereDoesntHave('application_quote')
        // ->whereDoesntHave('application_more_doc')
        ->get();
        if(sizeof($no_one_quoted_applications)){
            foreach($no_one_quoted_applications as $application){
                $updated_application = ApplyLoan::find($application->id);
                $updated_application->no_quoted_mail = date('Y-m-d h:i');
                try{
                    Mail::to($application->loan_user->email)->send(new NoQuoteDueToCredit(['user'=>$application->loan_user, 'apply_loan'=>$application]));
                }
                catch(Exception $ex)
                {
                    // dd($ex->getMessage());
                }
            }
        }
        return $no_one_quoted_applications;
            
    }

    public function incompleteSignupReminder()
    {
        $users = User::where('status',3)
        ->whereDate('created_at', '<', Carbon::today()->subDays(2))
        ->whereNull('incomplete_registration_mail')
        ->get();
        // return $users;

        foreach($users as $user){
            $update_user = User::find($user->id);
            $update_user->incomplete_registration_mail = date('Y-m-d h:i');
            $update_user->save();
            try 
            {
                Mail::to($user->email)->send(new IncompleteSignupReminder($user));
            }
            catch(Exception $ex)
            {
                dd($ex->getMessage());
            }
        }
    }
}
