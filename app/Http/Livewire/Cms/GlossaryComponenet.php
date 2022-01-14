<?php

namespace App\Http\Livewire\Cms;

use Livewire\Component;
use App\Models\Glossary;
use App\Models\WebData;

class GlossaryComponenet extends Component
{
    public function render()
    {
        // $data['glossary'] = WebData::where('key_name','=','glossary')->select('value')->first()->value ?? '';
        $data['glossaries'] = Glossary::where('status','=',1)->get();
        return view('livewire.cms.glossary-componenet',$data)->layout('cms.layouts.master');
    }
}
