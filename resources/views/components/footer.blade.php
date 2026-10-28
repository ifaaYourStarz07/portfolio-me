@props(['profile', 'socialLinks'])

<footer class="py-12 px-4 sm:px-6 lg:px-8 border-t border-[#1B1A55] bg-[#070F2B] relative z-10 text-xs font-mono">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6">
        
        <!-- Left Monogram & Copyright -->
        <div class="flex items-center gap-3">
            <span class="w-8 h-8 rounded-lg bg-[#1B1A55] border border-[#7286D3]/30 flex items-center justify-center text-[#7286D3] font-bold text-xs">
                MI
            </span>
            <div class="text-[#9290C3]">
                <span>&copy; {{ date('Y') }} {{ $profile['name'] }}.</span>
                <span class="text-[#535C91] block sm:inline sm:ml-2">Crafted with Laravel & Midnight Indigo aesthetic.</span>
            </div>
        </div>

        <!-- Center / Quick Links -->
        <nav class="flex items-center gap-4 text-[#9290C3]">
            <a href="#hero" class="hover:text-[#FFF2F2] transition-colors">Top</a>
            <span>•</span>
            <a href="#about" class="hover:text-[#FFF2F2] transition-colors">About</a>
            <span>•</span>
            <a href="#projects" class="hover:text-[#FFF2F2] transition-colors">Projects</a>
            <span>•</span>
            <a href="#skills" class="hover:text-[#FFF2F2] transition-colors">Skills</a>
            <span>•</span>
            <a href="#contact" class="hover:text-[#FFF2F2] transition-colors">Contact</a>
        </nav>

        <!-- Right Back to top button -->
        <div>
            <a href="#hero" aria-label="Kembali ke atas" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-[#1B1A55]/60 border border-[#535C91]/30 text-[#9290C3] hover:text-[#7286D3] hover:border-[#7286D3] transition-all">
                <span>Top</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
            </a>
        </div>

    </div>
</footer>
