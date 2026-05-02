<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#0e7490">
    <title>{{ $title ?? 'REGU' }}</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    @php
        $hasViteAssets = file_exists(public_path('build/manifest.json')) || (app()->environment('local') && file_exists(public_path('hot')));
    @endphp
    @if (app()->environment('production') || ! $hasViteAssets)
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    @if ($hasViteAssets)
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
        body {
            background:
                radial-gradient(circle at top left, rgba(16, 185, 129, 0.12), transparent 28%),
                radial-gradient(circle at bottom right, rgba(14, 165, 233, 0.12), transparent 24%),
                #f8fafc;
            color: #0f172a;
        }
    </style>
</head>
<body class="min-h-screen bg-slate-100 text-slate-900">
    <div class="min-h-screen">
        @unless (request()->routeIs('login', 'admin.login'))
            <nav class="border-b border-slate-200 bg-white/95 backdrop-blur">
                <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('dashboard.redirect') }}" class="flex h-12 w-12 shrink-0 items-center justify-center overflow-hidden rounded-full bg-white">
                            <img src="{{ asset('images/REGU.png') }}" alt="Logo REGU" class="h-full w-full object-contain">
                        </a>
                        <div>
                            <a href="{{ route('dashboard.redirect') }}" class="text-xl font-semibold tracking-tight text-slate-900">REGU</a>
                            <p class="text-sm text-slate-500">Platform Rating Guru Berbasis Evaluasi Siswa</p>
                        </div>
                    </div>
                    @auth
                    <div class="flex items-center gap-4">
                        <div class="text-right">
                            <p class="text-sm font-medium text-slate-900">{{ auth()->user()->name }}</p>
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-500">{{ str_replace('_', ' ', auth()->user()->role) }}</p>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="rounded-full bg-slate-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-slate-700">Logout</button>
                        </form>
                    </div>
                    @endauth
                </div>
            </nav>
        @endunless

        @auth
            <header class="border-b border-slate-200 bg-slate-50">
                <div class="mx-auto flex max-w-7xl flex-wrap gap-3 px-4 py-3 text-sm sm:px-6 lg:px-8">
                    @if (auth()->user()->role === 'siswa')
                        <a href="{{ route('siswa.dashboard') }}" class="rounded-full px-3 py-2 {{ request()->routeIs('siswa.*') ? 'bg-emerald-600 text-white' : 'bg-white text-slate-700' }}">Dashboard Siswa</a>
                    @elseif (auth()->user()->role === 'guru_bk')
                        <a href="{{ route('bk.dashboard') }}" class="rounded-full px-3 py-2 {{ request()->routeIs('bk.*') ? 'bg-amber-500 text-slate-950' : 'bg-white text-slate-700' }}">Dashboard Guru BK</a>
                    @elseif (auth()->user()->role === 'kepala_sekolah')
                        <a href="{{ route('kepala-sekolah.dashboard') }}" class="rounded-full px-3 py-2 {{ request()->routeIs('kepala-sekolah.dashboard') ? 'bg-sky-600 text-white' : 'bg-white text-slate-700' }}">Dashboard Laporan</a>
                        <a href="{{ route('kepala-sekolah.periode.index') }}" class="rounded-full px-3 py-2 {{ request()->routeIs('kepala-sekolah.periode.*') ? 'bg-sky-600 text-white' : 'bg-white text-slate-700' }}">Periode Evaluasi</a>
                    @elseif (auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="rounded-full px-3 py-2 {{ request()->routeIs('admin.*') ? 'bg-slate-900 text-white' : 'bg-white text-slate-700' }}">Dashboard Admin</a>
                    @endif
                </div>
            </header>
        @endauth

        <main class="{{ request()->routeIs('login', 'admin.login') ? '' : 'mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8' }}">
            @if (session('success'))
                <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">{{ session('error') }}</div>
            @endif
            @if (! request()->routeIs('login', 'admin.login') && $errors->any())
                <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
