<?php

namespace App\Http\Middleware;

use App\Models\ServiceType;
use Closure;

class CheckServiceType
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
        if (ServiceType::all()->count() === 0) :
            session()->flash('warning', 'Your need to Create Service Types First.');
            return redirect()->route('service-types.create');
        endif;
        return $next($request);
    }
}
