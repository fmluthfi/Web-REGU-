@extends('layouts.app', ['title' => 'Laporan Guru'])

@section('content')
    <div class="space-y-6">
        <section class="rounded-[2rem] bg-white p-8 shadow-sm ring-1 ring-slate-200">
            <div class="flex flex-wrap items-start justify-between gap-4">
                <div>
                    <p class="text-sm uppercase tracking-[0.3em] text-sky-500">Laporan Guru</p>
                    <h1 class="mt-3 text-3xl font-semibold text-slate-900">{{ $guru->nama }}</h1>
                    <p class="mt-2 text-sm text-slate-500">{{ $guru->mata_pelajaran }} • {{ $periode?->nama_periode ?? 'Semua Periode' }}</p>
                </div>
                <a href="{{ route('kepala-sekolah.guru.laporan.pdf', ['guru' => $guru->id, 'periode_id' => $periode?->id]) }}" class="rounded-full bg-sky-600 px-5 py-3 text-sm font-semibold text-white hover:bg-sky-500">Export PDF</a>
            </div>
            <div class="mt-8 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                <div class="rounded-2xl border border-slate-200 p-5"><p class="text-sm text-slate-500">Jumlah Evaluasi</p><p class="mt-2 text-2xl font-semibold text-slate-900">{{ $summary['jumlah_evaluasi'] }}</p></div>
                <div class="rounded-2xl border border-slate-200 p-5"><p class="text-sm text-slate-500">Rata-rata Kejelasan</p><p class="mt-2 text-2xl font-semibold text-slate-900">{{ number_format($summary['avg_kejelasan'], 2) }}</p></div>
                <div class="rounded-2xl border border-slate-200 p-5"><p class="text-sm text-slate-500">Rata-rata Ketepatan Waktu</p><p class="mt-2 text-2xl font-semibold text-slate-900">{{ number_format($summary['avg_ketepatan_waktu'], 2) }}</p></div>
                <div class="rounded-2xl border border-slate-200 p-5"><p class="text-sm text-slate-500">Rata-rata Interaksi</p><p class="mt-2 text-2xl font-semibold text-slate-900">{{ number_format($summary['avg_interaksi'], 2) }}</p></div>
                <div class="rounded-2xl border border-slate-200 p-5"><p class="text-sm text-slate-500">Rata-rata Metode</p><p class="mt-2 text-2xl font-semibold text-slate-900">{{ number_format($summary['avg_metode'], 2) }}</p></div>
                <div class="rounded-2xl border border-slate-200 p-5"><p class="text-sm text-slate-500">Skor Akhir</p><p class="mt-2 text-2xl font-semibold text-slate-900">{{ number_format($summary['avg_skor_akhir'], 2) }}</p><p class="mt-1 text-sm text-slate-500">{{ $summary['kategori_akhir'] }}</p></div>
            </div>
        </section>
        <section class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <h2 class="text-xl font-semibold text-slate-900">Komentar Siswa (Anonim)</h2>
            <div class="mt-6 space-y-4">
                @forelse ($evaluasis as $evaluasi)
                    <article class="rounded-2xl border border-slate-200 p-5">
                        <p class="text-sm leading-7 text-slate-700">{{ $evaluasi->komentar }}</p>
                        <p class="mt-3 text-xs uppercase tracking-[0.25em] text-slate-400">{{ $evaluasi->created_at->format('d M Y') }}</p>
                    </article>
                @empty
                    <div class="rounded-2xl bg-slate-50 p-5 text-sm text-slate-500">Belum ada komentar terverifikasi untuk guru ini pada periode yang dipilih.</div>
                @endforelse
            </div>
        </section>
    </div>
@endsection
