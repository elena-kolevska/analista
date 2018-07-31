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
            ->with('tracked_terms', $trackedTerm);

        $this->app->make(TrackedTerm::class)->store($trackedTerm);
    }
    public function testStoreAsLowerCase()
    {
        $this->redisManagerMock = Mockery::mock('Illuminate\Redis\RedisManager');
        $this->app->instance('redis', $this->redisManagerMock);

        $trackedTerm = "My_Tracked_Term";

        $this->redisManagerMock->shouldReceive('sadd')
            ->once()
            ->with('tracked_terms', strtolower($trackedTerm));

        $this->app->make(TrackedTerm::class)->store($trackedTerm);
    }
}
