<?php

namespace Amirsasani\ReportingSystem\Tests\Unit;

use Amirsasani\ReportingSystem\Models\Report;
use Amirsasani\ReportingSystem\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReportsTest extends TestCase
{
    use RefreshDatabase;

    public function test_report_has_user_type()
    {
        $report = Report::factory()->create(['user_type' => 'Fake\User']);
        $this->assertEquals('Fake\User', $report->user_type);
    }
}