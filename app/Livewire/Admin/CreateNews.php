<?php

namespace App\Livewire\Admin;

use App\Models\News;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class CreateNews extends Component
{
    use WithFileUploads;

    // TAMBAHKAN $is_highlight DISINI
    public $title, $category, $content, $youtube_video_id, $thumbnail, $is_highlight = false; 
    public $is_member_only = false;

    public function save()
    {
        $this->validate([
        'title' => 'required|min:5',
        // Tambahkan 'in:...' untuk memastikan kategori sesuai dengan pilihan dropdown
        'category' => 'required|in:Film,Series,Shorts,Reviews,Technology,Events,Jobs',
        'content' => 'required',
        'thumbnail' => 'nullable|image|max:2048',
    ]);

        try {
            $path = $this->thumbnail ? $this->thumbnail->store('thumbnails', 'public') : null;

            News::create([
                'title'            => $this->title,
                'slug'             => Str::slug($this->title),
                'category'         => $this->category,
                'content'          => $this->content,
                'youtube_video_id' => $this->youtube_video_id,
                'is_member_only'   => $this->is_member_only,
                'is_highlight'     => $this->is_highlight, // TAMBAHKAN INI
                'thumbnail'        => $path,
            ]);

            session()->flash('message', 'Berita berhasil diterbitkan!');
            return redirect()->to('/dashboard');

        } catch (\Exception $e) {
            session()->flash('error', 'Gagal: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.create-news')->layout('layouts.app');
    }
}