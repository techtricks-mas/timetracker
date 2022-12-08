<?php

namespace App\Http\Livewire\Common;

use Livewire\Component;

class Sidenav extends Component
{
    public $page;
    public function render()
    {

        return view('livewire.common.sidenav');
    }
}
