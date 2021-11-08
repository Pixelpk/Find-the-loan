<?php

namespace App\Http\Livewire\Cms;
use App\Models\Faq;

use Livewire\Component;

class FaqComponent extends Component
{
    public function render()
    {
        $data['faqs'] = Faq::where('status','=',1)
        ->orderBy('sequence_id','asc')->get();
        return view('livewire.cms.faq-component',$data)->layout('cms.layouts.master');
    }
}
