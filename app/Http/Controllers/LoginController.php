<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('cms.login');
    }

    public function loginAttempt(Request $request)
    {
        // return $request->all();
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $approve = User::where('email', $request->email)->where('status', '!=',2)->first();
        if(!$approve){
            return redirect(route('login'))->with('error','User not exists');
        }
        if($approve && $approve->status == 1){
            Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password]);
            return redirect()->route('home');
        }elseif($approve && $approve->status == 0){
            return redirect()->route('login')->with('error', 'User deactivated');
        }
        return redirect()->route('login')->with('error', 'User is not approved please verify through email');      
        
    }
}
