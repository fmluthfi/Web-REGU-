@extends('layouts.app', ['title' => 'Login Admin REGU'])

@section('content')
    <div class="relative flex min-h-screen items-center justify-center overflow-hidden bg-slate-100 px-4 py-10 sm:px-6">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_18%_18%,rgba(14,165,233,0.16),transparent_30%),radial-gradient(circle_at_82%_78%,rgba(16,185,129,0.12),transparent_28%),linear-gradient(135deg,#f8fafc,#e0f2fe_55%,#f8fafc)]"></div>
        <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-sky-700 via-cyan-500 to-emerald-500"></div>

        <section class="relative w-full max-w-md rounded-[1.75rem] bg-white/95 px-7 py-9 shadow-2xl shadow-slate-900/12 ring-1 ring-white/80 backdrop-blur-md sm:px-9">
            <div class="mx-auto flex h-24 w-24 items-center justify-center">
                <img src="{{ asset('images/REGU.png') }}" alt="Logo REGU" class="h-full w-full object-contain">
            </div>

            <div class="mt-5 text-center">
                <div class="mx-auto mb-3 inline-flex items-center rounded-full border border-sky-100 bg-sky-50 px-3 py-1 text-xs font-extrabold uppercase tracking-[0.2em] text-sky-700">
                    Internal
                </div>
                <h1 class="text-4xl font-extrabold tracking-tight text-cyan-700">Admin REGU</h1>
                <p class="mt-2 text-sm font-medium text-slate-500">Akses khusus pengelolaan data siswa dan guru.</p>
            </div>

            <form method="POST" action="{{ route('admin.login.store') }}" class="mt-9 space-y-5">
                @csrf
                <div>
                    <label for="login" class="mb-2 flex items-center gap-2 text-sm font-bold text-slate-700">
                        <svg class="h-4 w-4 text-cyan-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M2 5.5A2.5 2.5 0 0 1 4.5 3h11A2.5 2.5 0 0 1 18 5.5v9a2.5 2.5 0 0 1-2.5 2.5h-11A2.5 2.5 0 0 1 2 14.5v-9Zm2.5-.75a.75.75 0 0 0-.75.75v1.25h12.5V5.5a.75.75 0 0 0-.75-.75h-11Zm-.75 4v5.75c0 .414.336.75.75.75h11a.75.75 0 0 0 .75-.75V8.75H3.75Zm1.75 2.75h4v1.5h-4v-1.5Zm0-2.25h2.75v1.5H5.5v-1.5Z"/>
                        </svg>
                        Email / Username Admin
                    </label>
                    <input id="login" name="login" type="text" value="{{ old('login') }}" class="w-full rounded-xl border {{ $errors->has('login') ? 'border-rose-400 focus:border-rose-500 focus:ring-rose-100' : 'border-slate-200 focus:border-cyan-500 focus:ring-cyan-100' }} bg-white px-4 py-3 text-sm outline-none transition placeholder:text-slate-400 focus:ring-4" placeholder="..." autocomplete="username" aria-describedby="login-error">
                    @error('login')
                        <p id="login-error" class="mt-2 text-sm font-medium text-rose-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password" class="mb-2 flex items-center gap-2 text-sm font-bold text-slate-700">
                        <svg class="h-4 w-4 text-cyan-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5 8V6a5 5 0 0 1 10 0v2h.5A1.5 1.5 0 0 1 17 9.5v6A1.5 1.5 0 0 1 15.5 17h-11A1.5 1.5 0 0 1 3 15.5v-6A1.5 1.5 0 0 1 4.5 8H5Zm2 0h6V6a3 3 0 1 0-6 0v2Z" clip-rule="evenodd"/>
                        </svg>
                        Password
                    </label>
                    <input id="password" name="password" type="password" class="w-full rounded-xl border {{ $errors->has('password') ? 'border-rose-400 focus:border-rose-500 focus:ring-rose-100' : 'border-slate-200 focus:border-cyan-500 focus:ring-cyan-100' }} bg-white px-4 py-3 text-sm outline-none transition placeholder:text-slate-400 focus:ring-4" placeholder="Masukkan password admin" autocomplete="current-password" aria-describedby="password-error">
                    @error('password')
                        <p id="password-error" class="mt-2 text-sm font-medium text-rose-600">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-sky-700 via-cyan-600 to-sky-500 px-4 py-3.5 text-sm font-extrabold text-white shadow-lg shadow-cyan-700/25 transition hover:from-sky-800 hover:via-cyan-700 hover:to-sky-600 focus:outline-none focus:ring-4 focus:ring-cyan-200">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M3 10a1 1 0 0 1 1-1h7.586L8.293 5.707a1 1 0 0 1 1.414-1.414l5 5a1 1 0 0 1 0 1.414l-5 5a1 1 0 1 1-1.414-1.414L11.586 11H4a1 1 0 0 1-1-1Z" clip-rule="evenodd"/>
                        <path d="M14 3a1 1 0 0 1 1-1h1.5A1.5 1.5 0 0 1 18 3.5v13a1.5 1.5 0 0 1-1.5 1.5H15a1 1 0 1 1 0-2h1V4h-1a1 1 0 0 1-1-1Z"/>
                    </svg>
                    Masuk Admin
                </button>
            </form>
        </section>
    </div>
@endsection
