<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebData;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    function siteData(Request $request){
        $web_data = WebData::pluck('value', 'key_name');
        $data['web_data'] = $web_data;
        return view('admin.web_data.web_data',$data);
    }

    function submitSiteData(Request $request){
        $data = $request->all();
//        dd($request->all());
        foreach ($data as $key=>$value){
            if ($key != '_token'){
                $web_data = WebData::where('key_name','=',$key)->first();
                if (!$web_data){
                    $web_data = new WebData();
                }
                $web_data->key_name = $key;
                $web_data->value = $value;
                $web_data->save();
            }
        }
        return redirect(route('site-data'))->with('success','Data is updated successfully.');

    }
}
