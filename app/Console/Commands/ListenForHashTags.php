<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use TwitterStreamingApi;

class ListenForHashTags extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'analista:listen-for-hash-tags {hashtag} {keywords*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Listen for tweets containing the specified hashtag';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Save the parameters for later use
        Redis::set('hashtag', $this->argument('hashtag'));
        Redis::sadd('keywords', $this->argument('keywords'));


        TwitterStreamingApi::publicStream()
            ->whenHears($this->argument('hashtag'), function (array $rawTweet) {
                $tweet = app()->make('App\Tweet')->build($rawTweet);
                $tweet->save();
                $tweet->queueForProcessing();
            })
            ->startListening();
    }
}
