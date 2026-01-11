<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'status',
        'description',
        'thumbnail',
        'banner_image',
        'logo_project',
        'is_featured',
        'order'
    ];

    // Otomatis buat slug saat title diisi
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($project) {
            $project->slug = Str::slug($project->title);
        });
    }

    public function characters()
    {
    return $this->hasMany(Character::class);
    }

    
}