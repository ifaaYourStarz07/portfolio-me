@props(['skills' => []])

@php
    // ===== DATA — sunting di sini =====
    $eyebrow  = '03. Keahlian Teknis';
    $title    = 'Skillset & Kerangka Kerja';
    $subtitle = 'Bidang yang sedang saya pelajari dan perdalam melalui latihan serta pembuatan proyek nyata.';
    $footnote = 'Seluruh bidang di atas masih terus dipelajari dan diperdalam.';

    // Tiap item: ['name' => '...', 'sub' => '...' (opsional)]
    $groups = [
        [
            'name'  => 'Frontend Developer',
            'desc'  => 'Membangun antarmuka yang rapi, responsif, dan nyaman digunakan.',
            'items' => [
                ['name' => 'HTML'],
                ['name' => 'CSS'],
                ['name' => 'JavaScript'],
                ['name' => 'Tailwind CSS'],
            ],
        ],
        [
            'name'  => 'Backend Developer',
            'desc'  => 'Mengembangkan logika aplikasi, API, dan pengelolaan basis data.',
            'items' => [
                ['name' => 'Laravel Framework'],
                ['name' => 'REST API'],
                ['name' => 'PHP'],
                ['name' => 'SQL', 'sub' => 'MySQL · PostgreSQL'],
            ],
        ],
        [
            'name'  => 'Tools',
            'desc'  => 'Perangkat yang mendukung alur kerja pengembangan sehari-hari.',
            'items' => [
                ['name' => 'Git & GitHub'],
                ['name' => 'Visual Studio Code'],
                ['name' => 'Composer'],
                ['name' => 'Postman'],
            ],
        ],
    ];
@endphp

{{-- Palet: #0B2447  #19376D  #576CBC  #A5D7E8 (sama dengan #hero, #projects, #journey, #contact) --}}

@verbatim
<style>
    /* ===== SKILLS ===== */
    #skills { background: #0B2447; position: relative; overflow: hidden; scroll-margin-top: 5rem; }
    /* glow lembut — memudar di tepi atas & bawah agar menyatu dengan section lain */
    #skills::before {
        content: ""; position: absolute; inset: 0; pointer-events: none;
        background:
            radial-gradient(620px circle at 8% 14%, rgba(87,108,188,.16), transparent 62%),
            radial-gradient(520px circle at 94% 84%, rgba(25,55,109,.5), transparent 64%);
        -webkit-mask-image: linear-gradient(to bottom, transparent 0, #000 20%, #000 78%, transparent 100%);
                mask-image: linear-gradient(to bottom, transparent 0, #000 20%, #000 78%, transparent 100%);
    }
    #skills > * { position: relative; z-index: 1; }

    #skills .s-eyebrow { font-family: ui-monospace, monospace; font-size: .7rem; letter-spacing: .22em; text-transform: uppercase; color: #576CBC; }
    #skills .s-title { font-weight: 600; letter-spacing: .01em; line-height: 1.2; color: #F2FAFF; font-size: clamp(1.75rem, 3.6vw, 2.5rem); }
    #skills .s-lead { margin-top: .8rem; font-size: .88rem; line-height: 1.8; letter-spacing: .005em; color: rgba(165,215,232,.7); max-width: 34rem; }

    /* ---- Grid kartu ---- */
    #skills .s-grid { display: grid; grid-template-columns: minmax(0,1fr); gap: 1.25rem; margin-top: 3.25rem; }
    @media (min-width: 768px)  { #skills .s-grid { grid-template-columns: repeat(3, minmax(0,1fr)); gap: 1.4rem; } }

    #skills .s-card {
        position: relative; overflow: hidden; padding: 1.6rem 1.6rem 1.35rem; border-radius: 1.15rem;
        background: rgba(25,55,109,.34); border: 1px solid rgba(87,108,188,.22);
        transition: transform .45s cubic-bezier(.2,.7,.2,1), border-color .45s, background .45s, box-shadow .45s;
    }
    #skills .s-card::after {
        content: ""; position: absolute; left: 0; right: 0; top: 0; height: 2px;
        background: linear-gradient(90deg, #576CBC, #A5D7E8);
        transform: scaleX(0); transform-origin: left; transition: transform .5s cubic-bezier(.2,.7,.2,1);
    }
    #skills .s-card:hover { transform: translateY(-5px); border-color: rgba(165,215,232,.38); background: rgba(25,55,109,.55); box-shadow: 0 20px 40px -22px rgba(0,0,0,.8); }
    #skills .s-card:hover::after { transform: scaleX(1); }

    #skills .s-num { font-family: ui-monospace, monospace; font-size: .66rem; letter-spacing: .2em; color: #576CBC; font-variant-numeric: tabular-nums; }
    #skills .s-name { margin-top: .55rem; font-size: 1.1rem; font-weight: 600; letter-spacing: .005em; line-height: 1.3; color: #F2FAFF; }
    #skills .s-desc { margin-top: .5rem; font-size: .8rem; line-height: 1.75; color: rgba(165,215,232,.62); }

    /* ---- Daftar item (tanpa level, hanya nama) ---- */
    #skills .s-list { list-style: none; margin: 1.4rem 0 0; padding: 0; }
    #skills .s-item {
        display: flex; align-items: center; gap: .8rem; padding: .78rem 0;
        border-top: 1px solid rgba(87,108,188,.18);
    }
    #skills .s-dot {
        flex: none; width: .45rem; height: .45rem; border-radius: 9999px;
        border: 1.5px solid rgba(87,108,188,.75); background: transparent;
        transition: background .3s, border-color .3s, box-shadow .3s, transform .3s;
    }
    #skills .s-iname { font-size: .88rem; font-weight: 500; color: #EAF6FC; transition: color .3s, transform .3s; }
    #skills .s-isub { margin-left: auto; font-family: ui-monospace, monospace; font-size: .64rem; letter-spacing: .04em; color: rgba(165,215,232,.5); text-align: right; }
    #skills .s-item:hover .s-dot { background: #A5D7E8; border-color: #A5D7E8; box-shadow: 0 0 10px rgba(165,215,232,.65); transform: scale(1.15); }
    #skills .s-item:hover .s-iname { color: #A5D7E8; transform: translateX(3px); }

    #skills .s-foot {
        margin-top: 2.75rem; text-align: center; font-family: ui-monospace, monospace;
        font-size: .7rem; letter-spacing: .06em; color: rgba(165,215,232,.5);
    }

    /* ---- Muncul bertahap ---- */
    #skills .s-reveal { opacity: 0; transform: translateY(20px); }
    #skills .s-reveal.is-in { opacity: 1; transform: none; transition: opacity .75s cubic-bezier(.2,.7,.2,1), transform .75s cubic-bezier(.2,.7,.2,1), border-color .45s, background .45s, box-shadow .45s; }
    #skills .s-card.s-reveal.is-in:hover { transform: translateY(-5px); }
    #skills .s-item { opacity: 0; transform: translateX(-8px); }
    #skills .is-in .s-item { opacity: 1; transform: none; transition: opacity .6s ease-out, transform .6s cubic-bezier(.2,.7,.2,1); transition-delay: calc(var(--i) * 70ms + 250ms); }

    @media (prefers-reduced-motion: reduce) {
        #skills * { transition: none !important; animation: none !important; }
        #skills .s-reveal, #skills .s-item { opacity: 1 !important; transform: none !important; }
    }
</style>
@endverbatim

<section id="skills" class="py-24 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">

        <!-- Header -->
        <header class="s-reveal">
            <div class="s-eyebrow mb-4">// {{ $eyebrow }}</div>
            <h2 class="s-title font-display">{{ $title }}</h2>
            <p class="s-lead">{{ $subtitle }}</p>
        </header>

        <!-- Kartu keahlian -->
        <div class="s-grid">
            @foreach ($groups as $g => $group)
                <article class="s-card s-reveal">
                    <div class="s-num">{{ str_pad((string) ($g + 1), 2, '0', STR_PAD_LEFT) }}</div>
                    <h3 class="s-name font-display">{{ $group['name'] }}</h3>
                    <p class="s-desc">{{ $group['desc'] }}</p>

                    <ul class="s-list">
                        @foreach ($group['items'] as $j => $item)
                            <li class="s-item" style="--i: {{ $j }}">
                                <span class="s-dot"></span>
                                <span class="s-iname">{{ $item['name'] }}</span>
                                @if (!empty($item['sub']))
                                    <span class="s-isub">{{ $item['sub'] }}</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </article>
            @endforeach
        </div>

        <p class="s-foot s-reveal">{{ $footnote }}</p>

    </div>
</section>

@verbatim
<script>
(function () {
    var sec = document.getElementById('skills');
    if (!sec) return;
    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var items = Array.prototype.slice.call(sec.querySelectorAll('.s-reveal'));

    if ('IntersectionObserver' in window && !reduce) {
        var io = new IntersectionObserver(function (es) {
            es.forEach(function (e) {
                if (!e.isIntersecting) return;
                var i = items.indexOf(e.target);
                e.target.style.transitionDelay = (Math.min(i, 5) * 90) + 'ms';
                e.target.classList.add('is-in');
                io.unobserve(e.target);
                /* setelah animasi masuk selesai, hapus delay agar hover tetap responsif */
                setTimeout(function () { e.target.style.transitionDelay = ''; }, 1100);
            });
        }, { threshold: .15 });
        items.forEach(function (n) { io.observe(n); });
    } else {
        items.forEach(function (n) { n.classList.add('is-in'); });
    }
})();
</script>
@endverbatim