<?php

namespace App\Http\Livewire\Cms;

use Livewire\Component;
use App\Models\WebData;

class FinancialInclusionComponent extends Component
{
    public function render()
    {
        $data['financial_inclusion'] = WebData::where('key_name','=','financial_inclusion')->select('value')->first()->value;
        return view('livewire.cms.financial-inclusion-component',$data)->layout('cms.layouts.master');
    }
}
