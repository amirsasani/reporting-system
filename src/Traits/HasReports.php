<?php

namespace Amirsasani\ReportingSystem\Traits;

use Amirsasani\ReportingSystem\Models\Report;

trait HasReports
{
    public function reports()
    {
        return $this->morphMany(Report::class, 'user');
    }
}