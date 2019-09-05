<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Manager\Apikey;

class DatabaseConnectionByApi
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
        $key = $request->query('key');
        $apikey = Apikey::where('key', $key)->first();

        if(!$apikey) {
            return response()->json(['error' => 'Invalied api key']);
        }
        
        $db = $apikey->databases()->first();
        config()->set('database.connections.tenant.host', $db->host);
        config()->set('database.connections.tenant.port', $db->port);
        config()->set('database.connections.tenant.database', $db->database);
        DB::reconnect('tenant');
        
        return $next($request);
    }
}
