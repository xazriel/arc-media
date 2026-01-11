<nav x-data="{ open: false }" 
     @keydown.escape="open = false"
     class="bg-[#101010]/95 backdrop-blur-md border-b border-white/5 py-4 px-6 md:px-16 flex items-center justify-between sticky top-0 z-[100]">
    
    {{-- LEFT: LOGO (Menggunakan Image Logo) --}}
    <div class="flex items-center">
        <a href="/" wire:navigate class="group flex items-center">
            {{-- Sesuaikan path h-8 (tinggi) agar proporsional dengan navbar --}}
                <img src="{{ asset('assets-img/ARC_LOGO_MEDIA.png') }}"
                 alt="ARC Media Logo" 
                 class="h-8 md:h-10 w-auto object-contain transition-transform duration-300 group-hover:scale-105">
        </a>
    </div> 

    {{-- CENTER: NAVIGATION (Desktop) --}}
    <div class="hidden md:flex items-center gap-10">
        @php
            $menus = [
                ['name' => 'Home', 'url' => route('home'), 'pattern' => '/'],
                ['name' => 'News', 'url' => route('news.index'), 'pattern' => 'news*'],
                ['name' => 'Project', 'url' => route('projects.index'), 'pattern' => 'projects*'],
                ['name' => 'About', 'url' => route('about'), 'pattern' => 'about*'],
                ['name' => 'Contact', 'url' => route('contact'), 'pattern' => 'contact*'],
            ];
        @endphp

        @foreach($menus as $menu)
            @php
                $isActive = ($menu['pattern'] === '/') 
                            ? request()->is('/') 
                            : request()->is($menu['pattern']);
            @endphp

            <a href="{{ $menu['url'] }}" 
               wire:navigate
               class="relative text-[11px] font-black uppercase tracking-[0.2em] transition-all duration-300
               {{ $isActive ? 'text-white' : 'text-white/40 hover:text-white' }}">
                {{ $menu['name'] }}
                @if($isActive)
                    {{-- Menggunakan warna resmi arc-red --}}
                    <span class="absolute -bottom-[10px] left-0 w-full h-[3px] bg-arc-red shadow-[0_0_10px_rgba(237,30,36,0.5)]"></span>
                @endif
            </a>
        @endforeach
    </div>

    {{-- RIGHT: AUTH & HAMBURGER --}}
    <div class="flex items-center gap-4">
        <div class="hidden md:flex items-center gap-4">
            @auth
                <div class="flex items-center gap-6">
                    @if(auth()->user()->role === 'admin')
                        <a href="/dashboard" wire:navigate class="text-[10px] font-black uppercase tracking-widest text-white/60 hover:text-white transition">
                            Control Center
                        </a>
                        <div class="h-4 w-[1px] bg-white/10"></div>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-[10px] font-black uppercase tracking-widest text-arc-red hover:text-white transition">
                            Logout
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" wire:navigate class="border border-arc-red text-white px-7 py-2.5 rounded-full text-[10px] font-black uppercase tracking-[0.15em] hover:bg-arc-red/10 transition">
                    Login
                </a>
                <a href="{{ route('register') }}" wire:navigate class="bg-arc-red hover:bg-red-700 text-white px-7 py-2.5 rounded-full text-[10px] font-black uppercase tracking-[0.15em] shadow-lg transition transform hover:-translate-y-0.5">
                    Sign Up
                </a>
            @endauth
        </div>

        {{-- MOBILE MENU BUTTON (Hamburger) --}}
        <button @click="open = !open" class="md:hidden text-white focus:outline-none p-2 z-[10000]">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    {{-- MOBILE OVERLAY MENU (FIXED: Tidak Transparan) --}}
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-x-full"
         x-transition:enter-end="opacity-100 translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-x-0"
         x-transition:leave-end="opacity-0 translate-x-full"
         {{-- Menggunakan fixed inset-0 dan bg-black solid --}}
         class="fixed inset-0 w-full h-screen bg-[#000000] z-[9999] md:hidden flex flex-col p-10 pt-32 gap-8"
         style="display: none;">
        
        <p class="text-arc-red text-[10px] font-black uppercase tracking-[0.5em] italic mb-4">Menu Navigation</p>

        @foreach($menus as $menu)
            <a href="{{ $menu['url'] }}" @click="open = false" wire:navigate 
               class="text-4xl font-black uppercase italic tracking-tighter text-white hover:text-arc-red transition-all">
                {{ $menu['name'] }}
            </a>
        @endforeach

        <div class="flex flex-col gap-4 mt-10 pt-10 border-t border-white/10">
            @auth
                <a href="/dashboard" class="text-white font-black uppercase tracking-widest text-xs">Control Center</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-arc-red font-black uppercase tracking-widest text-xs text-left">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="w-full text-center border border-arc-red text-white py-4 rounded-xl font-black uppercase text-xs tracking-widest">Login</a>
                <a href="{{ route('register') }}" class="w-full text-center bg-arc-red text-white py-4 rounded-xl font-black uppercase text-xs tracking-widest">Sign Up</a>
            @endauth
        </div>
    </div>
</nav>