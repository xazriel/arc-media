<div class="bg-white">
    {{-- 1. HERO SLIDER SECTION (HIGHLIGHTS) --}}
    @if(!$highlight->isEmpty())
    <section x-data="{ 
        activeSlide: 0, 
        slidesCount: {{ $highlight->count() }},
        next() { this.activeSlide = this.activeSlide === this.slidesCount - 1 ? 0 : this.activeSlide + 1 },
        prev() { this.activeSlide = this.activeSlide === 0 ? this.slidesCount - 1 : this.activeSlide - 1 }
    }" 
    x-init="setInterval(() => next(), 7000)"
    class="relative h-screen min-h-[700px] w-full bg-black overflow-hidden">
        
        @foreach($highlight as $index => $item)
        <div x-show="activeSlide === {{ $index }}" 
             x-transition:enter="transition ease-out duration-700"
             x-transition:enter-start="opacity-0 transform scale-105"
             x-transition:enter-end="opacity-100 transform scale-100"
             x-transition:leave="transition ease-in duration-700"
             x-transition:leave-start="opacity-100 transform scale-100"
             x-transition:leave-end="opacity-0 transform scale-95"
             class="absolute inset-0">
            
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent z-10"></div>
            <img src="{{ asset('storage/' . $item->thumbnail) }}" class="w-full h-full object-cover">

            <div class="absolute inset-0 z-20 flex flex-col justify-end pb-32 px-4 sm:px-6 lg:px-8">
                <div class="max-w-7xl mx-auto w-full">
                    <div class="inline-block bg-red-600 text-white text-[10px] font-black px-4 py-1 uppercase italic tracking-widest mb-6">
                        #MULAIDARIKITA / TRENDING
                    </div>
                    <h1 class="text-5xl md:text-8xl font-black text-white uppercase italic tracking-tighter leading-[0.85] mb-8 max-w-4xl">
                        {{ $item->title }}
                    </h1>
                    <p class="text-slate-300 max-w-2xl text-lg font-medium mb-10 line-clamp-2">
                        {{ Str::limit(strip_tags($item->content), 180) }}
                    </p>
                    
                    {{-- Tambahan: Read More Hero --}}
                    <a href="{{ route('news.show', $item->slug) }}" class="inline-flex items-center gap-3 text-white font-black uppercase text-xs tracking-widest group">
                        Read More 
                        <span class="bg-white text-black w-8 h-8 flex items-center justify-center rounded-full group-hover:bg-red-600 group-hover:text-white transition-all duration-300">
                            →
                        </span>
                    </a>
                </div>
            </div>
        </div>
        @endforeach

        {{-- Navigasi Panah --}}
        <div class="absolute bottom-12 right-12 z-40 flex gap-4">
            <button @click="prev()" class="w-14 h-14 rounded-full border border-white/20 bg-black/20 backdrop-blur-md flex items-center justify-center text-white hover:bg-red-600 hover:border-red-600 transition-all duration-300 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button @click="next()" class="w-14 h-14 rounded-full border border-white/20 bg-black/20 backdrop-blur-md flex items-center justify-center text-white hover:bg-red-600 hover:border-red-600 transition-all duration-300 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>

        {{-- Navigation Dots --}}
        <div class="absolute bottom-12 left-1/2 -translate-x-1/2 z-30 flex gap-3">
            @foreach($highlight as $index => $item)
            <button @click="activeSlide = {{ $index }}" 
                :class="activeSlide === {{ $index }} ? 'w-12 bg-red-600' : 'w-3 bg-white/30'"
                class="h-1 transition-all duration-500 rounded-full"></button>
            @endforeach
        </div>
    </section>
    @endif

    {{-- 2. WELCOME SECTION --}}
    <section class="py-24 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
            <div>
                <h2 class="text-6xl md:text-8xl font-black uppercase tracking-tighter leading-none text-slate-900">
                    Welcome<br>to <span class="text-red-600">ARC</span><br>Media
                </h2>
            </div>
            <div class="pt-4">
                <h3 class="text-2xl font-bold uppercase italic tracking-tight mb-6 text-slate-800 leading-tight">
                    Ruang kolaborasi kreatif untuk kemajuan industri animasi Indonesia.
                </h3>
                <p class="text-slate-500 text-lg leading-relaxed mb-8">
                    Sebagaimana diskusi mengenai masa depan industri animasi hybrid di tahun 2026, kami percaya kolaborasi antara teknologi AI dan kreativitas manusia adalah kunci utama kemajuan IP Lokal.
                </p>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-[2px] bg-red-600"></div>
                    <span class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400">Scroll to Explore</span>
                </div>
            </div>
        </div>
    </section>

    {{-- 3. FEATURED PROJECTS (HORIZONTAL SCROLL) --}}
    <section class="py-24 bg-white overflow-hidden border-t border-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">
            <div class="flex justify-between items-end">
                <div>
                    <span class="text-red-600 font-black text-[10px] uppercase tracking-[0.3em] italic mb-2 block">On Going</span>
                    <h2 class="text-4xl md:text-5xl font-black uppercase italic tracking-tighter text-slate-900">Project</h2>
                </div>
                <a href="/projects" class="hidden md:block text-[10px] font-black uppercase tracking-widest border-b-2 border-black pb-1 hover:text-red-600 hover:border-red-600 transition-all">
                    Explore All Project →
                </a>
            </div>
        </div>

        <div class="flex gap-10 overflow-x-auto pb-12 px-[5%] snap-x snap-mandatory custom-scrollbar">
            @forelse($featured_projects as $project)
            <div class="flex-none w-[320px] md:w-[600px] snap-center group">
                {{-- Modifikasi: Tambahkan anchor link membungkus kartu --}}
                <a href="{{ route('projects.show', $project->slug) }}" class="block">
                    <div class="relative aspect-[16/9] overflow-hidden rounded-[3rem] mb-8 shadow-2xl shadow-slate-200 bg-slate-100">
                        <img src="{{ asset('storage/' . $project->banner_image) }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                        
                        <div class="absolute inset-0 bg-black/40 backdrop-blur-[2px] flex items-center justify-center p-16 opacity-0 group-hover:opacity-100 transition-all duration-500">
                            <img src="{{ asset('storage/' . $project->logo_project) }}" class="max-w-full max-h-full object-contain transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                        </div>

                        <div class="absolute bottom-6 left-6">
                            <span class="bg-white text-black text-[8px] font-black px-5 py-2 rounded-full uppercase tracking-widest shadow-lg">
                                {{ $project->status }}
                            </span>
                        </div>
                    </div>
                </a>
                <div class="px-4 flex justify-between items-end">
    <div>
        <h3 class="text-3xl font-black uppercase italic tracking-tighter text-slate-800 group-hover:text-red-600 transition-colors">
            {{ $project->title }}
        </h3>
        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mt-2 italic">Architecture of Imagination / 2026</p>
    </div>

    {{-- Tombol Read More Project yang Konsisten --}}
    <a href="{{ route('projects.show', $project->slug) }}" class="inline-flex items-center gap-3 text-slate-900 font-black uppercase text-[10px] tracking-[0.2em] group shrink-0">
        Read Project 
        <span class="bg-slate-900 text-white w-10 h-10 flex items-center justify-center rounded-full group-hover:bg-red-600 group-hover:text-white transition-all duration-300">
            →
        </span>
    </a>
</div>
            </div>
            @empty
            <div class="w-full py-20 text-center">
                <p class="text-slate-300 font-black uppercase italic tracking-widest">Masterpieces are being rendered...</p>
            </div>
            @endforelse
        </div>
    </section>

    {{-- 4. LATEST FROM THE FRONTLINE SECTION --}}
    <section class="py-24 bg-slate-50 border-y border-slate-100 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-end mb-16">
                <div>
                    <span class="text-red-600 font-black text-[10px] uppercase tracking-[0.3em] italic mb-2 block">Update</span>
                    <h2 class="text-4xl md:text-5xl font-black uppercase italic tracking-tighter text-slate-900">Latest From The Frontline</h2>
                </div>
                <a href="/news" class="hidden md:flex items-center gap-3 text-[10px] font-black uppercase border-2 border-black px-8 py-3 rounded-full hover:bg-black hover:text-white transition duration-300">
                    View All News <span>→</span>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse($latest_news as $news)
                <article class="group">
                    <a href="{{ route('news.show', $news->slug) }}" class="block">
                        <div class="relative h-[300px] overflow-hidden rounded-[2.5rem] mb-8 shadow-xl shadow-slate-200/50 bg-white">
                            <img src="{{ asset('storage/' . $news->thumbnail) }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            
                            <div class="absolute top-6 left-6 flex flex-col gap-2">
                                <span class="bg-white/90 backdrop-blur-sm text-black text-[8px] font-black px-4 py-1.5 rounded-full uppercase tracking-widest shadow-sm">
                                    {{ $news->category }}
                                </span>
                                @if($news->is_member_only)
                                <span class="bg-blue-600 text-white text-[8px] font-black px-4 py-1.5 rounded-full uppercase tracking-widest shadow-sm">
                                    Member Only
                                </span>
                                @endif
                            </div>
                        </div>
                    </a>
                    
                    <div class="px-2">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3 flex items-center gap-2">
                            {{ $news->created_at->format('M d, Y') }}
                            <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                            {{ $news->views ?? 0 }} Views
                        </p>
                        <h3 class="text-2xl font-black uppercase italic tracking-tighter leading-tight group-hover:text-red-600 transition-colors duration-300 text-slate-900 mb-6">
                            <a href="{{ route('news.show', $news->slug) }}">{{ $news->title }}</a>
                        </h3>
                        
                        {{-- Tambahan: Read More News yang Konsisten --}}
                    <div class="mt-8">
                        <a href="{{ route('news.show', $news->slug) }}" class="inline-flex items-center gap-3 text-slate-900 font-black uppercase text-[10px] tracking-[0.2em] group">
                            Read More
                            <span class="bg-slate-900 text-white w-9 h-9 flex items-center justify-center rounded-full group-hover:bg-red-600 group-hover:text-white transition-all duration-300">
                                →
                            </span>
                        </a>
                    </div>
                </article>
                @empty
                <div class="col-span-full py-20 text-center">
                    <p class="text-slate-400 font-black uppercase italic">No news from the frontline yet.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

        {{-- 5. ARC LATEST VIDEO SECTION --}}
    <section class="py-24 bg-white border-t border-slate-100 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center gap-3 mb-12">
                <div class="w-1.5 h-8 bg-red-600"></div>
                <h2 class="text-3xl md:text-5xl font-black uppercase tracking-tighter italic text-slate-900">ARC LATEST VIDEO</h2>
            </div>

            <div class="bg-black rounded-[2rem] md:rounded-[3rem] overflow-hidden flex flex-col lg:flex-row shadow-2xl border-4 border-white">
                {{-- Video Player Side --}}
                <div class="lg:w-2/3 relative aspect-video bg-zinc-900">
                    {{-- Menggunakan link video yang Anda berikan --}}
                    <iframe class="absolute inset-0 w-full h-full" 
                        src="https://www.youtube.com/embed/WkP4k-mWOjk" 
                        title="Studio Animasi DIPADIRA dengan karya nya KWARTET" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                </div>

                {{-- Info Side --}}
                <div class="lg:w-1/3 p-8 md:p-12 flex flex-col justify-center bg-zinc-950 text-white">
                    <div class="flex items-center gap-3 text-red-600 mb-6">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                            <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/>
                        </svg>
                        <span class="text-[10px] font-black uppercase tracking-[0.3em]">ARC UNITE</span>
                    </div>

                    <h3 class="text-2xl md:text-3xl font-black uppercase italic tracking-tighter leading-tight mb-6">
                        Studio Animasi DIPADIRA dengan karya nya "KWARTET" Begini kisah perjalanannya...
                    </h3>

                    <div class="flex flex-wrap gap-2 mb-10">
                        <span class="text-[9px] bg-zinc-800 px-3 py-1 rounded-full text-zinc-400 font-bold">#trending</span>
                        <span class="text-[9px] bg-zinc-800 px-3 py-1 rounded-full text-zinc-400 font-bold">#animation</span>
                        <span class="text-[9px] bg-zinc-800 px-3 py-1 rounded-full text-zinc-400 font-bold">#Dipadira</span>
                    </div>

                    {{-- Tombol diarahkan langsung ke video YouTube --}}
                    <a href="https://www.youtube.com/watch?v=WkP4k-mWOjk" target="_blank" 
                       class="group relative overflow-hidden bg-red-600 text-white text-center py-4 rounded-xl font-black uppercase text-[10px] tracking-[0.2em] transition-all hover:bg-white hover:text-black">
                        <span class="relative z-10">Watch on YouTube</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Custom Scrollbar CSS --}}
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            height: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            margin: 0 10%;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #ef4444;
            border-radius: 10px;
        }
    </style>
</div>