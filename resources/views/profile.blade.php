@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-12 mt-10">
    <div class="bg-white dark:bg-[#1a1816] rounded-[2rem] border border-[var(--card-border)] shadow-xl overflow-hidden">
        
        <!-- Headers/Cover -->
        <div class="h-40 bg-gradient-to-r from-[#d2b48c] to-[#a68a64] relative">
            <div class="absolute -bottom-12 left-10">
                <div class="w-28 h-28 rounded-full bg-white dark:bg-[#1a1816] p-1.5 shadow-lg">
                    <div class="w-full h-full rounded-full bg-[#8b7355] text-white flex items-center justify-center font-bold text-4xl" id="profile-avatar">AR</div>
                </div>
            </div>
            <a href="/upgrade" class="absolute top-4 right-4 bg-white/20 backdrop-blur-sm px-4 py-1.5 rounded-full text-white hover:bg-white/30 transition-colors font-semibold text-sm border border-white/30 flex items-center gap-2 cursor-pointer shadow-sm">
                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                ReadSpace Pro
            </a>
        </div>

        <!-- Profile Details -->
        <div class="pt-16 pb-10 px-10">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-3xl font-bold text-[var(--foreground)]" id="profile-name">Memuat Profil...</h1>
                    <p class="text-zinc-500 mt-1" id="profile-email">---</p>
                </div>
                <button class="px-5 py-2.5 rounded-xl bg-[var(--background)] hover:bg-zinc-100 transition-colors font-medium border border-[var(--card-border)] text-[var(--foreground)] text-sm flex items-center gap-2">
                    <i data-lucide="edit-3" class="w-4 h-4"></i> Edit Profil
                </button>
            </div>

            <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-6 rounded-2xl bg-[var(--background)] border border-[var(--card-border)] flex flex-col gap-2">
                    <span class="text-zinc-500 font-semibold text-sm uppercase tracking-wider">Total Dibaca</span>
                    <span class="text-4xl font-bold text-[var(--foreground)]" id="profile-dibaca-count">-</span>
                </div>
                <div class="p-6 rounded-2xl bg-[var(--background)] border border-[var(--card-border)] flex flex-col gap-2">
                    <span class="text-zinc-500 font-semibold text-sm uppercase tracking-wider">Disimpan di Rak</span>
                    <span class="text-4xl font-bold text-[var(--foreground)]" id="profile-rak-count">-</span>
                </div>
                <div class="p-6 rounded-2xl bg-[var(--background)] border border-[var(--card-border)] flex flex-col gap-2">
                    <span class="text-zinc-500 font-semibold text-sm uppercase tracking-wider">Waktu Membaca</span>
                    <span class="text-4xl font-bold text-[var(--foreground)]" id="profile-jam-count">-</span>
                </div>
            </div>

            <!-- Other Settings Menu -->
            <div class="mt-12">
                <h3 class="text-xl font-bold text-[var(--foreground)] mb-6">Pengaturan Akun</h3>
                
                <div class="flex flex-col gap-2">
                    <a href="#" class="flex items-center justify-between p-4 rounded-xl hover:bg-[var(--background)] hover:border-[var(--card-border)] border border-transparent transition-colors group relative overflow-hidden">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center shrink-0">
                                <i data-lucide="shield" class="w-5 h-5 text-zinc-600 dark:text-zinc-400"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-semibold text-[var(--foreground)]">Kemananan & Sandi</span>
                                <span class="text-sm text-zinc-500">Perbarui kata sandi dan pengaturan autentikasi ganda</span>
                            </div>
                        </div>
                        <i data-lucide="chevron-right" class="w-5 h-5 text-zinc-400 group-hover:text-[var(--accent)] transition-colors"></i>
                    </a>

                    <a href="#" class="flex items-center justify-between p-4 rounded-xl hover:bg-[var(--background)] hover:border-[var(--card-border)] border border-transparent transition-colors group relative overflow-hidden">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center shrink-0">
                                <i data-lucide="bell" class="w-5 h-5 text-zinc-600 dark:text-zinc-400"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-semibold text-[var(--foreground)]">Preferensi Notifikasi</span>
                                <span class="text-sm text-zinc-500">Atur apa yang ingin Anda terima di email atau aplikasi</span>
                            </div>
                        </div>
                        <i data-lucide="chevron-right" class="w-5 h-5 text-zinc-400 group-hover:text-[var(--accent)] transition-colors"></i>
                    </a>

                    <a href="#" class="flex items-center justify-between p-4 rounded-xl hover:bg-zinc-50 dark:hover:bg-zinc-900 border border-transparent hover:border-red-100 dark:hover:border-red-900/40 transition-colors group mt-4">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center shrink-0 text-red-600">
                                <i data-lucide="trash-2" class="w-5 h-5"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-semibold text-red-600">Hapus Akun</span>
                                <span class="text-sm text-red-500 opacity-80">Tindakan ini tidak dapat dibatalkan.</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    window.addEventListener('load', async function() {
        if (!window.Clerk) return;
        
        const user = window.Clerk.user;

        if (user) {
            const firstName = user.firstName || user.fullName?.split(' ')[0] || 'A';
            document.getElementById('profile-name').innerText = user.fullName || 'User';
            document.getElementById('profile-avatar').innerText = firstName.substring(0, 2).toUpperCase();
            
            if (user.primaryEmailAddress) {
                document.getElementById('profile-email').innerText = user.primaryEmailAddress.emailAddress;
            }

            fetch('/bookmarks/count?user_id=' + user.id)
                .then(res => res.json())
                .then(data => {
                    if (data.count !== undefined) {
                        document.getElementById('profile-rak-count').innerHTML = `${data.count} <span class="text-base font-medium text-zinc-400">buku</span>`;
                        document.getElementById('profile-dibaca-count').innerHTML = `${data.dibaca} <span class="text-base font-medium text-zinc-400">buku</span>`;
                        document.getElementById('profile-jam-count').innerHTML = `${data.jam} <span class="text-base font-medium text-zinc-400">Jam</span>`;
                    }
                });
        }
    });
</script>
@endpush
