<?php

namespace Tests\Unit;

use App\TrackedTerm;
use Mockery;
use Tests\TestCase;
use Illuminate\Support\Facades\Redis;

class TrackedTermTest extends TestCase
{
    private $redisManagerMock;

    public function setUp()
    {
        parent::setUp();
    }

    public function testStore()
    {
        $this->redisManagerMock = Mockery::mock('Illuminate\Redis\RedisManager');
        $this->app->instance('redis', $this->redisManagerMock);

        $trackedTerm = "my_tracked_term";

        $this->redisManagerMock->shouldReceive('sadd')
            ->once()
            ->with(TrackedTerm::KEY_NAME, $trackedTerm);

        $this->app->make(TrackedTerm::class)->store($trackedTerm);
    }


    public function testStoreAsLowerCase()
    {
        $this->redisManagerMock = Mockery::mock('Illuminate\Redis\RedisManager');
        $this->app->instance('redis', $this->redisManagerMock);

        $trackedTerm = "My_Tracked_Term";

        $this->redisManagerMock->shouldReceive('sadd')
            ->once()
            ->with(TrackedTerm::KEY_NAME, strtolower($trackedTerm));

        $this->app->make(TrackedTerm::class)->store($trackedTerm);
    }

    public function testGetsAllTrackedTerms()
    {
        $this->redisManagerMock = Mockery::mock('Illuminate\Redis\RedisManager');
        $this->app->instance('redis', $this->redisManagerMock);

        $this->redisManagerMock->shouldReceive('smembers')
            ->once()
            ->with(TrackedTerm::KEY_NAME);

        $this->app->make(TrackedTerm::class)->getAll();
    }

}
