<?php

namespace App\Http\Livewire\Cms;

use Livewire\Component;

class GlossaryComponenet extends Component
{
    public function render()
    {
        return view('livewire.cms.glossary-componenet')->layout('cms.layouts.master');
    }
}
