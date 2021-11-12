<?php

namespace App\Http\Controllers;

use App\Models\Media;
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

    public static function vali($model, $key, $apply_loan_id, $share_holder)
    {
        return Media::where('model', $model)
        ->where('key', $key)
        ->where('apply_loan_id', $apply_loan_id)
        ->where('share_holder', $share_holder)
        ->where('model_id', 0)
        ->first();
    }
}
