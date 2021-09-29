<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApplyLoan;
use App\Models\AssignedApplication;
use App\Models\CompanyStructure;
use App\Models\FinancePartner;
use App\Models\FinancePartnerMeta;
use App\Models\LoanType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use ZipArchive;

class LoanApplications extends Controller
{
    public function loanApplications(Request $request){
        $data = $request->all();

        $enquiry_id = $data['enquiry_id'] ?? null;
        $loan_type_id = $data['loan_type_id'] ?? null;
        $company_structure_type_id = $data['company_structure_type_id'] ?? null;
        $assigned_user_id = $data['assigned_user_id'] ?? null;
        $from_date = $data['from_date'] ?? null;
        $to_date = $data['to_date'] ?? null;
        if ($from_date != null){
            $request->validate([
                'from_date'=> 'date|date_format:Y-m-d',
            ]);
        }
        if ($to_date != null){
            $request->validate([
                'to_date'=> 'date|date_format:Y-m-d',
            ]);
        }
        $query = ApplyLoan::select('*')
            ->with(['loan_type','loan_company_detail','user_loan_reasons','assigned_application']);
        if ($loan_type_id != null){
            $query->where('loan_type_id','=',$loan_type_id);
        }
        if($enquiry_id != null){
            $query->where('enquiry_id','=',$enquiry_id);
        }
        if ($company_structure_type_id != null){
            $query->whereHas('loan_company_detail', function ($query) use ($company_structure_type_id) {
                $query->where('company_structure_type_id','=',$company_structure_type_id);
            });
        }

        if ($assigned_user_id != null){
            $query->whereHas('assigned_application', function ($query) use ($assigned_user_id) {
                $query->where('user_id','=',$assigned_user_id);
            });
        }

        if ($from_date != null){
                $query->whereDate('created_at','>=',$from_date);
        }
        if ($to_date != null){
            $query->whereDate('created_at','<=',$to_date);
        }

        $data['applications'] = $query->paginate('20');
//        return $data;
        $user = $request->user();
        $partner_id = "";
        if ($user->parent_id == 0){
            $partner_id = $user->id;
        }else{
            $partner_id = $user->parent_id;
        }
        $data['all_users'] = FinancePartner::where('parent_id','=',$partner_id)
            ->where('status','=','1')
            ->get();
        $data['loan_types'] = LoanType::where('status','=','1')
            ->get();
        $data['company_structure'] = CompanyStructure::where('status','=','1')
            ->get();
        $data['enquiry_data'] = FinancePartnerMeta::where('partner_id','=',$partner_id)
            ->pluck('value', 'key_name');

        //setting filter values for pagination
        if($loan_type_id != null){
            $data['applications']->appends(['loan_type_id' => $loan_type_id]);
        }
        if($company_structure_type_id != null){
            $data['applications']->appends(['company_structure_type_id' => $company_structure_type_id]);
        }
        if($assigned_user_id != null){
            $data['applications']->appends(['assigned_user_id' => $assigned_user_id]);
        }
        if ($from_date != null){
            $data['applications']->appends(['from_date' => $from_date]);
        }
        if ($to_date != null){
            $data['applications']->appends(['to_date' => $to_date]);
        }

//        return $data;
        return view('admin.loan_applications.loan_applications',$data);
    }


    public function applicationSearch(Request $request){
        $search = isset($request->search) ? $request->search : '';
        $html = '';
        if ($search != '') {
            $getResults = ApplyLoan::select('*')
                ->where('enquiry_id','like','%'.$search."%")
                ->offset(0)->limit(5)->get();
            // print_r($getResults);
            if(isset($getResults[0])){
                foreach ($getResults as $key => $item) {
                    $full_name = str_replace($search, "<strong>" . $search . "</strong>", $item->product_name);
                    $link = route("loan-applications", ['enquiry_id' => $item->enquiry_id]);
                    $html .= "<a class='search-link' href='" . $link . "'>" . $item->enquiry_id . "</a>";
                }
            }
        }
        return $html;
    }

    public function assignApplication(Request $request){
        $data = $request->all();
        $user = $request->user();
        $partner_id = "";
        if ($user->parent_id == 0){
            $partner_id = $user->id;
        }else{
            $partner_id = $user->parent_id;
        }
        $assign_user_id = $data['user_id'];
        foreach ($data['selected_list'] as $apply_loan_id){
            $application = new AssignedApplication();
            $application->partner_id = $partner_id;
            $application->user_id = $assign_user_id;
            $application->apply_loan_id = $apply_loan_id;
            $application->save();
        }
        Session::flash('success','Applications are assigned to the user');
        return 1;
    }

    public function downloadLoanDoc(Request $request){
        $id = $request->id  ?? null;
        $application = ApplyLoan::where('id','=',$id)->with(['loan_documents','loan_person_share_holder','loan_statements'])->first();
        if (!$application || $id== null){
            return redirect(route('loan-applications'))->with('error','Oops. Something went wrong');
        }

        $zip_file = 'documents.zip';
        $zip = new \ZipArchive();
        $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        $path = storage_path('app/');
        foreach ($application->loan_documents as $key=>$document) {
            $statementFilePath = $path.$document->statement;
            $statement = 'loan_documents/' . $document->statement;
            $zip->addFile($statementFilePath, $statement);

            $latestYearFilePath = $path.$document->latest_year;
            $latest_year = 'loan_documents/' . $document->latest_year;
            $zip->addFile($latestYearFilePath, $latest_year);

            $yearBeforeFilePath = $path.$document->latest_year;
            $year_before = 'loan_documents/' . $document->year_before;
            $zip->addFile($yearBeforeFilePath, $year_before);
        }
        foreach ($application->loan_person_share_holder as $key=>$document) {
            $nricFrontFilePath = $path.$document->nric_front;
            $nric_front = 'person_share_holders/' . $document->nric_front;
            $zip->addFile($nricFrontFilePath, $nric_front);

            $nricBackFilePath = $path.$document->nric_back;
            $nric_back = 'person_share_holders/' . $document->nric_back;
            $zip->addFile($nricBackFilePath, $nric_back);

            $naoLatestFilePath = $path.$document->nao_latest;
            $nao_latest = 'person_share_holders/' . $document->nao_latest;
            $zip->addFile($naoLatestFilePath, $nao_latest);

            $naoOlderFilePath = $path.$document->nao_older;
            $nao_older = 'person_share_holders/' . $document->nao_older;
            $zip->addFile($naoOlderFilePath, $nao_older);

        }

        foreach ($application->loan_statements as $key=>$document) {
            $statementFilePath = $path.$document->statement;
            $file = 'loan_six_month_statements/' . $document->statement;
            $zip->addFile($statementFilePath, $file);

        }
        $zip->close();
        try {
            return response()->download($zip_file);
        }catch (\Exception $exception){
            return redirect(route('loan-applications'))->with('error','Sorry. There are no documents to download');
        }

    }
}
