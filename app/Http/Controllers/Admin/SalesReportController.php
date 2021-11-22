<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApplyLoan;
use App\Models\AssignedApplication;
use App\Models\FinancePartner;
use App\Models\RejectReason;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DateInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SalesReportController extends Controller
{
    public function viewPeriod()
    {
        $last_six_mont_start_date = Carbon::now()->subMonths(6)->startOfMonth()->format('Y-m-d');
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
    }

    //last 6 month list in three chunks of a month
    public function salesReportMonthList($mydate)
    {
        $carbon_obj =  Carbon::create($mydate);
        $next_six_mont_start_date = $carbon_obj->addMonths(5)->endOfMonth()->format('Y-m-d');
        $next_six_months = CarbonPeriod::create($mydate,new DateInterval('P1M'),$next_six_mont_start_date);
        
        $months_list = [];
        foreach ($next_six_months as $key=>$month) {
            $chunks = [];
            $dt =  Carbon::create($month);
            $months_list[$key]['month_start_day'] = $dt->startOfMonth()->format('d');
            $months_list[$key]['month_end_day'] = $dt->endOfMonth()->format('d');
            $start_date1_from = $dt->startOfMonth()->format('Y-m-d');
            $start_date1_to = $dt->startOfMonth()->addDays(9)->format('Y-m-d');
            $lable = $dt->startOfMonth()->format('d M')."-".$dt->startOfMonth()->addDays(9)->format('d M');
            array_push($chunks,['start_date_from'=>$start_date1_from, 'start_date_to'=>$start_date1_to,'lable'=>$lable]);

            $start_date2_from = $dt->startOfMonth()->addDays(10)->format('Y-m-d');
            $start_date2_to = $dt->startOfMonth()->addDays(19)->format('Y-m-d');
            $lable = $dt->startOfMonth()->addDays(10)->format('d M')."-".$dt->startOfMonth()->addDays(19)->format('d M');
            array_push($chunks,['start_date_from'=>$start_date2_from, 'start_date_to'=>$start_date2_to,'lable'=>$lable]);

            $start_date3_from = $dt->startOfMonth()->addDays(20)->format('Y-m-d');
            $start_date3_to = $dt->endOfMonth()->format('Y-m-d');
            $lable = $dt->startOfMonth()->addDays(20)->format('d M')."-".$dt->endOfMonth()->format('d M');
            array_push($chunks,['start_date_from'=>$start_date3_from, 'start_date_to'=>$start_date3_to,'lable'=>$lable]);

            $months_list[$key]['month_name'] = $month->format('M');
            $months_list[$key]['year_number'] = $month->format('Y');
            $months_list[$key]['month_number'] = $month->format('m');
            $months_list[$key]['chunks'] = $chunks;
        }

        return $months_list;
    }

    public function getPartnerSalesReport(Request $request)
    {
        $loggedin_user = $request->user();
        $parent_id = $loggedin_user->id;

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

            $months_list = $this->salesReportMonthList(mydate: $date);

            $total_applications = 0;
            foreach($months_list as $key2=>$month){
                foreach($month['chunks'] as $key3=>$chunk){
                    $start_date_from = $chunk['start_date_from'];
                    $start_date_to = $chunk['start_date_to'];

                    if($start_date_from >= $date){
                        $sales_report[$key2][$key3]['start_date_from'] = $start_date_from;
                        $sales_report[$key2][$key3]['start_date_to'] = $start_date_to;
                        $sales_report[$key2][$key3]['lable'] = $chunk['lable'];
    
                        $user_report_data = $this->fetchReportOfUser(parent_id: $parent_id, partner_user_id: $partner_user_id, start_date_to : $start_date_to, start_date_from : $start_date_from);
    
                        $sales_report[$key2][$key3]['user_report_data'] = $user_report_data;
                        $sales_report[$key2][$key3]['total_viewed_applications'] = count($user_report_data->viewed_applications);
                        $sales_report[$key2][$key3]['total_rejected_applications'] = count($user_report_data->user_all_rejected_applications);
                        $sales_report[$key2][$key3]['total_quoted_application'] = count($user_report_data->user_all_quoted_applications);
                        $sales_report[$key2][$key3]['total_more_doc_requests'] = count($user_report_data->user_all_more_doc_requests);
                        $sales_report[$key2][$key3]['total_assigned_out_application'] = count($user_report_data->assigned_out_application);
                        $total_applications += count($user_report_data->assigned_application);
                    }
                    
                }

                //month vise report of user quoted and disbursed loan
                $quoted_and_disbursed = $this->quoted_and_disbursed(parent_id: $parent_id, month_number: $month['month_number'], year_number: $month['year_number'], partner_user_id: $partner_user_id);
                $month_vise[$key2]['month_name'] = $month['month_name'];
                $month_vise[$key2]['quoted'] = $quoted_and_disbursed['quoted'];
                $month_vise[$key2]['rejected'] = $quoted_and_disbursed['rejected'];
                $month_vise[$key2]['reject_reasons'] = $quoted_and_disbursed['reject_reasons'];

            }

            // return $month_vise;
            $data['total_applications'] = $total_applications;
            $data['sales_report'] = $sales_report;
            $data['month_vise'] = $month_vise;

            $data['selected_user'] = $partner_user_id ?? null;
            $data['selected_period'] = $date ?? null;

        }
        // return $data;
        
        $data['all_users'] = FinancePartner::where('partner_id','=',$partner_id)
        ->where('parent_id','=',$loggedin_user->id)
        ->get();
        $data['months_list'] = $this->viewPeriod();

        return view('admin.sales_report.partner-sales-report',$data);
    }

    public function quoted_and_disbursed($partner_user_id,$parent_id,$month_number,$year_number)
    {
        $quoted_and_disbursed =  FinancePartner::select('id','partner_id','parent_id','name')->where('id',$partner_user_id)
        ->where('parent_id',$parent_id)
        ->with('user_all_quoted_applications',function($query) use($month_number, $year_number){
            $query->whereMonth('created_at',$month_number)
            ->whereYear('created_at',$year_number);
        })
        // ->with('user_all_rejected_applications',function($query) use($month_number){
        //     $query->whereMonth('created_at',$month_number);         
        // })
        ->first();

        $reject_reasons = RejectReason::select('id','reason')
        ->whereHas('user_loan_reject',function($query) use ($partner_user_id,$month_number,$year_number){
            $query->where('user_id',$partner_user_id)
            ->whereMonth('created_at',$month_number)
            ->whereYear('created_at',$year_number);
        })->with('user_loan_reject')
        ->get();
        // dd($reject_reasons);


        //quotation part
        $total_loan_quoted = 0;
        $quoted_average_interest = 0;
        $quoted_average_tenure = 0;
        foreach($quoted_and_disbursed->user_all_quoted_applications as $quote){
            $total_loan_quoted+= $quote->quantum_interest->quantum ?? 0;
            $quoted_average_interest+= $quote->fixed->interest->interest_pa ?? 0;
            $quoted_average_tenure+= isset($quote->fixed->tenure->years) ? ($quote->fixed->tenure->years*12) + $quote->fixed->tenure->months  : 0;
        }
        $quoted_count = count($quoted_and_disbursed->user_all_quoted_applications);
        $quoted = [
            'total_loan_quoted'=>$total_loan_quoted,
            'quoted_count'=>$quoted_count,
            'quoted_average_loan_size'=>$quoted_count > 0 ? ($total_loan_quoted / $quoted_count) : 0,
            'quoted_average_interest'=>($quoted_average_interest * $quoted_count)/100,
            'quoted_average_tenure' => $quoted_average_tenure ? ($quoted_average_tenure * 12) : 0,
        ];
        //end quotation part

        //reject enquires(loan applications) part

        return array(
            'quoted'=> $quoted,
            'rejected'=> [],
            'reject_reasons'=> $reject_reasons,
        );

    }

    public function fetchReportOfUser($partner_user_id, $parent_id,$start_date_from,$start_date_to){

        return FinancePartner::select('id','partner_id','parent_id','name')->where('id',$partner_user_id)
        ->where('parent_id',$parent_id)
        ->with('assigned_application',function($query) use($start_date_from,$start_date_to){
            $query->whereDate('created_at',">=",$start_date_from) //assigned greater then this date
            ->whereDate('created_at',"<=",$start_date_to); //assigned less then this date                        
        })
        ->with('viewed_applications',function($query) use($start_date_from,$start_date_to){
            $query->whereDate('created_at',">=",$start_date_from) //assigned greater then this date
            ->whereDate('created_at',"<=",$start_date_to); //assigned less then this date     
        })
        ->with('user_all_rejected_applications',function($query) use($start_date_from,$start_date_to){
            $query->whereDate('created_at',">=",$start_date_from) //assigned greater then this date
            ->whereDate('created_at',"<=",$start_date_to); //assigned less then this date                        
        })->with('user_all_quoted_applications',function($query) use($start_date_from,$start_date_to){
            $query->whereDate('created_at',">=",$start_date_from) //assigned greater then this date
            ->whereDate('created_at',"<=",$start_date_to); //assigned less then this date                        
        })->with('user_all_more_doc_requests',function($query) use($start_date_from,$start_date_to){
            $query->whereDate('created_at',">=",$start_date_from) //assigned greater then this date
            ->whereDate('created_at',"<=",$start_date_to); //assigned less then this date                        
        })->with('assigned_out_application',function($query) use($start_date_from,$start_date_to){
            $query->whereDate('created_at',">=",$start_date_from) //assigned greater then this date
            ->whereDate('created_at',"<=",$start_date_to);
        })
        ->first();

    }
}
