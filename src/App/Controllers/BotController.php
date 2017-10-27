<?php

namespace SimpleBot\App\Controllers;

use App\Core\Http\Controllers\Controller;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use Illuminate\Http\Request;

class BotController extends Controller
{
    public function handle()
    {
        DriverManager::loadDriver(\BotMan\Drivers\BotFramework\BotFrameworkDriver::class);

        $config = [
            'facebook' => [
                'token' => 'EAAkDsm7f2PUBAJBK5CYdUWvu7FLrauOZCzZCpsIVN4e4hesG0agr4CVZBwWhFfqLXVTH2Ht7bqmIbZCZAc3uSYTeGISjV04mardwt2ktyS7kOMouhRIIoJ2yemZCUUM1hHmqyPc9QacSHrYLKwhsgKg6DbBJRKhODbKOL4S6aLQAZDZD',
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
