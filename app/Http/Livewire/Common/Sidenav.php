<?php

namespace App\Http\Livewire\Common;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Sidenav extends Component
{
    public $page;
    public function render()
    {
        if (Auth::user()->role == 'admin') {
            return view('livewire.common.Admin.sidenav');
        }elseif (Auth::user()->role == 'superadmin') {
            return view('livewire.common.Admin.sidenav');
        }
        elseif (Auth::user()->role == 'employee') {
            return view('livewire.common.User.sidenav');
        } elseif (Auth::user()->role == 'candidate') {
            return view('livewire.common.Candidate.sidenav');
        }
    }
}
