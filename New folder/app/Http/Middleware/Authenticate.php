<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
//        // Check for 'admin' route and if both guards are provided
//        if (((!empty($guards[1]) && !auth()->guard($guards[1])->check()) || (!empty($guards[0]) && !auth()->guard($guards[0])->check())) && $request->segment(1) == 'admin') {
//            return redirect()->route('admin.login');
//        }

        // Check for 'supplier' route
        if (!auth()->guard($guards[0])->check() && $request->segment(1) == 'seller') {
            return redirect()->route('seller.login');
        }

        // Check for 'customer' route
        if (!auth()->guard($guards[0])->check() && $request->segment(1) == 'customer') {
            return redirect()->route('customer.login');
        }

        return $next($request);
    }

    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('main_admin.login');
        }
    }
}
