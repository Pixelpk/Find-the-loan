<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoanReason;
use App\Models\LoanType;
use App\Models\MainType;
use Illuminate\Http\Request;

class LoanReasonController extends Controller
{
    public function getLoanMainType(Request $request)
    {
        $mainTypes = MainType::where('profile_id', $request->id)->get();
        return view('cms.ajax.main-type')->with('mainTypes', $mainTypes);
       
    }
    public function loanReasons(Request $request){
        $data = $request->all();
        $data['items'] = LoanReason::query()
            ->where('status','!=',2)
            ->orderBy('id','desc')
            ->paginate(50);
        return view('admin.loans.reasons',$data);
    }

    function reasonDetail(Request $request)
    {
       
        try {
            $data = $request->all();
            $id = $data['id'] ?? '';
            $reason = LoanReason::where("id", "=", $id)
                ->first();
            if (!$reason){
                return $this->resp(0,'not found',['reason'=>null],401);
            }
            return $this->resp(1,'reason details found',['reason'=>$reason],200);
        } catch (\Exception $exception) {
            return $this->resp(0,'error',['error'=>$exception->getMessage()],401);
        }
    }

    public function addReason(Request $request){
        $data = $request->all();
        // return $data;
        $request->validate([
            'reason' => 'required',
            'main_type' => 'required',
        ]);
        $id = $data['id'] ?? null;
        $reason = new LoanReason();
        if ($id != null){
            $reason = LoanReason::query()->where('id','=',$id)->first();
            if (!$reason){
                return redirect(route('loan-reasons'))->with('error',  "Reason does not exist")->withInput();
            }
        }
        $reason->fill($data)->save();
        if ($id != null){
            return redirect(route('loan-reasons'))->with('success',"Reason updated successfully!");
        }
        return redirect(route('loan-reasons'))->with('success',"Reason added successfully!");
    }

    public function getLoanType(Request $request, $id)
    {
        if($request->loan_reason_id == 0)
        {
            $loanReason= '';    
        }
        else{
            $loanReason = LoanReason::where('id', $request->loan_reason_id)->first();
        }
        $loanTypes = LoanType::where('profile', $id)->where('status', 1)->get();
        return view('admin.ajax.get-loan-type')
        ->with('loanReason', $loanReason)
        ->with('loanTypes', $loanTypes);
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
            $reason = LoanReason::query()
                ->where("id", "=", $id)
                ->where('status','!=','2')
                ->first();
            if (!$reason) {
                return redirect(route('loan-reasons'))->with("error", "Faq not found");
            }
            $reason->status = $status;
            if ($reason->save()) {
                if ($status == 0){
                    return redirect(route('loan-reasons'))->with("success", "Reason is deactivated successfully.");
                }elseif ($status == 1){
                    return redirect(route('loan-reasons'))->with("success", "Reason is activated successfully.");
                }
                return redirect(route('loan-reasons'))->with("success", "Reason is deleted successfully.");
            }
        } catch (\Exception $exception){
            return redirect(route('loan-reasons'))->with("error", $exception->getMessage());
        }
    }
}
