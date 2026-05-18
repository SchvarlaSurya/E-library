@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12 md:py-16 flex flex-col gap-10">
    <div>
        <h1 class="text-3xl md:text-5xl font-black tracking-tight text-[var(--foreground)] mb-2">Rak Saya</h1>
        <p class="text-sm font-medium text-zinc-500">Koleksi buku yang telah Anda simpan</p>
    </div>

    <div id="vault-content" class="min-h-[400px]">
        @if(empty($bookmarks) || count($bookmarks) == 0)
            <div class="border-dashed border-2 border-[var(--card-border)] bg-zinc-50 dark:bg-zinc-900/40 rounded-3xl p-24 text-center transition-colors">
                <div class="w-16 h-16 bg-white dark:bg-zinc-800 rounded-full flex items-center justify-center mx-auto mb-6 border border-[var(--card-border)] shadow-sm">
                    <i data-lucide="bookmark-minus" class="w-8 h-8 text-zinc-400"></i>
                </div>
                <p class="text-sm font-bold text-[var(--foreground)] mb-2">Belum ada buku di rak</p>
                <a href="/library" class="inline-flex items-center gap-2 px-6 py-3 bg-[var(--foreground)] text-[var(--background)] rounded-xl text-xs font-bold hover:scale-105 transition-transform shadow-md">
                    <i data-lucide="search" class="w-4 h-4"></i> Cari Buku
                </a>
            </div>
        @else
            <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($bookmarks as $book)
                <div class="flex flex-col group relative">
                    <div class="w-full aspect-[2/3] bg-white dark:bg-zinc-900 border border-[var(--card-border)] rounded-2xl flex flex-col items-center justify-center shadow-sm group-hover:shadow-md mb-3 transition-all hover:-translate-y-1 relative overflow-hidden">
                        <img src="{{ $book->thumbnail }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        
                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center gap-3 backdrop-blur-[2px] z-10">
                            <a href="/book/{{ $book->book_id }}" class="bg-white text-black px-6 py-2 rounded-full text-xs font-bold shadow-xl hover:scale-105 transition-transform flex items-center gap-2">Baca Sekarang <i data-lucide="arrow-right" class="w-3 h-3"></i></a>
                        </div>
                    </div>
                    
                    <h3 class="text-[0.95rem] font-bold text-[var(--foreground)] leading-tight mb-1 truncate transition-colors group-hover:text-[var(--accent)]">{{ $book->title }}</h3>
                    <p class="text-xs font-medium text-zinc-500 mb-2 truncate">{{ $book->author ?? 'Penulis Tidak Diketahui' }}</p>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    window.addEventListener('load', () => {
        const checkClerk = setInterval(() => {
            if (window.Clerk && window.Clerk.isReady) {
                clearInterval(checkClerk);
                const urlParams = new URLSearchParams(window.location.search);
                if (!urlParams.has('user_id')) {
                    if (window.Clerk.user) {
                        window.location.replace(`/borrowed?user_id=${window.Clerk.user.id}`);
                    } else {
                        window.location.href = '/login';
                    }
                }
            } else if (window.Clerk && window.Clerk.loaded) {
                // Some versions use .loaded instead of .isReady
                clearInterval(checkClerk);
                const urlParams = new URLSearchParams(window.location.search);
                if (!urlParams.has('user_id')) {
                    if (window.Clerk.user) {
                        window.location.replace(`/borrowed?user_id=${window.Clerk.user.id}`);
                    } else {
                        window.location.href = '/login';
                    }
                }
            }
        }, 100);
        
        // Failsafe timeout
        setTimeout(() => clearInterval(checkClerk), 5000);
    });
</script>
@endpush
@endsection
