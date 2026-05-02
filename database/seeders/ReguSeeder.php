<?php

namespace Database\Seeders;

use App\Models\Evaluasi;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\PeriodeEvaluasi;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Verifikasi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ReguSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@regu.test'],
            [
                'name' => 'Admin REGU',
                'nis' => null,
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'kepsek@regu.test'],
            [
                'name' => 'Kepala Sekolah REGU',
                'nis' => null,
                'password' => Hash::make('password'),
                'role' => 'kepala_sekolah',
            ]
        );

        $guruBk = User::updateOrCreate(
            ['email' => 'bk@regu.test'],
            [
                'name' => 'Guru BK REGU',
                'nis' => null,
                'password' => Hash::make('password'),
                'role' => 'guru_bk',
            ]
        );

        $kelasX1 = Kelas::updateOrCreate(['nama_kelas' => 'X IPA 1'], ['tingkat' => '10']);
        $kelasX2 = Kelas::updateOrCreate(['nama_kelas' => 'X IPA 2'], ['tingkat' => '10']);

        $gurus = collect([
            ['nama' => 'Rina Wulandari', 'nip' => '1987001', 'mata_pelajaran' => 'Matematika'],
            ['nama' => 'Budi Santoso', 'nip' => '1987002', 'mata_pelajaran' => 'Bahasa Indonesia'],
            ['nama' => 'Dewi Lestari', 'nip' => '1987003', 'mata_pelajaran' => 'Fisika'],
            ['nama' => 'Andi Saputra', 'nip' => '1987004', 'mata_pelajaran' => 'Sejarah'],
        ])->map(fn (array $data) => Guru::updateOrCreate(['nip' => $data['nip']], $data));

        $kelasX1->gurus()->syncWithoutDetaching($gurus->pluck('id')->take(3)->all());
        $kelasX2->gurus()->syncWithoutDetaching($gurus->pluck('id')->slice(1)->all());

        $students = collect([
            ['nis' => '1001', 'name' => 'Vicky', 'kelas_id' => $kelasX1->id],
            ['nis' => '1002', 'name' => 'Luthfi', 'kelas_id' => $kelasX1->id],
            ['nis' => '1003', 'name' => 'Ali', 'kelas_id' => $kelasX1->id],
            ['nis' => '1004', 'name' => 'Mahdi', 'kelas_id' => $kelasX2->id],
            ['nis' => '1005', 'name' => 'Muhtiar', 'kelas_id' => $kelasX2->id],
        ])->map(function (array $student) {
            $user = User::updateOrCreate(
                ['nis' => $student['nis']],
                [
                    'name' => $student['name'],
                    'email' => null,
                    'password' => Hash::make('password'),
                    'role' => 'siswa',
                ]
            );

            return Siswa::updateOrCreate(
                ['nis' => $student['nis']],
                [
                    'user_id' => $user->id,
                    'kelas_id' => $student['kelas_id'],
                    'nama' => $student['name'],
                ]
            );
        })->values();

        PeriodeEvaluasi::query()->update(['status' => 'tidak_aktif']);
        $periodeAktif = PeriodeEvaluasi::updateOrCreate(
            ['nama_periode' => 'Semester Genap 2026'],
            [
                'tanggal_mulai' => now()->startOfMonth()->toDateString(),
                'tanggal_selesai' => now()->addMonth()->endOfMonth()->toDateString(),
                'status' => 'aktif',
            ]
        );

        $evaluasiVerified = Evaluasi::updateOrCreate(
            [
                'siswa_id' => $students[0]->id,
                'guru_id' => $gurus[0]->id,
                'periode_evaluasi_id' => $periodeAktif->id,
            ],
            [
                'skor_kejelasan' => 5,
                'skor_ketepatan_waktu' => 4,
                'skor_interaksi' => 5,
                'skor_metode' => 4,
                'komentar' => 'Guru menjelaskan materi dengan sangat jelas dan interaktif di kelas.',
                'skor_akhir' => 90,
                'kategori' => 'Sangat Baik',
                'status' => 'terverifikasi',
            ]
        );

        Verifikasi::updateOrCreate(
            ['evaluasi_id' => $evaluasiVerified->id],
            [
                'guru_bk_id' => $guruBk->id,
                'catatan' => null,
                'status' => 'terverifikasi',
            ]
        );

        Evaluasi::updateOrCreate(
            [
                'siswa_id' => $students[1]->id,
                'guru_id' => $gurus[1]->id,
                'periode_evaluasi_id' => $periodeAktif->id,
            ],
            [
                'skor_kejelasan' => 4,
                'skor_ketepatan_waktu' => 4,
                'skor_interaksi' => 4,
                'skor_metode' => 3,
                'komentar' => 'Pembelajaran sudah baik, tetapi variasi metode masih bisa ditingkatkan.',
                'skor_akhir' => 75,
                'kategori' => 'Baik',
                'status' => 'menunggu_verifikasi',
            ]
        );
    }
}
