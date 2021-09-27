<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApplyLoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use ZipArchive;

class LoanApplications extends Controller
{
    public function loanApplications(Request $request){
        $data['applications'] = ApplyLoan::select('*')
            ->with(['loan_type','loan_company_detail','user_loan_reasons'])
            ->paginate('20');
        return view('admin.loan_applications.loan_applications',$data);
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
