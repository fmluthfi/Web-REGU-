@extends('layouts.app', ['title' => 'Dashboard Siswa'])

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
        color: white;
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
    .delay-4 { animation-delay: 0.4s; }

</style>

@php
    $totalGuru = $gurus->count();
    $selesai = $gurus->where('sudah_dinilai', true)->count();
    $belum = $totalGuru - $selesai;
    $progress = $totalGuru > 0 ? ($selesai / $totalGuru) * 100 : 0;
@endphp

<div class="font-pj space-y-6 max-w-[1400px] mx-auto">

    <!-- 1. HEADER (Mesh Gradient) -->
    <div class="bento-card mesh-header p-8 sm:p-12 animate-enter text-white">
        <div class="relative z-10 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-8">
            <div class="max-w-2xl">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 mb-6">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span class="text-xs font-bold tracking-widest uppercase text-sky-100">Portal Siswa</span>
                </div>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight mb-4 leading-tight">
                    Halo, <span class="text-transparent bg-clip-text bg-gradient-to-r from-sky-400 to-blue-200">{{ explode(' ', $siswa->nama)[0] }}</span> 👋
                </h1>
                <p class="text-sky-100/90 text-lg font-medium leading-relaxed mb-4">
                    NIS: <span class="font-bold text-white">{{ $siswa->nis }}</span> • Kelas: <span class="font-bold text-white">{{ $siswa->kelas->nama_kelas }}</span>
                </p>
                <p class="text-sky-200/80 text-sm leading-relaxed max-w-xl">
                    Lengkapi penilaian guru pada periode aktif. Hasil evaluasi Anda akan diverifikasi Guru BK dan identitas <strong class="text-white">tidak akan ditampilkan</strong> kepada guru maupun kepala sekolah.
                </p>
            </div>
            
            @if($periodeAktif)
            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-3xl p-6 min-w-[240px] text-center shrink-0 shadow-2xl">
                <p class="text-sky-200/80 text-xs font-black uppercase tracking-widest mb-2">Periode Evaluasi</p>
                <p class="text-2xl font-extrabold">{{ $periodeAktif->nama_periode }}</p>
                <p class="text-sm text-sky-100 mt-2 font-medium">
                    {{ \Carbon\Carbon::parse($periodeAktif->tanggal_mulai)->isoFormat('D MMM Y') }} - {{ \Carbon\Carbon::parse($periodeAktif->tanggal_selesai)->isoFormat('D MMM Y') }}
                </p>
                <div class="mt-4 text-sm bg-emerald-500/20 text-emerald-100 border border-emerald-400/30 rounded-xl py-2 px-4 inline-block font-bold">
                    Aktif & Berjalan
                </div>
            </div>
            @else
            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-3xl p-6 min-w-[240px] text-center shrink-0 shadow-2xl">
                 <p class="text-sky-200/80 text-xs font-black uppercase tracking-widest mb-2">Status Periode</p>
                 <p class="text-xl font-extrabold text-amber-300">Belum Ada Periode Aktif</p>
            </div>
            @endif
        </div>
    </div>

    <!-- 2. STATS & INFO -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <!-- Progress Circular -->
        <div class="bento-card p-6 sm:p-8 flex items-center gap-6 animate-enter delay-1 group">
            <div class="absolute -right-12 -top-12 w-40 h-40 bg-blue-50 rounded-full blur-3xl group-hover:bg-blue-100 transition-colors duration-500"></div>
            <div class="relative w-24 h-24 shrink-0">
                <svg viewBox="0 0 100 100" class="w-full h-full progress-circle drop-shadow-md">
                    <defs>
                        <linearGradient id="blueGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" stop-color="#38bdf8" />
                            <stop offset="100%" stop-color="#2563eb" />
                        </linearGradient>
                    </defs>
                    <circle class="progress-circle-bg" cx="50" cy="50" r="45" />
                    <circle class="progress-circle-value" cx="50" cy="50" r="45" style="stroke-dashoffset: {{ 283 - (283 * $progress / 100) }};" />
                </svg>
                <div class="absolute inset-0 flex flex-col items-center justify-center">
                    <span class="text-2xl font-black text-slate-800 tracking-tighter">{{ round($progress) }}%</span>
                </div>
            </div>
            <div class="relative z-10">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Progress Evaluasi</h3>
                <p class="text-sm font-semibold text-slate-600 leading-relaxed">Dari total {{ $totalGuru }} guru di kelas Anda.</p>
            </div>
        </div>

        <!-- Stat: Selesai -->
        <div class="bento-card p-6 sm:p-8 flex flex-col justify-center animate-enter delay-2 group bg-gradient-to-br from-white to-emerald-50/30">
            <div class="absolute -right-8 -bottom-8 w-32 h-32 bg-emerald-100/50 rounded-full blur-3xl group-hover:bg-emerald-200/50 transition-colors duration-500"></div>
            <div class="relative z-10 flex items-start justify-between mb-4">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-emerald-400 to-emerald-600 text-white flex items-center justify-center shadow-lg shadow-emerald-500/30">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <div class="relative z-10">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Sudah Dinilai</h3>
                <div class="flex items-baseline gap-2">
                    <span class="text-4xl font-black text-slate-800 tracking-tighter count-up" data-value="{{ $selesai }}">0</span>
                    <span class="text-sm font-bold text-slate-500">Guru</span>
                </div>
            </div>
        </div>

        <!-- Stat: Belum -->
        <div class="bento-card p-6 sm:p-8 flex flex-col justify-center animate-enter delay-3 group bg-gradient-to-br from-white to-amber-50/30">
            <div class="absolute -right-8 -bottom-8 w-32 h-32 bg-amber-100/50 rounded-full blur-3xl group-hover:bg-amber-200/50 transition-colors duration-500"></div>
            <div class="relative z-10 flex items-start justify-between mb-4">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-amber-400 to-amber-500 text-white flex items-center justify-center shadow-lg shadow-amber-500/30">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <div class="relative z-10">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Belum Dinilai</h3>
                <div class="flex items-baseline gap-2">
                    <span class="text-4xl font-black text-slate-800 tracking-tighter count-up" data-value="{{ $belum }}">0</span>
                    <span class="text-sm font-bold text-slate-500">Guru</span>
                </div>
            </div>
        </div>

    </div>

    <!-- 3. TABLE SECTION -->
    <div class="bento-card animate-enter delay-4 mt-6">
        <div class="p-6 sm:p-8 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white">
            <div>
                <h2 class="text-2xl font-black text-slate-800">Daftar Guru Pengajar</h2>
                <p class="text-base font-medium text-slate-500 mt-1">Pilih guru untuk memberikan evaluasi pada periode aktif ini.</p>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="modern-table w-full text-left">
                <thead>
                    <tr>
                        <th class="w-16 text-center">No</th>
                        <th>Nama Guru</th>
                        <th>Mata Pelajaran</th>
                        <th>Status Evaluasi</th>
                        <th class="text-right">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="bg-slate-50/30">
                    @forelse($gurus as $i => $guru)
                    @php
                        $statusText = match($guru['status']) {
                            'diverifikasi' => 'Selesai (Terverifikasi)',
                            'menunggu_verifikasi' => 'Selesai (Menunggu)',
                            'ditolak' => 'Ditolak',
                            default => 'Belum Dinilai'
                        };
                        $badgeClass = match($guru['status']) {
                            'diverifikasi' => 'badge-b',
                            'menunggu_verifikasi' => 'badge-c',
                            'ditolak' => 'badge-k',
                            default => 'badge-k'
                        };
                    @endphp
                    <tr>
                        <td class="text-center font-bold text-slate-400">
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            <div class="font-extrabold text-slate-800 text-base">{{ $guru['nama'] }}</div>
                        </td>
                        <td>
                            <span class="inline-flex items-center px-3 py-1.5 rounded-lg bg-blue-50 text-blue-700 text-xs font-bold border border-blue-100">
                                {{ $guru['mata_pelajaran'] }}
                            </span>
                        </td>
                        <td>
                            <span class="badge-modern {{ $badgeClass }}">
                                @if(in_array($guru['status'], ['diverifikasi', 'menunggu_verifikasi'])) 
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg> 
                                @endif
                                {{ $statusText }}
                            </span>
                        </td>
                        <td class="text-right">
                            @if ($guru['bisa_menilai'])
                                <a href="{{ route('siswa.evaluasi.create', $guru['id']) }}" class="btn-glow text-sm py-2 px-5">
                                    Isi Evaluasi
                                </a>
                            @elseif ($guru['sudah_dinilai'])
                                <div class="inline-flex items-center justify-center gap-2 px-5 py-2 rounded-xl bg-slate-100 text-sm font-extrabold text-slate-400 cursor-not-allowed border border-slate-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                    Terkirim
                                </div>
                            @else
                                <span class="text-sm font-bold text-slate-400 bg-slate-50 px-3 py-1.5 rounded-lg border border-slate-200">
                                    {{ $periodeAktif ? 'Tidak tersedia' : 'Menunggu periode aktif' }}
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-16">
                            <div class="flex flex-col items-center justify-center text-slate-400">
                                <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mb-4 border border-slate-200">
                                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                </div>
                                <p class="font-extrabold text-lg text-slate-600 mb-1">Belum Ada Data</p>
                                <p class="text-sm font-medium">Belum ada guru yang dipetakan ke kelas ini.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

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
</script>
@endsection
