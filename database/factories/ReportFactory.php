<?php

namespace Amirsasani\ReportingSystem\Database\Factories;

use Amirsasani\ReportingSystem\Models\Report;
use Amirsasani\ReportingSystem\Tests\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{

    protected $model = Report::class;

    /**
     * @inheritDoc
     */
    public function definition()
    {
        $user = User::factory()->create();

        return [
            'user_id' => $user->id,
            'user_type' => get_class($user),
            'resource_type' => 'nickname',
            'details' => json_encode(['resource_id' => 1, 'nickname' => 'somebadword']),
            'report_status' => Report::STATUS_PENDING
        ];
    }
}