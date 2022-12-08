<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Profile extends Component
{
    public $page = 'profile';
    public function render()
    {
        return view('livewire.profile');
    }
}
