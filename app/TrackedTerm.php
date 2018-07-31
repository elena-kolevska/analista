<?php

namespace App;

use Illuminate\Redis\RedisManager;

class TrackedTerm
{
    const KEY_NAME = 'tracked_terms';

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
        return $this->redis->sadd(self::KEY_NAME, strtolower($term));
    }

    public function getAll()
    {
        return $this->redis->smembers(self::KEY_NAME);
    }
}
