<?php

namespace SimpleBot\App\Controllers;

use BotMan\BotMan\BotMan;
use SimpleBot\App\Conversations\TestConversation;

class BotController
{
    public function handle(\Request $request)
    {
        $botman = app('botman');

        /*  // give the bot something to listen for.
        $botman->hears('Oi', function (BotMan $bot) {
            $bot->startConversation(new TestConversation());
        });*/

        // give the bot something to listen for.
        $botman->hears('Ol�', function (BotMan $bot) {
            $bot->reply('Ol�.');
        });

        // start listening
        $botman->listen();
    }
}
