<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApplyLoan;
use App\Models\FinancePartner;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DateInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SalesReportController extends Controller
{
    public function viewPeriod()
    {
        $partner_id = Session::get('partner_id');

        // $user_query = FinancePartner::where('partner_id','=',$partner_id);
        // if ($loggedin_user->parent_id != 0){
        //     $user_query->where('parent_id','=',$loggedin_user->id);
        // }
        // // $data['all_users'] = $user_query->get();
        // $all_users = $user_query->get();

        $last_six_mont_start_date = Carbon::now()->subMonths(10)->startOfMonth()->format('Y-m-d');
        $date_now = date('Y-m-d');
        $last_six_months = CarbonPeriod::create($last_six_mont_start_date,new DateInterval('P1M'),$date_now);
         
        //month divided in 3 parts
        $months_list = [];
        foreach ($last_six_months as $key=>$month) {
            $dt =  Carbon::create($month);
            $months_list[$key]['month_start_day'] = $dt->startOfMonth()->format('d');
            $months_list[$key]['month_end_day'] = $dt->endOfMonth()->format('d');
            $months_list[$key]['start_date1'] = $dt->startOfMonth()->format('Y-m-d');
            $months_list[$key]['start_date2'] = $dt->startOfMonth()->addDays(10)->format('Y-m-d');
            $months_list[$key]['start_date3'] = $dt->startOfMonth()->addDays(20)->format('Y-m-d');

            $months_list[$key]['month_name'] = $month->format('M');
            $months_list[$key]['month_number'] = $month->format('m');
        }

        return $months_list;
        // $data['months_list'] = $months_list;

        // return view('admin.sales_report.partner-sales-report',$data);
    }

    public function getPartnerSalesReport(Request $request)
    {
        // $request->validate([
        //     'partner_user_id' => 'required',
        //     'date' => 'required',
        // ]);

        $loggedin_user = $request->user();

        $partner_user_id = $request->partner_user_id ?? null;
        $date = $request->date ?? null; 

        $partner_id = Session::get('partner_id');
        if($partner_user_id && $date){
            $partner_user = FinancePartner::where('partner_id',$partner_id)
            ->where('id',$partner_user_id)
            ->where('parent_id',$loggedin_user->id)->first();
            if(!$partner_user){
                return redirect(route('partner-sales-report'))->with('error','Something went wrong.');
            }
    
            $data['applications'] = ApplyLoan::select('*')->whereHas('loan_all_lender_details',function($query) use($partner_id){
                $query->where('status',1)
                ->where('lender_id',$partner_id);
            })->whereHas('assigned_application',function($query) use($partner_user_id,$date){
                $query->where('is_viewed',1)
                ->whereDate('created_at',">=",$date) //assigned greater then this date
                ->where('user_id',$partner_user_id)
                ->groupBY('created_at');
            })
            ->get();
            // return $data['applications'];
            $data['total_received'] = count($data['applications']);
            return $data['applications'];

        }

        $user_query = FinancePartner::where('partner_id','=',$partner_id);
        if ($loggedin_user->parent_id != 0){
            $user_query->where('parent_id','=',$loggedin_user->id);
        }
        $data['all_users'] = $user_query->get();
        $data['months_list'] = $this->viewPeriod();

        // return $applications;
        return view('admin.sales_report.partner-sales-report',$data);
    }
}
