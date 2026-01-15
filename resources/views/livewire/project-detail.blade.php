<div class="bg-white">
{{-- 1. HERO SECTION --}}
<section 
    class="relative 
           h-[45vh] md:h-[65vh] 
           min-h-[320px] md:min-h-[480px] 
           w-full bg-slate-900 overflow-hidden">

    {{-- Background Image --}}
    <img 
        src="{{ asset('storage/' . $project->banner_image) }}" 
        class="w-full h-full object-cover opacity-85">

    {{-- Color Overlay --}}
    <div class="absolute inset-0 bg-[#36B7E5]/20"></div>

    {{-- Center Logo --}}
    <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-6">
        <img 
            src="{{ asset('storage/' . $project->logo_project) }}" 
            class="h-28 md:h-52 object-contain drop-shadow-xl z-20">
    </div>

</section>

    {{-- Back Button --}}
    <div class="max-w-7xl mx-auto px-4 pt-8">
<a href="{{ route('projects.index')}}"
   class="inline-flex items-center gap-2
          text-red-500
          text-[10px] font-semibold uppercase tracking-widest
          hover:text-red-600 transition-all">
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
    </svg>
    Back to Project
</a>

    </div>

    {{-- 2. TITLE & DESCRIPTION SECTION --}}
    <section class="relative z-20 py-14 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl md:text-4xl font-semibold text-center uppercase tracking-tight text-slate-900 mb-14">
            {{ $project->title }}
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
            {{-- Video / Thumbnail --}}
            <div class="rounded-2xl overflow-hidden shadow-xl bg-slate-100 aspect-video border border-slate-200">
                @if($project->youtube_video_id)
                    <iframe class="w-full h-full"
                            src="https://www.youtube.com/embed/{{ $project->youtube_video_id }}"
                            frameborder="0" allowfullscreen>
                    </iframe>
                @else
                    <img src="{{ asset('storage/' . $project->thumbnail) }}"
                         class="w-full h-full object-cover">
                @endif
            </div>

            {{-- Description --}}
            <div class="flex flex-col justify-center">
                <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed text-base font-normal mb-8">
                    {!! $project->description !!}
                </div>

                <a href="https://www.youtube.com/@NussaOfficialSeries"
                   target="_blank"
                   class="inline-flex items-center gap-3 w-fit
                          px-6 py-3 border border-red-500 text-red-500
                          rounded-lg text-[11px] font-semibold uppercase tracking-widest
                          hover:bg-red-500 hover:text-white transition-all">
                    Watch on Youtube
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- 3. THE CHARACTERS SECTION --}}
    <section class="py-20 bg-white border-t border-slate-100">
        <div class="relative h-40 md:h-52 w-full overflow-hidden mb-20">
            <img src="{{ asset('storage/' . $project->banner_image) }}"
                 class="w-full h-full object-cover opacity-15">

            <div class="absolute inset-0 flex items-center justify-center">
                <h2 class="text-3xl md:text-5xl font-semibold uppercase tracking-tight text-slate-900">
                    The Characters
                </h2>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-y-20 gap-x-10">
                @forelse($project->characters as $char)
                    <div class="flex flex-col items-center">
                        <div class="w-36 h-36 md:w-56 md:h-56 rounded-full p-2
                                    bg-gradient-to-b from-[#A5E5FF] to-[#36B7E5]
                                    shadow-xl">
                            <div class="w-full h-full rounded-full overflow-hidden bg-white border border-white">
                                <img src="{{ asset('storage/' . $char->image) }}"
                                     alt="{{ $char->name }}"
                                     class="w-full h-full object-cover">
                            </div>
                        </div>

                        <h4 class="mt-6 text-base md:text-xl font-semibold uppercase tracking-wide text-slate-800 text-center">
                            {{ $char->name }}
                        </h4>
                    </div>
                @empty
                    <div class="col-span-full text-center py-10">
                        <p class="text-slate-400 uppercase font-medium tracking-widest text-xs">
                            No characters revealed for this project yet.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</div>