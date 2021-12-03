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

    //accesstoken and apikey will be generated in login function.. followin is dummy accesstoken and apikey
    public $accessToken = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1aWQiOjU5MSwiaWRlbnRpdHkiOiI1OTEiLCJpYXQiOjE2MzY5NzQ3OTQsImV4cCI6MTYzNzU3OTU5NH0.AE5fcr6ZxRb0th10GGrrx2JV-aTehCS6cfkKrn0eFtU";
    public $apiKey = "b3bec2a8317bab6163543a75598a36da49508da1b8f7d32b744db0e419ff54e1";
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
        $post_data = ['name'=>'TestGroup2'];
        $response = json_decode($this->curlRequest(array('Content-Type: application/json','x-api-key: '.$this->apiKey, 'Authorization: Bearer '.$this->accessToken),'POST',self::STAPLE_CREATE_GROUP_API,json_encode($post_data)));
        return $response;

    }

    public function createQueue(){
        $post_data = ['input'=>
            [
                'gid'=> 922, //gid will be generated in createGroup function
                'name'=>'TestQueue20',
                'accountType'=>'Test',
                // 'supplier'=>'',
                // 'customer'=>'',
                'docType'=>'BANKSTAT', 
                'language'=>'EN'
            ],
            'members'=>['Pixelpkk@gmail.com']
        ];
        $response = json_decode($this->curlRequest(array('Content-Type: application/json','x-api-key: '.$this->apiKey, 'Authorization: Bearer '.$this->accessToken),'POST',self::STAPLE_CREATE_QUEUES_API,json_encode($post_data)));
        return $response;
    }

    public function bankStatDocType(){
        
        $path = public_path('test.pdf');
        // dd($path);
        $post_data = array(
            'files'=> new CURLFILE($path),
            'qid' => 1910, //qid will be generated in createQueue function
            'handwritten' => false
        );

        $response = $this->curlRequest(
            array('x-api-key: '.$this->apiKey,'Authorization: Bearer '.$this->accessToken),
            'POST',
            self::STAPLE_SCAN_BANK_STAT_API,
            $post_data
        );
        // dd($response);
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

    public function ocrResults()
    {
        $path = base_path("bankstatementresults.json");
        $content = file_get_contents($path);
        $content = json_decode($content);
        $document_data = $content->scanDocuments->data;
        // $scanDocuments = $content['scanDocuments'];
        $AccountNumber = $document_data->AccountNumber->matches[0]->match;
        $Email = $document_data->Email->matches[0]->match;
        $Currency = $document_data->Currency->matches[0]->match;
        $BankName = $document_data->BankName->matches[0]->match;
        $lineItems = $document_data->LineItems;
        $total_debit_amount = 0;
        $total_credit_amount = 0;
        $month_end_balance = 0;

        // foreach($lineItems as $item){
        //     // return $item;
        //     // foreach($item as $sub_item){
        //     //     return end($sub_item)[0];
        //     // }
        // }
        // exit;
        $results = (json_decode(file_get_contents($path), 1));
        $results = $results['scanDocuments']['data']['LineItems'];
        foreach($results as $result) {
            foreach($result as $item){
                $fArray = $item;
                return $fArray['Bank Ref/ '];
            }
        }
        // $heads = [
        //     'Bank Ref/ ',
        // ]
    }


}
