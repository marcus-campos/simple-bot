<?php
/**
 * User: marcus-campos
 * Date: 23/10/17
 * Time: 10:35
 */

use SimpleBot\App\Controllers\BotController;
// Don't use the Facade in here to support the RTM API too :)
$botman = resolve('botman');
$botman->hears('/iniciar', BotController::class.'@startConversation');
$botman->hears('Oi', BotController::class.'@startConversation');
$botman->hears('/ajuda', function($bot){
    $bot->typesAndWaits(2);
    $bot->reply('Como vai, ' . $bot->getUser()->getFirstName() . ', tudo bem? Eu sou a AnnyBot e estou aqui para te ajudar. Para falar comigo é só digitar /iniciar.');
});
$botman->fallback(function($bot) {
    $bot->typesAndWaits(1);
    $bot->reply('Digite /iniciar para começar ou /ajuda para saber mais sobre o bot.');
});