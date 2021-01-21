<?php

namespace App\Providers;

use App\SiteLanguages;
use App\SiteSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $setting = SiteSetting::where('id',1)->first(['site_name','footer_text','meta_title','meta_description','site_logo','site_favicon','user_avatar']);
            $lang = SiteLanguages::where('is_active',1)->first();
            $view->with(['setting' => $setting, 'lang' => $lang]);
        });
    }
}
