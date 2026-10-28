@props(['profile'])

<header id="main-navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- Monogram / Brand -->
            <a href="#hero" class="group flex items-center gap-3 text-decoration-none">
                <span class="w-10 h-10 rounded-xl bg-[#1B1A55] border border-[#7286D3]/30 flex items-center justify-center text-[#7286D3] font-bold font-mono text-base tracking-wider transition-all duration-300 group-hover:border-[#7286D3] group-hover:scale-105 group-hover:shadow-[0_0_15px_rgba(114,134,211,0.4)]">
                    MI
                </span>
                <div class="flex flex-col">
                    <span class="text-sm font-semibold tracking-wide text-[#FFF2F2] font-display">
                        {{ $profile['name'] }}
                    </span>
                    <span class="text-xs text-[#9290C3] font-mono">
                        {{ $profile['role'] }}
                    </span>
                </div>
            </a>

            <!-- Desktop Nav Items -->
            <nav class="hidden md:flex items-center gap-1 bg-[#1B1A55]/40 backdrop-blur-md px-4 py-2 rounded-full border border-[#535C91]/30">
                <a href="#about" class="px-3.5 py-1.5 text-xs uppercase tracking-wider font-medium text-[#9290C3] hover:text-[#FFF2F2] hover:bg-[#1B1A55] rounded-full transition-all">About</a>
                <a href="#projects" class="px-3.5 py-1.5 text-xs uppercase tracking-wider font-medium text-[#9290C3] hover:text-[#FFF2F2] hover:bg-[#1B1A55] rounded-full transition-all">Projects</a>
                <a href="#skills" class="px-3.5 py-1.5 text-xs uppercase tracking-wider font-medium text-[#9290C3] hover:text-[#FFF2F2] hover:bg-[#1B1A55] rounded-full transition-all">Skills</a>
                <a href="#journey" class="px-3.5 py-1.5 text-xs uppercase tracking-wider font-medium text-[#9290C3] hover:text-[#FFF2F2] hover:bg-[#1B1A55] rounded-full transition-all">Journey</a>
                <a href="#contact" class="px-3.5 py-1.5 text-xs uppercase tracking-wider font-medium text-[#9290C3] hover:text-[#FFF2F2] hover:bg-[#1B1A55] rounded-full transition-all">Contact</a>
            </nav>

            <!-- Action Button -->
            <div class="hidden md:block">
                <a href="#contact" class="btn-primary text-xs py-2 px-5">
                    <span>Let's Talk</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden flex items-center">
                <button id="mobile-menu-btn" type="button" aria-expanded="false" aria-label="Toggle Navigation Menu" class="p-2 rounded-lg bg-[#1B1A55] text-[#9290C3] hover:text-[#FFF2F2] border border-[#535C91]/40 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Drawer Backdrop -->
    <div id="mobile-menu-backdrop" class="hidden fixed inset-0 bg-[#070F2B]/80 backdrop-blur-sm z-40 md:hidden" aria-hidden="true"></div>

    <!-- Mobile Menu Drawer -->
    <div id="mobile-menu" class="hidden fixed top-20 right-4 left-4 z-50 bg-[#1B1A55] border border-[#535C91]/50 rounded-2xl p-6 shadow-2xl md:hidden">
        <nav class="flex flex-col gap-3">
            <a href="#about" class="mobile-nav-link text-sm font-medium py-2 px-3 text-[#E5E0FF] hover:bg-[#535C91]/20 rounded-lg">About Me</a>
            <a href="#projects" class="mobile-nav-link text-sm font-medium py-2 px-3 text-[#E5E0FF] hover:bg-[#535C91]/20 rounded-lg">Selected Projects</a>
            <a href="#skills" class="mobile-nav-link text-sm font-medium py-2 px-3 text-[#E5E0FF] hover:bg-[#535C91]/20 rounded-lg">Skills & Toolkit</a>
            <a href="#journey" class="mobile-nav-link text-sm font-medium py-2 px-3 text-[#E5E0FF] hover:bg-[#535C91]/20 rounded-lg">Learning Journey</a>
            <a href="#contact" class="mobile-nav-link text-sm font-medium py-2 px-3 text-[#E5E0FF] hover:bg-[#535C91]/20 rounded-lg">Get in Touch</a>
            <div class="pt-3 border-t border-[#535C91]/30">
                <a href="#contact" class="mobile-nav-link btn-primary w-full text-center text-xs py-2.5">
                    Connect With Me
                </a>
            </div>
        </nav>
    </div>
</header>
