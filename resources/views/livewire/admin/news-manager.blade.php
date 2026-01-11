<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-black uppercase italic tracking-tighter">News Management</h2>
                {{-- Tombol kembali ke Dashboard jika sedang di halaman list --}}
                <a href="{{ route('dashboard') }}" class="text-[10px] font-black uppercase bg-slate-100 px-4 py-2 rounded-xl hover:bg-black hover:text-white transition">← Back to Dashboard</a>
            </div>

            @if (session()->has('message'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 text-xs font-bold uppercase italic">
                    {{ session('message') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b-2 border-black text-[10px] font-black uppercase tracking-widest text-slate-400">
                            <th class="py-3">Thumbnail</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm font-medium">
                        @foreach($all_news as $item)
                        <tr class="border-b border-slate-100 hover:bg-slate-50 transition">
                            <td class="py-4">
                                @if($item->thumbnail)
                                    <img src="{{ asset('storage/'.$item->thumbnail) }}" class="w-20 h-12 object-cover rounded shadow-sm">
                                @else
                                    <div class="w-20 h-12 bg-slate-100 rounded flex items-center justify-center text-[8px] font-black text-slate-400 uppercase">No Image</div>
                                @endif
                            </td>
                            <td>
                                <div class="font-bold uppercase italic text-slate-800">{{ $item->title }}</div>
                                <div class="text-[9px] text-slate-400 font-medium">{{ Str::limit(strip_tags($item->content), 50) }}</div>
                            </td>
                            <td><span class="text-[10px] bg-slate-100 px-2 py-1 rounded font-black uppercase tracking-tighter">{{ $item->category }}</span></td>
                            <td>
                                <div class="flex flex-col gap-1">
                                    @if($item->is_highlight)
                                        <span class="text-red-600 font-black text-[9px] italic underline">HIGHLIGHT</span>
                                    @endif
                                    @if($item->is_member_only)
                                        <span class="text-blue-600 font-black text-[9px] italic underline">MEMBER ONLY</span>
                                    @endif
                                    @if(!$item->is_highlight && !$item->is_member_only)
                                        <span class="text-slate-300 text-[9px] font-black uppercase italic">Standard</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="flex gap-3">
                                    <button wire:click="edit({{ $item->id }})" class="bg-blue-50 text-blue-600 px-3 py-1 rounded-lg font-black uppercase text-[10px] hover:bg-blue-600 hover:text-white transition">Edit</button>
                                    <button wire:click="delete({{ $item->id }})" onclick="confirm('Delete this story permanently?') || event.stopImmediatePropagation()" class="bg-red-50 text-red-600 px-3 py-1 rounded-lg font-black uppercase text-[10px] hover:bg-red-600 hover:text-white transition">Delete</button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-6">{{ $all_news->links() }}</div>
        </div>
    </div>

    {{-- MODAL CRUD (Diselaraskan dengan CreateNews) --}}
    @if($isModalOpen)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
        <div class="bg-white w-full max-w-4xl p-8 rounded-[2rem] shadow-2xl overflow-y-auto max-h-[90vh]">
            <div class="flex justify-between items-start mb-8 border-b-4 border-black pb-4">
                <h3 class="text-3xl font-black uppercase italic tracking-tighter">
                    {{ $news_id ? 'Update Story' : 'New Story' }}
                </h3>
                <button wire:click="closeModal()" class="text-slate-400 hover:text-black font-black text-2xl">&times;</button>
            </div>
            
            <form wire:submit.prevent="store" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Title --}}
                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-black uppercase tracking-widest mb-2 text-slate-400">Judul Berita</label>
                        <input type="text" wire:model="title" class="w-full border-2 border-slate-100 rounded-2xl p-4 focus:border-black outline-none transition font-bold italic text-lg">
                        @error('title') <span class="text-red-500 text-[10px] font-bold uppercase italic mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- Category --}}
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest mb-2 text-slate-400">Category</label>
                        <select wire:model="category" class="w-full border-2 border-slate-100 rounded-2xl p-4 font-bold uppercase italic focus:border-black outline-none transition">
                            <option value="">Select Category</option>
                            <option value="Film">FILM</option>
                            <option value="Series">SERIES</option>
                            <option value="Shorts">SHORTS</option>
                            <option value="Reviews">REVIEWS</option>
                            <option value="Technology">TECHNOLOGY</option>
                            <option value="Events">EVENTS</option>
                            <option value="Jobs">JOBS</option>
                        </select>
                        @error('category') <span class="text-red-500 text-[10px] font-bold uppercase italic mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- YouTube ID --}}
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest mb-2 text-slate-400">YouTube Video ID (Optional)</label>
                        <input type="text" wire:model="youtube_video_id" placeholder="ID setelah v=" class="w-full border-2 border-slate-100 rounded-2xl p-4">
                    </div>

                    {{-- Thumbnail --}}
                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-black uppercase tracking-widest mb-2 text-slate-400">Thumbnail Image</label>
                        <div class="flex flex-col md:flex-row items-center gap-6 p-4 border-2 border-dashed border-slate-100 rounded-2xl">
                            <input type="file" wire:model="thumbnail" class="text-xs font-black uppercase">
                            
                            @if($thumbnail)
                                <div class="text-center">
                                    <p class="text-[8px] font-black uppercase mb-1 text-blue-600 italic">New Preview:</p>
                                    <img src="{{ $thumbnail->temporaryUrl() }}" class="w-32 h-20 object-cover rounded-lg shadow-md border-2 border-white">
                                </div>
                            @elseif($old_thumbnail)
                                <div class="text-center">
                                    <p class="text-[8px] font-black uppercase mb-1 text-slate-400 italic">Current Image:</p>
                                    <img src="{{ asset('storage/'.$old_thumbnail) }}" class="w-32 h-20 object-cover rounded-lg shadow-md border-2 border-white">
                                </div>
                            @endif
                        </div>
                        <div wire:loading wire:target="thumbnail" class="text-[10px] font-black text-blue-500 mt-2 uppercase italic">Uploading...</div>
                    </div>
                </div>

                {{-- Content with Trix --}}
                <div wire:ignore>
                    <label class="block text-[10px] font-black uppercase tracking-widest mb-2 text-slate-400">Content (Rich Text)</label>
                    <input id="content_edit" type="hidden" name="content" value="{{ $content }}">
                    <trix-editor 
                        input="content_edit" 
                        x-data
                        x-on:trix-change="$dispatch('input', $event.target.value)"
                        wire:model.defer="content"
                        class="border-2 border-slate-100 rounded-2xl p-4 focus:border-black outline-none transition min-h-[300px] prose prose-slate max-w-none"
                    ></trix-editor>
                </div>
                @error('content') <span class="text-red-500 text-[10px] font-bold uppercase italic">{{ $message }}</span> @enderror

                {{-- Feature Toggles --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-center gap-3 bg-slate-50 p-4 rounded-2xl border border-slate-100">
                        <input type="checkbox" wire:model="is_highlight" id="is_h_edit" class="w-5 h-5 rounded border-gray-300 text-red-600 focus:ring-red-500">
                        <label for="is_h_edit" class="text-[10px] font-black uppercase italic tracking-widest cursor-pointer text-red-600">Jadikan Highlight Frontline</label>
                    </div>

                    <div class="flex items-center gap-3 bg-slate-50 p-4 rounded-2xl border border-slate-100">
                        <input type="checkbox" wire:model="is_member_only" id="is_m_edit" class="w-5 h-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <label for="is_m_edit" class="text-[10px] font-black uppercase italic tracking-widest cursor-pointer text-blue-600">Khusus Member Only</label>
                    </div>
                </div>

                <div class="flex justify-end gap-3 mt-8 border-t-2 border-slate-50 pt-6">
                    <button type="button" wire:click="closeModal()" class="px-6 py-3 font-black uppercase text-[10px] text-slate-400 hover:text-black transition">Cancel</button>
                    <button type="submit" wire:loading.attr="disabled" class="px-10 py-4 bg-black text-white font-black uppercase text-[10px] tracking-[0.2em] rounded-full hover:bg-red-600 transition shadow-xl flex items-center gap-2">
                        <span wire:loading.remove>{{ $news_id ? 'Update Story' : 'Save Story' }}</span>
                        <span wire:loading>Processing...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>