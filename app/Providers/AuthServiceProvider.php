<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        view()->composer('*', function ($view) {
            if (Auth::check()) 
            {
                $currentUser = Auth::user();
                $uuid = $currentUser->user_uuid;
                $image = $currentUser->image;
                $view->with('logged_in_user_uuid', $uuid)->with('logged_in_user_image', $image);

            } 
        });
    }
}
