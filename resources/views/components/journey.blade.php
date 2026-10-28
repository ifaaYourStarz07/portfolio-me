@props(['journey'])

<section id="journey" class="py-24 px-4 sm:px-6 lg:px-8 border-t border-[#1B1A55]/60 relative">
    <div class="max-w-7xl mx-auto">
        
        <!-- Section Header -->
        <div class="flex items-center gap-4 mb-6 reveal-on-scroll">
            <span class="text-xs font-mono text-[#7286D3] uppercase tracking-widest">// 04. PROGRESS & MILESTONES</span>
            <div class="h-px bg-gradient-to-r from-[#535C91]/60 to-transparent flex-1"></div>
        </div>

        <div class="max-w-2xl mb-16 reveal-on-scroll">
            <h2 class="text-3xl sm:text-4xl font-bold font-display text-[#FFF2F2] tracking-tight">
                Perjalanan Belajar (Learning Journey)
            </h2>
            <p class="text-sm text-[#9290C3] mt-2">
                Dokumentasi langkah demi langkah dalam membangun kompetensi rekayasa perangkat lunak secara berkelanjutan.
            </p>
        </div>

        <!-- Vertical Timeline with Editorial Style -->
        <div class="relative pl-6 sm:pl-10 border-l border-[#535C91]/40 space-y-12 max-w-3xl">
            @foreach ($journey as $step)
                <div class="relative reveal-on-scroll">
                    <!-- Timeline Node Indicator -->
                    <span class="absolute -left-[31px] sm:-left-[47px] top-1.5 w-4 h-4 rounded-full bg-[#1B1A55] border-2 border-[#7286D3] shadow-[0_0_10px_rgba(114,134,211,0.5)]"></span>

                    <!-- Card Container -->
                    <div class="glass-panel p-6 rounded-2xl border border-[#535C91]/30 hover:border-[#7286D3]/40 transition-colors">
                        <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                            <span class="text-xs font-mono text-[#8EA7E9] uppercase tracking-wider font-semibold">
                                {{ $step['period'] }}
                            </span>
                            <span class="px-2.5 py-0.5 rounded-full bg-[#1B1A55] text-[11px] font-mono text-[#E5E0FF] border border-[#535C91]/40">
                                {{ $step['milestone'] }}
                            </span>
                        </div>

                        <h3 class="text-lg font-bold font-display text-[#FFF2F2] mb-2">
                            {{ $step['title'] }}
                        </h3>

                        <p class="text-xs sm:text-sm text-[#9290C3] leading-relaxed mb-4">
                            {{ $step['description'] }}
                        </p>

                        <div class="flex flex-wrap gap-2 pt-3 border-t border-[#535C91]/20">
                            @foreach ($step['tags'] as $tag)
                                <span class="text-[11px] font-mono text-[#9290C3] bg-[#070F2B]/60 px-2 py-0.5 rounded border border-[#535C91]/20">
                                    #{{ $tag }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>
