<div class="bg-white min-h-screen antialiased font-sans pb-20">
    {{-- 1. TOP NAVIGATION (Sesuai Referensi) --}}
    <div class="max-w-7xl mx-auto px-6 py-8">
        <a href="{{ route('news.index')}}" class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-black transition-all group">
            <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to News
        </a>
    </div>

    {{-- 2. MAIN MEDIA (Atas - Full Width Look) --}}
    <div class="max-w-5xl mx-auto px-4 md:px-6 mb-12">
        <div class="rounded-3xl overflow-hidden shadow-xl aspect-video bg-black">
            @if($videoId)
                <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allowfullscreen></iframe>
            @else
                <img src="{{ asset('storage/' . $news->thumbnail) }}" class="w-full h-full object-cover">
            @endif
        </div>
    </div>

    {{-- 3. ARTICLE HEADER (Di Bawah Gambar) --}}
    <div class="max-w-4xl mx-auto px-6 mb-10">
        <h1 class="text-3xl md:text-5xl font-extrabold text-slate-900 leading-tight tracking-tight mb-4">
            {{ $news->title }}
        </h1>
        <p class="text-slate-500 text-[11px] md:text-xs font-bold uppercase tracking-wide">
            Published on {{ $news->created_at->format('F d, Y h:i A') }} EST
        </p>
    </div>

    {{-- 4. CONTENT AREA --}}
    <div class="max-w-4xl mx-auto px-6">
        
        {{-- Highlight Box (Garis Merah di Samping Sesuai Gambar) --}}
        <div class="border-l-[6px] border-red-600 bg-slate-50 p-6 md:p-8 mb-10 rounded-r-2xl">
            <h2 class="text-xl md:text-2xl font-bold text-slate-900 leading-snug">
                {{ $news->title }}
            </h2>
        </div>

        {{-- Main Article Text --}}
        <article class="prose prose-slate lg:prose-lg max-w-none text-slate-700 leading-relaxed mb-16
            prose-headings:text-slate-900 prose-headings:font-bold prose-headings:tracking-tight
            prose-img:rounded-2xl prose-img:shadow-lg prose-strong:text-slate-900">
            
            {!! $news->content !!}

        </article>

        {{-- 5. INTERACTION BAR (Like, View, Share) --}}
        <div class="flex items-center justify-between py-8 border-y border-slate-100">
            <div class="flex items-center gap-8">
                {{-- Like Button --}}
                <button wire:click="incrementLike" class="flex items-center gap-3 group">
                    <div class="p-2 rounded-full group-hover:bg-red-50 transition-colors">
                        <svg class="w-7 h-7 {{ session()->has('liked_news_' . $news->id) ? 'text-red-600 fill-current' : 'text-slate-300 fill-none stroke-current' }}" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                    </div>
                    <span class="font-bold text-lg text-slate-600">{{ number_format($news->likes) }}</span>
                </button>
                
                {{-- Views --}}
                <div class="flex items-center gap-3 text-slate-300">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <span class="font-bold text-lg text-slate-400">{{ number_format($news->views) }}</span>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-4">
                <button onclick="navigator.clipboard.writeText(window.location.href); alert('Link Copied!')" 
                        class="hidden md:block text-[10px] font-black uppercase tracking-widest border-2 border-slate-100 px-6 py-2.5 rounded-lg hover:bg-black hover:text-white transition-all">
                    Copy Link
                </button>
                <button class="text-slate-400 hover:text-black transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>