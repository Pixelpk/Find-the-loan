<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApplyLoan;
use App\Models\Blog;
use App\Models\CompanyStructure;
use App\Models\Faq;
use App\Models\FinancePartner;
use App\Models\LoanReason;
use App\Models\LoanType;
use App\Models\Sector;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function adminLogin(Request $request)
    {
//        dd(Auth::guard('partners')->user());
//        dd(Auth::guard('users')->user());
        if (!Auth::guard('partners')->user() && !Auth::guard('users')->user()){
            $data['login_url'] = route('admin-login');
            return view('admin.user.signin',$data);
        }else{
            return redirect(route('admin-dashboard'));
        }
    }

    public function partnerLogin(Request $request)
    {
//        dd(Auth::guard('partners')->user());
//        dd(Auth::guard('users')->user());
        if (!Auth::guard('partners')->user() && !Auth::guard('users')->user()){
            $data['login_url'] = route('partner-login-submit');
            return view('admin.user.signin',$data);
        }else{
            return redirect(route('admin-dashboard'));
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->fails()){
            return redirect(route('admin-login'))->withErrors($validator);
        }
        if (Auth::guard('users')->attempt(['email'=>$request->email, 'password'=>$request->password, 'role_id'=>1,'status'=>1])){
            return redirect(route('admin-dashboard'))->with('success','You are successfully logged in.');
        }else{
            return redirect(route('admin-login'))->with('error',"Email/Password is wrong");
        }
    }

    public function partnerLoginSubmit(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->fails()){
            return redirect(route('partner-login'))->withErrors($validator);
        }
        $credentials = ['email'=>$request->email, 'password'=>$request->password,'status'=>1];
        if (Auth::guard('partners')->attempt($credentials)){
            $user = Auth::guard('partners')->user();
            if ($user->parent_id == 0){
                $partner_id = $user->id;
                Session::put('partner_id', $partner_id);
            }else{
                $partner_id = $user->partner_id;
                Session::put('partner_id', $partner_id);
            }
            return redirect(route('admin-dashboard'))->with('success','You are successfully logged in.');
        }else{
            return redirect(route('partner-login'))->with('error',"Email/Password is wrong");
        }
    }


    public function dashboard(Request $request)
    {
    //    dd(Auth::user());exit();
        $loggedin_user = $request->user();
        $user_id = $loggedin_user->id;

        $data['user_count'] = User::where('role_id','!=','1')->whereIn('status',[0,1])->count();
        $data['faq_count'] = Faq::whereIn('status',[0,1])->count();
        $data['blog_count'] = Blog::whereIn('status',[0,1])->count();
        $partner_count_query = FinancePartner::whereIn('status',[0,1]);
        if ($loggedin_user->parent_id != 0){
            $loggedin_user->where('parent_id','=',$loggedin_user->id);
        }
        $data['partner_enquires_count'] = ApplyLoan::select('*')
        ->whereHas('loan_lender_details',function($query) use ($user_id){
            $query->where('lender_id','=',$user_id)->where('status',1);
        })->count() ?? 0;
        $data['partner_count'] = $partner_count_query->where('parent_id',$user_id)->count();
        $data['loan_type_count'] = LoanType::whereIn('status',[0,1])->count();
        $data['loan_reason_count'] = LoanReason::whereIn('status',[0,1])->count();
        $data['company_struct_count'] = CompanyStructure::whereIn('status',[0,1])->count();
        $data['sector_count'] = Sector::whereIn('status',[0,1])->count();
        $data['testimonial_count'] = Testimonial::whereIn('status',[0,1])->count();
        return view('admin.dashboard',$data);
    }

    public function adminProfile(Request $request)
    {
        return view('admin.user.profile');
    }

    public function partnerProfile(Request $request)
    {
        $data['structures'] = CompanyStructure::where('status','=','1')
            ->get();
        $data['loan_types'] = LoanType::where('status','=',1)->get();
        $data['selected_structure'] = $request->user()->company_structure_id;
        $data['selected_loan_types'] = explode(',',$request->user()->loan_type_id);
        return view('admin.user.partner-profile',$data);
    }

//    public function profile(Request $request)
//    {
//        return view('admin.user.profile');
//    }

    function userDetail(Request $request)
    {
        try {
            $data = $request->all();
            $id = $data['id'] ?? '';
            $user = UserDetail::where("user_id", "=", $id)
                ->first();
            if (!$user){
                return $this->resp(0,'not found',['detail'=>null],401);
            }
            return $this->resp(1,'user details found',['detail'=>$user],200);
        } catch (\Exception $exception) {
            return $this->resp(0,'error',['error'=>$exception->getMessage()],401);
        }
    }

    function updateAdminProfile(Request $request){
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
        ]);

        $user = $request->user();

        $user = User::where('id','=',$user->id)->first();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->save();
        return redirect()->back()->with('success','Profile is updated successfully');
    }

    function updatePartnerProfile(Request $request){
        $data = $request->all();
        $this->validate($request,[
            'name' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'min_quantum' => 'required|min:0',
            'max_quantum' => 'required|min:0',
            'company_structure_id' => 'required',
            'loan_type_id' => 'required',
            'length_of_incorporation' => 'required|min:0',
            'local_shareholding' => 'required|min:0',
            'subsidiaries' => 'required|min:0',
        ]);
        $data['loan_type_id'] = implode(',',$data['loan_type_id']);

        $user = $request->user();

        $user->fill($data)->save();

        return redirect()->back()->with('success','Profile is updated successfully');
    }

    function updatePassword(Request $request){
        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);
        $user = Auth::user();
        if (Hash::check($request->old_password , $user->password)){
            $password = Hash::make($request->password);
            if (Auth::guard('partners')){
                FinancePartner::where('id','=',$user->id)->update(['password'=>$password]);
            }
            else{
                User::where('id','=',$user->id)->update(['password'=>$password]);
            }
            return redirect()->back()->with('success','Password updated successfully');
        }
        return redirect()->back()->with('success',"You old password is wrong. try again");
    }

    public function users(Request $request){
        $data['users'] = User::select('*')->with('user_detail')
            ->where('role_id','=','2')
            ->whereIn('status',[0,1])
            ->orderby('id','desc')
            ->paginate(20);
        return view('admin.user.users',$data);
    }

    public function changeStatus(Request $request)
    {
        try {
            $data = $request->all();
            if (!isset($data['user_id']) || !isset($data['status'])){
                return redirect()->back()->with('error',"Oops. something went wrong");
            }
            $user_id = $data['user_id'];
            $status = (int)$data['status'];
            if ($status != 0 && $status != 1 && $status != 2){
                return redirect()->back()->with('error',"Oops. something went wrong");
            }
            $user = User::query()
                ->where("id", "=", $user_id)
                ->where('role_id','!=','1')
                ->where('status','!=','2')
                ->first();
            if (!$user) {
                return redirect(route('users'))->with("error", "User does not exists");
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

    // public function addUser(Request $request){
    //     $data = $request->all();
    //     $request->validate([
    //         'first_name' => 'required',
    //         'last_name' => 'required',
    //         'role_id' => 'required',
    //         'email' => 'required',
    //         'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
    //         'password' => 'required'
    //     ]);

    //     $data['password'] = Hash::make($data['password']);
    //     $dup = User::where(function ($query) use($data){
    //         $query->where('email','=',$data['email']);
    //         $query->orwhere('phone','=',$data['phone']);
    //     })->where('status','!=','2')->first();

    //     if ($dup){
    //         return redirect(route('support-users',['support_role_id'=>$data['role_id']]))->with('error',  "User already exists!")->withInput();
    //     }

    //     $user = new User();
    //     try {
    //         $user->fill($data)->save();
    //     }catch (\Exception $exception){
    //         return redirect(route('support-users',['support_role_id'=>$data['role_id']]))->with('error',$exception->getMessage());
    //     }
    //     return redirect(route('support-users',['support_role_id'=>$data['role_id']]))->with('success',"User added successfully!");

    // }

    public function logout(Request $request)
    {
        // return Auth::user();
        if (Auth::guard('users')->check()){
            Auth::guard('users')->logout();
            return redirect(route('admin-login'));
        }else{
            Auth::guard('partners')->logout();
            return redirect(route('partner-login'));
        }
    }
    public function customerLogout(){
        Auth::logout();

        return redirect(route('login'));
    }

}
