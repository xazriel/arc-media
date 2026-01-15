<?php

namespace App\Livewire;

use App\Models\News;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class NewsIndex extends Component
{
    use WithPagination;

    #[Url]
    public $search = '';

    #[Url]
    public $selectedCategory = 'All';

    // Otomatis balik ke halaman 1 jika filter berubah
    public function updatedSearch() { $this->resetPage(); }
    public function updatedSelectedCategory() { $this->resetPage(); }

    public function render()
    {
        // 1. Ambil Berita Trending (Hanya muncul jika di kategori All dan tidak sedang cari berita)
        $trending = News::where('is_highlight', true)->latest()->first();

        // 2. Query Utama untuk List News
        $query = News::query();

        // Filter berdasarkan kategori
        if ($this->selectedCategory !== 'All') {
            $query->where('category', $this->selectedCategory);
        }

        // Filter berdasarkan pencarian title
        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }

        return view('livewire.news-index', [
            'trending' => $trending,
            'all_news' => $query->latest()->paginate(9),
        ])->layout('layouts.app');
    }
}