<?php

namespace App\Http\Livewire\Cms;

use Livewire\Component;
use App\Models\WebData;

class TermsConditionsComponent extends Component
{
    public function render()
    {
        $data['terms_conditions'] = WebData::where('key_name','=','terms_condition')->select('value')->first()->value;

        return view('livewire.cms.terms-conditions-component',$data)->layout('cms.layouts.master');
    }
}
