<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Personal Portfolio of a student creative web developer building modern, high-performance digital experiences with Laravel and Tailwind CSS.">
    <meta name="theme-color" content="#070F2B">

    <title>{{ $title ?? 'Midnight Indigo — Creative Developer Portfolio' }}</title>

    <!-- Google Fonts: Syne & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=Syne:wght@600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    <!-- Styles & Scripts via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#070F2B] text-[#FFF2F2] font-sans antialiased selection:bg-[#7286D3] selection:text-[#070F2B] relative min-h-screen">

    <!-- Ambient Creative Coding Background Accents -->
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden" aria-hidden="true">
        <div class="absolute -top-32 -left-32 w-96 h-96 rounded-full bg-[#1B1A55]/40 blur-3xl"></div>
        <div class="absolute top-1/3 -right-32 w-[30rem] h-[30rem] rounded-full bg-[#7286D3]/10 blur-3xl"></div>
        <div class="absolute -bottom-32 left-1/4 w-[28rem] h-[28rem] rounded-full bg-[#535C91]/20 blur-3xl"></div>
        <div class="absolute inset-0 bg-[radial-gradient(#535C91_1px,transparent_1px)] [background-size:32px_32px] opacity-15"></div>
    </div>

    <!-- Navigation -->
    <x-navbar :profile="$profile" />

    <!-- Main Content Area -->
    <main class="relative z-10">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <x-footer :profile="$profile" :social-links="$socialLinks" />

</body>
</html>
