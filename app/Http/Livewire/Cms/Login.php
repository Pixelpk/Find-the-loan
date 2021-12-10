<?php

namespace App\Http\Livewire\Cms;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;
    public $message;
    public $errorMessage;

    public function mount()
    {
        if(Auth::check()){
            return redirect()->route('home');
        }
    }
    public function render()
    {
        return view('livewire.cms.login')->layout('cms.layouts.master');
    }
    public function loginAttemp()
    {
       $this->errorMessage = '';
        $this->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $approve = User::where('email', $this->email)->where('status', '!=',2)
        ->where('role_id', 2)->first();
        if(!$approve){
           
            $this->errorMessage = 'User not exists';
            return;
            // dd('adas');
            // session()->flash
            // return redirect(route('login'))->with('error','User not exists');
        }
        if($approve && $approve->status == 1 && $approve->role_id == 2){
            Auth::guard('web')->attempt(['email' => $this->email, 'password' => $this->password]);
            return redirect()->route('home');
        }elseif($approve && $approve->status == 0 && $approve->role_id == 2){
            $this->errorMessage = 'User deactivated';
            return;
            // return redirect()->route('login')->with('error', 'User deactivated');
        }
        // return redirect()->route('login')->with('error', 'User is not approved please verify through email');  
    }
}
