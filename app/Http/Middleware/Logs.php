<?php

namespace App\Http\Middleware;

use Closure;
use App\LogsData;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Str;

class Logs
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
        $log['user_id'] = auth()->user()->id;
        $log['url'] = \URL::previous();
        $log['data'] = $request->all();
        $logs = json_encode($log);

        if (Str::contains($log['url'], 'provinsi')){
            Log::channel('provinsi')->info($logs); 
        } elseif (Str::contains($log['url'], 'kabupaten-kota')) {
            Log::channel('kabupaten-kota')->info($logs);
        } elseif (Str::contains($log['url'], 'kecamatan')) {
            Log::channel('kecamatan')->info($logs);
        } elseif (Str::contains($log['url'], 'kelurahan')) {
            Log::channel('kelurahan')->info($logs);
        } else {
            Log::channel('participant')->info($logs);
        } 

        $data = json_encode($request->all());
        $store = LogsData::create( ['user_id' => $log['user_id'],
                                'url' => $log['url'],
                                'data' => $data
                            ]);
        if($store){
            return $next($request);
        }
    }
}

