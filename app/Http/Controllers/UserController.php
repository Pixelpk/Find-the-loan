<?php

namespace App\Http\Controllers;

use App\Models\MainType;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function applyLoan(Request $request)
    {
        
        $mainTypes=MainType::where('profile_id', $request->profile)->get();
        
        return view('cms.apply-loan')->with('mainTypes', $mainTypes);
    }

    public function applyLoanStore(Request $request)
    {
        $this->validate($request,[
            'main_type' => 'required',
            'loan_type_id' => 'required',
            'amount' => 'required|integer'
        ]);
    }
}
