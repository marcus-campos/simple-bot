<?php

namespace SimpleBot\App\Controllers;

use BotMan\BotMan\BotMan;
use SimpleBot\App\Conversations\TestConversation;

class BotController
{
    public function handle(\Request $request)
    {
        $botman = app('botman');
        // give the bot something to listen for.
        $botman->hears('Oi', function (BotMan $bot) {
            $bot->startConversation(new TestConversation());
        });

        // give the bot something to listen for.
        $botman->hears('Cole', function (BotMan $bot) {
            $bot->reply('Cole.');
        });

        // start listening
        $botman->listen();
    }
}
