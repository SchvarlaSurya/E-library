<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Athena | Modern E-Library</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=LINE+Seed+JP&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', 'LINE Seed JP', sans-serif; }
        .glass-nav {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }
        .liquid-nav {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
</head>
<body class="bg-white text-zinc-900 antialiased">

    <nav id="navbar" class="fixed top-0 left-0 w-full z-50 liquid-nav py-6">
        <div class="max-w-7xl mx-auto px-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/20">
                    <i data-lucide="book-open" class="w-5 h-5 text-white"></i>
                </div>
                <span class="text-xl font-bold tracking-tight uppercase">Athena</span>
            </div>
            
            <ul class="hidden md:flex items-center gap-8 text-sm font-semibold text-zinc-500">
                <li><a href="/library" class="hover:text-zinc-900 transition-colors">Library</a></li>
                <li><a href="/about" class="hover:text-zinc-900 transition-colors">About</a></li>
                <li><a href="#" class="hover:text-zinc-900 transition-colors">Pricing</a></li>
            </ul>

            <div class="flex items-center gap-5">
                <button class="text-zinc-400 hover:text-zinc-900 transition-colors">
                    <i data-lucide="search" class="w-5 h-5"></i>
                </button>
                <div class="h-5 w-[1px] bg-zinc-200"></div>
                <a href="/login" class="text-sm font-semibold bg-zinc-900 hover:bg-zinc-800 text-white px-6 py-2.5 rounded-full transition-all shadow-md">
                    Sign In
                </a>
            </div>
        </div>
    </nav>

    <main class="min-h-screen relative overflow-hidden flex flex-col justify-center bg-zinc-50">
        <!-- Abstract Glow -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-blue-400/20 rounded-full blur-[120px] pointer-events-none opacity-60 mix-blend-multiply"></div>
        
        <div class="max-w-7xl mx-auto px-6 relative z-10 w-full pt-32 pb-20">
            <div class="flex flex-col items-center text-center max-w-4xl mx-auto space-y-8">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-100 border border-blue-200 backdrop-blur-md">
                    <span class="relative flex h-2.5 w-2.5">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-blue-600"></span>
                    </span>
                    <span class="text-xs font-bold uppercase tracking-widest text-blue-700">Athena Archive 2026</span>
                </div>
                
                <h1 class="text-6xl md:text-8xl font-black text-zinc-900 tracking-tight leading-tight">
                    Simplicity in <br> 
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-500">Digital Reading.</span>
                </h1>
                
                <p class="text-lg md:text-xl text-zinc-500 leading-relaxed max-w-2xl font-medium">
                    Explore a curated collection of premium digital assets and documentation with a distraction-free, synchronized interface.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-6 pt-6 w-full max-w-md">
                    <a href="/library" class="w-full sm:w-auto bg-zinc-900 hover:bg-zinc-800 text-white px-8 py-4 rounded-2xl font-bold text-sm tracking-wide transition-all shadow-xl hover:-translate-y-1 flex items-center justify-center gap-2">
                        Explore Library <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>

            <div class="mt-32 relative mx-auto max-w-5xl perspective-[2000px]">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 transform rotate-x-12 rotate-y-[-5deg] scale-100 hover:scale-[1.02] transition-transform duration-1000 ease-out">
                    @php
                        $gradients = [
                            'from-rose-400 to-orange-300',
                            'from-blue-500 to-cyan-400',
                            'from-emerald-400 to-teal-500',
                            'from-violet-500 to-purple-500'
                        ];
                    @endphp
                    @for ($i = 0; $i < 4; $i++)
                    @php
                        $h = ['h-64', 'h-80', 'h-72', 'h-96'][$i];
                        $t = ['translate-y-0', 'translate-y-8', 'translate-y-4', 'translate-y-12'][$i];
                    @endphp
                    <div class="relative {{ $h }} {{ $t }} rounded-2xl shadow-2xl overflow-hidden hover:-translate-y-4 transition-transform duration-500 ease-out group border border-white/40">
                        <div class="absolute inset-0 bg-gradient-to-br {{ $gradients[$i] }} opacity-90 group-hover:opacity-100 transition-opacity"></div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute inset-x-0 bottom-0 p-6 flex flex-col justify-end">
                            <span class="text-white/60 text-xs font-bold uppercase tracking-widest mb-1">Featured</span>
                            <span class="text-white text-lg font-bold">Volume 0{{$i+1}}</span>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </main>

    <script>
        lucide.createIcons();

        const nav = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                nav.classList.add('glass-nav', 'py-4');
                nav.classList.remove('py-6');
            } else {
                nav.classList.remove('glass-nav', 'py-4');
                nav.classList.add('py-6');
            }
        });
    </script>
</body>
</html>