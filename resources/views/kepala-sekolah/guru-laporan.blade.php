@extends('layouts.app', ['title' => 'Laporan Guru - ' . $guru->nama])

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    /* Global Premium Background */
    body {
        background-color: #f8fafc;
        background-image: 
            radial-gradient(circle at 15% 50%, rgba(14, 165, 233, 0.08), transparent 25%),
            radial-gradient(circle at 85% 30%, rgba(37, 99, 235, 0.08), transparent 25%),
            url("data:image/svg+xml,%3Csvg width='24' height='24' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%230ea5e9' fill-opacity='0.05' fill-rule='evenodd'%3E%3Ccircle cx='3' cy='3' r='1.5'/%3E%3C/g%3E%3C/svg%3E");
        background-attachment: fixed;
    }

    /* Identical Base Styles to Dashboard */
    .font-pj { font-family: 'Plus Jakarta Sans', sans-serif; }
    
    .bento-card {
        background: #ffffff;
        border-radius: 24px;
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: 
            0 4px 6px -1px rgba(0, 0, 0, 0.02), 
            0 10px 15px -3px rgba(0, 0, 0, 0.03),
            inset 0 1px 0 rgba(255, 255, 255, 1);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
    }
    .bento-card:hover {
        transform: translateY(-4px);
        box-shadow: 
            0 15px 30px -5px rgba(37, 99, 235, 0.1), 
            0 8px 10px -5px rgba(37, 99, 235, 0.05),
            inset 0 1px 0 rgba(255, 255, 255, 1);
    }

    /* Dashboard-style Mesh Header */
    .mesh-header {
        background-color: #0f172a;
        background-image: 
            radial-gradient(at 0% 0%, hsla(253,16%,7%,1) 0, transparent 50%), 
            radial-gradient(at 50% 0%, hsla(225,39%,30%,1) 0, transparent 50%), 
            radial-gradient(at 100% 0%, hsla(217,91%,60%,1) 0, transparent 50%);
        border: none;
        box-shadow: 0 20px 25px -5px rgba(15, 23, 42, 0.2);
    }

    /* Button consistent with Dashboard */
    .btn-glow {
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        color: white;
        font-weight: 700;
        border-radius: 14px;
        padding: 0.875rem 1.5rem;
        transition: all 0.3s;
        position: relative;
        z-index: 1;
        overflow: hidden;
        border: none;
        cursor: pointer;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        text-decoration: none;
    }
    .btn-glow::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, #1d4ed8, #2563eb);
        z-index: -1;
        transition: opacity 0.3s;
        opacity: 0;
    }
    .btn-glow:hover::before { opacity: 1; }
    .btn-glow:hover {
        box-shadow: 0 8px 20px -6px rgba(37, 99, 235, 0.6);
        transform: translateY(-2px);
    }

    /* Score Ring (same as dashboard) */
    .progress-circle {
        transform: rotate(-90deg);
        transform-origin: 50% 50%;
    }
    .progress-circle-bg { fill: none; stroke: #f1f5f9; stroke-width: 8; }
    .progress-circle-value {
        fill: none;
        stroke: url(#blueGradient);
        stroke-width: 8;
        stroke-linecap: round;
        stroke-dasharray: 283;
        stroke-dashoffset: 283;
        transition: stroke-dashoffset 1.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    /* Score Bar (same as dashboard table) */
    .score-track {
        background-color: #f1f5f9;
        border-radius: 999px;
        height: 8px;
        width: 100%;
        overflow: hidden;
    }
    .score-fill {
        background: linear-gradient(90deg, #38bdf8, #2563eb);
        height: 100%;
        border-radius: 999px;
        transition: width 1s ease-out;
    }

    /* Badges */
    .badge-modern {
        padding: 0.4rem 0.8rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 800;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
    }
    .badge-sb { background-color: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; }
    .badge-b { background-color: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; }
    .badge-c { background-color: #fffbeb; color: #b45309; border: 1px solid #fde68a; }
    .badge-k { background-color: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; }

    /* Animations */
    .animate-enter { opacity: 0; animation: enter 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    @keyframes enter {
        0% { opacity: 0; transform: translateY(30px) scale(0.95); }
        100% { opacity: 1; transform: translateY(0) scale(1); }
    }
    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }

</style>

<div class="font-pj space-y-6 max-w-[1400px] mx-auto">

    <!-- 1. HEADER (Identical to Dashboard Header structure) -->
    <div class="bento-card mesh-header p-8 sm:p-12 animate-enter text-white">
        <div class="relative z-10 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-8">
            <div class="max-w-2xl">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 mb-6 text-sky-100">
                    <a href="{{ route('kepala-sekolah.dashboard') }}" class="hover:text-white transition-colors flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        <span class="text-xs font-bold tracking-widest uppercase ml-1">Kembali</span>
                    </a>
                    <span class="text-xs text-white/50 px-2">•</span>
                    <span class="text-xs font-bold tracking-widest uppercase">Laporan Kinerja Guru</span>
                </div>
                
                <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight mb-4 leading-tight">
                    {{ $guru->nama }}
                </h1>
                
                <div class="flex flex-wrap items-center gap-3">
                    <span class="px-4 py-2 rounded-xl bg-white/10 backdrop-blur-md border border-white/10 text-sm font-bold text-sky-100">
                        📚 {{ $guru->mata_pelajaran }}
                    </span>
                    @if($guru->nip)
                    <span class="px-4 py-2 rounded-xl bg-white/10 backdrop-blur-md border border-white/10 text-sm font-bold text-sky-100 font-mono">
                        NIP: {{ $guru->nip }}
                    </span>
                    @endif
                </div>
            </div>
            
            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-3xl p-6 min-w-[240px] flex flex-col justify-center items-center shrink-0 shadow-2xl">
                <p class="text-sky-200/80 text-xs font-black uppercase tracking-widest mb-2">Periode</p>
                <p class="text-xl font-extrabold text-center mb-4">{{ $periode?->nama_periode ?? 'Semua Periode' }}</p>
                <a href="{{ route('kepala-sekolah.guru.laporan.pdf', ['guru' => $guru->id, 'periode_id' => $periode?->id]) }}" class="w-full btn-glow flex items-center justify-center gap-2 py-3 bg-white text-slate-900 border-none before:hidden hover:shadow-lg hover:shadow-white/20 hover:-translate-y-1">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    <span>Cetak Laporan</span>
                </a>
            </div>
        </div>
    </div>

    <!-- 2. BENTO GRID (Stats & Metrics) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        <!-- LEFT: Overall Score (Matches Dashboard Stat Card) -->
        <div class="bento-card p-6 sm:p-8 lg:col-span-4 flex flex-col items-center justify-center text-center animate-enter delay-1 group">
            <div class="absolute -right-12 -top-12 w-40 h-40 bg-blue-50 rounded-full blur-3xl group-hover:bg-blue-100 transition-colors duration-500"></div>
            
            <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-6 relative z-10">Skor Akhir Kinerja</h3>
            
            <div class="relative w-40 h-40 shrink-0 mb-6">
                <svg viewBox="0 0 100 100" class="w-full h-full progress-circle drop-shadow-md">
                    <defs>
                        <linearGradient id="blueGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" stop-color="#38bdf8" />
                            <stop offset="100%" stop-color="#2563eb" />
                        </linearGradient>
                    </defs>
                    <circle class="progress-circle-bg" cx="50" cy="50" r="45" />
                    <circle class="progress-circle-value" cx="50" cy="50" r="45" style="stroke-dashoffset: {{ 283 - (283 * min($summary['avg_skor_akhir'], 100) / 100) }};" />
                </svg>
                <div class="absolute inset-0 flex flex-col items-center justify-center">
                    <span class="text-4xl font-black text-slate-800 tracking-tighter">{{ number_format($summary['avg_skor_akhir'], 1) }}</span>
                </div>
            </div>

            @php
                $kat = $summary['kategori_akhir'];
                $badgeClass = match(true) {
                    $kat === 'Sangat Baik' => 'badge-sb',
                    $kat === 'Baik' => 'badge-b',
                    $kat === 'Cukup' => 'badge-c',
                    default => 'badge-k'
                };
            @endphp
            <div class="relative z-10 mb-4">
                <span class="badge-modern {{ $badgeClass }} px-4 py-2 text-sm">
                    Kategori: {{ $kat }}
                </span>
            </div>

            <div class="w-full pt-4 mt-2 border-t border-slate-100 flex items-center justify-between relative z-10">
                <span class="text-sm font-bold text-slate-500">Total Responden</span>
                <span class="text-lg font-black text-slate-800">{{ $summary['jumlah_evaluasi'] }} Siswa</span>
            </div>
        </div>

        <!-- RIGHT: 4 Detailed Metrics -->
        <div class="bento-card p-6 sm:p-8 lg:col-span-8 animate-enter delay-2 flex flex-col">
            <div class="mb-8">
                <h2 class="text-xl font-extrabold text-slate-800">Rincian Penilaian Evaluasi</h2>
                <p class="text-sm font-medium text-slate-500 mt-1">Nilai rata-rata dari 4 indikator utama pengajaran (Skala 5.00)</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 flex-1">
                @php
                    $metrics = [
                        ['label' => 'Kejelasan Materi', 'val' => $summary['avg_kejelasan'], 'icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z'],
                        ['label' => 'Ketepatan Kehadiran', 'val' => $summary['avg_ketepatan_waktu'], 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['label' => 'Interaksi Siswa', 'val' => $summary['avg_interaksi'], 'icon' => 'M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z'],
                        ['label' => 'Metode Pembelajaran', 'val' => $summary['avg_metode'], 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10']
                    ];
                @endphp

                @foreach($metrics as $m)
                @php $pct = ($m['val'] / 5) * 100; @endphp
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100 hover:border-blue-200 hover:bg-blue-50/30 transition-colors group">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-white text-blue-500 shadow-sm flex items-center justify-center border border-slate-100 group-hover:bg-blue-500 group-hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $m['icon'] }}"></path></svg>
                        </div>
                        <h3 class="font-bold text-slate-700">{{ $m['label'] }}</h3>
                    </div>
                    
                    <div class="flex items-center gap-4 mb-2">
                        <span class="font-black text-2xl text-slate-800">{{ number_format($m['val'], 2) }}</span>
                    </div>
                    
                    <div class="score-track">
                        <div class="score-fill" style="width: {{ $pct }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>

    <!-- 3. COMMENTS TABLE (Matches Dashboard Table Style) -->
    <div class="bento-card animate-enter delay-3">
        <div class="p-6 sm:p-8 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white">
            <div>
                <h2 class="text-xl font-extrabold text-slate-800 flex items-center gap-2">💬 Ulasan Tertulis</h2>
                <p class="text-sm font-medium text-slate-500 mt-1">Komentar anonim dari siswa yang telah dikurasi.</p>
            </div>
            <span class="bg-slate-100 text-slate-600 px-4 py-2 rounded-xl font-bold text-sm border border-slate-200">
                {{ $evaluasis->count() }} Komentar
            </span>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <tbody class="bg-white">
                    @forelse($evaluasis as $evaluasi)
                    <tr class="border-b border-slate-100 hover:bg-slate-50/80 transition-colors">
                        <td class="p-6 sm:p-8">
                            <p class="text-slate-700 font-medium leading-relaxed text-[15px] mb-4">
                                "{{ $evaluasi->komentar }}"
                            </p>
                            <div class="flex items-center gap-3">
                                <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-widest border border-blue-100">Anonim</span>
                                <span class="text-xs font-bold text-slate-400">{{ $evaluasi->created_at->format('d M Y') }}</span>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="p-12">
                            <div class="flex flex-col items-center justify-center text-center">
                                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4 border border-slate-100">
                                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                </div>
                                <p class="text-lg font-bold text-slate-600 mb-1">Belum Ada Ulasan</p>
                                <p class="text-sm font-medium text-slate-500 max-w-sm">Tidak ada komentar terverifikasi untuk guru ini pada periode yang dipilih.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
