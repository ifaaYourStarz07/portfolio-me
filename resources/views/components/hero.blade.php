@props(['profile'])

@php
    // ===== DATA PROFILE — sunting di sini =====
    $name  = $profile['name']     ?? 'Tifayatul Husna Azahra';
    $roles = $profile['roles']    ?? ['Laravel Engineer', 'UI Builder'];
    $stats = $profile['stats']    ?? [
        ['value' => 3,  'suffix' => '+', 'label' => 'Tahun Pengalaman'],
        ['value' => 20, 'suffix' => '+', 'label' => 'Proyek Selesai'],
       
    ];
    $statusText = $profile['status']   ?? 'Available for work';
    $subtitle   = $profile['subtitle'] ?? 'Saya membangun aplikasi web yang rapi, cepat, dan enak dipakai — dari ide, desain UI, sampai deploy ke production.';

    // ===== FOTO PROFIL =====
// File berada di: public/images/pp.jpeg
$photo = $profile['avatar_url'] ?? 'images/pp.jpeg';
$photoUrl = asset($photo);

    // Nama pendek untuk badge di kartu foto
    $shortName = 'Tifa';
@endphp

{{-- Palet: #0B2447  #19376D  #576CBC  #A5D7E8 --}}

@verbatim
<style>
    /* ===== HERO: Safe Haven ===== */
    #hero { --x: 30%; --y: 30%; background: #0B2447; scroll-margin-top: 5rem; }

    /* Fondasi: garis halus + dua glow statis biar gak ada flat */
    #hero::before {
        content: ""; position: absolute; inset: 0; pointer-events: none;
        background-image: linear-gradient(to right, rgba(165,215,232,.045) 1px, transparent 1px),
                          linear-gradient(to bottom, rgba(165,215,232,.045) 1px, transparent 1px);
        background-size: 68px 68px;
        -webkit-mask-image: radial-gradient(circle at 50% 38%, #000 28%, transparent 74%);
                mask-image: radial-gradient(circle at 50% 38%, #000 28%, transparent 74%);
    }
    #hero .orb {
        position: absolute; border-radius: 9999px; filter: blur(90px); pointer-events: none;
    }
    #hero .orb-a { width: 440px; height: 440px; left: -120px; top: -70px; background: rgba(87,108,188,.38); animation: hero-float 20s ease-in-out infinite; }
    #hero .orb-b { width: 380px; height: 380px; right: -100px; bottom: -100px; background: rgba(25,55,109,.65); animation: hero-float 26s ease-in-out infinite reverse; }
    @keyframes hero-float {
        0%,100% { transform: translate3d(0,0,0) scale(1); }
        50%     { transform: translate3d(42px,-34px,0) scale(1.12); }
    }

    /* Cahaya halus mengikuti mouse */
    #hero .spot {
        position: absolute; inset: 0; pointer-events: none;
        background: radial-gradient(480px circle at var(--x) var(--y), rgba(87,108,188,.28), transparent 65%);
    }

    /* ===== Entrance: muncul bertahap ===== */
    #hero .hero-in { opacity: 0; transform: translateY(24px); animation: hero-rise .8s cubic-bezier(.2,.7,.2,1) forwards; }
    #hero .d1 { animation-delay: .1s; } #hero .d2 { animation-delay: .22s; } #hero .d3 { animation-delay: .34s; }
    #hero .d4 { animation-delay: .46s; } #hero .d5 { animation-delay: .58s; }
    #hero .d6 { animation-delay: .7s; }
    @keyframes hero-rise { to { opacity: 1; transform: none; } }

    /* ===== Teks & judul ===== */
    #hero .greet { border: 1px solid rgba(87,108,188,.35); background: rgba(25,55,109,.55); }
    #hero .name-grad {
        background: linear-gradient(98deg, #A5D7E8 0%, #7FA8E8 45%, #576CBC 100%);
        -webkit-background-clip: text; background-clip: text; color: transparent;
    }
    /* sapuan kilau lewat di atas nama, sesekali */
    #hero .name-wrap { position: relative; display: inline-block; }
    #hero .name-wrap::after {
        content: ""; position: absolute; inset: 0; pointer-events: none;
        background: linear-gradient(105deg, transparent 38%, rgba(255,255,255,.28) 50%, transparent 62%);
        background-size: 240% 100%; background-position: 130% 0;
        animation: hero-sheen 7.5s ease-in-out 1.6s infinite;
    }
    @keyframes hero-sheen { 0%,86% { background-position: 130% 0; } 100% { background-position: -60% 0; } }

    /* Role yang diketik */
    #hero .role-line { display: flex; align-items: center; gap: .65rem; }
    #hero .role-slash { color: #576CBC; font-weight: 800; flex: none; }
    #hero .caret {
        display: inline-block; width: 3px; height: 1em; margin-left: 4px; background: #A5D7E8;
        vertical-align: -.1em; animation: hero-blink 1s steps(1) infinite;
    }
    @keyframes hero-blink { 50% { opacity: 0; } }

    /* ===== Tombol ===== */
    #hero .hbtn {
        position: relative; overflow: hidden; display: inline-flex; align-items: center; gap: .55rem;
        padding: .85rem 1.6rem; border-radius: .85rem; font-weight: 600; font-size: .95rem;
        transition: transform .25s, background .25s, border-color .25s, box-shadow .25s;
    }
    #hero .hbtn:hover { transform: translateY(-3px); }
    #hero .hbtn svg { transition: transform .25s; }
    #hero .hbtn:hover svg { transform: translateX(4px); }
    #hero .hbtn-primary { background: #576CBC; color: #fff; box-shadow: 0 10px 30px -12px rgba(87,108,188,.85); }
    #hero .hbtn-primary:hover { background: #6a7fd0; box-shadow: 0 16px 34px -12px rgba(87,108,188,1); }
    #hero .hbtn-secondary { color: #A5D7E8; border: 1px solid rgba(165,215,232,.35); background: rgba(11,36,71,.35); }
    #hero .hbtn-secondary:hover { background: rgba(165,215,232,.1); border-color: #A5D7E8; }

    /* ===== Statistik ===== */
    #hero .stat { padding: 0 1.5rem; border-left: 1px solid rgba(87,108,188,.4); }
    #hero .stat:first-child { padding-left: 0; border-left: 0; }
    #hero .stat-val { font-variant-numeric: tabular-nums; }

    /* ===== KARTU FOTO: profil yang dibingkai ===== */
    #hero .frame { position: relative; max-width: 22rem; margin-inline: auto; }
    #hero .dots {
        position: absolute; width: 118px; height: 118px; pointer-events: none; opacity: .75;
        background-image: radial-gradient(rgba(165,215,232,.45) 1.4px, transparent 1.4px);
        background-size: 13px 13px;
    }
    #hero .dots-tl { top: -26px; left: -26px; -webkit-mask-image: linear-gradient(to bottom right, #000, transparent 72%); mask-image: linear-gradient(to bottom right, #000, transparent 72%); }
    #hero .dots-br { bottom: -26px; right: -26px; -webkit-mask-image: linear-gradient(to top left, #000, transparent 72%); mask-image: linear-gradient(to top left, #000, transparent 72%); }
    #hero .ring { position: absolute; border-radius: 1.6rem; pointer-events: none; }
    #hero .ring-1 { inset: -14px; border: 1px dashed rgba(87,108,188,.4); animation: hero-spin 38s linear infinite; }
    #hero .ring-2 { inset: -28px; border: 1px solid rgba(165,215,232,.13); }
    @keyframes hero-spin { to { transform: rotate(360deg); } }

    #hero .tilt-card {
        position: relative; border-radius: 1.5rem; overflow: hidden;
        padding: 6px; background: rgba(255,255,255,.09);
        transition: transform .25s ease-out, box-shadow .25s; will-change: transform;
        box-shadow: 0 30px 60px -25px rgba(0,0,0,.65);
    }
    #hero .photo-inner { position: relative; border-radius: 1.2rem; overflow: hidden; background: #19376D; }
    #hero .photo-inner img {
        width: 100%; aspect-ratio: 4/5; object-fit: cover; display: block;
        object-position: 50% 22%;
        transition: transform .9s cubic-bezier(.2,.7,.2,1);
    }
    #hero .frame:hover .photo-inner img { transform: scale(1.06); }
    /* overlay gradasi bawah */
    #hero .photo-shade {
        position: absolute; inset: 0; pointer-events: none;
        background: linear-gradient(to top, rgba(11,36,71,.95) 0%, rgba(11,36,71,.45) 26%, transparent 55%);
    }
    /* kilau diagonal halus di permukaan foto */
    #hero .photo-sheen {
        position: absolute; inset: 0; pointer-events: none;
        background: linear-gradient(120deg, transparent 45%, rgba(165,215,232,.12) 50%, transparent 56%);
    }
    /* garis bawah bercahaya */
    #hero .glowline {
        position: absolute; left: 12%; right: 12%; bottom: 0; height: 2px; pointer-events: none;
        background: linear-gradient(90deg, transparent, #A5D7E8, #576CBC, transparent);
        filter: blur(3.5px); opacity: .8;
    }
    /* nama di atas foto */
    #hero .photo-caption { position: absolute; left: 1.25rem; right: 1.25rem; bottom: 1.3rem; pointer-events: none; text-align: center; }
    #hero .photo-name { font-size: 1.02rem; }
    #hero .photo-name::after { content: ""; display: block; width: 34px; height: 2px; margin: .6rem auto 0; border-radius: 2px; background: linear-gradient(90deg, transparent, #A5D7E8, transparent); }
    #hero .photo-name { font-weight: 700; letter-spacing: .01em; color: #fff; text-shadow: 0 2px 12px rgba(0,0,0,.5); }
    #hero .photo-role { font-size: .72rem; letter-spacing: .14em; text-transform: uppercase; color: #A5D7E8; opacity: .85; }

    /* chip mengambang */
    #hero .chip {
        position: absolute; z-index: 2; display: inline-flex; align-items: center; gap: .5rem;
        padding: .55rem .9rem; border-radius: 9999px; font-size: .8rem; font-weight: 600; color: #EAF6FC;
        background: rgba(11,36,71,.82); border: 1px solid rgba(87,108,188,.45);
        backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);
        box-shadow: 0 14px 30px -14px rgba(0,0,0,.7);
    }
    #hero .chip-1 { top: 6%; right: -8%; animation: hero-bob 5.5s ease-in-out infinite; }
    #hero .chip-2 { top: calc(100% - 1.1rem); left: 8%; animation: hero-bob 6.8s ease-in-out .8s infinite; }
    @keyframes hero-bob {
        0%,100% { transform: translateY(0); }
        50%     { transform: translateY(-10px); }
    }
    #hero .chip .mark {
        width: 1.4rem; height: 1.4rem; border-radius: 9999px; display: grid; place-items: center;
        background: rgba(87,108,188,.32); color: #A5D7E8; font-size: .72rem; font-weight: 800; flex: none;
    }
    #hero .chip .live { width: .5rem; height: .5rem; border-radius: 9999px; background: #34d399; box-shadow: 0 0 0 4px rgba(52,211,153,.18); flex: none; }

    /* scroll cue */
    #hero .cue {
        position: absolute; left: 50%; bottom: 1.35rem; transform: translateX(-50%);
        z-index: 3; color: rgba(165,215,232,.6); font-size: .68rem; letter-spacing: .16em;
        text-transform: uppercase; font-family: ui-monospace, monospace; text-decoration: none;
        display: flex; flex-direction: column; align-items: center; gap: .35rem;
    }
    #hero .cue:hover { color: #A5D7E8; }
    #hero .cue svg { animation: hero-down 1.9s ease-in-out infinite; }
    @keyframes hero-down { 0%,100% { transform: translateY(0); opacity: .5; } 50% { transform: translateY(6px); opacity: 1; } }

    @media (max-width: 640px) {
        #hero .chip-1 { right: 2%; } #hero .chip-2 { left: 2%; }
        #hero .stat { padding: 0 1rem; }
        #hero .ring-2 { display: none; }
        #hero .dots-tl { left: -6px; } #hero .dots-br { right: -6px; }
    }

    @media (prefers-reduced-motion: reduce) {
        #hero *, #hero *::before, #hero *::after { animation: none !important; transition: none !important; }
        #hero .hero-in { opacity: 1; transform: none; }
    }
</style>
@endverbatim

<section id="hero" class="relative min-h-screen flex items-center pt-28 pb-24 px-4 sm:px-6 lg:px-8 overflow-hidden">
    <span class="orb orb-a" aria-hidden="true"></span>
    <span class="orb orb-b" aria-hidden="true"></span>
    <div class="spot" aria-hidden="true"></div>

    <div class="relative max-w-6xl mx-auto w-full">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-y-10 lg:gap-x-10 items-center">

            <!-- Teks -->
            <div class="lg:col-span-7">
                <div class="hero-in d1 greet inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full mb-6">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span class="text-xs font-mono uppercase tracking-wider text-[#A5D7E8]">{{ $statusText }}</span>
                </div>

                <p class="hero-in d1 text-[#A5D7E8]/70 font-mono text-sm tracking-[.22em] uppercase mb-3">Halo, saya</p>

                <h1 class="hero-in d2 text-4xl sm:text-5xl lg:text-[4rem] font-extrabold tracking-tight font-display text-white leading-[1.08] mb-3">
                    <span class="name-wrap"><span class="name-grad">{{ $name }}</span></span>
                </h1>

                <div class="hero-in d3 role-line text-xl sm:text-2xl lg:text-3xl font-semibold font-display text-[#576CBC] mb-5 min-h-[1.4em]">
                    <span class="role-slash" aria-hidden="true">{</span>
                    <span id="typed-role" data-roles='@json($roles)'></span>
                    <span class="caret" aria-hidden="true"></span>
                    <span class="role-slash" aria-hidden="true">}</span>
                </div>

                <p class="hero-in d3 text-base sm:text-lg text-[#A5D7E8]/70 max-w-xl leading-relaxed mb-8">
                    {{ $subtitle }}
                </p>

                <div class="hero-in d4 flex flex-wrap items-center gap-3">
                    <a href="#projects" class="hbtn hbtn-primary">
                        Lihat Proyek
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h13M13 6l6 6-6 6"/></svg>
                    </a>
                    <a href="#contact" class="hbtn hbtn-secondary">
                        Hubungi Saya
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6l8 6 8-6"/><rect x="3" y="5" width="18" height="14" rx="2.5"/></svg>
                    </a>
                </div>

                <dl class="hero-in d5 mt-12 flex items-start max-w-xl">
                    @foreach ($stats as $stat)
                        <div class="stat">
                            <dd class="stat-val text-3xl sm:text-4xl font-bold font-display text-white leading-none">
                                <span data-count="{{ $stat['value'] }}">0</span><span class="text-[#A5D7E8]">{{ $stat['suffix'] ?? '' }}</span>
                            </dd>
                            <dt class="mt-2 text-xs text-[#A5D7E8]/65">{{ $stat['label'] }}</dt>
                        </div>
                    @endforeach
                </dl>
            </div>

            <!-- Foto profil -->
            <div class="hero-in d6 lg:col-span-5 flex justify-center lg:justify-end pt-6 pb-20 lg:pb-24">
                <div id="tilt-wrap" class="frame w-full" style="perspective: 1000px;">
                    <span class="dots dots-tl" aria-hidden="true"></span>
                    <span class="dots dots-br" aria-hidden="true"></span>
                    <span class="ring ring-2" aria-hidden="true"></span>
                    <span class="ring ring-1" aria-hidden="true"></span>

                    <span class="chip chip-1">
                        <span class="mark">{ }</span>
                        <span>Laravel&nbsp;·&nbsp;Livewire</span>
                    </span>
                    <span class="chip chip-2">
                        <span class="live"></span>
                        <span>Est. 2024 · Bandung</span>
                    </span>

                    <div id="tilt-card" class="tilt-card">
                        <div class="photo-inner">
                            <img
    src="{{ $photoUrl }}"
    alt="Foto profil {{ $name }}"
    class="object-cover"
    loading="eager"
    onerror="this.onerror=null; this.alt='Foto profil tidak ditemukan';"
>
                            <span class="photo-sheen" aria-hidden="true"></span>
                            <span class="photo-shade" aria-hidden="true"></span>
                            <span class="glowline" aria-hidden="true"></span>
                            <div class="photo-caption">
                                <div class="photo-name text-lg leading-tight">{{ $name }}</div>
                                <div class="photo-role mt-1">{{ $shortName }} · Developer &amp; UI Builder</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <a href="#about" class="cue" aria-label="Gulir ke bawah">
        <span>Scroll</span>
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 4v15M5 13l7 7 7-7"/></svg>
    </a>
</section>

@verbatim
<script>
(function () {
    var hero = document.getElementById('hero');
    if (!hero) return;
    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    /* Teks mengetik */
    var el = document.getElementById('typed-role');
    if (el) {
        var roles = JSON.parse(el.dataset.roles || '[]');
        if (reduce || !roles.length) { el.textContent = roles[0] || ''; }
        else {
            var r = 0, c = 0, del = false;
            (function tick() {
                var w = roles[r], delay = del ? 40 : 85;
                el.textContent = w.slice(0, c);
                if (!del && c === w.length) { del = true; delay = 1600; }
                else if (del && c === 0) { del = false; r = (r + 1) % roles.length; delay = 350; }
                else { c += del ? -1 : 1; }
                setTimeout(tick, delay);
            })();
        }
    }

    /* Angka menghitung naik */
    var run = function (n) {
        var target = +n.dataset.count, start = null;
        if (reduce) { n.textContent = target; return; }
        requestAnimationFrame(function step(t) {
            if (!start) start = t;
            var p = Math.min((t - start) / 1300, 1);
            n.textContent = Math.round(target * (1 - Math.pow(1 - p, 3)));
            if (p < 1) requestAnimationFrame(step);
        });
    };
    var counters = hero.querySelectorAll('[data-count]');
    if ('IntersectionObserver' in window) {
        var io = new IntersectionObserver(function (es) {
            es.forEach(function (e) { if (e.isIntersecting) { run(e.target); io.unobserve(e.target); } });
        }, { threshold: .6 });
        counters.forEach(function (n) { io.observe(n); });
    } else { counters.forEach(run); }

    if (reduce || !window.matchMedia('(hover: hover)').matches) return;

    /* Cahaya mengikuti mouse (halus) */
    var m = { x: 0, y: 0 }, s = { x: 0, y: 0 }, active = false;
    hero.addEventListener('mousemove', function (e) {
        var b = hero.getBoundingClientRect();
        m.x = e.clientX - b.left; m.y = e.clientY - b.top;
        if (!active) { s.x = m.x; s.y = m.y; active = true; }
    });
    (function loop() {
        if (active) {
            s.x += (m.x - s.x) * .1; s.y += (m.y - s.y) * .1;
            hero.style.setProperty('--x', s.x + 'px');
            hero.style.setProperty('--y', s.y + 'px');
        }
        requestAnimationFrame(loop);
    })();

    /* Foto miring tipis mengikuti mouse */
    var wrap = document.getElementById('tilt-wrap'), card = document.getElementById('tilt-card');
    if (wrap && card) {
        wrap.addEventListener('mousemove', function (e) {
            var b = wrap.getBoundingClientRect();
            var x = (e.clientX - b.left) / b.width - .5, y = (e.clientY - b.top) / b.height - .5;
            card.style.transform = 'rotateY(' + (x * 7) + 'deg) rotateX(' + (-y * 7) + 'deg)';
        });
        wrap.addEventListener('mouseleave', function () { card.style.transform = ''; });
    }
})();
</script>
@endverbatim