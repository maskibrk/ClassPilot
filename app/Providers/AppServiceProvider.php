<?php

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
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
        Route::bind('students', function ($value) {
            return Student::findOrFail($value);
        });
        Route::bind('parent', function ($value) {
            return User::parents()->findOrFail($value);
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
