<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckStatus
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Jika user tidak login, lanjutkan request tanpa logout
        if (!$user) {
            return $next($request);
        }

        // Jika user tidak aktif atau akun dihapus, logout dan redirect
        if ($user->status !== 'active' || $user->deleted_at !== null) {
            Auth::logout();
            return redirect('/login')->withErrors(['status' => 'Akun Anda tidak aktif atau telah dihapus.']);
        }

        return $next($request);
    }
}
