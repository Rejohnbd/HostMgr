<?php

namespace App\Http\Middleware;

use App\Models\HostingPackage;
use Closure;

class CheckHostingPackageCount
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
        if (HostingPackage::all()->count() === 0) :
            session()->flash('warning', 'Your need to Create Service Types First.');
            return redirect()->route('hosting-packages.create');
        endif;
        return $next($request);
    }
}
