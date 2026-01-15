<div class="bg-white"> {{-- ROOT ELEMENT --}}

{{-- 1. PHOTO GROUP (HERO SECTION) --}}
<section class="relative 
                h-[35vh] sm:h-[65vh] md:h-[80vh] 
                w-full overflow-hidden bg-black">

    {{-- BACKGROUND IMAGE --}}
    <img src="{{ asset('assets-img/Header_About.jpg') }}"
         class="absolute inset-0 w-full h-full object-cover object-center opacity-70">

    {{-- OVERLAY --}}
    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>

    {{-- TITLE --}}
    <div class="absolute inset-0 flex items-center justify-center text-center px-4">
        <h1 class="text-white 
                text-2xl sm:text-4xl md:text-[4.5rem]
                font-semibold uppercase 
                tracking-tight leading-[0.95] 
                drop-shadow-xl">
            ABOUT US
        </h1>
    </div>

    {{-- RED MARQUEE --}}
    <div class="absolute -bottom-1 sm:bottom-0 w-full bg-[#ff0000] py-3 overflow-hidden border-t border-white/10">
        <div class="flex flex-nowrap whitespace-nowrap animate-marquee-horizontal">

            <div class="flex items-center flex-shrink-0">
                @for ($i = 0; $i < 5; $i++)
                    <span class="text-white 
                                 text-[9px] sm:text-[10px] md:text-[11px]
                                 font-bold uppercase tracking-[0.25em]
                                 px-5 sm:px-6 md:px-8
                                 flex items-center">
                        <span class="mr-2 text-[12px] leading-none">•</span>
                        TOGETHER WE ACT, TOGETHER WE IMPACT
                    </span>
                @endfor
            </div>

            <div class="flex items-center flex-shrink-0">
                @for ($i = 0; $i < 5; $i++)
                    <span class="text-white 
                                 text-[9px] sm:text-[10px] md:text-[11px]
                                 font-bold uppercase tracking-[0.25em]
                                 px-5 sm:px-6 md:px-8
                                 flex items-center">
                        <span class="mr-2 text-[12px] leading-none">•</span>
                        TOGETHER WE ACT, TOGETHER WE IMPACT
                    </span>
                @endfor
            </div>

        </div>
    </div>

</section>

{{-- 2. ABOUT US NARRATIVE --}}
<section class="py-16 sm:py-20 md:py-24
               max-w-7xl mx-auto
               px-5 sm:px-8 md:px-12
               text-center">

    {{-- TAG --}}
    <div class="inline-flex items-center
                border border-slate-200
                text-slate-500
                text-[8px] sm:text-[9px] md:text-[10px]
                font-medium uppercase tracking-[0.3em]
                px-5 py-2 mb-6
                rounded-xl">
        SINCE 2024 • REVOLUTIONARY CREATIVES
    </div>

    {{-- TITLE --}}
    <h2 class="text-xl sm:text-2xl md:text-4xl
               font-semibold uppercase
               tracking-tight text-slate-900
               mb-6 leading-snug">
        Connecting talents, building dreams,
        <span class="block sm:inline">
            and <span class="text-red-600">redefining</span> the industry
        </span>
    </h2>

    {{-- DESCRIPTION --}}
    <div class="max-w-2xl mx-auto">
        <p class="text-slate-500
                  text-sm sm:text-base md:text-lg
                  leading-relaxed font-normal">
            Adittoro Revolutionary Creatives (ARC) is a collaborative catalyst
            dedicated to advancing the Indonesian animation industry.
            We bridge creative vision and technical excellence,
            building an ecosystem where imagination can grow freely.
        </p>
    </div>

</section>

{{-- 3. PHOTO PER DIVISI & INDIVIDUAL (THE ARCHITECTS) --}}
<section class="py-24 md:py-32 bg-white">
    <div class="max-w-7xl mx-auto px-6 md:px-16">

        {{-- Section Title --}}
<h2 class="text-center text-3xl md:text-5xl font-extrabold uppercase tracking-tight text-black mb-24">
    THE ARCHITECTS
</h2>

        @php
            $departments = [
                [
                    'name' => 'Founders & PA',
                    'group_photo' => asset('assets-img/FOUNDERS_PA.jpg'),
                    'members' => [
                        ['name' => 'Aditya Triantoro', 'role' => 'Founder & Creative Director', 'img' => asset('assets-img/photo-89.jpg')],
                        ['name' => 'Nabila Rahma', 'role' => 'Co-Founder & Strategy Lead', 'img' => asset('assets-img/photo-103.jpg')],
                        ['name' => 'Nabila Rahma', 'role' => 'Co-Founder & Strategy Lead', 'img' => asset('assets-img/photo-115.jpg')],
                    ]
                ],
                [
                    'name' => 'Production',
                    'group_photo' => asset('assets-img/PRODUCTION.jpg'),
                    'members' => [
                        ['name' => 'Faira Tri Agustint', 'role' => 'Head of Production', 'img' => asset('assets-img/photo-72.jpg')],
                        ['name' => 'Sinta Dewi', 'role' => 'Animation Supervisor', 'img' => asset('assets-img/photo-79.jpg')],
                        ['name' => 'Budi Santoso', 'role' => 'Pipeline Lead', 'img' => asset('assets-img/photo-83.jpg')],
                    ]
                ],
                [
                    'name' => 'Brand',
                    'group_photo' => asset('assets-img/BRAND.jpg'),
                    'members' => [
                        ['name' => 'Alya Putri', 'role' => 'Brand Strategist', 'img' => asset('assets-img/photo-92.jpg')],
                        ['name' => 'Fajar Ramadhan', 'role' => 'Content Lead', 'img' => asset('assets-img/photo-72.jpg')],
                        ['name' => 'Fajar Ramadhan', 'role' => 'Content Lead', 'img' => asset('assets-img/photo-130.jpg')],
                        ['name' => 'Fajar Ramadhan', 'role' => 'Content Lead', 'img' => asset('assets-img/photo-121.jpg')],
                        ['name' => 'Fajar Ramadhan', 'role' => 'Content Lead', 'img' => asset('assets-img/photo-123.jpg')],
                    ]
                ],
                [
                    'name' => 'Finance',
                    'group_photo' => asset('assets-img/FINANCE.jpg'),
                    'members' => [
                        ['name' => 'Dewi Laksmi', 'role' => 'Finance Manager', 'img' => asset('assets-img/photo-136.jpg')],
                        ['name' => 'Arif Nugroho', 'role' => 'Accounting Lead', 'img' => asset('assets-img/photo-72.jpg')],
                    ]
                ],
                [
                    'name' => 'New Business Development',
                    'group_photo' => asset('assets-img/BUSINESS_DEVELOPMENT.jpg'),
                    'members' => [
                        ['name' => 'Kevin Adi', 'role' => 'Business Development Lead', 'img' => asset('assets-img/photo-89.jpg')],
                        ['name' => 'Kevin Adi', 'role' => 'Business Development Lead', 'img' => asset('assets-img/photo-103.jpg')],
                        ['name' => 'Maya Lestari', 'role' => 'Partnership Manager', 'img' => asset('assets-img/photo-92.jpg')],
                    ]
                ],
            ];
        @endphp

        @foreach($departments as $dept)
        <div class="mb-32 md:mb-40">

            {{-- Group Photo --}}
            <div class="relative h-[30vh] md:h-[60vh] rounded-[3rem] overflow-hidden mb-16 shadow-2xl group">
                <img src="{{ $dept['group_photo'] }}"
                     class="w-full h-full object-cover transition-transform duration-700 hover:scale-105"
                     alt="{{ $dept['name'] }} Group Photo">

                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>

                <h3 class="absolute bottom-8 left-8 md:bottom-12 md:left-12
                           text-white text-3xl md:text-5xl font-extrabold uppercase tracking-tight">
                    {{ $dept['name'] }}
                </h3>
            </div>

            {{-- MEMBERS (AUTO CENTER + AVATAR GEDE) --}}
            <div class="grid justify-center
                        [grid-template-columns:repeat(auto-fit,minmax(180px,1fr))]
                        gap-12 max-w-6xl mx-auto">

                @foreach($dept['members'] as $member)
                <div class="text-center">

                    <div class="aspect-square w-40 sm:w-44 md:w-48 rounded-full overflow-hidden mb-6
                                shadow-xl ring-2 ring-gray-200 mx-auto
                                transition-all duration-500 hover:ring-red-500">
                        <img src="{{ $member['img'] }}"
                             class="w-full h-full object-cover transition-transform duration-500 hover:scale-110"
                             alt="{{ $member['name'] }}">
                    </div>

                    <h4 class="font-bold uppercase text-sm md:text-base tracking-wide text-black">
                        {{ $member['name'] }}
                    </h4>

                    <p class="text-[10px] md:text-xs font-semibold text-gray-500 uppercase tracking-widest mt-1">
                        {{ $member['role'] }}
                    </p>

                </div>
                @endforeach

            </div>

        </div>
        @endforeach

    </div>
</section>

   {{-- 4. PARTNERS SECTION --}}
<section class="py-16 md:py-24 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 md:px-16">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:justify-between md:items-end gap-6 md:gap-8 mb-14 md:mb-16">

            <div class="max-w-2xl">
                <div class="flex items-center gap-3 text-red-600 text-[9px] md:text-[10px] font-semibold uppercase tracking-[0.25em] mb-3">
                    <span class="w-6 md:w-8 h-[2px] bg-red-600"></span>
                    Collaborative Ecosystem
                </div>

                <h2 class="text-2xl md:text-5xl font-extrabold uppercase tracking-tight text-black leading-tight">
                    Strategic <span class="text-gray-300">Partners</span>
                </h2>
            </div>

            <p class="text-gray-400 font-medium text-left md:text-right max-w-md text-[10px] md:text-xs uppercase tracking-widest leading-relaxed">
                We collaborate with trusted partners to expand creative impact and distribution.
            </p>

        </div>

        {{-- Main Partner Highlight --}}
        <div class="relative rounded-[2rem] md:rounded-[2.5rem] overflow-hidden bg-black
                    aspect-[4/5] sm:aspect-[16/10] md:aspect-[21/9]
                    shadow-xl mb-14 md:mb-16">

            <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=2069"
                 class="w-full h-full object-cover opacity-60 transition-transform duration-[2000ms] hover:scale-105"
                 alt="Main Partner">

            <div class="absolute inset-0 bg-gradient-to-t md:bg-gradient-to-r
                        from-black/90 via-black/50 to-transparent"></div>

            <div class="absolute inset-0 p-6 sm:p-10 md:p-14 flex items-end md:items-center">
                <div class="max-w-xl">

                    <h3 class="text-white text-xl sm:text-2xl md:text-3xl font-bold uppercase tracking-tight mb-3 md:mb-4">
                        PROVALIANT<span class="text-red-600">.</span>
                    </h3>

                    <p class="text-gray-200 text-xs sm:text-sm md:text-base font-medium leading-relaxed mb-6 md:mb-8">
                        Together with Provaliant, ARC Media enables local IPs to reach global markets
                        through innovative distribution and brand integration strategies.
                    </p>

                    <div class="flex flex-wrap gap-2 md:gap-3">
                        <span class="px-3 md:px-4 py-2 bg-white/10 border border-white/20 rounded-full
                                     text-[9px] md:text-[10px] font-semibold text-white uppercase tracking-widest">
                            Distribution Partner
                        </span>
                        <span class="px-3 md:px-4 py-2 bg-white/10 border border-white/20 rounded-full
                                     text-[9px] md:text-[10px] font-semibold text-white uppercase tracking-widest">
                            Strategic Alliance
                        </span>
                    </div>

                </div>
            </div>
        </div>

        {{-- Other Partners --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-6 md:gap-10 items-center">
            @for ($i = 0; $i < 5; $i++)
                <div class="h-10 sm:h-12 bg-gray-100 rounded-lg md:rounded-xl
                            flex items-center justify-center
                            text-gray-400 font-semibold text-[10px] md:text-xs uppercase tracking-widest">
                    Partner Logo
                </div>
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