<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\PartnerMail;
use App\Mail\PartnerUserMail;
use App\Models\FinancePartner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PartnerUserController extends Controller
{
    public function users(Request $request){
        $user = $request->user();
        $data['users'] = FinancePartner::where('parent_id','=',$user->id)
            ->paginate(30);
        return view('admin.partner_users.users',$data);
    }

    public function addUser(Request $request){
        $data = $request->all();
        $parent = $request->user();
        $parent_id = '';
        $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'email' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'password' => 'required|min:6',
        ]);

        $if_user = FinancePartner::where('email','=',$data['email'])->where('status','!=','2')->first();
        if ($if_user){
            return redirect(route('finance-partners'))->with('error',  "User already exists against this email!")->withInput();
        }
        if ($parent->parent_id == 0){
            $parent_id = $parent->id;
        }else{
            $parent_id = $parent->parent_id;
        }
        $newUser = new FinancePartner();
        $newUser->name = $data['name'];
        $newUser->parent_id = $parent_id;
        $newUser->designation = $data['designation'];
        $newUser->email = $data['email'];
        $newUser->phone = $data['phone'];
        $newUser->password = Hash::make($data['password']);
        $newUser->save();
        $finance_partner = FinancePartner::select('id','name')->where('id','=',$parent_id)->first();
        $info = array(
            'partner_name' => $finance_partner->name,
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'designation' => $data['designation'],
            'password' => $request->password,
            'created_or_updated' => '1' //account created
        );
        try {
            Mail::to($data['email'])->send(new PartnerUserMail($info));
        }catch (\Exception $exception){
        }
        return redirect(route('partner-users'))->with('success',"User is added successfully!");
    }

    public function updateUser(Request $request){
        $data = $request->all();
//        return $data;
        $request->validate([
            'id' => 'required',
            'designation' => 'required',
            'name' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',

        ]);

        $partner_user = FinancePartner::where('id','=',$data['id'])->where('status','!=','2')->first();
        if (!$partner_user){
            return redirect(route('partner-users'))->with('error',  "User not exists!")->withInput();
        }
        if (isset($data['password'])){
            $request->validate([
                'password' => 'min:6',
            ]);
            $partner_user->password = Hash::make($data['password']);
        }

        $partner_user->name = $data['name'];
        $partner_user->designation = $data['designation'];
        $partner_user->phone = $data['phone'];
        $partner_user->save();
        $finance_partner = FinancePartner::select('id','name')->where('id','=',$partner_user->parent_id)->first();
        if (isset($request->password)){
            $info = array(
                'partner_name' => $finance_partner->name,
                'name' => $partner_user->name,
                'phone' => $partner_user->phone,
                'email' => $partner_user->email,
                'designation' => $partner_user->designation,
                'password' => $request->password,
                'created_or_updated' => '0' //account detail updated
            );
            try {
                Mail::to($partner_user->email)->send(new PartnerUserMail($info));
            }catch (\Exception $exception){

            }
        }
        return redirect(route('partner-users'))->with('success',"User updated successfully!");
    }

    function userDetail(Request $request)
    {
        try {
            $data = $request->all();
            $id = $data['id'] ?? '';
            $user = FinancePartner::where("id", "=", $id)
                ->first();
            if (!$user){
                return $this->resp(0,'not found',['user'=>null],401);
            }
            return $this->resp(1,'User details found',['user'=>$user],200);
        } catch (\Exception $exception) {
            return $this->resp(0,'error',['error'=>$exception->getMessage()],401);
        }
    }

    public function termsConditions(Request $request){
        $user = $request->user();
        $user_id = '';
        if ($user->parent_id == 0){
            $user_id = $user->id;
        }else{
            $user_id = $user->parent_id;
        }
        $data['detail'] = FinancePartner::select('id','terms_condition','requested_terms_condition','terms_request_user_id','terms_request_status')
            ->where('id','=',$user_id)->first();
//        return $data;
        $data['user_detail'] = FinancePartner::select('id','name','designation')->where('id','=',$data['detail']->terms_request_user_id)->first();
//        return $data;
        return view('admin.finance_partners.terms_conditions',$data);
    }

    public function requestTermsConditions(Request $request){
        $user = $request->user();
//        return $user;
        $id = $user->id;
        $message= '';
        $partner_id = '';
        if ($user->parent_id == 0){
            $partner_id = $user->id;
        }else{
            $partner_id = $user->parent_id;
        }
        $partner = FinancePartner::select('id','terms_condition')->where('id','=',$partner_id)->first();
        if ($partner->id == $id){
            $partner->terms_request_status = '1'; //request by admin of financial partner
            $message = "Request to update terms & conditions is forward to super admin.";
        }else{
            $partner->terms_request_status = '0'; //request by user of bank other than bank admin
            $message = "Request to update terms & conditions is forward to Bank admin.";

        }
        $partner->terms_request_user_id = $user->id;
        $partner->requested_terms_condition = $request->requested_terms_condition;
//        return $partner;
        $partner->save();
        return redirect(route('partner-terms-conditions'))->with('success',$message);
    }

    public function changeStatus(Request $request)
    {
        try {
            $data = $request->all();
            if (!isset($data['user_id']) || !isset($data['status'])){
                return redirect()->back()->with('error',"Oops. something went wrong");
            }
            $parent = $request->user();
            $parent_id = '';
            if ($parent->parent_id == 0){
                $parent_id = $parent->id;
            }else{
                $parent_id = $parent->parent_id;
            }

            $user_id = $data['user_id'];
            $status = (int)$data['status'];
            if ($status != 0 && $status != 1 && $status != 2){
                return redirect()->back()->with('error',"Oops. something went wrong");
            }
            $user = FinancePartner::query()
                ->where("id", "=", $user_id)
                ->where('parent_id','=',$parent_id)
                ->where('status','!=','2')
                ->first();
            if (!$user) {
                return redirect(route('partner-users'))->with("error", "User does not exists");
            }
            $user->status = $status;
            if ($user->save()) {
                if ($status == 1) {
                    return redirect()->back()->with("success", "User is activated successfully.");
                } else if ($status == 2) {
                    return redirect()->back()->with("success", "user is deleted successfully.");
                } else if ($status == 0) {
                    return redirect()->back()->with("success", "user is deactivated successfully.");
                }
            }
        } catch (\Exception $exception) {
            return redirect()->back()->with("error", $exception->getMessage());
        }
    }
}
