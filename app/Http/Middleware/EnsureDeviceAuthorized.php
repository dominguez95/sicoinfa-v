<?php

namespace App\Http\Middleware;

use App\Models\AuthorizedDevices;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureDeviceAuthorized
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $deviceId = sha1($request->header('User-Agent') . '_' . $request->ip());

        $authorized = AuthorizedDevices::where('device_hash', $deviceId)
            ->whereHas('authorizedotp', function ($q) {
                $q->where('expires_at', '>', now());
            })
            ->exists();

        if ($authorized) {
            return $next($request);
        }

        return redirect()->route('login.admin')->withErrors([
            'auth' => 'Este dispositivo no está autorizado. Inicia sesión como administrador.'
        ]);
    }
}
