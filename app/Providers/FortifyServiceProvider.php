<?php

namespace App\Providers;
namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Added for Auth class
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str; // Added for Str class
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Illuminate\Contracts\Auth\StatefulGuard; // Added for StatefulGuard interface
use Laravel\Fortify\Contracts\LoginResponse; // Added for LoginResponse contract
use Laravel\Fortify\Contracts\TwoFactorAuthenticationProvider; // Added for TwoFactorAuthenticationProvider contract
use Laravel\Fortify\Contracts\LogoutResponse;
use app\Http\Controllers\AdminController;
use App\Actions\Fortify\AttemptToAuthenticate;
use App\Actions\Fortify\RedirectIfTwoFactorAuthenticatable;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
{
    $this->app->when([AdminController::class, AttemptToAuthenticate::class, RedirectIfTwoFactorAuthenticatable::class])
        ->needs(StatefulGuard::class)->give(function () {
            return Auth::guard('admin');
        });
}


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
