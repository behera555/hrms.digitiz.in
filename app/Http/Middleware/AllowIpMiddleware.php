<?php

namespace App\Http\Middleware;
use App\Models\Allowip;
use Closure;
use Illuminate\Http\Request;

class AllowIpMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $restrictedIp = Allowip::pluck('allowips')->toArray();
        if (!in_array($request->ip(), $restrictedIp)) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->back()->with('error','You are not allowed to access this Application.');
        }
        return $next($request);
    }
}
