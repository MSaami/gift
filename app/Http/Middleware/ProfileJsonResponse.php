<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;

class ProfileJsonResponse
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
        $response =  $next($request);

        if (!app()->bound('debugbar') || !app('debugbar')->isEnabled()){
            return $response;
        }

        if ($response instanceof JsonResponse){
            $response->setData(array_merge($response->getData(true), [
                '_debugbar' => $this->getProfilingData()
            ]));

        }
        return $response;
    }

    protected function getProfilingData()
    {
        $data = app('debugbar')->getData();
        if (array_key_exists('queries', $data)){
            return app('debugbar')->getData()['queries'];
        }
    }
}
