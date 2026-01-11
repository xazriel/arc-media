    <div class="bg-white min-h-screen">
        {{-- 1. HERO SECTION --}}
        <section class="relative h-[55vh] w-full overflow-hidden">
            {{-- Background Image: Sesuai referensi tangan di atas keyboard laptop --}}
            <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?q=80&w=2070" 
                class="w-full h-full object-cover opacity-60">
            
            {{-- Teks Tengah --}}
            <div class="absolute inset-0 flex items-center justify-center">
                <h1 class="text-white text-6xl md:text-8xl font-black uppercase tracking-tighter shadow-2xl">
                    CONTACT US
                </h1>
            </div>
        </section>

        {{-- 2. FORM SECTION --}}
        <section class="py-20 max-w-6xl mx-auto px-6">
            {{-- Header Form --}}
            <div class="flex items-start gap-5 mb-14">
                <div class="mt-1">
                    {{-- Icon salaman sesuai gambar --}}
                    <svg class="w-10 h-10 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-black uppercase tracking-tight leading-none mb-2">Start a Collaboration</h2>
                    <p class="text-slate-500 font-medium text-lg">Tell us about your project and how we can work together</p>
                </div>
            </div>

            {{-- DARK FORM CONTAINER (PRESISI) --}}
            <div class="bg-[#050505] rounded-xl p-10 md:p-16 shadow-2xl">
                <form wire:submit.prevent="send" class="space-y-12">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-10">
                        {{-- Full Name --}}
                        <div class="space-y-3">
                            <label class="text-[#ff0000] font-black uppercase text-[12px] tracking-[0.3em]">Full Name</label>
                            <input type="text" wire:model="full_name" placeholder="Enter Your Name" 
                                class="w-full bg-[#2a2a2a] border-none rounded-md py-5 px-6 text-white placeholder-slate-500 focus:ring-1 focus:ring-red-600 transition-all text-sm">
                            @error('full_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        {{-- Email --}}
                        <div class="space-y-3">
                            <label class="text-[#ff0000] font-black uppercase text-[12px] tracking-[0.3em]">Email</label>
                            <input type="email" wire:model="email" placeholder="name@company.com" 
                                class="w-full bg-[#2a2a2a] border-none rounded-md py-5 px-6 text-white placeholder-slate-500 focus:ring-1 focus:ring-red-600 transition-all text-sm">
                            @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        {{-- Organization --}}
                        <div class="space-y-3">
                            <label class="text-[#ff0000] font-black uppercase text-[12px] tracking-[0.3em]">Organization</label>
                            <input type="text" wire:model="organization" placeholder="Company Name" 
                                class="w-full bg-[#2a2a2a] border-none rounded-md py-5 px-6 text-white placeholder-slate-500 focus:ring-1 focus:ring-red-600 transition-all text-sm">
                        </div>

                        {{-- Project Type --}}
                        <div class="space-y-3">
                            <label class="text-[#ff0000] font-black uppercase text-[12px] tracking-[0.3em]">Project Type</label>
                            <div class="relative">
                                <select wire:model="project_type" class="w-full bg-[#2a2a2a] border-none rounded-md py-5 px-6 text-black focus:ring-1 focus:ring-red-600 appearance-none cursor-pointer text-sm font-bold uppercase tracking-wider">
                                    <option value="Sponsorship">Sponsorship</option>
                                    <option value="Production">Production</option>
                                    <option value="Collaboration">Collaboration</option>
                                </select>
                                <div class="absolute inset-y-0 right-5 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Message --}}
                    <div class="space-y-3">
                        <label class="text-[#ff0000] font-black uppercase text-[12px] tracking-[0.3em]">Message</label>
                        <textarea wire:model="message" rows="7" placeholder="Describe your project vision..." 
                                class="w-full bg-[#2a2a2a] border-none rounded-md py-5 px-6 text-white placeholder-slate-500 focus:ring-1 focus:ring-red-600 transition-all resize-none text-sm"></textarea>
                    </div>

                    {{-- Button Send Now (Merah Menyala) --}}
                    <div class="flex justify-end pt-4">
                        <button type="submit" class="bg-[#ff0000] hover:bg-red-700 text-white font-black py-4 px-14 rounded-md transition-all uppercase text-[14px] tracking-widest shadow-xl active:scale-95 flex items-center gap-3">
                            <span wire:loading.remove>Send Now</span>
                            <span wire:loading>Processing...</span>
                        </button>
                    </div>
                </form>
            </div>
        </section>

        {{-- 3. MAP SECTION DENGAN LINK EMBED BARU --}}
    <section class="py-20 max-w-6xl mx-auto px-6">  
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.509087581026!2d106.79214947453268!3d-6.328014261917963!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ef13cd1d57e7%3A0x5d813dcc2fe6653d!2sARC%20Headquarters!5e0!3m2!1sid!2sid!4v1767710605476!5m2!1sid!2sid" 
            class="w-full h-full border-0" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </section>