<?php

namespace App\Http\Controllers;

use App\Models\Evaluasi;
use App\Models\Guru;
use App\Models\PeriodeEvaluasi;
use App\Support\AuditLogger;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class GuruLaporanController extends Controller
{
    public function show(Request $request, Guru $guru): View
    {
        [$periode, $evaluasis, $summary] = $this->buildReportData($request, $guru);

        return view('kepala-sekolah.guru-laporan', compact('guru', 'periode', 'evaluasis', 'summary'));
    }

    public function pdf(Request $request, Guru $guru): Response
    {
        abort_unless(class_exists(Pdf::class), 500, 'Package dompdf belum terpasang.');

        [$periode, $evaluasis, $summary] = $this->buildReportData($request, $guru);

        AuditLogger::log(
            $request,
            'kepala_sekolah_export_pdf',
            sprintf('Kepala sekolah mengunduh PDF laporan guru %s.', $guru->nama)
        );

        return Pdf::loadView('kepala-sekolah.guru-laporan-pdf', compact('guru', 'periode', 'evaluasis', 'summary'))
            ->download('laporan-guru-'.$guru->id.'.pdf');
    }

    private function buildReportData(Request $request, Guru $guru): array
    {
        $periode = $request->filled('periode_id')
            ? PeriodeEvaluasi::query()->find($request->integer('periode_id'))
            : PeriodeEvaluasi::query()->active()->latest('tanggal_mulai')->first();

        if (! $periode) {
            $periode = PeriodeEvaluasi::query()->latest('tanggal_mulai')->first();
        }

        $query = Evaluasi::query()
            ->where('guru_id', $guru->id)
            ->where('status', 'terverifikasi');

        if ($periode) {
            $query->where('periode_evaluasi_id', $periode->id);
        }

        $evaluasis = $query->latest()->get();

        $avgSkor = round((float) $evaluasis->avg('skor_akhir'), 2);

        $summary = [
            'jumlah_evaluasi' => $evaluasis->count(),
            'avg_kejelasan' => round((float) $evaluasis->avg('skor_kejelasan'), 2),
            'avg_ketepatan_waktu' => round((float) $evaluasis->avg('skor_ketepatan_waktu'), 2),
            'avg_interaksi' => round((float) $evaluasis->avg('skor_interaksi'), 2),
            'avg_metode' => round((float) $evaluasis->avg('skor_metode'), 2),
            'avg_skor_akhir' => $avgSkor,
            'kategori_akhir' => Evaluasi::kategoriDariSkor($avgSkor),
        ];

        return [$periode, $evaluasis, $summary];
    }
}
