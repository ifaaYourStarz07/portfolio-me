@props(['projects'])

<section id="projects" class="py-24 px-4 sm:px-6 lg:px-8 border-t border-[#1B1A55]/60 relative">
    <div class="max-w-7xl mx-auto">
        
        <!-- Section Header with Filters -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-16 reveal-on-scroll">
            <div>
                <span class="text-xs font-mono text-[#7286D3] uppercase tracking-widest">// 02. SELECTED WORKS</span>
                <h2 class="text-3xl sm:text-4xl font-bold font-display text-[#FFF2F2] mt-2 tracking-tight">
                    Proyek Pilihan & Studi Kasus
                </h2>
                <p class="text-sm text-[#9290C3] mt-2 max-w-lg">
                    Setiap proyek merupakan eksplorasi nyata konsep pengembangan web. Ditandai transparan dengan status pengerjaan yang sebenarnya.
                </p>
            </div>

            <!-- Category Filter Buttons -->
            <div class="flex flex-wrap items-center gap-2" role="group" aria-label="Filter kategori project">
                <button type="button" data-filter="all" class="project-filter-btn px-4 py-1.5 rounded-full text-xs font-mono tracking-wider transition-all bg-[#7286D3] text-[#070F2B] font-semibold" aria-pressed="true">
                    Semua
                </button>
                <button type="button" data-filter="web-app" class="project-filter-btn px-4 py-1.5 rounded-full text-xs font-mono tracking-wider transition-all bg-transparent text-[#9290C3] border border-[#535C91]/40 hover:text-[#FFF2F2]" aria-pressed="false">
                    Web App
                </button>
                <button type="button" data-filter="fullstack" class="project-filter-btn px-4 py-1.5 rounded-full text-xs font-mono tracking-wider transition-all bg-transparent text-[#9290C3] border border-[#535C91]/40 hover:text-[#FFF2F2]" aria-pressed="false">
                    Fullstack
                </button>
                <button type="button" data-filter="creative-ui" class="project-filter-btn px-4 py-1.5 rounded-full text-xs font-mono tracking-wider transition-all bg-transparent text-[#9290C3] border border-[#535C91]/40 hover:text-[#FFF2F2]" aria-pressed="false">
                    Creative UI
                </button>
            </div>
        </div>

        <!-- Project Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($projects as $project)
                <article 
                    data-category="{{ $project['category'] }}" 
                    class="project-card glass-panel rounded-2xl overflow-hidden border border-[#535C91]/30 hover:border-[#7286D3]/60 transition-all duration-500 hover:-translate-y-1.5 flex flex-col justify-between reveal-on-scroll"
                >
                    <div>
                        <!-- Project Image Container -->
                        <div class="relative overflow-hidden aspect-[16/10] bg-[#1B1A55]/40 border-b border-[#535C91]/20 group">
                            <img 
                                src="{{ $project['preview_image'] }}" 
                                alt="{{ $project['title'] }} Preview" 
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                loading="lazy"
                            >
                            
                            <!-- Badges -->
                            <div class="absolute top-3 left-3 right-3 flex items-center justify-between pointer-events-none">
                                <span class="px-2.5 py-1 rounded-md bg-[#070F2B]/90 backdrop-blur-md text-[11px] font-mono text-[#8EA7E9] border border-[#7286D3]/30">
                                    {{ $project['category_label'] }}
                                </span>
                                @if ($project['is_placeholder'])
                                    <span class="px-2 py-0.5 rounded bg-[#535C91]/80 text-[10px] font-mono text-[#FFF2F2]">
                                        [CONTOH PROYEK]
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div class="p-6">
                            <h3 class="text-xl font-bold font-display text-[#FFF2F2] mb-2 leading-tight">
                                {{ $project['title'] }}
                            </h3>
                            <p class="text-xs text-[#9290C3] leading-relaxed mb-4">
                                {{ $project['description'] }}
                            </p>

                            <!-- Key Features List -->
                            <div class="mb-5 pt-3 border-t border-[#535C91]/20">
                                <span class="text-[11px] font-mono uppercase text-[#7286D3] tracking-wider block mb-2">Fitur Utama:</span>
                                <ul class="space-y-1.5">
                                    @foreach ($project['features'] as $feature)
                                        <li class="flex items-start gap-2 text-xs text-[#E5E0FF]">
                                            <svg class="w-3.5 h-3.5 text-[#7286D3] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                            <span>{{ $feature }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Challenge / Process Note -->
                            <div class="p-3 rounded-lg bg-[#070F2B]/60 border border-[#535C91]/20 mb-5">
                                <span class="text-[10px] font-mono text-[#8EA7E9] block mb-1 uppercase font-semibold">// Tantangan & Solusi:</span>
                                <p class="text-[11px] text-[#9290C3] leading-normal italic">
                                    "{{ $project['challenge'] }}"
                                </p>
                            </div>

                            <!-- Tech Stack Chips -->
                            <div class="flex flex-wrap gap-1.5 mb-6">
                                @foreach ($project['tech_stack'] as $tech)
                                    <span class="px-2.5 py-1 rounded-md bg-[#1B1A55] border border-[#535C91]/30 text-[11px] font-mono text-[#E5E0FF]">
                                        {{ $tech }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Footer Action Links -->
                    <div class="px-6 pb-6 pt-2 flex items-center justify-between border-t border-[#535C91]/20 text-xs font-mono">
                        @if ($project['repo_url'])
                            <a href="{{ $project['repo_url'] }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-[#9290C3] hover:text-[#FFF2F2] transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/></svg>
                                <span>Repository</span>
                            </a>
                        @else
                            <span class="text-[#535C91] text-[11px]">Private Repo</span>
                        @endif

                        @if ($project['demo_url'])
                            <a href="{{ $project['demo_url'] }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1 text-[#7286D3] hover:text-[#8EA7E9] font-medium transition-colors">
                                <span>Live Demo</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        @else
                            <span class="text-[#535C91] text-[11px]">[Demo Belum Online]</span>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>

    </div>
</section>
