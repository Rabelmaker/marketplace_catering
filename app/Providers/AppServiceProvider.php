<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        // Membagikan data ke semua view
        View::composer('*', function ($view) {
            $adminId = Auth::guard('admin')->id();
            $sekolah = DB::table('sekolah_tb')
                ->where('id_admin', $adminId)
                ->first();
            $view->with('dataSekolah', $sekolah);
        });
    }
}
