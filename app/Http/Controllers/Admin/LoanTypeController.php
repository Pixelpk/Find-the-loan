<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoanType;
use Illuminate\Http\Request;

class LoanTypeController extends Controller
{
    public function loanTypes(Request $request){

        $data = $request->all();
        $data['items'] = LoanType::query()
            ->orderBy('id','desc')
            ->where('status','!=',2)
            ->where('parent_id','=',0)
            ->paginate(50);

        return view('admin.loans.types',$data);
    }

    public function loanSubTypes(Request $request){

        $data = $request->all();
        $id = isset($data['id']) ? $data['id'] : null;
        if ($id == null){
            return redirect(route('loan-types'))->with('error',  "Oops. something went wrong");
        }
        $if_type = LoanType::select('id')->where('id','=',$id)
            ->where('status','!=',2)
            ->first();
        if (!$if_type){
            return redirect(route('loan-types'))->with('error','Loan type not exists');
        }
        $data['loan_type_name'] = $if_type->type_name;
        $data['items'] = LoanType::query()
            ->orderBy('id','desc')
            ->where('status','!=',2)
            ->where('parent_id','=',$id)
            ->paginate(50);
        return view('admin.loans.sub_types',$data);
    }

    function loanTypeDetail(Request $request)
    {
        try {
            $data = $request->all();
            $id = $data['id'] ?? '';
            $loan_type = LoanType::where("id", "=", $id)
                ->first();
            if (!$loan_type){
                return $this->resp(0,'not found',['loan_type'=>null],401);
            }
            return $this->resp(1,'Loan type details found',['loan_type'=>$loan_type],200);
        } catch (\Exception $exception) {
            return $this->resp(0,'error',['error'=>$exception->getMessage()],401);
        }
    }

    public function addLoanType(Request $request){
        $data = $request->all();
        $request->validate([
            'main_type' => 'required',
            'type_name' => 'required',
        ]);
        $id = $data['id'] ?? null;
        $loan_type = new LoanType();
        if ($id != null){
            $loan_type = LoanType::query()->where('id','=',$id)->first();
            if (!$loan_type){
                return redirect(route('loan-types'))->with('error',  "Loan type does not exist")->withInput();
            }
        }
        $loan_type->main_type = $data['main_type'];
        $loan_type->type_name = $data['type_name'];
        $loan_type->save();
        if ($id != null){
            return redirect(route('loan-types'))->with('success',"Loan type updated successfully!");
        }
        return redirect(route('loan-types'))->with('success',"Loan type added successfully!");
    }

    public function addLoanSubType(Request $request){
        $data = $request->all();
        $request->validate([
            'parent_id' => 'required',
            'type_name' => 'required',
        ]);
        $id = $data['id'] ?? null;
        $if_parent = LoanType::query()->where('id','=',$data['parent_id'])->first();
        if (!$if_parent){
            return redirect()->back()->with('error',  "Loan type does not exist")->withInput();
        }
        $loan_type = new LoanType();
        if ($id != null){
            $loan_type = LoanType::query()->where('id','=',$id)->first();
            if (!$loan_type){
                return redirect()->back()->with('error',  "Loan type does not exist")->withInput();
            }
        }
        $loan_type->parent_id = $data['parent_id'];
        $loan_type->type_name = $data['type_name'];
        $loan_type->save();
        if ($id != null){
            return redirect()->back()->with('success',"Loan type updated successfully!");
        }
        return redirect()->back()->with('success',"Loan type added successfully!");
    }

    public function changeStatus(Request $request)
    {
        try {
            $data = $request->all();
            if (!isset($data['id']) || ! isset($data['status'])){
                return redirect()->back()->with('error',"Oops. something went wrong");
            }
            $id = $data['id'];
            $status = (int)$data['status'];
            if ($status != 2 && $status != 0 && $status != 1){
                return redirect()->back()->with('error',"Oops. something went wrong");
            }
            $loan_type = LoanType::query()
                ->where("id", "=", $id)
                ->where('status','!=','2')
                ->first();
            if (!$loan_type) {
                return redirect(route('loan-types'))->with("error", "Loan type not found");
            }
            if ($loan_type->parent_id != 0){
                $parent = LoanType::query()
                    ->where("id", "=", $loan_type->parent_id)
                    ->where('status','!=','2')
                    ->first();
                if (!$parent){
                    return redirect()->back()->with("error", "Loan subtype not found");
                }
            }
            $loan_type->status = $status;
            if ($loan_type->save()) {
                if ($status == 0){
                    return redirect()->back()->with("success", "Loan type is deactivated successfully.");
                }elseif ($status == 1){
                    return redirect()->back()->with("success", "Loan type is activated successfully.");
                }
                return redirect()->back()->with("success", "Loan type is deleted successfully.");
            }
        } catch (\Exception $exception){
            return redirect(route('loan-types'))->with("error", $exception->getMessage());
        }
    }
}
