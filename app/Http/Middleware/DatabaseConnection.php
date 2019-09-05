<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DatabaseConnection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        try {
            config()->set('database.connections.tenant.host', Auth::user()->databases->first()->host);
            config()->set('database.connections.tenant.port', Auth::user()->databases->first()->port);
            config()->set('database.connections.tenant.database', Auth::user()->databases->first()->database);
            DB::reconnect('tenant');
        } catch (\Exception $e) {
            return redirect()->route('admin.login');
        }
        

        return $next($request);
    }
}
