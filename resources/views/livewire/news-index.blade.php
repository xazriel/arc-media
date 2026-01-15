<div class="bg-white">
        {{-- 1. HEADER - Menghilangkan min-h-screen agar tidak menarik warna background luar --}}
        <div class="max-w-7xl mx-auto px-4 pt-12 md:pt-16 pb-8 bg-white">
            <h1 class="text-4xl md:text-6xl font-black uppercase italic tracking-tighter mb-4 text-slate-900 leading-none">NEWS</h1>
            <p class="text-sm md:text-base text-slate-400 font-medium tracking-wide max-w-2xl">The latest insights and trends shaping Indonesia's creative and animation industry.</p>
        </div>

{{-- 2. CATEGORY TABS --}}
<div class="hidden md:block
            sticky top-[64px] z-40
            bg-white/95 backdrop-blur-md
            border-y border-slate-100
            py-4 mb-10">

    <div class="max-w-7xl mx-auto px-4 flex flex-wrap gap-2">

        @foreach(['All', 'Film', 'Series', 'Shorts', 'Reviews', 'Technology', 'Events', 'Jobs'] as $cat)
            <button
                wire:click="$set('selectedCategory', '{{ $cat }}')"
                class="whitespace-nowrap
                       px-6 py-2
                       rounded-full
                       text-[10px]
                       font-black uppercase tracking-widest
                       transition-all duration-200
                {{ $selectedCategory == $cat
                    ? 'bg-red-600 text-white'
                    : 'bg-slate-100 text-slate-400 hover:bg-red-600 hover:text-white' }}">
                {{ $cat }}
            </button>
        @endforeach

    </div>
</div>


{{-- 3. TRENDING SECTION --}}
@if($trending && $selectedCategory == 'All' && !$search)
<section class="max-w-7xl mx-auto px-4 mb-16 md:mb-24 bg-white">

    {{-- Section Title --}}
    <div class="flex items-center gap-3 mb-8">
        <div class="w-1 h-8 bg-red-600"></div>
        <h2 class="font-black uppercase tracking-widest text-[13px] md:text-base text-slate-900">
            Trending Now
        </h2>
    </div>

    {{-- Image Card --}}
    <div class="relative 
                h-[260px] sm:h-[320px] md:h-[600px]
                rounded-[1.5rem] md:rounded-[3rem]
                overflow-hidden group shadow-2xl mb-6">

        <img src="{{ asset('storage/'.$trending->thumbnail) }}"
             class="w-full h-full object-cover group-hover:scale-105 transition duration-1000">

        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent"></div>

        {{-- Badge --}}
        <div class="absolute bottom-4 left-4 md:bottom-10 md:left-10">
            <span class="bg-red-600 text-white 
                         text-[8px] md:text-[9px]
                         font-black px-3 md:px-4 py-1
                         rounded-full uppercase italic">
                Must Read
            </span>
        </div>
    </div>

    {{-- Text Content (OUTSIDE CARD) --}}
    <div class="max-w-4xl">

        <h3 class="text-[17px] sm:text-lg md:text-4xl
           font-bold uppercase
           tracking-tight leading-tight mb-3">
    {{ $trending->title }}
</h3>

<a href="{{ route('news.show', $trending->slug) }}"
   class="inline-flex items-center gap-1.5
          px-3 py-1.5 md:px-4 md:py-2
          border border-red-600
          text-red-600 font-medium uppercase
          text-[9px] md:text-[10px] tracking-widest
          rounded
          hover:bg-red-600 hover:text-white
          transition-all duration-300">

    Read Story
    <span class="text-xs md:text-sm">→</span>
</a>

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
        <section class="mb-14 md:mb-24 bg-white">

            {{-- Section Header --}}
            <div class="flex justify-between items-end mb-6 border-b border-slate-100 pb-4">
                <div class="flex items-center gap-3">
                    <div class="w-1 h-6 bg-red-600"></div>
                    <h2 class="font-bold uppercase tracking-widest text-[13px] md:text-base text-slate-900">
                        {{ $catName }}
                    </h2>
                </div>

                <button wire:click="$set('selectedCategory', '{{ $catName }}')" 
                        class="text-[9px] md:text-[10px] font-semibold uppercase tracking-widest text-red-600 hover:text-red-700 transition">
                    View All →
                </button>
            </div>

            {{-- Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-10">
                @foreach($categoryNews as $item)
                <div class="group cursor-pointer">

                    <a href="{{ route('news.show', $item->slug) }}" class="block">
                        <div class="relative h-60 md:h-72 rounded-[2rem] md:rounded-[2.5rem] overflow-hidden mb-5 shadow-xl shadow-slate-200/50 border border-slate-100">
                            <img src="{{ asset('storage/'.$item->thumbnail) }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                        </div>
                    </a>

                    <div class="px-2">
                        <p class="text-[9px] font-medium text-slate-400 uppercase tracking-widest mb-2">
                            {{ $item->created_at->format('d M Y') }}
                        </p>

                        <h4 class="text-[15px] md:text-lg font-semibold uppercase tracking-tight leading-snug mb-4 group-hover:text-red-600 transition">
                            <a href="{{ route('news.show', $item->slug) }}">
                                {{ $item->title }}
                            </a>
                        </h4>

                        {{-- Read Story Button --}}
                        <a href="{{ route('news.show', $item->slug) }}"
                           class="inline-flex items-center gap-1.5
                                  px-3 py-1.5
                                  border border-red-600
                                  text-red-600 font-medium uppercase
                                  text-[9px] tracking-widest
                                  rounded-md
                                  hover:bg-red-600 hover:text-white
                                  transition-all duration-300">
                            Read Story
                            <span class="text-xs">→</span>
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
    </div>