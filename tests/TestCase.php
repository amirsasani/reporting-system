<?php

namespace Amirsasani\ReportingSystem\Tests;

use Amirsasani\ReportingSystem\ReportingSystemServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function user($email = 'old@example.com')
    {
        return User::create([
            'id' => 1,
            'name' => 'Demo User',
            'email' => $email,
            'password' => 'secret',
        ]);
    }

    protected function getPackageProviders($app)
    {
        return [
            ReportingSystemServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        include_once __DIR__ . '/../database/migrations/create_users_table.php.stub';
        include_once __DIR__ . '/../database/migrations/create_reports_table.php.stub';
        include_once __DIR__ . '/../database/migrations/create_report_logs_table.php.stub';

        (new \CreateUsersTable)->up();
        (new \CreateReportsTable)->up();
        (new \CreateReportLogsTable)->up();
    }
}