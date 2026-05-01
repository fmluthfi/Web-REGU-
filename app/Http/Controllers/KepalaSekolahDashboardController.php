<?php

namespace App\Http\Controllers;

use App\Models\Evaluasi;
use App\Models\PeriodeEvaluasi;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class KepalaSekolahDashboardController extends Controller
{
    public function index(Request $request): View
    {
        $periodes = PeriodeEvaluasi::query()->latest('tanggal_mulai')->get();
        $periode = $request->filled('periode_id')
            ? $periodes->firstWhere('id', (int) $request->integer('periode_id'))
            : $periodes->firstWhere('status', 'aktif');

        if (! $periode) {
            $periode = $periodes->first();
        }

        $evaluasiQuery = Evaluasi::query()
            ->with('guru')
            ->where('status', 'terverifikasi');

        if ($periode) {
            $evaluasiQuery->where('periode_evaluasi_id', $periode->id);
        }

        $evaluasis = $evaluasiQuery->get();

        $guruSummaries = $evaluasis
            ->groupBy('guru_id')
            ->map(function (Collection $items) {
                $guru = $items->first()->guru;
                $avgSkor = round((float) $items->avg('skor_akhir'), 2);

                return [
                    'guru' => $guru,
                    'jumlah_evaluasi' => $items->count(),
                    'rata_skor_akhir' => $avgSkor,
                    'kategori' => Evaluasi::kategoriDariSkor($avgSkor),
                ];
            })
            ->sortByDesc('rata_skor_akhir')
            ->values();

        $avgKeseluruhan = round((float) $evaluasis->avg('skor_akhir'), 2);

        return view('kepala-sekolah.dashboard', [
            'periodes' => $periodes,
            'periode' => $periode,
            'guruSummaries' => $guruSummaries,
            'avgKeseluruhan' => $avgKeseluruhan,
            'verifiedCount' => $evaluasis->count(),
            'chartLabels' => $guruSummaries->pluck('guru.nama')->values(),
            'chartScores' => $guruSummaries->pluck('rata_skor_akhir')->values(),
        ]);
    }
}
