@props(['journey'])

@php
    // ===== DATA — sunting di sini =====
    $title      = $journey['title']       ?? 'Perjalanan Belajar';
    $subtitle   = $journey['subtitle']    ?? 'Langkah demi langkah membangun kompetensi rekayasa perangkat lunak.';
    $eyebrow    = $journey['eyebrow']     ?? '04. Progress & Milestones';
    $steps      = $journey['steps']       ?? ($journey ?? []);
    $totalSteps = is_countable($steps) ? count($steps) : 0;
@endphp

{{-- Palet: #0B2447  #19376D  #576CBC  #A5D7E8 (sama dengan #hero) --}}

@verbatim
<style>
    /* ===== JOURNEY: rail & index ===== */
    #journey {
        background: #0B2447;
        position: relative;
        color: #A5D7E8;
        scroll-margin-top: 5rem;
    }
    /* glow dekoratif — memudar di tepi atas & bawah agar menyatu dengan section lain (tanpa garis patah) */
    #journey::before {
        content: ""; position: absolute; inset: 0; pointer-events: none;
        background:
            radial-gradient(620px circle at 88% 8%, rgba(87,108,188,.20), transparent 62%),
            radial-gradient(520px circle at 4% 82%, rgba(25,55,109,.55), transparent 64%);
        -webkit-mask-image: linear-gradient(to bottom, transparent 0, #000 18%, #000 78%, transparent 100%);
                mask-image: linear-gradient(to bottom, transparent 0, #000 18%, #000 78%, transparent 100%);
    }
    #journey::after {
        content: ""; position: absolute; inset: 0; pointer-events: none; opacity: .5;
        background-image: linear-gradient(to right, rgba(165,215,232,.045) 1px, transparent 1px);
        background-size: 68px 100%;
        -webkit-mask-image: linear-gradient(to bottom, transparent, #000 18%, #000 82%, transparent);
                mask-image: linear-gradient(to bottom, transparent, #000 18%, #000 82%, transparent);
    }
    #journey > * { position: relative; z-index: 1; }

    /* ---- Header: judul kiri, indeks kanan ---- */
    #journey .j-head { display: flex; flex-wrap: wrap; align-items: flex-end; justify-content: space-between; gap: 1.5rem; }
    #journey .j-eyebrow { font-family: ui-monospace, monospace; font-size: .7rem; letter-spacing: .22em; text-transform: uppercase; color: #576CBC; }
    /* judul: lebih ringan & lega (sebelumnya terlalu tebal/rapat) */
    #journey .j-title { font-size: clamp(1.75rem, 3.6vw, 2.5rem); font-weight: 600; letter-spacing: .01em; line-height: 1.2; color: #F2FAFF; }
    #journey .j-sub { margin-top: .8rem; font-size: .88rem; line-height: 1.8; letter-spacing: .005em; color: rgba(165,215,232,.7); max-width: 34rem; }
    #journey .j-index { text-align: right; }
    #journey .j-index-num { font-family: ui-monospace, monospace; font-variant-numeric: tabular-nums; line-height: 1; color: #F2FAFF; }
    #journey .j-index-num .cur { font-size: 2.6rem; font-weight: 800; }
    #journey .j-index-num .tot { font-size: 1rem; color: rgba(165,215,232,.5); }
    #journey .j-index-cap { font-family: ui-monospace, monospace; font-size: .62rem; letter-spacing: .2em; text-transform: uppercase; color: rgba(87,108,188,.9); margin-top: .45rem; }

    /* ---- Grid Layout utama ---- */
    #journey .j-grid { display: grid; grid-template-columns: 2.75rem minmax(0,1fr); gap: 0 1.25rem; margin-top: 3.75rem; }

    /* Rail vertikal (hanya desktop) */
    #journey .j-rail { position: relative; display: none; }
    #journey .j-rail::before {
        content: ""; position: absolute; left: 50%; top: .65rem; bottom: 0; width: 1px;
        transform: translateX(-50%); background: rgba(87,108,188,.24);
    }
    #journey .j-rail-fill {
        position: absolute; left: 50%; top: .65rem; width: 2px; height: 0; transform: translateX(-50%);
        background: linear-gradient(to bottom, #A5D7E8, #576CBC);
        box-shadow: 0 0 14px rgba(165,215,232,.55);
        transition: height .7s cubic-bezier(.2,.7,.2,1); border-radius: 2px;
    }
    #journey .j-rail-fill::after {
        content: ""; position: absolute; left: 50%; bottom: -4px; width: 9px; height: 9px;
        transform: translateX(-50%); border-radius: 9999px; background: #A5D7E8;
        box-shadow: 0 0 18px rgba(165,215,232,.9);
    }
    #journey .j-dot {
        position: absolute; left: 50%; width: 11px; height: 11px; border-radius: 9999px;
        transform: translate(-50%, .1rem); background: #0B2447; border: 1.5px solid rgba(87,108,188,.55);
        transition: background .35s, border-color .35s, box-shadow .35s, transform .35s;
    }
    #journey .j-dot.is-on { background: #A5D7E8; border-color: #A5D7E8; box-shadow: 0 0 14px rgba(165,215,232,.7); }
    #journey .j-dot.is-cur {
        transform: translate(-50%, .1rem) scale(1.35); background: #F2FAFF; border-color: #F2FAFF;
        box-shadow: 0 0 0 4px rgba(11,36,71,1), 0 0 0 5.5px rgba(165,215,232,.55), 0 0 22px rgba(165,215,232,.85);
        animation: j-pulse 2.4s ease-out infinite;
    }
    @keyframes j-pulse {
        0%,100% { box-shadow: 0 0 0 4px rgba(11,36,71,1), 0 0 0 5.5px rgba(165,215,232,.55), 0 0 22px rgba(165,215,232,.85); }
        50%     { box-shadow: 0 0 0 4px rgba(11,36,71,1), 0 0 0 9px rgba(165,215,232,.14), 0 0 26px rgba(165,215,232,.6); }
    }
    #journey .j-rail-num {
        position: absolute; left: 50%; transform: translateX(-50%);
        font-family: ui-monospace, monospace; font-size: .58rem; letter-spacing: .16em;
        color: rgba(87,108,188,.75); font-variant-numeric: tabular-nums;
    }
    #journey .j-rail-num.is-cur { color: #A5D7E8; }

    /* ---- Kartu langkah ---- */
    #journey .j-step { position: relative; padding-bottom: 2.35rem; }
    #journey .j-step:last-child { padding-bottom: 0; }
    #journey .j-card {
        position: relative; overflow: hidden;
        padding: 1.35rem 1.5rem 1.4rem; border-radius: 1.15rem;
        background: rgba(25,55,109,.38); border: 1px solid rgba(87,108,188,.22);
        transition: transform .4s cubic-bezier(.2,.7,.2,1), border-color .4s, background .4s, box-shadow .4s;
    }
    #journey .j-card::before {
        content: ""; position: absolute; left: 0; top: 14%; bottom: 14%; width: 2px; border-radius: 2px;
        background: linear-gradient(to bottom, #A5D7E8, #576CBC);
        transform: scaleY(0); transform-origin: top; transition: transform .45s cubic-bezier(.2,.7,.2,1);
    }
    /* kilau melintas pelan di kartu aktif */
    #journey .j-card::after {
        content: ""; position: absolute; inset: 0; pointer-events: none;
        background: linear-gradient(105deg, transparent 42%, rgba(165,215,232,.09) 50%, transparent 58%);
        background-size: 260% 100%; background-position: 135% 0;
        transition: background-position .9s ease-out;
    }
    #journey .j-card { opacity: .82; }
    #journey .j-year { opacity: .72; }                 /* sebelumnya .5 — terlalu pudar */
    #journey .j-step.is-cur .j-card { opacity: 1; background: rgba(25,55,109,.66); border-color: rgba(165,215,232,.45); }
    #journey .j-step.is-cur .j-year { opacity: 1; }
    @media (min-width: 900px) {
        #journey .j-step.is-cur .j-card { transform: translateX(8px); box-shadow: -14px 0 34px -22px rgba(165,215,232,.5); }
    }
    #journey .j-step.is-cur .j-card::before { transform: scaleY(1); }
    #journey .j-step.is-cur .j-card::after { background-position: -55% 0; }

    /* Desktop: tahun dan kartu jadi dua kolom di dalam tiap langkah */
    @media (min-width: 900px) {
        #journey .j-step { display: grid; grid-template-columns: 10rem minmax(0,1fr); column-gap: 2rem; align-items: start; }
        #journey .j-step .j-year { grid-column: 1; grid-row: 1; padding-top: .1rem; }
        #journey .j-step .j-card { grid-column: 2; grid-row: 1; }
    }

    /* Tahun / periode: warna solid terang (tidak lagi memudar ke bawah) agar baris kedua & ketiga tetap terbaca */
    #journey .j-year {
        font-weight: 700; line-height: 1.1; letter-spacing: -.01em;
        font-size: clamp(2rem, 5vw, 3.25rem); font-variant-numeric: tabular-nums;
        background: linear-gradient(180deg, #F2FAFF 0%, #A5D7E8 100%);
        -webkit-background-clip: text; background-clip: text; color: transparent;
        transition: opacity .4s, transform .4s;
    }
    /* periode berupa teks panjang (mis. "Tahap Saat Ini") → ukuran lebih kecil agar tidak pecah jadi 3 baris besar */
    #journey .j-year.is-long { font-size: clamp(1.4rem, 2.5vw, 1.9rem); line-height: 1.25; letter-spacing: 0; }

    #journey .j-top { display: flex; flex-wrap: wrap; align-items: center; gap: .6rem; margin-bottom: 1.05rem; }
    #journey .j-chip {
        display: inline-flex; align-items: center; gap: .5rem;
        padding: .3rem .7rem; border-radius: 9999px; font-size: .7rem; font-weight: 600;
        color: #EAF6FC; background: rgba(11,36,71,.85); border: 1px solid rgba(87,108,188,.42);
        font-family: ui-monospace, monospace; letter-spacing: .02em;
    }
    #journey .j-chip .dot { width: .42rem; height: .42rem; border-radius: 9999px; background: #34d399; box-shadow: 0 0 0 3px rgba(52,211,153,.18); }
    #journey .j-ordinal { font-family: ui-monospace, monospace; font-size: .65rem; letter-spacing: .2em; color: rgba(87,108,188,.85); margin-left: auto; font-variant-numeric: tabular-nums; }

    #journey .j-h { font-size: 1.055rem; font-weight: 700; color: #F2FAFF; letter-spacing: -.01em; margin-bottom: .45rem; }
    #journey .j-p { font-size: .84rem; line-height: 1.65; color: rgba(165,215,232,.66); margin-bottom: 1.05rem; }

    /* Meta: progress + durasi */
    #journey .j-meta { display: flex; align-items: center; gap: .85rem; margin-bottom: 1.05rem; }
    #journey .j-bar { position: relative; height: 3px; border-radius: 3px; background: rgba(87,108,188,.28); width: 7rem; overflow: hidden; }
    #journey .j-bar span { position: absolute; inset: 0 auto 0 0; border-radius: 3px; background: linear-gradient(90deg, #576CBC, #A5D7E8); }
    #journey .j-dur { font-family: ui-monospace, monospace; font-size: .64rem; letter-spacing: .1em; color: rgba(165,215,232,.5); }

    #journey .j-tags { display: flex; flex-wrap: wrap; gap: .4rem; padding-top: .95rem; border-top: 1px dashed rgba(87,108,188,.24); }
    #journey .j-tag {
        font-family: ui-monospace, monospace; font-size: .66rem; padding: .22rem .55rem; border-radius: .45rem;
        color: rgba(165,215,232,.6); background: rgba(11,36,71,.6); border: 1px solid rgba(87,108,188,.2);
        transition: color .3s, border-color .3s, background .3s;
    }
    #journey .j-step.is-cur .j-tag:hover, #journey .j-tag:hover { color: #A5D7E8; border-color: rgba(165,215,232,.45); background: rgba(25,55,109,.7); }

    /* ---- Reveal ---- */
    #journey .j-reveal { opacity: 0; transform: translateY(20px); }
    #journey .j-reveal.is-in { opacity: 1; transform: none; transition: opacity .7s cubic-bezier(.2,.7,.2,1), transform .7s cubic-bezier(.2,.7,.2,1); }

    /* ---- Responsive ---- */
    @media (max-width: 899px) {
        #journey .j-grid { grid-template-columns: minmax(0,1fr); gap: 0; }
        #journey .j-rail { display: none; }
        #journey .j-step { padding-left: 1.6rem; border-left: 1px solid rgba(87,108,188,.26); }
        #journey .j-step::before {
            content: ""; position: absolute; left: -6px; top: .35rem; width: 11px; height: 11px;
            border-radius: 9999px; background: #0B2447; border: 1.5px solid rgba(87,108,188,.6);
        }
        #journey .j-step.is-cur::before { background: #A5D7E8; border-color: #A5D7E8; }
        #journey .j-year { font-size: 1.95rem; }
        #journey .j-index { text-align: left; }
    }
    @media (min-width: 900px) { #journey .j-rail { display: block; } }

    @media (prefers-reduced-motion: reduce) {
        #journey * { transition: none !important; animation: none !important; }
        #journey .j-reveal, #journey .j-step { opacity: 1 !important; transform: none !important; }
    }
</style>
@endverbatim

<section id="journey" class="py-24 px-4 sm:px-6 lg:px-8 overflow-hidden">

    <div class="max-w-7xl mx-auto">

        <!-- Header: judul + penghitung langkah -->
        <header class="j-head j-reveal">
            <div>
                <div class="j-eyebrow mb-4">// {{ $eyebrow }}</div>
                <h2 class="j-title font-display">{{ $title }}</h2>
                <p class="j-sub">{{ $subtitle }}</p>
            </div>
            <div class="j-index">
                <div class="j-index-num"><span class="cur" id="j-cur">01</span><span class="tot"> / {{ str_pad((string) $totalSteps, 2, '0', STR_PAD_LEFT) }}</span></div>
                <div class="j-index-cap">Langkah aktif</div>
            </div>
        </header>

        <div class="j-grid">
            <!-- Rail progres -->
            <div class="j-rail" aria-hidden="true">
                <span class="j-rail-fill" id="j-rail-fill"></span>
            </div>

            <!-- Daftar langkah -->
            <div id="j-list">
                @foreach ($steps as $i => $step)
                    @php
                        $tags  = $step['tags'] ?? [];
                        $mile  = $step['milestone'] ?? 'Milestone';
                        $prog  = (int) ($step['progress'] ?? 100);
                        $dur   = $step['duration'] ?? null;
                        $long  = mb_strlen(trim((string) ($step['period'] ?? ''))) > 8;
                    @endphp
                    <article class="j-step j-reveal" data-index="{{ $i + 1 }}">
                        <div class="j-year mb-3 {{ $long ? 'is-long' : '' }}">{{ $step['period'] }}</div>

                        <div class="j-card">
                            <div class="j-top">
                                <span class="j-chip"><span class="dot"></span>{{ $mile }}</span>
                                <span class="j-ordinal">{{ str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) }} / {{ str_pad((string) $totalSteps, 2, '0', STR_PAD_LEFT) }}</span>
                            </div>

                            <h3 class="j-h font-display">{{ $step['title'] }}</h3>
                            <p class="j-p">{{ $step['description'] }}</p>

                            @if ($dur || $prog < 100)
                                <div class="j-meta">
                                    <span class="j-bar"><span style="width: {{ max(0, min(100, $prog)) }}%"></span></span>
                                    <span class="j-dur">{{ $dur ? $dur : $prog.'% selesai' }}</span>
                                </div>
                            @endif

                            @if (count($tags))
                                <div class="j-tags">
                                    @foreach ($tags as $tag)
                                        <span class="j-tag">#{{ $tag }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
        </div>

    </div>
</section>

@verbatim
<script>
(function () {
    var sec = document.getElementById('journey');
    if (!sec) return;
    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var steps = Array.prototype.slice.call(sec.querySelectorAll('.j-step'));
    var rail  = sec.querySelector('.j-rail');
    var fill  = document.getElementById('j-rail-fill');
    var curEl = document.getElementById('j-cur');
    if (!steps.length) return;

    /* tanpa IntersectionObserver: tampilkan semua, selesai */
    if (!('IntersectionObserver' in window)) {
        steps.concat([sec.querySelector('.j-head')]).forEach(function (n) { if (n) n.classList.add('is-in'); });
        return;
    }

    /* pasang titik-titik rail di posisi tiap kartu */
    function placeDots() {
        if (!rail) return;
        rail.querySelectorAll('.j-dot, .j-rail-num').forEach(function (n) { n.remove(); });
        if (window.innerWidth < 900) return;
        var base = rail.offsetTop;
        steps.forEach(function (s, i) {
            var top = s.offsetTop - base;              /* kebal terhadap animasi */
            var d = document.createElement('span');
            d.className = 'j-dot';
            d.style.top = (top + 18) + 'px';
            rail.appendChild(d);
            var n = document.createElement('span');
            n.className = 'j-rail-num';
            n.textContent = ('0' + (i + 1)).slice(-2);
            n.style.top = (top + 36) + 'px';
            rail.appendChild(n);
            s._dot = d; s._num = n;
        });
        update();
    }

    function update() {
        var mid = window.innerHeight * .42, best = 0, bestDist = Infinity;
        steps.forEach(function (s, i) {
            var b = s.getBoundingClientRect();
            if (b.top < window.innerHeight * .95) s.classList.add('is-in');
            var on = b.top < mid;
            if (s._dot) s._dot.classList.toggle('is-on', on);
            var dist = Math.abs(b.top - mid);
            if (dist < bestDist) { bestDist = dist; best = i; }
        });
        steps.forEach(function (s, i) {
            s.classList.toggle('is-cur', i === best);
            if (s._num) s._num.classList.toggle('is-cur', i === best);
        });
        if (curEl) curEl.textContent = ('0' + (best + 1)).slice(-2);
        if (fill && rail) {
            var rb = rail.getBoundingClientRect();
            var cb = steps[best].getBoundingClientRect();
            var h = Math.max(0, Math.min(cb.top - rb.top + cb.height / 2, rb.height));
            fill.style.height = h + 'px';
        }
    }

    /* reveal bertahap */
    var rio = new IntersectionObserver(function (es) {
        es.forEach(function (e) {
            if (!e.isIntersecting) return;
            e.target.classList.add('is-in');
            rio.unobserve(e.target);
            placeDots();
        });
    }, { threshold: .18 });
    steps.forEach(function (s) { rio.observe(s); });
    var head = sec.querySelector('.j-head');
    if (head) rio.observe(head);

    if (reduce) {
        steps.forEach(function (s) { s.classList.add('is-in'); });
        if (head) head.classList.add('is-in');
    }

    var raf = null;
    function onScroll() { if (raf) return; raf = requestAnimationFrame(function () { raf = null; update(); }); }
    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', function () { placeDots(); });
    window.addEventListener('load', placeDots);
    placeDots();
    update();

    /* pastikan kartu pertama langsung muncul walau belum di-scroll */
    setTimeout(update, 300);
})();
</script>
@endverbatim