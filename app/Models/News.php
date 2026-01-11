<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory;

    /**
     * fillable: Kolom mana saja yang boleh diisi secara massal.
     * Ini penting untuk keamanan agar tidak ada data liar masuk ke DB.
     */
    protected $fillable = [
        'title',
        'slug',
        'category',
        'is_highlight',
        'content',
        'thumbnail',
        'youtube_video_id',
        'is_member_only',
        'views',
    ];

    /**
     * cast: Memastikan tipe data benar saat dipanggil.
     * Kita ingin 'is_member_only' selalu terbaca sebagai True/False (Boolean).
     */
    protected $casts = [
        'is_member_only' => 'boolean',
    ];

    /**
     * Helper Function: Mendapatkan URL Thumbnail atau Placeholder.
     * Berguna jika admin lupa upload thumbnail.
     */
    public function getThumbnailUrl()
    {
        return $this->thumbnail 
            ? asset('storage/' . $this->thumbnail) 
            : 'https://via.placeholder.com/800x450.png?text=ARC+MEDIA';
    }
}