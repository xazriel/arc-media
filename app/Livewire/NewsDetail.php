<?php

namespace App\Livewire;

use App\Models\News;
use Livewire\Component;


class NewsDetail extends Component
{
    public $news;
    public $videoId;
    public $relatedNews; 

    public function mount($slug)
    {
        $this->news = News::where('slug', $slug)->firstOrFail();

        $this->news->increment('views');

        $this->relatedNews = News::where('category', $this->news->category)
        ->where('id', '!=', $this->news->id)
        ->latest()
        ->take(3)
        ->get();

    // Jika berita di kategori yang sama kurang dari 3, ambil dari berita terbaru lainnya
    if ($this->relatedNews->count() < 3) {
        $extraNews = News::where('id', '!=', $this->news->id)
            ->whereNotIn('id', $this->relatedNews->pluck('id'))
            ->latest()
            ->take(3 - $this->relatedNews->count())
            ->get();
            
        $this->relatedNews = $this->relatedNews->concat($extraNews);
    }
        
        $this->videoId = $this->parseYoutubeId($this->news->youtube_video_id);
    }

    private function parseYoutubeId($url)
{
    if (!$url) return null;

    // Menghapus spasi dan parameter tambahan yang merusak (seperti ?si=...)
    $url = trim($url);

    // Regex ini akan mencari 11 karakter ID YouTube dan mengabaikan sisanya
    $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i';
    
    if (preg_match($pattern, $url, $match)) {
        return $match[1]; // Hanya mengambil 'wq32ij2qaDs'
    }

    // Jika input yang dimasukkan ternyata sudah berupa ID (11 karakter)
    return (strlen($url) === 11) ? $url : null;
}
    
    public function incrementLike()
{
    // Cek apakah di session sudah ada tanda kalau user ini sudah like berita ini
    $sessionKey = 'liked_news_' . $this->news->id;

    if (!session()->has($sessionKey)) {
        // Jika belum pernah like, tambah angkanya
        $this->news->increment('likes');
        
        // Tandai session agar tidak bisa like lagi
        session()->put($sessionKey, true);
        
        // Refresh data agar angka di layar update
        $this->news->refresh();
    } else {
        // Opsional: Jika diklik lagi, bisa jadi 'Unlike'
        $this->news->decrement('likes');
        session()->forget($sessionKey);
        $this->news->refresh();
    }
}

    public function render()
{
    // Gunakan 'layouts.app' karena file ada di resources/views/layouts/app.blade.php
    return view('livewire.news-detail')->layout('layouts.app');
}

}