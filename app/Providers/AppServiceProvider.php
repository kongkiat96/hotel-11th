<?php

namespace App\Providers;

use App\Models\Master\getDataMasterModel;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    private $masterModel;
    private $employeeModel;
    public function __construct()
    {
        $this->masterModel = new getDataMasterModel;
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

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $getAboutApp = $this->masterModel->getDataAboutApp();
        Schema::defaultStringLength(191);
        Config::set([
            'aboutApp.show_app_name'=> $getAboutApp->show_app_name,
            'aboutApp.about_app_img'=> $getAboutApp->about_app_img,
            ]);
    }
}
