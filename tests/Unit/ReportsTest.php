<?php

namespace Amirsasani\ReportingSystem\Tests\Unit;

use Amirsasani\ReportingSystem\Details\Contracts\Details;
use Amirsasani\ReportingSystem\Details\NicknameDetails;
use Amirsasani\ReportingSystem\Models\Report;
use Amirsasani\ReportingSystem\ReportSystem;
use Amirsasani\ReportingSystem\Tests\TestCase;
use Amirsasani\ReportingSystem\Tests\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReportsTest extends TestCase
{
    use RefreshDatabase;

    public function test_report_has_user_type()
    {
        $report = Report::factory()->create(['user_type' => 'Fake\User']);
        $this->assertEquals('Fake\User', $report->user_type);
    }


    public function test_create_report_with_service()
    {
        $details = $this->detailsDataProvider();

        $user = User::factory()->create();
        $reportSystem = new ReportSystem($user);

        $newReport = $reportSystem->new('nickname', $details);

        $this->assertDatabaseHas('reports', ['report_status' => Report::STATUS_PENDING]);
        $this->assertInstanceOf(Report::class, $newReport);

        return $details;
    }


    public function test_report_and_report_log_create()
    {
        $details = $this->detailsDataProvider();

        $user = User::factory()->create();
        $reportSystem = new ReportSystem($user);

        $newReport = $reportSystem->new('nickname', $details);

        $this->assertDatabaseHas('report_logs', ['report_id' => $newReport->id]);
        $this->assertDatabaseCount('report_logs', 1);
    }


    public function test_report_count()
    {
        $details = $this->detailsDataProvider();

        $user_1 = User::factory()->create();
        $reportSystem = new ReportSystem($user_1);
        $report_1 = $reportSystem->new('nickname', $details);

        $user_2 = User::factory()->create();
        $reportSystem = new ReportSystem($user_2);
        $report_2 = $reportSystem->new('nickname', $details);


        /*
         * reports table should have 1 record and the report_count should be 2
         * because we have two reports with same details (same resource) from two users
         * and the report_logs should have 2 records
         */
        $this->assertDatabaseHas('reports', ['report_count' => 2]);
        $this->assertDatabaseCount('reports', 1);
        $this->assertDatabaseCount('report_logs', 2);
    }

    public function detailsDataProvider()
    {
        $details = new NicknameDetails();
        $details->setId(2);
        $details->setDescription("user's nickname is against rules");
        $details->setNickname("badusername");
        $details->setSubject("nickname is not valid");

        return $details;
    }
}