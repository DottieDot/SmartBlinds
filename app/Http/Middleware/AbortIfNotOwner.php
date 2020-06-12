<?php

namespace App\Http\Middleware;

use Closure;

class AbortIfNotOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $model, $parameterName)
    {
        $resourceId = $request->route()->parameter($parameterName);

        $resource = $model::find($resourceId);

        if ($resource === null || $resource->user_id !== $request->user()->id) {
            abort(403);
        }

        return $next($request);
    }
}
