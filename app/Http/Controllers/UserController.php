<?php

namespace App\Http\Controllers;

use App\Models\ApplyLoan;
use App\Models\CompanyStructure;
use App\Models\LoanCompanyDetail;
use App\Models\LoanDocument;
use App\Models\LoanReason;
use App\Models\LoanReasonDetail;
use App\Models\LoanStatement;
use App\Models\MainType;
use App\Models\Sector;
use App\Models\UserLoanReason;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function applyLoan(Request $request)
    {
     
        $mainTypes=MainType::where('profile_id', $request->profile)->get();
        if(isset($request->loanTypeId))
        {
            $loanReasons=LoanReason::where('loan_type_id', $request->loanTypeId)->get();
        }
        isset($loanReasons) ? $loanReasons : $loanReasons =[];
        return view('cms.apply-loan')
        ->with('mainTypes', $mainTypes)
        ->with('loanReasons', $loanReasons);
    }

    

    public function loanReason(Request $request)
    {
        
        $loanReasons = LoanReason::where('loan_type_id', $request->id)->where('status', 1)->get();
        $sector = Sector::where('status', 1)->get();
        $company_structure = CompanyStructure::where('status', 1)->get();
        return view('cms.ajax.loan-reason')
        ->with('sector', $sector)
        ->with('company_structure', $company_structure)
        ->with('loanReasons', $loanReasons);
        
    }

    
    
}
