<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;

class ProjectDetail extends Component
{
    public $project;

    public function mount($slug)
    {
        // Cari project berdasarkan slug
        $this->project = Project::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.project-detail')->layout('layouts.app');
    }
}