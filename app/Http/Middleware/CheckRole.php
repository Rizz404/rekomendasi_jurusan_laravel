<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!$request->user())
        {
            return redirect()->route('login');
        }


        // Jika role yang diizinkan berupa list (dipisahkan koma)
        if (strpos($role, '|') !== false)
        {
            $roles = explode('|', $role);
            if (in_array($request->user()->role, $roles))
            {
                return $next($request);
            }
        }
        // Jika hanya satu role
        else if ($request->user()->role === $role)
        {
            return $next($request);
        }

        // Jika role tidak sesuai
        return redirect()->route('landing')->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
    }
}
