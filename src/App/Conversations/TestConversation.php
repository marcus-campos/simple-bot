<?php
/**
 * User: marcus-campos
 * Date: 01/11/17
 * Time: 13:47
 */

namespace SimpleBot\App\Conversations;


use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;

class TestConversation extends Conversation
{
    protected $firstname;

    protected $email;

    public function askFirstname()
    {
        $this->ask('Olá! Qual é seu primeiro nome?', function(Answer $answer) {
            // Save result
            $this->firstname = $answer->getText();

            $this->say('Prazer em conhece-lo(a) '.$this->firstname);
            $this->askEmail();
        });
    }

    public function askEmail()
    {
        $this->ask('Mais uma coisa - qual é seu email?', function(Answer $answer) {
            // Save result
            $this->email = $answer->getText();

            $this->say('Perfeito! - isso é tudo que precisamos, '.$this->firstname . ' - '.$this->email);
        });
    }

    public function run()
    {
        // This will be called immediately
        $this->askFirstname();
    }
}