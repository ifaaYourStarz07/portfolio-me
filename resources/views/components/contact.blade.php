@props(['profile', 'socialLinks'])

@php
    // ===== DATA — sunting di sini =====
    $name     = $profile['name'] ?? 'Tifayatul Husna Azahra';
    $first    = explode(' ', $name)[0];
    $email    = $profile['email'] ?? 'tifayatul.khusna07@gmail.com';
    $location = $profile['location'] ?? 'Bandung, Indonesia';
    $links    = $socialLinks ?? [];

    /*
    |============================================================================
    | ICON SET (path logo dari Simple Icons, CC0)
    | Key yang tersedia: github, instagram, linkedin, x / twitter, whatsapp,
    | tiktok, youtube, dribbble, behance, telegram
    | Tiap key menyimpan: [tipe, path SVG, warna brand (hex)]
    |============================================================================
    | Cara pakai di data $socialLinks:
    | ['name' => 'GitHub', 'handle' => '@tifayatul', 'url' => '...', 'icon' => 'github']
    | ['name' => 'Dribbble','handle' => 'tifayatul', 'url' => '...', 'icon_url' => 'images/social/dribbble.png']
    |
    | -> 'icon'     = pakai ikon bawaan di bawah (kalau kosong, dicocokkan dari 'name')
    | -> 'icon_url' = pakai GAMBAR kamu sendiri dari folder public/
    | -> dua-duanya kosong & nama tak dikenal = inisial 2 huruf
    */
    $icons = [
        'github'    => ['b', '__PATH_LOGO__', '181717'],
        'instagram' => ['b', '__PATH_LOGO__', 'E4405F'],
        'linkedin'  => ['b', '__PATH_LOGO__', '0A66C2'],
        'x'         => ['b', '__PATH_LOGO__', '000000'],
        'twitter'   => ['b', '__PATH_LOGO__', '000000'],
        'whatsapp'  => ['b', '__PATH_LOGO__', '25D366'],
        'tiktok'    => ['b', '__PATH_LOGO__', '000000'],
        'youtube'   => ['b', '__PATH_LOGO__', 'FF0000'],
        'dribbble'  => ['b', '__PATH_LOGO__', 'ea4c89'],
        'behance'   => ['b', '__PATH_LOGO__', '1769ff'],
        'telegram'  => ['b', '__PATH_LOGO__', '26A5E4'],
    ];
    // envelope (gaya stroke, selaras dengan ikon lain secara visual)
    $mailIcon = '<path d="M3.5 6.5h17v11h-17z" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="M4.5 7.5l7.5 5.5 7.5-5.5" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>';

    $brandFg = function ($hex) {
        $hex = ltrim((string) $hex, '#');
        if (strlen($hex) !== 6 || !ctype_xdigit($hex)) {
            return '#F2FAFF';
        }

        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
        $luminance = (0.299 * $r) + (0.587 * $g) + (0.114 * $b);

        return $luminance > 155 ? '#0B2447' : '#F2FAFF';
    };

    $resolveIcon = function (array $link) use ($icons, $mailIcon) {
        $name = $link['name'] ?? '';
        $key  = strtolower(trim($link['icon'] ?? ''));
        if ($key === '') {
            $key = strtolower(preg_replace('/[^A-Za-z]/', '', $name));
        }

        // 1) GAMBAR milikmu sendiri -> 'icon_url' => 'images/social/nama.png'
        if (!empty($link['icon_url'])) {
            return ['img', asset($link['icon_url']), null, null];
        }
        // 2) ikon brand bawaan (+ warna aslinya untuk aksen hover)
        if (isset($icons[$key]) && $icons[$key][1] !== '__PATH_LOGO__') {
            return ['svg', '<path fill="currentColor" d="' . $icons[$key][1] . '"/>',
                    isset($icons[$key][2]) ? $icons[$key][2] : null];
        }

        // Ikon bawaan masih placeholder? Gunakan inisial agar SVG tidak rusak.
        if (isset($icons[$key]) && $icons[$key][1] === '__PATH_LOGO__') {
            return ['text', strtoupper(substr(preg_replace('/[^A-Za-z0-9]/', '', $name) ?: '?', 0, 2)),
                    isset($icons[$key][2]) ? $icons[$key][2] : null];
        }
        // 3) email
        if (in_array($key, ['email', 'mail', 'surel'], true) || strpos(strtolower($name), 'email') !== false) {
            return ['svg', $mailIcon, null];
        }
        // 4) tidak dikenal -> inisial 2 huruf
        return ['text', strtoupper(substr(preg_replace('/[^A-Za-z0-9]/', '', $name) ?: '?', 0, 2)), null];
    };
@endphp

{{-- Palet: #0B2447  #19376D  #576CBC  #A5D7E8 --}}

@verbatim
<style>
    #contact { background: #0B2447; position: relative; overflow: hidden; scroll-margin-top: 5rem; }
    #contact::before {
        content: ""; position: absolute; inset: 0; pointer-events: none;
        background:
            radial-gradient(640px circle at 12% 0%, rgba(87,108,188,.22), transparent 60%),
            radial-gradient(520px circle at 92% 88%, rgba(25,55,109,.6), transparent 62%);
        /* memudar di tepi atas & bawah agar menyatu mulus dengan section sebelumnya */
        -webkit-mask-image: linear-gradient(to bottom, transparent 0, #000 22%, #000 80%, transparent 100%);
                mask-image: linear-gradient(to bottom, transparent 0, #000 22%, #000 80%, transparent 100%);
    }
    #contact > * { position: relative; z-index: 1; }

    #contact .c-eyebrow { font-family: ui-monospace, monospace; font-size: .7rem; letter-spacing: .22em; text-transform: uppercase; color: #576CBC; }
    /* judul: lebih ringan & lega (sebelumnya terlalu tebal/rapat) */
    #contact .c-title { font-weight: 600; letter-spacing: .01em; line-height: 1.2; color: #F2FAFF; font-size: clamp(1.75rem, 3.6vw, 2.5rem); }
    #contact .c-lead { margin-top: 1rem; font-size: .92rem; line-height: 1.85; letter-spacing: .005em; color: rgba(165,215,232,.7); max-width: 34rem; }

    #contact .c-grid { display: grid; grid-template-columns: minmax(0,1fr); gap: 2.75rem; margin-top: 3rem; }
    @media (min-width: 1024px) { #contact .c-grid { grid-template-columns: 5fr 7fr; gap: 3rem; } }

    /* ---- Email + salin ---- */
    #contact .c-mail {
        position: relative; display: flex; flex-wrap: wrap; align-items: center; gap: 1rem;
        padding: 1rem 1.1rem; border-radius: 1rem; margin-bottom: 1.2rem;
        background: rgba(25,55,109,.42); border: 1px solid rgba(87,108,188,.28);
        transition: border-color .35s, background .35s;
    }
    #contact .c-mail:hover { border-color: rgba(165,215,232,.4); background: rgba(25,55,109,.6); }
    #contact .c-mail-label { font-family: ui-monospace, monospace; font-size: .62rem; letter-spacing: .18em; text-transform: uppercase; color: #576CBC; display: block; margin-bottom: .25rem; }
    #contact .c-mail-addr { font-size: .98rem; font-weight: 600; color: #F2FAFF; word-break: break-all; }
    #contact .c-copy {
        margin-left: auto; flex: none; display: inline-flex; align-items: center; gap: .4rem; cursor: pointer;
        padding: .5rem .8rem; border-radius: .7rem; font-size: .74rem; font-weight: 600;
        color: #A5D7E8; background: rgba(11,36,71,.7); border: 1px solid rgba(87,108,188,.4);
        transition: color .3s, border-color .3s, transform .3s;
    }
    #contact .c-copy:hover { transform: translateY(-2px); border-color: #A5D7E8; color: #F2FAFF; }
    #contact .c-copy svg { width: 14px; height: 14px; }
    #contact .c-copy .ok { display: none; }
    #contact .c-copy.is-done { color: #6ee7b7; border-color: rgba(110,231,183,.5); }
    #contact .c-copy.is-done .ok { display: block; } #contact .c-copy.is-done .idle { display: none; }

    /* ---- Tiles sosial ---- */
    #contact .c-social { display: grid; grid-template-columns: repeat(2, minmax(0,1fr)); gap: .8rem; }
    @media (min-width: 560px) { #contact .c-social { grid-template-columns: repeat(3, minmax(0,1fr)); } }
    /* baris terakhir tidak penuh -> tile terakhir melebar mengisi ruang */
    @media (max-width: 559px) { #contact .c-link:last-child:nth-child(2n + 1) { grid-column: span 2; } }
    @media (min-width: 560px) {
        #contact .c-link:last-child:nth-child(3n + 1) { grid-column: span 3; }
        #contact .c-link:last-child:nth-child(3n + 2) { grid-column: span 2; }
    }
    #contact .c-link {
        position: relative; overflow: hidden; display: flex; flex-direction: column; gap: .55rem;
        padding: .8rem .85rem .75rem; border-radius: .95rem; text-decoration: none;
        background: rgba(25,55,109,.3); border: 1px solid rgba(87,108,188,.22);
        transition: transform .4s cubic-bezier(.2,.7,.2,1), border-color .4s, background .4s, box-shadow .4s;
    }
    #contact .c-link::after {
        content: ""; position: absolute; left: 0; right: 0; bottom: 0; height: 2px;
        background: linear-gradient(90deg, #576CBC, #A5D7E8);
        transform: scaleX(0); transform-origin: left; transition: transform .45s cubic-bezier(.2,.7,.2,1);
    }
    #contact .c-link:hover { transform: translateY(-5px); border-color: rgba(165,215,232,.38); background: rgba(25,55,109,.55); box-shadow: 0 18px 34px -20px rgba(0,0,0,.8); }
    #contact .c-link:hover::after { transform: scaleX(1); }
    #contact .c-ico {
        width: 2rem; height: 2rem; border-radius: .6rem; display: grid; place-items: center; flex: none;
        color: #A5D7E8; background: rgba(11,36,71,.75); border: 1px solid rgba(87,108,188,.35);
        transition: color .35s, background .35s, transform .35s, border-color .35s;
    }
    #contact .c-ico svg { width: 16px; height: 16px; display: block; }
    #contact .c-ico img { width: 18px; height: 18px; object-fit: contain; display: block; }
    #contact .c-ico .ini { font-family: ui-monospace, monospace; font-size: .68rem; font-weight: 700; }
    #contact .c-link:hover .c-ico {
        color: var(--brand-fg, #F2FAFF); background: var(--brand, #576CBC); border-color: transparent;
        transform: scale(1.08) rotate(-4deg);
    }
    #contact .c-nm { font-size: .8rem; font-weight: 600; color: #F2FAFF; line-height: 1.2; }
    #contact .c-hd {
        font-family: ui-monospace, monospace; font-size: .66rem; color: rgba(165,215,232,.55);
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }
    #contact .c-arrow {
        position: absolute; top: .8rem; right: .8rem; color: rgba(165,215,232,.35);
        transition: color .35s, transform .35s;
    }
    #contact .c-link:hover .c-arrow { color: #A5D7E8; transform: translate(2px, -2px); }

    #contact .c-note {
        display: flex; align-items: center; gap: .6rem; margin-top: 1.6rem; padding-top: 1.1rem;
        border-top: 1px dashed rgba(87,108,188,.26); font-family: ui-monospace, monospace;
        font-size: .68rem; color: rgba(165,215,232,.45);
    }
    #contact .c-note svg { width: 13px; height: 13px; flex: none; color: #576CBC; }

    /* ---- Form ---- */
    #contact form {
        padding: 1.4rem 1.35rem 1.45rem; border-radius: 1.35rem;
        background: rgba(25,55,109,.34); border: 1px solid rgba(87,108,188,.24);
    }
    #contact .f-head { font-size: .95rem; font-weight: 700; color: #F2FAFF; }
    #contact .f-sub { font-size: .74rem; color: rgba(165,215,232,.5); margin-top: .25rem; margin-bottom: 1.35rem; }
    #contact .f-row { display: grid; grid-template-columns: minmax(0,1fr); gap: 1rem; }
    @media (min-width: 640px) { #contact .f-row.two { grid-template-columns: 1fr 1fr; } }
    #contact .f-field { position: relative; }
    #contact label {
        display: block; font-family: ui-monospace, monospace; font-size: .62rem; letter-spacing: .16em;
        text-transform: uppercase; color: rgba(165,215,232,.55); margin-bottom: .45rem; transition: color .3s;
    }
    #contact .f-field:focus-within label { color: #A5D7E8; }
    #contact input, #contact textarea {
        width: 100%; padding: .7rem .85rem; border-radius: .85rem; font-size: .88rem; color: #F2FAFF;
        background: rgba(11,36,71,.55); border: 1px solid rgba(87,108,188,.28); outline: none;
        transition: border-color .3s, background .3s, box-shadow .3s;
    }
    #contact textarea { resize: vertical; min-height: 6.5rem; line-height: 1.6; }
    #contact input::placeholder, #contact textarea::placeholder { color: rgba(165,215,232,.28); }
    #contact input:focus, #contact textarea:focus {
        border-color: rgba(165,215,232,.55); background: rgba(11,36,71,.8);
        box-shadow: 0 0 0 3px rgba(87,108,188,.2);
    }
    /* garis yang melebar saat field fokus */
    #contact .f-field::after {
        content: ""; position: absolute; left: 0; right: 0; bottom: 0; height: 1.5px; border-radius: 2px;
        background: linear-gradient(90deg, #576CBC, #A5D7E8);
        transform: scaleX(0); transform-origin: left; transition: transform .4s cubic-bezier(.2,.7,.2,1);
    }
    #contact .f-field:focus-within::after { transform: scaleX(1); }

    #contact .f-alert { padding: .85rem 1rem; border-radius: .85rem; font-size: .76rem; margin-bottom: 1.1rem; }
    #contact .f-ok  { background: rgba(52,211,153,.1);  border: 1px solid rgba(52,211,153,.35);  color: #bbf7d0; }
    #contact .f-err { background: rgba(248,113,113,.09); border: 1px solid rgba(248,113,113,.35); color: #fecaca; }
    #contact .f-err ul { margin-top: .35rem; padding-left: 1.05rem; }

    #contact .f-submit {
        position: relative; overflow: hidden; width: 100%; margin-top: .35rem;
        display: inline-flex; align-items: center; justify-content: center; gap: .6rem;
        padding: .82rem 1.2rem; border-radius: .9rem; border: 0; cursor: pointer;
        font-weight: 700; font-size: .88rem; color: #fff; background: #576CBC;
        box-shadow: 0 12px 30px -14px rgba(87,108,188,.95);
        transition: background .3s, transform .25s, box-shadow .3s;
    }
    #contact .f-submit::before {
        content: ""; position: absolute; inset: 0;
        background: linear-gradient(105deg, transparent 40%, rgba(255,255,255,.28) 50%, transparent 60%);
        background-size: 250% 100%; background-position: 140% 0; transition: background-position .8s ease-out;
    }
    #contact .f-submit:hover { background: #6a7fd0; transform: translateY(-2px); }
    #contact .f-submit:hover::before { background-position: -45% 0; }
    #contact .f-submit svg { transition: transform .3s; }
    #contact .f-submit:hover svg { transform: translate(3px, -3px); }
    #contact .f-submit.is-busy { pointer-events: none; opacity: .8; }
    #contact .f-spin { display: none; width: 15px; height: 15px; border-radius: 9999px; border: 2px solid rgba(255,255,255,.35); border-top-color: #fff; animation: c-rot .7s linear infinite; }
    #contact .f-submit.is-busy .f-spin { display: block; }
    @keyframes c-rot { to { transform: rotate(360deg); } }

    /* ---- Reveal ---- */
    #contact .c-reveal { opacity: 0; transform: translateY(18px); }
    #contact .c-reveal.is-in { opacity: 1; transform: none; transition: opacity .75s cubic-bezier(.2,.7,.2,1), transform .75s cubic-bezier(.2,.7,.2,1); }

    @media (prefers-reduced-motion: reduce) {
        #contact * { transition: none !important; animation: none !important; }
        #contact .c-reveal { opacity: 1 !important; transform: none !important; }
    }
</style>
@endverbatim

<section id="contact" class="pt-24 sm:pt-28 lg:pt-32 pb-24 px-4 sm:px-6 lg:px-8">

    <div class="max-w-7xl mx-auto">

        <!-- Header -->
        <header class="flex flex-wrap items-end justify-between gap-4 c-reveal">
            <div>
                <div class="c-eyebrow mb-4">// 05. Kontak &amp; Kolaborasi</div>
                <h2 class="c-title font-display">Mari Berdiskusi</h2>
                <p class="c-lead">Apabila Anda memiliki proyek, kebutuhan pekerjaan, atau gagasan yang ingin diwujudkan, silakan kirimkan pesan atau hubungi melalui salah satu kanal berikut.</p>
            </div>
        </header>

        <div class="c-grid">

            <!-- Kanal -->
            <div>
                <!-- Email + salin -->
                <div class="c-mail c-reveal">
                    <div>
                        <span class="c-mail-label">Email Langsung</span>
                        <a href="mailto:{{ $email }}" class="c-mail-addr">{{ $email }}</a>
                        <div class="mt-1 text-[.68rem] font-mono text-[#576CBC]">{{ $location }}</div>
                    </div>
                    <button type="button" class="c-copy" data-copy="{{ $email }}" aria-label="Salin alamat email">
                        <svg class="idle" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="9" y="9" width="11" height="11" rx="2.5"/><path d="M5 15V5.5A1.5 1.5 0 0 1 6.5 4H15"/></svg>
                        <svg class="ok" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <span class="idle">Salin</span><span class="ok">Tersalin</span>
                    </button>
                </div>

                <!-- Sosial media -->
                @if (count($links))
                    <div class="c-social">
                        @foreach ($links as $link)
                            @php [$type, $val, $hex] = $resolveIcon($link); @endphp
                            <a href="{{ $link['url'] ?? '#' }}" target="_blank" rel="noopener noreferrer"
                               class="c-link c-reveal" aria-label="{{ $link['name'] ?? 'tautan' }}"
                               style="@if ($hex) --brand:{{ '#' . $hex }}; --brand-fg:{{ $brandFg($hex) }}; @endif">
                                <span class="c-ico">
                                    @if ($type === 'img')
                                        <img src="{{ $val }}" alt="" loading="lazy">
                                    @elseif ($type === 'text')
                                        <span class="ini">{{ $val }}</span>
                                    @else
                                        <svg viewBox="0 0 24 24" aria-hidden="true">{!! $val !!}</svg>
                                    @endif
                                </span>
                                <span class="c-nm">{{ $link['name'] }}</span>
                                <span class="c-hd">{{ $link['handle'] ?? '' }}</span>
                                <svg class="c-arrow" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17L17 7M9 7h8v8"/></svg>
                            </a>
                        @endforeach
                    </div>
                @endif

                <div class="c-note c-reveal">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="4" y="10" width="16" height="10" rx="2.5"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/></svg>
                    <span>Data kontak di atas masih berupa contoh dan akan diperbarui sesuai akun resmi.</span>
                </div>
            </div>

            <!-- Form -->
            <div class="c-reveal">
                <form action="{{ route('contact.send') }}" method="POST">
                    @csrf
                    <div class="f-head font-display">Kirim Pesan</div>
                    <div class="f-sub">Mohon lengkapi formulir berikut.</div>

                    @if (session('success'))
                        <div class="f-alert f-ok">{{ session('success') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="f-alert f-err">
                            <strong>Mohon periksa kembali:</strong>
                            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                        </div>
                    @endif

                    <div class="f-row two">
                        <div class="f-field">
                            <label for="contact-name">Nama</label>
                            <input type="text" id="contact-name" name="name" value="{{ old('name') }}" required placeholder="Nama lengkap Anda">
                        </div>
                        <div class="f-field">
                            <label for="contact-email">Email</label>
                            <input type="email" id="contact-email" name="email" value="{{ old('email') }}" required placeholder="nama@domain.com">
                        </div>
                    </div>

                    <div class="f-row" style="margin-top:1rem">
                        <div class="f-field">
                            <label for="contact-subject">Subjek <span style="opacity:.55">(opsional)</span></label>
                            <input type="text" id="contact-subject" name="subject" value="{{ old('subject') }}" placeholder="Contoh: pengembangan situs web">
                        </div>
                    </div>

                    <div class="f-row" style="margin-top:1rem">
                        <div class="f-field">
                            <label for="contact-message">Pesan</label>
                            <textarea id="contact-message" name="message" rows="4" required placeholder="Uraikan secara singkat kebutuhan atau pertanyaan Anda...">{{ old('message') }}</textarea>
                        </div>
                    </div>

                    <button type="submit" class="f-submit" id="c-submit">
                        <span class="f-spin" aria-hidden="true"></span>
                        <span>Kirim Pesan</span>
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.1" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17L17 7M9 7h8v8"/></svg>
                    </button>
                </form>
            </div>

        </div>
    </div>
</section>

@verbatim
<script>
(function () {
    var sec = document.getElementById('contact');
    if (!sec) return;
    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    /* reveal bertahap */
    var items = Array.prototype.slice.call(sec.querySelectorAll('.c-reveal'));
    if ('IntersectionObserver' in window && !reduce) {
        var io = new IntersectionObserver(function (es) {
            es.forEach(function (e) {
                if (!e.isIntersecting) return;
                var i = items.indexOf(e.target);
                e.target.style.transitionDelay = ((i % 4) * 70) + 'ms';
                e.target.classList.add('is-in');
                io.unobserve(e.target);
            });
        }, { threshold: .15 });
        items.forEach(function (n) { io.observe(n); });
    } else {
        items.forEach(function (n) { n.classList.add('is-in'); });
    }

    /* salin email */
    var btn = sec.querySelector('.c-copy');
    if (btn) {
        btn.addEventListener('click', function () {
            var txt = btn.getAttribute('data-copy');
            var done = function () {
                btn.classList.add('is-done');
                setTimeout(function () { btn.classList.remove('is-done'); }, 1800);
            };
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(txt).then(done).catch(function () { window.location.href = 'mailto:' + txt; });
            } else {
                var ta = document.createElement('textarea');
                ta.value = txt; ta.style.position = 'fixed'; ta.style.opacity = '0';
                document.body.appendChild(ta); ta.select();
                try { document.execCommand('copy'); done(); } catch (err) { window.location.href = 'mailto:' + txt; }
                document.body.removeChild(ta);
            }
        });
    }

    /* status kirim */
    var form = sec.querySelector('form'), sub = document.getElementById('c-submit');
    if (form && sub) {
        form.addEventListener('submit', function () {
            if (form.checkValidity()) sub.classList.add('is-busy');
        });
        window.addEventListener('pageshow', function () { sub.classList.remove('is-busy'); });
    }
})();
</script>
@endverbatim