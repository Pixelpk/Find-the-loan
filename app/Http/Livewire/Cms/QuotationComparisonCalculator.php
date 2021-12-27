<?php

namespace App\Http\Livewire\Cms;

use Livewire\Component;

class QuotationComparisonCalculator extends Component
{
    public function render()
    {
        return view('livewire.customer.quotation-comparison-calculator')->layout('cms.layouts.master');
    }
}
