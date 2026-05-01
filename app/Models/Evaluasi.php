<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Evaluasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'guru_id',
        'periode_evaluasi_id',
        'skor_kejelasan',
        'skor_ketepatan_waktu',
        'skor_interaksi',
        'skor_metode',
        'komentar',
        'skor_akhir',
        'kategori',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'skor_akhir' => 'decimal:2',
        ];
    }

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }

    public function guru(): BelongsTo
    {
        return $this->belongsTo(Guru::class);
    }

    public function periodeEvaluasi(): BelongsTo
    {
        return $this->belongsTo(PeriodeEvaluasi::class);
    }

    public function verifikasi(): HasOne
    {
        return $this->hasOne(Verifikasi::class);
    }

    public static function kategoriDariSkor(float $skorAkhir): string
    {
        if ($skorAkhir >= 85) {
            return 'Sangat Baik';
        }

        if ($skorAkhir >= 70) {
            return 'Baik';
        }

        if ($skorAkhir >= 50) {
            return 'Cukup';
        }

        if ($skorAkhir >= 30) {
            return 'Kurang';
        }

        return 'Sangat Kurang';
    }
}
