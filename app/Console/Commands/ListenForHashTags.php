<?php

namespace App\Console\Commands;

use App\Tweet;
use Illuminate\Console\Command;
use TwitterStreamingApi;

class ListenForHashTags extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'analista:listen-for-hash-tags {hashtags* : List all the hashtags separated by spaces}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Listen for hashtags being used on Twitter';

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
        TwitterStreamingApi::publicStream()
            ->whenHears($this->argument('hashtags'), function (array $rawTweet) {
                $tweet = app()->make('App\Tweet')->makeFromRaw($rawTweet);
                $tweet->save();
                $tweet->queueForProcessing();
            })
            ->startListening();
    }
}
