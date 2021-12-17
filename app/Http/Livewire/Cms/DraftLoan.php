<?php

namespace App\Http\Livewire\Cms;

use App\Models\ApplyLoan as ModelsApplyLoan;
use App\Models\CompanyStructure;

use App\Models\LoanCompanyDetail;
use App\Models\LoanDocument;
use App\Models\LoanPersonShareHolder;
use App\Models\LoanReason;
use App\Models\LoanStatement;
use App\Models\LoanType;
use App\Models\MainType;
use App\Models\Sector;
use App\Models\ApplyLoan;
use App\Models\ShareHolderDetail;
use App\Models\UserLoanReason;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\LoanGernalInfo;
use App\Models\LoanLender;
use App\Models\LoanLenderDetail;
use App\Models\Media;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Config;

use File;
class DraftLoan extends Component
{

    public $user;
    // public $getLoans;
    public $profile;

    protected $queryString = ['profile'];

    public function mount()
    {
        $this->user = Auth::user();
        // dd($this->profile);
        // if($this->profile != 1 && $this->profile != 2){
        //     return redirect(route('applyLoan'));
        // }

    }


    public function render()
    {
        $getLoans = ApplyLoan::where('user_id', $this->user->id)
        ->with(['loan_type.mainType','loan_company_detail','loan_reason'])
        ->where('status', 0)
        ->orderBy('id','desc')
        ->paginate(10);
        // $getLoans->appends(['profile' => $this->profile]);
        // dd($getLoans);
        return view('livewire.cms.draft-loan',['getLoans' => $getLoans])->layout('cms.layouts.master');;
    }

   

}
