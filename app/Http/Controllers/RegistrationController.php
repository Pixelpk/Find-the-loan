<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerify;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Swift_TransportException;
use Illuminate\Support\Facades\Crypt;


class RegistrationController extends Controller
{
    public function index()
    {
        return view('cms.registration');
    }

    public function store(Request $request)
    {
       $alreadrUser=User::where('email', $request->email)->first();
       if($alreadrUser){
        return redirect()->route('registration')->with('error', 'Email already taken');
       }
       $this->validate($request, [
           'first_name' => 'required',
           'last_name' => 'required',
           'email' => 'required|email',
           'phone' => 'required',
           'password' => 'required',
           'confirm_password' => 'required|same:password',
       ]);
       
       $user=User::forceCreate([
           'first_name' => $request->first_name,
           'last_name' => $request->last_name,
           'email' => $request->email,
           'password' => Hash::make($request->password),
           'phone' => $request->phone,
           'status' => 3,
           'role_id' => 2,
       ]);
        try 
        {
            Mail::to($request->email)->send(new EmailVerify(['data' => $user]));
        }
        catch(Swift_TransportException $ex)
        {
           
        }
       return redirect()->route('registration')->with('message', 'We have sent confirmation link to your email please verify');
    }

    public function verifyEmail(Request $request)
    {
         $user = User::where('email', Crypt::decryptString($request->email))->first();
         $user->status = 1;
         $user->update();
         return redirect()->route('login')->with('message', 'Email verify successfully');
    }
}
