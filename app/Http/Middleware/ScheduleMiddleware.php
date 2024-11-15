<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ScheduleMiddleware
{
    private $startHour;
    private $endHour;
    private $permission;

    public function __construct(
        $startHour = 9,
        $endHour = 18,
        $permission = "schedule 9:00 to 18:00"
    )
    {
        // Set default values
        $this->startHour = $startHour;
        $this->endHour = $endHour;
        $this->permission = $permission;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->is('nova/login')) {
            return $next($request);
        }

        $user = $request->user();
        
        $currentHour = now()->hour;
        
        if ($user && !$user->hasThisPermission($this->permission)) {
            return $next($request);
        }

        if (
            $user && 
            $user->hasThisPermission($this->permission) &&
            $currentHour >= $this->startHour &&
            $currentHour < $this->endHour
        ) {
            return $next($request);
        } else {
            return redirect('/')->with('error', 'You do not have access outside the allowed schedule.');
        }

        return $next($request);
    }
}
