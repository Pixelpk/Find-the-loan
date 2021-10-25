<?php

namespace App\Http\Livewire\Cms;

use App\Models\FinancePartner;
use App\Models\LoanType;
use Livewire\Component;

class Home extends Component
{
    public $partners;
    public $loan_types;
    public function mount()
    {
        $this->partners= FinancePartner::where('status','=',1)->get();
        $this->loan_types = LoanType::query()
        ->orderBy('id','desc')
        ->where('status','!=',2)
        ->where('parent_id','=',0)
        ->get();
    }
    public function render()
    {
       
        return view('livewire.cms.home')->layout('cms.layouts.master');
    }
}
