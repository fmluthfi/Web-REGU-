@extends('layouts.app', ['title' => 'Detail Evaluasi - Guru BK'])

@section('content')

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
    
    .btn-glow-emerald {
        background: linear-gradient(135deg, #10b981, #34d399);
        color: white;
        font-weight: 700;
        border-radius: 14px;
        padding: 0.875rem 1.5rem;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        box-shadow: 0 4px 10px rgba(16, 185, 129, 0.3);
    }
    .btn-glow-emerald:hover {
        box-shadow: 0 8px 20px -6px rgba(16, 185, 129, 0.6);
        transform: translateY(-2px);
    }

    .btn-glow-rose {
        background: linear-gradient(135deg, #f43f5e, #fb7185);
        color: white;
        font-weight: 700;
        border-radius: 14px;
        padding: 0.875rem 1.5rem;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        box-shadow: 0 4px 10px rgba(244, 63, 94, 0.3);
    }
    .btn-glow-rose:hover {
        box-shadow: 0 8px 20px -6px rgba(244, 63, 94, 0.6);
        transform: translateY(-2px);
    }

    .modern-textarea {
        width: 100%;
        border-radius: 16px;
        border: 2px solid #e2e8f0;
        padding: 1rem;
        transition: all 0.2s;
    }
    .modern-textarea:focus {
        outline: none;
        border-color: #f43f5e;
        box-shadow: 0 0 0 4px rgba(244, 63, 94, 0.15);
    }

    .animate-enter { opacity: 0; animation: enter 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    @keyframes enter {
        0% { opacity: 0; transform: translateY(30px) scale(0.95); }
        100% { opacity: 1; transform: translateY(0) scale(1); }
    }
</style>

<div class="space-y-6 max-w-[1000px] mx-auto">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('bk.dashboard') }}" class="w-10 h-10 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-500 hover:text-blue-600 hover:bg-blue-50 hover:border-blue-200 transition-all shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
        </a>
        <h1 class="text-2xl font-extrabold text-slate-800">Kembali ke Dashboard</h1>
    </div>

    <div class="bento-card p-8 sm:p-10 animate-enter">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8 pb-6 border-b border-slate-100">
            <div>
                <h2 class="text-3xl font-black text-slate-800">Detail Evaluasi</h2>
                <div class="mt-2 inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-slate-100 text-sm font-bold text-slate-600 border border-slate-200">
                    Periode: {{ $evaluasi->periodeEvaluasi->nama_periode }}
                </div>
            </div>
            <div>
                @include('partials.status-badge', ['status' => $evaluasi->status])
            </div>
        </div>

        <!-- Info Siswa & Guru -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="rounded-2xl bg-gradient-to-br from-blue-50/50 to-indigo-50/50 p-6 border border-blue-100/50">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <h3 class="font-extrabold text-slate-800 text-lg">Informasi Siswa</h3>
                </div>
                <div class="space-y-3">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Nama Lengkap</p>
                        <p class="font-bold text-slate-700">{{ $evaluasi->siswa->nama }}</p>
                    </div>
                    <div class="flex gap-6">
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">NIS</p>
                            <p class="font-mono font-bold text-slate-600">{{ $evaluasi->siswa->nis }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Kelas</p>
                            <p class="font-bold text-slate-600 bg-white px-2 py-0.5 rounded border border-slate-200 shadow-sm text-sm inline-block">{{ $evaluasi->siswa->kelas->nama_kelas }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl bg-gradient-to-br from-sky-50/50 to-cyan-50/50 p-6 border border-sky-100/50">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-sky-100 text-sky-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="font-extrabold text-slate-800 text-lg">Informasi Guru Target</h3>
                </div>
                <div class="space-y-3">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Nama Guru</p>
                        <p class="font-bold text-slate-700">{{ $evaluasi->guru->nama }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Mata Pelajaran</p>
                        <p class="font-bold text-slate-600 bg-white px-2 py-0.5 rounded border border-slate-200 shadow-sm text-sm inline-block">{{ $evaluasi->guru->mata_pelajaran }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rincian Skor -->
        <h3 class="font-extrabold text-slate-800 text-lg mb-4">Rincian Penilaian</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="rounded-2xl border border-slate-200 p-5 bg-white text-center shadow-sm hover:border-blue-400 transition-colors">
                <p class="text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-2">Kejelasan</p>
                <p class="text-3xl font-black text-slate-800">{{ $evaluasi->skor_kejelasan }}</p>
            </div>
            <div class="rounded-2xl border border-slate-200 p-5 bg-white text-center shadow-sm hover:border-blue-400 transition-colors">
                <p class="text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-2">Waktu</p>
                <p class="text-3xl font-black text-slate-800">{{ $evaluasi->skor_ketepatan_waktu }}</p>
            </div>
            <div class="rounded-2xl border border-slate-200 p-5 bg-white text-center shadow-sm hover:border-blue-400 transition-colors">
                <p class="text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-2">Interaksi</p>
                <p class="text-3xl font-black text-slate-800">{{ $evaluasi->skor_interaksi }}</p>
            </div>
            <div class="rounded-2xl border border-slate-200 p-5 bg-white text-center shadow-sm hover:border-blue-400 transition-colors">
                <p class="text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-2">Metode</p>
                <p class="text-3xl font-black text-slate-800">{{ $evaluasi->skor_metode }}</p>
            </div>
        </div>

        <!-- Skor Akhir & Komentar -->
        <div class="rounded-2xl bg-slate-50 p-6 sm:p-8 border border-slate-100">
            <div class="flex flex-col sm:flex-row items-center gap-8">
                <div class="text-center sm:text-left shrink-0">
                    <p class="text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-1">Skor Akhir</p>
                    <p class="text-5xl font-black text-slate-800">{{ number_format($evaluasi->skor_akhir, 2) }}</p>
                    <div class="mt-2 inline-block px-3 py-1 rounded-lg bg-white border border-slate-200 text-sm font-bold shadow-sm">
                        {{ $evaluasi->kategori }}
                    </div>
                </div>
                <div class="w-full h-px sm:w-px sm:h-24 bg-slate-200"></div>
                <div class="flex-1">
                    <p class="text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-2">Komentar Tambahan Siswa</p>
                    @if($evaluasi->komentar)
                        <div class="relative">
                            <svg class="absolute -top-2 -left-2 w-8 h-8 text-slate-200/50" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                            <p class="relative z-10 text-slate-700 leading-relaxed font-medium pl-4 italic">"{{ $evaluasi->komentar }}"</p>
                        </div>
                    @else
                        <p class="text-slate-400 italic">Siswa tidak meninggalkan komentar tambahan.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Aksi Verifikasi/Tolak -->
        @if ($evaluasi->status === 'menunggu_verifikasi')
            <div class="mt-10 pt-8 border-t border-slate-100">
                <h3 class="font-extrabold text-slate-800 text-xl mb-6 text-center">Tindakan Validasi</h3>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    
                    <div class="rounded-3xl border border-emerald-200 bg-emerald-50/50 p-6 relative overflow-hidden flex flex-col h-full">
                        <div class="absolute -right-10 -top-10 w-32 h-32 bg-emerald-200/50 rounded-full blur-3xl"></div>
                        <div class="relative z-10 flex-1">
                            <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <h2 class="font-extrabold text-emerald-900 text-lg">Verifikasi Evaluasi</h2>
                            <p class="mt-2 text-sm text-emerald-700/80 font-medium">Setujui evaluasi ini. Pastikan identitas siswa dapat diverifikasi secara internal dan komentar bebas dari unsur SARA atau ujaran kebencian.</p>
                        </div>
                        <form method="POST" action="{{ route('bk.evaluasi.verify', $evaluasi) }}" class="mt-6 relative z-10 w-full">
                            @csrf
                            <button type="submit" class="btn-glow-emerald">Verifikasi Sekarang</button>
                        </form>
                    </div>

                    <div class="rounded-3xl border border-rose-200 bg-rose-50/50 p-6 relative overflow-hidden flex flex-col h-full">
                        <div class="absolute -right-10 -top-10 w-32 h-32 bg-rose-200/50 rounded-full blur-3xl"></div>
                        <div class="relative z-10 flex-1">
                            <div class="w-12 h-12 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </div>
                            <h2 class="font-extrabold text-rose-900 text-lg">Tolak Evaluasi</h2>
                            <p class="mt-2 text-sm text-rose-700/80 font-medium mb-4">Tolak evaluasi jika ditemukan indikasi spam, ketidaksesuaian identitas, atau pelanggaran norma.</p>
                            
                            <form method="POST" action="{{ route('bk.evaluasi.reject', $evaluasi) }}" id="formTolak">
                                @csrf
                                <label for="catatan" class="block text-xs font-bold text-rose-900/70 uppercase tracking-widest mb-2">Alasan Penolakan (Wajib)</label>
                                <textarea id="catatan" name="catatan" rows="3" required placeholder="Contoh: Komentar mengandung kata-kata tidak pantas." class="modern-textarea bg-white/80 backdrop-blur">{{ old('catatan') }}</textarea>
                            </form>
                        </div>
                        <div class="mt-4 relative z-10">
                            <button type="submit" form="formTolak" class="btn-glow-rose">Tolak Evaluasi</button>
                        </div>
                    </div>

                </div>
            </div>
        @endif
    </div>
</div>
@endsection
