<?php

namespace App;

use Exception;
use Illuminate\Redis\RedisManager;

class Tweet
{

    const TWEET_PREFIX = "tweets:";
    const UNPROCESSED_QUEUE_PREFIX = "unprocessed_tweets:";

    /**
     * @var RedisManager
     */
    private $redis;

    /**
     * Tweet constructor.
     * @param RedisManager $redis
     */
    public function __construct(RedisManager $redis)
    {
        $this->redis = $redis;
    }

    public function makeFromRaw(array $tweet)
    {
        $this->id = $tweet['id'];
        $this->text = $tweet['text'];

        if ($tweet['truncated']){
            $this->text = $this->getExtendedTweet($tweet);
        }

        return $this;
    }

    /**
     * @param array $tweet
     * @return string
     */
    private function getExtendedTweet(array $tweet)
    {
        try {
            return $tweet['extended_tweet']['full_text'];
        } catch(Exception $e){
            return $this->text;
        }
    }

    public function save()
    {
        return $this->redis->set($this->getTweetKey(), $this->text);
    }

    public function queueForProcessing()
    {

    }

    /**
     * @return string
     */
    public function getTweetKey()
    {
        return self::TWEET_PREFIX . $this->id;
    }
}
