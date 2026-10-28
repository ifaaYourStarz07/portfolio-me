@props(['profile'])

<section id="about" class="py-24 px-4 sm:px-6 lg:px-8 border-t border-[#1B1A55]/60 relative">
    <div class="max-w-7xl mx-auto">
        
        <!-- Section Header -->
        <div class="flex items-center gap-4 mb-16 reveal-on-scroll">
            <span class="text-xs font-mono text-[#7286D3] uppercase tracking-widest">// 01. ABOUT ME</span>
            <div class="h-px bg-gradient-to-r from-[#535C91]/60 to-transparent flex-1"></div>
        </div>

        <!-- Editorial Asymmetrical Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            
            <!-- Left Portrait Visual with Distinct Composition -->
            <div class="lg:col-span-5 reveal-on-scroll">
                <div class="relative max-w-md mx-auto lg:max-w-none">
                    <div class="relative rounded-2xl overflow-hidden glass-panel border border-[#535C91]/30 p-2">
                        <div class="relative rounded-xl overflow-hidden aspect-[1/1]">
                            <img 
                                src="{{ $profile['avatar_url'] }}" 
                                alt="Foto profil sudut pandang close-up (placeholder)" 
                                class="w-full h-full object-cover object-center filter grayscale contrast-125 hover:grayscale-0 transition-all duration-700"
                                loading="lazy"
                            >
                        </div>
                    </div>

                    <!-- Highlight Meta Box -->
                    <div class="mt-6 p-5 rounded-xl bg-[#1B1A55]/50 border border-[#535C91]/30 flex flex-col gap-3">
                        <div class="flex items-center justify-between text-xs font-mono text-[#9290C3]">
                            <span>STATUS:</span>
                            <span class="text-[#8EA7E9] font-semibold">{{ $profile['status'] }}</span>
                        </div>
                        <div class="flex items-center justify-between text-xs font-mono text-[#9290C3]">
                            <span>LOKASI:</span>
                            <span class="text-[#FFF2F2]">{{ $profile['location'] }}</span>
                        </div>
                        <div class="flex items-center justify-between text-xs font-mono text-[#9290C3]">
                            <span>BIDANG:</span>
                            <span class="text-[#E5E0FF]">Web Engineering & Design</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Story & Editorial Narrative -->
            <div class="lg:col-span-7 flex flex-col gap-6 reveal-on-scroll delay-100">
                <h2 class="text-3xl sm:text-4xl font-bold font-display text-[#FFF2F2] tracking-tight leading-snug">
                    Membangun website dengan ketelitian kode dan rasa estetika.
                </h2>

                <div class="space-y-4 text-[#9290C3] leading-relaxed text-base">
                    <p class="text-[#E5E0FF] font-medium text-lg leading-relaxed">
                        {{ $profile['bio_story'] }}
                    </p>
                    <p>
                        Sebagai seorang pelajar, motivasi terbesar saya adalah memahami arsitektur internal di balik website yang solid — dari perancangan database terstruktur hingga animasi interaktif yang tidak memperlambat perangkat pengguna.
                    </p>
                    <p>
                        {{ $profile['learning_focus'] }}
                    </p>
                </div>

                <!-- Education & Learning Focus Highlights -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4 pt-6 border-t border-[#535C91]/30">
                    <div class="p-4 rounded-xl bg-[#1B1A55]/30 border border-[#535C91]/20">
                        <span class="text-xs font-mono text-[#7286D3] uppercase tracking-wider block mb-1">Pendidikan</span>
                        <h3 class="text-sm font-semibold text-[#FFF2F2]">{{ $profile['education'] }}</h3>
                        <p class="text-xs text-[#9290C3] mt-1">Mengasah logika pemrograman, algoritma data, dan web modern.</p>
                    </div>

                    <div class="p-4 rounded-xl bg-[#1B1A55]/30 border border-[#535C91]/20">
                        <span class="text-xs font-mono text-[#8EA7E9] uppercase tracking-wider block mb-1">Prinsip Belajar</span>
                        <h3 class="text-sm font-semibold text-[#FFF2F2]">Clean Code & User-Centric</h3>
                        <p class="text-xs text-[#9290C3] mt-1">Mengutamakan keterbacaan kode, keamanan data, dan kepuasan pengguna.</p>
                    </div>
                </div>

            </div>

        </div>

    </div>
</section>
