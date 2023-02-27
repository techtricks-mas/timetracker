<?php

namespace App\Providers;

use App\Models\Setting;
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
        $settings = Setting::first();
        if ($settings) {
            $data = [
                'transport' => $settings->mail_transport,
                'host' => $settings->mail_host,
                'port' => $settings->mail_port,
                'encryption' => $settings->mail_encryption,
                'username' => $settings->mail_username,
                'password' => $settings->mail_password,
                'from' => [
                    'address' => $settings->mail_from,
                    'name' => $settings->mail_from_name,
                ]
            ];
            Config::set('mail', $data);
        }
    }
}
