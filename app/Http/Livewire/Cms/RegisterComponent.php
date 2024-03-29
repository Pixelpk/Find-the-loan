<?php

namespace App\Http\Livewire\Cms;

use App\Mail\EmailVerify;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Swift_TransportException;

class RegisterComponent extends Component
{
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $password;
    public $confirm_password;
    public $errorMessage;
    public $message;

    public function mount()
    {
        if(Auth::check()){
            return redirect()->route('home');
        }
    }
    public function render()
    {
        return view('livewire.cms.register-component')->layout('cms.layouts.master');
    }

    public function store()
    {
       
       $alreadrUser=User::where('email', $this->email)->first();
       if($alreadrUser){
        return redirect()->route('registration')->with('error', 'Email already taken');
       }
       $this->validate([
           'first_name' => 'required',
           'last_name' => 'required',
           'email' => 'required|email|unique:users,email',
           'phone' => 'required',
           'password' => 'required|min:8',
           'confirm_password' => 'required|same:password',
       ]);
       
       $user=User::forceCreate([
           'first_name' => $this->first_name,
           'last_name' => $this->last_name,
           'email' => $this->email,
           'password' => Hash::make($this->password),
           'phone' => $this->phone,
           'status' => 3,
           'role_id' => 2,
       ]);
       
      
        try 
        {
            Mail::to($this->email)->send(new EmailVerify(['data' => $user]));
        }
        catch(Swift_TransportException $ex)
        {
           
        }
        $this->message = 'We have sent confirmation link to your email please verify';
        $this->first_name = '';
        $this->last_name = '';
        $this->email = '';
        $this->phone = '';
        $this->password = '';
       
    //    return redirect()->route('registration')->with('message', 'We have sent confirmation link to your email please verify');
    }
}
