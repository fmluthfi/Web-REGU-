@extends('layouts.app', ['title' => 'Login REGU'])

@section('content')
    <style>
        .login-bg-slide {
            opacity: 0;
            transform: scale(1.06);
            transition: opacity 1200ms ease-in-out, transform 6000ms ease-out;
        }

        .login-bg-slide.is-active {
            opacity: 1;
            transform: scale(1.02);
        }

        @media (prefers-reduced-motion: reduce) {
            .login-bg-slide {
                transition: none;
            }
        }
    </style>

    <div class="relative flex min-h-screen items-center justify-center overflow-hidden bg-slate-950 px-4 py-10 sm:px-6">
        <div id="login-background-slideshow" class="absolute inset-0 overflow-hidden">
            <img src="{{ asset('images/login/guru.png') }}" alt="" class="login-bg-slide is-active absolute inset-0 h-full w-full object-cover object-center blur-sm" data-login-slide>
            <img src="{{ asset('images/login/guru2.jpeg') }}" alt="" class="login-bg-slide absolute inset-0 h-full w-full object-cover object-center blur-sm" data-login-slide>
            <img src="{{ asset('images/login/guru3.jpg') }}" alt="" class="login-bg-slide absolute inset-0 h-full w-full object-cover object-center blur-sm" data-login-slide>
            <img src="{{ asset('images/login/guru4.jpg') }}" alt="" class="login-bg-slide absolute inset-0 h-full w-full object-cover object-center blur-sm" data-login-slide>
        </div>
        <div class="absolute inset-0 bg-slate-950/65"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_20%,rgba(14,165,233,0.28),transparent_28%),radial-gradient(circle_at_82%_76%,rgba(6,182,212,0.2),transparent_32%),linear-gradient(135deg,rgba(8,47,73,0.72),rgba(15,23,42,0.35)_48%,rgba(3,105,161,0.45))]"></div>

        <section class="relative w-full max-w-md rounded-[1.75rem] bg-white/95 px-7 py-9 shadow-2xl shadow-slate-950/45 ring-1 ring-white/70 backdrop-blur-md sm:px-9">
            <div class="mx-auto flex h-24 w-24 items-center justify-center">
                <img src="{{ asset('images/REGU.png') }}" alt="Logo REGU" class="h-full w-full object-contain">
            </div>

            <div class="mt-5 text-center">
                <h1 class="text-4xl font-extrabold tracking-tight text-cyan-700">REGU</h1>
                <p class="mt-2 text-sm font-medium text-slate-500">Platform Rating Guru Berbasis Evaluasi Siswa</p>
            </div>

            <form method="POST" action="{{ route('login.store') }}" class="mt-9 space-y-5">
                @csrf
                <div>
                    <label for="login" class="mb-2 flex items-center gap-2 text-sm font-bold text-slate-700">
                        <svg class="h-4 w-4 text-cyan-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M2 5.5A2.5 2.5 0 0 1 4.5 3h11A2.5 2.5 0 0 1 18 5.5v9a2.5 2.5 0 0 1-2.5 2.5h-11A2.5 2.5 0 0 1 2 14.5v-9Zm2.5-.75a.75.75 0 0 0-.75.75v1.25h12.5V5.5a.75.75 0 0 0-.75-.75h-11Zm-.75 4v5.75c0 .414.336.75.75.75h11a.75.75 0 0 0 .75-.75V8.75H3.75Zm1.75 2.75h4v1.5h-4v-1.5Zm0-2.25h2.75v1.5H5.5v-1.5Z"/>
                        </svg>
                        NIS / NIP
                    </label>
                    <p class="mb-3 text-xs font-medium text-slate-500">Gunakan NIP atau NIS untuk login.</p>
                    <input id="login" name="login" type="text" value="{{ old('login') }}" class="w-full rounded-xl border {{ $errors->has('login') ? 'border-rose-400 focus:border-rose-500 focus:ring-rose-100' : 'border-slate-200 focus:border-cyan-500 focus:ring-cyan-100' }} bg-white px-4 py-3 text-sm outline-none transition placeholder:text-slate-400 focus:ring-4" placeholder="Masukkan NIS atau NIP" autocomplete="username" aria-describedby="login-error">
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
                    <input id="password" name="password" type="password" class="w-full rounded-xl border {{ $errors->has('password') ? 'border-rose-400 focus:border-rose-500 focus:ring-rose-100' : 'border-slate-200 focus:border-cyan-500 focus:ring-cyan-100' }} bg-white px-4 py-3 text-sm outline-none transition placeholder:text-slate-400 focus:ring-4" placeholder="Masukkan password" autocomplete="current-password" aria-describedby="password-error">
                    @error('password')
                        <p id="password-error" class="mt-2 text-sm font-medium text-rose-600">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-sky-700 via-cyan-600 to-sky-500 px-4 py-3.5 text-sm font-extrabold text-white shadow-lg shadow-cyan-700/25 transition hover:from-sky-800 hover:via-cyan-700 hover:to-sky-600 focus:outline-none focus:ring-4 focus:ring-cyan-200">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M3 10a1 1 0 0 1 1-1h7.586L8.293 5.707a1 1 0 0 1 1.414-1.414l5 5a1 1 0 0 1 0 1.414l-5 5a1 1 0 1 1-1.414-1.414L11.586 11H4a1 1 0 0 1-1-1Z" clip-rule="evenodd"/>
                        <path d="M14 3a1 1 0 0 1 1-1h1.5A1.5 1.5 0 0 1 18 3.5v13a1.5 1.5 0 0 1-1.5 1.5H15a1 1 0 1 1 0-2h1V4h-1a1 1 0 0 1-1-1Z"/>
                    </svg>
                    Login
                </button>
            </form>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const slides = Array.from(document.querySelectorAll('[data-login-slide]'));
            let activeSlide = 0;

            if (slides.length < 2) {
                return;
            }

            window.setInterval(() => {
                slides[activeSlide].classList.remove('is-active');
                activeSlide = (activeSlide + 1) % slides.length;
                slides[activeSlide].classList.add('is-active');
            }, 5000);
        });
    </script>
@endsection
