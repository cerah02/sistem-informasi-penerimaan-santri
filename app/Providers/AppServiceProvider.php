<?php

namespace App\Providers;

use App\Models\Agenda;
use Illuminate\Support\Facades\Auth;
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
        // Composer untuk layout yang pakai navbar (ganti 'layouts.app' sesuai nama file layout kamu)
        View::composer('layout', function ($view) {
            $user = Auth::user();

            if ($user && $user->hasRole('Santri')) {
                $santri = \App\Models\Santri::where('user_id', $user->id)->first();
                $unreadNotifications = $user->unreadNotifications;

                $view->with([
                    'Santri' => $santri,
                    'unreadNotifications' => $unreadNotifications
                ]);
            }

            if ($user && $user->hasRole('Guru')) {
                $guru = \App\Models\Guru::where('user_id', $user->id)->first();
                $view->with('Guru', $guru);
            }
        });

        // Composer untuk layout landing page seperti yang sudah kamu pakai
        View::composer('layout_landingpage', function ($view) {
            $agenda = \App\Models\Agenda::orderBy('tanggal_agenda', 'desc')->limit(5)->get();
            $view->with('agendaFooter', $agenda);
        });
    }
}
