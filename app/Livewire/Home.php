<?php

namespace App\Livewire;

use App\Models\News;
use App\Models\Project; // Tambahkan baris ini
use Livewire\Component;

class Home extends Component
{
    public function render()
{
    return view('livewire.home', [
            // Slider Atas: Hanya berita yang dicentang 'is_highlight'
            'highlight' => News::where('is_highlight', true)
                            ->latest()
                            ->take(3)
                            ->get(),
            
            // Frontline: Berita terbaru yang bukan highlight
            'latest_news' => News::where('is_highlight', false)
                                 ->latest()
                                 ->take(3) 
                                 ->get(),

            // Projects: Ambil project yang difitur
            'featured_projects' => Project::where('is_featured', true)
                                    ->latest()
                                    ->get(),
            
        ])->layout('layouts.app');
    }
}