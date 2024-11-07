<?php
namespace App\Providers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', 'App\Http\View\Composers\MenuComposer');
        View::composer('*', 'App\Http\View\Composers\FakerComposer');
        View::composer('*', 'App\Http\View\Composers\DarkModeComposer');
        View::composer('*', 'App\Http\View\Composers\LoggedInUserComposer');
        View::composer('*', 'App\Http\View\Composers\ColorSchemeComposer');

        // توجيه إلى /home إذا كان الطلب إلى /
        if (request()->is('/')) {
            Redirect::to('/Home_Page')->send();
        }
    }
}
