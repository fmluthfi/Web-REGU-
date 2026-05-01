<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas',
        'tingkat',
    ];

    public function siswas(): HasMany
    {
        return $this->hasMany(Siswa::class);
    }

    public function gurus(): BelongsToMany
    {
        return $this->belongsToMany(Guru::class, 'guru_kelas')->withTimestamps();
    }
}
