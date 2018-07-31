<?php

namespace Tests\Unit;

use Mockery;
use Tests\TestCase;
use Illuminate\Support\Facades\Redis;

class TweetTest extends TestCase
{

    private $rawTweetShort;
    private $rawTweetLong;
    private $tweet;
    private $redisManagerMock;

    public function setUp()
    {
        parent::setUp();

        $this->tweet = $this->app->make('App\Tweet');

        $this->rawTweetShort = [
            'id' => 123,
            'text' => 'Short tweet',
            'truncated' => false,
        ];

        $this->rawTweetLong = [
            'id' => 123,
            'text' => "Longer tweet...",
            'truncated' => true,
            'extended_tweet' => [
                'full_text' => "Longer tweet was posted"
            ]
        ];
        $this->rawTweetLongMissingExtendedTweetKey = [
            'id' => 123,
            'text' => "Longer tweet...",
            'truncated' => true
        ];
    }

    public function testCreatingATweetObjectFromAShortRawTweet()
    {
        $tweet = $this->tweet->build($this->rawTweetShort);

        $this->assertEquals($this->rawTweetShort['id'], $tweet->id);
        $this->assertEquals($this->rawTweetShort['text'], $tweet->text);
    }

    public function testCreatingATweetObjectFromALongRawTweet()
    {
        $tweet = $this->tweet->build($this->rawTweetLong);

        $this->assertEquals($this->rawTweetLong['id'], $tweet->id);
        $this->assertEquals($this->rawTweetLong['extended_tweet']['full_text'], $tweet->text);
    }

    public function testCreatingATweetObjectFromALongRawTweetWithMissingExtendedTweetKey()
    {
        $tweet = $this->tweet->build($this->rawTweetLongMissingExtendedTweetKey);

        $this->assertEquals($this->rawTweetLongMissingExtendedTweetKey['id'], $tweet->id);
        $this->assertEquals($this->rawTweetLongMissingExtendedTweetKey['text'], $tweet->text);
    }

    public function testFormingOfTweetPrefix()
    {
        $tweet = $this->tweet->build($this->rawTweetShort);

        $this->assertEquals('tweets:' . $this->rawTweetShort['id'], $tweet->getTweetKey());

    }

    public function testSave()
    {
        $this->redisManagerMock = Mockery::mock('Illuminate\Redis\RedisManager');
        $this->app->instance('redis', $this->redisManagerMock);

        $tweet = $this->app->make('App\Tweet')->build($this->rawTweetShort);

        $this->redisManagerMock->shouldReceive('set')
            ->once()
            ->with('tweets:' . $this->rawTweetShort['id'], $this->rawTweetShort['text']);

        $tweet->save();
    }
}
