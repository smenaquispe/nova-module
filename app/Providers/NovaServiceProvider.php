<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Illuminate\Http\Request;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Dashboards\Main;
use App\Nova\Dashboards\UserInsights;
USE App\Nova\Dashboards\CatInsights;
use App\Nova\User;
use App\Nova\Cat;
use App\Nova\Permission;
use App\Nova\Role;
use Acme\PriceTracker\PriceTracker;
use Laravel\Nova\Events\ServingNova;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {    
        parent::boot();

        Nova::mainMenu(function (Request $request) {
            return [
                MenuSection::dashboard(Main::class)->icon('chart-bar'),

                MenuSection::make('Models', [
                    MenuItem::resource(User::class),
                    MenuItem::resource(Cat::class),
                ])->icon('user')->collapsable(),

                MenuSection::make('Authorization', [
                    MenuItem::resource(Permission::class),
                    MenuItem::resource(Role::class), 
                ])->icon('document-text')->collapsable(),

                MenuSection::dashboard(UserInsights::class)->icon('chart-bar'),
                MenuSection::dashboard(CatInsights::class)->icon('chart-bar'),
                
                MenuSection::make('Contact Form')
                    ->path('price-tracker')
                    ->icon('currency-dollar')
            ];
        });

    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes(default: true)
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            // return $user->isAdmin();
            // return in_array($user->email, [
            //     //
            // ]);
            return true;
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            Main::make(),
            UserInsights::make(),
            CatInsights::make(),
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            PriceTracker::make(),
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}
