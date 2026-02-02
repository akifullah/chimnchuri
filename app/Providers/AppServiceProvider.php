<?php

namespace App\Providers;

use App\Models\SmtpSetting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        if (Schema::hasTable("smtp_settings")) {
            $smtp = SmtpSetting::first();
            if ($smtp) {
                Config::set("mail.default", $smtp->mailer);
                Config::set("mail.mailers.smtp.host", $smtp->host);
                Config::set("mail.mailers.smtp.username", $smtp->username);
                Config::set("mail.mailers.smtp.password", $smtp->password);
                Config::set("mail.mailers.smtp.port", $smtp->port);
                Config::set("mail.mailers.smtp.encryption", $smtp->encryption);
                Config::set("mail.from.address", $smtp->from_address);
                Config::set("mail.from.name", $smtp->from_name);
            }
        }
    }
}
