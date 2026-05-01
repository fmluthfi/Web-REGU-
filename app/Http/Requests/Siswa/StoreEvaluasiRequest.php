<?php

namespace App\Http\Requests\Siswa;

use Illuminate\Foundation\Http\FormRequest;

class StoreEvaluasiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->role === 'siswa';
    }

    public function rules(): array
    {
        return [
            'skor_kejelasan' => ['required', 'integer', 'between:1,5'],
            'skor_ketepatan_waktu' => ['required', 'integer', 'between:1,5'],
            'skor_interaksi' => ['required', 'integer', 'between:1,5'],
            'skor_metode' => ['required', 'integer', 'between:1,5'],
            'komentar' => ['required', 'string', 'min:10'],
        ];
    }
}
