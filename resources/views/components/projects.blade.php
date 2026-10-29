@props(['projects'])

@php
    $projects = $projects ?? [];

    /* kategori unik untuk tombol filter — dibuat otomatis dari data */
    $cats = [];
    foreach ($projects as $p) {
        $k = $p['category'] ?? 'lainnya';
        $cats[$k] = $p['category_label'] ?? ucfirst(str_replace('-', ' ', $k));
    }

    $limit = function (string $t, int $n = 110): string {
        return mb_strlen($t) <= $n ? $t : rtrim(mb_substr($t, 0, $n)) . '…';
    };
@endphp

{{-- Palet: #0B2447  #19376D  #576CBC  #A5D7E8 (sama persis dengan #hero, #journey, #contact) --}}

@verbatim
<style>
    /* ===== PROJECTS ===== */
    #projects {
        /* nilai disamakan dengan journey & contact */
        --page: #0B2447;
        --surface: #19376D;
        --edge: #576CBC;
        --ink: #F2FAFF;
        --muted: #A5D7E8;
        --brand: #576CBC;
        --accent: #576CBC;      /* eyebrow & ikon, sama seperti section lain */
        --soft: #A5D7E8;
        --on-brand: #FFFFFF;

        --edge-22: rgba(87,108,188,.22);
        --edge-30: rgba(87,108,188,.30);
        --edge-40: rgba(87,108,188,.40);
        --surf-32: rgba(25,55,109,.32);
        --surf-45: rgba(25,55,109,.45);
        --surf-60: rgba(25,55,109,.60);
        --soft-40: rgba(165,215,232,.40);
        --soft-55: rgba(165,215,232,.55);
        --muted-72: rgba(165,215,232,.72);
        --muted-60: rgba(165,215,232,.60);
        --muted-45: rgba(165,215,232,.45);
        background: var(--page); position: relative; overflow: hidden; scroll-margin-top: 5rem;
    }
    /* glow dekoratif — memudar di tepi atas & bawah agar menyatu dengan section lain */
    #projects::before {
        content: ""; position: absolute; inset: 0; pointer-events: none;
        background:
            radial-gradient(620px circle at 88% 8%, rgba(87,108,188,.20), transparent 62%),
            radial-gradient(520px circle at 4% 82%, rgba(25,55,109,.55), transparent 64%);
        -webkit-mask-image: linear-gradient(to bottom, transparent 0, #000 18%, #000 78%, transparent 100%);
                mask-image: linear-gradient(to bottom, transparent 0, #000 18%, #000 78%, transparent 100%);
    }
    #projects > * { position: relative; z-index: 1; }

    #projects .p-eyebrow { font-family: ui-monospace, monospace; font-size: .7rem; letter-spacing: .22em; text-transform: uppercase; color: var(--accent); }
    /* judul: ringan & lega, sama seperti journey & contact */
    #projects .p-title { font-weight: 600; letter-spacing: .01em; line-height: 1.2; color: var(--ink); font-size: clamp(1.75rem, 3.6vw, 2.5rem); }
    #projects .p-sub { margin-top: .8rem; font-size: .88rem; line-height: 1.8; letter-spacing: .005em; color: rgba(165,215,232,.7); max-width: 32rem; }

    /* ---------- Search ---------- */
    #projects .p-searchbox { position: relative; width: min(280px, 60vw); }
    #projects .p-searchbox svg { position: absolute; left: .8rem; top: 50%; transform: translateY(-50%); width: 14px; height: 14px; color: var(--accent); pointer-events: none; }
    #projects .p-searchbox input {
        width: 100%; padding: .6rem .9rem .6rem 2.2rem; border-radius: 9999px; font-size: .8rem;
        color: var(--ink); background: var(--surf-45); border: 1px solid var(--edge-30); outline: none;
        transition: border-color .3s, box-shadow .3s, background .3s;
    }
    #projects .p-searchbox input::placeholder { color: var(--muted-45); font-family: ui-monospace, monospace; }
    #projects .p-searchbox input:focus { border-color: var(--soft-55); box-shadow: 0 0 0 3px rgba(87,108,188,.2); background: rgba(11,36,71,.7); }

    /* ---------- Filter ---------- */
    #projects .p-bar { display: flex; flex-wrap: wrap; align-items: center; gap: .5rem; margin-top: 2.1rem; }
    #projects .p-btn {
        appearance: none; cursor: pointer; padding: .45rem .95rem; border-radius: 9999px;
        font-family: ui-monospace, monospace; font-size: .7rem; letter-spacing: .08em; font-weight: 600; text-transform: uppercase;
        color: var(--muted-72); background: var(--surf-32); border: 1px solid var(--edge-30);
        transition: color .3s, background .3s, border-color .3s, transform .3s, box-shadow .3s;
    }
    #projects .p-btn:hover { color: var(--ink); border-color: var(--soft-40); transform: translateY(-2px); }
    #projects .p-btn.is-on { color: var(--on-brand); background: var(--brand); border-color: var(--brand); box-shadow: 0 10px 22px -12px rgba(87,108,188,.95); }
    #projects .p-count { margin-left: auto; font-family: ui-monospace, monospace; font-size: .68rem; letter-spacing: .1em; text-transform: uppercase; color: var(--muted-45); font-variant-numeric: tabular-nums; }
    #projects .p-count b { color: var(--soft); font-weight: 700; }
    @media (max-width: 639px) {
        #projects .p-bar { flex-wrap: nowrap; overflow-x: auto; scrollbar-width: none; -webkit-overflow-scrolling: touch; padding-bottom: .35rem; }
        #projects .p-bar::-webkit-scrollbar { display: none; }
        #projects .p-btn { flex: none; }
        #projects .p-count { display: none; }
        #projects .p-searchbox { width: 100%; }
    }

    /* ---------- Track geser horizontal ---------- */
    #projects .p-track {
        display: flex; gap: 1.2rem; margin: 1.6rem -1rem 0; padding: .6rem 1rem 1.6rem;
        overflow-x: auto; overflow-y: hidden;
        scroll-snap-type: x mandatory; scroll-padding-left: 1rem; scroll-behavior: smooth;
        scrollbar-width: none; -webkit-overflow-scrolling: touch; overscroll-behavior-x: contain;
        cursor: grab; outline: none;
        -webkit-mask-image: linear-gradient(to right, transparent 0, #000 1rem, #000 calc(100% - 2.5rem), transparent 100%);
                mask-image: linear-gradient(to right, transparent 0, #000 1rem, #000 calc(100% - 2.5rem), transparent 100%);
    }
    #projects .p-track::-webkit-scrollbar { display: none; }
    #projects .p-track.is-drag { cursor: grabbing; scroll-snap-type: none; scroll-behavior: auto; user-select: none; }
    #projects .p-track.is-drag .pj-wrap { pointer-events: none; }

    #projects .pj { position: relative; flex: 0 0 auto; width: min(21rem, 80vw); scroll-snap-align: start; }
    #projects .pj-wrap {
        position: relative; overflow: hidden; display: flex; flex-direction: column; height: 100%;
        border-radius: 1.15rem; background: rgba(25,55,109,.38); border: 1px solid var(--edge-22);
        text-decoration: none; color: inherit;
        transform: translateY(var(--lift, 0px)); scale: var(--s, 1); opacity: var(--o, 1);
        transition: transform .45s cubic-bezier(.2,.7,.2,1), scale .3s ease-out, opacity .3s ease-out,
                    border-color .45s, background .45s, box-shadow .45s;
    }
    #projects .pj-wrap:hover { --lift: -6px; border-color: rgba(165,215,232,.45); background: rgba(25,55,109,.62); box-shadow: 0 22px 44px -24px rgba(0,0,0,.8); }
    #projects .pj-wrap::after {
        content: ""; position: absolute; left: 0; right: 0; top: 0; height: 2px; z-index: 3;
        background: linear-gradient(90deg, #576CBC, #A5D7E8);
        transform: scaleX(0); transform-origin: left; transition: transform .5s cubic-bezier(.2,.7,.2,1);
    }
    #projects .pj-wrap:hover::after { transform: scaleX(1); }

    /* gambar / placeholder */
    #projects .pj-img { position: relative; overflow: hidden; aspect-ratio: 16/10; background: var(--surface); flex: none; }
    #projects .pj-img img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; transition: transform .9s cubic-bezier(.2,.7,.2,1); -webkit-user-drag: none; user-select: none; }
    #projects .pj-wrap:hover .pj-img img { transform: scale(1.07); }
    #projects .pj-img::after { content: ""; position: absolute; inset: 0; background: linear-gradient(to top, rgba(11,36,71,.55), transparent 55%); }
    #projects .pj-noimg { position: absolute; inset: 0; background: radial-gradient(120% 100% at 0% 0%, #19376D, #0F2A52); }
    #projects .pj-noimg::before {
        content: ""; position: absolute; top: 1rem; left: 1.1rem; width: .6rem; height: .6rem; border-radius: 9999px;
        background: #576CBC; box-shadow: 1.1rem 0 0 rgba(165,215,232,.55), 2.2rem 0 0 rgba(87,108,188,.5);
    }
    #projects .pj-noimg i {
        position: absolute; left: 1.1rem; right: 1.1rem; top: 2.4rem; font-style: normal;
        font-family: ui-monospace, monospace; font-size: .62rem; line-height: 2.15; letter-spacing: .02em;
        color: var(--muted-60); white-space: pre;
    }
    #projects .pj-noimg i::before { content: "$ git log --oneline\A> proyek ini masih tahap\A  eksplorasi pribadi."; }
    #projects .pj-tag-exam { position: absolute; left: .75rem; bottom: .75rem; z-index: 2; font-family: ui-monospace, monospace; font-size: .55rem; font-weight: 700; letter-spacing: .16em; color: #0B2447; background: #A5D7E8; padding: .18rem .45rem; border-radius: .35rem; }

    /* isi kartu */
    #projects .pj-body { position: relative; padding: 1.05rem 1.15rem 1.15rem; display: flex; flex-direction: column; gap: .5rem; flex: 1; }
    #projects .pj-meta { display: flex; align-items: center; gap: .5rem; }
    #projects .pj-cat { font-family: ui-monospace, monospace; font-size: .58rem; font-weight: 700; letter-spacing: .16em; text-transform: uppercase; color: var(--soft); background: rgba(11,36,71,.8); border: 1px solid var(--edge-40); padding: .2rem .5rem; border-radius: .45rem; }
    #projects .pj-year { font-family: ui-monospace, monospace; font-size: .6rem; letter-spacing: .18em; color: var(--muted-45); font-variant-numeric: tabular-nums; }
    #projects .pj-title { margin: 0; font-size: 1.03rem; font-weight: 700; letter-spacing: -.01em; line-height: 1.25; color: var(--ink); transition: color .35s; }
    #projects .pj-wrap:hover .pj-title { color: var(--soft); }
    #projects .pj-desc { color: rgba(165,215,232,.66); font-size: .8rem; line-height: 1.7; margin: 0; }
    #projects .pj-tech { display: flex; flex-wrap: wrap; gap: .35rem; margin-top: .25rem; }
    #projects .pj-tech span { font-family: ui-monospace, monospace; font-size: .6rem; color: var(--muted-60); background: rgba(11,36,71,.6); border: 1px solid var(--edge-22); padding: .16rem .45rem; border-radius: .4rem; }
    #projects .pj-arr { position: absolute; top: 1.05rem; right: 1.05rem; z-index: 2; color: var(--soft); opacity: 0; transform: translate(-6px, 6px); transition: opacity .35s, transform .35s; }
    #projects .pj-wrap:hover .pj-arr { opacity: 1; transform: none; }

    /* ---------- Navigasi: progress + panah ---------- */
    #projects .p-foot { display: flex; align-items: center; gap: 1.25rem; margin-top: .2rem; }
    #projects .p-progress { position: relative; flex: 1; height: 3px; border-radius: 9999px; background: var(--edge-30); overflow: hidden; transition: opacity .3s; }
    #projects .p-thumb { position: absolute; top: 0; bottom: 0; left: 0; width: 30%; border-radius: inherit; background: linear-gradient(90deg, #576CBC, #A5D7E8); transition: width .3s; }
    #projects .p-nav { display: flex; gap: .5rem; }
    #projects .p-arrow {
        width: 2.5rem; height: 2.5rem; border-radius: 9999px; display: grid; place-items: center; cursor: pointer;
        color: var(--soft); background: var(--surf-45); border: 1px solid var(--edge-40);
        transition: background .3s, color .3s, transform .3s, opacity .3s, border-color .3s;
    }
    #projects .p-arrow:hover:not(:disabled) { background: var(--brand); color: var(--on-brand); border-color: var(--brand); transform: scale(1.08); }
    #projects .p-arrow:active:not(:disabled) { transform: scale(.95); }
    #projects .p-arrow:disabled { opacity: .3; cursor: default; }
    #projects .p-arrow svg { transition: transform .3s; }
    #projects #p-prev:hover:not(:disabled) svg { transform: translateX(-2px); }
    #projects #p-next:hover:not(:disabled) svg { transform: translateX(2px); }

    /* ---------- Muncul bertahap ---------- */
    #projects .pj { opacity: 0; transform: translateX(36px); }
    #projects .pj.show { opacity: 1; transform: none; transition: opacity .7s cubic-bezier(.2,.7,.2,1), transform .7s cubic-bezier(.2,.7,.2,1); }

    #projects .pj.is-off { display: none; }
    #projects .p-empty {
        display: none; margin-top: 2.25rem; padding: 3rem 1rem; text-align: center; border-radius: 1.15rem;
        border: 1px dashed var(--edge-40); font-family: ui-monospace, monospace; font-size: .76rem; color: var(--muted-60);
    }
    #projects .p-empty.is-on { display: block; }

    @media (prefers-reduced-motion: reduce) {
        #projects * { transition: none !important; animation: none !important; }
        #projects .p-track { scroll-behavior: auto; }
        #projects .pj { opacity: 1 !important; transform: none !important; }
    }
</style>
<noscript><style>#projects .pj { opacity: 1 !important; transform: none !important; }</style></noscript>
@endverbatim

<section id="projects" class="py-24 px-4 sm:px-6 lg:px-8">

    <div class="max-w-7xl mx-auto">

        <!-- Header -->
        <header class="flex flex-wrap items-end justify-between gap-6">
            <div>
                <div class="p-eyebrow mb-4">// 02. Selected Works</div>
                <h2 class="p-title font-display">Proyek pilihan</h2>
                <p class="p-sub">Yang benar-benar kukerjakan, bukan yang cuma kuniatkan. Geser ke samping untuk melihat lebih banyak.</p>
            </div>

            <div class="p-searchbox">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="11" cy="11" r="7"/><path d="M20 20l-3.4-3.4"/></svg>
                <input type="text" id="p-search" placeholder="cari nama / stack" autocomplete="off" aria-label="Cari proyek">
            </div>
        </header>

        <!-- Filter -->
        <div class="p-bar" role="group" aria-label="Filter kategori">
            <button type="button" class="p-btn is-on" data-filter="all" aria-pressed="true">Semua</button>
            @foreach ($cats as $key => $label)
                <button type="button" class="p-btn" data-filter="{{ $key }}" aria-pressed="false">{{ $label }}</button>
            @endforeach
            <span class="p-count" id="p-count" aria-live="polite"></span>
        </div>

        <!-- Track geser horizontal -->
        <div class="p-track" id="p-track" tabindex="0" role="region" aria-label="Daftar proyek, geser ke samping">
            @foreach ($projects as $p)
                @php
                    $tech    = $p['tech_stack'] ?? [];
                    $shown   = array_slice($tech, 0, 4);
                    $extra   = max(0, count($tech) - count($shown));
                    $cat     = $p['category'] ?? 'lainnya';
                    $href    = $p['demo_url'] ?? ($p['repo_url'] ?? '#');
                    $index   = $p['record_no'] ?? (($loop->iteration < 10 ? '0' : '') . $loop->iteration);
                    $hay     = strtolower($p['title'] . ' ' . ($p['description'] ?? '') . ' ' . implode(' ', $tech));
                @endphp
                <article class="pj" data-cat="{{ $cat }}" data-hay="{{ $hay }}">
                    <a class="pj-wrap" href="{{ $href }}" target="_blank" rel="noopener noreferrer" draggable="false">
                        <span class="pj-arr">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17L17 7M9 7h8v8"/></svg>
                        </span>

                        <span class="pj-img">
                            @if (!empty($p['preview_image']))
                                <img src="{{ $p['preview_image'] }}" alt="Pratinjau {{ $p['title'] }}" loading="lazy" draggable="false">
                            @else
                                <span class="pj-noimg"><i></i></span>
                            @endif
                            @if (!empty($p['is_placeholder']))
                                <span class="pj-tag-exam">[CONTOH]</span>
                            @endif
                        </span>
                        <span class="pj-body">
                            <span class="pj-meta">
                                <span class="pj-cat">{{ $p['category_label'] ?? $cat }}</span>
                                <span class="pj-year">{{ $index }} · {{ $p['year'] ?? '—' }}</span>
                            </span>
                            <h3 class="pj-title font-display">{{ $p['title'] }}</h3>
                            <span class="pj-desc">{!! e($limit($p['description'] ?? '', 110)) !!}</span>
                            @if (count($shown))
                                <span class="pj-tech">
                                    @foreach ($shown as $t)<span>{{ $t }}</span>@endforeach
                                    @if ($extra)<span>+{{ $extra }}</span>@endif
                                </span>
                            @endif
                        </span>
                    </a>
                </article>
            @endforeach
        </div>

        <!-- Progress + panah -->
        <div class="p-foot">
            <div class="p-progress" id="p-progress" aria-hidden="true"><span class="p-thumb" id="p-thumb"></span></div>
            <div class="p-nav">
                <button type="button" class="p-arrow" id="p-prev" aria-label="Geser ke kiri">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
                </button>
                <button type="button" class="p-arrow" id="p-next" aria-label="Geser ke kanan">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
                </button>
            </div>
        </div>

        <div class="p-empty" id="p-empty">// tidak ada proyek yang cocok — coba kata lain</div>

    </div>
</section>

@verbatim
<script>
(function () {
    var sec = document.getElementById('projects');
    if (!sec) return;
    var track    = document.getElementById('p-track');
    var cards    = Array.prototype.slice.call(sec.querySelectorAll('.pj'));
    var btns     = Array.prototype.slice.call(sec.querySelectorAll('.p-btn'));
    var countEl  = document.getElementById('p-count');
    var emptyEl  = document.getElementById('p-empty');
    var search   = document.getElementById('p-search');
    var prev     = document.getElementById('p-prev');
    var next     = document.getElementById('p-next');
    var progress = document.getElementById('p-progress');
    var thumb    = document.getElementById('p-thumb');
    var curCat   = 'all';
    var reduce   = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (!cards.length) {
        if (countEl) countEl.style.display = 'none';
        sec.querySelector('.p-foot').style.display = 'none';
        return;
    }

    /* ---------- progress, panah, dan efek skala saat digeser ---------- */
    var ticking = false;
    function update() {
        ticking = false;
        var max = track.scrollWidth - track.clientWidth;
        var sl  = track.scrollLeft;
        var hasScroll = max > 4;

        prev.disabled = !hasScroll || sl <= 2;
        next.disabled = !hasScroll || sl >= max - 2;
        progress.style.opacity = hasScroll ? 1 : 0;

        var w = Math.max((track.clientWidth / track.scrollWidth) * 100, 10);
        thumb.style.width = w + '%';
        thumb.style.left  = (hasScroll ? (sl / max) * (100 - w) : 0) + '%';

        var tb = track.getBoundingClientRect(), mid = tb.left + tb.width / 2;
        cards.forEach(function (c) {
            if (c.classList.contains('is-off')) return;
            if (!hasScroll || reduce) { c.style.setProperty('--s', 1); c.style.setProperty('--o', 1); return; }
            var r = c.getBoundingClientRect();
            var d = Math.min(Math.abs(r.left + r.width / 2 - mid) / (tb.width / 2 + r.width / 2), 1);
            d = d * d;
            c.style.setProperty('--s', (1 - d * .06).toFixed(3));
            c.style.setProperty('--o', (1 - d * .35).toFixed(3));
        });
    }
    function queue() { if (!ticking) { ticking = true; requestAnimationFrame(update); } }
    track.addEventListener('scroll', queue, { passive: true });
    window.addEventListener('resize', queue);

    function step(dir) {
        var first = cards.filter(function (c) { return !c.classList.contains('is-off'); })[0];
        var amount = first ? first.getBoundingClientRect().width + 19 : track.clientWidth * .8;
        track.scrollBy({ left: dir * amount, behavior: reduce ? 'auto' : 'smooth' });
    }
    prev.addEventListener('click', function () { step(-1); });
    next.addEventListener('click', function () { step(1); });

    /* ---------- drag dengan mouse ---------- */
    var down = false, sx = 0, sl0 = 0, moved = 0;
    track.addEventListener('pointerdown', function (e) {
        if (e.pointerType !== 'mouse' || e.button !== 0) return;
        down = true; moved = 0; sx = e.clientX; sl0 = track.scrollLeft;
    });
    window.addEventListener('pointermove', function (e) {
        if (!down) return;
        var dx = e.clientX - sx;
        moved = Math.max(moved, Math.abs(dx));
        if (moved > 5) { track.classList.add('is-drag'); track.scrollLeft = sl0 - dx; }
    });
    window.addEventListener('pointerup', function () {
        if (!down) return;
        down = false; track.classList.remove('is-drag');
    });
    track.addEventListener('click', function (e) {
        if (moved > 5) { e.preventDefault(); e.stopPropagation(); moved = 0; }
    }, true);
    track.addEventListener('dragstart', function (e) { e.preventDefault(); });

    /* ---------- filter + cari ---------- */
    function apply() {
        var q = (search && search.value || '').trim().toLowerCase();
        var shown = 0;
        cards.forEach(function (c) {
            var ok = (curCat === 'all' || c.dataset.cat === curCat) &&
                     (q === '' || (c.dataset.hay || '').indexOf(q) !== -1);
            c.classList.toggle('is-off', !ok);
            if (ok) shown++;
        });
        countEl.innerHTML = '<b>' + shown + '</b> dari ' + cards.length;
        emptyEl.classList.toggle('is-on', shown === 0);
        track.style.display = shown === 0 ? 'none' : '';
        track.scrollLeft = 0;
        queue();
    }

    function replay() {
        if (reduce) return;
        var vis = cards.filter(function (c) { return !c.classList.contains('is-off'); });
        vis.forEach(function (c) { c.classList.remove('show'); c.style.transitionDelay = '0ms'; });
        requestAnimationFrame(function () {
            requestAnimationFrame(function () {
                vis.forEach(function (c, i) {
                    c.style.transitionDelay = (Math.min(i, 5) * 70) + 'ms';
                    c.classList.add('show');
                });
            });
        });
    }

    btns.forEach(function (b) {
        b.addEventListener('click', function () {
            btns.forEach(function (o) {
                o.classList.toggle('is-on', o === b);
                o.setAttribute('aria-pressed', o === b ? 'true' : 'false');
            });
            curCat = b.dataset.filter;
            apply(); replay();
        });
    });
    if (search) search.addEventListener('input', function () { apply(); replay(); });

    /* ---------- muncul dari samping saat section terlihat ---------- */
    if ('IntersectionObserver' in window && !reduce) {
        var io = new IntersectionObserver(function (es) {
            es.forEach(function (e) {
                if (!e.isIntersecting) return;
                io.disconnect();
                cards.forEach(function (c, i) {
                    c.style.transitionDelay = (Math.min(i, 5) * 90) + 'ms';
                    c.classList.add('show');
                });
            });
        }, { threshold: .1 });
        io.observe(sec);
    } else {
        cards.forEach(function (c) { c.classList.add('show'); });
    }

    apply();
})();
</script>
@endverbatim