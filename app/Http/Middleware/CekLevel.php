<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$levels): Response
    {
        if (in_array($request->user()->level,$levels)){
            return $next($request);
        }
          // Simpan URL saat ini
            $previousUrl = url()->previous();

            // Jika URL sebelumnya adalah URL saat ini, maka arahkan ke halaman utama
            if ($previousUrl == $request->url()) {
                return redirect('/');
            }

            // Jika URL sebelumnya bukan URL saat ini, arahkan kembali ke URL sebelumnya
            return redirect()->to($previousUrl);
    }
}
