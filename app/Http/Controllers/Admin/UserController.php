<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Company;
use App\Models\Faq;
use App\Models\FinancePartner;
use App\Models\Horse;
use App\Models\Jockey;
use App\Models\Location;
use App\Models\Notification;
use App\Models\Race;
use App\Models\Shift;
use App\Models\Signal;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\UserLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use SimpleXLSX;
use Vtiful\Kernel\Excel;
use function PHPUnit\Framework\isEmpty;

class UserController extends Controller
{
    public function adminLogin(Request $request)
    {
        if (!Auth::check()){
            return view('admin.user.signin');
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
        $credentials = ['email'=>$request->email, 'password'=>$request->password, 'role_id'=>[1,3,4,5],'status'=>1];
        if (Auth::attempt($credentials)){
            return redirect(route('admin-dashboard'))->with('success','You are successfully logged in.');
        }else{
            return redirect(route('admin-login'))->with('error',"Email/Password is wrong");
        }
    }


    public function dashboard(Request $request)
    {
        $data['user_count'] = User::where('role_id','!=','1')->whereIn('status',[0,1])->count();
        $data['faq_count'] = Faq::whereIn('status',[0,1])->count();
        $data['blog_count'] = Blog::whereIn('status',[0,1])->count();
        $data['partner_count'] = FinancePartner::whereIn('status',[0,1])->count();
        return view('admin.dashboard',$data);
    }

    public function profile(Request $request)
    {
        return view('admin.user.profile');
    }

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

    function updateProfile(Request $request){
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
        ]);

        $user = $request->user();

        $user = User::where('id','=',$user->id)->first();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->save();
        return redirect(route('profile'))->with('success','Profile is updated successfully');
    }

    function updatePassword(Request $request){
        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);
        $user = Auth::user();
        if (Hash::check($request->old_password , $user->password)){
            $password = Hash::make($request->password);
            User::where('id','=',$user->id)->update(['password'=>$password]);
            return redirect(route('profile'))->with('success','Password updated successfully');
        }
        return redirect(route('profile'))->with('success',"You old password is wrong. try again");
    }

    public function users(Request $request){
        $data['users'] = User::select('*')->with('user_detail')
            ->where('role_id','=','2')
            ->whereIn('status',[0,1])
            ->orderby('id','desc')
            ->get();
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

    public function addUser(Request $request){
        $data = $request->all();
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'role_id' => 'required',
            'email' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'password' => 'required'
        ]);

        $data['password'] = Hash::make($data['password']);
        $dup = User::where(function ($query) use($data){
                $query->where('email','=',$data['email']);
                $query->orwhere('phone','=',$data['phone']);
            })->where('status','!=','2')->first();

        if ($dup){
            return redirect(route('support-users',['support_role_id'=>$data['role_id']]))->with('error',  "User already exists!")->withInput();
        }

        $user = new User();
        try {
            $user->fill($data)->save();
        }catch (\Exception $exception){
            return redirect(route('support-users',['support_role_id'=>$data['role_id']]))->with('error',$exception->getMessage());
        }
        return redirect(route('support-users',['support_role_id'=>$data['role_id']]))->with('success',"User added successfully!");

    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect(route('admin-login'));
    }

}
