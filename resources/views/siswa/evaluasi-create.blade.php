@extends('layouts.app', ['title' => 'Isi Evaluasi'])

@section('content')
    <div class="mx-auto max-w-4xl space-y-6">
        <section class="rounded-[2rem] bg-white p-8 shadow-sm ring-1 ring-slate-200">
            <h1 class="text-2xl font-semibold text-slate-900">Form Evaluasi Guru</h1>
            <p class="mt-2 text-sm text-slate-500">Guru: {{ $guru->nama }} • {{ $guru->mata_pelajaran }} • Periode {{ $periodeAktif->nama_periode }}</p>
            <form method="POST" action="{{ route('siswa.evaluasi.store', $guru) }}" class="mt-8 space-y-8">
                @csrf
                @php
                    $fields = [
                        'skor_kejelasan' => 'Kejelasan penyampaian materi',
                        'skor_ketepatan_waktu' => 'Ketepatan waktu dan kedisiplinan',
                        'skor_interaksi' => 'Interaksi dengan siswa',
                        'skor_metode' => 'Metode pembelajaran',
                    ];
                @endphp
                @foreach ($fields as $field => $label)
                    <div class="rounded-2xl border border-slate-200 p-5">
                        <p class="text-sm font-semibold text-slate-900">{{ $label }}</p>
                        <div class="mt-4 flex flex-wrap gap-3">
                            @for ($i = 1; $i <= 5; $i++)
                                <label class="flex cursor-pointer items-center gap-2 rounded-full border border-slate-200 px-4 py-2 text-sm text-slate-700 transition hover:border-emerald-300 hover:bg-emerald-50">
                                    <input type="radio" name="{{ $field }}" value="{{ $i }}" {{ old($field) == $i ? 'checked' : '' }} class="text-emerald-600 focus:ring-emerald-500">
                                    <span>{{ $i }}</span>
                                </label>
                            @endfor
                        </div>
                    </div>
                @endforeach
                <div>
                    <label for="komentar" class="mb-2 block text-sm font-medium text-slate-700">Komentar</label>
                    <textarea id="komentar" name="komentar" rows="5" class="w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100" placeholder="Tuliskan komentar yang konstruktif dan minimal 10 karakter...">{{ old('komentar') }}</textarea>
                </div>
                <div class="flex flex-wrap gap-3">
                    <button type="submit" class="rounded-full bg-emerald-600 px-6 py-3 text-sm font-semibold text-white hover:bg-emerald-500">Kirim Evaluasi</button>
                    <a href="{{ route('siswa.dashboard') }}" class="rounded-full bg-slate-100 px-6 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-200">Kembali</a>
                </div>
            </form>
        </section>
    </div>
@endsection
