<?php

namespace App\Http\Controllers;

use App\Http\Requests\Siswa\StoreEvaluasiRequest;
use App\Models\Evaluasi;
use App\Models\Guru;
use App\Models\PeriodeEvaluasi;
use App\Support\AuditLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EvaluasiController extends Controller
{
    public function create(Guru $guru): View
    {
        [$siswa, $periodeAktif] = $this->resolveAuthorizedContext($guru);

        return view('siswa.evaluasi-create', [
            'guru' => $guru,
            'siswa' => $siswa,
            'periodeAktif' => $periodeAktif,
        ]);
    }

    public function store(StoreEvaluasiRequest $request, Guru $guru): RedirectResponse
    {
        [$siswa, $periodeAktif] = $this->resolveAuthorizedContext($guru);
        $validated = $request->validated();

        $alreadyExists = Evaluasi::query()
            ->where('siswa_id', $siswa->id)
            ->where('guru_id', $guru->id)
            ->where('periode_evaluasi_id', $periodeAktif->id)
            ->exists();

        if ($alreadyExists) {
            return redirect()
                ->route('siswa.dashboard')
                ->with('error', 'Evaluasi untuk guru ini pada periode aktif sudah pernah dikirim.');
        }

        $rataRata = (
            $validated['skor_kejelasan'] +
            $validated['skor_ketepatan_waktu'] +
            $validated['skor_interaksi'] +
            $validated['skor_metode']
        ) / 4;

        $skorAkhir = round($rataRata * 20, 2);

        Evaluasi::create([
            'siswa_id' => $siswa->id,
            'guru_id' => $guru->id,
            'periode_evaluasi_id' => $periodeAktif->id,
            'skor_kejelasan' => $validated['skor_kejelasan'],
            'skor_ketepatan_waktu' => $validated['skor_ketepatan_waktu'],
            'skor_interaksi' => $validated['skor_interaksi'],
            'skor_metode' => $validated['skor_metode'],
            'komentar' => $validated['komentar'],
            'skor_akhir' => $skorAkhir,
            'kategori' => Evaluasi::kategoriDariSkor($skorAkhir),
            'status' => 'menunggu_verifikasi',
        ]);

        AuditLogger::log(
            $request,
            'siswa_submit_evaluasi',
            sprintf('Siswa %s mengirim evaluasi untuk guru %s pada periode %s.', $siswa->nis, $guru->nama, $periodeAktif->nama_periode)
        );

        return redirect()
            ->route('siswa.dashboard')
            ->with('success', 'Evaluasi berhasil dikirim dan menunggu verifikasi Guru BK.');
    }

    private function resolveAuthorizedContext(Guru $guru): array
    {
        $user = auth()->user();
        abort_if(! $user, 403);

        $siswa = $user->siswa()->with('kelas.gurus')->firstOrFail();
        $periodeAktif = PeriodeEvaluasi::query()->active()->latest('tanggal_mulai')->first();

        abort_if(! $periodeAktif, 403, 'Belum ada periode evaluasi aktif.');
        abort_unless($siswa->kelas->gurus->contains('id', $guru->id), 403, 'Guru tidak mengajar di kelas siswa.');

        return [$siswa, $periodeAktif];
    }
}
