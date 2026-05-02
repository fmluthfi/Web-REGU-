@extends('layouts.app', ['title' => 'Dashboard Admin'])

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    body {
        background-color: #f8fafc;
        background-image:
            radial-gradient(circle at 15% 50%, rgba(14, 165, 233, 0.08), transparent 25%),
            radial-gradient(circle at 85% 30%, rgba(37, 99, 235, 0.08), transparent 25%),
            url("data:image/svg+xml,%3Csvg width='24' height='24' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%230ea5e9' fill-opacity='0.05' fill-rule='evenodd'%3E%3Ccircle cx='3' cy='3' r='1.5'/%3E%3C/g%3E%3C/svg%3E");
        background-attachment: fixed;
    }

    .font-pj { font-family: 'Plus Jakarta Sans', sans-serif; }

    .bento-card {
        background: #ffffff;
        border-radius: 24px;
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow:
            0 4px 6px -1px rgba(0, 0, 0, 0.02),
            0 10px 15px -3px rgba(0, 0, 0, 0.03),
            inset 0 1px 0 rgba(255, 255, 255, 1);
        position: relative;
        overflow: hidden;
    }

    .mesh-header {
        background-color: #0f172a;
        background-image:
            radial-gradient(at 0% 0%, hsla(253,16%,7%,1) 0, transparent 50%),
            radial-gradient(at 50% 0%, hsla(225,39%,30%,1) 0, transparent 50%),
            radial-gradient(at 100% 0%, hsla(217,91%,60%,1) 0, transparent 50%);
        border: none;
        box-shadow: 0 20px 25px -5px rgba(15, 23, 42, 0.2);
    }

    .admin-input {
        width: 100%;
        border-radius: 14px;
        border: 1px solid #e2e8f0;
        background: #fff;
        padding: 0.875rem 1rem;
        font-size: 0.875rem;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .admin-input:focus {
        border-color: #06b6d4;
        box-shadow: 0 0 0 4px rgba(6, 182, 212, 0.12);
    }

    .admin-label {
        margin-bottom: 0.5rem;
        display: block;
        font-size: 0.75rem;
        font-weight: 900;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: #475569;
    }

    .modern-table th {
        background-color: #ffffff;
        color: #64748b;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-size: 0.75rem;
        padding: 1rem 1.25rem;
        border-bottom: 2px solid #f1f5f9;
        white-space: nowrap;
    }

    .modern-table td {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
        vertical-align: middle;
    }

    .modern-table tbody tr:last-child td { border-bottom: none; }
    .animate-enter { opacity: 0; animation: enter 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    @keyframes enter {
        0% { opacity: 0; transform: translateY(30px) scale(0.98); }
        100% { opacity: 1; transform: translateY(0) scale(1); }
    }
    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }
</style>

<div class="font-pj space-y-6 max-w-[1400px] mx-auto">
    <div class="bento-card mesh-header p-8 sm:p-12 animate-enter text-white">
        <div class="relative z-10 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-8">
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 mb-6">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span class="text-xs font-bold tracking-widest uppercase text-sky-100">Internal Admin</span>
                </div>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight mb-4 leading-tight">
                    Kelola <span class="text-transparent bg-clip-text bg-gradient-to-r from-sky-400 to-blue-200">Data REGU</span>
                </h1>
                <p class="text-sky-100/90 text-lg font-medium leading-relaxed max-w-2xl">
                    Tambahkan data siswa dan guru dari satu panel internal. Akses ini tidak memakai fitur daftar publik.
                </p>
            </div>
            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-3xl p-6 min-w-[240px] shadow-2xl">
                <p class="text-sky-200/80 text-xs font-black uppercase tracking-widest mb-2">Admin Aktif</p>
                <p class="text-2xl font-extrabold">{{ auth()->user()->name }}</p>
                <p class="mt-2 text-sm font-medium text-sky-100">Manajemen data master</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bento-card p-6 sm:p-8 animate-enter delay-1 bg-gradient-to-br from-white to-blue-50/30">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-400 to-blue-600 text-white flex items-center justify-center shadow-lg shadow-blue-500/30 mb-5">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-4a4 4 0 100-8 4 4 0 000 8zm6 2a3 3 0 100-6"></path></svg>
            </div>
            <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Total Siswa</h3>
            <div class="flex items-baseline gap-2">
                <span class="text-5xl font-black text-slate-800 tracking-tighter">{{ $totalSiswa }}</span>
                <span class="text-base font-bold text-slate-500">Siswa</span>
            </div>
        </div>
        <div class="bento-card p-6 sm:p-8 animate-enter delay-2 bg-gradient-to-br from-white to-emerald-50/30">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-400 to-emerald-600 text-white flex items-center justify-center shadow-lg shadow-emerald-500/30 mb-5">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 14l9-5-9-5-9 5 9 5zm0 0v7m-5-4l5 3 5-3"></path></svg>
            </div>
            <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Total Guru</h3>
            <div class="flex items-baseline gap-2">
                <span class="text-5xl font-black text-slate-800 tracking-tighter">{{ $totalGuru }}</span>
                <span class="text-base font-bold text-slate-500">Guru</span>
            </div>
        </div>
        <div class="bento-card p-6 sm:p-8 animate-enter delay-3 bg-gradient-to-br from-white to-cyan-50/30">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-cyan-400 to-sky-600 text-white flex items-center justify-center shadow-lg shadow-cyan-500/30 mb-5">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 10h16M4 14h10M4 18h10"></path></svg>
            </div>
            <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Total Kelas</h3>
            <div class="flex items-baseline gap-2">
                <span class="text-5xl font-black text-slate-800 tracking-tighter">{{ $totalKelas }}</span>
                <span class="text-base font-bold text-slate-500">Kelas</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
        <form method="POST" action="{{ route('admin.siswa.store') }}" class="bento-card p-6 sm:p-8 animate-enter delay-2">
            @csrf
            <div class="mb-6">
                <h2 class="text-2xl font-black text-slate-800">Tambah Siswa</h2>
                <p class="text-sm font-medium text-slate-500 mt-1">Akun siswa dibuat oleh admin internal.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="sm:col-span-2">
                    <label for="siswa-nama" class="admin-label">Nama Siswa</label>
                    <input id="siswa-nama" name="nama" type="text" value="{{ old('nama') }}" class="admin-input" placeholder="Contoh: Vicky Pratama">
                </div>
                <div>
                    <label for="siswa-nis" class="admin-label">NIS</label>
                    <input id="siswa-nis" name="nis" type="text" value="{{ old('nis') }}" class="admin-input" placeholder="Contoh: 2026001">
                </div>
                <div>
                    <label for="siswa-kelas" class="admin-label">Kelas</label>
                    <select id="siswa-kelas" name="kelas_id" class="admin-input">
                        <option value="">Pilih kelas</option>
                        @foreach ($kelas as $item)
                            <option value="{{ $item->id }}" @selected(old('kelas_id') == $item->id)>{{ $item->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <label for="siswa-password" class="admin-label">Password Awal</label>
                    <input id="siswa-password" name="password" type="password" class="admin-input" placeholder="Minimal 6 karakter">
                </div>
            </div>
            <button type="submit" class="mt-6 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-sky-700 via-cyan-600 to-sky-500 px-4 py-3.5 text-sm font-extrabold text-white shadow-lg shadow-cyan-700/20 transition hover:from-sky-800 hover:via-cyan-700 hover:to-sky-600">
                Simpan Data Siswa
            </button>
        </form>

        <form method="POST" action="{{ route('admin.guru.store') }}" class="bento-card p-6 sm:p-8 animate-enter delay-3">
            @csrf
            <div class="mb-6">
                <h2 class="text-2xl font-black text-slate-800">Tambah Guru</h2>
                <p class="text-sm font-medium text-slate-500 mt-1">Data guru dipakai sebagai target evaluasi siswa.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="sm:col-span-2">
                    <label for="guru-nama" class="admin-label">Nama Guru</label>
                    <input id="guru-nama" name="nama" type="text" value="{{ old('nama') }}" class="admin-input" placeholder="Contoh: Rina Wulandari">
                </div>
                <div>
                    <label for="guru-nip" class="admin-label">NIP</label>
                    <input id="guru-nip" name="nip" type="text" value="{{ old('nip') }}" class="admin-input" placeholder="Opsional">
                </div>
                <div>
                    <label for="guru-mapel" class="admin-label">Mata Pelajaran</label>
                    <input id="guru-mapel" name="mata_pelajaran" type="text" value="{{ old('mata_pelajaran') }}" class="admin-input" placeholder="Contoh: Matematika">
                </div>
                <div class="sm:col-span-2">
                    <label for="guru-kelas" class="admin-label">Mengajar di Kelas</label>
                    <select id="guru-kelas" name="kelas_ids[]" class="admin-input min-h-32" multiple>
                        @foreach ($kelas as $item)
                            <option value="{{ $item->id }}" @selected(in_array($item->id, old('kelas_ids', [])))>{{ $item->nama_kelas }}</option>
                        @endforeach
                    </select>
                    <p class="mt-2 text-xs font-medium text-slate-500">Tahan Ctrl untuk memilih lebih dari satu kelas.</p>
                </div>
            </div>
            <button type="submit" class="mt-6 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-slate-900 px-4 py-3.5 text-sm font-extrabold text-white shadow-lg shadow-slate-900/20 transition hover:bg-slate-700">
                Simpan Data Guru
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
        <section class="bento-card animate-enter delay-2">
            <div class="p-6 sm:p-8 border-b border-slate-100">
                <h2 class="text-2xl font-black text-slate-800">Siswa Terbaru</h2>
                <p class="text-sm font-medium text-slate-500 mt-1">Daftar data siswa yang terakhir ditambahkan.</p>
            </div>
            <div class="overflow-x-auto">
                <table class="modern-table w-full text-left">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>NIS</th>
                            <th>Kelas</th>
                        </tr>
                    </thead>
                    <tbody class="bg-slate-50/30">
                        @forelse ($siswas as $siswa)
                            <tr>
                                <td class="font-extrabold text-slate-800">{{ $siswa->nama }}</td>
                                <td><span class="rounded-lg border border-slate-200 bg-white px-2 py-1 font-mono text-xs font-bold text-slate-500">{{ $siswa->nis }}</span></td>
                                <td><span class="rounded-lg border border-blue-100 bg-blue-50 px-3 py-1 text-xs font-bold text-blue-700">{{ $siswa->kelas->nama_kelas }}</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-12 text-center font-bold text-slate-400">Belum ada data siswa.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <section class="bento-card animate-enter delay-3">
            <div class="p-6 sm:p-8 border-b border-slate-100">
                <h2 class="text-2xl font-black text-slate-800">Guru Terbaru</h2>
                <p class="text-sm font-medium text-slate-500 mt-1">Daftar data guru yang terakhir ditambahkan.</p>
            </div>
            <div class="overflow-x-auto">
                <table class="modern-table w-full text-left">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Mapel</th>
                            <th>Kelas</th>
                        </tr>
                    </thead>
                    <tbody class="bg-slate-50/30">
                        @forelse ($gurus as $guru)
                            <tr>
                                <td class="font-extrabold text-slate-800">{{ $guru->nama }}</td>
                                <td><span class="rounded-lg border border-slate-200 bg-white px-2 py-1 font-mono text-xs font-bold text-slate-500">{{ $guru->nip ?? '-' }}</span></td>
                                <td class="font-bold text-slate-600">{{ $guru->mata_pelajaran }}</td>
                                <td class="min-w-52">
                                    <div class="flex flex-wrap gap-2">
                                        @forelse ($guru->kelas as $item)
                                            <span class="rounded-lg border border-emerald-100 bg-emerald-50 px-2 py-1 text-xs font-bold text-emerald-700">{{ $item->nama_kelas }}</span>
                                        @empty
                                            <span class="text-xs font-bold text-slate-400">Belum diatur</span>
                                        @endforelse
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-12 text-center font-bold text-slate-400">Belum ada data guru.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>
@endsection
