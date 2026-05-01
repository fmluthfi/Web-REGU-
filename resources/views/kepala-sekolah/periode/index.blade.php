@extends('layouts.app', ['title' => 'Periode Evaluasi'])

@section('content')
    <div class="space-y-6">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-slate-900">Manajemen Periode Evaluasi</h1>
                <p class="mt-2 text-sm text-slate-500">Aktifkan hanya satu periode agar siswa menilai pada jendela waktu yang benar.</p>
            </div>
            <a href="{{ route('kepala-sekolah.periode.create') }}" class="rounded-full bg-sky-600 px-5 py-3 text-sm font-semibold text-white hover:bg-sky-500">Buat Periode</a>
        </div>
        <section class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-sm">
                    <thead>
                        <tr class="text-left text-slate-500">
                            <th class="px-4 py-3 font-medium">Nama Periode</th>
                            <th class="px-4 py-3 font-medium">Mulai</th>
                            <th class="px-4 py-3 font-medium">Selesai</th>
                            <th class="px-4 py-3 font-medium">Status</th>
                            <th class="px-4 py-3 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($periodes as $periode)
                            <tr>
                                <td class="px-4 py-4 font-medium text-slate-900">{{ $periode->nama_periode }}</td>
                                <td class="px-4 py-4 text-slate-600">{{ $periode->tanggal_mulai->format('d M Y') }}</td>
                                <td class="px-4 py-4 text-slate-600">{{ $periode->tanggal_selesai->format('d M Y') }}</td>
                                <td class="px-4 py-4">@include('partials.status-badge', ['status' => $periode->status])</td>
                                <td class="px-4 py-4">
                                    <div class="flex flex-wrap gap-2">
                                        @if ($periode->status !== 'aktif')
                                            <form method="POST" action="{{ route('kepala-sekolah.periode.activate', $periode) }}">@csrf<button type="submit" class="rounded-full bg-emerald-600 px-4 py-2 text-white hover:bg-emerald-500">Aktifkan</button></form>
                                        @endif
                                        @if ($periode->status !== 'selesai')
                                            <form method="POST" action="{{ route('kepala-sekolah.periode.complete', $periode) }}">@csrf<button type="submit" class="rounded-full bg-slate-900 px-4 py-2 text-white hover:bg-slate-700">Selesaikan</button></form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-4 py-6 text-center text-slate-500">Belum ada periode evaluasi.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection
