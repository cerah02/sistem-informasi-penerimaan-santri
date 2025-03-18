<?php

namespace App\Providers;

use App\Models\Agenda;
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
        View::composer('layout_landingpage', function ($view) {
            $agenda = Agenda::orderBy('tanggal_agenda', 'desc')->limit(5)->get();
            $view->with('agendaFooter', $agenda);
        });
    }
}
