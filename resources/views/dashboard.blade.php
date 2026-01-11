<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-gray-800 leading-tight uppercase italic tracking-tighter">
            {{ __('ARC Media Control Center') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            {{-- 1. QUICK STATS --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-black p-8 rounded-3xl shadow-xl">
                    <div class="text-slate-400 text-[10px] font-black uppercase tracking-[0.2em] mb-2">Total News</div>
                    <div class="text-5xl font-black text-white italic tracking-tighter">{{ $totalNews }}</div>
                </div>
                
                <div class="bg-red-600 p-8 rounded-3xl shadow-xl">
                    <div class="text-white/70 text-[10px] font-black uppercase tracking-[0.2em] mb-2">Active Highlights</div>
                    <div class="text-5xl font-black text-white italic tracking-tighter">{{ $totalHighlights }}</div>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-xl border border-slate-200">
                    <div class="text-slate-400 text-[10px] font-black uppercase tracking-[0.2em] mb-2">Quick Actions</div>
                    <div class="flex flex-wrap gap-2 mt-2">
                        <a href="/" target="_blank" class="bg-slate-100 hover:bg-black hover:text-white transition p-3 rounded-xl text-[10px] font-black uppercase italic">View Site ↗</a>
                        <a href="{{ route('admin.news') }}" class="bg-slate-100 hover:bg-red-600 hover:text-white transition p-3 rounded-xl text-[10px] font-black uppercase italic">Manage List</a>
                    </div>
                </div>
            </div>

            {{-- 2. THE MAIN ENGINE (Memanggil CreateNews) --}}
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 border-b border-slate-50 bg-white flex justify-between items-center">
                    <h3 class="text-xs font-black uppercase tracking-[0.3em] text-slate-400 italic">Create New Content</h3>
                    <span class="text-[9px] bg-yellow-100 text-yellow-700 px-2 py-1 rounded font-bold uppercase">Editor Mode</span>
                </div>
                
                <div class="p-0"> {{-- Container tanpa padding agar style create-news yang atur --}}
                    @livewire('admin.create-news')
                </div>
            </div>

            {{-- 3. PROJECT MANAGER ENGINE (Menambahkan Project Manager) --}}
            <div id="project-manager" class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 border-b border-slate-50 bg-white flex justify-between items-center">
                    <h3 class="text-xs font-black uppercase tracking-[0.3em] text-slate-400 italic">Project Management</h3>
                    <span class="text-[9px] bg-red-100 text-red-700 px-2 py-1 rounded font-bold uppercase">Project Mode</span>
                </div>
                
                <div class="p-6"> {{-- Tambahkan padding p-6 jika komponen project-manager belum punya padding internal --}}
                    @livewire('admin.project-manager')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>