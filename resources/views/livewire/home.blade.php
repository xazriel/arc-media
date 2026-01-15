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
class="relative 
h-[52vh] sm:h-[65vh] md:h-screen
min-h-[300px] sm:min-h-[360px] md:min-h-[700px]
       w-full bg-black overflow-hidden"
        
        @foreach($highlight as $index => $item)
        <div x-show="activeSlide === {{ $index }}" 
             x-transition:enter="transition ease-out duration-700"
             x-transition:enter-start="opacity-0 transform scale-105"
             x-transition:enter-end="opacity-100 transform scale-100"
             x-transition:leave="transition ease-in duration-700"
             x-transition:leave-start="opacity-100 transform scale-100"
             x-transition:leave-end="opacity-0 transform scale-95"
             class="absolute inset-0">
            
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent z-10"></div>
            <img src="{{ asset('storage/' . $item->thumbnail) }}" class="w-full h-full object-cover">

            <div class="absolute inset-0 z-20 flex flex-col justify-end pb-3 sm:pb-6 md:pb-24 -translate-y-8 sm:-translate-y-4 md:translate-y-0">
                <div class="max-w-7xl mx-auto w-full lg:pl-6 xl:pl-8">
                    
                   <div class="inline-block bg-red-600 text-white text-[8px] sm:text-[10px] md:text-[11px] font-semibold px-2.5 sm:px-4 py-0.5 uppercase tracking-widest mb-4 rounded-sm">
                    #MULAIDARIKITA / TRENDING
                </div>

                    <h1 class="text-[17px] sm:text-xl md:text-5xl lg:text-6xl font-bold text-white uppercase tracking-tight leading-[1.1] mb-3 md:mb-4 max-w-3xl">
                        {{ $item->title }}
                    </h1>

                    <p class="text-slate-300 max-w-lg text-[10px] sm:text-xs md:text-base font-normal mb-3 line-clamp-2">
                        {{ Str::limit(strip_tags($item->content), 150) }}
                    </p>
                    
                    {{-- Read More --}}
                    <a 
                    href="{{ route('news.show', $item->slug) }}"
                    class="group inline-flex items-center gap-2
                            px-3 py-1.5
                            bg-white/10 backdrop-blur-sm
                            text-white text-[9px] font-semibold uppercase tracking-widest
                            rounded
                            hover:bg-white/20 transition-all duration-300"
                    >
                    Read More
                    <span class="transform transition-transform duration-300 group-hover:translate-x-1">
                        →
                    </span>
                    </a>

                </div>
            </div>
        </div>
        @endforeach

       {{-- Navigasi Panah --}}
<div class="absolute bottom-5 md:bottom-8  right-8 md:right-14 lg:right-20 z-40 flex gap-2 md:gap-3">
    <button @click="prev()"
        class="w-8 h-8 md:w-9 md:h-9
               rounded-full
               bg-white/10 backdrop-blur-sm
               flex items-center justify-center
               text-white
               hover:bg-white/20
               transition-all duration-300 group">
        <svg xmlns="http://www.w3.org/2000/svg"
             class="h-3.5 w-3.5 md:h-4 md:w-4
                    transform group-hover:-translate-x-0.5 transition-transform"
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 19l-7-7 7-7" />
        </svg>
    </button>

    <button @click="next()"
        class="w-8 h-8 md:w-9 md:h-9
               rounded-full
               bg-white/10 backdrop-blur-sm
               flex items-center justify-center
               text-white
               hover:bg-white/20
               transition-all duration-300 group">
        <svg xmlns="http://www.w3.org/2000/svg"
             class="h-3.5 w-3.5 md:h-4 md:w-4
                    transform group-hover:translate-x-0.5 transition-transform"
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 5l7 7-7 7" />
        </svg>
    </button>
</div>

        {{-- Navigation Dots --}}
        <div class="absolute bottom-6 md:bottom-12 left-1/2 -translate-x-1/2 z-30 flex gap-2 md:gap-3">
            @foreach($highlight as $index => $item)
            <button @click="activeSlide = {{ $index }}" 
                :class="activeSlide === {{ $index }} ? 'w-8 bg-red-600' : 'w-3 bg-white/30'"
                class="h-1 transition-all duration-500 rounded-full"></button>
            @endforeach
        </div>
    </section>
    @endif  

  {{-- 2. WELCOME SECTION --}}
<section class="py-14 md:py-16 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-10 items-start">
        
        <div>
            <h2 class="text-4xl sm:text-5xl md:text-6xl font-extrabold uppercase tracking-tight leading-[1.1] text-slate-900">
                Welcome<br>
                to <span class="text-red-600">ARC</span><br>
                Media
            </h2>
        </div>

        <div class="pt-1">
            <h3 class="text-lg md:text-xl font-semibold uppercase tracking-wide mb-3 text-slate-800 leading-snug">
                Ruang kolaborasi kreatif untuk kemajuan industri animasi Indonesia
            </h3>

            <p class="text-slate-500 text-base leading-relaxed mb-5 max-w-md">
                Sebagaimana diskusi mengenai masa depan industri animasi hybrid di tahun 2026, kami percaya kolaborasi antara teknologi AI dan kreativitas manusia adalah kunci utama kemajuan IP Lokal.
            </p>

            <div class="flex items-center gap-3">
                <div class="w-8 h-[2px] bg-red-600"></div>
                <span class="text-[9px] font-semibold uppercase tracking-[0.25em] text-slate-400">
                    Scroll to Explore
                </span>
            </div>
        </div>

    </div>
</section>


{{-- 3. FEATURED PROJECTS (GRID CLEAN) --}}
<section class="py-20 bg-white border-t border-slate-100">

    {{-- Header --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
        <div class="flex justify-between items-end">
            <div>
                <span class="text-red-600 font-semibold text-[9px] uppercase tracking-[0.35em] block mb-2">
                    On Going
                </span>
                <h2 class="text-3xl md:text-4xl font-extrabold uppercase tracking-tight text-slate-900">
                    Featured Projects
                </h2>
            </div>

            <a href="/projects"
               class="hidden md:inline-flex items-center gap-2
                      text-[9px] font-semibold uppercase tracking-widest
                      text-slate-900
                      hover:text-red-600 transition">
                Explore All
                <span class="transition-transform duration-300 group-hover:translate-x-1">→</span>
            </a>
        </div>
    </div>

    {{-- Grid Projects --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">

            @forelse($featured_projects as $project)
                <div class="group">

                    {{-- Card --}}
                    <a href="{{ route('projects.show', $project->slug) }}">
                        <div class="relative aspect-[16/9] overflow-hidden rounded-2xl mb-4 bg-slate-100">

                            <img src="{{ asset('storage/' . $project->banner_image) }}"
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">

                            {{-- Overlay Logo --}}
                            <div class="absolute inset-0 bg-black/40 backdrop-blur-[1px] 
                                        flex items-center justify-center opacity-0 
                                        group-hover:opacity-100 transition duration-500">
                                <img src="{{ asset('storage/' . $project->logo_project) }}"
                                     class="max-w-[60%] max-h-[60%] object-contain">
                            </div>

                            {{-- Status --}}
                            <div class="absolute bottom-3 left-3">
                                <span class="bg-white text-slate-900 text-[8px] font-semibold 
                                             px-3 py-1 rounded-full uppercase tracking-widest">
                                    {{ $project->status }}
                                </span>
                            </div>

                        </div>
                    </a>

                    {{-- Text + Button (STACKED / BUTTON DI BAWAH) --}}
                    <div class="flex flex-col gap-3">

                        <div>
                            <h3 class="text-base md:text-lg font-extrabold uppercase tracking-tight 
                                       text-slate-800 line-clamp-3 group-hover:text-red-600 transition-colors">
                                {{ $project->title }}
                            </h3>

                            <p class="text-[9px] font-medium text-slate-400 uppercase tracking-widest mt-2">
                                Architecture of Imagination / 2026
                            </p>
                        </div>

                        {{-- CTA --}}
                        <a href="{{ route('projects.show', $project->slug) }}"
                           class="inline-flex items-center gap-2
                                  w-fit
                                  px-3 py-1.5
                                  border border-red-600
                                  text-red-600
                                  bg-white
                                  font-semibold uppercase text-[9px] tracking-widest
                                  rounded-md
                                  hover:bg-red-600 hover:text-white
                                  transition-all duration-300 group">
                            View
                            <span class="transform transition-transform duration-300 group-hover:translate-x-1">
                                →
                            </span>
                        </a>

                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center">
                    <p class="text-slate-300 font-semibold uppercase tracking-widest text-sm">
                        Projects in progress...
                    </p>
                </div>
            @endforelse

        </div>
    </div>
</section>


   {{-- 4. LATEST FROM THE FRONTLINE --}}
<section class="py-20 bg-slate-50 border-y border-slate-100">

    {{-- Header --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
        <div class="flex justify-between items-end">
            <div>
                <span class="text-red-600 font-semibold text-[9px] uppercase tracking-[0.35em] mb-2 block">
                    Update
                </span>
                <h2 class="text-3xl md:text-4xl font-extrabold uppercase tracking-tight text-slate-900">
                    Latest From The Frontline
                </h2>
            </div>

            <a href="/news"
               class="hidden md:inline-flex items-center gap-2
                      text-[9px] font-semibold uppercase tracking-widest
                      text-slate-900 hover:text-red-600 transition">
                View All
                <span class="transition-transform duration-300 group-hover:translate-x-1">→</span>
            </a>
        </div>
    </div>

    {{-- News Grid --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">

            @forelse($latest_news as $news)
            <article class="group">

                {{-- Thumbnail --}}
                <a href="{{ route('news.show', $news->slug) }}">
                    <div class="relative aspect-[4/3] overflow-hidden rounded-2xl mb-4 bg-white">

                        <img src="{{ asset('storage/' . $news->thumbnail) }}"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">

                        {{-- Badges --}}
                        <div class="absolute top-3 left-3 flex flex-col gap-2">
                            <span class="bg-white text-slate-900 text-[8px] font-semibold 
                                         px-3 py-1 rounded-full uppercase tracking-widest">
                                {{ $news->category }}
                            </span>

                            @if($news->is_member_only)
                            <span class="bg-blue-600 text-white text-[8px] font-semibold 
                                         px-3 py-1 rounded-full uppercase tracking-widest">
                                Member Only
                            </span>
                            @endif
                        </div>

                    </div>
                </a>

                {{-- Meta --}}
                <p class="text-[9px] font-medium text-slate-400 uppercase tracking-widest mb-2 flex items-center gap-2">
                    {{ $news->created_at->format('M d, Y') }}
                    <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                    {{ $news->views ?? 0 }} Views
                </p>

                {{-- Title --}}
                <h3 class="text-base md:text-lg font-extrabold uppercase tracking-tight 
                           text-slate-900 line-clamp-3 
                           group-hover:text-red-600 transition-colors">
                    <a href="{{ route('news.show', $news->slug) }}">
                        {{ $news->title }}
                    </a>
                </h3>

                {{-- CTA --}}
                <div class="mt-4">
                    <a href="{{ route('news.show', $news->slug) }}"
                       class="inline-flex items-center gap-2
                              px-3 py-1.5
                              border border-red-600
                              text-red-600 bg-white
                              font-semibold uppercase text-[9px] tracking-widest
                              rounded-md
                              hover:bg-red-600 hover:text-white
                              transition-all duration-300">
                        View
                        <span class="transition-transform duration-300 group-hover:translate-x-1">→</span>
                    </a>
                </div>

            </article>

            @empty
            <div class="col-span-full py-16 text-center">
                <p class="text-slate-400 font-semibold uppercase tracking-widest text-sm">
                    No updates available yet.
                </p>
            </div>
            @endforelse

        </div>
    </div>
</section>

        {{-- 5. ARC LATEST VIDEO SECTION --}}
    <section class="py-16 bg-white border-t border-slate-100 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto px-8">
            <div class="flex items-center gap-3 mb-10">
                <div class="w-1.5 h-7 bg-red-600"></div>
                <h2 class="text-2xl md:text-4xl font-black uppercase tracking-tighter text-slate-900">
                ARC LATEST VIDEO
            </h2>
            </div>

            <div class="bg-black rounded-[1.5rem] md:rounded-[2rem] overflow-hidden flex flex-col lg:flex-row shadow-xl border-2 border-white">
                
                {{-- Video Player Side --}}
                <div class="lg:w-2/3 relative aspect-video bg-zinc-900">
                    <iframe
                        class="absolute inset-0 w-full h-full"
                        src="https://www.youtube.com/embed/WkP4k-mWOjk"
                        title="Studio Animasi DIPADIRA dengan karya nya KWARTET"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                </div>

                {{-- Info Side --}}
                <div class="lg:w-1/3 p-6 md:p-8 flex flex-col justify-center bg-zinc-950 text-white">
                    
                    <div class="flex items-center gap-3 text-red-600 mb-5">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                            <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/>
                        </svg>
                        <span class="text-[9px] font-black uppercase tracking-[0.3em]">
                            ARC UNITE
                        </span>
                    </div>

                    <h3 class="text-xl md:text-2xl font-black uppercase tracking-tighter leading-tight mb-5">
                        Studio Animasi DIPADIRA dengan karya nya "KWARTET" Begini kisah perjalanannya...
                    </h3>

                    <div class="flex flex-wrap gap-2 mb-8">
                        <span class="text-[9px] bg-zinc-800 px-3 py-1 rounded-full text-zinc-400 font-bold">#trending</span>
                        <span class="text-[9px] bg-zinc-800 px-3 py-1 rounded-full text-zinc-400 font-bold">#animation</span>
                        <span class="text-[9px] bg-zinc-800 px-3 py-1 rounded-full text-zinc-400 font-bold">#Dipadira</span>
                    </div>

                    <a href="https://www.youtube.com/watch?v=WkP4k-mWOjk"
                    target="_blank"
                    class="group relative overflow-hidden bg-red-600 text-white text-center py-3 rounded-lg font-black uppercase text-[9px] tracking-[0.25em] transition-all hover:bg-white hover:text-black">
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