<?php

namespace App\Http\Requests\GuruBk;

use Illuminate\Foundation\Http\FormRequest;

class RejectEvaluasiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->role === 'guru_bk';
    }

    public function rules(): array
    {
        return [
            'catatan' => ['nullable', 'string', 'max:1000'],
        ];
    }
}
