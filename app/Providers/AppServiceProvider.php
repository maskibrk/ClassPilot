<?php

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use Illuminate\Validation\Rule;
use App\Models\Student;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (
            $this->app->environment('local') &&
            class_exists(\Laravel\Telescope\TelescopeServiceProvider::class)
        ) {

            $this->app->register(
                \Laravel\Telescope\TelescopeServiceProvider::class
            );

            $this->app->register(
                TelescopeServiceProvider::class
            );
        }
    }
    /**/
    /*     * Bootstrap any application services. */
    /*      */
    /* / */
    public function boot(): void
    {
        Route::bind('teacher', function ($value) {
            return User::teachers()->findOrFail($value);
        });
        Route::bind('student', function ($value) {
            return Student::findOrFail($value);
        });
        Route::bind('parent', function ($value) {
            return User::parents()->findOrFail($value);
        });
        Rule::macro('userWithRole', function (string $role) {
            return Rule::exists('users', 'id')->where('role', $role);
        });
    }

    /* * Configure default behaviors for production-ready applications. */
    /* */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(
            fn(): ?Password => app()->isProduction()
                ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
                : null,
        );
    }
}
