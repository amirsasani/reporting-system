<?php

namespace Amirsasani\ReportingSystem;


use Amirsasani\ReportingSystem\Console\DeleteRejectedReports;
use Illuminate\Support\ServiceProvider;


class ReportingSystemServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../database/migrations/create_reports_table.php.stub' =>  database_path('migrations/' . date('Y_m_d_His', time()) . '_create_reports_table.php'),
                __DIR__ . '/../database/migrations/create_report_logs_table.php.stub' =>  database_path('migrations/' . date('Y_m_d_His', time()) . '_create_report_logs_table.php'),
            ], 'migrations');

            $this->commands([
                DeleteRejectedReports::class,
            ]);
        }
    }
}