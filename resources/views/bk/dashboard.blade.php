@extends('layouts.app', ['title' => 'Dashboard Guru BK'])

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

    /* Buttons */
    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.625rem 1.25rem;
        border-radius: 12px;
        font-size: 0.875rem;
        font-weight: 700;
        transition: all 0.2s;
        background-color: #0f172a;
        color: #ffffff;
        box-shadow: 0 2px 4px rgba(15, 23, 42, 0.1);
    }
    .btn-action:hover {
        background-color: #1e293b;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(15, 23, 42, 0.2);
    }

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
    <!-- 1. HEADER (Mesh Gradient) -->
    <div class="bento-card mesh-header p-8 sm:p-12 animate-enter text-white">
        <div class="relative z-10 flex flex-col justify-center max-w-3xl">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 mb-6 w-fit">
                <span class="w-2 h-2 rounded-full bg-sky-400 animate-pulse"></span>
                <span class="text-xs font-bold tracking-widest uppercase text-sky-100">Bimbingan Konseling</span>
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight mb-4 leading-tight">
                Validasi <span class="text-transparent bg-clip-text bg-gradient-to-r from-sky-400 to-blue-200">Evaluasi</span>
            </h1>
            <p class="text-sky-100/90 text-lg font-medium leading-relaxed max-w-2xl">
                Lakukan verifikasi terhadap evaluasi kinerja guru yang diajukan oleh siswa. Pastikan keakuratan data sebelum diproses lebih lanjut.
            </p>
        </div>
    </div>

    <!-- 2. STATS GRID -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Stat 1: Pending -->
        <div class="bento-card p-6 sm:p-8 flex flex-col justify-center animate-enter delay-1 group bg-gradient-to-br from-white to-blue-50/30">
            <div class="absolute -right-8 -bottom-8 w-32 h-32 bg-blue-100/50 rounded-full blur-3xl group-hover:bg-blue-200/50 transition-colors duration-500"></div>
            <div class="relative z-10 flex items-start justify-between mb-4">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-400 to-blue-600 text-white flex items-center justify-center shadow-lg shadow-blue-500/30">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <div class="relative z-10">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Menunggu Verifikasi</h3>
                <div class="flex items-baseline gap-2">
                    <span class="text-5xl font-black text-slate-800 tracking-tighter count-up" data-value="{{ $pendingCount }}">0</span>
                    <span class="text-base font-bold text-slate-500">Evaluasi</span>
                </div>
            </div>
        </div>

        <!-- Stat 2: Verified -->
        <div class="bento-card p-6 sm:p-8 flex flex-col justify-center animate-enter delay-2 group bg-gradient-to-br from-white to-emerald-50/30">
            <div class="absolute -right-8 -bottom-8 w-32 h-32 bg-emerald-100/50 rounded-full blur-3xl group-hover:bg-emerald-200/50 transition-colors duration-500"></div>
            <div class="relative z-10 flex items-start justify-between mb-4">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-400 to-emerald-600 text-white flex items-center justify-center shadow-lg shadow-emerald-500/30">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <div class="relative z-10">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Terverifikasi</h3>
                <div class="flex items-baseline gap-2">
                    <span class="text-5xl font-black text-slate-800 tracking-tighter count-up" data-value="{{ $verifiedCount }}">0</span>
                    <span class="text-base font-bold text-slate-500">Evaluasi</span>
                </div>
            </div>
        </div>

        <!-- Stat 3: Rejected -->
        <div class="bento-card p-6 sm:p-8 flex flex-col justify-center animate-enter delay-3 group bg-gradient-to-br from-white to-rose-50/30">
            <div class="absolute -right-8 -bottom-8 w-32 h-32 bg-rose-100/50 rounded-full blur-3xl group-hover:bg-rose-200/50 transition-colors duration-500"></div>
            <div class="relative z-10 flex items-start justify-between mb-4">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-rose-400 to-rose-600 text-white flex items-center justify-center shadow-lg shadow-rose-500/30">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                </div>
            </div>
            <div class="relative z-10">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Ditolak</h3>
                <div class="flex items-baseline gap-2">
                    <span class="text-5xl font-black text-slate-800 tracking-tighter count-up" data-value="{{ $rejectedCount }}">0</span>
                    <span class="text-base font-bold text-slate-500">Evaluasi</span>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. TABLE SECTION -->
    <div class="bento-card animate-enter delay-3 mt-6">
        <div class="p-6 sm:p-8 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white">
            <div>
                <h2 class="text-2xl font-black text-slate-800">Daftar Menunggu Verifikasi</h2>
                <p class="text-base font-medium text-slate-500 mt-1">Evaluasi yang perlu Anda tinjau dan proses.</p>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="modern-table w-full text-left">
                <thead>
                    <tr>
                        <th>Siswa</th>
                        <th>Kelas</th>
                        <th>Guru Target</th>
                        <th>Periode</th>
                        <th>Status</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-slate-50/30">
                    @forelse ($pendingEvaluasis as $evaluasi)
                        <tr>
                            <td>
                                <div class="font-extrabold text-slate-800 text-base mb-1">{{ $evaluasi->siswa->nama }}</div>
                                <div class="inline-block px-2 py-0.5 rounded bg-slate-100 text-xs font-bold text-slate-500 font-mono border border-slate-200">NIS: {{ $evaluasi->siswa->nis }}</div>
                            </td>
                            <td>
                                <span class="inline-flex items-center px-3 py-1.5 rounded-lg bg-blue-50 text-blue-700 text-xs font-bold border border-blue-100">
                                    {{ $evaluasi->siswa->kelas->nama_kelas }}
                                </span>
                            </td>
                            <td>
                                <div class="font-bold text-slate-700">{{ $evaluasi->guru->nama }}</div>
                            </td>
                            <td>
                                <span class="font-medium text-slate-600">{{ $evaluasi->periodeEvaluasi->nama_periode }}</span>
                            </td>
                            <td>
                                @include('partials.status-badge', ['status' => $evaluasi->status])
                            </td>
                            <td class="text-right">
                                <a href="{{ route('bk.evaluasi.show', $evaluasi) }}" class="btn-action">
                                    <span>Lihat Detail</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-16">
                                <div class="flex flex-col items-center justify-center text-slate-400">
                                    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                                    </div>
                                    <p class="font-extrabold text-lg text-slate-600 mb-1">Semua Beres!</p>
                                    <p class="text-sm font-medium">Tidak ada evaluasi yang menunggu verifikasi saat ini.</p>
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
