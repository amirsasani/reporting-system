<?php

namespace Amirsasani\ReportingSystem;


use Amirsasani\ReportingSystem\Details\Contracts\Details;
use Amirsasani\ReportingSystem\Exceptions\UserMustUseHasReportsTraitException;
use Amirsasani\ReportingSystem\Models\Report;
use Amirsasani\ReportingSystem\Traits\HasReports;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\DB;

class ReportSystem
{
    /**
     * @var Authenticatable
     */
    private $user;

    /**
     * @param Authenticatable $user
     * @throws UserMustUseHasReportsTraitException
     */
    public function __construct(Authenticatable $user)
    {
        if (!trait_exists(HasReports::class)) {
            throw new UserMustUseHasReportsTraitException();
        }
        $this->user = $user;
    }

    /**
     * @param string $resource_type
     * @param Details $details
     * @return false|Report
     */
    public function new(string $resource_type, Details $details)
    {
        // check if report for this resource exists
        $report = Report::where([
            ['resource_type', '=', $resource_type],
            ['details->id', '=', $details->asArray()['id']],
        ])->first();

        if(!$report) {
            DB::transaction(function () use (&$report, $resource_type, $details) {
                $report = $this->user->reports()->create([
                    'user_id' => $this->user->id,
                    'user_type' => get_class($this->user),
                    'resource_type' => $resource_type,
                    'report_status' => Report::STATUS_PENDING,
                    'details' => $details->asJson(),
                ]);
            }, 3);
        }else{
            $report->update(['report_count' => DB::raw('report_count + 1')]);
        }

        $report->reportLog()->create(['user_id' => $this->user->id]);

        return $report;
    }
}