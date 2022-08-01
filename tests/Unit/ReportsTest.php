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

    /**
     * @dataProvider detailsDataProvider
     */
    public function test_create_report_with_service(Details $details)
    {
        $user = User::factory()->create();
        $reportSystem = new ReportSystem($user);

        $newReport = $reportSystem->new('nickname', $details);

        $this->assertDatabaseHas('reports', ['report_status' => Report::STATUS_PENDING]);
        $this->assertInstanceOf(Report::class, $newReport);

        return $details;
    }

    /**
     * @dataProvider detailsDataProvider
     */
    public function test_report_and_report_log_create(Details $details)
    {
        $user = User::factory()->create();
        $reportSystem = new ReportSystem($user);

        $newReport = $reportSystem->new('nickname', $details);

        $this->assertDatabaseHas('report_logs', ['report_id' => $newReport->id]);
        $this->assertDatabaseCount('report_logs', 1);
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