<?php

namespace App\Http\Requests\KepalaSekolah;

use Illuminate\Foundation\Http\FormRequest;

class StorePeriodeEvaluasiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->role === 'kepala_sekolah';
    }

    public function rules(): array
    {
        return [
            'nama_periode' => ['required', 'string', 'max:255'],
            'tanggal_mulai' => ['required', 'date'],
            'tanggal_selesai' => ['required', 'date', 'after_or_equal:tanggal_mulai'],
        ];
    }
}
