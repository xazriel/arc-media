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
    Schema::create('projects', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('slug')->unique();
        $table->string('status'); // Contoh: 'Coming Soon 2027' atau 'On Mentari TV'
        $table->text('description')->nullable();
        
        // Asset Gambar
        $table->string('thumbnail'); // Untuk grid kecil (Ongoing Project)
        $table->string('banner_image')->nullable(); // Untuk banner besar di atas
        $table->string('logo_project')->nullable(); // Untuk logo transparan (seperti logo Ibra)
        
        // Pengaturan Tampilan
        $table->boolean('is_featured')->default(false); // Jika true, muncul di banner atas
        $table->integer('order')->default(0); // Untuk mengatur urutan tampilan
        
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
