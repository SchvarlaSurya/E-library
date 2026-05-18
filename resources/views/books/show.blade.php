@extends('layouts.app')

@section('content')
@php
    $info = $book['volumeInfo'] ?? [];
    $title = $info['title'] ?? 'Tanpa Judul';
    $author = $info['authors'][0] ?? 'Penulis Tidak Diketahui';
    $categories = $info['categories'] ?? ['Klasik Indonesia'];
    $publisher = $info['publisher'] ?? 'Independen';
    $year = substr($info['publishedDate'] ?? '1980', 0, 4);
    $pages = $info['pageCount'] ?? '535';
    $isbn = $info['industryIdentifiers'][0]['identifier'] ?? 'Tetralogi Buru #1';
    $hours = max(1, round((int)$pages / 30));
    $rating = $info['averageRating'] ?? 4.9;
    $ratingCount = $info['ratingsCount'] ?? '12.480';
    $cover = $info['imageLinks']['thumbnail'] ?? $info['imageLinks']['smallThumbnail'] ?? 'https://via.placeholder.com/300x450/f4f0eb/8b6a4f?text=Sampul';
    $desc = strip_tags($info['description'] ?? 'Tidak ada sinopsis tersedia untuk buku ini.');
@endphp

<div class="min-h-screen bg-[#fcfbfa] dark:bg-[#1a1918] text-[#2c2a29] dark:text-[#ece4db] font-sans pb-24 transition-colors">
    
    {{-- Custom Page Header (Breadcrumbs) --}}
    <div class="border-b border-[#f0ece5] dark:border-[#33302c] bg-white dark:bg-[#141312]">
        <div class="max-w-7xl mx-auto px-6 h-14 flex items-center justify-between text-sm font-medium">
            <div class="flex items-center gap-3 text-[#827a72] dark:text-[#9e968d]">
                <a href="/" class="hover:text-[#8b6a4f] transition-colors">Beranda</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <a href="/library" class="hover:text-[#8b6a4f] transition-colors">{{ $categories[0] ?? 'Kategori' }}</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <span class="text-[#2c2a29] dark:text-[#ece4db] font-semibold truncate max-w-[200px] sm:max-w-xs">{{ $title }}</span>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 pt-12">
        {{-- Top Section: Hero Book Detail --}}
        <div class="grid lg:grid-cols-12 gap-10">
            
            {{-- 1. Left (Cover) --}}
            <div class="lg:col-span-3">
                <div class="bg-[#f0ece5] dark:bg-[#282522] rounded-3xl p-6 flex flex-col items-center justify-center shadow-inner aspect-[3/4] relative overflow-hidden group">
                    <img src="{{ $cover }}" alt="{{ $title }}" class="w-full h-full object-cover rounded-xl shadow-lg border border-[#e6ddcf] dark:border-[#3d3833] transition-transform duration-700 group-hover:scale-105 z-10">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent z-20"></div>
                </div>
            </div>

            {{-- 2. Middle (Info) --}}
            <div class="lg:col-span-6 flex flex-col">
                <div class="flex flex-wrap gap-2 mb-5">
                    @foreach(array_slice($categories, 0, 3) as $cat)
                        <span class="px-3 py-1 bg-[#ede8e0] dark:bg-[#33302c] text-[#6b6258] dark:text-[#bea896] text-[11px] font-bold rounded-full uppercase tracking-wider">{{ $cat }}</span>
                    @endforeach
                </div>
                
                <h1 class="text-4xl md:text-5xl font-black tracking-tight leading-tight mb-2">{{ $title }}</h1>
                <p class="text-lg text-[#8b6a4f] dark:text-[#bea896] font-semibold mb-5">{{ $author }}</p>
                
                <div class="flex items-center gap-3 mb-8 text-sm font-semibold">
                    <div class="flex items-center gap-1 text-amber-500">
                        @for($i=0; $i<5; $i++)
                            <i data-lucide="star" class="w-4 h-4 {{ $i < floor($rating) ? 'fill-current' : 'opacity-30' }}"></i>
                        @endfor
                    </div>
                    <span class="text-[#2c2a29] dark:text-white">{{ $rating }}</span>
                    <span class="text-[#827a72] dark:text-[#9e968d]">({{ $ratingCount }} ulasan)</span>
                    <span class="w-1.5 h-1.5 rounded-full bg-[#e6ddcf] dark:bg-[#4a4540] mx-1"></span>
                    <span class="text-[#8b6a4f] dark:text-[#bea896] bg-[#8b6a4f]/10 dark:bg-[#bea896]/10 px-2.5 py-0.5 rounded-md text-xs uppercase tracking-wide border border-[#8b6a4f]/20">Klasik</span>
                </div>

                {{-- Metadata Grid --}}
                <div class="grid grid-cols-2 lg:grid-cols-3 gap-6 mb-10 py-6 border-y border-[#f0ece5] dark:border-[#33302c]">
                    <div>
                        <p class="text-[10px] font-bold text-[#a39b92] dark:text-[#7d756d] uppercase tracking-widest mb-1">Penerbit</p>
                        <p class="text-sm font-semibold">{{ $publisher }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-[#a39b92] dark:text-[#7d756d] uppercase tracking-widest mb-1">Tahun</p>
                        <p class="text-sm font-semibold">{{ $year }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-[#a39b92] dark:text-[#7d756d] uppercase tracking-widest mb-1">Halaman</p>
                        <p class="text-sm font-semibold">{{ $pages }} hal.</p>
                    </div>
                    <div class="col-span-2 lg:col-span-1">
                        <p class="text-[10px] font-bold text-[#a39b92] dark:text-[#7d756d] uppercase tracking-widest mb-1">Identitas / Seri</p>
                        <p class="text-sm font-semibold">{{ $isbn }}</p>
                    </div>
                    <div class="col-span-2 lg:col-span-2">
                        <p class="text-[10px] font-bold text-[#a39b92] dark:text-[#7d756d] uppercase tracking-widest mb-1">Estimasi Baca</p>
                        <p class="text-sm font-semibold flex items-center gap-2"><i data-lucide="clock" class="w-3.5 h-3.5 text-[#8b6a4f]"></i> {{ $hours }}-{{ $hours + 2 }} jam</p>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex flex-wrap items-center gap-4 mt-auto">
                    <button onclick="openViewer()" class="px-8 py-4 bg-[#2c2a29] dark:bg-[#ece4db] text-[#fcfbfa] dark:text-[#2c2a29] rounded-xl font-bold text-sm shadow-xl hover:shadow-2xl hover:-translate-y-0.5 transition-all flex items-center gap-3">
                        <i data-lucide="play" class="w-4 h-4 fill-current"></i>
                        Baca Sekarang
                    </button>
                    <button id="detail-bookmark-btn" 
                            data-id="{{ $book['id'] }}"
                            data-title="{{ $title }}"
                            data-author="{{ $author }}"
                            data-cover="{{ $cover }}"
                            class="bookmark-btn-{{ $book['id'] }} px-8 py-4 bg-white dark:bg-[#1a1918] border-2 border-[#e6ddcf] dark:border-[#3d3833] text-[#2c2a29] dark:text-[#ece4db] rounded-xl font-bold text-sm hover:bg-[#f4f0eb] dark:hover:bg-[#282522] transition-colors flex items-center gap-2">
                        <i data-lucide="bookmark-plus" class="w-4 h-4"></i>
                        <span class="btn-text">Rak Saya</span>
                    </button>
                    
                    <div class="flex items-center gap-2 ml-auto">
                        <button class="w-12 h-12 flex items-center justify-center rounded-xl bg-white dark:bg-[#1a1918] border border-[#e6ddcf] dark:border-[#3d3833] text-[#827a72] hover:text-[#8b6a4f] transition-colors" title="Simpan">
                            <i data-lucide="heart" class="w-5 h-5"></i>
                        </button>
                        <button class="w-12 h-12 flex items-center justify-center rounded-xl bg-white dark:bg-[#1a1918] border border-[#e6ddcf] dark:border-[#3d3833] text-[#827a72] hover:text-[#8b6a4f] transition-colors" title="Bagikan">
                            <i data-lucide="share-2" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>
            </div>

            {{-- 3. Right (Status Panels) --}}
            <div class="lg:col-span-3 flex flex-col gap-6">
                {{-- Ketersediaan --}}
                <div class="bg-white dark:bg-[#201e1d] rounded-2xl p-6 border border-[#f0ece5] dark:border-[#33302c] shadow-sm">
                    <h3 class="text-xs font-bold text-[#a39b92] dark:text-[#7d756d] uppercase tracking-widest mb-4">Ketersediaan</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 rounded-xl bg-[#f0fdf4] dark:bg-[#f0fdf4]/5 border border-green-200 dark:border-green-900/30">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-green-100 dark:bg-green-900/50 flex items-center justify-center text-green-600 dark:text-green-400">
                                    <i data-lucide="check" class="w-4 h-4"></i>
                                </div>
                                <span class="text-sm font-bold text-green-800 dark:text-green-300">Baca Online</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-xl bg-[#fffbf0] dark:bg-[#fffbf0]/5 border border-amber-200 dark:border-amber-900/30">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-amber-100 dark:bg-amber-900/50 flex items-center justify-center text-amber-600 dark:text-amber-400">
                                    <i data-lucide="headphones" class="w-4 h-4"></i>
                                </div>
                                <span class="text-sm font-bold text-amber-800 dark:text-amber-300">Audiobook</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Statistik --}}
                <div class="bg-white dark:bg-[#201e1d] rounded-2xl p-6 border border-[#f0ece5] dark:border-[#33302c] shadow-sm flex-1">
                    <h3 class="text-xs font-bold text-[#a39b92] dark:text-[#7d756d] uppercase tracking-widest mb-5">Statistik</h3>
                    <div class="space-y-5">
                        <div>
                            <div class="flex justify-between text-sm font-medium mb-1">
                                <span class="text-[#827a72] dark:text-[#9e968d]">Dibaca bulan ini</span>
                                <span class="font-bold text-[#2c2a29] dark:text-[#ece4db]">3.2K</span>
                            </div>
                            <div class="w-full bg-[#f4f0eb] dark:bg-[#33302c] h-1.5 rounded-full overflow-hidden">
                                <div class="bg-[#8b6a4f] w-3/4 h-full rounded-full"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-sm font-medium mb-1">
                                <span class="text-[#827a72] dark:text-[#9e968d]">Di rak pembaca</span>
                                <span class="font-bold text-[#2c2a29] dark:text-[#ece4db]">28.5K</span>
                            </div>
                            <div class="w-full bg-[#f4f0eb] dark:bg-[#33302c] h-1.5 rounded-full overflow-hidden">
                                <div class="bg-[#8b6a4f] w-full h-full rounded-full"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-sm font-medium mb-1">
                                <span class="text-[#827a72] dark:text-[#9e968d]">Tingkat Selesai</span>
                                <span class="font-bold text-green-600 dark:text-green-400">91%</span>
                            </div>
                            <div class="w-full bg-[#f4f0eb] dark:bg-[#33302c] h-1.5 rounded-full overflow-hidden">
                                <div class="bg-green-500 w-[91%] h-full rounded-full"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-14 border-[#f0ece5] dark:border-[#33302c]">

        {{-- Bottom Section --}}
        <div class="grid lg:grid-cols-12 gap-16">
            
            {{-- Left Column (Main Content) --}}
            <div class="lg:col-span-8">
                
                {{-- Tabs --}}
                <div class="flex items-center gap-8 border-b border-[#f0ece5] dark:border-[#33302c] mb-8">
                    <button class="pb-4 text-sm font-bold text-[#2c2a29] dark:text-white border-b-2 border-[#8b6a4f] transition-all">Sinopsis</button>
                    <button class="pb-4 text-sm font-bold text-[#a39b92] dark:text-[#7d756d] hover:text-[#2c2a29] dark:hover:text-[#ece4db] border-b-2 border-transparent transition-all">Ulasan</button>
                    <button class="pb-4 text-sm font-bold text-[#a39b92] dark:text-[#7d756d] hover:text-[#2c2a29] dark:hover:text-[#ece4db] border-b-2 border-transparent transition-all">Detail</button>
                    <button class="pb-4 text-sm font-bold text-[#a39b92] dark:text-[#7d756d] hover:text-[#2c2a29] dark:hover:text-[#ece4db] border-b-2 border-transparent transition-all">Seri Buku</button>
                </div>

                {{-- Synopsis --}}
                <div class="prose prose-zinc dark:prose-invert max-w-none text-[#6b6258] dark:text-[#b5ab9f] leading-loose text-sm mb-12">
                    <p class="mb-4">
                        {{ \Illuminate\Support\Str::words($desc, 80, '...') }}
                    </p>
                    @if(str_word_count($desc) > 80)
                    <button class="text-[#8b6a4f] font-bold text-sm hover:underline flex items-center gap-1">Baca selengkapnya <i data-lucide="arrow-down" class="w-3 h-3"></i></button>
                    @endif
                </div>

                {{-- Reviews --}}
                <div>
                    <h3 class="text-xl font-black mb-8 text-[#2c2a29] dark:text-[#ece4db]">Ulasan pembaca</h3>
                    
                    {{-- Summary --}}
                    <div class="flex items-center gap-10 mb-10 p-6 bg-white dark:bg-[#201e1d] rounded-2xl border border-[#f0ece5] dark:border-[#33302c]">
                        <div class="flex flex-col items-center">
                            <span class="text-5xl font-black text-[#2c2a29] dark:text-white">{{ $rating }}</span>
                            <div class="flex items-center gap-1 text-amber-500 my-2">
                                @for($i=0; $i<5; $i++) <i data-lucide="star" class="w-4 h-4 fill-current"></i> @endfor
                            </div>
                            <span class="text-xs font-semibold text-[#827a72]">{{ $ratingCount }} ulasan</span>
                        </div>
                        <div class="flex-1 flex flex-col gap-2">
                            @foreach([5 => 85, 4 => 10, 3 => 3, 2 => 1, 1 => 1] as $star => $pct)
                            <div class="flex items-center gap-3">
                                <span class="text-xs font-bold w-3 text-[#6b6258] dark:text-[#9e968d]">{{ $star }}</span>
                                <i data-lucide="star" class="w-3 h-3 text-[#a39b92] dark:text-[#7d756d] fill-current"></i>
                                <div class="flex-1 bg-[#f0ece5] dark:bg-[#33302c] h-2 rounded-full overflow-hidden">
                                    <div class="bg-amber-400 h-full rounded-full" style="width: {{ $pct }}%"></div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Mock Review Cards --}}
                    <div class="space-y-6">
                        {{-- Card 1 --}}
                        <div class="pb-6 border-b border-[#f0ece5] dark:border-[#33302c] last:border-0">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-[#e6ddcf] dark:bg-[#3d3833] text-[#8b6a4f] dark:text-[#bea896] flex items-center justify-center font-bold text-sm">SR</div>
                                    <div>
                                        <p class="font-bold text-sm text-[#2c2a29] dark:text-[#ece4db] flex items-center gap-2">
                                            Sari Rahayu 
                                            <span class="px-2 py-0.5 rounded bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 text-[9px] uppercase tracking-wider font-bold">Pembaca Terverifikasi</span>
                                        </p>
                                        <p class="text-[11px] font-medium text-[#827a72]">12 Maret 2025</p>
                                    </div>
                                </div>
                                <div class="flex gap-1 text-amber-500"><i data-lucide="star" class="w-3.5 h-3.5 fill-current"></i><i data-lucide="star" class="w-3.5 h-3.5 fill-current"></i><i data-lucide="star" class="w-3.5 h-3.5 fill-current"></i><i data-lucide="star" class="w-3.5 h-3.5 fill-current"></i><i data-lucide="star" class="w-3.5 h-3.5 fill-current"></i></div>
                            </div>
                            <p class="text-sm text-[#6b6258] dark:text-[#b5ab9f] leading-relaxed mb-4">Karya masterpiece yang wajib dibaca setiap orang Indonesia. Gaya bahasanya memukau dan mampu membawa kita benar-benar hidup di era tersebut.</p>
                            <p class="text-xs font-semibold text-[#827a72] flex items-center gap-3">
                                Apakah ulasan ini membantu? 
                                <button class="hover:text-[#2c2a29] dark:hover:text-white transition-colors">Ya (234)</button> &middot; 
                                <button class="hover:text-[#2c2a29] dark:hover:text-white transition-colors">Tidak (3)</button>
                            </p>
                        </div>

                        {{-- Card 2 --}}
                        <div class="pb-6 border-b border-[#f0ece5] dark:border-[#33302c] last:border-0">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-[#e6ddcf] dark:bg-[#3d3833] text-[#8b6a4f] dark:text-[#bea896] flex items-center justify-center font-bold text-sm">BW</div>
                                    <div>
                                        <p class="font-bold text-sm text-[#2c2a29] dark:text-[#ece4db]">Budi Wicaksono</p>
                                        <p class="text-[11px] font-medium text-[#827a72]">28 Januari 2025</p>
                                    </div>
                                </div>
                                <div class="flex gap-1 text-amber-500"><i data-lucide="star" class="w-3.5 h-3.5 fill-current"></i><i data-lucide="star" class="w-3.5 h-3.5 fill-current"></i><i data-lucide="star" class="w-3.5 h-3.5 fill-current"></i><i data-lucide="star" class="w-3.5 h-3.5 fill-current"></i><i data-lucide="star" class="w-3.5 h-3.5 fill-current"></i></div>
                            </div>
                            <p class="text-sm text-[#6b6258] dark:text-[#b5ab9f] leading-relaxed mb-4">Membaca buku ini seperti menyelami sejarah bangsa. Sarat makna dan karakter Minke sangat berkesan dan inspiratif.</p>
                            <p class="text-xs font-semibold text-[#827a72] flex items-center gap-3">
                                Apakah ulasan ini membantu? 
                                <button class="hover:text-[#2c2a29] dark:hover:text-white transition-colors">Ya (189)</button> &middot; 
                                <button class="hover:text-[#2c2a29] dark:hover:text-white transition-colors">Tidak (1)</button>
                            </p>
                        </div>
                    </div>

                    <button class="w-full mt-6 py-4 rounded-xl border-2 border-[#e6ddcf] dark:border-[#3d3833] text-[#2c2a29] dark:text-[#ece4db] font-bold text-sm hover:bg-[#f4f0eb] dark:hover:bg-[#282522] transition-colors flex items-center justify-center gap-2">
                        Lihat semua {{ $ratingCount }} ulasan <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </button>
                </div>

            </div>

            {{-- Right Column (Sidebar) --}}
            <div class="lg:col-span-4 flex flex-col gap-8">
                
                {{-- BUKU SERUPA --}}
                <div class="bg-white dark:bg-[#201e1d] rounded-3xl p-6 border border-[#f0ece5] dark:border-[#33302c] shadow-sm">
                    <h3 class="text-xs font-bold text-[#a39b92] dark:text-[#7d756d] uppercase tracking-widest mb-6">Buku Serupa</h3>
                    <div class="space-y-4">
                        @forelse($similarBooks as $sim)
                            @php
                                $simInfo = $sim['volumeInfo'] ?? [];
                                $simTitle = $simInfo['title'] ?? 'Tanpa Judul';
                                $simAuthor = $simInfo['authors'][0] ?? 'Anonim';
                                $simRating = $simInfo['averageRating'] ?? 4.8;
                                $simCover = $simInfo['imageLinks']['smallThumbnail'] ?? $simInfo['imageLinks']['thumbnail'] ?? null;
                            @endphp
                            <a href="/book/{{ $sim['id'] }}" class="flex items-center gap-4 group">
                                <div class="w-12 h-16 rounded-lg bg-[#f0ece5] dark:bg-[#282522] flex items-center justify-center text-[#8b6a4f] dark:text-[#bea896] shrink-0 overflow-hidden border border-[#e6ddcf] dark:border-[#3d3833]">
                                    @if($simCover)
                                        <img src="{{ $simCover }}" alt="{{ $simTitle }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    @else
                                        <i data-lucide="book" class="w-5 h-5 opacity-50 group-hover:scale-110 transition-transform"></i>
                                    @endif
                                </div>
                                <div>
                                    <h4 class="font-bold text-sm text-[#2c2a29] dark:text-[#ece4db] group-hover:text-[#8b6a4f] transition-colors line-clamp-1 truncate max-w-[180px]">{{ $simTitle }}</h4>
                                    <p class="text-[11px] font-semibold text-[#827a72] mt-0.5 truncate max-w-[170px]">{{ $simAuthor }}</p>
                                    <div class="flex items-center gap-1 mt-1 text-amber-500">
                                        <i data-lucide="star" class="w-3 h-3 fill-current"></i>
                                        <span class="text-[10px] font-bold text-[#6b6258] dark:text-[#9e968d]">{{ $simRating }}</span>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <p class="text-xs text-zinc-500">Belum ada saran buku serupa.</p>
                        @endforelse
                    </div>
                </div>

                {{-- TENTANG PENULIS --}}
                <div class="bg-white dark:bg-[#201e1d] rounded-3xl p-6 border border-[#f0ece5] dark:border-[#33302c] shadow-sm flex flex-col items-center text-center">
                    <h3 class="text-xs font-bold text-[#a39b92] dark:text-[#7d756d] uppercase tracking-widest mb-5 self-start w-full">Tentang Penulis</h3>
                    
                    <div class="w-20 h-20 rounded-full bg-[#f4f0eb] dark:bg-[#282522] border border-[#e6ddcf] dark:border-[#3d3833] flex items-center justify-center mb-4">
                        <i data-lucide="user-round" class="w-8 h-8 text-[#8b6a4f] dark:text-[#bea896]"></i>
                    </div>
                    <h4 class="font-black text-lg text-[#2c2a29] dark:text-white mb-2">{{ $author }}</h4>
                    <p class="text-xs text-[#6b6258] dark:text-[#b5ab9f] leading-relaxed mb-6">
                        Sastrawan besar Indonesia yang telah melahirkan banyak karya fenomenal bertemakan sejarah, perjuangan, dan kemanusiaan.
                    </p>
                    <button class="w-full py-3 rounded-xl border border-[#8b6a4f] text-[#8b6a4f] dark:border-[#bea896] dark:text-[#bea896] font-bold text-xs hover:bg-[#8b6a4f] hover:text-white dark:hover:bg-[#bea896] dark:hover:text-[#141312] transition-colors">
                        + Ikuti Penulis
                    </button>
                </div>

                {{-- TAG & TEMA --}}
                <div class="bg-white dark:bg-[#201e1d] rounded-3xl p-6 border border-[#f0ece5] dark:border-[#33302c] shadow-sm">
                    <h3 class="text-xs font-bold text-[#a39b92] dark:text-[#7d756d] uppercase tracking-widest mb-4">Tag & Tema</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach(['Kolonialisme', 'Sejarah', 'Cinta', 'Nasionalisme', 'Klasik', 'Jawa', 'Politik', 'Drama'] as $tag)
                            <a href="#" class="px-3 py-1.5 rounded-lg border border-[#e6ddcf] dark:border-[#3d3833] text-[11px] font-bold text-[#6b6258] dark:text-[#b5ab9f] hover:bg-[#f0ece5] dark:hover:bg-[#282522] transition-colors">{{ $tag }}</a>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- Viewer Modal --}}
<div id="viewer-modal" class="fixed inset-0 z-[100] bg-black/90 backdrop-blur-sm hidden flex-col items-center justify-center">
    <div class="w-full max-w-6xl h-[90vh] bg-white dark:bg-[#1a1918] rounded-3xl flex flex-col overflow-hidden relative shadow-2xl border border-white/10">
        <div class="h-16 flex items-center justify-between px-6 border-b border-[#f0ece5] dark:border-[#33302c]">
            <h3 class="font-bold text-[#2c2a29] dark:text-white opacity-80">{{ $title }}</h3>
            <button onclick="closeViewer()" class="w-8 h-8 flex items-center justify-center bg-[#f0ece5] dark:bg-[#33302c] rounded-full text-[#2c2a29] dark:text-white hover:bg-rose-500 hover:text-white transition-colors">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>
        <div class="flex-1 bg-[#f4f0eb] dark:bg-[#282522] p-2">
            <div id="viewerCanvas" class="w-full h-full rounded-2xl bg-white dark:bg-[#1f1d1b]"></div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://www.google.com/books/jsapi.js"></script>
<script type="text/javascript">
    google.books.load();

    function initialize() {
        var viewer = new google.books.DefaultViewer(document.getElementById('viewerCanvas'));
        var bookId = '{{ $book["id"] }}';
        
        viewer.load(bookId, function(success) {
            if (!success) {
                document.getElementById('viewerCanvas').innerHTML = 
                "<div class='flex flex-col items-center justify-center h-full gap-4 text-[#827a72] dark:text-[#5a5550] uppercase text-[10px] font-black tracking-[0.2em]'><i data-lucide='shield-alert' class='w-8 h-8 opacity-40'></i>Akses Terbatas. Pratinjau Tidak Tersedia.</div>";
                if(window.lucide) window.lucide.createIcons();
            }
        });
    }

    google.books.setOnLoadCallback(initialize);

    function openViewer() {
        document.getElementById('viewer-modal').classList.remove('hidden');
        document.getElementById('viewer-modal').classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeViewer() {
        document.getElementById('viewer-modal').classList.add('hidden');
        document.getElementById('viewer-modal').classList.remove('flex');
        document.body.style.overflow = '';
    }

    document.getElementById('detail-bookmark-btn')?.addEventListener('click', async function() {
        const btn = this;
        const id = btn.dataset.id;
        const title = btn.dataset.title;
        const author = btn.dataset.author;
        const cover = btn.dataset.cover;
        const textSpan = btn.querySelector('.btn-text');
        
        if (textSpan) textSpan.innerHTML = "Menyimpan...";
        
        // Use the global function
        await toggleBookmark(id, title, author, cover);

        if (btn.classList.contains('is-bookmarked')) {
            if (textSpan) textSpan.innerHTML = "Tersimpan";
            btn.classList.add('bg-[#f4f0eb]', 'dark:bg-[#282522]');
        } else {
            if (textSpan) textSpan.innerHTML = "Rak Saya";
            btn.classList.remove('bg-[#f4f0eb]', 'dark:bg-[#282522]');
        }
    });

</script>
@endsection
