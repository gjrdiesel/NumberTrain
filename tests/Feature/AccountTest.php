<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Facades\App\Accounts\YouTube\Channel;
use Facades\App\Accounts\Twitter;
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
        $account->track(10, 'Youtube Subscribers');

        // gets user total follow #
        $this->assertEquals(10, $user->totalFollowers);

        // gets user follow count by last 7 days for all accounts
        $this->assertEquals([0, 0, 0, 0, 0, 0, 10], $user->last7Days);

        // gets user follow count for a single account for last 7 days
        $this->assertEquals([0, 0, 0, 0, 0, 0, 10], $user->accounts()->first()->last7Days);
    }

    function test_grabs_twitter_followers()
    {
        // create user
        $user = User::first() ?? factory(User::class)->create();

        // user adds account
        $account = $user->addAccount([
            'username' => 'gjreasoner',
            'type' => Twitter::class
        ]);

        $twitter = Twitter::fetch($account);

        $this->assertEquals('gjreasoner', $twitter->username);
        $this->assertNotNull($twitter->followers);
    }

    function test_grabs_youtube_subscribers()
    {
        // create user
        $user = User::first() ?? factory(User::class)->create();

        // user adds account
        $account = $user->addAccount([
            'username' => 'UCMa2GeloonhtykTGTmVLEiQ',
            'type' => Channel::class
        ]);

        $youtube = Channel::fetch($account);

        $this->assertEquals($account->username, $youtube->username);
        $this->assertNotNull($youtube->views);
        $this->assertNotNull($youtube->subscribers);
    }
}
