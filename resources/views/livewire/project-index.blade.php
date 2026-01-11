<div class="bg-white">
    {{-- 1. HERO SECTION - Auto Slider dengan Alpine.js --}}
    <section 
        x-data="{ 
            activeSlide: 0, 
            slides: {{ $projects->take(5)->map(fn($p) => ['image' => asset('storage/'.$p->banner_image), 'logo' => asset('storage/'.$p->logo_project)])->toJson() }},
            next() { this.activeSlide = (this.activeSlide + 1) % this.slides.length },
            init() { setInterval(() => this.next(), 5000) } 
        }"
        class="relative h-[60vh] md:h-[75vh] min-h-[450px] md:min-h-[550px] w-full bg-slate-900 overflow-hidden"
    >
        {{-- Loop Slides --}}
        <template x-for="(slide, index) in slides" :key="index">
            <div 
                x-show="activeSlide === index"
                x-transition:enter="transition ease-out duration-1000"
                x-transition:enter-start="opacity-0 scale-105"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-1000"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="absolute inset-0"
            >
                {{-- Background Image --}}
                <img :src="slide.image" class="w-full h-full object-cover opacity-60">
                
                {{-- Logo Project --}}
                <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-6">
                    <img :src="slide.logo" 
                         x-transition:enter="transition ease-out delay-300 duration-700"
                         x-transition:enter-start="opacity-0 translate-y-8"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="h-32 md:h-64 object-contain mb-8 drop-shadow-[0_20px_20px_rgba(0,0,0,0.5)]">
                </div>
            </div>
        </template>

        {{-- Slider Indicators (Opsional) --}}
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex gap-3 z-20">
            <template x-for="(slide, index) in slides" :key="index">
                <button @click="activeSlide = index" 
                        :class="activeSlide === index ? 'bg-red-600 w-8' : 'bg-white/30 w-2'"
                        class="h-2 rounded-full transition-all duration-500"></button>
            </template>
        </div>
    </section>

    {{-- 2. ON GOING PROJECT SECTION --}}
    <section class="py-16 md:py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-4 mb-10 md:mb-16">
            <div class="w-1.5 h-10 md:w-2 md:h-12 bg-red-600"></div>
            <h2 class="text-3xl md:text-4xl font-black uppercase tracking-tighter italic text-slate-900 leading-tight">On Going Project</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 md:gap-10">
            @foreach($projects as $project)
            <div class="group cursor-pointer">
                <a href="{{ route('projects.show', $project->slug) }}" class="block">
                    <div class="relative aspect-[4/3] rounded-[2rem] md:rounded-3xl overflow-hidden mb-5 shadow-lg bg-slate-100">
                        <img src="{{ asset('storage/' . $project->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-black/10 group-hover:bg-black/40 transition-all flex items-center justify-center p-10 opacity-0 group-hover:opacity-100">
                             <img src="{{ asset('storage/' . $project->logo_project) }}" class="max-w-full h-10 md:h-12 object-contain">
                        </div>
                    </div>
                </a>
                <h3 class="text-lg font-black text-slate-900 uppercase italic tracking-tight group-hover:text-red-600 transition-colors">
                    {{ $project->title }}
                </h3>
                <p class="text-[10px] font-bold text-red-600 uppercase tracking-widest mt-1">{{ $project->status }}</p>
                <div class="mt-6">
                    <a href="{{ route('projects.show', $project->slug) }}" class="inline-flex items-center gap-3 text-slate-900 font-black uppercase text-[10px] tracking-[0.2em] group/btn">
                        Read More 
                        <span class="bg-slate-900 text-white w-8 h-8 flex items-center justify-center rounded-full group-hover/btn:bg-red-600 group-hover/btn:text-white transition-all duration-300">
                            →
                        </span>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    {{-- 3. BEHIND THE SCENE --}}
    <section class="py-16 md:py-24 bg-slate-50 border-y border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-4 mb-10 md:mb-16">
                <div class="w-1.5 h-10 md:w-2 md:h-12 bg-red-600"></div>
                <h2 class="text-3xl md:text-4xl font-black uppercase tracking-tighter italic text-slate-900">Behind The Scene</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 md:gap-5 h-auto md:h-[800px]">
                <div class="md:col-span-8 rounded-[2rem] md:rounded-[3rem] overflow-hidden shadow-xl h-64 md:h-full">
                    <img src="https://images.unsplash.com/photo-1616469829581-73993eb86b02?q=80&w=2070" class="w-full h-full object-cover hover:scale-105 transition duration-700">
                </div>
                <div class="md:col-span-4 rounded-[2rem] md:rounded-[3rem] overflow-hidden shadow-xl h-64 md:h-full">
                    <img src="https://images.unsplash.com/photo-1550745165-9bc0b252726f?q=80&w=2070" class="w-full h-full object-cover hover:scale-105 transition duration-700">
                </div>
                <div class="md:col-span-4 rounded-[2rem] md:rounded-[3rem] overflow-hidden shadow-xl h-64 md:h-full">
                    <img src="https://images.unsplash.com/photo-1593305841991-05c297ba4575?q=80&w=1957" class="w-full h-full object-cover hover:scale-105 transition duration-700">
                </div>
                <div class="md:col-span-8 rounded-[2rem] md:rounded-[3rem] overflow-hidden shadow-xl h-64 md:h-full">
                    <img src="https://images.unsplash.com/photo-1511512578047-dfb367046420?q=80&w=2071" class="w-full h-full object-cover hover:scale-105 transition duration-700">
                </div>
            </div>
        </div>
    </section>

    {{-- 4. ARTICLES SECTION --}}
    <section class="py-16 md:py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-10 md:mb-16">
            <div class="flex items-center gap-4">
                <div class="w-1.5 h-10 md:w-2 md:h-12 bg-red-600"></div>
                <h2 class="text-3xl md:text-4xl font-black uppercase tracking-tighter italic text-slate-900">Articles</h2>
            </div>
            <a href="/news" class="text-red-600 font-black text-xs uppercase italic tracking-widest group w-fit">
                View All <span class="inline-block transition-transform group-hover:translate-x-2">→</span>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12">
            @foreach($latest_articles as $article)
            <article class="group">
                <div class="aspect-[16/10] rounded-[2rem] md:rounded-[2.5rem] overflow-hidden mb-6 md:mb-8 shadow-xl">
                    <img src="{{ asset('storage/' . $article->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                </div>
                <div class="space-y-3 md:space-y-4">
                    <span class="text-[9px] md:text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">{{ $article->created_at->format('d M Y') }}</span>
                    <h3 class="text-xl md:text-2xl font-black uppercase italic tracking-tighter leading-tight text-slate-900 group-hover:text-red-600 transition">
                        {{ $article->title }}
                    </h3>
                    <p class="text-slate-500 text-sm leading-relaxed line-clamp-2">{{ Str::limit(strip_tags($article->content), 120) }}</p>
                </div>
            </article>
            @endforeach
        </div>
    </section>

    {{-- 5. THE ARC ECOSYSTEM --}}
    <section class="bg-black text-white py-20 md:py-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-xl md:text-2xl font-black uppercase italic tracking-[0.3em] md:tracking-[0.5em] mb-4 text-white/90 leading-tight">The Arc Ecosystem</h2>
            <p class="text-[9px] md:text-[10px] font-bold text-red-600 uppercase tracking-widest mb-16 md:mb-20">Where Innovation Connects</p>
            <div class="flex flex-wrap justify-center items-center gap-10 md:gap-32 opacity-30 grayscale hover:opacity-100 hover:grayscale-0 transition duration-1000 mb-20 md:mb-32">
                <img src="https://upload.wikimedia.org/wikipedia/commons/b/b9/Marvel_Logo.svg" class="h-6 md:h-10">
                <img src="https://upload.wikimedia.org/wikipedia/commons/3/3e/Disney%2B_logo.svg" class="h-10 md:h-14">
                <img src="https://upload.wikimedia.org/wikipedia/commons/b/b9/Marvel_Logo.svg" class="h-6 md:h-10">
                <img src="https://upload.wikimedia.org/wikipedia/commons/3/3e/Disney%2B_logo.svg" class="h-10 md:h-14">
            </div>
            <div class="bg-red-600 max-w-5xl mx-auto rounded-[2.5rem] md:rounded-[3rem] p-10 md:p-24 relative overflow-hidden group">
                <div class="relative z-10 text-center">
                    <h2 class="text-3xl md:text-6xl font-black uppercase italic tracking-tighter mb-8 md:mb-10 leading-[0.9]">Ready To Shape<br>The Future?</h2>
                    <a href="{{ route('contact') }}" class="inline-block bg-black text-white px-10 py-4 rounded-xl text-[10px] md:text-xs font-black uppercase italic hover:bg-white hover:text-black transition-colors">
                        Let's Collaborate
                    </a>
                </div>
                <div class="absolute -top-24 -right-24 w-48 md:w-80 h-48 md:h-80 bg-white/10 rounded-full blur-3xl group-hover:bg-white/20 transition duration-700"></div>
                <div class="absolute -bottom-24 -left-24 w-48 md:w-80 h-48 md:h-80 bg-black/10 rounded-full blur-3xl group-hover:bg-black/20 transition duration-700"></div>
            </div>
        </div>
    </section>
</div>