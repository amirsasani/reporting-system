<?php

namespace Amirsasani\ReportingSystem\Tests\Unit;

use Amirsasani\ReportingSystem\Models\Report;
use Amirsasani\ReportingSystem\ReportSystem;
use Amirsasani\ReportingSystem\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;

class DeleteRejectedReportsTest extends TestCase
{
    use RefreshDatabase;

    public function test_delete_rejected_reports()
    {
        $details = $this->detailsDataProvider();

        $user = $this->user();
        $reportSystem = new ReportSystem($user);
        $newReport = $reportSystem->new('nickname', $details);

        $newReport->update(['report_status' => Report::STATUS_REJECTED]);

        Artisan::call('reports:delete-rejected');

        $this->assertDatabaseCount('reports', 0);
    }
}
