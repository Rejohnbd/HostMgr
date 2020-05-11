<?php

namespace App\Http\Middleware;

use App\Models\Customer;
use Closure;

class CheckCustomersCount
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
        if (Customer::all()->count() === 0) :
            session()->flash('warning', 'Your need to Create Customer First.');
            return redirect()->route('customers.create');
        endif;
        return $next($request);
    }
}
