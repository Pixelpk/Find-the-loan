<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\PartnerMail;
use App\Models\CompanyStructure;
use App\Models\FinancePartner;
use App\Models\LoanType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class FinancePartnerController extends Controller
{
    public function financePartners(Request $request){
        $data = $request->all();
        $data['items'] = FinancePartner::query()
            ->orderBy('id','desc')
            ->where('parent_id','=',0)
            ->where('status','!=',2)
            ->paginate(50);
        $data['structures'] = CompanyStructure::where('status','=','1')
            ->get();
        $data['loan_types'] = LoanType::where('status','=',1)->get();
        return view('admin.finance_partners.partners',$data);
    }

    function partnerDetail(Request $request)
    {
        try {
            $data = $request->all();
            $id = $data['id'] ?? '';
            $partner = FinancePartner::where("id", "=", $id)
                ->first();
            if (!$partner){
                return $this->resp(0,'not found',['partner'=>null],401);
            }
            $partner->loan_type_id = explode(',',$partner->loan_type_id);
            return $this->resp(1,'partner details found',['partner'=>$partner],200);
        } catch (\Exception $exception) {
            return $this->resp(0,'error',['error'=>$exception->getMessage()],401);
        }
    }

    public function addPartner(Request $request){
        $data = $request->all();
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'email' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'password' => 'required|min:6',
            'min_quantum' => 'required|min:0',
            'max_quantum' => 'required|min:0',
            'company_structure_id' => 'required',
            'loan_type_id' => 'required',
            'length_of_incorporation' => 'required|min:0',
            'local_shareholding' => 'required|min:0',
            'subsidiaries' => 'required|min:0',
            'cbs_member' => 'required',
            'terms_condition' => 'required',
            'image' => 'required|image',
        ]);

        $if_partner = FinancePartner::where('email','=',$data['email'])->where('status','!=','2')->first();
        if ($if_partner){
            return redirect(route('finance-partners'))->with('error',  "Finance partner already exists!")->withInput();
        }
        $partner = new FinancePartner();
        $data['parent_id'] = 0;
        $data['role_id'] = 1;
        $data['loan_type_id'] = implode(',',$data['loan_type_id']);
        $data['cbs_member'] = $data['cbs_member'] ? 1 : 0;
        $data['password'] = Hash::make($data['password']);

//        $partner->parent_id = 0;
//        $partner->name = $data['name'];
//        $partner->email = $data['email'];
//        $partner->phone = $data['phone'];
//        $partner->password = Hash::make($data['password']);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'partner' . date("Ymd-his") . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path("uploads/financePartnerImages/" . $filename);
            if (move_uploaded_file($_FILES['image']['tmp_name'], $destinationPath) && $data['image']) {
                if (file_exists($destinationPath)) {
//                    $partner->image = $filename;
                    $data['image'] = $filename;
                } else {
                    return redirect(route('finance-partners'))->with('error',"Oops. Something went wrong with image");
                }
            }
        }

        $partner->fill($data)->save();
        $info = array(
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => $request->password,
            'created_or_updated' => '1' //account created
        );
        try {
            Mail::to($data['email'])->send(new PartnerMail($info));
        }catch (\Exception $exception){
        }
        return redirect(route('finance-partners'))->with('success',"Finance partner added successfully!");
    }

    public function updatePartner(Request $request){
        $data = $request->all();
        $request->validate([
            'id' => 'required',
            'type' => 'required',
            'name' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'min_quantum' => 'required|min:0',
            'max_quantum' => 'required|min:0',
            'company_structure_id' => 'required',
            'loan_type_id' => 'required',
            'length_of_incorporation' => 'required|min:0',
            'local_shareholding' => 'required|min:0',
            'subsidiaries' => 'required|min:0',
            'terms_condition' => 'required'
        ]);

        $partner = FinancePartner::where('id','=',$data['id'])->where('status','!=','2')->first();
        if (!$partner){
            return redirect(route('finance-partners'))->with('error',  "Finance partner not exists!")->withInput();
        }
        if (isset($data['password'])){
            $request->validate([
                'password' => 'min:6',
            ]);
            $data['password'] = Hash::make($data['password']);
        }else{
            $data['password'] = $partner->password;
        }
        $data['loan_type_id'] = implode(',',$data['loan_type_id']);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'partner' . date("Ymd-his") . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path("uploads/financePartnerImages/" . $filename);
            if (move_uploaded_file($_FILES['image']['tmp_name'], $destinationPath) && $data['image']) {
                if (file_exists($destinationPath)) {
//                    $partner->image = $filename;
                    $data['image'] = $filename;
                } else {
                    return redirect(route('finance-partners'))->with('error',"Oops. Something went wrong with image");
                }
            }
        }
        $partner->fill($data)->save();
        if (isset($request->password)){
            $info = array(
                'name' => $partner->name,
                'phone' => $partner->phone,
                'email' => $partner->email,
                'password' => $request->password,
                'created_or_updated' => '0' //account details updated
            );
            try {
                Mail::to($partner->email)->send(new PartnerMail($info));
            }catch (\Exception $exception){
            }
        }

        return redirect(route('finance-partners'))->with('success',"Finance partner updated successfully!");
    }

    public function conditionsApprovalRequests(Request $request){
        $data['items'] = FinancePartner::select('id','name','requested_terms_condition')
            ->where('terms_request_status','=',1)
            ->whereNotNull('requested_terms_condition')->paginate(10);
        return view('admin.finance_partners.term_conditions_requests',$data);
    }

    //approving terms & conditions request by super admin
    public function approveTermsConditions(Request $request){
        {
            try {
                $data = $request->all();
                if (!isset($data['id']) || ! isset($data['status'])){
                    return redirect()->back()->with('error',"Oops. something went wrong");
                }
                $id = $data['id'];
                $status = (int)$data['status'];
                if ($status != 0 && $status != 1){
                    return redirect()->back()->with('error',"Oops. something went wrong");
                }
                $partner = FinancePartner::query()
                    ->where("id", "=", $id)
                    ->where('terms_request_status','=',1)
                    ->where('status','!=','2')
                    ->first();
                if (!$partner) {
                    return redirect(route('conditions-approval-requests'))->with("error", "Oops. something went wrong.");
                }
                if ($status == 0){
                    $partner->requested_terms_condition = null;
                    $partner->save();
                    return redirect(route('conditions-approval-requests'))->with("success", "Request is rejected successfully.");
                }
                $partner->terms_condition = $partner->requested_terms_condition;
                $partner->requested_terms_condition = null;
                $partner->terms_request_status = null;
                $partner->save();
                return redirect(route('conditions-approval-requests'))->with("success", "Request is accepted successfully.");

            } catch (\Exception $exception){
                return redirect(route('conditions-approval-requests'))->with("error", $exception->getMessage());
            }
        }
    }

    //approving terms and conditions request by bank admin
    public function approveTermsConditionsByBank(Request $request){
        try {
            $data = $request->all();
            $user = $request->user();
            if (!isset($data['status'])){
                return redirect()->back()->with('error',"Oops. something went wrong");
            }
            $status = (int)$data['status'];
            if ($status != 0 && $status != 1){
                return redirect()->back()->with('error',"Oops. something went wrong");
            }
            $partner = FinancePartner::query()
                ->where("id", "=", $user->id)
                ->where("parent_id", "=", 0)
                ->where('status','!=','2')
                ->first();
            if (!$partner) {
                return redirect(route('partner-terms-conditions'))->with("error", "Oops. something went wrong.");
            }
            if ($status == 0){
                $partner->terms_request_status = null;
                $partner->requested_terms_condition = null;
                $partner->save();
                return redirect(route('partner-terms-conditions'))->with("success", "Request is rejected successfully.");
            }
            $partner->terms_request_user_id = $partner->id;
            $partner->terms_condition = $partner->requested_terms_condition;
            $partner->terms_request_status = 1;
            $partner->save();
            return redirect(route('partner-terms-conditions'))->with("success", "Request is forward to super admin for approval. ");

        } catch (\Exception $exception){
            return redirect(route('partner-terms-conditions'))->with("error", $exception->getMessage());
        }
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
            $partner = FinancePartner::query()
                ->where("id", "=", $id)
                ->where('parent_id','=',0)
                ->where('status','!=','2')
                ->first();
            if (!$partner) {
                return redirect(route('finance-partners'))->with("error", "Finance partner not found");
            }
            $partner->status = $status;
            if ($partner->save()) {
                if ($status == 0){
                    return redirect(route('finance-partners'))->with("success", "Finance partner is deactivated successfully.");
                }elseif ($status == 1){
                    return redirect(route('finance-partners'))->with("success", "Finance partner is activated successfully.");
                }
                return redirect(route('finance-partners'))->with("success", "Finance partner is deleted successfully.");
            }
        } catch (\Exception $exception){
            return redirect(route('finance-partners'))->with("error", $exception->getMessage());
        }
    }
}
