<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="min-h-[85vh] flex flex-col justify-center items-center px-6">
    <div class="w-full max-w-md bg-[#161616] border border-white/5 p-10 rounded-[2rem] shadow-2xl">
        
        {{-- Header Register --}}
        <div class="text-center mb-8">
            <h2 class="text-3xl font-[900] italic tracking-tighter uppercase text-white mb-2">
                JOIN <span class="text-red-600">ARC</span>
            </h2>
            <p class="text-white/40 text-[10px] font-bold uppercase tracking-[0.2em]">Create your account for full access</p>
        </div>

        <form wire:submit="register" class="space-y-5">
            {{-- Name --}}
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-white/50 mb-2 ml-1">Full Name</label>
                <input wire:model="name" type="text" required autofocus
                    class="w-full bg-[#0f0f0f] border-2 border-white/5 rounded-2xl px-5 py-4 text-white text-sm focus:border-red-600 focus:ring-0 transition-all duration-300 placeholder:text-white/10"
                    placeholder="Enter your name">
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500 text-xs font-bold uppercase italic" />
            </div>

            {{-- Email Address --}}
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-white/50 mb-2 ml-1">Email Address</label>
                <input wire:model="email" type="email" required
                    class="w-full bg-[#0f0f0f] border-2 border-white/5 rounded-2xl px-5 py-4 text-white text-sm focus:border-red-600 focus:ring-0 transition-all duration-300 placeholder:text-white/10"
                    placeholder="name@example.com">
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-xs font-bold uppercase italic" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Password --}}
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-white/50 mb-2 ml-1">Password</label>
                    <input wire:model="password" type="password" required
                        class="w-full bg-[#0f0f0f] border-2 border-white/5 rounded-2xl px-5 py-3 text-white text-sm focus:border-red-600 focus:ring-0 transition-all duration-300">
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-white/50 mb-2 ml-1">Confirm</label>
                    <input wire:model="password_confirmation" type="password" required
                        class="w-full bg-[#0f0f0f] border-2 border-white/5 rounded-2xl px-5 py-3 text-white text-sm focus:border-red-600 focus:ring-0 transition-all duration-300">
                </div>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-500 text-xs font-bold uppercase italic" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-red-500 text-xs font-bold uppercase italic" />

            {{-- Submit Button --}}
            <button type="submit" 
                class="w-full bg-red-600 hover:bg-red-700 text-white font-black uppercase tracking-[0.2em] py-4 rounded-2xl shadow-[0_10px_20px_rgba(220,38,38,0.2)] transition-all transform hover:-translate-y-1 active:scale-[0.98] text-xs mt-4">
                Create Account
            </button>
        </form>

        {{-- Footer --}}
        <div class="mt-8 text-center border-t border-white/5 pt-6">
            <p class="text-[10px] font-bold text-white/20 uppercase tracking-widest">
                Already have an account? 
                <a href="{{ route('login') }}" wire:navigate class="text-red-600 hover:text-red-500 ml-1">Login here</a>
            </p>
        </div>
    </div>
</div>