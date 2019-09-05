<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Manager\Apikey;

class CheckReferrer
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
        // $fullReferrer = $request->server('HTTP_REFERER');
        // $parsed_url = parse_url($fullReferrer);
        // $domain = $parsed_url['scheme'] . '://' . $parsed_url['host'] . ($parsed_url['port'] ? ':'.$parsed_url['port'] : '');

        if(!$apikey) {
            return response()->json(['error' => 'Invalid api key']);
        }

        $referrers = $apikey->referrers;

        return response()->json($referrers);
        foreach($referrers as $referrer) {
            if (preg_match('/^'.$this->convertToRegExp($referrer['referrer']).'$/', $domain)) {
                return $next($request);                
            }
        }

        return response()->json(['error' => 'Invalid referrer']);
    }

    protected function convertToRegExp ($referrer=null) {
        $result = null;

        if ($referrer) {
            if ($referrer === '*') {
                $result = '.+:\/\/.+(:.+)?';
            } else {
                $result = preg_replace('/([\.\/])/i', '\\\$1', $referrer);
                $result = preg_replace('/\*/', '.+', $result);
                $result = preg_replace('/:\.\+/', '(:.+)?', $result);
            }    
        }

        return $result;
    }
}
