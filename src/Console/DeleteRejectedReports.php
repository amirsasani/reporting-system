<?php

namespace Amirsasani\ReportingSystem\Console;

use Amirsasani\ReportingSystem\Models\Report;
use Illuminate\Console\Command;

class DeleteRejectedReports extends Command
{
    protected $signature = 'reports:delete-rejected';

    protected $description = "Delete rejected reports and their logs";

    public function handle()
    {
        $this->info('Deleting rejected reports ...');

        $rejectedReports = Report::where('report_status', Report::STATUS_REJECTED);

        $this->info(sprintf("Found %d rejected reports!", $rejectedReports->count()));

        $rejectedReports->delete();
    }
}