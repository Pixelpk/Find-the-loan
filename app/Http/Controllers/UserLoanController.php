<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\ApplyLoan;
use App\Models\LoanCompanyDetail;
use App\Models\LoanDocument;
use App\Models\LoanPersonShareHolder;
use App\Models\LoanStatement;
use App\Models\UserLoanReason;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserLoanController extends Controller
{
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

            if(isset($request->current_year)){
                $current_year = uniqid().'current_year' . date("Ymd-his") . '.' . $request->current_year->getClientOriginalExtension();
                $year_current_path = $request->current_year->move(public_path('/uploads/documents'), $current_year);
            }

            if(isset($request->optional_documents)){
                $optional_documents = uniqid().'optional_documents' . date("Ymd-his") . '.' . $request->optional_documents->getClientOriginalExtension();
                $year_current_year_path = $request->optional_documents->move(public_path('/uploads/documents'), $optional_documents);
            }

            if($request->reveivable_payable_listing){

                $reveivable_payable_listing = uniqid().'reveivable_payable_listing' . date("Ymd-his") . '.' . $request->reveivable_payable_listing->getClientOriginalExtension();
                $reveivable_payable_listing_path = $request->reveivable_payable_listing->move(public_path('/uploads/documents'), $reveivable_payable_listing);
            }


            LoanDocument::forceCreate([
                'apply_loan_id' => $applyLoan->id,
                'statement' => $statement_path,
                'latest_year' => isset($request->latest_year) ? $latest_year_path : '',
                'year_before' => $year_before_path,
                'current_year' => isset($request->current_year) ?  $year_current_path : '',
                'optional_documents' => isset($request->optional_documents) ?  $year_current_year_path : '',
                'reveivable_payable_listing' => isset($request->reveivable_payable_listing) ? $reveivable_payable_listing_path : '',
            ]);
            
            DB::commit();

            return response()->json(['message' => 'Data add successfully', 'apply_loan_id' => $applyLoan->id], 200);
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
        }
        
    }
    public function shareHolderScreen(Request $request)
    {
        $companyDetail = LoanCompanyDetail::where('apply_loan_id', $request->id)->where('share_holder', 0)->first();
        return view('cms.ajax.share-holder')->with('companyDetail', $companyDetail);
    }
    public function shareHolderStore(Request $request)
    {
        
        $count = $request->countShareHolder + 1;
        DB::beginTransaction();
        try {
            if($count  >= 3){
               
                $validator = Validator::make($request->all(), [ 
                    'nric_front' => ["required","array","min:3"],
                    'nric_front.*' => 'image|mimes:jpg,jpeg,png',

                    'nric_back' => ["required","array","min:3"],
                    'nric_back.*' => 'image|mimes:jpg,jpeg,png',

                    'nao_latest' => ["required","array","min:3"],
                    'nao_latest.*' => 'image|mimes:jpg,jpeg,png',

                    'nao_older' => ["required","array","min:3"],
                    'nao_older.*' => 'image|mimes:jpg,jpeg,png',

                    'cbs' => ["required","array","min:3"],
                    'cbs.*' => 'image|mimes:jpg,jpeg,png',
                ]);
            }

            if($count  == 2){
                $validator = Validator::make($request->all(), [ 
                    'nric_front' => ["required","array","min:2"],
                    'nric_front.*' => 'image|mimes:jpg,jpeg,png',

                    'nric_back' => ["required","array","min:2"],
                    'nric_back.*' => 'image|mimes:jpg,jpeg,png',

                    'nao_latest' => ["required","array","min:2"],
                    'nao_latest.*' => 'image|mimes:jpg,jpeg,png',

                    'nao_older' => ["required","array","min:2"],
                    'nao_older.*' => 'image|mimes:jpg,jpeg,png',

                    'nao_older' => ["required","array","min:2"],
                    'nao_older.*' => 'image|mimes:jpg,jpeg,png',
                ]);
            }

            if($count  == 1){
                $validator = Validator::make($request->all(), [ 
                    'nric_front' => ["required","array","min:1"],
                    'nric_front.*' => 'image|mimes:jpg,jpeg,png',

                    'nric_back' => ["required","array","min:1"],
                    'nric_back.*' => 'image|mimes:jpg,jpeg,png',

                    'nao_latest' => ["required","array","min:1"],
                    'nao_latest.*' => 'image|mimes:jpg,jpeg,png',

                    'nao_older' => ["required","array","min:1"],
                    'nao_older.*' => 'image|mimes:jpg,jpeg,png',

                    'nao_older' => ["required","array","min:1"],
                    'nao_older.*' => 'image|mimes:jpg,jpeg,png',
                ]);
            }

         

            if ($validator->fails()) {
              return response()->json($validator->errors(), 400);
            }
          
            foreach($request->nric_front as $key => $item){

                $nric_front = uniqid().'shareholder' . date("Ymd-his") . '.' . $item->getClientOriginalExtension();
                $nric_front_path = $item->move(public_path('/uploads/shareholder'), $nric_front);

                $nric_back = uniqid().'shareholder' . date("Ymd-his") . '.' . $request->nric_back[$key]->getClientOriginalExtension();
                $nric_back_path = $request->nric_back[$key]->move(public_path('/uploads/shareholder'), $nric_back);

                $nao_latest = uniqid().'shareholder' . date("Ymd-his") . '.' . $request->nao_latest[$key]->getClientOriginalExtension();
                $nao_latest_path = $request->nao_latest[$key]->move(public_path('/uploads/shareholder'), $nao_latest);


                $nao_older = uniqid().'shareholder' . date("Ymd-his") . '.' . $request->nao_older[$key]->getClientOriginalExtension();
                $nao_older_path = $request->nao_older[$key]->move(public_path('/uploads/shareholder'), $nao_older);

                $cbs = uniqid().'shareholder' . date("Ymd-his") . '.' . $request->cbs[$key]->getClientOriginalExtension();
                $cbs_path = $request->cbs[$key]->move(public_path('/uploads/shareholder'), $cbs);


                LoanPersonShareHolder::forceCreate([
                    'apply_loan_id' => 1,
                    'nric_front' => $nric_front_path,
                    'nric_back' => $nao_latest_path,
                    'nao_latest' => $nric_back_path,
                    'nao_older' => $nao_older_path,
                    'cbs' => $cbs_path,
                ]);
            }

            
            
            DB::commit();

            return response()->json(['message' => 'Data add successfully'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
        }
    }
}
