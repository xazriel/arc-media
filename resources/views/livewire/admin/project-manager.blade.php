<div class="py-12 bg-[#F8FAFC] min-h-screen">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Tombol Kembali / Header Section --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-black uppercase italic tracking-tighter text-slate-800 leading-none">
                    Project Manager <span class="text-red-600">/</span> ARC Studio
                </h2>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.3em] mt-2">Engine Room: Portfolio Management</p>
            </div>
            @if($isOpen)
                <button wire:click="closeModal()" class="text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-red-600 transition">
                    ← Back to List
                </button>
            @endif
        </div>

        @if(!$isOpen)
            {{-- DAFTAR PROJECT (TABLE VIEW) --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-[2rem] border border-slate-100">
                <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-white">
                    <h3 class="font-black uppercase italic text-sm tracking-widest text-slate-500">Active Blueprints</h3>
                    <button wire:click="create()" class="bg-black hover:bg-red-600 text-white text-[10px] font-black uppercase tracking-[0.2em] px-8 py-3 rounded-full transition-all">
                        Add New Project +
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-8 py-4 text-left text-[9px] font-black text-slate-400 uppercase tracking-[0.2em]">Project</th>
                                <th class="px-8 py-4 text-left text-[9px] font-black text-slate-400 uppercase tracking-[0.2em]">Status</th>
                                <th class="px-8 py-4 text-right text-[9px] font-black text-slate-400 uppercase tracking-[0.2em]">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @foreach($projects as $p)
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-4">
                                        @if($p->thumbnail)
                                            <img src="{{ asset('storage/'.$p->thumbnail) }}" class="w-16 h-10 object-cover rounded-lg shadow-sm border border-slate-100">
                                        @endif
                                        <span class="font-black uppercase italic text-slate-700 tracking-tighter">{{ $p->title }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-[10px] font-bold uppercase text-slate-400 italic">
                                    {{ $p->status }}
                                </td>
                                <td class="px-8 py-5 text-right">
                                    <button wire:click="edit({{ $p->id }})" class="text-blue-600 font-black uppercase text-[10px] tracking-widest mr-4">Edit</button>
                                    <button wire:click="delete({{ $p->id }})" wire:confirm="Execute delete?" class="text-red-600 font-black uppercase text-[10px] tracking-widest">Delete</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            {{-- FORM CREATE/EDIT --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-[2rem] border border-slate-100 p-8 md:p-12 animate-in fade-in slide-in-from-bottom-4 duration-500">
                <form wire:submit.prevent="store" class="space-y-8">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- Judul Project --}}
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] mb-2 text-slate-400 italic">Judul Project</label>
                            <input type="text" wire:model="title" 
                                class="w-full p-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:border-black focus:ring-0 outline-none transition font-bold text-xl italic text-slate-800"
                                placeholder="MASUKKAN NAMA PROJECT DISINI...">
                        </div>

                        {{-- Status Tag --}}
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] mb-2 text-slate-400 italic">Status / Platform</label>
                            <input type="text" wire:model="status" 
                                class="w-full p-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:border-black focus:ring-0 outline-none transition font-black uppercase italic text-sm"
                                placeholder="CONTOH: ON MENTARI TV">
                        </div>

                        {{-- Featured Dropdown --}}
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] mb-2 text-slate-400 italic">Featured Status</label>
                            <select wire:model="is_featured" 
                                class="w-full p-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:border-black focus:ring-0 outline-none transition font-black uppercase italic text-sm">
                                <option value="0">REGULAR PROJECT</option>
                                <option value="1">FEATURED (BANNER UTAMA)</option>
                            </select>
                        </div>

                        {{-- Upload Assets --}}
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] mb-2 text-slate-400 italic">Project Assets (Thumbnail, Banner, Logo)</label>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="p-4 bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl flex flex-col items-center gap-2">
                                    <span class="text-[8px] font-black uppercase text-slate-400 italic">Thumbnail</span>
                                    <input type="file" wire:model="thumbnail" class="text-[8px] w-full">
                                </div>
                                <div class="p-4 bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl flex flex-col items-center gap-2">
                                    <span class="text-[8px] font-black uppercase text-slate-400 italic">Hero Banner</span>
                                    <input type="file" wire:model="banner_image" class="text-[8px] w-full">
                                </div>
                                <div class="p-4 bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl flex flex-col items-center gap-2">
                                    <span class="text-[8px] font-black uppercase text-slate-400 italic">Logo Project</span>
                                    <input type="file" wire:model="logo_project" class="text-[8px] w-full">
                                </div>
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] mb-2 text-slate-400 italic">Description</label>
                            <textarea wire:model="description" rows="5" 
                                class="w-full p-6 bg-slate-50 border-2 border-slate-100 rounded-[1.5rem] focus:border-black focus:ring-0 outline-none transition font-medium text-slate-600 shadow-inner"
                                placeholder="Tuliskan detail project..."></textarea>
                        </div>

                        {{-- SECTION KARAKTER (Di dalam Form agar terkirim) --}}
                        <div class="md:col-span-2 mt-8 pt-8 border-t-2 border-slate-50">
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] mb-4 text-slate-400 italic">The Characters / Cast</label>
                            
                            {{-- Indikator Loading --}}
                            <div wire:loading wire:target="character_images" class="mb-4 text-red-600 font-black text-[10px] italic animate-pulse">
                                SYSTEM UPLOADING CHARACTERS... PLEASE WAIT.
                            </div>

                            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                                {{-- Tampilkan Karakter yang Sudah Ada --}}
                                @foreach($existing_characters as $char)
                                    <div class="relative group aspect-square rounded-2xl overflow-hidden border-2 border-slate-100 shadow-sm">
                                        <img src="{{ asset('storage/' . $char->image) }}" class="w-full h-full object-cover">
                                        <button type="button" wire:click="deleteCharacter({{ $char->id }})" 
                                                class="absolute inset-0 bg-red-600/90 text-white opacity-0 group-hover:opacity-100 transition-all flex flex-col items-center justify-center gap-2">
                                            <span class="font-black text-[9px] uppercase italic">Remove</span>
                                        </button>
                                        <div class="absolute bottom-0 inset-x-0 p-2 bg-black/40 backdrop-blur-sm">
                                            <p class="text-[8px] text-white font-bold truncate text-center uppercase">{{ $char->name }}</p>
                                        </div>
                                    </div>
                                @endforeach

                                {{-- Temporary Preview (Gambar yang sedang diupload tapi belum disubmit) --}}
                                @if($character_images)
                                    @foreach($character_images as $image)
                                        <div class="relative aspect-square rounded-2xl overflow-hidden border-2 border-blue-400 animate-pulse">
                                            <img src="{{ $image->temporaryUrl() }}" class="w-full h-full object-cover opacity-50">
                                            <div class="absolute inset-0 flex items-center justify-center">
                                                <span class="bg-blue-600 text-white text-[8px] font-black px-2 py-1 rounded">PENDING</span>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                                {{-- Input Tambah Baru (Dropzone style) --}}
                                <div class="relative aspect-square rounded-2xl border-2 border-dashed border-slate-200 flex flex-col items-center justify-center hover:border-red-600 hover:bg-red-50 transition-all group cursor-pointer">
                                    <input type="file" wire:model="character_images" multiple class="absolute inset-0 opacity-0 cursor-pointer">
                                    <span class="text-2xl text-slate-300 group-hover:text-red-600 transition-colors">+</span>
                                    <span class="text-[8px] font-black text-slate-400 uppercase tracking-widest mt-1 group-hover:text-red-600">Add Cast</span>
                                </div>
                            </div>
                            @error('character_images.*') <span class="text-red-500 text-[10px] font-bold italic mt-2 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- Submit Section --}}
                    <div class="flex justify-end pt-10 border-t border-slate-100 gap-4">
                        <button type="button" wire:click="closeModal()" class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 hover:text-red-600 transition">
                            Cancel
                        </button>
                        <button type="submit" wire:loading.attr="disabled"
                            class="bg-black hover:bg-red-600 text-white font-black py-5 px-14 rounded-full transition-all transform hover:scale-105 shadow-2xl uppercase tracking-[0.2em] text-[10px] disabled:opacity-50">
                            <span wire:loading.remove wire:target="store">{{ $project_id ? 'Update Strategy' : 'Execute Project' }}</span>
                            <span wire:loading wire:target="store">Processing...</span>
                        </button>
                    </div>
                </form>
            </div>
        @endif
    </div>
</div>