<?php

namespace App\Http\Livewire\Cms;

use App\Models\Blog;
use Livewire\Component;

class BlogDetailComponent extends Component
{
    public $blog_id;
    public $name;
    protected $queryString = ['blog_id','name'];
    public function render()
    {
        $id = $this->blog_id ?? null;
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
        return view('livewire.cms.blog-detail-component',$data)->layout('cms.layouts.master');
    }
}
