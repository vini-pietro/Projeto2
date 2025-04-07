<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsGod
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role === 'god') {
            return $next($request);
        }

        abort(403, 'Acesso não autorizado');
    }
}
