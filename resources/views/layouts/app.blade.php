<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReadSpace</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://unpkg.com/lucide@latest"></script>
    <script async crossorigin="anonymous" data-clerk-publishable-key="{{ $clerk_pk }}" src="https://cdn.jsdelivr.net/npm/@clerk/clerk-js@latest/dist/clerk.browser.js"></script>

    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }

        function toggleDarkMode() {
            const html = document.documentElement;
            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.theme = 'light';
            } else {
                html.classList.add('dark');
                localStorage.theme = 'dark';
            }
        }
    </script>
    @stack('css')
</head>

<body class="bg-[var(--background)] text-[var(--foreground)] overflow-x-hidden transition-colors duration-300 antialiased font-sans">
    
    {{-- Top Header Section --}}
    <header class="w-full bg-white dark:bg-[#1a1816] border-b border-[var(--card-border)] sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            
            <div class="flex items-center gap-2 md:gap-3">
                {{-- Hamburger Menu (Mobile) --}}
                <div id="mobile-menu-container" class="md:hidden relative">
                    <button onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" class="p-2 -ml-2 rounded-xl hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors text-zinc-600 dark:text-zinc-300">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                    {{-- Dropdown Panel --}}
                    <div id="mobile-menu" class="absolute left-0 mt-3 w-[240px] bg-white dark:bg-[#1a1816] rounded-2xl border border-[var(--card-border)] shadow-xl hidden z-50 p-2 flex flex-col gap-1">
                        <a href="/" class="flex items-center px-4 py-3 rounded-xl text-[15px] font-semibold text-[var(--foreground)] hover:bg-zinc-50 dark:hover:bg-zinc-800/70 transition-colors">Beranda</a>
                        <a href="/library" class="flex items-center px-4 py-3 rounded-xl text-[15px] font-semibold text-[var(--foreground)] hover:bg-zinc-50 dark:hover:bg-zinc-800/70 transition-colors">Koleksi</a>
                        <a href="/borrowed" class="flex items-center px-4 py-3 rounded-xl text-[15px] font-semibold text-[var(--foreground)] hover:bg-zinc-50 dark:hover:bg-zinc-800/70 transition-colors">Rak Saya</a>
                        <a href="#" class="flex items-center px-4 py-3 rounded-xl text-[15px] font-semibold text-[var(--foreground)] hover:bg-zinc-50 dark:hover:bg-zinc-800/70 transition-colors">Catatan</a>
                        <a href="#" class="flex items-center px-4 py-3 rounded-xl text-[15px] font-semibold text-[var(--foreground)] hover:bg-zinc-50 dark:hover:bg-zinc-800/70 transition-colors">Jelajahi</a>
                    </div>
                </div>

                {{-- Logo --}}
                <a href="/" class="flex items-center gap-3 group">
                    <div class="w-8 h-8 rounded-lg bg-[var(--accent)] flex items-center justify-center shadow-sm group-hover:scale-105 transition-transform">
                        <i data-lucide="book" class="w-5 h-5 text-white"></i>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-[var(--foreground)] mt-0.5">ReadSpace</span>
                </a>
            </div>

            {{-- Centered Navigation Links --}}
            <nav class="hidden md:flex items-center gap-8 h-full">
                <a href="/" class="relative h-full flex items-center text-sm font-semibold {{ Request::is('/') ? 'text-[var(--accent)]' : 'text-zinc-500 hover:text-[var(--foreground)]' }} transition-colors">
                    Beranda
                    @if(Request::is('/'))
                        <div class="absolute bottom-0 left-0 w-full h-[4px] bg-[var(--accent)] rounded-t-full"></div>
                    @endif
                </a>
                <a href="/library" class="relative h-full flex items-center text-sm font-semibold {{ Request::is('library') ? 'text-[var(--accent)]' : 'text-zinc-500 hover:text-[var(--foreground)]' }} transition-colors">
                    Koleksi
                    @if(Request::is('library'))
                        <div class="absolute bottom-0 left-0 w-full h-[4px] bg-[var(--accent)] rounded-t-full"></div>
                    @endif
                </a>
                <a href="/borrowed" class="relative h-full flex items-center text-sm font-semibold {{ Request::is('borrowed') ? 'text-[var(--accent)]' : 'text-zinc-500 hover:text-[var(--foreground)]' }} transition-colors">
                    Rak Saya
                    @if(Request::is('borrowed'))
                        <div class="absolute bottom-0 left-0 w-full h-[4px] bg-[var(--accent)] rounded-t-full"></div>
                    @endif
                </a>
                <a href="#" class="relative h-full flex items-center text-sm font-semibold text-zinc-500 hover:text-[var(--foreground)] transition-colors">
                    Catatan
                </a>
                <a href="#" class="relative h-full flex items-center text-sm font-semibold text-zinc-500 hover:text-[var(--foreground)] transition-colors">
                    Jelajahi
                </a>
            </nav>

            {{-- Right Section: Search & User --}}
            <div class="flex items-center gap-3 lg:gap-6">
                <form action="/library" method="GET" class="hidden lg:flex items-center bg-[var(--background)] rounded-full px-4 py-2 border border-[var(--card-border)] focus-within:ring-2 focus-within:ring-[var(--accent)]/20 transition-all">
                    <i data-lucide="search" class="w-4 h-4 text-zinc-400"></i>
                    <input type="text" name="q" placeholder="Cari buku..." class="bg-transparent border-none focus:outline-none focus:ring-0 text-sm ml-2 w-48 placeholder:text-zinc-400 text-[var(--foreground)] font-medium">
                </form>

                <div class="flex items-center gap-2 lg:gap-4">
                    <button onclick="toggleDarkMode()" class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-[var(--background)] transition-colors">
                        <i data-lucide="moon" class="w-4 h-4 dark:hidden text-zinc-600"></i>
                        <i data-lucide="sun" class="w-4 h-4 hidden dark:block text-yellow-500"></i>
                    </button>

                    {{-- Notification Dropdown --}}
                    <div class="relative hidden sm:block" id="notification-container">
                        <button onclick="document.getElementById('notification-dropdown').classList.toggle('hidden'); document.getElementById('account-dropdown')?.classList.add('hidden')" class="relative w-10 h-10 flex items-center justify-center rounded-full hover:bg-zinc-100 dark:hover:bg-[#252320] transition-colors border border-transparent shadow-sm">
                            <i data-lucide="bell" class="w-5 h-5 text-zinc-600 dark:text-zinc-300"></i>
                            <span id="notif-dot" class="absolute top-[8px] right-[10px] w-2 h-2 bg-orange-500 rounded-full border border-white dark:border-[#1a1816]"></span>
                        </button>
                        
                        <div id="notification-dropdown" class="absolute right-0 mt-3 w-[340px] bg-white dark:bg-[#1a1816] rounded-2xl border border-[var(--card-border)] shadow-xl hidden z-50 overflow-hidden">
                            <div class="px-5 py-4 border-b border-[var(--card-border)] text-base font-bold text-[var(--foreground)]">Notifikasi</div>
                            <div class="max-h-[360px] overflow-y-auto p-2 flex flex-col gap-1" id="notification-list">
                                <!-- Dynamic notifications will be populated here -->
                            </div>
                        </div>
                    </div>

                    {{-- Original Clerk User Button --}}
                    <div id="user-button" class="hidden"></div>

                    {{-- Auth Links (Logged Out) --}}
                    <div id="auth-links" class="hidden items-center gap-2">
                        <a href="/login" class="text-sm font-bold text-zinc-600 dark:text-zinc-400 hover:text-[var(--foreground)] px-4 py-2 transition-colors">Masuk</a>
                        <a href="/register" class="text-sm font-bold bg-[var(--foreground)] text-[var(--background)] px-5 py-2 rounded-xl hover:scale-105 transition-transform shadow-sm">Daftar</a>
                    </div>
                    
                    {{-- Account Mockup Dropdown --}}
                    <div id="mock-account-dropdown-widget" class="relative hidden">
                        <button onclick="document.getElementById('account-dropdown').classList.toggle('hidden'); document.getElementById('notification-dropdown')?.classList.add('hidden')" class="flex items-center gap-2 p-1.5 pr-2 rounded-full hover:bg-zinc-100 dark:hover:bg-[#252320] transition-colors border border-transparent hover:border-[var(--card-border)] group">
                            <div class="relative shrink-0">
                                <div class="w-8 h-8 rounded-full bg-[#8b7355] text-white flex items-center justify-center font-bold text-xs tracking-wider" id="clerk-user-avatar">AR</div>
                                <div id="small-crown-badge" class="hidden absolute -top-1 -right-1 w-3.5 h-3.5 rounded-full flex items-center justify-center shadow-sm border border-white dark:border-[#1a1816]">
                                    <i data-lucide="crown" class="w-2 h-2 text-white fill-current"></i>
                                </div>
                            </div>
                            <span id="clerk-user-name" class="hidden md:block text-sm font-semibold text-[var(--foreground)] tracking-tight">Andi Rizky</span>
                            <i data-lucide="chevron-down" class="hidden md:block w-4 h-4 text-zinc-500 group-hover:text-zinc-700 dark:group-hover:text-zinc-300"></i>
                        </button>

                        <div id="account-dropdown" class="absolute right-0 mt-3 w-[340px] bg-white dark:bg-[#1a1816] rounded-[24px] border border-[var(--card-border)] shadow-xl hidden z-50 overflow-hidden">
                            {{-- Profile Header --}}
                            <div class="flex items-center gap-4 p-5">
                                <div class="relative shrink-0">
                                    <div class="w-14 h-14 rounded-full bg-[#8b7355] text-white flex items-center justify-center font-bold text-xl" id="clerk-user-avatar-large">AR</div>
                                    <div id="large-crown-badge" class="hidden absolute -bottom-0.5 -right-0.5 w-5 h-5 rounded-full flex items-center justify-center shadow-sm border-2 border-white dark:border-[#1a1816]">
                                        <i data-lucide="crown" class="w-3 h-3 text-white fill-current"></i>
                                    </div>
                                </div>
                                <div class="flex flex-col overflow-hidden">
                                    <span class="font-bold text-[var(--foreground)] text-[16px] truncate" id="clerk-user-fullname">Andi Rizky</span>
                                    <span class="text-sm text-zinc-500 truncate" id="clerk-user-email">andi.rizky@email.com</span>
                                    <a href="/upgrade" id="pro-header-link" class="hidden relative z-50 inline-flex items-center gap-1.5 mt-1.5 bg-amber-50 dark:bg-amber-900/20 text-[#c99339] hover:bg-amber-100 hover:text-amber-700 transition-colors px-2.5 py-1 rounded-full text-xs font-bold border border-amber-200 dark:border-amber-900 w-fit cursor-pointer">
                                        <i data-lucide="star" class="w-3 h-3 fill-current"></i>
                                        ReadSpace <span id="current-plan-display">Pro</span>
                                    </a>
                                </div>
                            </div>

                            {{-- Stats Grid --}}
                            <div class="grid grid-cols-3 border-y border-[var(--card-border)] py-3 bg-[var(--background)]">
                                <div class="flex flex-col items-center justify-center relative">
                                    <span class="font-bold text-[19px] text-[var(--foreground)]" id="dibaca-count">0</span>
                                    <span class="text-[11px] font-semibold text-zinc-500 uppercase tracking-widest mt-0.5">Dibaca</span>
                                    <div class="absolute right-0 top-[25%] h-[50%] w-[1px] bg-[var(--card-border)]"></div>
                                </div>
                                <div class="flex flex-col items-center justify-center relative">
                                    <span class="font-bold text-[19px] text-[var(--foreground)]" id="rak-count-1">0</span>
                                    <span class="text-[11px] font-semibold text-zinc-500 uppercase tracking-widest mt-0.5">Di rak</span>
                                    <div class="absolute right-0 top-[25%] h-[50%] w-[1px] bg-[var(--card-border)]"></div>
                                </div>
                                <div class="flex flex-col items-center justify-center">
                                    <span class="font-bold text-[19px] text-[var(--foreground)]" id="jam-count">0</span>
                                    <span class="text-[11px] font-semibold text-zinc-500 uppercase tracking-widest mt-0.5">Jam</span>
                                </div>
                            </div>

                            {{-- Menu List --}}
                            <div class="p-2 flex flex-col gap-0.5">
                                <a href="/profile" class="flex items-center px-4 py-3 rounded-xl hover:bg-zinc-50 dark:hover:bg-[#262422] transition-colors text-[15px] font-medium text-[var(--foreground)] group/item">
                                    <i data-lucide="user" class="w-4 h-4 mr-3 text-zinc-400 group-hover/item:text-[#8b7355] transition-colors"></i>
                                    Profil saya
                                </a>
                                <a href="/borrowed" class="flex items-center px-4 py-3 rounded-xl hover:bg-zinc-50 dark:hover:bg-[#262422] transition-colors text-[15px] font-medium text-[var(--foreground)] group/item flex-1">
                                    <i data-lucide="bookmark" class="w-4 h-4 mr-3 text-zinc-400 group-hover/item:text-[#8b7355] transition-colors"></i>
                                    Rak saya
                                    <span class="ml-auto text-[13px] font-semibold text-zinc-500" id="rak-count-2">0 buku</span>
                                </a>
                                <a href="#" class="flex items-center px-4 py-3 rounded-xl hover:bg-zinc-50 dark:hover:bg-[#262422] transition-colors text-[15px] font-medium text-[var(--foreground)] group/item">
                                    <i data-lucide="bar-chart-2" class="w-4 h-4 mr-3 text-zinc-400 group-hover/item:text-[#8b7355] transition-colors"></i>
                                    Statistik membaca
                                </a>
                                <a href="#" class="flex items-center px-4 py-3 rounded-xl hover:bg-zinc-50 dark:hover:bg-[#262422] transition-colors text-[15px] font-medium text-[var(--foreground)] group/item">
                                    <i data-lucide="settings" class="w-4 h-4 mr-3 text-zinc-400 group-hover/item:text-[#8b7355] transition-colors"></i>
                                    Pengaturan
                                </a>
                                <a href="/upgrade" id="pro-menu-item" class="flex items-center px-4 py-3 rounded-xl hover:bg-zinc-50 dark:hover:bg-[#262422] transition-colors text-[15px] font-medium text-[var(--foreground)] group/item flex-1">
                                    <i data-lucide="crown" class="w-4 h-4 mr-3 text-zinc-400 group-hover/item:text-[#8b7355] transition-colors"></i>
                                    <span id="buy-plan-text">Upgrade ke Pro</span>
                                    <span id="pro-menu-status" class="hidden ml-auto text-[11px] font-bold tracking-wider uppercase text-emerald-700 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-900/30 px-2 py-0.5 rounded-full border border-emerald-100 dark:border-emerald-800">Aktif</span>
                                </a>
                                
                                <div class="h-[1px] bg-[var(--card-border)] my-1"></div>
                                
                                <a href="#" onclick="window.Clerk.signOut()" class="flex items-center px-4 py-3 rounded-xl hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors text-[15px] font-medium text-[#b2524d]">
                                    <i data-lucide="log-out" class="w-4 h-4 mr-3 opacity-90"></i>
                                    Keluar dari akun
                                </a>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </header>

    {{-- Main Content Space --}}
    <main class="w-full min-h-screen"> 
        @yield('content')
    </main>

    <footer class="bg-white dark:bg-[#1a1816] border-t border-[var(--card-border)] py-12 mt-20">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-6 text-sm text-zinc-500 dark:text-zinc-400">
            <div class="flex items-center gap-3">
                <i data-lucide="book" class="w-5 h-5 text-[var(--accent)]"></i>
                <span class="font-bold text-[var(--foreground)]">ReadSpace</span>
                <span>&copy; {{ date('Y') }}. Hak Cipta Dilindungi.</span>
            </div>
            <div class="flex gap-6 font-medium">
                <a href="#" class="hover:text-[var(--accent)] transition-colors">Ketentuan</a>
                <a href="#" class="hover:text-[var(--accent)] transition-colors">Privasi</a>
                <a href="#" class="hover:text-[var(--accent)] transition-colors">Bantuan</a>
            </div>
        </div>
    </footer>

    <script>
        lucide.createIcons();
        window.addEventListener('load', async function() {
            try {
                await window.Clerk.load();
                if (window.Clerk.user) {
                    if (window.location.pathname === '/register' || window.location.pathname === '/login') {
                        window.location.href = '/';
                        return;
                    }
                    document.getElementById('auth-links')?.classList.add('hidden');
                    document.getElementById('auth-links')?.classList.remove('flex');
                    
                    const mockWidget = document.getElementById('mock-account-dropdown-widget');
                    if (mockWidget) {
                        mockWidget.classList.remove('hidden');
                        mockWidget.classList.add('block');
                        
                        const user = window.Clerk.user;
                        const firstName = user.firstName || user.fullName?.split(' ')[0] || 'User';
                        const initials = firstName.substring(0, 2).toUpperCase();
                        
                        document.getElementById('clerk-user-name').innerText = firstName;
                        document.getElementById('clerk-user-fullname').innerText = user.fullName;
                        document.getElementById('clerk-user-avatar').innerText = initials;
                        document.getElementById('clerk-user-avatar-large').innerText = initials;
                        
                        if (user.primaryEmailAddress) {
                            document.getElementById('clerk-user-email').innerText = user.primaryEmailAddress.emailAddress;
                        }

                        // Dummy Plan Logic
                        const userPlan = localStorage.getItem('dummy_user_plan') || 'basic';
                        
                        const smallCrown = document.getElementById('small-crown-badge');
                        const largeCrown = document.getElementById('large-crown-badge');

                        if (userPlan !== 'basic') {
                            if (userPlan === 'pro') {
                                if (smallCrown) {
                                    smallCrown.classList.remove('hidden');
                                    smallCrown.className += ' bg-gradient-to-tr from-amber-400 to-amber-600';
                                }
                                if (largeCrown) {
                                    largeCrown.classList.remove('hidden');
                                    largeCrown.className += ' bg-gradient-to-tr from-amber-400 to-amber-600';
                                }
                            } else if (userPlan === 'standard') {
                                if (smallCrown) {
                                    smallCrown.classList.remove('hidden');
                                    smallCrown.className += ' bg-gradient-to-tr from-zinc-300 to-zinc-500';
                                }
                                if (largeCrown) {
                                    largeCrown.classList.remove('hidden');
                                    largeCrown.className += ' bg-gradient-to-tr from-zinc-300 to-zinc-500';
                                }
                            }
                            
                            document.getElementById('pro-header-link')?.classList.remove('hidden');
                            document.getElementById('pro-header-link')?.classList.add('inline-flex');
                            
                            const displaySpan = document.getElementById('current-plan-display');
                            if (displaySpan) {
                                displaySpan.innerText = userPlan === 'pro' ? 'Pro' : 'Standard';
                            }
                            
                            const buyText = document.getElementById('buy-plan-text');
                            if (buyText) {
                                buyText.innerText = 'Langganan ' + (userPlan === 'pro' ? 'Pro' : 'Standard');
                            }
                            
                            document.getElementById('pro-menu-status')?.classList.remove('hidden');
                        }

                        // Fetch dynamic Rak saya count
                        fetch('/bookmarks/count?user_id=' + user.id)
                            .then(res => res.json())
                            .then(data => {
                                if(data.count !== undefined) {
                                    const rakCount1 = document.getElementById('rak-count-1');
                                    const rakCount2 = document.getElementById('rak-count-2');
                                    const dibacaCount = document.getElementById('dibaca-count');
                                    const jamCount = document.getElementById('jam-count');
                                    
                                    if(rakCount1) rakCount1.innerText = data.count;
                                    if(rakCount2) rakCount2.innerText = data.count + ' buku';
                                    if(dibacaCount) dibacaCount.innerText = data.dibaca;
                                    if(jamCount) jamCount.innerText = data.jam;
                                }
                            }).catch(console.error);

                        // Notifications Setup
                        const notifications = []; // Real implementation would query DB
                        const notifDot = document.getElementById('notif-dot');
                        const notifList = document.getElementById('notification-list');
                        
                        if (notifications.length === 0) {
                            if(notifDot) notifDot.classList.add('hidden');
                            if(notifList) notifList.innerHTML = '<div class="p-8 text-center text-zinc-500 font-medium text-[15px] flex flex-col items-center justify-center gap-3"><i data-lucide="bell-off" class="w-8 h-8 text-zinc-300"></i>Belum ada notifikasi baru</div>';
                            lucide.createIcons();
                        } else {
                            if(notifDot) notifDot.classList.remove('hidden');
                            // Render template string map
                        }

                    } else {
                        // Fallback if custom UI is removed
                        window.Clerk.mountUserButton(document.getElementById('user-button'), { 
                            afterSignOutUrl: '/login'
                        });
                    }
                } else {
                    const authLinks = document.getElementById('auth-links');
                    if (authLinks) {
                        authLinks.classList.remove('hidden');
                        authLinks.classList.add('flex');
                    }
                    const mockWidget = document.getElementById('mock-account-dropdown-widget');
                    if (mockWidget) mockWidget.classList.add('hidden');
                }
            } catch (err) { console.error(err); }
        });
        
        // Handle click outside to close dropdowns
        document.addEventListener('click', function(e) {
            if (!document.getElementById('mock-account-dropdown-widget')?.contains(e.target)) {
                document.getElementById('account-dropdown')?.classList.add('hidden');
            }
            if (!document.getElementById('notification-container')?.contains(e.target)) {
                document.getElementById('notification-dropdown')?.classList.add('hidden');
            }
            if (!document.getElementById('mobile-menu-container')?.contains(e.target)) {
                document.getElementById('mobile-menu')?.classList.add('hidden');
            }
        });

        async function toggleBookmark(id, title, author, thumbnail, btnElement = null) {
            if (!window.Clerk || !window.Clerk.user) {
                window.location.href = '/login';
                return;
            }

            const btn = btnElement || document.querySelector(`.bookmark-btn-${id}`);
            if (!btn) return;
            const icon = btn.querySelector('i');

            try {
                const res = await fetch('/bookmarks/toggle', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        book_id: id,
                        user_id: window.Clerk.user.id,
                        title: title || 'Tanpa Judul',
                        author: author || 'Penulis Tidak Diketahui',
                        thumbnail: thumbnail || ''
                    })
                });

                const data = await res.json();
                if (data.status === 'added') {
                    btn.classList.add('is-bookmarked');
                    btn.classList.replace('text-zinc-500', 'text-[var(--accent)]');
                    btn.classList.replace('text-white', 'text-[var(--accent)]');
                    if (icon) icon.classList.add('fill-current');
                } else {
                    btn.classList.remove('is-bookmarked');
                    btn.classList.replace('text-[var(--accent)]', 'text-zinc-500');
                    if (btn.classList.contains('bg-white/20')) {
                        btn.classList.replace('text-[var(--accent)]', 'text-white');
                    }
                    if (icon) icon.classList.remove('fill-current');
                }
            } catch (err) {
                console.error(err);
                alert("Gagal menghubungi server. Silakan coba lagi.");
            }
        }
        
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.global-bookmark-btn');
            if (btn) {
                e.preventDefault();
                toggleBookmark(
                    btn.dataset.id,
                    btn.dataset.title,
                    btn.dataset.author,
                    btn.dataset.thumbnail,
                    btn
                );
            }
        });
    </script>
    @stack('scripts')
</body>
</html>