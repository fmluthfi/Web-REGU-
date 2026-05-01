@extends('layouts.app', ['title' => 'Dashboard Guru BK'])

@section('content')
    <div class="space-y-6">
        <section class="grid gap-4 md:grid-cols-3">
            <div class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200"><p class="text-sm text-slate-500">Menunggu Verifikasi</p><p class="mt-3 text-3xl font-semibold text-amber-600">{{ $pendingCount }}</p></div>
            <div class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200"><p class="text-sm text-slate-500">Terverifikasi</p><p class="mt-3 text-3xl font-semibold text-emerald-600">{{ $verifiedCount }}</p></div>
            <div class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200"><p class="text-sm text-slate-500">Ditolak</p><p class="mt-3 text-3xl font-semibold text-rose-600">{{ $rejectedCount }}</p></div>
        </section>
        <section class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <h1 class="text-xl font-semibold text-slate-900">Daftar Evaluasi Menunggu Verifikasi</h1>
            <div class="mt-6 overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-sm">
                    <thead>
                        <tr class="text-left text-slate-500">
                            <th class="px-4 py-3 font-medium">Siswa</th>
                            <th class="px-4 py-3 font-medium">Kelas</th>
                            <th class="px-4 py-3 font-medium">Guru</th>
                            <th class="px-4 py-3 font-medium">Periode</th>
                            <th class="px-4 py-3 font-medium">Status</th>
                            <th class="px-4 py-3 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($pendingEvaluasis as $evaluasi)
                            <tr>
                                <td class="px-4 py-4 text-slate-900">{{ $evaluasi->siswa->nama }} <span class="text-xs text-slate-500">({{ $evaluasi->siswa->nis }})</span></td>
                                <td class="px-4 py-4 text-slate-600">{{ $evaluasi->siswa->kelas->nama_kelas }}</td>
                                <td class="px-4 py-4 text-slate-600">{{ $evaluasi->guru->nama }}</td>
                                <td class="px-4 py-4 text-slate-600">{{ $evaluasi->periodeEvaluasi->nama_periode }}</td>
                                <td class="px-4 py-4">@include('partials.status-badge', ['status' => $evaluasi->status])</td>
                                <td class="px-4 py-4"><a href="{{ route('bk.evaluasi.show', $evaluasi) }}" class="rounded-full bg-slate-900 px-4 py-2 font-medium text-white hover:bg-slate-700">Lihat Detail</a></td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="px-4 py-6 text-center text-slate-500">Tidak ada evaluasi yang menunggu verifikasi.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection
