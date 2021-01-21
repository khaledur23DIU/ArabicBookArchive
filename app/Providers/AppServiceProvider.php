<?php

namespace App\Providers;

use App\SiteLanguages;
use App\SiteSetting;
use Illuminate\Support\Facades\Config;
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
        $language_active = SiteLanguages::where(['is_active' => 1])->first();

        if ($language_active) {
            

            Config::set('app.locale', $language_active->language_code);
        }
        else{
            Config::set('app.locale', 'en');
        }

        $site = SiteSetting::where(['id' => 1])->first();

        if ($site) {
            

            Config::set('app.name', $site->site_name);
        }
        else{
            Config::set('app.name', 'Archive');
        }
    }
}
