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

    public function applyLoanStore(Request $request)
    {
        $bankStateMents = (array) $request->last_6_month_bank_statement;
        $otherStatements = (array) $request->last_6_month_statement_another_currency;
        $request['bankStateMents'] = $bankStateMents;
        $request['otherStatements'] = $otherStatements;
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [ 
                'amount' => 'required',
                'loanTypeId' => 'required',
                'reasons' => 'required',
                'company_year' => 'required',
                'company_month' => 'required',
                'number_of_share_holder' => 'required',
                'sector' => 'required',
                'percentage_shareholder' => 'required',
                'company_structure_type' => 'required',
                'number_of_employees' => 'required',
                'bankStateMents' => ["required","array","min:6"],
                'bankStateMents.*' => 'image|mimes:jpg,jpeg,png',
                'otherStatements' => ["required","array","min:6"],
                'otherStatements.*' => 'image|mimes:jpg,jpeg,png',
            ]);
            if ($validator->fails()) {
              return response()->json($validator->errors(), 400);
            }
            
            $company_start_date = $request->company_year.'/'.$request->company_month;
            $revenue = $request->revenue_amount1.'.'.$request->revenue_amount2;
            $applyLoan=ApplyLoan::forceCreate([
                'amount' => $request->amount,
                'loan_type_id' => $request->loanTypeId,
                'user_id' => Auth::guard('web')->user()->id,
                
            ]);
            LoanCompanyDetail::forceCreate([
                'apply_loan_id' => $applyLoan->id,
                'company_start_date' => $company_start_date,
                'revenue' => $revenue,
                'number_of_share_holder' => $request->number_of_share_holder,
                'sector_id' => $request->sector,
                'percentage_shareholder' => $request->percentage_shareholder,
                'company_structure_type_id' => $request->company_structure_type,
                'number_of_employees' => $request->number_of_employees,
                'profitable_latest_year' => $request->profitable_latest_year,
                'profitable_before_year' => $request->profitable_before_year,
                'optional_revenuee' => $request->revenuee,

            ]);
            if(isset($request->reasons)){
                $reasons=explode(',',$request->reasons);
                foreach($reasons as $item){
                    UserLoanReason::forceCreate([
                        'apply_loan_id' => $applyLoan->id,
                        'loan_reason_id' => $item,
                        'loan_type_id' => $request->loanTypeId,
                    ]);
                }                 
            }
            foreach($bankStateMents as $key => $item){
                
               
               
                $filename = uniqid().'statement' . date("Ymd-his") . '.' . $item->getClientOriginalExtension();
               
                $path = $item->move(public_path('/uploads/documents'), $filename);
                LoanStatement::forceCreate([
                    'apply_loan_id' => $applyLoan->id,
                    'statement' => $path,
                    'month' => $key,
                ]);
                
            }
            
            foreach($otherStatements as $key => $item){

                $filename = uniqid().'statement' . date("Ymd-his") . '.' . $item->getClientOriginalExtension();
                $path = $item->move(public_path('/uploads/documents'), $filename);
                LoanStatement::forceCreate([
                    'apply_loan_id' => $applyLoan->id,
                    'statement' => $path,
                    'month' => $key,
                    'other_statement' => 1,
                ]);
            }
           
            $statement = uniqid().'statement' . date("Ymd-his") . '.' . $request->statement->getClientOriginalExtension();
            
            $statement_path = $request->statement->move(public_path('/uploads/documents'), $statement);
           
            if(isset($request->latest_year)){

                $latest_year = uniqid().'latest_year' . date("Ymd-his") . '.' . $request->latest_year->getClientOriginalExtension();
                $latest_year_path = $request->latest_year->move(public_path('/uploads/documents'), $latest_year);

            }


            $year_before = uniqid().'year_before' . date("Ymd-his") . '.' . $request->year_before->getClientOriginalExtension();
            $year_before_path = $request->year_before->move(public_path('/uploads/documents'), $year_before);


            $current_year = uniqid().'current_year' . date("Ymd-his") . '.' . $request->current_year->getClientOriginalExtension();
            $year_current_path = $request->current_year->move(public_path('/uploads/documents'), $current_year);


            $optional_documents = uniqid().'optional_documents' . date("Ymd-his") . '.' . $request->optional_documents->getClientOriginalExtension();
            $year_current_year_path = $request->optional_documents->move(public_path('/uploads/documents'), $optional_documents);


            $reveivable_payable_listing = uniqid().'reveivable_payable_listing' . date("Ymd-his") . '.' . $request->reveivable_payable_listing->getClientOriginalExtension();
            $reveivable_payable_listing_path = $request->reveivable_payable_listing->move(public_path('/uploads/documents'), $reveivable_payable_listing);


            LoanDocument::forceCreate([
                'apply_loan_id' => $applyLoan->id,
                'statement' => $statement_path,
                'latest_year' => isset($request->latest_year) ? $latest_year_path : '',
                'year_before' => $year_before_path,
                'current_year' => $year_current_path,
                'optional_documents' => $year_current_year_path,
                'reveivable_payable_listing' => $reveivable_payable_listing_path,
            ]);
            
            DB::commit();

            return response()->json(['message' => 'Data add successfully'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
        }
        
    }
    
}
