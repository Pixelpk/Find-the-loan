<?php
namespace App\Http\Livewire\Widget;
use Livewire\Component;
class Currency extends Component
{

    public $main_type;
    public $currency = 'SGD';
    
    public function render()
    {
        return view('livewire.widget.currency');
    }

    public function getCurrency()
    {
        $this->emit('getCurrency', $this->currency);
    }

  

   
}
