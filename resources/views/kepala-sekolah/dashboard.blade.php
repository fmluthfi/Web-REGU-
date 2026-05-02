@extends('layouts.app', ['title' => 'Dashboard Kepala Sekolah'])

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

    /* Base & Typography */
    .font-pj { font-family: 'Plus Jakarta Sans', sans-serif; }
    
    /* Bento Card Styling */
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

    /* Mesh Header */
    .mesh-header {
        background-color: #0f172a;
        background-image: 
            radial-gradient(at 0% 0%, hsla(253,16%,7%,1) 0, transparent 50%), 
            radial-gradient(at 50% 0%, hsla(225,39%,30%,1) 0, transparent 50%), 
            radial-gradient(at 100% 0%, hsla(217,91%,60%,1) 0, transparent 50%);
        border: none;
        box-shadow: 0 20px 25px -5px rgba(15, 23, 42, 0.2);
    }

    /* Form Controls */
    .modern-select {
        appearance: none;
        background-color: #f8fafc;
        border: 2px solid #e2e8f0;
        padding: 0.875rem 3rem 0.875rem 1.25rem;
        border-radius: 16px;
        font-weight: 700;
        color: #1e293b;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2.5' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1.25rem center;
        background-size: 1.2em;
        transition: all 0.2s;
        cursor: pointer;
    }
    .modern-select:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
        background-color: #ffffff;
    }

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

    .btn-outline-modern {
        background: transparent;
        color: #475569;
        font-weight: 700;
        border-radius: 14px;
        padding: 0.875rem 1.5rem;
        border: 2px solid #cbd5e1;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        cursor: pointer;
        text-decoration: none;
    }
    .btn-outline-modern:hover {
        background: #f8fafc;
        color: #0f172a;
        border-color: #94a3b8;
    }

    /* Animated Circle */
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

    /* Table */
    .modern-table th {
        background-color: #ffffff;
        color: #64748b;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-size: 0.75rem;
        padding: 1.25rem 1.5rem;
        border-bottom: 2px solid #f1f5f9;
    }
    .modern-table td {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
        vertical-align: middle;
        transition: background-color 0.2s;
    }
    .modern-table tbody tr { transition: transform 0.2s ease, box-shadow 0.2s ease; }
    .modern-table tbody tr:hover {
        background-color: #ffffff;
        box-shadow: 0 4px 15px -3px rgba(0,0,0,0.05);
        transform: scale(1.005);
        border-radius: 16px;
        z-index: 10;
        position: relative;
    }
    .modern-table tbody tr:hover td { border-bottom-color: transparent; }
    .modern-table tbody tr:last-child td { border-bottom: none; }

    /* Score Bar in Table */
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

    /* Rank Icons */
    .rank-icon {
        width: 40px; height: 40px;
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-weight: 800; font-size: 1rem;
    }
    .rank-1 { background: linear-gradient(135deg, #fef08a, #eab308); color: #713f12; box-shadow: 0 4px 10px rgba(234,179,8,0.2); }
    .rank-2 { background: linear-gradient(135deg, #f1f5f9, #cbd5e1); color: #334155; }
    .rank-3 { background: linear-gradient(135deg, #ffedd5, #fdba74); color: #9a3412; }
    .rank-n { background: #f8fafc; color: #64748b; border: 2px solid #f1f5f9; }

    /* Animations */
    .animate-enter { opacity: 0; animation: enter 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    @keyframes enter {
        0% { opacity: 0; transform: translateY(30px) scale(0.95); }
        100% { opacity: 1; transform: translateY(0) scale(1); }
    }
    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }
    .delay-4 { animation-delay: 0.4s; }

</style>

<div class="font-pj space-y-6 max-w-[1400px] mx-auto">

    <!-- 1. HEADER (Mesh Gradient) -->
    <div class="bento-card mesh-header p-8 sm:p-12 animate-enter text-white">
        <div class="relative z-10 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-8">
            <div class="max-w-2xl">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 mb-6">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span class="text-xs font-bold tracking-widest uppercase text-sky-100">Live Dashboard</span>
                </div>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight mb-4 leading-tight">
                    Kinerja <span class="text-transparent bg-clip-text bg-gradient-to-r from-sky-400 to-blue-200">Tenaga Pendidik</span>
                </h1>
                <p class="text-sky-100/90 text-lg font-medium leading-relaxed">
                    Tinjauan komprehensif hasil evaluasi siswa terhadap guru. Data telah diverifikasi untuk memastikan akurasi.
                </p>
            </div>
            
            @if($periode)
            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-3xl p-6 min-w-[240px] text-center shrink-0 shadow-2xl">
                <p class="text-sky-200/80 text-xs font-black uppercase tracking-widest mb-2">Periode Aktif</p>
                <p class="text-2xl font-extrabold">{{ $periode->nama_periode }}</p>
                <div class="mt-4 text-sm bg-white/15 rounded-xl py-2 px-4 inline-block font-bold">
                    {{ ucfirst(str_replace('_',' ',$periode->status)) }}
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- 2. BENTO GRID -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        <!-- FILTER (Left Sidebar on Desktop) -->
        <div class="bento-card p-6 sm:p-8 lg:col-span-4 flex flex-col animate-enter delay-1 bg-gradient-to-b from-white to-slate-50/50">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center text-xl shadow-inner">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                </div>
                <div>
                    <h2 class="text-xl font-extrabold text-slate-800">Filter Data</h2>
                    <p class="text-sm font-medium text-slate-500">Sesuaikan tampilan</p>
                </div>
            </div>
            
            <form method="GET" class="flex-1 flex flex-col">
                <div class="mb-6">
                    <label class="block text-xs font-extrabold text-slate-500 uppercase tracking-widest mb-3">Pilih Periode</label>
                    <select name="periode_id" class="modern-select w-full">
                        @foreach($periodes as $item)
                        <option value="{{ $item->id }}" @selected($periode?->id===$item->id)>{{ $item->nama_periode }}</option>
                        @endforeach
                    </select>
                </div>

                @if($periode)
                <div class="bg-white rounded-2xl p-5 mb-8 border border-slate-200 shadow-sm flex-1">
                    <div class="space-y-4">
                        <div class="flex justify-between items-center pb-4 border-b border-slate-100">
                            <span class="text-sm font-bold text-slate-500">Mulai</span>
                            <span class="text-sm font-extrabold text-slate-800">{{ \Carbon\Carbon::parse($periode->tanggal_mulai)->isoFormat('D MMM Y') }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-bold text-slate-500">Selesai</span>
                            <span class="text-sm font-extrabold text-slate-800">{{ \Carbon\Carbon::parse($periode->tanggal_selesai)->isoFormat('D MMM Y') }}</span>
                        </div>
                    </div>
                </div>
                @endif

                <div class="mt-auto space-y-4">
                    <button type="submit" class="btn-glow w-full text-base py-4">Terapkan Filter</button>
                    <a href="{{ route('kepala-sekolah.periode.index') }}" class="btn-outline-modern w-full py-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Kelola Periode
                    </a>
                </div>
            </form>
        </div>

        <!-- STATS & CHART (Right Area on Desktop) -->
        <div class="lg:col-span-8 flex flex-col gap-6">
            
            <!-- Quick Stats -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Stat 1 -->
                <div class="bento-card p-6 sm:p-8 flex items-center gap-6 animate-enter delay-2 group">
                    <div class="absolute -right-12 -top-12 w-40 h-40 bg-blue-50 rounded-full blur-3xl group-hover:bg-blue-100 transition-colors duration-500"></div>
                    <div class="relative w-28 h-28 shrink-0">
                        <svg viewBox="0 0 100 100" class="w-full h-full progress-circle drop-shadow-md">
                            <defs>
                                <linearGradient id="blueGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                    <stop offset="0%" stop-color="#38bdf8" />
                                    <stop offset="100%" stop-color="#2563eb" />
                                </linearGradient>
                            </defs>
                            <circle class="progress-circle-bg" cx="50" cy="50" r="45" />
                            <circle class="progress-circle-value" cx="50" cy="50" r="45" style="stroke-dashoffset: {{ 283 - (283 * min($avgKeseluruhan, 100) / 100) }};" />
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <span class="text-3xl font-black text-slate-800 tracking-tighter">{{ number_format($avgKeseluruhan, 1) }}</span>
                        </div>
                    </div>
                    <div class="relative z-10">
                        <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Rata-rata Skor</h3>
                        <p class="text-sm font-semibold text-slate-600 leading-relaxed">Nilai agregat seluruh guru yang dievaluasi.</p>
                    </div>
                </div>

                <!-- Stat 2 -->
                <div class="bento-card p-6 sm:p-8 flex flex-col justify-center animate-enter delay-3 group bg-gradient-to-br from-white to-emerald-50/30">
                    <div class="absolute -right-8 -bottom-8 w-32 h-32 bg-emerald-100/50 rounded-full blur-3xl group-hover:bg-emerald-200/50 transition-colors duration-500"></div>
                    <div class="relative z-10 flex items-start justify-between mb-4">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-400 to-emerald-600 text-white flex items-center justify-center shadow-lg shadow-emerald-500/30">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                    <div class="relative z-10">
                        <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Total Verifikasi</h3>
                        <div class="flex items-baseline gap-2">
                            <span class="text-5xl font-black text-slate-800 tracking-tighter count-up" data-value="{{ $verifiedCount }}">0</span>
                            <span class="text-base font-bold text-slate-500">Evaluasi</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart -->
            <div class="bento-card p-6 sm:p-8 animate-enter delay-4 flex-1 flex flex-col">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
                    <div>
                        <h2 class="text-xl font-extrabold text-slate-800">Tren Skor Guru</h2>
                        <p class="text-sm font-medium text-slate-500 mt-1">Distribusi nilai rata-rata per individu.</p>
                    </div>
                    @if($chartLabels->count())
                    <span class="bg-blue-50 text-blue-700 text-xs font-black uppercase tracking-widest px-4 py-2 rounded-xl border border-blue-100">
                        {{ $chartLabels->count() }} Data
                    </span>
                    @endif
                </div>
                
                <div class="relative flex-1 min-h-[280px] w-full">
                    @if($chartLabels->count())
                        <canvas id="mainChart"></canvas>
                    @else
                        <div class="absolute inset-0 flex flex-col items-center justify-center text-slate-400 bg-slate-50/50 rounded-2xl border border-dashed border-slate-200">
                            <svg class="w-16 h-16 mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                            <p class="font-bold text-lg text-slate-600">Belum Ada Data</p>
                            <p class="text-sm mt-1">Grafik akan muncul setelah ada evaluasi yang diverifikasi.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- 3. TABLE SECTION -->
    <div class="bento-card animate-enter delay-4 mt-6">
        <div class="p-6 sm:p-8 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white">
            <div>
                <h2 class="text-2xl font-black text-slate-800">Peringkat Kinerja</h2>
                <p class="text-base font-medium text-slate-500 mt-1">Daftar lengkap guru diurutkan dari nilai tertinggi.</p>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="modern-table w-full text-left">
                <thead>
                    <tr>
                        <th class="w-20 text-center">Posisi</th>
                        <th>Profil Tenaga Pendidik</th>
                        <th>Mata Pelajaran</th>
                        <th class="text-center">Jml Evaluasi</th>
                        <th class="w-56">Pencapaian Skor</th>
                        <th>Status</th>
                        <th class="text-right">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="bg-slate-50/30">
                    @forelse($guruSummaries as $i => $item)
                    @php
                        $skor = $item['rata_skor_akhir'];
                        $kat = $item['kategori'];
                        $badgeClass = match(true) {
                            $kat === 'Sangat Baik' => 'badge-sb',
                            $kat === 'Baik' => 'badge-b',
                            $kat === 'Cukup' => 'badge-c',
                            default => 'badge-k'
                        };
                        $rankClass = match($i) { 0 => 'rank-1', 1 => 'rank-2', 2 => 'rank-3', default => 'rank-n' };
                        $rankIcon = match($i) { 0 => '1', 1 => '2', 2 => '3', default => $i + 1 };
                    @endphp
                    <tr>
                        <td class="text-center">
                            <div class="mx-auto rank-icon {{ $rankClass }}">
                                {{ $rankIcon }}
                            </div>
                        </td>
                        <td>
                            <div class="font-extrabold text-slate-800 text-base mb-1">{{ $item['guru']->nama }}</div>
                            @if($item['guru']->nip)
                                <div class="inline-block px-2 py-0.5 rounded bg-slate-100 text-xs font-bold text-slate-500 font-mono border border-slate-200">NIP: {{ $item['guru']->nip }}</div>
                            @endif
                        </td>
                        <td>
                            <span class="inline-flex items-center px-3 py-1.5 rounded-lg bg-blue-50 text-blue-700 text-xs font-bold border border-blue-100">
                                {{ $item['guru']->mata_pelajaran }}
                            </span>
                        </td>
                        <td class="text-center">
                            <span class="font-extrabold text-slate-700 text-lg">{{ $item['jumlah_evaluasi'] }}</span>
                        </td>
                        <td>
                            <div class="flex items-center gap-4">
                                <span class="font-black text-slate-800 text-lg w-10">{{ number_format($skor, 1) }}</span>
                                <div class="score-track">
                                    <div class="score-fill shadow-sm" style="width: {{ $skor }}%"></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge-modern {{ $badgeClass }}">
                                @if($kat === 'Sangat Baik') <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg> @endif
                                {{ $kat }}
                            </span>
                        </td>
                        <td class="text-right">
                            <a href="{{ route('kepala-sekolah.guru.laporan',['guru'=>$item['guru']->id,'periode_id'=>$periode?->id]) }}" 
                               class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-white border-2 border-slate-200 text-sm font-extrabold text-blue-600 shadow-sm hover:border-blue-500 hover:bg-blue-50 hover:text-blue-700 transition-all">
                                <span>Laporan</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-16">
                            <div class="flex flex-col items-center justify-center text-slate-400">
                                <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                </div>
                                <p class="font-extrabold text-lg text-slate-600 mb-1">Belum Ada Data</p>
                                <p class="text-sm font-medium">Belum ada evaluasi terverifikasi untuk periode ini.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Count Up Animation
    document.querySelectorAll('.count-up').forEach(el => {
        const target = parseInt(el.dataset.value) || 0;
        if (target === 0) return;
        let start = 0;
        const duration = 1500; // ms
        const stepTime = Math.max(10, Math.floor(duration / target)); // ensure it doesn't go too fast
        
        const timer = setInterval(() => {
            start += 1;
            el.textContent = start;
            if (start >= target) {
                el.textContent = target; // Ensure final value is exact
                clearInterval(timer);
            }
        }, stepTime);
    });

    // Main Chart Initialization
    const ctx = document.getElementById('mainChart');
    if (ctx) {
        // Line chart with smooth curves and gradient fill
        const bgGradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 300);
        bgGradient.addColorStop(0, 'rgba(59, 130, 246, 0.5)'); // blue-500 with opacity
        bgGradient.addColorStop(1, 'rgba(59, 130, 246, 0.0)');

        new Chart(ctx, {
            type: 'line', 
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    label: 'Rata-rata Skor',
                    data: @json($chartScores),
                    borderColor: '#2563eb', // blue-600
                    backgroundColor: bgGradient,
                    borderWidth: 3,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#2563eb',
                    pointBorderWidth: 3,
                    pointRadius: 5,
                    pointHoverRadius: 8,
                    fill: true,
                    tension: 0.4 // Smooth curves (Bezier)
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    y: { duration: 1500, easing: 'easeOutQuart' },
                    x: { duration: 1500, easing: 'easeOutQuart' }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1e293b', // slate-800
                        titleFont: { family: "'Plus Jakarta Sans', sans-serif", size: 14, weight: 'bold' },
                        bodyFont: { family: "'Plus Jakarta Sans', sans-serif", size: 13, weight: '500' },
                        padding: 14,
                        cornerRadius: 16,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return 'Skor: ' + context.parsed.y.toFixed(1);
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        border: { display: false },
                        ticks: {
                            font: { family: "'Plus Jakarta Sans', sans-serif", size: 12, weight: '700' },
                            color: '#64748b',
                            maxRotation: 45,
                            minRotation: 0
                        }
                    },
                    y: {
                        beginAtZero: true,
                        max: 100,
                        border: { display: false },
                        grid: { color: '#e2e8f0', strokeDash: [4, 4] },
                        ticks: {
                            font: { family: "'Plus Jakarta Sans', sans-serif", size: 12, weight: '600' },
                            color: '#94a3b8',
                            stepSize: 20
                        }
                    }
                }
            }
        });
    }
</script>
@endsection
