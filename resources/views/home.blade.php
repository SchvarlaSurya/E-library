@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-12 md:py-16">

        {{-- Hero Section --}}
        <section class="mb-16 rounded-[2rem] overflow-hidden bg-[var(--accent)] text-white relative">
            <div class="absolute inset-0 bg-black/10 mix-blend-multiply"></div>
            <div class="relative z-10 flex flex-col lg:flex-row items-center gap-12 p-10 md:p-16">

                <div class="flex-1 flex flex-col gap-6">
                    <div>
                        <span
                            class="inline-flex items-center px-4 py-2 rounded-full bg-white/20 backdrop-blur-md text-xs font-bold tracking-widest uppercase mb-4 text-[#fae1cd]">
                            Perpustakaan Digital Kamu
                        </span>
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-black leading-tight tracking-tight text-[#fdfbf7]">
                            Temukan Cerita yang Menghangatkan Hari
                        </h1>
                    </div>
                    <p class="text-lg md:text-xl font-medium leading-relaxed max-w-xl opacity-90 text-[#fdfbf7]">
                        Ribuan buku siap menemani waktu santaimu — dari fiksi klasik hingga non-fiksi modern. Mulai membaca
                        hari ini.
                    </p>
                    <div class="flex flex-col sm:flex-row items-center gap-4 mt-4">
                        <a href="/library"
                            class="w-full sm:w-auto px-8 py-4 rounded-xl font-bold bg-[#fdfbf7] text-[var(--accent)] hover:bg-white hover:scale-105 transition-all shadow-md text-center">
                            Mulai Membaca
                        </a>
                        <a href="/library"
                            class="w-full sm:w-auto px-8 py-4 rounded-xl font-bold bg-transparent border-2 border-[#fdfbf7] text-[#fdfbf7] hover:bg-[#fdfbf7]/10 transition-colors text-center">
                            Lihat Koleksi
                        </a>
                    </div>
                </div>

                <div class="w-full lg:w-1/3 flex flex-col justify-center gap-4">
                    <div
                        class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-lg hover:-translate-y-1 transition-transform">
                        <div class="text-3xl font-black text-[#fdfbf7] mb-1">12K+</div>
                        <div class="text-[0.65rem] font-bold uppercase tracking-widest text-[#fdfbf7]/70">Koleksi Buku</div>
                    </div>
                    <div
                        class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-lg hover:-translate-y-1 transition-transform">
                        <div class="text-3xl font-black text-[#fdfbf7] mb-1">340+</div>
                        <div class="text-[0.65rem] font-bold uppercase tracking-widest text-[#fdfbf7]/70">Penulis</div>
                    </div>
                    <div
                        class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-lg hover:-translate-y-1 transition-transform">
                        <div class="text-3xl font-black text-[#fdfbf7] mb-1">98%</div>
                        <div class="text-[0.65rem] font-bold uppercase tracking-widest text-[#fdfbf7]/70">Kepuasan</div>
                    </div>
                </div>

            </div>
        </section>

        {{-- Main 2-Column Grid --}}
        <div class="flex flex-col lg:flex-row gap-12">

            {{-- Left Sidebar --}}
            <aside class="w-full lg:w-72 flex-shrink-0 flex flex-col gap-10">

                {{-- Categories --}}
                <div>
                    <h3 class="text-xs font-bold text-zinc-400 uppercase tracking-widest mb-4">Kategori</h3>
                    <div class="flex flex-col gap-2">
                        <a href="/library"
                            class="flex items-center justify-between px-4 py-3 rounded-xl bg-[var(--accent)] text-white shadow-sm hover:scale-[1.02] transition-transform">
                            <div class="flex items-center gap-3 font-semibold text-sm">
                                <i data-lucide="layers" class="w-4 h-4 text-white/70"></i>
                                Semua
                            </div>
                            <span class="text-xs font-bold text-white/50">12K</span>
                        </a>

                        @php
                            $cats = [
                                ['name' => 'Fiksi', 'icon' => 'book-open', 'count' => '4.2K'],
                                ['name' => 'Non-Fiksi', 'icon' => 'compass', 'count' => '3.1K'],
                                ['name' => 'Sejarah', 'icon' => 'globe', 'count' => '1.5K'],
                                ['name' => 'Self-Help', 'icon' => 'heart', 'count' => '1.8K'],
                                ['name' => 'Sains', 'icon' => 'atom', 'count' => '850'],
                                ['name' => 'Drama', 'icon' => 'theater', 'count' => '620'],
                            ];
                        @endphp
                        @foreach($cats as $c)
                            <a href="/library?category={{ \Illuminate\Support\Str::slug($c['name']) }}"
                                class="flex items-center justify-between px-4 py-3 rounded-xl bg-transparent hover:bg-black/5 dark:hover:bg-white/5 text-zinc-600 dark:text-zinc-400 hover:text-[var(--foreground)] transition-colors">
                                <div class="flex items-center gap-3 font-medium text-sm">
                                    <i data-lucide="{{ $c['icon'] }}" class="w-4 h-4 opacity-50"></i>
                                    {{ $c['name'] }}
                                </div>
                                <span class="text-xs font-medium opacity-40">{{ $c['count'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>


                {{-- Filter Bahasa --}}
                <div>
                    <h3 class="text-xs font-bold text-zinc-400 uppercase tracking-widest mb-4">Filter Bahasa</h3>
                    <div class="flex flex-col gap-3">
                        <a href="/library?lang=id" class="flex items-center gap-3 cursor-pointer group">
                            <div
                                class="w-5 h-5 rounded border-2 border-[var(--accent)] bg-[var(--accent)] flex items-center justify-center">
                                <i data-lucide="check" class="w-3 h-3 text-white"></i>
                            </div>
                            <span class="text-sm font-semibold text-[var(--foreground)]">Indonesia</span>
                        </a>
                        <a href="/library?lang=en" class="flex items-center gap-3 cursor-pointer group">
                            <div
                                class="w-5 h-5 rounded border-2 border-zinc-300 dark:border-zinc-700 group-hover:border-[var(--accent)] transition-colors flex items-center justify-center">
                            </div>
                            <span
                                class="text-sm font-medium text-zinc-500 group-hover:text-[var(--foreground)]">English</span>
                        </a>
                        <a href="/library?lang=jw" class="flex items-center gap-3 cursor-pointer group">
                            <div
                                class="w-5 h-5 rounded border-2 border-zinc-300 dark:border-zinc-700 group-hover:border-[var(--accent)] transition-colors flex items-center justify-center">
                            </div>
                            <span class="text-sm font-medium text-zinc-500 group-hover:text-[var(--foreground)]">Jawa</span>
                        </a>
                    </div>
                </div>

                {{-- Upgrade to Pro Banner --}}
                <div class="relative overflow-hidden rounded-[1.25rem] bg-gradient-to-br from-[#2a2622] to-[#1a1816] border border-[#3e3832] p-6 shadow-xl shadow-amber-900/10 group mt-4">
                    <!-- Decorative Elements -->
                    <div class="absolute top-0 right-0 w-32 h-32 bg-amber-500/10 rounded-full blur-2xl -mr-10 -mt-10 transition-transform duration-700 group-hover:scale-150"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-orange-500/10 rounded-full blur-xl -ml-8 -mb-8 transition-transform duration-700 group-hover:scale-150"></div>
                    
                    <div class="relative z-10 flex flex-col">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-amber-200 to-amber-500 flex items-center justify-center shadow-lg shadow-amber-500/20 mb-4">
                            <i data-lucide="crown" class="w-5 h-5 text-amber-950 fill-amber-300"></i>
                        </div>
                        
                        <h3 class="text-white font-black text-lg tracking-tight mb-2 flex items-center gap-2">
                            ReadSpace <span class="text-[0.6rem] px-1.5 py-0.5 rounded-md bg-amber-500 text-white font-bold tracking-widest uppercase mb-1">PRO</span>
                        </h3>
                        
                        <p class="text-[0.8rem] font-medium text-zinc-400 leading-relaxed mb-5">
                            Buka akses tak terbatas ke koleksi premium, bebas iklan, dan statistik membaca mendalam.
                        </p>
                        
                        <a href="/upgrade" class="w-full flex items-center justify-center gap-2 bg-[#fdfbf7] text-[#1a1816] font-bold text-xs py-3 rounded-xl hover:scale-[1.02] hover:bg-white transition-all active:scale-95 shadow-sm">
                            Upgrade Sekarang
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </a>
                    </div>
                </div>

            </aside>

            {{-- Main Content Window --}}
            <div class="flex-1 flex flex-col gap-12">

                {{-- Pilihan Editor --}}
                <section>
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-black text-[var(--foreground)] tracking-tight">Pilihan Editor</h2>
                        <a href="#" class="text-sm font-bold text-[var(--accent)] hover:underline">Lihat semua &rarr;</a>
                    </div>
                    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
                        {{-- Card 1 --}}
                        <div
                            class="bg-white dark:bg-zinc-900 border border-[var(--card-border)] rounded-[2rem] p-6 shadow-sm hover:shadow-xl transition-all group flex flex-col h-full gap-4 relative overflow-hidden">
                            <div class="absolute -right-4 -top-4 w-32 h-32 bg-[var(--accent)]/5 rounded-full blur-2xl">
                            </div>
                            <div class="flex items-start justify-between z-10">
                                <div class="flex gap-2">
                                    <span
                                        class="bg-zinc-100 text-zinc-600 dark:bg-zinc-800 dark:text-zinc-400 text-[0.65rem] font-bold uppercase tracking-widest px-3 py-1 rounded-full border border-black/5">Fiksi
                                        Sastra</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-6 mt-2 mb-2 z-10">
                                <div
                                    class="w-24 h-32 bg-[#e8e1d7] dark:bg-zinc-800 rounded-xl flex items-center justify-center text-[var(--accent)] shrink-0 shadow-md">
                                    <i data-lucide="book" class="w-8 h-8"></i>
                                </div>
                                <div class="flex flex-col">
                                    <h3
                                        class="text-xl font-black leading-tight text-[var(--foreground)] mb-2 group-hover:text-[var(--accent)] transition-colors">
                                        Bumi Manusia</h3>
                                    <p class="text-sm font-medium text-zinc-500 mb-1">Pramoedya Ananta Toer &middot; 1980
                                    </p>
                                </div>
                            </div>
                            <div class="mt-auto flex items-center gap-3 w-full z-10 pt-2">
                                <button
                                    class="flex-1 bg-[var(--foreground)] text-[var(--background)] py-3 rounded-xl font-bold text-xs uppercase tracking-wider hover:scale-105 transition-transform">Baca
                                    Sekarang</button>
                                <button data-id="bumi-manusia" data-title="Bumi Manusia" data-author="Pramoedya Ananta Toer" data-thumbnail="https://images.unsplash.com/photo-1544947950-fa07a98d237f?q=80&w=300&auto=format&fit=crop"
                                    class="global-bookmark-btn w-12 h-12 flex items-center justify-center border border-[var(--card-border)] rounded-xl text-zinc-500 hover:text-white hover:border-[var(--accent)] hover:bg-[var(--accent)] cursor-pointer transition-colors group/btn"><i
                                        data-lucide="bookmark-plus" class="w-5 h-5 group-hover/btn:scale-110 transition-transform"></i></button>
                            </div>
                        </div>

                        {{-- Card 2 --}}
                        <div
                            class="bg-white dark:bg-zinc-900 border border-[var(--card-border)] rounded-[2rem] p-6 shadow-sm hover:shadow-xl transition-all group flex flex-col h-full gap-4 relative overflow-hidden">
                            <div class="absolute -right-4 -top-4 w-32 h-32 bg-emerald-500/5 rounded-full blur-2xl"></div>
                            <div class="flex items-start justify-between z-10">
                                <div class="flex gap-2">
                                    <span
                                        class="bg-zinc-100 text-zinc-600 dark:bg-zinc-800 dark:text-zinc-400 text-[0.65rem] font-bold uppercase tracking-widest px-3 py-1 rounded-full border border-black/5">Non-Fiksi</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-6 mt-2 mb-2 z-10">
                                <div
                                    class="w-24 h-32 bg-[#e3e8d7] dark:bg-zinc-800 rounded-xl flex items-center justify-center text-emerald-600 shrink-0 shadow-md">
                                    <i data-lucide="leaf" class="w-8 h-8"></i>
                                </div>
                                <div class="flex flex-col">
                                    <h3
                                        class="text-xl font-black leading-tight text-[var(--foreground)] mb-2 group-hover:text-[var(--accent)] transition-colors">
                                        Filosofi Teras</h3>
                                    <p class="text-sm font-medium text-zinc-500 mb-1">Henry Manampiring &middot; 2019</p>
                                </div>
                            </div>
                            <div class="mt-auto flex items-center gap-3 w-full z-10 pt-2">
                                <button
                                    class="flex-1 bg-[var(--foreground)] text-[var(--background)] py-3 rounded-xl font-bold text-xs uppercase tracking-wider hover:scale-105 transition-transform">Baca
                                    Sekarang</button>
                                <button data-id="filosofi-teras" data-title="Filosofi Teras" data-author="Henry Manampiring" data-thumbnail="https://images.unsplash.com/photo-1512820790803-83ca734da794?q=80&w=300&auto=format&fit=crop"
                                    class="global-bookmark-btn w-12 h-12 flex items-center justify-center border border-[var(--card-border)] rounded-xl text-zinc-500 hover:text-white hover:border-[var(--accent)] hover:bg-[var(--accent)] cursor-pointer transition-colors group/btn"><i
                                        data-lucide="bookmark-plus" class="w-5 h-5 group-hover/btn:scale-110 transition-transform"></i></button>
                            </div>
                        </div>

                    </div>
                </section>

                {{-- Buku Terpopuler Grid --}}
                <section>
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-2xl font-black text-[var(--foreground)] tracking-tight">Buku Terpopuler</h2>
                        <a href="#" class="text-sm font-bold text-[var(--accent)] hover:underline">Lihat semua &rarr;</a>
                    </div>

                    {{-- Filter Chips --}}
                    <div class="flex items-center gap-2 mb-6 overflow-x-auto pb-2 scrollbar-hide">
                        @php
                            $chips = ['Semua' => true, 'Minggu ini' => false, 'Bulan ini' => false, 'Fiksi' => false, 'Non-Fiksi' => false, 'Lokal' => false];
                        @endphp
                        @foreach($chips as $lbl => $isActive)
                            <a href="/library?filter={{ \Illuminate\Support\Str::slug($lbl) }}"
                                class="block px-4 py-2 rounded-full text-xs font-bold whitespace-nowrap {{ $isActive ? 'bg-[var(--foreground)] text-[var(--background)] shadow-md' : 'bg-white dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 border border-[var(--card-border)]' }} transition-colors">
                                {{ $lbl }}
                            </a>
                        @endforeach
                    </div>

                    {{-- Book Grid --}}
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        @php
                            $popBooks = [
                                ['id' => 'Milk And Honey', 'title' => 'Milk And Honey', 'author' => 'Rupi Kaur', 'rating' => '4.9', 'badge' => 'Lama', 'image' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?q=80&w=600&auto=format&fit=crop'],
                                ['id' => 'paket bundling buku', 'title' => 'Paket Bundling Buku', 'author' => 'Gramedia', 'rating' => '4.7', 'badge' => '', 'image' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?q=80&w=600&auto=format&fit=crop'],
                                ['id' => 'Matt Ridley', 'title' => 'How Innovation Works', 'author' => 'Matt Ridley', 'rating' => '4.8', 'badge' => 'Trending', 'image' => 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?q=80&w=600&auto=format&fit=crop'],
                                ['id' => 'Bundling buku', 'title' => 'Bundling Buku', 'author' => 'Gramedia', 'rating' => '4.6', 'badge' => '', 'image' => 'https://images.unsplash.com/photo-1543002588-bfa74002ed7e?q=80&w=600&auto=format&fit=crop']
                            ];
                        @endphp
                        @foreach($popBooks as $pb)
                            <div class="flex flex-col group relative">
                                <div
                                    class="w-full aspect-[2/3] bg-white dark:bg-zinc-900 border border-[var(--card-border)] rounded-2xl flex flex-col items-center justify-center shadow-sm group-hover:shadow-md mb-4 transition-all hover:-translate-y-1 relative overflow-hidden">
                                    @if($pb['badge'] != '')
                                        <div
                                            class="absolute top-2 left-2 px-2.5 py-1 bg-rose-500 text-white text-[0.6rem] font-bold uppercase tracking-wider rounded-lg z-10 shadow-sm">
                                            {{ $pb['badge'] }}</div>
                                    @endif
                                    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105" style="background-image: url('{{ $pb['image'] }}');"></div>

                                    <div
                                        class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center gap-3 backdrop-blur-[2px] z-10">
                                        <button
                                            class="bg-white text-black px-6 py-2 rounded-full text-xs font-bold shadow-xl hover:scale-105 transition-transform flex items-center gap-2">Detail buku
                                            <i data-lucide="arrow-right" class="w-3 h-3"></i></button>
                                    </div>

                                    <div class="absolute top-3 right-3 z-20">
                                        <button data-id="{{ $pb['id'] }}" data-title="{{ $pb['title'] }}" data-author="{{ $pb['author'] }}" data-thumbnail="{{ $pb['image'] }}" 
                                                class="global-bookmark-btn w-8 h-8 rounded-full bg-white/20 backdrop-blur-md border border-white/20 flex items-center justify-center text-white hover:bg-[var(--accent)] hover:text-white cursor-pointer transition-all shadow-md group/btn">
                                            <i data-lucide="bookmark" class="w-4 h-4 group-hover/btn:scale-110 transition-transform"></i>
                                        </button>
                                    </div>
                                </div>
                                <h3 class="text-[0.95rem] font-bold text-[var(--foreground)] leading-tight mb-1 truncate">
                                    {{ $pb['title'] }}</h3>
                                <p class="text-xs font-medium text-zinc-500 mb-2 truncate">{{ $pb['author'] }}</p>
                                <div class="flex items-center gap-1.5 mt-auto text-xs font-bold text-amber-500">
                                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                    <span>{{ $pb['rating'] }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>

            </div>
        </div>

        {{-- Bottom Banner --}}
        <section
            class="mt-20 w-full rounded-[2rem] bg-[#2d2a26] text-white p-12 md:p-16 flex flex-col md:flex-row items-center justify-between gap-8 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0naHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmcnIHdpZHRoPSc0MDAnIGhlaWdodD0nNDAwJz48ZGVmcz48cGF0dGVybiBpZD0ncGF0dGVybicgd2lkdGg9JzQwJyBoZWlnaHQ9JzQwJyBwYXR0ZXJuVW5pdHM9J3VzZXJTcGFjZU9uVXNlcic+PHBhdGggZD0nTTIwaDBjMTEuMDUgMCAyMC04Ljk1IDIwLTIwdjBWMGMwIDExLjA1LTguOTUgMjAtMjAgMjBTMCAxMS4wNSAwIDB2MHZwaDBjMCAxMS4wNSA4Ljk1IDIwIDIwIDIweicgZmlsbD0nbm9uZScgc3Ryb2tlPScjZmZmJyBzdHJva2Utd2lkdGg9JzAuMTUnLz48L3BhdHRlcm4+PC9kZWZzPjxyZWN0IHdpZHRoPScxMDAlJyBoZWlnaHQ9JzEwMCUnIGZpbGw9J3VybCgjcGF0dGVybiknLz48L3N2Zz4=')] bg-repeat relative overflow-hidden shadow-2xl">
            <div class="absolute inset-0 bg-gradient-to-r from-black/80 to-black/20"></div>
            <div class="relative z-10 flex flex-col gap-3 text-center md:text-left">
                <h2 class="text-3xl md:text-4xl font-black tracking-tight text-[#fdfbf7]">Upgrade ke ReadSpace Pro</h2>
                <p class="text-sm font-medium text-white/70">Akses tak terbatas &middot; Unduh offline &middot; Bebas iklan
                </p>
            </div>
            <button
                class="relative z-10 whitespace-nowrap bg-[#fdfbf7] text-[#2d2a26] px-8 py-4 rounded-xl text-sm font-bold shadow-xl hover:scale-105 transition-transform outline-none ring-4 ring-white/10">
                Coba Gratis 30 Hari
            </button>
        </section>

    </div>

    @push('scripts')
        <script>
            // Remove old parallax logic
        </script>
    @endpush

@endsection