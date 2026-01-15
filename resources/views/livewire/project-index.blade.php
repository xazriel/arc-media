<div class="bg-white">

    {{-- 1. HERO SECTION --}}
    <section 
        x-data="{ 
            activeSlide: 0, 
            slides: {{ $projects->whereNotNull('banner_image')->take(5)->map(fn($p) => [
                'image' => asset('storage/'.$p->banner_image), 
                'logo' => $p->logo_project ? asset('storage/'.$p->logo_project) : null,
                'title' => $p->title
            ])->values()->toJson() }},
            next() { this.activeSlide = (this.activeSlide + 1) % this.slides.length },
            init() { 
                if(this.slides.length > 0) {
                    setInterval(() => this.next(), 5000) 
                }
            } 
        }"
        class="relative h-[45vh] md:h-[75vh] min-h-[320px] md:min-h-[550px] w-full bg-slate-900 overflow-hidden"
    > {{-- <-- Pastikan ada kurung tutup ini --}}

        <template x-for="(slide, index) in slides" :key="index">
            <div 
                x-show="activeSlide === index" 
                x-transition:enter="transition ease-out duration-1000"
                x-transition:enter-start="opacity-0 transform scale-105"
                x-transition:enter-end="opacity-100 transform scale-100"
                class="absolute inset-0"
            >
                {{-- Background Image --}}
                <img :src="slide.image" class="w-full h-full object-cover opacity-60">
                
                {{-- Overlay Gradient --}}
                <div class="absolute inset-0 bg-gradient-to-b from-black/20 via-transparent to-black/60"></div>

                {{-- Logo Project di Tengah --}}
                <div class="absolute inset-0 flex items-center justify-center px-6">
                    <template x-if="slide.logo">
                        <img :src="slide.logo" class="h-28 md:h-56 object-contain drop-shadow-2xl">
                    </template>
                    <template x-if="!slide.logo">
                        <h2 class="text-white text-4xl md:text-7xl font-black uppercase italic tracking-tighter" x-text="slide.title"></h2>
                    </template>
                </div>
            </div>
        </template>

        {{-- Navigasi Dots --}}
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex gap-3 z-20">
            <template x-for="(slide, index) in slides" :key="index">
                <button @click="activeSlide = index"
                        :class="activeSlide === index ? 'bg-red-600 w-8' : 'bg-white/30 w-2'"
                        class="h-2 rounded-full transition-all duration-300"></button>
            </template>
        </div>
    </section>

    {{-- 2. ON GOING PROJECT --}}
    <section class="py-16 md:py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-4 mb-10">
            <div class="w-1.5 h-10 bg-red-600"></div>
            <h2 class="text-2xl md:text-3xl font-black uppercase tracking-tight text-slate-900">
                On Going Project
            </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($projects as $project)
            <div class="group">
                <a href="{{ route('projects.show', $project->slug) }}">
                    <div class="relative aspect-[4/3] rounded-3xl overflow-hidden mb-4 shadow-lg">
                        <img src="{{ asset('storage/' . $project->thumbnail) }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    </div>
                </a>

                <h3 class="text-base font-black uppercase tracking-tight text-slate-900 group-hover:text-red-600 transition">
                    {{ $project->title }}
                </h3>

                <p class="text-[10px] font-bold text-red-600 uppercase tracking-widest mt-1">
                    {{ $project->status }}
                </p>

                <div class="mt-5">
                    <a href="{{ route('projects.show', $project->slug) }}">
                        <span class="px-4 py-2 border border-red-600 text-red-600 rounded-md
                                     text-[10px] uppercase tracking-widest
                                     hover:bg-red-600 hover:text-white transition">
                            Read More →
                        </span>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    {{-- 3. BEHIND THE SCENE --}}
    <section class="py-16 md:py-24 bg-slate-50 border-y border-slate-100">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center gap-4 mb-10">
                <div class="w-1.5 h-10 bg-red-600"></div>
                <h2 class="text-2xl md:text-3xl font-black uppercase tracking-tight text-slate-900">
                    Behind The Scene
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                <div class="md:col-span-8 rounded-3xl overflow-hidden shadow-xl h-64 md:h-full">
                    <img src="https://images.unsplash.com/photo-1616469829581-73993eb86b02?q=80&w=2070" class="w-full h-full object-cover">
                </div>
                <div class="md:col-span-4 rounded-3xl overflow-hidden shadow-xl h-64 md:h-full">
                    <img src="https://images.unsplash.com/photo-1550745165-9bc0b252726f?q=80&w=2070" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </section>

    {{-- 4. ARTICLES --}}
    <section class="py-16 md:py-24 max-w-7xl mx-auto px-4">
        <div class="flex items-center gap-4 mb-10">
            <div class="w-1.5 h-10 bg-red-600"></div>
            <h2 class="text-2xl md:text-3xl font-black uppercase tracking-tight text-slate-900">
                Articles
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($latest_articles as $article)
            <article>
                <div class="aspect-[16/10] rounded-3xl overflow-hidden mb-5 shadow-lg">
                    <img src="{{ asset('storage/' . $article->thumbnail) }}" class="w-full h-full object-cover">
                </div>

                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                    {{ $article->created_at->format('d M Y') }}
                </span>

                <h3 class="text-lg font-black uppercase tracking-tight text-slate-900 mt-2">
                    {{ $article->title }}
                </h3>

                <p class="text-sm text-slate-500 leading-relaxed mt-2">
                    {{ Str::limit(strip_tags($article->content), 120) }}
                </p>
            </article>
            @endforeach
        </div>
    </section>

    {{-- 5. THE ARC ECOSYSTEM (BALIK + AMAN) --}}
    <section class="bg-black text-white py-20 md:py-28">
        <div class="max-w-7xl mx-auto px-6 text-center">

            <h2 class="text-lg md:text-xl font-black uppercase tracking-[0.35em] mb-4 text-white/90">
                The Arc Ecosystem
            </h2>

            <p class="text-[10px] font-bold text-red-600 uppercase tracking-widest mb-16">
                Where Innovation Connects
            </p>

            <div class="flex flex-wrap justify-center items-center gap-12 md:gap-28 opacity-40 mb-20">
                <img src="https://upload.wikimedia.org/wikipedia/commons/b/b9/Marvel_Logo.svg" class="h-6 md:h-10">
                <img src="https://upload.wikimedia.org/wikipedia/commons/3/3e/Disney%2B_logo.svg" class="h-8 md:h-12">
                <img src="https://upload.wikimedia.org/wikipedia/commons/b/b9/Marvel_Logo.svg" class="h-6 md:h-10">
                <img src="https://upload.wikimedia.org/wikipedia/commons/3/3e/Disney%2B_logo.svg" class="h-8 md:h-12">
            </div>

            <div class="bg-red-600 max-w-4xl mx-auto rounded-3xl p-10 md:p-20">
                <h3 class="text-2xl md:text-4xl font-black uppercase tracking-tight mb-8 leading-tight">
                    Ready To Shape The Future?
                </h3>

                <a href="{{ route('contact') }}"
                   class="inline-block bg-white text-red-600 px-10 py-4 rounded-lg
                          text-[10px] uppercase tracking-widest font-black
                          hover:bg-black hover:text-white transition">
                    Let’s Collaborate
                </a>
            </div>

        </div>
    </section>

</div>