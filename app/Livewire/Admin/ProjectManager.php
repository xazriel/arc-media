<?php

namespace App\Livewire\Admin;

use App\Models\Project;
use App\Models\Character; // Pastikan Model Character di-import
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectManager extends Component
{
    use WithFileUploads;

    // Project Properties
    public $projects, $title, $status, $description, $thumbnail, $banner_image, $logo_project, $project_id;
    public $is_featured = false;
    public $isOpen = false;

    // Character Properties
    public $character_images = []; // Untuk menampung file upload baru
    public $existing_characters = []; // Untuk menampilkan karakter yang sudah tersimpan

    public function render()
    {
        $this->projects = Project::orderBy('order', 'asc')->get();
        
        return view('livewire.admin.project-manager')
                ->layout('layouts.app');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal() 
    { 
        $this->isOpen = true; 
    }

    public function closeModal() 
    { 
        $this->isOpen = false; 
        $this->resetInputFields();
    }

    private function resetInputFields() 
    {
        $this->title = '';
        $this->status = '';
        $this->description = '';
        $this->thumbnail = null;
        $this->banner_image = null;
        $this->logo_project = null;
        $this->is_featured = false;
        $this->project_id = null;
        $this->character_images = [];
        $this->existing_characters = [];
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'status' => 'required',
            'thumbnail' => $this->project_id ? 'nullable|image|max:2048' : 'required|image|max:2048',
            'banner_image' => 'nullable|image|max:3072',
            'logo_project' => 'nullable|image|max:1024',
            'character_images.*' => 'nullable|image|max:2048', // Validasi tiap file karakter
        ]);

        $data = [
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'status' => $this->status,
            'description' => $this->description,
            'is_featured' => (bool) $this->is_featured,
        ];

        // Handle Main Project Assets Uploads
        if ($this->thumbnail) {
            $data['thumbnail'] = $this->thumbnail->store('projects/thumbnails', 'public');
        }
        if ($this->banner_image) {
            $data['banner_image'] = $this->banner_image->store('projects/banners', 'public');
        }
        if ($this->logo_project) {
            $data['logo_project'] = $this->logo_project->store('projects/logos', 'public');
        }

        // Save Project
        $project = Project::updateOrCreate(['id' => $this->project_id], $data);

        // Handle Character Images Uploads (Multiple)
        if (!empty($this->character_images)) {
            foreach ($this->character_images as $image) {
                // Ambil nama file tanpa ekstensi untuk dijadikan nama karakter default
                $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $cleanName = str_replace(['-', '_'], ' ', $originalName);

                $path = $image->store('projects/characters', 'public');

                $project->characters()->create([
                    'name' => strtoupper($cleanName),
                    'image' => $path
                ]);
            }
        }

        session()->flash('message', $this->project_id ? 'Project Strategy Updated.' : 'New Project Executed.');

        $this->closeModal();
    }

    public function edit($id)
    {
        $this->resetInputFields();
        $project = Project::with('characters')->findOrFail($id);
        
        $this->project_id = $id;
        $this->title = $project->title;
        $this->status = $project->status;
        $this->description = $project->description;
        $this->is_featured = $project->is_featured;
        
        // Load existing characters ke dalam array untuk ditampilkan di view
        $this->existing_characters = $project->characters;

        $this->openModal();
    }

    public function deleteCharacter($charId)
    {
        $character = Character::findOrFail($charId);
        
        // Hapus file dari storage
        if ($character->image) {
            Storage::disk('public')->delete($character->image);
        }
        
        $character->delete();

        // Refresh list karakter yang ada
        $this->existing_characters = Character::where('project_id', $this->project_id)->get();
    }

    public function delete($id)
    {
        $project = Project::with('characters')->find($id);
        
        // Hapus asset utama
        if($project->thumbnail) Storage::disk('public')->delete($project->thumbnail);
        if($project->banner_image) Storage::disk('public')->delete($project->banner_image);
        if($project->logo_project) Storage::disk('public')->delete($project->logo_project);
        
        // Hapus semua file gambar karakter terkait
        foreach($project->characters as $char) {
            Storage::disk('public')->delete($char->image);
        }

        $project->delete();
        session()->flash('message', 'Project and all assets terminated.');
    }
}