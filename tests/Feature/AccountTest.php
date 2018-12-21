<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccountTest extends TestCase
{
    use RefreshDatabase;

    public function test_base_api()
    {
        // create user
        $user = User::first() ?? factory(User::class)->create();

        // user adds account
        $account = $user->addAccount([
            'username' => 'gjreasoner',
            'type' => 'yOutUbe'
        ]);

        // account scans for stats
        $account->trackFollowers(120);

        // gets user total follow #
        $this->assertEquals(10, $user->totalFollowers);

        // gets user follow count by last 7 days for all accounts
        $this->assertEquals([0, 0, 0, 0, 0, 0, 10], $user->last7Days);

        // gets user follow count for a single account for last 7 days
        $this->assertEquals([0, 0, 0, 0, 0, 0, 10], $user->accounts()->first()->last7Days);
    }
}
