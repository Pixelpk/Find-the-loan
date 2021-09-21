<?php

namespace App\Http\Controllers;

use App\Mail\ContactUs;
use App\Models\Blog;
use App\Models\Faq;
use App\Models\FinancePartner;
use App\Models\Testimonial;
use App\Models\WebData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

    public function contactUsSubmit(Request $request){
        $info = $request->all();
        try {
            Mail::to('atifrazabhatti098@gmail.com')->send(new ContactUs($info));
        }catch (\Exception $exception){
//            dd($exception->getMessage());
//            dd(Mail::failures());
        }
        return redirect(route('contact-us'))->with('success','Your query is submitted.');
    }

    public function privacyPolicy(){
        $data['privacy_policy'] = WebData::where('key_name','=','privacy_policy')->select('value')->first()->value;
        return view('cms.privacy_policy',$data);
    }

    public function termsConditions(){
        $data['terms_conditions'] = WebData::where('key_name','=','terms_condition')->select('value')->first()->value;
        return view('cms.terms_conditions',$data);
    }

    public function blogs(){
        $data['blogs'] = Blog::where('status','=','1')->paginate(10);
        $data['latest'] = Blog::where('status','=','1')
            ->orderBy('created_at','desc')
            ->limit(3)
            ->get();
        return view('cms.blogs',$data);
    }

    public function blogDetail(Request $request){
        $id = $request->id ?? null;
        if ($id == null){
            return redirect()->back()->with('error','Oops something went wrong');
        }
        $data['blog'] = Blog::where('status','=','1')
            ->where('id','=',$id)->first();
        if(!$data['blog']){
            return redirect()->back()->with('error','Blog not found');
        }
        $data['latest'] = Blog::where('status','=','1')
            ->orderBy('created_at','desc')
            ->limit(3)
            ->get();
        return view('cms.blog',$data);
    }

    public function faqs(){
        $data['faqs'] = Faq::where('status','=',1)->get();
        return view('cms.faqs',$data);
    }
}
