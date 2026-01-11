<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>{{ config('app.name', 'ARC MEDIA - Control Center') }}</title>

        {{-- Trix Editor Assets --}}
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
        <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

        {{-- Fonts --}}
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,900&display=swap" rel="stylesheet" />

        {{-- Scripts & Styles --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* 1. Custom Scrollbar */
            ::-webkit-scrollbar { width: 8px; }
            ::-webkit-scrollbar-track { background: #f1f1f1; }
            ::-webkit-scrollbar-thumb { background: #1a1a1a; border-radius: 10px; }

            /* 2. Trix Editor Styling */
            trix-editor {
                min-height: 400px !important;
                border-radius: 1.5rem !important;
                border: 2px solid #f1f5f9 !important;
                background-color: white !important;
                padding: 1.5rem !important;
                font-family: 'Figtree', sans-serif !important;
            }
            trix-editor:focus {
                border-color: #000 !important;
                outline: none !important;
            }
            .trix-button-group--file-tools { display: none !important; }

            /* 3. GLOBAL RESPONSIVE FIX (Magic Trick) */
            @media (max-width: 768px) {
                /* Font h1 & h2 otomatis mengecil di HP */
                h1 { font-size: 2.25rem !important; line-height: 2.5rem !important; letter-spacing: -0.05em !important; }
                h2 { font-size: 1.75rem !important; line-height: 2rem !important; }
                
                /* Container padding lebih rapat di HP agar konten luas */
                .max-w-7xl, .max-w-5xl, .max-w-4xl { 
                    padding-left: 1.25rem !important; 
                    padding-right: 1.25rem !important; 
                }

                /* Memaksa elemen grid yang kaku menjadi 1 kolom di HP */
                .grid-cols-12, .grid-cols-8, .grid-cols-4 { 
                    grid-template-columns: repeat(1, minmax(0, 1fr)) !important; 
                }
                
                /* Mengurangi padding section yang terlalu lebar agar tidak banyak scroll kosong */
                .py-24, .py-32 { padding-top: 3rem !important; padding-bottom: 3rem !important; }
                
                /* Image adjustment agar tidak overflow */
                img { max-width: 100%; height: auto; }
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-slate-50 text-slate-900">
        <div class="min-h-screen flex flex-col">
            {{-- Navbar --}}
            @livewire('layout.navbar') 

            {{-- Header (Dashboard Only) --}}
            @if (isset($header))
                <header class="bg-white border-b border-slate-200">
                    <div class="max-w-7xl mx-auto py-6 md:py-8 px-4 sm:px-6 lg:px-8">
                        <div class="flex items-center gap-4">
                            <div class="w-1.5 h-8 bg-red-600"></div>
                            <div class="flex-1 font-black text-lg md:text-xl text-gray-800 leading-tight uppercase italic tracking-tighter">
                                {{ $header }}
                            </div>
                        </div>
                    </div>
                </header>
            @endif

            {{-- Main Content --}}
            <main class="flex-grow">
                {{ $slot }}
            </main>

            {{-- Footer --}}
            @livewire('layout.footer')
        </div>

        @stack('scripts')
        @livewireScripts
    </body>
</html>