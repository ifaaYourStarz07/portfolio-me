@props(['profile'])

@php
    $roles = $profile['roles'] ?? ['Full-Stack Developer', 'Laravel Engineer', 'UI Builder', 'Problem Solver'];
    $stats = $profile['stats'] ?? [
        ['value' => 3, 'suffix' => '+', 'label' => 'Tahun Pengalaman'],
        ['value' => 20, 'suffix' => '+', 'label' => 'Proyek Selesai'],
        ['value' => 10, 'suffix' => '+', 'label' => 'Klien Puas'],
    ];
    $stack = $profile['stack'] ?? ['Laravel', 'PHP', 'JavaScript', 'Tailwind CSS', 'SQLite', 'MySQL', 'Alpine.js', 'Git', 'REST API', 'Vite'];
    $location = $profile['location'] ?? 'Indonesia';
@endphp

@verbatim
<style>
    #hero .hero-in { opacity: 0; transform: translateY(28px); animation: hero-rise .8s cubic-bezier(.2,.7,.2,1) forwards; }
    #hero .d1 { animation-delay: .10s; } #hero .d2 { animation-delay: .25s; } #hero .d3 { animation-delay: .40s; }
    #hero .d4 { animation-delay: .55s; } #hero .d5 { animation-delay: .70s; } #hero .d6 { animation-delay: .90s; }
    @keyframes hero-rise { to { opacity: 1; transform: none; } }

    #hero .gradient-text { background-size: 200% auto; animation: hero-shine 6s linear infinite; }
    @keyframes hero-shine { to { background-position: 200% center; } }

    #hero .blob { position: absolute; border-radius: 9999px; filter: blur(90px); opacity: .35; pointer-events: none; animation: hero-float 14s ease-in-out infinite; }
    @keyframes hero-float { 0%,100% { transform: translate(0,0) scale(1); } 50% { transform: translate(40px,-30px) scale(1.15); } }

    #hero .grid-bg {
        position: absolute; inset: 0; pointer-events: none;
        background-image: linear-gradient(rgba(114,134,211,.07) 1px, transparent 1px), linear-gradient(90deg, rgba(114,134,211,.07) 1px, transparent 1px);
        background-size: 48px 48px;
        mask-image: radial-gradient(ellipse at center, #000 30%, transparent 75%);
        -webkit-mask-image: radial-gradient(ellipse at center, #000 30%, transparent 75%);
    }

    #hero .caret { display: inline-block; width: 3px; height: 1em; margin-left: 4px; background: #7286D3; vertical-align: -.1em; animation: hero-blink 1s steps(1) infinite; }
    @keyframes hero-blink { 50% { opacity: 0; } }

    #hero .tilt-card { transform-style: preserve-3d; transition: transform .15s ease-out; will-change: transform; }
    #hero .float-chip { animation: hero-bob 5s ease-in-out infinite; }
    #hero .float-chip.alt { animation-delay: -2.5s; }
    @keyframes hero-bob { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }

    #hero .marquee { display: flex; width: max-content; animation: hero-marquee 28s linear infinite; }
    #hero .marquee-wrap:hover .marquee { animation-play-state: paused; }
    @keyframes hero-marquee { to { transform: translateX(-50%); } }

    #hero .cta-glow { position: relative; }
    #hero .cta-glow::after { content: ""; position: absolute; inset: -4px; border-radius: inherit; border: 1px solid rgba(114,134,211,.6); animation: hero-ping 2.4s ease-out infinite; pointer-events: none; }
    @keyframes hero-ping { 0% { opacity: .8; transform: scale(1); } 100% { opacity: 0; transform: scale(1.12); } }

    @media (prefers-reduced-motion: reduce) {
        #hero *, #hero *::before, #hero *::after { animation: none !important; transition: none !important; }
        #hero .hero-in { opacity: 1; transform: none; }
    }
</style>
@endverbatim

<section id="hero" class="relative min-h-screen flex items-center pt-28 pb-12 px-4 sm:px-6 lg:px-8 overflow-hidden">

    <!-- Background: grid + animated blobs -->
    <div class="grid-bg" aria-hidden="true"></div>
    <div class="blob w-96 h-96 bg-[#7286D3] -top-20 -left-24" aria-hidden="true"></div>
    <div class="blob w-80 h-80 bg-[#535C91] bottom-0 right-0" style="animation-delay:-6s" aria-hidden="true"></div>

    <div class="relative max-w-7xl mx-auto w-full">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-14 lg:gap-8 items-center">

            <!-- LEFT: Intro -->
            <div class="lg:col-span-7 flex flex-col justify-center">

                <!-- Availability badge -->
                <div class="hero-in d1 inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full bg-[#1B1A55]/70 border border-[#7286D3]/30 w-fit mb-6">
                    <span class="relative flex w-2.5 h-2.5">
                        <span class="absolute inline-flex w-full h-full rounded-full bg-emerald-400 opacity-75 animate-ping"></span>
                        <span class="relative inline-flex w-2.5 h-2.5 rounded-full bg-emerald-400"></span>
                    </span>
                    <span class="text-xs font-mono uppercase tracking-wider text-[#E5E0FF]">{{ $profile['status'] }}</span>
                </div>

                <!-- Greeting + name -->
                <p class="hero-in d2 font-mono text-sm sm:text-base text-[#7286D3] mb-3">&lt;hello_world /&gt; Halo, saya</p>
                <h1 class="hero-in d2 text-5xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight font-display text-[#FFF2F2] leading-[1.05] mb-4">
                    <span class="gradient-text text-transparent bg-clip-text bg-gradient-to-r from-[#7286D3] via-[#E5E0FF] to-[#7286D3]">{{ $profile['name'] }}</span>
                </h1>

                <!-- Typewriter role -->
                <div class="hero-in d3 text-2xl sm:text-3xl lg:text-4xl font-bold font-display text-[#E5E0FF] mb-6 min-h-[1.4em]">
                    <span id="typed-role" data-roles='@json($roles)'></span><span class="caret" aria-hidden="true"></span>
                </div>

                <!-- Subtitle -->
                <p class="hero-in d4 text-base sm:text-lg text-[#9290C3] max-w-xl leading-relaxed mb-8">
                    {{ $profile['subtitle'] }}
                </p>

                <!-- CTA -->
                <div class="hero-in d5 flex flex-wrap items-center gap-4">
                    <a href="#projects" class="btn-primary cta-glow">
                        <span>Lihat Proyek Saya</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                    </a>
                    <a href="#contact" class="btn-secondary">
                        <span>Hubungi Saya</span>
                    </a>
                </div>

                <!-- Stats -->
                <dl class="hero-in d6 mt-12 pt-6 border-t border-[#535C91]/25 grid grid-cols-3 gap-6 max-w-lg">
                    @foreach ($stats as $stat)
                        <div>
                            <dt class="sr-only">{{ $stat['label'] }}</dt>
                            <dd class="text-3xl sm:text-4xl font-extrabold font-display text-[#FFF2F2]">
                                <span data-count="{{ $stat['value'] }}">0</span><span class="text-[#7286D3]">{{ $stat['suffix'] ?? '' }}</span>
                            </dd>
                            <p class="text-[11px] sm:text-xs font-mono uppercase tracking-wider text-[#9290C3] mt-1">{{ $stat['label'] }}</p>
                        </div>
                    @endforeach
                </dl>
            </div>

            <!-- RIGHT: Profile card with 3D tilt -->
            <div class="hero-in d3 lg:col-span-5 flex justify-center lg:justify-end">
                <div id="tilt-wrap" class="relative w-full max-w-sm sm:max-w-md" style="perspective: 1000px;">
                    <div id="tilt-card" class="tilt-card relative">

                        <div class="absolute -top-3 -left-3 w-8 h-8 border-t-2 border-l-2 border-[#7286D3] pointer-events-none"></div>
                        <div class="absolute -top-3 -right-3 w-8 h-8 border-t-2 border-r-2 border-[#8EA7E9] pointer-events-none"></div>
                        <div class="absolute -bottom-3 -left-3 w-8 h-8 border-b-2 border-l-2 border-[#8EA7E9] pointer-events-none"></div>
                        <div class="absolute -bottom-3 -right-3 w-8 h-8 border-b-2 border-r-2 border-[#7286D3] pointer-events-none"></div>

                        <div class="relative rounded-2xl overflow-hidden glass-panel border border-[#7286D3]/30 shadow-2xl group">
                            <img src="{{ $profile['avatar_url'] }}"
                                 alt="Foto profil {{ $profile['name'] }}"
                                 class="w-full h-auto aspect-[4/5] object-cover transition-transform duration-700 group-hover:scale-105"
                                 loading="eager">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#070F2B]/70 via-transparent to-transparent pointer-events-none"></div>

                            <div class="absolute bottom-4 left-4 right-4 p-3 rounded-xl bg-[#070F2B]/85 backdrop-blur-md border border-[#535C91]/40 flex items-center justify-between text-xs font-mono">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                                    <span class="text-[#FFF2F2]">{{ $profile['name'] }}</span>
                                </div>
                                <span class="text-[#9290C3]">{{ $location }}</span>
                            </div>
                        </div>

                        <!-- Floating chips -->
                        <div class="float-chip absolute -left-4 sm:-left-8 top-10 px-3 py-2 rounded-lg bg-[#1B1A55]/90 backdrop-blur border border-[#7286D3]/40 font-mono text-xs text-[#E5E0FF] shadow-xl" style="transform: translateZ(50px)">
                            <span class="text-[#7286D3]">const</span> passion = <span class="text-[#8EA7E9]">'code'</span>;
                        </div>
                        <div class="float-chip alt absolute -right-3 sm:-right-6 bottom-24 px-3 py-2 rounded-lg bg-[#1B1A55]/90 backdrop-blur border border-[#7286D3]/40 font-mono text-xs text-[#E5E0FF] shadow-xl" style="transform: translateZ(50px)">
                            <span class="text-[#7286D3]">php</span> artisan <span class="text-[#8EA7E9]">serve</span>
                        </div>
                    </div>
                    <div class="absolute -inset-2 bg-gradient-to-r from-[#7286D3]/20 to-[#1B1A55]/40 rounded-2xl blur-xl -z-10" aria-hidden="true"></div>
                </div>
            </div>
        </div>

        <!-- Tech stack marquee -->
        <div class="hero-in d6 marquee-wrap mt-16 overflow-hidden border-y border-[#535C91]/25 py-4"
             style="mask-image: linear-gradient(90deg, transparent, #000 10%, #000 90%, transparent); -webkit-mask-image: linear-gradient(90deg, transparent, #000 10%, #000 90%, transparent);"
             aria-label="Tech stack">
            <div class="marquee">
                @foreach (range(1, 2) as $loop_copy)
                    <div class="flex items-center shrink-0" @if ($loop_copy === 2) aria-hidden="true" @endif>
                        @foreach ($stack as $tech)
                            <span class="px-6 text-sm font-mono uppercase tracking-widest text-[#9290C3] whitespace-nowrap">{{ $tech }}</span>
                            <span class="text-[#7286D3]">✦</span>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Scroll indicator -->
        <div class="pt-10 flex justify-center">
            <a href="#about" aria-label="Scroll ke bagian About" class="inline-flex flex-col items-center gap-2 text-[#9290C3] hover:text-[#7286D3] transition-colors group">
                <span class="text-[10px] font-mono tracking-widest uppercase">Scroll</span>
                <span class="w-5 h-9 rounded-full border-2 border-[#535C91]/60 flex items-start justify-center p-1 group-hover:border-[#7286D3] transition-colors">
                    <span class="w-1 h-2 rounded-full bg-[#7286D3] animate-bounce"></span>
                </span>
            </a>
        </div>
    </div>
</section>

@verbatim
<script>
(function () {
    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // Typewriter
    var el = document.getElementById('typed-role');
    if (el) {
        var roles = JSON.parse(el.dataset.roles || '[]');
        if (reduce || !roles.length) { el.textContent = roles[0] || ''; }
        else {
            var r = 0, c = 0, del = false;
            (function tick() {
                var word = roles[r];
                el.textContent = word.slice(0, c);
                var delay = del ? 40 : 85;
                if (!del && c === word.length) { del = true; delay = 1600; }
                else if (del && c === 0) { del = false; r = (r + 1) % roles.length; delay = 350; }
                else { c += del ? -1 : 1; }
                setTimeout(tick, delay);
            })();
        }
    }

    // Count-up stats
    var counters = document.querySelectorAll('#hero [data-count]');
    var run = function (n) {
        var target = +n.dataset.count, start = null, dur = 1400;
        if (reduce) { n.textContent = target; return; }
        requestAnimationFrame(function step(t) {
            if (!start) start = t;
            var p = Math.min((t - start) / dur, 1);
            n.textContent = Math.round(target * (1 - Math.pow(1 - p, 3)));
            if (p < 1) requestAnimationFrame(step);
        });
    };
    if ('IntersectionObserver' in window) {
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (e) { if (e.isIntersecting) { run(e.target); io.unobserve(e.target); } });
        }, { threshold: .6 });
        counters.forEach(function (n) { io.observe(n); });
    } else { counters.forEach(run); }

    // 3D tilt on profile card (desktop pointer only)
    var wrap = document.getElementById('tilt-wrap'), card = document.getElementById('tilt-card');
    if (wrap && card && !reduce && window.matchMedia('(hover: hover)').matches) {
        wrap.addEventListener('mousemove', function (e) {
            var b = wrap.getBoundingClientRect();
            var x = (e.clientX - b.left) / b.width - .5, y = (e.clientY - b.top) / b.height - .5;
            card.style.transform = 'rotateY(' + (x * 12) + 'deg) rotateX(' + (-y * 12) + 'deg)';
        });
        wrap.addEventListener('mouseleave', function () { card.style.transform = 'rotateY(0) rotateX(0)'; });
    }
})();
</script>
@endverbatim