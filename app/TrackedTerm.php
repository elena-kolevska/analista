<?php

namespace App;

use Illuminate\Redis\RedisManager;

class TrackedTerm
{
    /**
     * Tweet constructor.
     * @param RedisManager $redis
     */
    public function __construct(RedisManager $redis)
    {
        $this->redis = $redis;
    }

    public function store($term)
    {
        $this->redis->sadd('tracked_terms', strtolower($term));
    }
}
