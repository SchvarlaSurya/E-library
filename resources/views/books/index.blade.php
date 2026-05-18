@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 md:px-12 py-24">
    <div class="mb-32">
        <h1 class="text-7xl md:text-9xl font-black tracking-tighter leading-[0.85] uppercase mb-16 text-white">
            Index<br><span class="opacity-10">Archives.</span>
        </h1>
        <p class="text-[11px] font-bold opacity-30 max-w-sm mb-16 uppercase tracking-[0.4em] leading-loose">
            Universal collection of synchronized digital assets. Readied for deployment.
        </p>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-12 lg:gap-16">
        @for ($i = 1; $i <= 10; $i++)
        <div class="group">
            <div class="aspect-[3/4] rounded-3xl overflow-hidden premium-card mb-10 relative group border border-white/5">
                <div class="w-full h-full bg-zinc-950/20 flex items-center justify-center">
                    <i data-lucide="database" class="w-8 h-8 opacity-[0.03]"></i>
                </div>
                <div class="absolute bottom-6 left-6 right-6 translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all">
                    <button class="w-full bg-white text-black py-4 rounded-2xl text-[10px] font-black uppercase tracking-[0.3em] hover:bg-zinc-200 transition-colors">INITIALIZE</button>
                </div>
            </div>
            <div class="px-4">
                <h3 class="text-[11px] font-black uppercase tracking-tight text-white mb-2 truncate">Manifest.{{ sprintf('%02d', $i) }}</h3>
                <p class="text-[9px] font-black uppercase tracking-widest opacity-30 truncate">System</p>
            </div>
        </div>
        @endfor
    </div>
</div>


@endsection