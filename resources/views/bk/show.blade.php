@extends('layouts.app', ['title' => 'Detail Evaluasi'])

@section('content')
    <div class="space-y-6">
        <section class="rounded-[2rem] bg-white p-8 shadow-sm ring-1 ring-slate-200">
            <div class="flex flex-wrap items-start justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-semibold text-slate-900">Detail Evaluasi</h1>
                    <p class="mt-2 text-sm text-slate-500">{{ $evaluasi->periodeEvaluasi->nama_periode }}</p>
                </div>
                <div>@include('partials.status-badge', ['status' => $evaluasi->status])</div>
            </div>
            <div class="mt-8 grid gap-6 md:grid-cols-2">
                <div class="rounded-2xl bg-slate-50 p-5">
                    <h2 class="font-semibold text-slate-900">Informasi Siswa</h2>
                    <p class="mt-3 text-sm text-slate-600">Nama: {{ $evaluasi->siswa->nama }}</p>
                    <p class="mt-1 text-sm text-slate-600">NIS: {{ $evaluasi->siswa->nis }}</p>
                    <p class="mt-1 text-sm text-slate-600">Kelas: {{ $evaluasi->siswa->kelas->nama_kelas }}</p>
                </div>
                <div class="rounded-2xl bg-slate-50 p-5">
                    <h2 class="font-semibold text-slate-900">Informasi Guru</h2>
                    <p class="mt-3 text-sm text-slate-600">Nama: {{ $evaluasi->guru->nama }}</p>
                    <p class="mt-1 text-sm text-slate-600">Mata Pelajaran: {{ $evaluasi->guru->mata_pelajaran }}</p>
                </div>
            </div>
            <div class="mt-8 grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                <div class="rounded-2xl border border-slate-200 p-5"><p class="text-sm text-slate-500">Kejelasan</p><p class="mt-2 text-2xl font-semibold text-slate-900">{{ $evaluasi->skor_kejelasan }}</p></div>
                <div class="rounded-2xl border border-slate-200 p-5"><p class="text-sm text-slate-500">Ketepatan Waktu</p><p class="mt-2 text-2xl font-semibold text-slate-900">{{ $evaluasi->skor_ketepatan_waktu }}</p></div>
                <div class="rounded-2xl border border-slate-200 p-5"><p class="text-sm text-slate-500">Interaksi</p><p class="mt-2 text-2xl font-semibold text-slate-900">{{ $evaluasi->skor_interaksi }}</p></div>
                <div class="rounded-2xl border border-slate-200 p-5"><p class="text-sm text-slate-500">Metode</p><p class="mt-2 text-2xl font-semibold text-slate-900">{{ $evaluasi->skor_metode }}</p></div>
            </div>
            <div class="mt-8 rounded-2xl bg-slate-50 p-5">
                <p class="text-sm text-slate-500">Skor Akhir</p>
                <p class="mt-2 text-3xl font-semibold text-slate-900">{{ number_format($evaluasi->skor_akhir, 2) }}</p>
                <p class="mt-1 text-sm text-slate-600">Kategori: {{ $evaluasi->kategori }}</p>
                <p class="mt-4 text-sm leading-7 text-slate-700">{{ $evaluasi->komentar }}</p>
            </div>
            @if ($evaluasi->status === 'menunggu_verifikasi')
                <div class="mt-8 grid gap-6 lg:grid-cols-2">
                    <form method="POST" action="{{ route('bk.evaluasi.verify', $evaluasi) }}" class="rounded-2xl border border-emerald-200 bg-emerald-50 p-5">
                        @csrf
                        <h2 class="font-semibold text-emerald-900">Verifikasi Evaluasi</h2>
                        <p class="mt-2 text-sm text-emerald-700">Gunakan jika evaluasi valid dan identitas siswa dapat ditelusuri secara internal.</p>
                        <button type="submit" class="mt-4 rounded-full bg-emerald-600 px-5 py-3 text-sm font-semibold text-white hover:bg-emerald-500">Verifikasi</button>
                    </form>
                    <form method="POST" action="{{ route('bk.evaluasi.reject', $evaluasi) }}" class="rounded-2xl border border-rose-200 bg-rose-50 p-5">
                        @csrf
                        <h2 class="font-semibold text-rose-900">Tolak Evaluasi</h2>
                        <label for="catatan" class="mt-4 block text-sm font-medium text-rose-900">Catatan Penolakan</label>
                        <textarea id="catatan" name="catatan" rows="4" class="mt-2 w-full rounded-2xl border border-rose-200 px-4 py-3">{{ old('catatan') }}</textarea>
                        <button type="submit" class="mt-4 rounded-full bg-rose-600 px-5 py-3 text-sm font-semibold text-white hover:bg-rose-500">Tolak</button>
                    </form>
                </div>
            @endif
        </section>
    </div>
@endsection
