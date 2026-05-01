@extends('layouts.app', ['title' => 'Login REGU'])

@section('content')
    <div class="mx-auto grid max-w-5xl gap-6 lg:grid-cols-[1.2fr_0.8fr]">
        <section class="rounded-[2rem] bg-slate-900 p-8 text-white shadow-xl">
            <p class="text-sm uppercase tracking-[0.35em] text-emerald-300">REGU</p>
            <h1 class="mt-4 max-w-xl text-4xl font-semibold leading-tight">Platform evaluasi guru yang menjaga anonimitas siswa, tapi tetap akuntabel untuk sekolah.</h1>
            <p class="mt-4 max-w-lg text-sm leading-7 text-slate-300">Siswa menilai guru mapel secara periodik, Guru BK memverifikasi, lalu Kepala Sekolah membaca analitik dan laporan PDF.</p>
        </section>
        <section class="rounded-[2rem] bg-white p-8 shadow-xl ring-1 ring-slate-200">
            <h2 class="text-2xl font-semibold text-slate-900">Masuk ke REGU</h2>
            <p class="mt-2 text-sm text-slate-500">Gunakan email, username, atau NIS sesuai akun Anda.</p>
            <form method="POST" action="{{ route('login.store') }}" class="mt-8 space-y-5">
                @csrf
                <div>
                    <label for="login" class="mb-2 block text-sm font-medium text-slate-700">Email / Username / NIS</label>
                    <input id="login" name="login" type="text" value="{{ old('login') }}" class="w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100" placeholder="contoh: 1001 atau kepsek@regu.test">
                </div>
                <div>
                    <label for="password" class="mb-2 block text-sm font-medium text-slate-700">Password</label>
                    <input id="password" name="password" type="password" class="w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100" placeholder="Masukkan password">
                </div>
                <button type="submit" class="w-full rounded-2xl bg-emerald-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-emerald-500">Login</button>
            </form>
            <div class="mt-8 rounded-2xl bg-slate-50 p-4 text-sm text-slate-600">
                <p class="font-semibold text-slate-900">Akun demo</p>
                <p class="mt-2">Kepala Sekolah: <span class="font-medium">kepsek@regu.test</span></p>
                <p>Guru BK: <span class="font-medium">bk@regu.test</span></p>
                <p>Siswa: <span class="font-medium">1001</span></p>
                <p class="mt-2">Password default: <span class="font-medium">password</span></p>
            </div>
        </section>
    </div>
@endsection
