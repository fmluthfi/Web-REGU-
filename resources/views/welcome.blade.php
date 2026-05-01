@extends('layouts.app', ['title' => 'REGU'])

@section('content')
    <div class="rounded-[2rem] bg-white p-10 shadow-sm ring-1 ring-slate-200">
        <p class="text-sm uppercase tracking-[0.3em] text-emerald-500">REGU</p>
        <h1 class="mt-4 text-4xl font-semibold text-slate-900">Sistem evaluasi guru yang rapi, aman, dan terukur.</h1>
        <p class="mt-4 max-w-3xl text-sm leading-7 text-slate-600">
            Project Laravel ini sudah disiapkan untuk alur siswa, Guru BK, dan kepala sekolah. Masuk melalui halaman login untuk mulai menggunakan dashboard sesuai role Anda.
        </p>
        <div class="mt-8">
            <a href="{{ route('login') }}" class="rounded-full bg-emerald-600 px-5 py-3 text-sm font-semibold text-white hover:bg-emerald-500">
                Buka Halaman Login
            </a>
        </div>
    </div>
@endsection
