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
            config()->set('database.connections.mysql.host', Auth::user()->databases->first()->host);
            config()->set('database.connections.mysql.port', Auth::user()->databases->first()->port);
            config()->set('database.connections.mysql.database', Auth::user()->databases->first()->database);
            DB::reconnect('mysql');
        } catch (\Exception $e) {
            return redirect()->route('admin.login');
        }
        

        return $next($request);
    }
}
