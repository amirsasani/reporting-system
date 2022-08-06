<?php

namespace Amirsasani\ReportingSystem\Tests\Unit;

use Amirsasani\ReportingSystem\ReportSystem;
use Amirsasani\ReportingSystem\Tests\TestCase;
use Amirsasani\ReportingSystem\Tests\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BlacklistsTest extends TestCase
{
    use RefreshDatabase;

    public function test_add_to_blacklist()
    {
        $name = 'badusername';
        $type = User::class;

        ReportSystem::addToBlacklist($name, $type);

        $this->assertDatabaseCount('blacklists', 1);
    }

    public function test_remove_from_blacklist()
    {
        $name = 'badusername';
        $type = User::class;

        $blacklist = ReportSystem::addToBlacklist($name, $type);

        $this->assertDatabaseCount('blacklists', 1);

        ReportSystem::removeFromBlacklist($blacklist->id);

        $this->assertDatabaseCount('blacklists', 0);
    }
}