@extends('layouts.app', ['title' => 'Buat Periode'])

@section('content')
    <div class="mx-auto max-w-3xl">
        <section class="rounded-[2rem] bg-white p-8 shadow-sm ring-1 ring-slate-200">
            <h1 class="text-2xl font-semibold text-slate-900">Buat Periode Evaluasi</h1>
            <form method="POST" action="{{ route('kepala-sekolah.periode.store') }}" class="mt-8 space-y-5">
                @csrf
                <div>
                    <label for="nama_periode" class="mb-2 block text-sm font-medium text-slate-700">Nama Periode</label>
                    <input id="nama_periode" name="nama_periode" type="text" value="{{ old('nama_periode') }}" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
                </div>
                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label for="tanggal_mulai" class="mb-2 block text-sm font-medium text-slate-700">Tanggal Mulai</label>
                        <input id="tanggal_mulai" name="tanggal_mulai" type="date" value="{{ old('tanggal_mulai') }}" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
                    </div>
                    <div>
                        <label for="tanggal_selesai" class="mb-2 block text-sm font-medium text-slate-700">Tanggal Selesai</label>
                        <input id="tanggal_selesai" name="tanggal_selesai" type="date" value="{{ old('tanggal_selesai') }}" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
                    </div>
                </div>
                <div class="flex flex-wrap gap-3">
                    <button type="submit" class="rounded-full bg-sky-600 px-6 py-3 text-sm font-semibold text-white hover:bg-sky-500">Simpan Periode</button>
                    <a href="{{ route('kepala-sekolah.periode.index') }}" class="rounded-full bg-slate-100 px-6 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-200">Kembali</a>
                </div>
            </form>
        </section>
    </div>
@endsection
