<?php

namespace App\Livewire;

use Auth;
use Livewire\Component;

class Followers extends Component
{
    public $followers;
    public function render()
    {
        $this->followers = Auth::user()->followers;
        return view('livewire.followers');
    }
}
