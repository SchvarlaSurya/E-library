@extends('layouts.app')

@section('content')
@push('css')
<style>
    .zero-g {
        transition: all 0.4s cubic-bezier(0.19, 1, 0.22, 1);
        will-change: transform, opacity;
    }
    .zero-g:hover {
        transform: translate3d(0, -6px, 0) scale(1.01);
        opacity: 0.95;
    }
    .zero-g:active {
        transform: scale(0.985);
    }
    @keyframes admin-float {
        0%, 100% { transform: translate3d(0, 0, 0); }
        50% { transform: translate3d(0, -3px, 0); }
    }
    .floating-registry:hover {
        animation: admin-float 3s ease-in-out infinite;
    }
</style>
@endpush

<div class="max-w-7xl mx-auto px-6 md:px-12 py-24">
    
    <div class="mb-16 flex flex-col md:flex-row md:items-end justify-between gap-8">
        <div class="antigrav-float" style="--dur: 8s; --del: 0s; --tx: 3px; --ty: -5px; --tr: 0.5deg;">
            <h1 class="text-white text-5xl font-bold tracking-tight mb-4">Control Panel</h1>
            <p class="text-[11px] font-black uppercase tracking-[0.5em] text-blue-400 opacity-80 italic">Central command for the Athena</p>
        </div>
        
        <div class="flex gap-4">
            <div class="premium-card px-8 py-4 rounded-2xl flex items-center gap-4 group hover:border-emerald-500/50 transition-all">
                <i data-lucide="shield-check" class="w-4 h-4 text-emerald-400"></i>
                <span class="text-[10px] font-black uppercase tracking-widest text-emerald-400 group-hover:text-emerald-300 transition-all">Security Active</span>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-8 p-6 premium-card border-emerald-500/20 text-emerald-400 text-[10px] font-black uppercase tracking-[0.4em] flex items-center gap-4 animate-pulse">
            <i data-lucide="shield-check" class="w-5 h-5 text-emerald-500"></i>
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-8 p-6 premium-card border-rose-500/20 text-rose-400 text-[10px] font-black uppercase tracking-[0.4em] flex items-center gap-4">
            <i data-lucide="alert-triangle" class="w-5 h-5 text-rose-500"></i>
            {{ implode(' ', $errors->all()) }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        
        {{-- User Management Section --}}
        <section class="lg:col-span-2 flex flex-col gap-8">
            <div class="flex items-center justify-between px-6 py-2">
                <h2 class="text-[10px] font-black uppercase tracking-[0.5em] text-cyan-400 italic">Users Database</h2>
                <span class="text-[9px] premium-card px-4 py-1 rounded-full font-black uppercase tracking-widest text-cyan-400 bg-cyan-500/10 border border-cyan-500/20">
                    {{ count($users) }} Active users
                </span>
            </div>

            <div class="premium-card rounded-3xl overflow-hidden shadow-2xl border border-white/5 bg-zinc-950/40 backdrop-blur-xl floating-registry">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-[11px] font-black uppercase tracking-widest">
                        <thead class="bg-white/5 border-b border-white/10 text-cyan-400">
                            <tr>
                                <th class="px-8 py-6">Users</th>
                                <th class="px-8 py-6">Role</th>
                                <th class="px-8 py-6">Status</th>
                                <th class="px-8 py-6 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/10">
                            @forelse($users as $user)
                                <tr class="hover:bg-white/5 transition-all group">
                                    <td class="px-8 py-8">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-10 rounded-2xl bg-cyan-500/20 flex items-center justify-center text-cyan-400 border border-cyan-500/40 group-hover:shadow-[0_0_20px_rgba(6,182,212,0.4)] transition-all">
                                                {{ strtoupper(substr($user['first_name'] ?? $user['username'] ?? $user['emailAddresses'][0]['emailAddress'] ?? 'U', 0, 1)) }}
                                            </div>
                                            <div>
                                                <p class="text-white font-semibold mb-1">
                                                    {{ ($user['first_name'] ?? $user['username'] ?? 'Unknown') . ' ' . ($user['last_name'] ?? '') }}
                                                </p>
                                                <p class="text-[9px] text-cyan-400 tracking-normal lowercase">{{ $user['emailAddresses'][0]['emailAddress'] ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-8">
                                        <span class="px-4 py-1.5 rounded-full bg-white/10 border border-white/20 text-[9px] font-medium
                                            {{ ($user['publicMetadata']['role'] ?? 'member') == 'admin' ? 'text-rose-400 bg-rose-500/10 border-rose-500/30' : 'text-blue-400 bg-blue-500/10 border-blue-500/30' }}">
                                            {{ $user['publicMetadata']['role'] ?? 'member' }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-8">
                                        <div class="flex items-center gap-2 text-emerald-400">
                                            <div class="w-1 h-1 rounded-full bg-emerald-400 animate-pulse"></div>
                                            <span class="text-[9px] font-medium">Online</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-8 text-right">
                                        <form action="{{ route('admin.users.update-role', $user['id']) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin mengubah role user ini?')">
                                            @csrf
                                            <select name="role" onchange="if(this.value !== '') { if(confirm('Ubah role menjadi ' + this.value + '?')) { this.form.submit(); } else { this.value=''; } }" class="bg-white/10 border border-white/20 rounded-lg px-3 py-1 text-[9px] font-black uppercase tracking-widest text-cyan-400 hover:bg-white/20 transition-all cursor-pointer focus:ring-0 focus:border-cyan-500/50">
                                                <option value="">Pilih Role</option>
                                                <option value="admin" {{ ($user['publicMetadata']['role'] ?? 'member') == 'admin' ? 'selected' : '' }}>Admin</option>
                                                <option value="member" {{ ($user['publicMetadata']['role'] ?? 'member') == 'member' ? 'selected' : '' }}>Member</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-8 py-16 text-center opacity-20 italic">No user nodes detected in registry</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section class="flex flex-col gap-8">
            <div class="px-6 py-2">
                <h2 class="text-[10px] font-black uppercase tracking-[0.5em] text-purple-400 italic">Data_Injection</h2>
            </div>

            <div class="premium-card p-10 rounded-[2.5rem] bg-zinc-950/40 border border-white/5 shadow-2xl zero-g">
                <form action="{{ route('admin.books.store') }}" method="POST" class="space-y-8">
                    @csrf
                    <div class="space-y-3">
                        <label class="text-[9px] font-black uppercase tracking-[0.4em] text-purple-400 block ml-4">Title_String</label>
                        <input type="text" name="title" required placeholder="PROTOCOL_NAME" 
                               class="w-full bg-white/10 border border-white/20 rounded-2xl py-5 px-8 text-[11px] font-black uppercase tracking-widest placeholder-white/30 text-white focus:outline-none focus:border-purple-500/50 transition-all">
                    </div>
                    
                    <div class="space-y-3">
                        <label class="text-[9px] font-black uppercase tracking-[0.4em] text-purple-400 block ml-4">Author_Key</label>
                        <input type="text" name="author" required placeholder="IDENTIFIER_HASH" 
                               class="w-full bg-white/10 border border-white/20 rounded-2xl py-5 px-8 text-[11px] font-black uppercase tracking-widest placeholder-white/30 text-white focus:outline-none focus:border-purple-500/50 transition-all">
                    </div>

                    <div class="space-y-3">
                        <label class="text-[9px] font-black uppercase tracking-[0.4em] text-purple-400 block ml-4">Category_Node</label>
                        <select name="category" class="w-full bg-white/10 border border-white/20 rounded-2xl py-5 px-8 text-[11px] font-black uppercase tracking-widest text-white focus:outline-none focus:border-purple-500/50 transition-all cursor-pointer">
                            <option value="Systems">Systems</option>
                            <option value="Logic">Logic</option>
                            <option value="Interface">Interface</option>
                            <option value="Network">Network</option>
                        </select>
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="w-full bg-white text-black py-6 rounded-2xl text-[10px] font-black uppercase tracking-[0.5em] hover:bg-zinc-200 transition-all shadow-[0_20px_40px_-15px_rgba(255,255,255,0.15)] active:scale-95">
                            UPLOAD_ARCHIVE
                        </button>
                    </div>
                </form>
            </div>

            <div class="premium-card p-8 rounded-2xl bg-purple-500/10 border border-purple-500/20">
                <div class="flex items-center gap-4 mb-4">
                    <i data-lucide="info" class="w-4 h-4 text-purple-400"></i>
                    <span class="text-[9px] font-black uppercase tracking-[0.3em] text-purple-400">Security_Notice</span>
                </div>
                <p class="text-[9px] font-black uppercase tracking-widest leading-loose text-purple-300/80">All injections are logged and synchronized across the secure cluster. Misuse will trigger protocol lockdown.</p>
            </div>
        </section>
    </div>

</div>
@endsection
