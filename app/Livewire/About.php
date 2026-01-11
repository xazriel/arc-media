<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout; // 1. Tambahkan ini

class About extends Component
{
    #[Title('About Us - ARC MEDIA')]
    #[Layout('layouts.app')] // 2. Arahkan ke layout milik Breeze
    public function render()
    {
        return view('livewire.about');
    }
}