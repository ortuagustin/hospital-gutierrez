<?php

namespace App\Http\Middleware;

use App\ApplicationSetting;
use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Http\Exceptions\MaintenanceModeException;
use Illuminate\Support\Facades\Artisan;

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
        'login', 'logout',
    ];

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     *
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
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->checkMaintenanceModeSetting();

        if ($this->shouldPassThrough($request)) {
            return $next($request);
        }

        $data = json_decode(file_get_contents($this->app->storagePath().'/framework/down'), true);

        if ($request->wantsJson()) {
            request()->session()->flash('flash', 'Service unavailable; only Admins may log in');
            request()->session()->flash('flash-type', 'is-danger');

            return response()->json(['error' => 'Service unavailable; only Admins may log in'], 503);
        }

        throw new MaintenanceModeException($data['time'], $data['retry'], $data['message']);
    }

    /**
     * Puts the site in maintenance mode if specified in the system settings
     *
     * @return void
     */
    protected function checkMaintenanceModeSetting()
    {
        ApplicationSetting::onMaintenance() ? $this->ensureDown() : $this->ensureUp();
    }

    /**
     * Puts the site in maintenance mode if needed
     *
     * @return void
     */
    protected function ensureDown()
    {
        if (! $this->isDownForMaintenance()) {
            Artisan::call('down');
        }
    }

    /**
     * Takes the site out of maintenance mode if needed
     *
     * @return void
     */
    protected function ensureUp()
    {
        if ($this->isDownForMaintenance()) {
            Artisan::call('up');
        }
    }

    /**
     * Returns wether the request should ignore the middleware
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return bool
     */
    protected function shouldPassThrough($request)
    {
        return (
                ! $this->isDownForMaintenance() ||
                  $this->inExceptArray($request) ||
                  $this->isWhitelisted($request)
        );
    }

    /**
     * Wrapper for app->isDownForMaintenance()
     * Returns wether the application is in maintenance mode
     *
     * @return bool
     */
    protected function isDownForMaintenance()
    {
        return $this->app->isDownForMaintenance();
    }

    /**
     * Determine if the request has a URI that should pass through.
     *
     * @param  \Illuminate\Http\Request  $request
     *
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
     *
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
