<?php

namespace App\Http\Controllers;

use App\Models\Evaluasi;
use App\Models\PeriodeEvaluasi;
use Illuminate\View\View;

class SiswaDashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        abort_if(! $user, 403);

        $siswa = $user->siswa()->with('kelas.gurus')->firstOrFail();
        $periodeAktif = PeriodeEvaluasi::query()->active()->latest('tanggal_mulai')->first();

        $evaluasiByGuru = collect();
        if ($periodeAktif) {
            $evaluasiByGuru = Evaluasi::query()
                ->where('siswa_id', $siswa->id)
                ->where('periode_evaluasi_id', $periodeAktif->id)
                ->get()
                ->keyBy('guru_id');
        }

        $gurus = $siswa->kelas->gurus
            ->sortBy('nama')
            ->map(function ($guru) use ($evaluasiByGuru, $periodeAktif) {
                $evaluasi = $evaluasiByGuru->get($guru->id);

                return [
                    'id' => $guru->id,
                    'nama' => $guru->nama,
                    'mata_pelajaran' => $guru->mata_pelajaran,
                    'status' => $evaluasi ? $evaluasi->status : 'belum_dinilai',
                    'sudah_dinilai' => (bool) $evaluasi,
                    'bisa_menilai' => $periodeAktif && ! $evaluasi,
                ];
            });

        return view('siswa.dashboard', [
            'siswa' => $siswa,
            'periodeAktif' => $periodeAktif,
            'gurus' => $gurus,
        ]);
    }
}
