    <div class="bg-white">
        {{-- 1. HEADER - Menghilangkan min-h-screen agar tidak menarik warna background luar --}}
        <div class="max-w-7xl mx-auto px-4 pt-12 md:pt-16 pb-8 bg-white">
            <h1 class="text-4xl md:text-6xl font-black uppercase italic tracking-tighter mb-4 text-slate-900 leading-none">NEWS</h1>
            <p class="text-sm md:text-base text-slate-400 font-medium tracking-wide max-w-2xl">The latest insights and trends shaping Indonesia's creative and animation industry.</p>
        </div>

        {{-- 2. CATEGORY TABS - Menggunakan bg-white/95 untuk menutup area belakang saat sticky --}}
        <div class="sticky top-[64px] z-40 bg-white/95 backdrop-blur-md border-y border-slate-100 py-4 mb-10">
            <div class="max-w-7xl mx-auto px-4 flex flex-nowrap md:flex-wrap overflow-x-auto no-scrollbar gap-2">
                @foreach(['All', 'Film', 'Series', 'Shorts', 'Reviews', 'Technology', 'Events', 'Jobs'] as $cat)
                    <button wire:click="$set('selectedCategory', '{{ $cat }}')" 
                    class="whitespace-nowrap px-6 py-2 rounded-full text-[10px] font-black uppercase tracking-widest transition-all
                    {{ $selectedCategory == $cat ? 'bg-red-600 text-white' : 'bg-slate-100 text-slate-400 hover:bg-black hover:text-white' }}">
                        {{ $cat }}
                    </button>
                @endforeach
            </div>
        </div>

        {{-- 3. TRENDING SECTION --}}
        @if($trending && $selectedCategory == 'All' && !$search)
        <section class="max-w-7xl mx-auto px-4 mb-16 md:mb-24 bg-white">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-1 h-8 bg-red-600"></div>
                <h2 class="font-black uppercase italic tracking-widest text-lg text-slate-900">Trending Now</h2>
            </div>
            <div class="relative h-[400px] md:h-[600px] rounded-[2rem] md:rounded-[3rem] overflow-hidden group shadow-2xl">
                <img src="{{ asset('storage/'.$trending->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-1000">
                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent flex flex-col justify-end p-6 md:p-12">
                    <span class="bg-red-600 text-white text-[9px] font-black px-4 py-1.5 rounded-full uppercase italic w-fit mb-4">Must Read</span>
                    <h3 class="text-2xl md:text-6xl font-black text-white uppercase italic tracking-tighter leading-tight mb-6 max-w-4xl">
                        {{ $trending->title }}
                    </h3>
                    {{-- Tombol Read Story Putih (Hero Style) --}}
                    <a href="{{ route('news.show', $trending->slug) }}" class="inline-flex items-center gap-3 text-white font-black uppercase text-xs tracking-widest group">
                        Read Story 
                        <span class="bg-white text-black w-10 h-10 flex items-center justify-center rounded-full group-hover:bg-red-600 group-hover:text-white transition-all duration-300">
                            →
                        </span>
                    </a>
                </div>
            </div>
        </section>
        @endif

        {{-- 4. DYNAMIC CATEGORY SECTIONS --}}
        <div class="max-w-7xl mx-auto px-4 pb-32 bg-white">
            @php
                $categoriesToDisplay = ($selectedCategory == 'All') 
                    ? ['Film', 'Series', 'Shorts', 'Reviews'] 
                    : [$selectedCategory];
            @endphp

            @foreach($categoriesToDisplay as $catName)
                @php
                    $categoryNews = \App\Models\News::where('category', $catName)
                                    ->when($search, function($query) {
                                        $query->where('title', 'like', '%'.$this->search.'%');
                                    })
                                    ->latest()->take(3)->get();
                @endphp

                @if($categoryNews->count() > 0)
                <section class="mb-16 md:mb-24 bg-white">
                    <div class="flex justify-between items-end mb-8 border-b-2 border-slate-100 pb-6">
                        <div class="flex items-center gap-3">
                            <div class="w-1 h-6 bg-black"></div>
                            <h2 class="font-black uppercase italic tracking-widest text-xl md:text-2xl text-slate-900">{{ $catName }}</h2>
                        </div>
                        <button wire:click="$set('selectedCategory', '{{ $catName }}')" class="text-[9px] md:text-[10px] font-black uppercase tracking-widest text-red-600 hover:text-black transition">
                            View All →
                        </button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-10">
                        @foreach($categoryNews as $item)
                        <div class="group cursor-pointer">
                            <a href="{{ route('news.show', $item->slug) }}" class="block">
                                <div class="relative h-64 md:h-72 rounded-[2rem] md:rounded-[2.5rem] overflow-hidden mb-6 shadow-xl shadow-slate-200/50 border border-slate-100">
                                    <img src="{{ asset('storage/'.$item->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                                </div>
                            </a>
                            <div class="px-2">
                                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-3">{{ $item->created_at->format('d M Y') }}</p>
                                <h4 class="text-xl md:text-2xl font-black uppercase italic tracking-tighter leading-tight group-hover:text-red-600 transition mb-6">
                                    <a href="{{ route('news.show', $item->slug) }}">{{ $item->title }}</a>
                                </h4>
                                
                                {{-- Tombol Read Story Hitam (Selaras dengan Home & Project) --}}
                                <a href="{{ route('news.show', $item->slug) }}" class="inline-flex items-center gap-3 text-slate-900 font-black uppercase text-[10px] tracking-[0.2em] group/btn">
                                    Read Story 
                                    <span class="bg-slate-900 text-white w-8 h-8 flex items-center justify-center rounded-full group-hover/btn:bg-red-600 group-hover/btn:text-white transition-all duration-300">
                                        →
                                    </span>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>
                @endif
            @endforeach
        </div>
    </div>  