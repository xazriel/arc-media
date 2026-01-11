<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    public function login(): void
{
    $this->validate();

    $this->form->authenticate();

    Session::regenerate();

    // LOGIKA REDIRECT CUSTOM
    if (auth()->user()->role === 'admin') {
        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    } else {
        // Jika member, lempar ke home
        $this->redirect('/', navigate: true);
    }
}
};
?>

<div class="min-h-[80vh] flex flex-col justify-center items-center px-6">
    <div class="w-full max-w-md bg-[#161616] border border-white/5 p-10 rounded-[2rem] shadow-2xl">
        
        {{-- Header Login --}}
        <div class="text-center mb-10">
            <h2 class="text-3xl font-[900] italic tracking-tighter uppercase text-white mb-2">
                <span class="text-red-600">ARC</span> LOGIN
            </h2>
            <p class="text-white/40 text-[10px] font-bold uppercase tracking-[0.2em]">Enter your credentials to access control center</p>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form wire:submit="login" class="space-y-6">
            {{-- Email Address --}}
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-white/50 mb-2 ml-1">Email Address</label>
                <input wire:model="form.email" type="email" required autofocus
                    class="w-full bg-[#0f0f0f] border-2 border-white/5 rounded-2xl px-5 py-4 text-white text-sm focus:border-red-600 focus:ring-0 transition-all duration-300 placeholder:text-white/10"
                    placeholder="name@example.com">
                <x-input-error :messages="$errors->get('form.email')" class="mt-2 text-red-500 text-xs font-bold uppercase italic" />
            </div>

            {{-- Password --}}
            <div>
                <div class="flex justify-between items-center mb-2 ml-1">
                    <label class="text-[10px] font-black uppercase tracking-widest text-white/50">Password</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" wire:navigate class="text-[9px] font-black uppercase tracking-widest text-red-600 hover:text-red-500 transition">
                            Forgot?
                        </a>
                    @endif
                </div>
                <input wire:model="form.password" type="password" required
                    class="w-full bg-[#0f0f0f] border-2 border-white/5 rounded-2xl px-5 py-4 text-white text-sm focus:border-red-600 focus:ring-0 transition-all duration-300">
                <x-input-error :messages="$errors->get('form.password')" class="mt-2 text-red-500 text-xs font-bold uppercase italic" />
            </div>

            {{-- Remember Me --}}
            <div class="flex items-center px-1">
                <input wire:model="form.remember" id="remember" type="checkbox" 
                    class="w-4 h-4 rounded border-white/10 bg-[#0f0f0f] text-red-600 focus:ring-red-600 focus:ring-offset-[#161616]">
                <label for="remember" class="ms-3 text-[10px] font-black uppercase tracking-widest text-white/30 hover:text-white/60 cursor-pointer transition">
                    Keep me logged in
                </label>
            </div>

            {{-- Submit Button --}}
            <button type="submit" 
                class="w-full bg-red-600 hover:bg-red-700 text-white font-black uppercase tracking-[0.2em] py-4 rounded-2xl shadow-[0_10px_20px_rgba(220,38,38,0.2)] transition-all transform hover:-translate-y-1 active:scale-[0.98] text-xs">
                Log In
            </button>
        </form>

        {{-- Footer --}}
        <div class="mt-8 text-center">
            <p class="text-[10px] font-bold text-white/20 uppercase tracking-widest">
                Don't have an account? 
                <a href="{{ route('register') }}" wire:navigate class="text-red-600 hover:text-red-500 ml-1">Sign Up Now</a>
            </p>
        </div>
    </div>
</div>