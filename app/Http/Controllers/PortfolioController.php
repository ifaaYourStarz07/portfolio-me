<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PortfolioController extends Controller
{
    /**
     * Display the main portfolio landing page.
     */
    public function index(): View
    {
        $profile = [
            'name' => 'Nama Anda',
            'role' => 'Creative Developer & Student',
            'status' => 'Siswa / Mahasiswa Web Development',
            'headline' => 'I BUILD DIGITAL EXPERIENCES.',
            'subtitle' => 'Pelajar dan aspiring web developer yang antusias membangun aplikasi web modern, performan tinggi, dan antarmuka interaktif yang elegan.',
            'bio_story' => 'Saya seorang pelajar yang sedang mendalami dunia software development dan rekayasa web. Perjalanan saya dimulai dari rasa ingin tahu bagaimana sebuah website dapat menyajikan pengalaman interaktif yang intuitif bagi pengguna. Saat ini saya berfokus mendalami ekosistem Laravel di backend dan JavaScript/Tailwind CSS di frontend.',
            'learning_focus' => 'Fokus saat ini mencakup arsitektur MVC Laravel, perancangan basis data relasional, RESTful API, serta teknik animasi web responsif.',
            'education' => 'Pendidikan Web Development & Rekayasa Perangkat Lunak',
            'location' => 'Indonesia',
            'avatar_url' => asset('images/profile-placeholder.svg'),
        ];

        $projects = [
            [
                'id' => 1,
                'title' => 'Sistem Informasi & Manajemen Presensi',
                'category' => 'web-app',
                'category_label' => 'Web Application',
                'badge' => 'Laravel & SQLite',
                'description' => 'Aplikasi web manajemen presensi berbasis web dengan autentikasi pengguna, rekap kehadiran bulanan, dan ekspor laporan.',
                'preview_image' => asset('images/project-1.svg'),
                'tech_stack' => ['Laravel 13', 'Blade', 'Tailwind CSS', 'SQLite'],
                'features' => [
                    'Sistem autentikasi peran (Siswa/Admin)',
                    'Dashboard ringkasan statistik kehadiran',
                    'Validasi input form dan proteksi CSRF',
                    'Fitur filter tanggal dan ekspor data',
                ],
                'challenge' => 'Tantangan utama adalah menyusun skema relasi database yang rapi serta memastikan validasi waktu presensi yang akurat tanpa duplikasi data.',
                'repo_url' => 'https://github.com/placeholder-username/presensi-app',
                'demo_url' => null, // Ditandai null karena belum di-deploy live
                'is_placeholder' => true,
            ],
            [
                'id' => 2,
                'title' => 'Dashboard Kasir & Inventaris Mini',
                'category' => 'fullstack',
                'category_label' => 'Fullstack System',
                'badge' => 'CRUD & Analytics',
                'description' => 'Sistem kasir (Point of Sale) sederhana untuk pencatatan transaksi barang, stok otomatis berkurang, dan visualisasi pendapatan harian.',
                'preview_image' => asset('images/project-2.svg'),
                'tech_stack' => ['Laravel', 'Vite', 'Tailwind CSS', 'Chart.js'],
                'features' => [
                    'Manajemen master data produk & kategori',
                    'Keranjang belanja realtime di sisi klien',
                    'Pencetakan struk transaksi berbasis web',
                    'Grafik penjualan mingguan interaktif',
                ],
                'challenge' => 'Mengelola transaksi database secara atomic menggunakan DB Transactions agar stok barang konsisten saat proses checkout berlangsung.',
                'repo_url' => 'https://github.com/placeholder-username/pos-inventory',
                'demo_url' => null,
                'is_placeholder' => true,
            ],
            [
                'id' => 3,
                'title' => 'Midnight Indigo Creative Canvas',
                'category' => 'creative-ui',
                'category_label' => 'Creative UI / Frontend',
                'badge' => 'Motion & Design System',
                'description' => 'Eksperimen antarmuka personal portfolio dengan palet warna Midnight Indigo, tipografi editorial, micro-interactions, dan aksesibilitas ramah pembaca.',
                'preview_image' => asset('images/project-3.svg'),
                'tech_stack' => ['Tailwind CSS v4', 'Vanilla JS', 'SVG Arts', 'Vite'],
                'features' => [
                    'Desain token warna harmonis terstruktur',
                    'IntersectionObserver scroll reveal animations',
                    'Filter kategori project tanpa refresh halaman',
                    'Dukungan penuh preferensi reduced-motion',
                ],
                'challenge' => 'Memadukan estetika dark mode premium dengan rasio kontras teks WCAG AAA agar tetap nyaman dibaca dalam waktu lama.',
                'repo_url' => 'https://github.com/placeholder-username/midnight-indigo-portfolio',
                'demo_url' => 'http://localhost:8000',
                'is_placeholder' => true,
            ],
        ];

        $skills = [
            'frontend' => [
                'name' => 'Frontend Development',
                'description' => 'Fokus pada struktur semantik, estetika visual, dan interaksi yang halus.',
                'items' => [
                    ['name' => 'HTML5 & Semantics', 'level' => 'Proficient', 'note' => 'Aksesibilitas & Struktur SEO'],
                    ['name' => 'CSS3 & Tailwind CSS v4', 'level' => 'Advanced', 'note' => 'Design Tokens, Flexbox, Grid'],
                    ['name' => 'JavaScript (ES6+)', 'level' => 'Intermediate', 'note' => 'DOM, Fetch API, Async/Await'],
                    ['name' => 'Responsive UI & Motion', 'level' => 'Intermediate', 'note' => 'IntersectionObserver, Transitions'],
                ],
            ],
            'backend' => [
                'name' => 'Backend Development',
                'description' => 'Membangun logika bisnis yang aman, modular, dan terstruktur.',
                'items' => [
                    ['name' => 'PHP 8.x', 'level' => 'Intermediate', 'note' => 'OOP, Type Hints, Modern Syntax'],
                    ['name' => 'Laravel Framework', 'level' => 'Intermediate', 'note' => 'Routing, Controller, Blade, Middleware'],
                    ['name' => 'Eloquent ORM', 'level' => 'Intermediate', 'note' => 'Relations, Migrations, Seeders'],
                    ['name' => 'RESTful API Concept', 'level' => 'Foundational', 'note' => 'JSON Responses & Endpoint Design'],
                ],
            ],
            'database' => [
                'name' => 'Database & Storage',
                'description' => 'Penyimpanan data yang konsisten, aman, dan efisien.',
                'items' => [
                    ['name' => 'SQLite', 'level' => 'Proficient', 'note' => 'Local development & prototyping'],
                    ['name' => 'MySQL / MariaDB', 'level' => 'Intermediate', 'note' => 'Relational schemas & normalization'],
                    ['name' => 'Database Migrations', 'level' => 'Intermediate', 'note' => 'Version control for schema'],
                ],
            ],
            'tools' => [
                'name' => 'Tools & Workflow',
                'description' => 'Peralatan modern penunjang kolaborasi dan produktivitas.',
                'items' => [
                    ['name' => 'Git & GitHub', 'level' => 'Proficient', 'note' => 'Branching, Commits, Versioning'],
                    ['name' => 'Vite Bundler', 'level' => 'Intermediate', 'note' => 'Asset compilation & HMR'],
                    ['name' => 'Composer & NPM', 'level' => 'Proficient', 'note' => 'Package management'],
                    ['name' => 'PHPUnit Testing', 'level' => 'Foundational', 'note' => 'Basic feature testing'],
                ],
            ],
        ];

        $learningJourney = [
            [
                'period' => '2024 - Awal Belajar',
                'title' => 'Fondasi Web & Algoritma',
                'milestone' => 'HTML, CSS Dasar & Dasar Pemrograman',
                'description' => 'Mempelajari sintaks dasar web, tata letak CSS, dan logika dasar menggunakan JavaScript dan PHP native.',
                'tags' => ['HTML5', 'CSS3', 'Dasar PHP'],
            ],
            [
                'period' => '2025 - Pengembangan Lanjutan',
                'title' => 'Eksplorasi Framework & Relasi Database',
                'milestone' => 'Transisi ke Laravel & SQLite / MySQL',
                'description' => 'Mulai memahami arsitektur Model-View-Controller (MVC), routing dinamis, templating Blade, dan pembuatan proyek CRUD pertama.',
                'tags' => ['Laravel MVC', 'MySQL', 'CRUD'],
            ],
            [
                'period' => '2026 - Tahap Saat Ini',
                'title' => 'Creative Engineering & Professional Portfolio',
                'milestone' => 'Midnight Indigo Portfolio & Tailwind CSS v4',
                'description' => 'Mendalami modern frontend workflow, micro-interactions terarah, penataan arsitektur kode profesional, dan testing otomatis.',
                'tags' => ['Tailwind CSS v4', 'UI/UX Design', 'Quality Testing'],
            ],
        ];

        $socialLinks = [
            ['name' => 'GitHub', 'url' => 'https://github.com', 'handle' => '@placeholder_github'],
            ['name' => 'LinkedIn', 'url' => 'https://linkedin.com', 'handle' => 'Profile LinkedIn [Placeholder]'],
            ['name' => 'Email', 'url' => 'mailto:developer@example.com', 'handle' => 'developer@example.com [Contoh]'],
        ];

        return view('portfolio', compact('profile', 'projects', 'skills', 'learningJourney', 'socialLinks'));
    }

    /**
     * Handle incoming contact form submission.
     */
    public function sendContact(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        Log::info('Pesan kontak baru diterima:', $validated);

        return back()->with('success', 'Terima kasih! Pesan Anda telah berhasil diterima dan dicatat.');
    }
}
