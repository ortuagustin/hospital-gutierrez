<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Http\Exceptions\MaintenanceModeException;

/**
 * Replaces built-in \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode with
 * a custmom implementation that allows to whitelist users and bypass the middleware
 */
class CheckForMaintenanceMode
{
    /**
     * The application implementation.
     *
     * @var \Illuminate\Contracts\Foundation\Application
     */
    protected $app;

    /**
     * The URIs that should be always allowed regardless maintenance mode
     *
     * @var array
     */
    protected $except = [
        'login', 'logout', 'password/*',
    ];

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return void
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->shouldPassThrough($request)) {
            return $next($request);
        }

        $data = json_decode(file_get_contents($this->app->storagePath().'/framework/down'), true);

        throw new MaintenanceModeException($data['time'], $data['retry'], $data['message']);
    }

    /**
     * Returns wether the request should ignore the middleware
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function shouldPassThrough($request)
    {
        return (
                ! $this->isDownForMaintenance($request) ||
                  $this->inExceptArray($request) ||
                  $this->isWhitelisted($request)
        );
    }

    /**
     * Wrapper for app->isDownForMaintenance()
     * Returns wether the application is in maintenance mode
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function isDownForMaintenance($request)
    {
        return $this->app->isDownForMaintenance();
    }

    /**
     * Determine if the request has a URI that should pass through CSRF verification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function inExceptArray($request)
    {
        foreach ($this->except as $except) {
            if ($except !== '/') {
                $except = trim($except, '/');
            }

            if ($request->is($except)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Returns wether the request is whitelisted when application is down for maintenance
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function isWhitelisted($request)
    {
        if (! auth()->check()) {
            return false;
        }

        return auth()->user()->isAdmin();
    }
}