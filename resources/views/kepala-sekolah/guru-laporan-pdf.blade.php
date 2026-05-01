<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Evaluasi Guru</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #0f172a; font-size: 12px; }
        h1, h2 { margin: 0 0 10px; }
        .section { margin-bottom: 20px; }
        .card { border: 1px solid #cbd5e1; border-radius: 10px; padding: 12px; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #cbd5e1; padding: 8px; text-align: left; }
        th { background: #e2e8f0; }
    </style>
</head>
<body>
    <div class="section">
        <h1>Laporan Evaluasi Guru</h1>
        <p>Nama Guru: {{ $guru->nama }}</p>
        <p>Mata Pelajaran: {{ $guru->mata_pelajaran }}</p>
        <p>Periode: {{ $periode?->nama_periode ?? 'Semua Periode' }}</p>
    </div>
    <div class="section">
        <table>
            <tr><th>Jumlah Evaluasi Terverifikasi</th><td>{{ $summary['jumlah_evaluasi'] }}</td></tr>
            <tr><th>Rata-rata Kejelasan</th><td>{{ number_format($summary['avg_kejelasan'], 2) }}</td></tr>
            <tr><th>Rata-rata Ketepatan Waktu</th><td>{{ number_format($summary['avg_ketepatan_waktu'], 2) }}</td></tr>
            <tr><th>Rata-rata Interaksi</th><td>{{ number_format($summary['avg_interaksi'], 2) }}</td></tr>
            <tr><th>Rata-rata Metode</th><td>{{ number_format($summary['avg_metode'], 2) }}</td></tr>
            <tr><th>Skor Akhir</th><td>{{ number_format($summary['avg_skor_akhir'], 2) }}</td></tr>
            <tr><th>Kategori</th><td>{{ $summary['kategori_akhir'] }}</td></tr>
        </table>
    </div>
    <div class="section">
        <h2>Komentar Siswa Anonim</h2>
        @forelse ($evaluasis as $evaluasi)
            <div class="card">
                <p>{{ $evaluasi->komentar }}</p>
                <p>Tanggal: {{ $evaluasi->created_at->format('d M Y') }}</p>
            </div>
        @empty
            <p>Belum ada komentar terverifikasi.</p>
        @endforelse
    </div>
</body>
</html>
