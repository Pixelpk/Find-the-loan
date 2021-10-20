<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuoteAdditionalDocs;
use CURLFile;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Http\Request;

class OCRController extends Controller
{
    const STAPLE_EMAIL = 'Pixelpkk@gmail.com';
    const STAPLE_PASSWORD = "d7ce038f";
    const STAPLE_LOGIN_API = "https://api-gateway.staple.io/v1/users/login";
    const STAPLE_CREATE_GROUP_API = "https://api-gateway.staple.io/v1/groups";
    const STAPLE_CREATE_QUEUES_API = "https://api-gateway.staple.io/v1/queues";
    const STAPLE_SCAN_BANK_STAT_API = "https://api-gateway.staple.io/v1/documents/scan/bank-stat";
    public $accessToken = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1aWQiOjU5MSwiaWRlbnRpdHkiOiI1OTEiLCJpYXQiOjE2MzM1MDAzODIsImV4cCI6MTYzNDEwNTE4Mn0.fxzKAmUXON3aethuwSfssMOIjL5EnHTGoJ6rHvizQqE";
    public $apiKey = "4881b880dad969d1cf21a0ced31cb8e0f687687d35bd3bcca1f2eebe3bf1471e";
    public function login(){
        $post_data = [
            'credential'=>[
                'email'=>self::STAPLE_EMAIL,
                'password'=>self::STAPLE_PASSWORD,
                ]
        ];
        $login_response = json_decode($this->curlRequest(array('Content-Type: application/json'),'POST',self::STAPLE_LOGIN_API,json_encode($post_data)));
        $this->accessToken = $login_response->login->accessToken;
        $this->apiKey = $login_response->login->apiKey;
        return $login_response;
    }

    public function createGroup(){
        $post_data = ['name'=>'Find the loan'];
        $response = json_decode($this->curlRequest(array('Content-Type: application/json','x-api-key: '.$this->apiKey, 'Authorization: Bearer '.$this->accessToken),'POST',self::STAPLE_CREATE_GROUP_API,json_encode($post_data)));
        return $response;

    }

    public function createQueue(){
        $post_data = ['input'=>
            [
                'gid'=> 683,
                'name'=>'queue name',
                'accountType'=>'Test',
                'supplier'=>'Test',
                'customer'=>'Test',
                'docType'=>'BANKSTAT',
                'language'=>'Test',
            ],
            'members'=>['Pixelpkk@gmail.com']
        ];
        $response = json_decode($this->curlRequest(array('Content-Type: application/json','x-api-key: '.$this->apiKey, 'Authorization: Bearer '.$this->accessToken),'POST',self::STAPLE_CREATE_QUEUES_API,json_encode($post_data)));
        return $response;
    }

    public function bankStatDocType(){
        $path = public_path('test.pdf');
        $post_data = array(
            'files'=> new CURLFILE($path),
            'qid' => 1548,
            'handwritten' => false
        );

        $response = $this->curlRequest(
            array('x-api-key: '.$this->apiKey,'Authorization: Bearer '.$this->accessToken),
            'POST',
            self::STAPLE_SCAN_BANK_STAT_API,
            $post_data
        );
        return json_decode($response);
    }

    public function curlRequest($header,$method,$url,$post_data){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $post_data,
            CURLOPT_HTTPHEADER => $header,
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public function additionDocInfo(){
        return view('admin.additional-doc-info');
    }

    public function addAdditionDocInfo(Request $request){
        $data = $request->all();
        $add_doc_quote = new QuoteAdditionalDocs();
        $add_doc_quote->fill($data)->save();

        return redirect()->back()->with('success',"Added successfully!");
    }


}
