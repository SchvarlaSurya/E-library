@extends('layouts.app')

@section('content')
<div class="w-full min-h-screen bg-[#fcfaf7] dark:bg-[#151312] pt-12 pb-24 relative overflow-hidden">
    <!-- Stylized Background Blobs -->
    <div class="absolute top-[-100px] left-[-100px] w-[600px] h-[600px] bg-amber-500/5 blur-[120px] rounded-full pointer-events-none"></div>
    <div class="absolute bottom-[-100px] right-[-100px] w-[700px] h-[700px] bg-orange-400/5 blur-[120px] rounded-full pointer-events-none"></div>

    <div class="max-w-6xl mx-auto px-6 relative z-10">
        <!-- Header Section -->
        <div class="text-center max-w-2xl mx-auto mb-16 space-y-4">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 text-xs font-bold uppercase tracking-widest mb-2 border border-amber-200 dark:border-amber-800/50 shadow-sm">
                <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                Upgrade ke Premium
            </div>
            <h1 class="text-4xl md:text-5xl font-black text-[var(--foreground)] tracking-tight">Tingkatkan Pengalaman <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#8b7355] to-[#c99339]">Membaca Anda</span></h1>
            <p class="text-zinc-500 dark:text-zinc-400 text-sm md:text-base font-medium">Buka berbagai fitur eksklusif, hilangkan jejak iklan, dan bangun perpustakaan digital tak terbatas demi mendukung literasi harian Anda.</p>
        </div>

        <!-- Plans Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- Basic Plan -->
            <div class="bg-white dark:bg-[#1a1816] rounded-[2rem] p-8 border border-[var(--card-border)] shadow-sm flex flex-col hover:-translate-y-1 transition-all duration-300">
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-[var(--foreground)] mb-1">Basic</h2>
                    <p class="text-sm font-medium text-zinc-500">Gratis seumur hidup.</p>
                </div>
                <div class="mb-8 flex items-baseline gap-1">
                    <span class="text-4xl font-black text-[var(--foreground)] tracking-tighter">Rp 0</span>
                    <span class="text-sm font-bold text-zinc-400 uppercase tracking-widest">/bln</span>
                </div>
                
                <ul class="flex flex-col gap-4 mb-10 flex-1">
                    <li class="flex items-start gap-3">
                        <i data-lucide="check" class="w-5 h-5 text-emerald-500 shrink-0"></i>
                        <span class="text-sm font-semibold text-zinc-600 dark:text-zinc-400">Akses koleksi perpustakaan dasar</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i data-lucide="check" class="w-5 h-5 text-emerald-500 shrink-0"></i>
                        <span class="text-sm font-semibold text-zinc-600 dark:text-zinc-400">Rak Saya (Limit 10 buku)</span>
                    </li>
                    <li class="flex items-start gap-3 opacity-40">
                        <i data-lucide="x" class="w-5 h-5 text-zinc-400 shrink-0"></i>
                        <span class="text-sm font-medium text-zinc-500 line-through decoration-zinc-300">Bebas dari gangguan iklan</span>
                    </li>
                    <li class="flex items-start gap-3 opacity-40">
                        <i data-lucide="x" class="w-5 h-5 text-zinc-400 shrink-0"></i>
                        <span class="text-sm font-medium text-zinc-500 line-through decoration-zinc-300">Akses Eksklusif Rilisan Baru</span>
                    </li>
                </ul>

                <button onclick="buyPlan('basic')" class="w-full bg-zinc-100 dark:bg-zinc-800 text-[var(--foreground)] font-bold py-3.5 rounded-xl hover:bg-zinc-200 dark:hover:bg-zinc-700 transition-colors">
                    Kembali ke Basic
                </button>
            </div>

            <!-- Standard Plan -->
            <div class="bg-white dark:bg-[#1a1816] rounded-[2rem] p-8 border border-[var(--card-border)] shadow-md flex flex-col hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-amber-100/50 dark:bg-amber-900/10 rounded-bl-full pointer-events-none -mr-10 -mt-10"></div>
                
                <div class="mb-6 relative z-10">
                    <h2 class="text-xl font-bold text-[var(--foreground)] mb-1">Standard</h2>
                    <p class="text-sm font-medium text-zinc-500">Ideal bagi pembaca aktif.</p>
                </div>
                <div class="mb-8 flex items-baseline gap-1 relative z-10">
                    <span class="text-4xl font-black text-[var(--foreground)] tracking-tighter">Rp 29K</span>
                    <span class="text-sm font-bold text-zinc-400 uppercase tracking-widest">/bln</span>
                </div>
                
                <ul class="flex flex-col gap-4 mb-10 flex-1 relative z-10">
                    <li class="flex items-start gap-3">
                        <i data-lucide="check" class="w-5 h-5 text-emerald-500 shrink-0"></i>
                        <span class="text-sm font-semibold text-zinc-600 dark:text-zinc-400">Akses semua koleksi publik</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i data-lucide="check" class="w-5 h-5 text-emerald-500 shrink-0"></i>
                        <span class="text-sm font-semibold text-zinc-600 dark:text-zinc-400">Rak Saya (Limit 100 buku)</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i data-lucide="check" class="w-5 h-5 text-emerald-500 shrink-0"></i>
                        <span class="text-sm font-semibold text-zinc-600 dark:text-zinc-400">Bebas dari gangguan iklan</span>
                    </li>
                    <li class="flex items-start gap-3 opacity-40">
                        <i data-lucide="x" class="w-5 h-5 text-zinc-400 shrink-0"></i>
                        <span class="text-sm font-medium text-zinc-500 line-through decoration-zinc-300">Akses Eksklusif Rilisan Baru</span>
                    </li>
                </ul>

                <button onclick="buyPlan('standard')" class="relative z-10 w-full bg-[var(--foreground)] text-[var(--background)] font-bold py-3.5 rounded-xl hover:scale-[1.02] active:scale-95 transition-transform shadow-lg shadow-black/10">
                    Mulai Standard
                </button>
            </div>

            <!-- PRO Plan -->
            <div class="bg-gradient-to-b from-[#2a2622] to-[#1a1816] rounded-[2rem] p-8 border border-[#3e3832] shadow-2xl shadow-amber-900/20 flex flex-col hover:-translate-y-2 transition-all duration-300 relative overflow-hidden group">
                <!-- Pro decorative -->
                <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 mix-blend-overlay pointer-events-none"></div>
                <!-- Banner -->
                <div class="absolute top-6 -right-10 rotate-45 bg-[#c99339] text-white text-[10px] uppercase font-black tracking-widest py-1.5 w-40 text-center shadow-md">
                    Terpopuler
                </div>

                <div class="mb-6 relative z-10">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-amber-200 to-amber-500 flex items-center justify-center shadow-lg shadow-amber-500/20 mb-4 group-hover:scale-110 transition-transform">
                        <i data-lucide="crown" class="w-5 h-5 text-amber-950 fill-amber-300"></i>
                    </div>
                    <h2 class="text-2xl font-black text-white mb-1 flex items-center gap-2">ReadSpace <span class="bg-[#c99339] text-white px-1.5 py-0.5 rounded text-[10px] uppercase tracking-widest font-black">Pro</span></h2>
                    <p class="text-sm font-medium text-zinc-400">Pengalaman tanpa batas literasi.</p>
                </div>
                <div class="mb-8 flex items-baseline gap-1 relative z-10">
                    <span class="text-4xl font-black text-white tracking-tighter">Rp 89K</span>
                    <span class="text-sm font-bold text-amber-500/70 uppercase tracking-widest">/bln</span>
                </div>
                
                <ul class="flex flex-col gap-4 mb-10 flex-1 relative z-10">
                    <li class="flex items-start gap-3">
                        <div class="bg-[#c99339]/20 p-1 rounded-full shrink-0"><i data-lucide="check" class="w-3 h-3 text-[#c99339]"></i></div>
                        <span class="text-sm font-bold text-zinc-300">Kapasitas Rak tanpa batas</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="bg-[#c99339]/20 p-1 rounded-full shrink-0"><i data-lucide="check" class="w-3 h-3 text-[#c99339]"></i></div>
                        <span class="text-sm font-bold text-zinc-300">Bebas dari semua iklan</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="bg-[#c99339]/20 p-1 rounded-full shrink-0"><i data-lucide="check" class="w-3 h-3 text-[#c99339]"></i></div>
                        <span class="text-sm font-bold text-zinc-300">Buku audio interaktif</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="bg-[#c99339]/20 p-1 rounded-full shrink-0"><i data-lucide="check" class="w-3 h-3 text-[#c99339]"></i></div>
                        <span class="text-sm font-bold text-zinc-300">Akses Eksklusif Rilisan Baru</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="bg-[#c99339]/20 p-1 rounded-full shrink-0"><i data-lucide="check" class="w-3 h-3 text-[#c99339]"></i></div>
                        <span class="text-sm font-bold text-zinc-300">Lencana PRO di profil</span>
                    </li>
                </ul>

                <button onclick="buyPlan('pro')" class="relative z-10 w-full bg-gradient-to-r from-amber-400 to-[#c99339] text-[#1a1816] font-black py-4 rounded-xl hover:scale-[1.03] active:scale-95 transition-transform shadow-xl shadow-amber-500/20 uppercase tracking-wider text-[11px]">
                    Upgrade ke PRO
                </button>
            </div>

        </div>

        <div class="mt-20 flex flex-col items-center justify-center text-center">
            <h3 class="text-lg font-bold text-[var(--foreground)] mb-2">Ada pertanyaan tambahan?</h3>
            <p class="text-sm font-medium text-zinc-500 mb-6">Tim dukungan khusus kami siap membantu para pelanggan 24/7.</p>
            <a href="#" class="inline-flex items-center gap-2 text-sm font-bold text-[#8b7355] hover:text-[#c99339] transition-colors bg-white dark:bg-zinc-900 border border-[var(--card-border)] px-6 py-3 rounded-full hover:shadow-md">
                <i data-lucide="message-square" class="w-4 h-4"></i> Hubungi Dukungan
            </a>
        </div>
    </div>
</div>

<script>
    function buyPlan(plan) {
        // Simulasi pembelian / ganti plan
        localStorage.setItem('dummy_user_plan', plan);
        alert('Berhasil berlangganan paket ' + plan.toUpperCase() + '!');
        window.location.reload();
    }
</script>

@endsection
