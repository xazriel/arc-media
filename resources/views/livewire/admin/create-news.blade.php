<div class="py-6">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-[2rem] border border-slate-100 p-8 md:p-12">
            
            {{-- Header Section --}}
            <div class="mb-10">
                <h2 class="text-3xl font-black uppercase italic tracking-tighter text-slate-800">
                    Create News <span class="text-red-600">/</span> ARC Unite Update
                </h2>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.3em] mt-1">Engine Room: Content Distribution</p>
            </div>

            {{-- Notifications --}}
            @if (session()->has('message'))
                <div class="mb-6 p-4 text-xs font-black uppercase tracking-widest text-green-700 bg-green-50 border-l-4 border-green-500 rounded-r-xl italic">
                    {{ session('message') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 p-4 text-xs font-bold text-red-700 bg-red-50 border-l-4 border-red-500 rounded-r-xl">
                    <ul class="list-disc pl-5 uppercase tracking-tight">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form wire:submit.prevent="save" class="space-y-8">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- Judul Berita --}}
                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] mb-2 text-slate-400 italic">Judul Berita</label>
                        <input type="text" wire:model.live="title" 
                            class="w-full p-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:border-black focus:ring-0 outline-none transition font-bold text-xl italic text-slate-800"
                            placeholder="MASUKKAN JUDUL HEADLINE DISINI...">
                    </div>

                    {{-- Kategori (Dropdown) --}}
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] mb-2 text-slate-400 italic">Kategori</label>
                        <select wire:model.live="category" 
                            class="w-full p-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:border-black focus:ring-0 outline-none transition font-black uppercase italic text-sm">
                            <option value="">PILIH KATEGORI</option>
                            <option value="Film">FILM</option>
                            <option value="Series">SERIES</option>
                            <option value="Shorts">SHORTS</option>
                            <option value="Reviews">REVIEWS</option>
                            <option value="Technology">TECHNOLOGY</option>
                            <option value="Events">EVENTS</option>
                            <option value="Jobs">JOBS</option>
                        </select>
                    </div>

                    {{-- YouTube ID --}}
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] mb-2 text-slate-400 italic">YouTube Video ID (Optional)</label>
                        <input type="text" wire:model.live="youtube_video_id" 
                            class="w-full p-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:border-black focus:ring-0 outline-none transition font-medium text-sm"
                            placeholder="ID setelah v=">
                    </div>

                    {{-- Thumbnail --}}
                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] mb-2 text-slate-400 italic">Thumbnail Image</label>
                        <div class="flex flex-col md:flex-row items-center gap-6 p-6 border-2 border-dashed border-slate-200 rounded-[1.5rem] bg-slate-50/50">
                            <input type="file" wire:model="thumbnail" 
                                class="text-xs font-black uppercase file:mr-4 file:py-2 file:px-6 file:rounded-full file:border-0 file:bg-black file:text-white hover:file:bg-red-600 file:transition file:cursor-pointer">
                            
                            <div wire:loading wire:target="thumbnail" class="text-[10px] font-black text-blue-600 animate-pulse uppercase">Uploading Image...</div>

                            @if ($thumbnail)
                                <div class="relative group">
                                    <img src="{{ $thumbnail->temporaryUrl() }}" class="w-48 h-28 object-cover rounded-xl shadow-2xl border-4 border-white">
                                    <div class="absolute inset-0 bg-black/40 rounded-xl opacity-0 group-hover:opacity-100 transition flex items-center justify-center text-[8px] text-white font-black uppercase">Preview Mode</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Trix Editor (Rich Content) --}}
<div class="md:col-span-2" wire:ignore>
    <label class="block text-[10px] font-black uppercase tracking-[0.2em] mb-2 text-slate-400 italic">Content (Rich Text)</label>
    
    <input id="content_editor" type="hidden" name="content" value="{{ $content }}">
    <trix-editor 
        input="content_editor" 
        x-data
        x-on:trix-change="$wire.set('content', $event.target.value)"
        class="bg-white border-2 border-slate-100 rounded-[1.5rem] p-6 focus:border-black outline-none transition prose prose-slate max-w-none shadow-inner min-h-[400px]"
        placeholder="Mulai menulis konten eksklusif ARC disini...">
    </trix-editor>
</div>

                {{-- Options/Toggles --}}
                <div class="flex flex-wrap gap-4">
                    <div class="flex items-center p-4 bg-slate-50 rounded-2xl border border-slate-100 hover:border-red-200 transition-all group">
                        <input type="checkbox" wire:model="is_highlight" id="is_highlight" 
                            class="w-6 h-6 rounded-lg border-slate-300 text-red-600 focus:ring-red-500 cursor-pointer">
                        <label for="is_highlight" class="ml-4 text-[10px] font-black uppercase italic tracking-widest cursor-pointer group-hover:text-red-600 transition">Tampilkan di Highlight Frontline</label>
                    </div>

                    <div class="flex items-center p-4 bg-slate-50 rounded-2xl border border-slate-100 hover:border-blue-200 transition-all group">
                        <input type="checkbox" wire:model="is_member_only" id="is_member_only" 
                            class="w-6 h-6 rounded-lg border-slate-300 text-blue-600 focus:ring-blue-500 cursor-pointer">
                        <label for="is_member_only" class="ml-4 text-[10px] font-black uppercase italic tracking-widest cursor-pointer group-hover:text-blue-600 transition">Khusus Member Only</label>
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="flex justify-end pt-10 border-t border-slate-100">
                    <button type="submit" wire:loading.attr="disabled" 
                        class="bg-black hover:bg-red-600 text-white font-black py-5 px-14 rounded-full transition-all duration-300 transform hover:scale-105 shadow-2xl flex items-center gap-4 uppercase tracking-[0.2em] text-[10px]">
                        <span wire:loading.remove>Publish Story</span>
                        <span wire:loading class="flex items-center gap-2">
                            <svg class="animate-spin h-4 w-4 text-white" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            Syncing to Server...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>