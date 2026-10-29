@props(['profile'])

{{-- Palet: #0B2447  #19376D  #576CBC  #A5D7E8 (sama dengan #hero, #skills, #projects, #journey, #contact) --}}

@verbatim
<style>
    /* ===== ABOUT ===== */
    #about { background: #0B2447; position: relative; overflow: hidden; scroll-margin-top: 5rem; }
    /* glow lembut — memudar di tepi atas & bawah agar menyatu dengan section lain */
    #about::before {
        content: ""; position: absolute; inset: 0; pointer-events: none;
        background:
            radial-gradient(620px circle at 92% 10%, rgba(87,108,188,.18), transparent 62%),
            radial-gradient(520px circle at 6% 88%, rgba(25,55,109,.5), transparent 64%);
        -webkit-mask-image: linear-gradient(to bottom, transparent 0, #000 20%, #000 78%, transparent 100%);
                mask-image: linear-gradient(to bottom, transparent 0, #000 20%, #000 78%, transparent 100%);
    }
    #about > * { position: relative; z-index: 1; }

    #about .a-eyebrow { font-family: ui-monospace, monospace; font-size: .7rem; letter-spacing: .22em; text-transform: uppercase; color: #576CBC; }
    #about .a-title { font-weight: 600; letter-spacing: .01em; line-height: 1.3; color: #F2FAFF; font-size: clamp(1.75rem, 3.6vw, 2.5rem); }

    #about .a-grid { display: grid; grid-template-columns: minmax(0,1fr); gap: 3rem; align-items: start; }
    @media (min-width: 1024px) { #about .a-grid { grid-template-columns: 5fr 7fr; gap: 4rem; } }

    /* ---- Foto ---- */
    #about .a-photo { position: relative; max-width: 28rem; margin: 0 auto; }
    @media (min-width: 1024px) { #about .a-photo { max-width: none; } }
    #about .a-frame {
        position: relative; padding: .5rem; border-radius: 1.15rem;
        background: rgba(25,55,109,.38); border: 1px solid rgba(87,108,188,.28);
        transition: border-color .45s, box-shadow .45s;
    }
    #about .a-frame:hover { border-color: rgba(165,215,232,.45); box-shadow: 0 24px 48px -28px rgba(0,0,0,.85); }
    #about .a-img { position: relative; overflow: hidden; border-radius: .8rem; aspect-ratio: 1 / 1; }
    #about .a-img img {
        width: 100%; height: 100%; object-fit: cover; object-position: center; display: block;
        filter: grayscale(.55) contrast(1.05);
        transition: filter .8s ease, transform .9s cubic-bezier(.2,.7,.2,1);
    }
    #about .a-frame:hover .a-img img { filter: grayscale(0) contrast(1); transform: scale(1.05); }
    #about .a-img::after { content: ""; position: absolute; inset: 0; pointer-events: none; background: linear-gradient(to top, rgba(11,36,71,.5), transparent 55%); }
    /* sudut dekoratif */
    #about .a-corner { position: absolute; width: 1.4rem; height: 1.4rem; pointer-events: none; transition: transform .45s cubic-bezier(.2,.7,.2,1); }
    #about .a-corner.tl { top: -.45rem; left: -.45rem; border-top: 2px solid #576CBC; border-left: 2px solid #576CBC; border-top-left-radius: .4rem; }
    #about .a-corner.br { bottom: -.45rem; right: -.45rem; border-bottom: 2px solid #A5D7E8; border-right: 2px solid #A5D7E8; border-bottom-right-radius: .4rem; }
    #about .a-frame:hover .a-corner.tl { transform: translate(-3px, -3px); }
    #about .a-frame:hover .a-corner.br { transform: translate(3px, 3px); }

    /* ---- Info singkat ---- */
    #about .a-meta { margin-top: 1.25rem; padding: .35rem 1.15rem; border-radius: 1rem; background: rgba(25,55,109,.3); border: 1px solid rgba(87,108,188,.22); }
    #about .a-row { display: flex; align-items: center; justify-content: space-between; gap: 1rem; padding: .8rem 0; font-family: ui-monospace, monospace; font-size: .72rem; }
    #about .a-row + .a-row { border-top: 1px solid rgba(87,108,188,.18); }
    #about .a-key { letter-spacing: .14em; text-transform: uppercase; color: rgba(165,215,232,.5); }
    #about .a-val { color: #EAF6FC; text-align: right; }
    #about .a-val.live { display: inline-flex; align-items: center; gap: .5rem; }
    #about .a-val.live::before { content: ""; width: .42rem; height: .42rem; border-radius: 9999px; background: #34d399; box-shadow: 0 0 0 3px rgba(52,211,153,.18); }

    /* ---- Teks ---- */
    #about .a-lead { font-size: 1.05rem; font-weight: 500; line-height: 1.85; letter-spacing: .005em; color: #DDF0F7; }
    #about .a-text { font-size: .92rem; line-height: 1.9; letter-spacing: .005em; color: rgba(165,215,232,.7); }

    /* ---- Kartu sorotan ---- */
    #about .a-cards { display: grid; grid-template-columns: minmax(0,1fr); gap: 1rem; margin-top: 2rem; padding-top: 2rem; border-top: 1px dashed rgba(87,108,188,.28); }
    @media (min-width: 640px) { #about .a-cards { grid-template-columns: 1fr 1fr; } }
    #about .a-card {
        position: relative; overflow: hidden; padding: 1.15rem 1.2rem 1.2rem; border-radius: 1rem;
        background: rgba(25,55,109,.34); border: 1px solid rgba(87,108,188,.22);
        transition: transform .45s cubic-bezier(.2,.7,.2,1), border-color .45s, background .45s, box-shadow .45s;
    }
    #about .a-card::after {
        content: ""; position: absolute; left: 0; right: 0; top: 0; height: 2px;
        background: linear-gradient(90deg, #576CBC, #A5D7E8);
        transform: scaleX(0); transform-origin: left; transition: transform .5s cubic-bezier(.2,.7,.2,1);
    }
    #about .a-card:hover { transform: translateY(-5px); border-color: rgba(165,215,232,.38); background: rgba(25,55,109,.55); box-shadow: 0 18px 36px -22px rgba(0,0,0,.8); }
    #about .a-card:hover::after { transform: scaleX(1); }
    #about .a-card-k { display: block; font-family: ui-monospace, monospace; font-size: .64rem; letter-spacing: .18em; text-transform: uppercase; color: #576CBC; margin-bottom: .5rem; }
    #about .a-card-t { font-size: .95rem; font-weight: 600; line-height: 1.4; color: #F2FAFF; }
    #about .a-card-p { margin-top: .4rem; font-size: .78rem; line-height: 1.75; color: rgba(165,215,232,.62); }

    /* ---- Muncul bertahap ---- */
    #about .a-reveal { opacity: 0; transform: translateY(20px); }
    #about .a-reveal.is-in { opacity: 1; transform: none; transition: opacity .75s cubic-bezier(.2,.7,.2,1), transform .75s cubic-bezier(.2,.7,.2,1), border-color .45s, background .45s, box-shadow .45s; }
    #about .a-card.a-reveal.is-in:hover { transform: translateY(-5px); }

    @media (prefers-reduced-motion: reduce) {
        #about * { transition: none !important; animation: none !important; }
        #about .a-reveal { opacity: 1 !important; transform: none !important; }
    }
</style>
@endverbatim

<section id="about" class="py-24 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">

        <div class="a-grid">

            <!-- Kiri: foto + info singkat -->
            <div class="a-photo">
                <div class="a-frame a-reveal">
                    <span class="a-corner tl" aria-hidden="true"></span>
                    <span class="a-corner br" aria-hidden="true"></span>
                    <div class="a-img">
                        <img src="{{ $profile['avatar_url'] }}"
                             alt="Foto profil {{ $profile['name'] ?? '' }}"
                             loading="lazy">
                    </div>
                </div>

                <div class="a-meta a-reveal">
                    <div class="a-row">
                        <span class="a-key">Status</span>
                        <span class="a-val live">{{ $profile['status'] }}</span>
                    </div>
                    <div class="a-row">
                        <span class="a-key">Lokasi</span>
                        <span class="a-val">{{ $profile['location'] }}</span>
                    </div>
                    <div class="a-row">
                        <span class="a-key">Bidang</span>
                        <span class="a-val">Web Engineering &amp; Design</span>
                    </div>
                </div>
            </div>

            <!-- Kanan: cerita -->
            <div class="flex flex-col">
                <div class="a-reveal">
                    <div class="a-eyebrow mb-4">// 01. Tentang Saya</div>
                    <h2 class="a-title font-display">Membangun website dengan ketelitian kode dan rasa estetika.</h2>
                </div>

                <div class="mt-8 space-y-5">
                    <p class="a-lead a-reveal">{{ $profile['bio_story'] }}</p>
                    <p class="a-text a-reveal">
                        Sebagai seorang pelajar, motivasi terbesar saya adalah memahami arsitektur internal di balik website yang solid — dari perancangan database terstruktur hingga animasi interaktif yang tidak memperlambat perangkat pengguna.
                    </p>
                    <p class="a-text a-reveal">{{ $profile['learning_focus'] }}</p>
                </div>

                <div class="a-cards">
                    <div class="a-card a-reveal">
                        <span class="a-card-k">Pendidikan</span>
                        <h3 class="a-card-t">{{ $profile['education'] }}</h3>
                        <p class="a-card-p">Mengasah logika pemrograman, algoritma data, dan web modern.</p>
                    </div>

                    <div class="a-card a-reveal">
                        <span class="a-card-k">Prinsip Belajar</span>
                        <h3 class="a-card-t">Clean Code &amp; User-Centric</h3>
                        <p class="a-card-p">Mengutamakan keterbacaan kode, keamanan data, dan kepuasan pengguna.</p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

@verbatim
<script>
(function () {
    var sec = document.getElementById('about');
    if (!sec) return;
    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var items = Array.prototype.slice.call(sec.querySelectorAll('.a-reveal'));

    if ('IntersectionObserver' in window && !reduce) {
        var io = new IntersectionObserver(function (es) {
            es.forEach(function (e) {
                if (!e.isIntersecting) return;
                var i = items.indexOf(e.target);
                e.target.style.transitionDelay = ((i % 4) * 80) + 'ms';
                e.target.classList.add('is-in');
                io.unobserve(e.target);
                /* hapus delay setelah masuk agar hover tetap responsif */
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