<?php

namespace App\Livewire\Admin;

use App\Models\News;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NewsManager extends Component
{
    use WithFileUploads;

    public $news_id, $title, $content, $category, $thumbnail, $old_thumbnail, $youtube_video_id;
    public $is_highlight = false;
    public $is_member_only = false;
    public $isModalOpen = false;

    public function render()
    {
        return view('livewire.admin.news-manager', [
            'all_news' => News::latest()->paginate(10)
        ])->layout('layouts.app');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal() { $this->isModalOpen = true; }
    public function closeModal() { $this->isModalOpen = false; }

    private function resetInputFields() {
        $this->title = ''; 
        $this->content = ''; 
        $this->category = '';
        $this->youtube_video_id = '';
        $this->thumbnail = null; 
        $this->old_thumbnail = null;
        $this->is_highlight = false; 
        $this->is_member_only = false;
        $this->news_id = null;
    }

    public function store()
    {
        // 1. Validasi
        $this->validate([
            'title' => 'required|min:5',
            'category' => 'required|in:Film,Series,Shorts,Reviews,Technology,Events,Jobs',
            'content' => 'required',
            'thumbnail' => 'nullable|image|max:2048', 
        ]);

        // 2. Inisialisasi $data untuk menghindari Undefined Variable
        $data = [
            'title'            => $this->title,
            'slug'             => Str::slug($this->title),
            'category'         => $this->category,
            'content'          => $this->content,
            'youtube_video_id' => $this->youtube_video_id,
            'is_highlight'     => $this->is_highlight,
            'is_member_only'   => $this->is_member_only,
        ];

        // 3. Handle Upload Thumbnail jika ada file baru
        if ($this->thumbnail) {
            // Hapus foto lama jika sedang update berita
            if ($this->old_thumbnail) {
                Storage::disk('public')->delete($this->old_thumbnail);
            }
            $data['thumbnail'] = $this->thumbnail->store('news', 'public');
        }

        // 4. Proses Simpan (Update atau Create)
        News::updateOrCreate(['id' => $this->news_id], $data);

        // 5. Feedback & Reset
        session()->flash('message', $this->news_id ? 'News Updated successfully.' : 'News Created successfully.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        $this->news_id = $id;
        $this->title = $news->title;
        $this->content = $news->content;
        $this->category = $news->category;
        $this->youtube_video_id = $news->youtube_video_id;
        $this->is_highlight = $news->is_highlight;
        $this->is_member_only = $news->is_member_only;
        $this->old_thumbnail = $news->thumbnail;

        $this->openModal();
    }

    public function delete($id)
    {
        $news = News::find($id);
        if($news->thumbnail) {
            Storage::disk('public')->delete($news->thumbnail);
        }
        $news->delete();
        session()->flash('message', 'News Deleted.');
    }
}