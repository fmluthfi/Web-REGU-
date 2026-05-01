<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuruBk\RejectEvaluasiRequest;
use App\Models\Evaluasi;
use App\Models\Verifikasi;
use App\Support\AuditLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BkDashboardController extends Controller
{
    public function index(): View
    {
        $baseQuery = Evaluasi::query()->with(['siswa.kelas', 'guru', 'periodeEvaluasi']);

        return view('bk.dashboard', [
            'pendingCount' => (clone $baseQuery)->where('status', 'menunggu_verifikasi')->count(),
            'verifiedCount' => (clone $baseQuery)->where('status', 'terverifikasi')->count(),
            'rejectedCount' => (clone $baseQuery)->where('status', 'ditolak')->count(),
            'pendingEvaluasis' => (clone $baseQuery)
                ->where('status', 'menunggu_verifikasi')
                ->latest()
                ->get(),
        ]);
    }

    public function show(Evaluasi $evaluasi): View
    {
        $evaluasi->load(['siswa.kelas', 'guru', 'periodeEvaluasi', 'verifikasi.guruBk']);

        return view('bk.show', compact('evaluasi'));
    }

    public function verify(Request $request, Evaluasi $evaluasi): RedirectResponse
    {
        if ($evaluasi->status !== 'menunggu_verifikasi') {
            return back()->with('error', 'Evaluasi ini sudah diproses sebelumnya.');
        }

        $evaluasi->update(['status' => 'terverifikasi']);

        Verifikasi::updateOrCreate(
            ['evaluasi_id' => $evaluasi->id],
            [
                'guru_bk_id' => $request->user()->id,
                'catatan' => null,
                'status' => 'terverifikasi',
            ]
        );

        AuditLogger::log($request, 'bk_verifikasi_evaluasi', 'Guru BK memverifikasi evaluasi ID '.$evaluasi->id.'.');

        return redirect()
            ->route('bk.dashboard')
            ->with('success', 'Evaluasi berhasil diverifikasi.');
    }

    public function reject(RejectEvaluasiRequest $request, Evaluasi $evaluasi): RedirectResponse
    {
        if ($evaluasi->status !== 'menunggu_verifikasi') {
            return back()->with('error', 'Evaluasi ini sudah diproses sebelumnya.');
        }

        $evaluasi->update(['status' => 'ditolak']);

        Verifikasi::updateOrCreate(
            ['evaluasi_id' => $evaluasi->id],
            [
                'guru_bk_id' => $request->user()->id,
                'catatan' => $request->validated('catatan'),
                'status' => 'ditolak',
            ]
        );

        AuditLogger::log($request, 'bk_tolak_evaluasi', 'Guru BK menolak evaluasi ID '.$evaluasi->id.'.');

        return redirect()
            ->route('bk.dashboard')
            ->with('success', 'Evaluasi berhasil ditolak.');
    }
}
