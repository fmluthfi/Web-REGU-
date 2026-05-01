@php
    $classes = match ($status) {
        'menunggu_verifikasi' => 'bg-amber-100 text-amber-700',
        'terverifikasi' => 'bg-emerald-100 text-emerald-700',
        'ditolak' => 'bg-rose-100 text-rose-700',
        'aktif' => 'bg-emerald-100 text-emerald-700',
        'tidak_aktif' => 'bg-slate-200 text-slate-700',
        'selesai' => 'bg-sky-100 text-sky-700',
        'belum_dinilai' => 'bg-slate-200 text-slate-700',
        default => 'bg-slate-200 text-slate-700',
    };
@endphp

<span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold capitalize {{ $classes }}">
    {{ str_replace('_', ' ', $status) }}
</span>
