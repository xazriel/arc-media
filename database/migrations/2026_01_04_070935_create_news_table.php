<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('news', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('slug')->unique(); // Untuk URL SEO: arc-media.test/news/judul-berita
        $table->string('category'); // AI, Animation, Industry, ARC Update
        $table->longText('content'); // Isi berita (bisa simpan teks panjang & HTML)
        $table->string('thumbnail')->nullable(); // Foto utama berita
        $table->string('youtube_video_id')->nullable(); // ID video YT (misal: dQw4w9WgXcQ)
        $table->boolean('is_member_only')->default(false); // TRUE jika khusus member
        $table->integer('views')->default(0); // Hitung total view
        $table->timestamps(); // Mencatat created_at (tanggal upload) & updated_at
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
