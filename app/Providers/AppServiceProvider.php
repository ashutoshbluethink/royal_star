<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\User\Role;
    

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    // public function boot(): void
    // {
    //     //
    // }

    public function boot()
    {
        // Share user and role data with all views
        View::composer('*', function ($view) {
            $user = Auth::user();
            if ($user) {
                $role = $user->role;
                $role = Role::where('role_id', $role)->first();
                $view->with(compact('user', 'role'));
            }
        });
    }
}
