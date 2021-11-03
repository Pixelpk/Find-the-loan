<?php

namespace App\Http\Livewire\Cms;

use App\Models\FinancePartner;
use App\Models\Testimonial;
use App\Models\WebData;
use Livewire\Component;

class AboutUs extends Component
{
    public function render()
    {
        $data['partners'] = $this->allPartners();
        $data['about_us'] = WebData::where('key_name','=','about_us')->select('value')->first();
        $data['financial_inclusion'] = WebData::where('key_name','=','financial_inclusion')->select('value')->first();
        $data['testimonials'] = Testimonial::where('status','=','1')->get();
        return view('livewire.cms.about-us',$data)->layout('cms.layouts.master');
    }

    public function allPartners(){
        return FinancePartner::where('status','=',1)->get();
    }
}
