<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\EmailSetting;
use Config;

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
         // $settings = EmailSetting::first(); 
        // //dd($settings->smtp_host);
        // if($settings){


            // $mailConfig = [
            //     'driver'    => $settings->email_protocol,
            //     //'transport' => $settings->email_protocol,
            //     'host'      => $settings->smtp_host,
            //     'port'      => $settings->smtp_port,
            //     'encryption'=> $settings->email_encryption,
            //     'username'  => $settings->smtp_user,
            //     'password'  => $settings->smtp_password,
            //     'from'      => [
            //             'address' => $settings->smtp_user,
            //             'name'    => 'AMB Logistic'
            //     ],
            // ];
            // Config::set('mail',$mailConfig);
            
        // }
    }
}
