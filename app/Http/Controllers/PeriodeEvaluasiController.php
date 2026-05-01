<?php

namespace App\Http\Controllers;

use App\Http\Requests\KepalaSekolah\StorePeriodeEvaluasiRequest;
use App\Models\PeriodeEvaluasi;
use App\Support\AuditLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PeriodeEvaluasiController extends Controller
{
    public function index(): View
    {
        return view('kepala-sekolah.periode.index', [
            'periodes' => PeriodeEvaluasi::query()->latest('tanggal_mulai')->get(),
        ]);
    }

    public function create(): View
    {
        return view('kepala-sekolah.periode.create');
    }

    public function store(StorePeriodeEvaluasiRequest $request): RedirectResponse
    {
        $periode = PeriodeEvaluasi::create([
            ...$request->validated(),
            'status' => 'tidak_aktif',
        ]);

        AuditLogger::log($request, 'periode_buat', 'Membuat periode evaluasi '.$periode->nama_periode.'.');

        return redirect()
            ->route('kepala-sekolah.periode.index')
            ->with('success', 'Periode evaluasi berhasil dibuat.');
    }

    public function activate(PeriodeEvaluasi $periode): RedirectResponse
    {
        DB::transaction(function () use ($periode): void {
            PeriodeEvaluasi::query()->where('id', '!=', $periode->id)->update(['status' => 'tidak_aktif']);
            $periode->update(['status' => 'aktif']);
        });

        AuditLogger::log(request(), 'periode_aktifkan', 'Mengaktifkan periode '.$periode->nama_periode.'.');

        return back()->with('success', 'Periode evaluasi berhasil diaktifkan.');
    }

    public function complete(PeriodeEvaluasi $periode): RedirectResponse
    {
        $periode->update(['status' => 'selesai']);

        AuditLogger::log(request(), 'periode_selesaikan', 'Menyelesaikan periode '.$periode->nama_periode.'.');

        return back()->with('success', 'Periode evaluasi ditandai selesai.');
    }
}
