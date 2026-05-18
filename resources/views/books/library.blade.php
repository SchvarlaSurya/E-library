@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12 md:py-16 flex flex-col lg:flex-row gap-12">
    
    {{-- Left Sidebar --}}
    <aside class="w-full lg:w-72 flex-shrink-0 flex flex-col gap-10 sticky top-24 h-fit">
        
        {{-- Search Title --}}
        <div>
            <h1 class="text-2xl md:text-3xl font-black tracking-tight text-[var(--foreground)] mb-2">Eksplorasi</h1>
            <p class="text-sm font-medium text-zinc-500">Temukan buku favoritmu berikutnya</p>
        </div>

        {{-- Categories --}}
        <div>
            <h3 class="text-xs font-bold text-zinc-400 uppercase tracking-widest mb-4">Kategori</h3>
            <div class="flex flex-col gap-2">
                @php
                    $categories = [
                        ['id' => 'All', 'name' => 'Semua Buku', 'icon' => 'layers'],
                        ['id' => 'Fiksi', 'name' => 'Fiksi', 'icon' => 'book-open'],
                        ['id' => 'Non-Fiksi', 'name' => 'Non-Fiksi', 'icon' => 'compass'],
                        ['id' => 'Sains', 'name' => 'Sains', 'icon' => 'atom'],
                        ['id' => 'Sejarah', 'name' => 'Sejarah', 'icon' => 'globe'],
                        ['id' => 'Teknologi', 'name' => 'Teknologi', 'icon' => 'cpu'],
                    ];
                @endphp
                @foreach($categories as $cat)
                    @php 
                        $isActive = ($category ?? 'All') === $cat['id']; 
                    @endphp
                    <a href="/library?category={{ $cat['id'] }}" class="flex items-center justify-between px-4 py-3 rounded-xl transition-all {{ $isActive ? 'bg-[var(--accent)] text-white shadow-sm hover:scale-[1.02]' : 'bg-transparent hover:bg-black/5 dark:hover:bg-white/5 text-zinc-600 dark:text-zinc-400 hover:text-[var(--foreground)]' }}">
                        <div class="flex items-center gap-3 font-semibold text-sm">
                            <i data-lucide="{{ $cat['icon'] }}" class="w-4 h-4 {{ $isActive ? 'text-white/70' : 'opacity-50' }}"></i>
                            {{ $cat['name'] }}
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </aside>

    {{-- Main Content Window --}}
    <div class="flex-1 flex flex-col gap-8">
        
        {{-- Search Form --}}
        <form action="/library" method="GET" class="w-full relative">
            <div class="relative flex items-center">
                <div class="absolute left-5 text-zinc-400 group-focus-within:text-[var(--accent)] transition-colors pointer-events-none">
                    <i data-lucide="search" class="w-5 h-5"></i>
                </div>
                <input type="text" name="q" value="{{ $query }}" placeholder="Cari judul, penulis, atau kata kunci..." 
                       class="w-full bg-white dark:bg-zinc-900 border border-[var(--card-border)] py-4 pl-14 pr-6 rounded-2xl focus:outline-none focus:border-[var(--accent)] focus:ring-1 focus:ring-[var(--accent)] transition-all text-sm font-medium text-[var(--foreground)] placeholder-zinc-500 shadow-sm hover:shadow-md">
            </div>
        </form>

        @if($query && strtolower($query) !== 'programming' && strtolower($query) !== 'isbn')
            <div class="flex items-center gap-4">
                <span class="text-xs font-bold text-zinc-500 uppercase tracking-widest">Hasil untuk:</span>
                <span class="px-4 py-1.5 rounded-full bg-[var(--accent)]/10 text-[var(--accent)] text-xs font-bold">{{ $query }}</span>
            </div>
        @endif

        {{-- Book Grid --}}
        <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($books as $book)
                @php
                    $info = $book['volumeInfo'] ?? [];
                    $images = $info['imageLinks'] ?? [];
                    $cover = $images['thumbnail'] ?? 'https://via.placeholder.com/300x450/e0e0e0/888888?text=No+Cover';
                @endphp

                <div class="flex flex-col group relative">
                    <div class="w-full aspect-[2/3] bg-white dark:bg-zinc-900 border border-[var(--card-border)] rounded-2xl flex flex-col items-center justify-center shadow-sm group-hover:shadow-md mb-3 transition-all hover:-translate-y-1 relative overflow-hidden">
                        <img src="{{ $cover }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        
                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center gap-3 backdrop-blur-[2px] z-10">
                            <a href="/book/{{ $book['id'] }}" class="bg-white text-black px-6 py-2 rounded-full text-xs font-bold shadow-xl hover:scale-105 transition-transform flex items-center gap-2">Lihat Detail <i data-lucide="arrow-right" class="w-3 h-3"></i></a>
                        </div>

                        <div class="absolute top-3 right-3 z-20">
                            <button onclick="toggleBookmark('{{ $book['id'] }}', '{{ addslashes($info['title'] ?? '') }}', '{{ addslashes($info['authors'][0] ?? '') }}', '{{ $cover }}')" 
                                    class="bookmark-btn-{{ $book['id'] }} w-8 h-8 rounded-full bg-white/20 backdrop-blur-md border border-white/20 flex items-center justify-center text-white hover:bg-[var(--accent)] hover:text-white cursor-pointer transition-all shadow-sm group/libbtn">
                                <i data-lucide="bookmark" class="w-4 h-4 group-hover/libbtn:scale-110 transition-transform"></i>
                            </button>
                        </div>
                    </div>
                    
                    <h3 class="text-[0.95rem] font-bold text-[var(--foreground)] leading-tight mb-1 truncate transition-colors group-hover:text-[var(--accent)]">{{ $info['title'] ?? 'Tanpa Judul' }}</h3>
                    <p class="text-xs font-medium text-zinc-500 mb-2 truncate">{{ $info['authors'][0] ?? 'Penulis Tidak Diketahui' }}</p>
                    
                    <div class="flex items-center gap-1.5 mt-auto text-xs font-bold text-amber-500">
                        @php $rating = $info['averageRating'] ?? rand(4, 5) - (rand(0, 5)/10); @endphp
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                        <span>{{ number_format((float)$rating, 1, '.', '') }}</span>
                    </div>
                </div>
            @empty
                <div class="col-span-full border-dashed border-2 border-[var(--card-border)] bg-zinc-50 dark:bg-zinc-900/40 rounded-3xl p-24 text-center transition-colors">
                    <div class="w-16 h-16 bg-white dark:bg-zinc-800 rounded-full flex items-center justify-center mx-auto mb-6 border border-[var(--card-border)] shadow-sm">
                        <i data-lucide="book-x" class="w-8 h-8 text-zinc-400"></i>
                    </div>
                    <p class="text-sm font-bold text-[var(--foreground)] mb-1">Buku Tidak Ditemukan</p>
                    <p class="text-xs font-medium text-zinc-500">Coba gunakan kata kunci pencarian yang lain.</p>
                </div>
            @endforelse
        </div>
        
        {{-- Pagination Placeholder --}}
        @if(count($books) > 0)
        <div class="flex items-center justify-center mt-12 gap-3">
            <button class="w-10 h-10 rounded-xl bg-white dark:bg-zinc-900 border border-[var(--card-border)] text-zinc-500 hover:text-[var(--foreground)] flex items-center justify-center transition-colors shadow-sm">
                <i data-lucide="chevron-left" class="w-4 h-4"></i>
            </button>
            <div class="flex gap-2">
                <span class="w-10 h-10 rounded-xl bg-[var(--foreground)] text-[var(--background)] flex items-center justify-center text-sm font-bold shadow-md">1</span>
                <span class="w-10 h-10 rounded-xl bg-white dark:bg-zinc-900 border border-[var(--card-border)] text-zinc-500 hover:text-[var(--foreground)] hover:bg-zinc-50 dark:hover:bg-zinc-800 flex items-center justify-center text-sm font-bold transition-colors cursor-pointer shadow-sm">2</span>
                <span class="w-10 h-10 rounded-xl bg-white dark:bg-zinc-900 border border-[var(--card-border)] text-zinc-500 hover:text-[var(--foreground)] hover:bg-zinc-50 dark:hover:bg-zinc-800 flex items-center justify-center text-sm font-bold transition-colors cursor-pointer shadow-sm">3</span>
            </div>
            <button class="w-10 h-10 rounded-xl bg-white dark:bg-zinc-900 border border-[var(--card-border)] text-zinc-500 hover:text-[var(--foreground)] flex items-center justify-center transition-colors shadow-sm">
                <i data-lucide="chevron-right" class="w-4 h-4"></i>
            </button>
        </div>
        @endif
    </div>
</div>

@push('scripts')
@endpush
@endsection
