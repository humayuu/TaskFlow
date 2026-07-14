<?php

namespace App\Http\Middleware;

use App\Models\Task;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class UpdateTaskStatusMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $cacheKey = 'task-status-check-' . Carbon::now()->format('Y-m-d');


        if (! Cache::has($cacheKey)) {
            Task::where('status', '!=', 'complete')
                ->where('due_date', '<', Carbon::now())
                ->update(['status' => 'due']);
            Cache::put($cacheKey, true, Carbon::now()->endOfDay());
        }

        return $next($request);
    }
}