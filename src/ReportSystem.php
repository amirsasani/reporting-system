<?php

namespace Amirsasani\ReportingSystem;


use Amirsasani\ReportingSystem\Details\Contracts\Details;
use Amirsasani\ReportingSystem\Exceptions\UserMustUseHasReportsTraitException;
use Amirsasani\ReportingSystem\Models\Report;
use Amirsasani\ReportingSystem\Traits\HasReports;
use Illuminate\Contracts\Auth\Authenticatable;

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

    public function new(string $resource_type, Details $details)
    {
        return $this->user->reports()->create([
            'user_id' => $this->user->id,
            'user_type' => get_class($this->user),
            'resource_type' => $resource_type,
            'report_status' => Report::STATUS_PENDING,
            'details' => $details->asJson(),
        ]);
    }
}