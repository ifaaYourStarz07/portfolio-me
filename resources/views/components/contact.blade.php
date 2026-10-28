@props(['profile', 'socialLinks'])

<section id="contact" class="py-24 px-4 sm:px-6 lg:px-8 border-t border-[#1B1A55]/60 bg-[#070F2B] relative">
    <div class="max-w-7xl mx-auto">
        
        <!-- Section Header -->
        <div class="flex items-center gap-4 mb-6 reveal-on-scroll">
            <span class="text-xs font-mono text-[#7286D3] uppercase tracking-widest">// 05. CONTACT & COLLABORATION</span>
            <div class="h-px bg-gradient-to-r from-[#535C91]/60 to-transparent flex-1"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            
            <!-- Left Info Panel -->
            <div class="lg:col-span-5 reveal-on-scroll">
                <h2 class="text-3xl sm:text-4xl font-bold font-display text-[#FFF2F2] tracking-tight mb-4">
                    Mari Terhubung & Berdiskusi
                </h2>
                
                <p class="text-sm text-[#9290C3] leading-relaxed mb-8">
                    Terbuka untuk diskusi proyek web development, kolaborasi belajar, atau sekadar bertukar wawasan seputar teknologi software modern.
                </p>

                <!-- Social & Direct Channels -->
                <div class="space-y-4 mb-8">
                    @foreach ($socialLinks as $link)
                        <a 
                            href="{{ $link['url'] }}" 
                            target="_blank" 
                            rel="noopener noreferrer" 
                            class="glass-panel p-4 rounded-xl flex items-center justify-between group hover:border-[#7286D3]/60 transition-all"
                        >
                            <div class="flex items-center gap-3">
                                <span class="w-9 h-9 rounded-lg bg-[#1B1A55] border border-[#535C91]/40 flex items-center justify-center text-[#7286D3] font-mono text-xs font-bold group-hover:scale-105 transition-transform">
                                    {{ substr($link['name'], 0, 2) }}
                                </span>
                                <div>
                                    <h4 class="text-xs font-semibold text-[#FFF2F2]">{{ $link['name'] }}</h4>
                                    <span class="text-[11px] text-[#9290C3] font-mono">{{ $link['handle'] }}</span>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-[#9290C3] group-hover:text-[#7286D3] group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    @endforeach
                </div>

                <!-- Privacy & Transparency Notice -->
                <div class="p-4 rounded-xl bg-[#1B1A55]/30 border border-[#535C91]/25 text-xs text-[#9290C3] font-mono leading-relaxed">
                    <span class="text-[#8EA7E9] block font-semibold mb-1">// CATATAN PRIVASI:</span>
                    Informasi kontak di atas menggunakan data placeholder yang aman dan dapat diperbarui sewaktu-waktu sesuai akun resmi Anda.
                </div>
            </div>

            <!-- Right Interactive Form -->
            <div class="lg:col-span-7 reveal-on-scroll delay-100">
                <div class="glass-panel p-8 sm:p-10 rounded-2xl border border-[#535C91]/40 shadow-2xl">
                    <h3 class="text-xl font-bold font-display text-[#FFF2F2] mb-2">
                        Kirim Pesan
                    </h3>
                    <p class="text-xs text-[#9290C3] mb-6">
                        Silakan tinggalkan pesan melalui formulir di bawah ini.
                    </p>

                    <!-- Alert Notifications -->
                    @if (session('success'))
                        <div class="mb-6 p-4 rounded-xl bg-[#1B1A55] border border-[#7286D3] text-[#E5E0FF] text-xs flex items-center gap-3">
                            <svg class="w-5 h-5 text-[#8EA7E9] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-6 p-4 rounded-xl bg-[#1B1A55]/80 border border-red-400/50 text-[#FFF2F2] text-xs">
                            <span class="font-semibold block mb-1">Terdapat kesalahan pengisian formulir:</span>
                            <ul class="list-disc list-inside space-y-1 text-red-200">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Contact Form with CSRF -->
                    <form action="{{ route('contact.send') }}" method="POST" class="space-y-5">
                        @csrf
                        
                        <div>
                            <label for="contact-name" class="block text-xs font-mono uppercase text-[#E5E0FF] mb-2 tracking-wider">
                                Nama Anda <span class="text-[#7286D3]">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="contact-name" 
                                name="name" 
                                value="{{ old('name') }}" 
                                required 
                                placeholder="Masukkan nama Anda"
                                class="w-full px-4 py-3 rounded-xl bg-[#070F2B]/80 border border-[#535C91]/40 text-sm text-[#FFF2F2] placeholder-[#535C91] focus:border-[#7286D3] focus:ring-1 focus:ring-[#7286D3] transition-all"
                            >
                        </div>

                        <div>
                            <label for="contact-email" class="block text-xs font-mono uppercase text-[#E5E0FF] mb-2 tracking-wider">
                                Alamat Email <span class="text-[#7286D3]">*</span>
                            </label>
                            <input 
                                type="email" 
                                id="contact-email" 
                                name="email" 
                                value="{{ old('email') }}" 
                                required 
                                placeholder="nama@domain.com"
                                class="w-full px-4 py-3 rounded-xl bg-[#070F2B]/80 border border-[#535C91]/40 text-sm text-[#FFF2F2] placeholder-[#535C91] focus:border-[#7286D3] focus:ring-1 focus:ring-[#7286D3] transition-all"
                            >
                        </div>

                        <div>
                            <label for="contact-message" class="block text-xs font-mono uppercase text-[#E5E0FF] mb-2 tracking-wider">
                                Pesan <span class="text-[#7286D3]">*</span>
                            </label>
                            <textarea 
                                id="contact-message" 
                                name="message" 
                                rows="5" 
                                required 
                                placeholder="Tuliskan pesan atau topik yang ingin didiskusikan..."
                                class="w-full px-4 py-3 rounded-xl bg-[#070F2B]/80 border border-[#535C91]/40 text-sm text-[#FFF2F2] placeholder-[#535C91] focus:border-[#7286D3] focus:ring-1 focus:ring-[#7286D3] transition-all"
                            >{{ old('message') }}</textarea>
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="btn-primary w-full py-3.5 text-sm">
                                <span>Kirim Pesan Sekarang</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
</section>
