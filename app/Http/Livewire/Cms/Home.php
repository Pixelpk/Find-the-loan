<?php

namespace App\Http\Livewire\Cms;

use App\Models\FinancePartner;
use Livewire\Component;

class Home extends Component
{
    public $partners;
    public function mount()
    {
        $this->partners= FinancePartner::where('status','=',1)->get();
    }
    public function render()
    {
       
        return view('livewire.cms.home')->layout('cms.layouts.master');
    }
}
