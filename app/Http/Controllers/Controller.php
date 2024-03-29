<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $success = '';
    private $message = '';
    private $data = [];
    private $code;

    public function resp($success,$message,$data,$code){
        $this->success = $success;
        $this->message = $message;
        $this->data = $data;
        $this->code = $code;
        return response()->json(['success'=>$success,
            'message' => $message,
            'data' => $data,
        ], $code);
}
}
