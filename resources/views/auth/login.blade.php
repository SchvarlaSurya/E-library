<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Athena — Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=LINE+Seed+JP&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap');
        body { font-family: 'Plus Jakarta Sans', 'LINE Seed JP', sans-serif; }
        .page-enter { animation: fadeIn 0.5s ease-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
    <script crossorigin="anonymous" data-clerk-publishable-key="{{ $clerk_pk }}" src="https://cdn.jsdelivr.net/npm/@clerk/clerk-js@latest/dist/clerk.browser.js"></script>
</head>
<body class="bg-[#f0ece1] text-zinc-900 selection:bg-amber-200">
    <div class="min-h-screen flex items-center justify-center px-6 page-enter relative overflow-hidden">
        <!-- Decorative bg blobs -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-amber-500/10 blur-[100px] rounded-full mix-blend-multiply pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-orange-400/10 blur-[120px] rounded-full mix-blend-multiply pointer-events-none"></div>

        <div class="w-full max-w-[400px] relative z-10 space-y-8 bg-white/70 p-8 sm:p-10 rounded-[2rem] border border-white shadow-2xl backdrop-blur-xl">
            <div class="text-center space-y-2">
                <div class="w-14 h-14 bg-[#8b7355] text-white rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-amber-900/20">
                    <i data-lucide="book-open" class="w-7 h-7"></i>
                </div>
                <h2 class="text-3xl font-black tracking-tight text-zinc-900 mb-2">ReadSpace</h2>
                <p class="text-sm font-medium text-zinc-500">Masuk untuk mengakses perpustakaan Anda.</p>
            </div>

            <div id="note-message" class="hidden text-emerald-700 text-[11px] font-bold tracking-wide bg-emerald-50 p-4 rounded-xl border border-emerald-200 flex items-center gap-2 shadow-sm mb-4">
                <i data-lucide="info" class="w-4 h-4 shrink-0"></i>
                <span>Anda sudah memiliki akun. Silakan masuk.</span>
            </div>

            <div id="login-form-container" class="space-y-5">
                <div id="error-message" class="hidden text-rose-500 text-[11px] font-bold tracking-wide bg-rose-50 p-4 rounded-xl border border-rose-100 flex items-center gap-2 shadow-sm">
                    <i data-lucide="alert-circle" class="w-4 h-4 shrink-0"></i>
                    <span id="error-text">Terjadi kesalahan.</span>
                </div>
                
                <div class="space-y-1.5">
                    <label class="text-[11px] uppercase tracking-widest font-bold text-zinc-500 pl-1">Email Address</label>
                    <input type="email" id="email" required placeholder="name@example.com" 
                        class="w-full bg-white/50 border border-black/5 rounded-2xl px-5 py-3.5 text-sm text-zinc-900 placeholder:text-zinc-400 focus:outline-none focus:border-[#8b7355] focus:ring-1 focus:ring-[#8b7355] transition-all shadow-sm">
                </div>
                
                <div class="space-y-1.5">
                    <div class="flex justify-between items-center pl-1 pr-1">
                        <label class="text-[11px] uppercase tracking-widest font-bold text-zinc-500">Password</label>
                        <a href="#" class="text-[10px] uppercase tracking-wider font-bold text-zinc-400 hover:text-[#8b7355] transition-colors">Lupa?</a>
                    </div>
                    <input type="password" id="password" required placeholder="••••••••" 
                        class="w-full bg-white/50 border border-black/5 rounded-2xl px-5 py-3.5 text-sm text-zinc-900 placeholder:text-zinc-400 focus:outline-none focus:border-[#8b7355] focus:ring-1 focus:ring-[#8b7355] transition-all shadow-sm">
                </div>

                <button id="submit-login" class="w-full bg-[#1a1816] text-[#fdfbf7] py-4 rounded-2xl text-sm font-bold shadow-xl shadow-black/10 hover:scale-[1.02] transition-all mt-4 active:scale-[0.98] flex items-center justify-center gap-2">
                    <span id="btn-text">Masuk</span>
                    <div id="btn-loader" class="hidden w-5 h-5 border-2 border-white/20 border-t-white rounded-full animate-spin"></div>
                </button>
            </div>

            <div class="relative my-8 group">
                <div class="absolute inset-0 flex items-center"><span class="w-full border-t border-black/5"></span></div>
                <div class="relative flex justify-center text-[10px] uppercase tracking-widest">
                    <span class="bg-[#fcfaf7] px-4 font-bold text-zinc-400">Atau lanjutkan dengan</span>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <button type="button" onclick="loginWith('oauth_google')" class="flex items-center justify-center gap-2 py-3.5 bg-white border border-black/5 rounded-2xl hover:bg-zinc-50 hover:border-black/10 transition-all active:scale-95 text-xs font-bold text-zinc-600 shadow-sm">
                    <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-4 h-4" alt="Google">
                    Google
                </button>
                <button type="button" onclick="loginWith('oauth_github')" class="flex items-center justify-center gap-2 py-3.5 bg-white border border-black/5 rounded-2xl hover:bg-zinc-50 hover:border-black/10 transition-all active:scale-95 text-xs font-bold text-zinc-600 shadow-sm">
                    <i data-lucide="github" class="w-4 h-4"></i>
                    Github
                </button>
            </div>

            <p class="text-center text-xs font-medium text-zinc-500 mt-2">
                Belum punya akun? 
                <a href="/register" class="text-[#8b7355] font-bold hover:underline decoration-2 underline-offset-4">Daftar sekarang</a>
            </p>
        </div>
    </div>

<script>
    lucide.createIcons();

    window.addEventListener('load', async function() {
        try {
            if (window.Clerk) {
                await window.Clerk.load();
                
                // Show note message if URL has ?note=sudah-punya-akun
                const urlParams = new URLSearchParams(window.location.search);
                if (urlParams.get('note') === 'sudah-punya-akun') {
                    document.getElementById('note-message').classList.remove('hidden');
                }
            }
        } catch (err) {
            console.error("Clerk Load Error:", err);
        }
    });

    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const submitBtn = document.getElementById('submit-login');
    const errorEl = document.getElementById('error-message');
    const btnText = document.getElementById('btn-text');
    const btnLoader = document.getElementById('btn-loader');

    async function handleLogin() {
        errorEl.classList.add('hidden');
        btnText.classList.add('hidden');
        btnLoader.classList.remove('hidden');
        submitBtn.disabled = true;

        try {
            const signIn = await window.Clerk.client.signIn.create({
                identifier: emailInput.value,
                password: passwordInput.value
            });

            if (signIn.status === 'complete') {
                await window.Clerk.setActive({ session: signIn.createdSessionId });
                window.location.href = '/';
            } else {
                console.log("Mungkin butuh verifikasi lain:", signIn.status);
            }
        } catch (err) {
            console.error("Login Error:", err);
            
            // Check if user is not found
            const clkErrors = err.errors || [];
            const notFound = clkErrors.find(e => e.code === 'form_identifier_not_found');
            
            if (notFound) {
                // Redirect user to register with note
                window.location.href = '/register?note=belum-login';
                return;
            }

            document.getElementById('error-text').innerText = clkErrors.length > 0 ? clkErrors[0].longMessage : "AUTH_ERROR: Authentication failed.";
            errorEl.classList.remove('hidden');
        } finally {
            btnText.classList.remove('hidden');
            btnLoader.classList.add('hidden');
            submitBtn.disabled = false;
        }
    }

    submitBtn.addEventListener('click', handleLogin);
    
    // Enter to submit
    [emailInput, passwordInput].forEach(el => {
        el.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') handleLogin();
        });
    });

    async function loginWith(provider) {
        try {
            await window.Clerk.client.signIn.authenticateWithRedirect({
                strategy: provider,
                redirectUrl: '/sso-callback', 
                redirectUrlComplete: '/'      
            });
        } catch (err) {
            window.Clerk.openSignIn({ strategy: provider });
        }
    }
</script>
</body>
</html>
