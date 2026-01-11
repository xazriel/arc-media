<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Home;
use App\Livewire\NewsDetail;
use App\Livewire\Admin\NewsManager;
use App\Livewire\Admin\CreateNews;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Livewire\NewsIndex;
use App\Livewire\Admin\ProjectManager;
use App\Livewire\ProjectIndex;
use App\Livewire\ProjectDetail;
use App\Livewire\About; 
use App\Livewire\Contact;

/*
|--------------------------------------------------------------------------
| 1. PUBLIC ROUTES (Bisa diakses siapa saja)
|--------------------------------------------------------------------------
*/

// Halaman Utama / Landing Page
Route::get('/', Home::class)->name('home');

// Halaman Detail Berita (menggunakan slug untuk SEO)
Route::get('/news/{slug}', NewsDetail::class)->name('news.show');

Route::get('/news', \App\Livewire\NewsIndex::class)->name('news.index');

Route::get('/projects', ProjectIndex::class)->name('projects.index');

Route::get('/projects/{slug}', ProjectDetail::class)->name('projects.show');

Route::get('/about', About::class)->name('about');

Route::get('/contact', Contact::class)->name('contact');

/*
|--------------------------------------------------------------------------
| 2. PROTECTED ROUTES (Hanya untuk Admin dengan Role Admin)
|--------------------------------------------------------------------------
*/

    Route::middleware(['auth', 'verified', 'admin'])->group(function () {

    Route::get('/admin/projects', ProjectManager::class)->name('admin.projects');

    /**
     * DASHBOARD UTAMA
     * Mengirim data statistik untuk ditampilkan di "Control Center"
     */
    Route::get('/dashboard', function () {
        return view('dashboard', [
            'totalNews' => News::count(),
            'totalHighlights' => News::where('is_highlight', true)->count(),
            'recentNews' => News::latest()->take(5)->get(),
        ]);
    })->name('dashboard');

    /**
     * CONTENT MANAGEMENT SYSTEM (CMS)
     * Mengelola berita menggunakan Livewire
     */
    // CRUD Utama News (All-in-one Manager)
    Route::get('/admin/news', NewsManager::class)->name('admin.news');
    
    // Form Tambah Berita
    Route::get('/admin/news/create', CreateNews::class)->name('news.create');

    /**
     * USER PROFILE
     */
    Route::view('profile', 'profile')->name('profile');
});

/*
|--------------------------------------------------------------------------
| 3. AUTH & ADDITIONAL ROUTES
|--------------------------------------------------------------------------
*/

// Rute Logout GET khusus untuk memudahkan navigasi Logout di Admin
Route::get('/logout', function (Request $request) {
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout.get');

// Memanggil semua rute otentikasi dari Breeze Volt (Login, Register, dll)
require __DIR__.'/auth.php';