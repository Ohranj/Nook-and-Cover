<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
            
            Route::middleware('web')
                ->group(base_path('routes/auth.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('form_submit', function() {
            $key = 'form_submit'.Auth::id();
            $max = 5;
            $decay = 120;
            $hasExceededAttempts = RateLimiter::tooManyAttempts($key, $max);
            if ($hasExceededAttempts) {
                $secondsUntilReset = RateLimiter::availableIn($key);
                return redirect()
                    ->back()
                    ->with('throttled', $secondsUntilReset);
            } 
            RateLimiter::hit($key, $decay);
        });
    }
}
