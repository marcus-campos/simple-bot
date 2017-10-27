<?php

namespace SimpleBot\App\Controllers;

use App\Core\Http\Controllers\Controller;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use Illuminate\Http\Request;
use Maestro\Rest;

class BotController extends Controller
{
    public function handle($request)
    {
        DriverManager::loadDriver(\BotMan\Drivers\BotFramework\BotFrameworkDriver::class);

        $config = [

        ];

        // create an instance
        $botman = BotManFactory::create($config);

        // give the bot something to listen for.
        $botman->hears('hello', function (BotMan $bot) {
            $bot->reply('Hello yourself.');
        });

        // start listening
        $botman->listen();
    }
}
