<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CommonController extends Controller
{
    public function verifyEmail(Request $request)
    {
         $user = User::where('email', Crypt::decryptString($request->email))->first();
         $user->status = 1;
         $user->update();
         return redirect()->route('login')->with('message', 'Email verify successfully');
    }
}
