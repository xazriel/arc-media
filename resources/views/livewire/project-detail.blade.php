<div class="bg-white">
    {{-- 1. HERO SECTION --}}
    <section class="relative h-[75vh] min-h-[550px] w-full bg-slate-900 overflow-hidden">
        {{-- Banner Image --}}
        <img src="{{ asset('storage/' . $project->banner_image) }}" 
             class="w-full h-full object-cover opacity-80">
        
        <div class="absolute inset-0 bg-[#36B7E5]/20"></div>

        {{-- Logo Project di Tengah --}}
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-4">
            <img src="{{ asset('storage/' . $project->logo_project) }}" 
                 class="h-40 md:h-64 object-contain mb-8 drop-shadow-[0_35px_35px_rgba(0,0,0,0.5)] z-20">
        </div>
    </section>

    {{-- Back Button --}}
    <div class="max-w-7xl mx-auto px-4 pt-8">
        <a href="{{ route('projects.index')}}" class="inline-flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 hover:text-black transition-all group">
            <svg class="w-3 h-3 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Project
        </a>
    </div>

    {{-- 2. TITLE & DESCRIPTION SECTION --}}
    <section class="relative z-20 py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-black text-center uppercase italic mb-16 tracking-tighter text-slate-900">
            {{ $project->title }}
        </h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-start">
            {{-- Video/Thumbnail --}}
            <div class="rounded-[1.5rem] overflow-hidden shadow-2xl bg-slate-100 aspect-video group border-4 border-white">
                @if($project->youtube_video_id)
                    <iframe class="w-full h-full" 
                            src="https://www.youtube.com/embed/{{ $project->youtube_video_id }}" 
                            frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                    </iframe>
                @else
                    <img src="{{ asset('storage/' . $project->thumbnail) }}" class="w-full h-full object-cover">
                @endif
            </div>

            {{-- Deskripsi & Tombol YouTube --}}
            <div class="flex flex-col justify-center">
                <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed text-lg italic font-medium mb-10">
                    {!! $project->description !!}
                </div>
                
                <a href="https://www.youtube.com/@NussaOfficialSeries" 
                target="_blank" 
                class="inline-flex items-center w-fit gap-4 bg-arc-red text-white px-8 py-4 rounded-xl font-black text-xs uppercase italic hover:bg-arc-black transition-all shadow-xl hover:-translate-y-1">
                    <span>Watch on Youtube</span>
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- 3. THE CHARACTERS SECTION (FIXED) --}}
    <section class="py-24 bg-white border-t border-slate-50">
        {{-- Header Title dengan Background Blur --}}
        <div class="relative h-48 md:h-64 w-full overflow-hidden mb-24">
            <img src="{{ asset('storage/' . $project->banner_image) }}" class="w-full h-full object-cover opacity-20">
            <div class="absolute inset-0 flex flex-col items-center justify-center">
                <h2 class="text-5xl md:text-7xl font-black text-slate-900 uppercase italic tracking-tighter">The Characters</h2>

            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Menggunakan data dinamis dari database --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-y-24 gap-x-12">
                @forelse($project->characters as $char)
                    <div class="flex flex-col items-center group">
                        {{-- Frame Foto Bulat --}}
                        <div class="w-40 h-40 md:w-64 md:h-64 rounded-full p-2 bg-gradient-to-b from-[#A5E5FF] to-[#36B7E5] shadow-2xl transition-all duration-500 group-hover:scale-105">
                            <div class="w-full h-full rounded-full overflow-hidden bg-white border-4 border-white">
                                <img src="{{ asset('storage/' . $char->image) }}" 
                                     alt="{{ $char->name }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            </div>
                        </div>
                        {{-- Nama Karakter --}}
                        <h4 class="mt-8 text-2xl font-black text-slate-800 uppercase italic tracking-tight group-hover:text-red-600 transition-colors text-center">
                            {{ $char->name }}
                        </h4>
                    </div>
                @empty
                    <div class="col-span-full text-center py-10">
                        <p class="text-slate-400 italic uppercase font-black tracking-widest text-xs">No characters revealed for this project yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</div>