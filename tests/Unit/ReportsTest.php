<?php

namespace Amirsasani\ReportingSystem\Tests\Unit;

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
        $user = User::factory()->create();
        $reportSystem = new ReportSystem($user);

        $details = new NicknameDetails();
        $details->setId(2);
        $details->setDescription("user's nickname is against rules");
        $details->setNickname("badusername");
        $details->setSubject("nickname is not valid");

        $newReport = $reportSystem->new('nickname', $details);

        $this->assertDatabaseHas('reports', ['report_status' => Report::STATUS_PENDING]);
    }
}