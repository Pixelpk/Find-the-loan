<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\FinancePartner;
use App\Models\Testimonial;
use App\Models\WebData;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $data['partners'] = $this->allPartners();
        return view('cms.home',$data);
    }

    public function aboutUs(){
        $data['partners'] = $this->allPartners();
        $data['about_us'] = WebData::where('key_name','=','about_us')->select('value')->first();
        $data['testimonials'] = Testimonial::where('status','=','1')->get();
        return view('cms.about_us',$data);
    }

    public function allPartners(){
        return FinancePartner::where('status','=',1)->get();
    }

    public function contactUs(){
        return view('cms.contact_us');
    }

    public function privacyPolicy(){
        return view('cms.privacy_policy');
    }

    public function blogs(){
        $data['blogs'] = Blog::where('status','=','1')->paginate();
        return view('cms.blogs',$data);
    }

    public function blogDetail(Request $request){
        $id = $request->id ?? null;
        if ($id == null){

        }
        $data['blogs'] = Blog::where('status','=','1')->paginate();
        return view('cms.blogs',$data);
    }
}
