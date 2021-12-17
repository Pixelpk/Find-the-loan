<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Socialite;
use Exception;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Laravel\Socialite\Facades\Socialite as FacadesSocialite;


class SocialLoginController extends Controller
{
    public function facebookRedirect()
    {
        return FacadesSocialite::driver('facebook')->redirect();
    }

    public function loginWithFacebook()
    {

        try {

            $user = FacadesSocialite::driver('facebook')->user();
            $isUser = User::where('facebook_id', $user->id)->first();
            // dd($user);

            if($isUser){
                FacadesAuth::login($isUser);
                return redirect()->route('home');
            }else{
                $createUser = User::create([
                    'role_id' => 2,
                    'first_name' => $user->name,
                    'email' => $user->email,
                    'phone' => '',
                    'password' => '',
                    'facebook_id' => $user->id,
                ]);

                FacadesAuth::login($createUser);
                return redirect()->route('home');
            }

        } catch (Exception $exception) {
            
            // $this->errorMessage = 'Error!' .$exception->getMessage();
            return redirect()->route('login');
        }
    }
}
