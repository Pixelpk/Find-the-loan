<?php

namespace App\Http\Livewire\Cms;

use App\Models\Blog;
use Livewire\Component;

class BlogComponent extends Component
{

   
    public function render()
    {
        $data['blogs'] = Blog::where('status','=','1')->paginate(10);
        $data['latest'] = Blog::where('status','=','1')
            ->orderBy('created_at','desc')
            ->limit(3)
            ->get();
       
        return view('livewire.cms.blog-component',$data)->layout('cms.layouts.master');
    }
}
