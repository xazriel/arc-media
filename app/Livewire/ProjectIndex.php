<?php

namespace App\Livewire;

use App\Models\Project;
use App\Models\News;
use Livewire\Component;

class ProjectIndex extends Component
{
    public function render()
    {
        return view('livewire.project-index', [
            // Mengambil semua project untuk ditampilkan di grid
            'projects' => Project::latest()->get(),
            
            // Mengambil 3 berita terbaru untuk section Articles di bawah
            'latest_articles' => News::latest()->take(3)->get(),
        ])->layout('layouts.app'); // Memastikan menggunakan layout utama
    }
}   