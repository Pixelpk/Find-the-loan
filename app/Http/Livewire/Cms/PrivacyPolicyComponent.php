<?php

namespace App\Http\Livewire\Cms;

use Livewire\Component;
use App\Models\WebData;

class PrivacyPolicyComponent extends Component
{
    public function render()
    {
        $data['privacy_policy'] = WebData::where('key_name','=','privacy_policy')->select('value')->first()->value;
        return view('livewire.cms.privacy-policy-component',$data)->layout('cms.layouts.master');
    }
}
