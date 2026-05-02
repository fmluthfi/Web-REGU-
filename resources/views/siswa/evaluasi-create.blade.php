@extends('layouts.app', ['title' => 'Isi Evaluasi'])

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

    /* Custom Radio Button styling */
    .radio-label {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 3.5rem;
        height: 3.5rem;
        border-radius: 16px;
        border: 2px solid #e2e8f0;
        background-color: #f8fafc;
        color: #64748b;
        font-weight: 800;
        font-size: 1.125rem;
        cursor: pointer;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }
    .radio-label:hover {
        border-color: #93c5fd;
        background-color: #eff6ff;
        color: #3b82f6;
        transform: translateY(-2px);
    }
    .radio-input:checked + .radio-label {
        background: linear-gradient(135deg, #38bdf8, #2563eb);
        border-color: transparent;
        color: white;
        box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.2);
        transform: translateY(-2px);
    }
    /* Number indicators underneath */
    .rating-hint {
        text-align: center;
        font-size: 0.7rem;
        font-weight: 700;
        color: #94a3b8;
        margin-top: 0.5rem;
    }

    /* Form Card Focus Within */
    .field-card {
        transition: all 0.3s ease;
        border: 2px solid transparent;
        background: #ffffff;
    }
    .field-card:hover {
        box-shadow: 0 4px 20px -5px rgba(0,0,0,0.05);
    }
    .field-card:focus-within {
        border-color: #bfdbfe;
        box-shadow: 0 10px 25px -5px rgba(59,130,246,0.1);
        background: #fdfefe;
    }

    /* Animations */
    .animate-enter { opacity: 0; animation: enter 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    @keyframes enter {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
</style>

<div class="font-pj mx-auto max-w-4xl space-y-8">
    
    <!-- HEADER -->
    <div class="bento-card mesh-header p-8 sm:p-10 animate-enter text-white">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/20 mb-4">
                    <span class="w-2 h-2 rounded-full bg-blue-400 animate-pulse"></span>
                    <span class="text-xs font-bold tracking-widest uppercase text-sky-100">Form Evaluasi</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight mb-2">
                    Penilaian <span class="text-transparent bg-clip-text bg-gradient-to-r from-sky-400 to-blue-200">Kinerja Guru</span>
                </h1>
                <p class="text-sky-100/90 text-sm font-medium">Berikan penilaian Anda secara objektif dan jujur. Identitas Anda dirahasiakan.</p>
            </div>
            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-5 text-left md:text-right shrink-0">
                <p class="text-sky-200/80 text-xs font-black uppercase tracking-widest mb-1">Target Evaluasi</p>
                <p class="text-xl font-extrabold text-white">{{ $guru->nama }}</p>
                <div class="mt-2 flex flex-col md:items-end gap-1 text-sm font-semibold text-sky-100">
                    <span class="flex items-center gap-1.5"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg> {{ $guru->mata_pelajaran }}</span>
                    <span class="flex items-center gap-1.5"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> {{ $periodeAktif->nama_periode }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- FORM BODY -->
    <form method="POST" action="{{ route('siswa.evaluasi.store', $guru) }}" class="animate-enter delay-1 space-y-6">
        @csrf
        @php
            $fields = [
                'skor_kejelasan' => 'Kejelasan penyampaian materi',
                'skor_ketepatan_waktu' => 'Ketepatan waktu dan kedisiplinan',
                'skor_interaksi' => 'Interaksi dengan siswa',
                'skor_metode' => 'Metode pembelajaran',
            ];
            $hints = [
                1 => 'Sangat Kurang',
                2 => 'Kurang',
                3 => 'Cukup',
                4 => 'Baik',
                5 => 'Sangat Baik'
            ];
        @endphp

        <div class="bento-card p-6 sm:p-10 space-y-8">
            <div class="border-b border-slate-100 pb-4 mb-6">
                <h2 class="text-xl font-extrabold text-slate-800">Skala Penilaian</h2>
                <p class="text-sm font-medium text-slate-500 mt-1">Pilih angka 1-5 yang paling merepresentasikan kinerja guru pada masing-masing indikator.</p>
            </div>

            <div class="space-y-6">
                @foreach ($fields as $field => $label)
                    <div class="field-card rounded-2xl p-6 bg-slate-50/50 ring-1 ring-slate-200">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                            <div class="flex-1">
                                <p class="text-base font-bold text-slate-800">{{ $label }}</p>
                                @error($field)
                                    <p class="text-xs font-bold text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="flex gap-2 sm:gap-3 shrink-0">
                                @for ($i = 1; $i <= 5; $i++)
                                    <div>
                                        <input type="radio" id="{{ $field }}_{{ $i }}" name="{{ $field }}" value="{{ $i }}" {{ old($field) == $i ? 'checked' : '' }} class="radio-input hidden" required>
                                        <label for="{{ $field }}_{{ $i }}" class="radio-label">
                                            {{ $i }}
                                        </label>
                                        <div class="rating-hint md:hidden">{{ $hints[$i] }}</div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                        <div class="hidden md:flex justify-end gap-2 sm:gap-3 mt-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <div class="w-[3.5rem] text-center text-[0.65rem] font-bold text-slate-400 leading-tight">{{ $hints[$i] }}</div>
                            @endfor
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8 pt-8 border-t border-slate-100">
                <label for="komentar" class="mb-3 block text-base font-extrabold text-slate-800">Komentar & Masukan</label>
                <textarea id="komentar" name="komentar" rows="4" 
                    class="w-full rounded-2xl border-2 border-slate-200 bg-slate-50/50 px-5 py-4 text-slate-700 font-medium placeholder-slate-400 outline-none transition duration-200 focus:border-blue-400 focus:bg-white focus:ring-4 focus:ring-blue-50 resize-none shadow-sm" 
                    placeholder="Tuliskan komentar yang konstruktif untuk pengembangan guru kedepannya (opsional, minimal 10 karakter jika diisi)...">{{ old('komentar') }}</textarea>
                @error('komentar')
                    <p class="text-xs font-bold text-red-500 mt-2">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="animate-enter delay-2 flex flex-col sm:flex-row items-center justify-end gap-4 pt-4">
            <a href="{{ route('siswa.dashboard') }}" class="btn-outline-modern w-full sm:w-auto order-2 sm:order-1">
                Kembali
            </a>
            <button type="submit" class="btn-glow w-full sm:w-auto text-base py-3.5 px-8 order-1 sm:order-2">
                <span class="mr-2">Kirim Evaluasi</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
            </button>
        </div>
    </form>
</div>
@endsection
