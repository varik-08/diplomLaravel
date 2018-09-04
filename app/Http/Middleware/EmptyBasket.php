<?php

namespace App\Http\Middleware;

use Closure;

class EmptyBasket
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
        if(!session()->has('orderNumber'))
        {
            session()->flash('success', 'Ваша корзина пуста!');
            return redirect()->route('index');
        }
        return $next($request);
    }
}
