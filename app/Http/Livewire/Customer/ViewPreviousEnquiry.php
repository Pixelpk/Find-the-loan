<?php

namespace App\Http\Livewire\Customer;

use App\Models\ApplyLoan;
use App\Models\Media;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ViewPreviousEnquiry extends Component
{
    public $user;
    public $enquiry;

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function render()
    {
        $this->enquiry = ApplyLoan::where('user_id',$this->user->id)
        ->where('status',1)
        ->orderBy('id','desc')
        ->with(['loan_type','loan_reason','loan_documents','loan_statements','loan_company_detail','loan_person_share_holder','parentCompany','loan_lenders_cbs_member_image'])
        ->first();
        return view('livewire.customer.view-previous-enquiry')->layout('customer.layouts.master');
    }

    public function downloadDoc()
    {
        $application_docs = Media::where('apply_loan_id', $this->enquiry->id)->get()->groupBy('model');

        $zip_file = 'documents.zip';
        $zip = new \ZipArchive();
        $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        $path = storage_path('app/');
        foreach ($application_docs as $model_key => $docs) {
            $models_explode = explode("\\", $model_key);
            // return $models_explode;
            $folder_name = $models_explode[2]; //make model name as folder name
            foreach ($docs as $docs_key => $doc) {
                $file_path = $path . "/" . $doc->image;
                $file = $folder_name . '/' . $doc->orignal_name;
                $zip->addFile($file_path, $file);
            }
        }
        // return $application;

        foreach ($this->enquiry->loan_person_share_holder as $key => $document) {
            if ($document->nric_front) {
                $nricFrontFilePath = $path . $document->nric_front;
                $nric_front = 'PersonShareHolders/' . $document->nric_front;
                $zip->addFile($nricFrontFilePath, $nric_front);
            }

            if ($document->nric_back) {
                $nricBackFilePath = $path . $document->nric_back;
                $nric_back = 'PersonShareHolders/' . $document->nric_back;
                $zip->addFile($nricBackFilePath, $nric_back);
            }

            if ($document->nao_latest) {
                $naoLatestFilePath = $path . $document->nao_latest;
                $nao_latest = 'PersonShareHolders/' . $document->nao_latest;
                $zip->addFile($naoLatestFilePath, $nao_latest);
            }

            if ($document->nao_older) {
                $naoOlderFilePath = $path . $document->nao_older;
                $nao_older = 'PersonShareHolders/' . $document->nao_older;
                $zip->addFile($naoOlderFilePath, $nao_older);
            }
        }
        if ($this->enquiry->loan_company_detail != null && $this->enquiry->loan_company_detail->subsidiary != "") {
            $companyDetailDocPath = $path . $this->enquiry->loan_company_detail->subsidiary;
            $companyDocument = 'LoanCompanyDetail/' . $this->enquiry->loan_company_detail->subsidiary;
            $zip->addFile($companyDetailDocPath, $companyDocument);
        }
        if ($this->enquiry->loan_lenders_cbs_member_image != null && $this->enquiry->loan_lenders_cbs_member_image->cbs_member_image != "") {
            $companyDetailDocPath = $path . $this->enquiry->loan_lenders_cbs_member_image->cbs_member_image;
            $cbdMemberImage = 'LoanLenderCbsMemberImage/' . $this->enquiry->loan_lenders_cbs_member_image->cbs_member_image;
            $zip->addFile($companyDetailDocPath, $cbdMemberImage);
        }
        $zip->close();
        try {
            return response()->download($zip_file);
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Sorry. There are no documents to download');
        }

    }
}
