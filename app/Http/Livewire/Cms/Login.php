<?php

namespace App\Http\Livewire\Cms;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;
    public $message;
    public $errorMessage;
    public $captcha = 0;

    public function mount()
    {
        if(Auth::check()){
            return redirect()->route('home');
        }
    }

    public function updatedCaptcha($token)
    {
        $response = Http::post('https://www.google.com/recaptcha/api/siteverify?secret=' . env('CAPTCHA_SECRET_KEY') . '&response=' . $token);
        $this->captcha = $response->json()['score'];

        // if ($this->captcha > .3) {
        //     $this->loginAttemp();
        // } else {
        //     return session()->flash('success', 'Google thinks you are a bot, please refresh and try again');
        // }
    
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

        if ($this->captcha < 0.3) {
            $this->errorMessage = 'Google thinks you are a bot, please refresh captcha and try again';
            return;
        }

        $approve = User::where('email', $this->email)->where('status', '!=',2)
        ->where('role_id', 2)->first();
        if(!$approve){
           
            $this->errorMessage = 'User not exists';
            return;
        }
        if($approve && $approve->status == 1 && $approve->role_id == 2){
            Auth::guard('web')->attempt(['email' => $this->email, 'password' => $this->password]);
            return redirect()->route('home');
        }elseif($approve && $approve->status == 0 && $approve->role_id == 2){
            $this->errorMessage = 'User deactivated';
            return;
        }
    }
}
