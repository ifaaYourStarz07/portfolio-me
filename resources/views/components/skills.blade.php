@props(['skills'])

<section id="skills" class="py-24 px-4 sm:px-6 lg:px-8 border-t border-[#1B1A55]/60 relative">
    <div class="max-w-7xl mx-auto">
        
        <!-- Section Header -->
        <div class="flex items-center gap-4 mb-6 reveal-on-scroll">
            <span class="text-xs font-mono text-[#7286D3] uppercase tracking-widest">// 03. TECHNICAL CAPABILITIES</span>
            <div class="h-px bg-gradient-to-r from-[#535C91]/60 to-transparent flex-1"></div>
        </div>

        <div class="max-w-2xl mb-16 reveal-on-scroll">
            <h2 class="text-3xl sm:text-4xl font-bold font-display text-[#FFF2F2] tracking-tight">
                Skillset & Kerangka Kerja
            </h2>
            <p class="text-sm text-[#9290C3] mt-2">
                Fokus kompetensi teknis yang terus diasah melalui latihan intensif dan pembuatan proyek nyata.
            </p>
        </div>

        <!-- 4-Column Responsive Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($skills as $categoryKey => $category)
                <div class="glass-panel p-6 rounded-2xl border border-[#535C91]/30 hover:border-[#7286D3]/40 transition-all duration-300 flex flex-col justify-between reveal-on-scroll">
                    <div>
                        <!-- Category Header -->
                        <div class="flex items-center justify-between pb-4 mb-4 border-b border-[#535C91]/25">
                            <h3 class="text-base font-bold font-display text-[#FFF2F2]">
                                {{ $category['name'] }}
                            </h3>
                            <span class="w-2.5 h-2.5 rounded-full bg-[#7286D3]/80"></span>
                        </div>
                        
                        <p class="text-xs text-[#9290C3] mb-6 leading-relaxed">
                            {{ $category['description'] }}
                        </p>

                        <!-- Skill Items (No arbitrary percentages, rich informative tags) -->
                        <div class="space-y-3">
                            @foreach ($category['items'] as $item)
                                <div class="p-3 rounded-xl bg-[#070F2B]/60 border border-[#535C91]/20 group hover:border-[#7286D3]/50 transition-colors">
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="text-xs font-semibold text-[#E5E0FF] group-hover:text-[#FFF2F2]">
                                            {{ $item['name'] }}
                                        </span>
                                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-[#1B1A55] text-[#8EA7E9] border border-[#7286D3]/20">
                                            {{ $item['level'] }}
                                        </span>
                                    </div>
                                    <span class="text-[11px] text-[#9290C3] block leading-tight">
                                        {{ $item['note'] }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Footer Monospace Status -->
                    <div class="mt-6 pt-4 border-t border-[#535C91]/20 flex items-center justify-between text-[10px] font-mono text-[#7286D3]">
                        <span>// STATUS: ACTIVE</span>
                        <span class="text-[#9290C3]">2026</span>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>
