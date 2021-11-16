<?php

namespace App\Http\Livewire\Cms;

use App\Models\FinancePartner;
use App\Models\LoanType;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class Home extends Component
{
    public $partners;
    public $loan_types;
    public $is_cookie = 0;
    public function mount()
    {
        $this->partners= FinancePartner::where('status','=',1)->where('type',1)->get();
        $this->loan_types = LoanType::query()
        ->orderBy('id','desc')
        ->where('status','!=',2)
        ->where('parent_id','=',0)
        ->get();
        $this->is_cookie = Cookie::get('is_cookie') ?? 0;
    }
    public function render()
    {
       
        return view('livewire.cms.home')->layout('cms.layouts.master');
    }

    public function setCookie() {
        Cookie::queue('is_cookie', 1, 60); //for testing purpose
        $this->is_cookie = 1;
    
     }
}
