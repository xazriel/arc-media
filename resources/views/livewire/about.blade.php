<div class="bg-white"> {{-- ROOT ELEMENT --}}

    {{-- 1. PHOTO GROUP (HERO SECTION) --}}
    <section class="relative h-[80vh] w-full overflow-hidden bg-black">
        <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=2070" 
             class="w-full h-full object-cover opacity-70">
        
        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
        
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-4">
            <h1 class="text-white text-6xl md:text-[9rem] font-black uppercase italic tracking-tighter leading-[0.8] drop-shadow-2xl">
                THE COLLECTIVE
            </h1>
        </div>

        {{-- RED MARQUEE BANNER (FIXED ANIMATION) --}}
        <div class="absolute bottom-0 w-full bg-[#ff0000] py-4 overflow-hidden flex items-center border-t border-white/10">
            <div class="flex flex-nowrap whitespace-nowrap animate-marquee-horizontal">
                {{-- Set 1 --}}
                <div class="flex items-center flex-shrink-0">
                    @for ($i = 0; $i < 5; $i++)
                        <span class="text-white text-[11px] font-black uppercase tracking-[0.3em] px-8 flex items-center">
                            <span class="mr-3 text-[14px] leading-none">•</span> TOGETHER WE ACT, TOGETHER WE IMPACT
                        </span>
                    @endfor
                </div>
                {{-- Set 2 (Duplikasi untuk Looping Mulus) --}}
                <div class="flex items-center flex-shrink-0">
                    @for ($i = 0; $i < 5; $i++)
                        <span class="text-white text-[11px] font-black uppercase tracking-[0.3em] px-8 flex items-center">
                            <span class="mr-3 text-[14px] leading-none">•</span> TOGETHER WE ACT, TOGETHER WE IMPACT
                        </span>
                    @endfor
                </div>
            </div>
        </div>
    </section>

    {{-- 2. NARASI ABOUT US --}}
    <section class="py-32 max-w-7xl mx-auto px-6 md:px-16 text-center">
        <div class="inline-block bg-black text-white text-[10px] font-black px-6 py-2 uppercase italic tracking-[0.4em] mb-12">
            SINCE 2024 / REVOLUTIONARY CREATIVES
        </div>
        <h2 class="text-4xl md:text-6xl font-black uppercase italic tracking-tighter text-black mb-12 leading-tight">
            Connecting talents, building dreams, <br>and <span class="text-red-600">redefining</span> the industry.
        </h2>
        <div class="max-w-4xl mx-auto">
            <p class="text-gray-500 leading-relaxed text-xl md:text-2xl font-medium italic">
                Adittoro Revolutionary Creatives (ARC) is a collaborative catalyst dedicated to advancing the Indonesian animation industry. We bridge the gap between creative vision and technical excellence, nurturing an ecosystem where imagination has no limits.
            </p>
        </div>
    </section>

    {{-- 3. PHOTO PER DIVISI & INDIVIDUAL (THE ARCHITECTS) --}}
    <section class="py-32 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 md:px-16">
            <h2 class="text-7xl font-black uppercase italic tracking-tighter text-black mb-24 border-l-8 border-red-600 pl-8">
                THE ARCHITECTS
            </h2>

            @php
                $departments = [
                    [
                        'name' => 'Creative & IP Development',
                        'group_photo' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=2070',
                        'members' => [
                            ['name' => 'Aditya Pratama', 'role' => 'Creative Director', 'img' => 'https://i.pravatar.cc/400?u=1'],
                            ['name' => 'Nabila R.', 'role' => 'IP Strategist', 'img' => 'https://i.pravatar.cc/400?u=2'],
                            ['name' => 'Rizky M.', 'role' => 'Lead Concept', 'img' => 'https://i.pravatar.cc/400?u=3'],
                        ]
                    ],
                    [
                        'name' => 'Production & Technology',
                        'group_photo' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?q=80&w=2070',
                        'members' => [
                            ['name' => 'Budi Santoso', 'role' => 'Technical Director', 'img' => 'https://i.pravatar.cc/400?u=4'],
                            ['name' => 'Sinta Dewi', 'role' => 'AI Specialist', 'img' => 'https://i.pravatar.cc/400?u=5'],
                        ]
                    ]
                ];
            @endphp

            @foreach($departments as $dept)
            <div class="mb-40">
                {{-- Group Photo per Divisi --}}
                <div class="relative h-[50vh] rounded-[3rem] overflow-hidden mb-16 shadow-2xl group">
                    <img src="{{ $dept['group_photo'] }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-80"></div>
                    <h3 class="absolute bottom-12 left-12 text-white text-4xl font-black uppercase italic tracking-tighter">
                        {{ $dept['name'] }}
                    </h3>
                </div>

                {{-- Individual Team Members --}}
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8">
                    @foreach($dept['members'] as $member)
                    <div class="group">
                        <div class="aspect-square rounded-full overflow-hidden mb-6 border-4 border-white shadow-lg transition-transform group-hover:scale-105 group-hover:border-red-600 duration-500">
                            <img src="{{ $member['img'] }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500">
                        </div>
                        <div class="text-center">
                            <h4 class="font-black uppercase italic text-sm tracking-tighter text-black">{{ $member['name'] }}</h4>
                            <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest mt-1">{{ $member['role'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </section>

    {{-- 4. PARTNERS SECTION --}}
    <section class="py-32 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 md:px-16">
            {{-- Header Section --}}
            <div class="flex flex-col md:flex-row justify-between items-end mb-20 gap-8">
                <div class="max-w-2xl">
                    <div class="inline-flex items-center gap-3 text-red-600 text-[10px] font-black uppercase tracking-[0.4em] mb-4">
                        <span class="w-10 h-[2px] bg-red-600"></span> 
                        Collaborative Ecosystem
                    </div>
                    <h2 class="text-5xl md:text-7xl font-black uppercase italic tracking-tighter text-black leading-none">
                        STRATEGIC <br><span class="text-gray-200">PARTNERS</span>
                    </h2>
                </div>
                <p class="text-gray-400 font-medium text-right max-w-xs uppercase text-[10px] tracking-widest leading-relaxed">
                    We work with the best to redefine the boundaries of Indonesian animation.
                </p>
            </div>

            {{-- MAIN PARTNER HIGHLIGHT (DUMMY PROVALIANT) --}}
            <div class="relative group rounded-[3.5rem] overflow-hidden bg-black aspect-[16/9] md:aspect-[21/9] shadow-2xl mb-20">
                <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=2069" 
                     class="w-full h-full object-cover opacity-50 group-hover:scale-105 transition duration-[2000ms]">
                
                <div class="absolute inset-0 bg-gradient-to-r from-black via-black/40 to-transparent"></div>

                <div class="absolute inset-0 p-8 md:p-16 flex flex-col justify-center">
                    <div class="max-w-2xl">
                        <div class="mb-8 h-12 flex items-center">
                            <span class="text-3xl font-black text-white italic tracking-tighter uppercase">PROVALIANT<span class="text-red-600">.</span></span>
                        </div>

                        <h3 class="text-2xl md:text-4xl font-black text-white uppercase italic tracking-tight mb-6 leading-tight">
                            Revolutionizing Distribution & <br>Brand Integration
                        </h3>
                        
                        <p class="text-gray-300 text-lg font-medium italic mb-10 max-w-lg border-l-2 border-red-600 pl-6 leading-relaxed">
                            "Bersama Provaliant, ARC Media membuka pintu bagi IP lokal untuk menembus pasar global melalui strategi distribusi yang inovatif."
                        </p>

                        <div class="flex flex-wrap gap-4">
                            <span class="px-4 py-2 bg-white/10 backdrop-blur-md border border-white/20 rounded-full text-[9px] font-black text-white uppercase tracking-widest">
                                Distribution Partner
                            </span>
                            <span class="px-4 py-2 bg-white/10 backdrop-blur-md border border-white/20 rounded-full text-[9px] font-black text-white uppercase tracking-widest">
                                Strategic Alliance
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Floating Spinner Label --}}
                <div class="absolute top-4 right-4 md:top-8 md:right-8 hidden sm:block">
                    <div class="w-16 h-16 md:w-20 md:h-20 rounded-full border border-white/20 flex items-center justify-center text-white text-[7px] md:text-[8px] font-black uppercase text-center tracking-tighter animate-spin-slow">
                        ARC x PROVALIANT • ARC x PROVALIANT • 
                    </div>
                </div>
            </div>

            {{-- Other Partners Logo Grid --}}
            <div class="grid grid-cols-2 md:grid-cols-5 gap-12 items-center opacity-30 hover:opacity-100 transition-opacity duration-700">
                @for ($i = 0; $i < 5; $i++)
                    <div class="h-12 bg-gray-200 rounded-lg flex items-center justify-center font-black text-gray-400 italic text-xs tracking-tighter">PARTNER LOGO</div>
                @endfor
            </div>
        </div>
    </section>

    {{-- CSS STYLES (Inside Root Div to prevent Livewire Error) --}}
    <style>
        /* Marquee Animation */
        @keyframes marquee-infinite {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        .animate-marquee-horizontal {
            display: flex;
            width: max-content;
            animation: marquee-infinite 30s linear infinite;
        }

        /* Spinner Animation */
        @keyframes spin-slow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .animate-spin-slow {
            animation: spin-slow 10s linear infinite;
        }

        /* Smooth Scrolling */
        html {
            scroll-behavior: smooth;
        }
    </style>
</div> {{-- END OF ROOT ELEMENT --}}