<?php

namespace SimpleBot\App\Controllers;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;

class BotController
{
    public function handle()
    {
        DriverManager::loadDriver(\BotMan\Drivers\Facebook\FacebookDriver::class);

        $config = [
            'facebook' => [
                'token' => 'EAAkDsm7f2PUBACU7udZBd1MVIhZAVjYj6XJZBdeZAvXCDnUNjiDk6iJ43pedNYZAcCUy75qcOOxarXdFTbKylCwp1KjQi4LOkXNF2w8ZBvXBEON3eUW2GMl9M8UNqt4Qb7MxdFTTjru0ynpPJ5I49WlFkElXaMzvII1TZBz0T1jiwZDZD',
                'app_secret' => 'd374631fa82a58cd7219ebb722c6dc01',
                'verification'=>'gy840pghr0euggju3woifhudsfp'
            ]
        ];

        // create an instance
        $botman = BotManFactory::create($config);

        // give the bot something to listen for.
        $botman->hears('Oi', function (BotMan $bot) {
            $bot->reply('Hello yourself.');
        });

        // give the bot something to listen for.
        $botman->hears('Cole', function (BotMan $bot) {
            $bot->reply('Hello yourself cole.');
        });

        // start listening
        $botman->listen();
    }
}
