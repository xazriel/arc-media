<?php

namespace App\Livewire;

use App\Models\News;
use Livewire\Component;
use Livewire\WithPagination;

class NewsIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedCategory = 'All';

    protected $queryString = ['search', 'selectedCategory'];

    public function render()
    {
        $query = News::query();

        if ($this->selectedCategory !== 'All') {
            $query->where('category', $this->selectedCategory);
        }

        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }

        return view('livewire.news-index', [
            // Berita utama untuk section Trending
            'trending' => News::where('is_highlight', true)->latest()->first(),
            
            // List berita dengan pagination
            'all_news' => $query->latest()->paginate(6),
            
            // Video terbaru untuk section bawah
            'latest_video' => News::whereNotNull('youtube_video_id')->latest()->first()
        ])->layout('layouts.app');
    }
}