<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'siswas' => Siswa::query()->with(['kelas', 'user'])->latest()->take(12)->get(),
            'gurus' => Guru::query()->with('kelas')->latest()->take(12)->get(),
            'kelas' => Kelas::query()->orderBy('tingkat')->orderBy('nama_kelas')->get(),
            'totalSiswa' => Siswa::query()->count(),
            'totalGuru' => Guru::query()->count(),
            'totalKelas' => Kelas::query()->count(),
        ]);
    }

    public function storeSiswa(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'nis' => ['required', 'string', 'max:255', 'unique:users,nis', 'unique:siswas,nis'],
            'kelas_id' => ['required', 'exists:kelas,id'],
            'password' => ['required', 'string', 'min:6'],
        ], [
            'nama.required' => 'Nama siswa wajib diisi.',
            'nis.required' => 'NIS siswa wajib diisi.',
            'nis.unique' => 'NIS sudah terdaftar.',
            'kelas_id.required' => 'Kelas wajib dipilih.',
            'kelas_id.exists' => 'Kelas tidak valid.',
            'password.required' => 'Password siswa wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
        ]);

        DB::transaction(function () use ($data): void {
            $user = User::create([
                'name' => $data['nama'],
                'email' => null,
                'nis' => $data['nis'],
                'password' => Hash::make($data['password']),
                'role' => 'siswa',
            ]);

            Siswa::create([
                'user_id' => $user->id,
                'kelas_id' => $data['kelas_id'],
                'nis' => $data['nis'],
                'nama' => $data['nama'],
            ]);
        });

        return back()->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function storeGuru(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'nip' => ['nullable', 'string', 'max:255', 'unique:gurus,nip'],
            'mata_pelajaran' => ['required', 'string', 'max:255'],
            'kelas_ids' => ['nullable', 'array'],
            'kelas_ids.*' => ['exists:kelas,id'],
        ], [
            'nama.required' => 'Nama guru wajib diisi.',
            'nip.unique' => 'NIP sudah terdaftar.',
            'mata_pelajaran.required' => 'Mata pelajaran wajib diisi.',
            'kelas_ids.*.exists' => 'Kelas yang dipilih tidak valid.',
        ]);

        $guru = Guru::create([
            'nama' => $data['nama'],
            'nip' => $data['nip'] ?: null,
            'mata_pelajaran' => $data['mata_pelajaran'],
        ]);

        $guru->kelas()->sync($data['kelas_ids'] ?? []);

        return back()->with('success', 'Data guru berhasil ditambahkan.');
    }
}
