<?php

namespace Amirsasani\ReportingSystem\Tests;

use Amirsasani\ReportingSystem\Details\NicknameDetails;
use Amirsasani\ReportingSystem\ReportingSystemServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function user()
    {
        return User::factory()->create();
    }

    protected function detailsDataProvider()
    {
        $details = new NicknameDetails();
        $details->setId(2);
        $details->setDescription("user's nickname is against rules");
        $details->setNickname("badusername");
        $details->setSubject("nickname is not valid");

        return $details;
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
        include_once __DIR__ . '/../database/migrations/create_blacklist_table.php.stub';

        (new \CreateUsersTable)->up();
        (new \CreateReportsTable)->up();
        (new \CreateReportLogsTable)->up();
        (new \CreateBlacklistsTable)->up();
    }
}