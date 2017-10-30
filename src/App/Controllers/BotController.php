<?php

namespace SimpleBot\App\Controllers;

use App\Core\Http\Controllers\Controller;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use Illuminate\Http\Request;

class BotController extends Controller
{
    public function handle(Request $request)
    {
        DriverManager::loadDriver(\BotMan\Drivers\Facebook\FacebookDriver::class);

        $config = [
            'facebook' => [
                'token' => 'EAAkDsm7f2PUBACU7udZBd1MVIhZAVjYj6XJZBdeZAvXCDnUNjiDk6iJ43pedNYZAcCUy75qcOOxarXdFTbKylCwp1KjQi4LOkXNF2w8ZBvXBEON3eUW2GMl9M8UNqt4Qb7MxdFTTjru0ynpPJ5I49WlFkElXaMzvII1TZBz0T1jiwZDZD',
                'verification'=>'gy840pghr0euggju3woifhudsfp',
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
