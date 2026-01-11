<footer class="bg-black text-white pt-20">
    <div class="max-w-7xl mx-auto px-6 md:px-16 pb-16">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 md:gap-24">
            
            {{-- COLUMN 1: BRAND & DESC --}}
            <div class="space-y-6">
                <a href="/" class="text-3xl font-[900] italic tracking-tighter uppercase">
                    <span class="text-red-600">ARC</span> MEDIA
                </a>
                <p class="text-white/50 text-sm leading-relaxed max-w-sm">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
                
                {{-- SOCIAL ICONS --}}
                <div class="flex items-center gap-4 pt-2">
                    <a href="#" class="w-10 h-10 flex items-center justify-center bg-red-600 rounded-lg hover:bg-red-700 transition">
                        <svg class="w-6 h-6 fill-white" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                    <a href="#" class="w-10 h-10 flex items-center justify-center bg-[#0077b5] rounded-lg hover:opacity-80 transition">
                        <svg class="w-6 h-6 fill-white" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                    </a>
                    <a href="#" class="w-10 h-10 flex items-center justify-center bg-gradient-to-tr from-[#f9ce34] via-[#ee2a7b] to-[#6228d7] rounded-lg hover:opacity-80 transition">
                        <svg class="w-6 h-6 fill-white" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                </div>
            </div>

            {{-- COLUMN 2: QUICK LINKS --}}
            <div>
                <h4 class="text-red-600 font-black uppercase tracking-widest text-sm mb-8">Quick Links</h4>
                <ul class="space-y-4">
                    <li><a href="/" wire:navigate class="text-white/60 hover:text-white transition-colors text-sm font-bold uppercase tracking-wider">Home</a></li>
                    <li><a href="/news" wire:navigate class="text-white/60 hover:text-white transition-colors text-sm font-bold uppercase tracking-wider">News</a></li>
                    <li><a href="/projects" class="text-white/60 hover:text-white transition-colors text-sm font-bold uppercase tracking-wider">Project</a></li>
                    <li><a href="about" class="text-white/60 hover:text-white transition-colors text-sm font-bold uppercase tracking-wider">About</a></li>
                </ul>
            </div>

            {{-- COLUMN 3: OFFICE TIME --}}
            <div>
                <h4 class="text-red-600 font-black uppercase tracking-widest text-sm mb-8">Office Time</h4>
                <ul class="space-y-4 text-sm font-bold uppercase tracking-wider">
                    <li class="flex justify-between">
                        <span class="text-white/40">Mon-Sat:</span>
                        <span class="text-white">10:00AM - 4:00PM</span>
                    </li>
                    <li class="flex justify-between">
                        <span class="text-white/40">Sunday:</span>
                        <span class="text-white">10:00AM - 4:00PM</span>
                    </li>
                    <li class="flex justify-between">
                        <span class="text-red-600 italic">Friday:</span>
                        <span class="text-red-600 italic">Close</span>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    {{-- BOTTOM COPYRIGHT BAR --}}
    <div class="bg-red-600 py-6">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="text-white text-[10px] md:text-xs font-black uppercase tracking-[0.3em]">
                &copy; 2026 Adittoro Revolutionari Creatives, All Rights Reserved.
            </p>
        </div>
    </div>
</footer>