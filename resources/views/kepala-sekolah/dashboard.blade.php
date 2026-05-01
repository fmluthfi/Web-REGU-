@extends('layouts.app', ['title' => 'Dashboard Kepala Sekolah'])

@section('content')
    <div class="space-y-6">
        <section class="grid gap-4 lg:grid-cols-[0.7fr_1.3fr]">
            <div class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
                <h1 class="text-xl font-semibold text-slate-900">Filter Periode</h1>
                <form method="GET" class="mt-4 space-y-4">
                    <select name="periode_id" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
                        @foreach ($periodes as $item)
                            <option value="{{ $item->id }}" @selected($periode?->id === $item->id)>{{ $item->nama_periode }} ({{ str_replace('_', ' ', $item->status) }})</option>
                        @endforeach
                    </select>
                    <button type="submit" class="rounded-full bg-sky-600 px-5 py-3 text-sm font-semibold text-white hover:bg-sky-500">Terapkan</button>
                </form>
            </div>
            <div class="grid gap-4 md:grid-cols-3">
                <div class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200"><p class="text-sm text-slate-500">Periode Dipilih</p><p class="mt-3 text-lg font-semibold text-slate-900">{{ $periode?->nama_periode ?? 'Belum ada periode' }}</p></div>
                <div class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200"><p class="text-sm text-slate-500">Rata-rata Semua Guru</p><p class="mt-3 text-3xl font-semibold text-sky-600">{{ number_format($avgKeseluruhan, 2) }}</p></div>
                <div class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200"><p class="text-sm text-slate-500">Evaluasi Terverifikasi</p><p class="mt-3 text-3xl font-semibold text-emerald-600">{{ $verifiedCount }}</p></div>
            </div>
        </section>
        <section class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <h2 class="text-xl font-semibold text-slate-900">Rata-rata Skor Guru</h2>
            <p class="mt-1 text-sm text-slate-500">Grafik hanya memakai evaluasi yang sudah diverifikasi.</p>
            <div class="mt-6 h-96"><canvas id="guruChart"></canvas></div>
        </section>
        <section class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <h2 class="text-xl font-semibold text-slate-900">Daftar Guru</h2>
            <div class="mt-6 overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-sm">
                    <thead>
                        <tr class="text-left text-slate-500">
                            <th class="px-4 py-3 font-medium">Nama Guru</th>
                            <th class="px-4 py-3 font-medium">Mata Pelajaran</th>
                            <th class="px-4 py-3 font-medium">Evaluasi Terverifikasi</th>
                            <th class="px-4 py-3 font-medium">Rata-rata Skor</th>
                            <th class="px-4 py-3 font-medium">Kategori</th>
                            <th class="px-4 py-3 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($guruSummaries as $item)
                            <tr>
                                <td class="px-4 py-4 font-medium text-slate-900">{{ $item['guru']->nama }}</td>
                                <td class="px-4 py-4 text-slate-600">{{ $item['guru']->mata_pelajaran }}</td>
                                <td class="px-4 py-4 text-slate-600">{{ $item['jumlah_evaluasi'] }}</td>
                                <td class="px-4 py-4 text-slate-600">{{ number_format($item['rata_skor_akhir'], 2) }}</td>
                                <td class="px-4 py-4 text-slate-600">{{ $item['kategori'] }}</td>
                                <td class="px-4 py-4"><a href="{{ route('kepala-sekolah.guru.laporan', ['guru' => $item['guru']->id, 'periode_id' => $periode?->id]) }}" class="rounded-full bg-slate-900 px-4 py-2 font-medium text-white hover:bg-slate-700">Lihat Laporan</a></td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="px-4 py-6 text-center text-slate-500">Belum ada evaluasi terverifikasi pada periode ini.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('guruChart');
        if (ctx) {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($chartLabels),
                    datasets: [{
                        label: 'Rata-rata skor guru',
                        data: @json($chartScores),
                        backgroundColor: '#0ea5e9',
                        borderRadius: 14,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: { beginAtZero: true, max: 100 }
                    }
                }
            });
        }
    </script>
@endsection
