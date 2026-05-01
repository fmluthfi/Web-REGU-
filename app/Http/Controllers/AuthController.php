<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();
        $login = trim($credentials['login']);
        $throttleKey = mb_strtolower($login).'|'.$request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            throw ValidationException::withMessages([
                'login' => 'Terlalu banyak percobaan login gagal. Coba lagi beberapa saat.',
            ]);
        }

        $user = User::query()
            ->where('email', $login)
            ->orWhere('nis', $login)
            ->orWhere('name', $login)
            ->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            RateLimiter::hit($throttleKey, 60);

            return back()
                ->withErrors(['login' => 'Kredensial tidak valid.'])
                ->onlyInput('login');
        }

        RateLimiter::clear($throttleKey);
        Auth::login($user, false);
        $request->session()->regenerate();

        return redirect()->intended($this->redirectPath($user->role));
    }

    public function destroy(): RedirectResponse
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function redirect(): RedirectResponse
    {
        /** @var User $user */
        $user = auth()->user();

        return redirect()->to($this->redirectPath($user->role));
    }

    private function redirectPath(string $role): string
    {
        switch ($role) {
            case 'siswa':
                return '/siswa/dashboard';
            case 'guru_bk':
                return '/bk/dashboard';
            case 'kepala_sekolah':
                return '/kepala-sekolah/dashboard';
            default:
                return '/';
        }
    }
}
