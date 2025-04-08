<?php

namespace App\Http\Middleware;

use App\Models\Quiz;
use Closure;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

/**
 * Ensure quizzes can only access data for current tenant
 */
class ApplyTenantScopesMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        Quiz::addGlobalScope(fn (Builder $query) => $query->whereBelongsTo(Filament::getTenant()));

        return $next($request);
    }
}
