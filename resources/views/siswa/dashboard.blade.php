@extends('layouts.app', ['title' => 'Dashboard Siswa'])

@section('content')
    <div class="space-y-6">
        <div class="grid gap-6 lg:grid-cols-[1.2fr_0.8fr]">
            <section class="rounded-[2rem] bg-gradient-to-br from-emerald-600 to-teal-700 p-8 text-white shadow-lg">
                <p class="text-sm uppercase tracking-[0.3em] text-emerald-100">Dashboard Siswa</p>
                <h1 class="mt-4 text-3xl font-semibold">{{ $siswa->nama }}</h1>
                <p class="mt-2 text-sm text-emerald-50">NIS {{ $siswa->nis }} • {{ $siswa->kelas->nama_kelas }} • Tingkat {{ $siswa->kelas->tingkat }}</p>
                <p class="mt-6 max-w-2xl text-sm leading-7 text-emerald-50">Lengkapi penilaian guru pada periode aktif. Hasil evaluasi Anda akan diverifikasi Guru BK dan identitas tidak akan ditampilkan kepada guru maupun kepala sekolah.</p>
            </section>
            <section class="rounded-[2rem] bg-white p-8 shadow-sm ring-1 ring-slate-200">
                <h2 class="text-lg font-semibold text-slate-900">Periode Evaluasi</h2>
                @if ($periodeAktif)
                    <p class="mt-3 text-sm text-slate-600">{{ $periodeAktif->nama_periode }}</p>
                    <p class="mt-1 text-sm text-slate-500">{{ $periodeAktif->tanggal_mulai->format('d M Y') }} - {{ $periodeAktif->tanggal_selesai->format('d M Y') }}</p>
                    <div class="mt-4">@include('partials.status-badge', ['status' => $periodeAktif->status])</div>
                @else
                    <div class="mt-4 rounded-2xl bg-amber-50 p-4 text-sm text-amber-700">Belum ada periode evaluasi aktif.</div>
                @endif
            </section>
        </div>
        <section class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <h2 class="text-xl font-semibold text-slate-900">Guru Pengajar di Kelas Anda</h2>
            <p class="mt-1 text-sm text-slate-500">Isi evaluasi hanya untuk guru yang memang mengajar di kelas Anda.</p>
            <div class="mt-6 overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-sm">
                    <thead>
                        <tr class="text-left text-slate-500">
                            <th class="px-4 py-3 font-medium">Nama Guru</th>
                            <th class="px-4 py-3 font-medium">Mata Pelajaran</th>
                            <th class="px-4 py-3 font-medium">Status</th>
                            <th class="px-4 py-3 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($gurus as $guru)
                            <tr>
                                <td class="px-4 py-4 font-medium text-slate-900">{{ $guru['nama'] }}</td>
                                <td class="px-4 py-4 text-slate-600">{{ $guru['mata_pelajaran'] }}</td>
                                <td class="px-4 py-4">@include('partials.status-badge', ['status' => $guru['status']])</td>
                                <td class="px-4 py-4">
                                    @if ($guru['bisa_menilai'])
                                        <a href="{{ route('siswa.evaluasi.create', $guru['id']) }}" class="inline-flex rounded-full bg-emerald-600 px-4 py-2 font-medium text-white hover:bg-emerald-500">Isi Evaluasi</a>
                                    @else
                                        <span class="text-slate-400">{{ $periodeAktif ? 'Tidak tersedia' : 'Menunggu periode aktif' }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-6 text-center text-slate-500">Belum ada guru yang dipetakan ke kelas ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection
