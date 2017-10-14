<?php

namespace SimpleBot\App\Controllers;

use AnyBot\Client\CallSendApi;
use AnyBot\Client\SenderRequest;
use AnyBot\Client\WebHook;
use AnyBot\Facebook\Elements\Button;
use AnyBot\Facebook\Messages\SenderAction;
use AnyBot\Facebook\Messages\Text;
use AnyBot\Facebook\Templates\ButtonsTemplate;
use App\Core\Http\Controllers\Controller;
use App\Helpers\Config\PlatformConfig;

class BotController extends Controller
{
    /**
     * @return bool|mixed
     */
    public function subscribe()
    {
        $webhook = new WebHook;
        $subscribe = $webhook->check((new PlatformConfig())->get()->token->facebook->validationToken);

        if(!$subscribe) {
            abort(403, 'Unauthorized action.');
        }
        return $subscribe;
    }

    public function receiveMessage()
    {
        $sender = new SenderRequest;
        $senderId = $sender->getSenderId();
        $message = $sender->getMessage();

        $this->similarText($senderId, $message);
    }

    /**
     * @param $senderId
     * @param $message
     */
    public function similarText($senderId, $message)
    {
        $percent = 0;
        $keyOption = '';

        foreach ($this->cases($message) as $key => $value)
            if($value > $percent) {
                $percent = $value;
                $keyOption = $key;
            }

        $this->dialogFlux($senderId, $message, $keyOption);
    }

    /**
     * @param $message
     * @return array
     */
    public function cases($message)
    {
        $cases = [
            //Saudações
            'Oi' => 'saudacao',
            'Olá' => 'saudacao',
            'Ola' => 'saudacao',
            //Telefone
            'Telefone' => 'telefone',
            'Qual é o telefone de contato' => 'telefone',
            'Qual é o número de contato' => 'telefone',
            'Qual é o telefone da UniBH' => 'telefone',
            'Qual é o telefone da faculdade' => 'telefone',
            'Qual é o telefone' => 'telefone',
            //Horário de funcionamento
            'Qual é o horario de funcionamento?' => 'horario_funcionamento',
            'Horario de funcionamento' => 'horario_funcionamento',
            'Que horas funciona' => 'horario_funcionamento',
            //Endereco
            'Onde esta localizado' => 'endereco',
            'Qual é o endereço' => 'endereco',
            'Onde fica' => 'endereco',
            'Onde se encontra' => 'endereco',
            'Qual é a localização' => 'endereco',
            'Como chegar' => 'endereco',
            //Historia
            'Me conte sobre a Uni' => 'historia',
            'Me conte sobre a UniBH' => 'historia',
            'Historia da Uni' => 'historia',
            'Historia da UniBH' => 'historia',
            'Sobre a Uni' => 'historia',
            'Sobre a UniBH' => 'historia',
            //Objetivo
            'Qual e seu objetivo' => 'objetivo_anny',
            'Qual e o intuito' => 'objetivo_anny',
            'Seu objetivo' => 'objetivo_anny',
            'Qual e sua utilidade' => 'objetivo_anny',
            'Sua utilidade' => 'objetivo_anny',
        ];

        $asserts = [];

        foreach ($cases as $key => $value)
        {
            $percent = null;
            similar_text($key, $message, $percent);
            if($percent >= 50.0)
                $asserts[$value] = $percent;
        }

        return $asserts;
    }

    /**
     * @param $senderId
     * @param $message
     */
    public function dialogFlux($senderId, $message, $option)
    {
        $callSendApi = new CallSendApi((new PlatformConfig())->get()->token->facebook->pageAccessToken);
        $callSendApi = $callSendApi->facebook();

        $senderAction = new SenderAction($senderId);
        $callSendApi->make($senderAction->message('typing_on'));

        $text = new Text($senderId);
        $enderecoBtn = new ButtonsTemplate($senderId);
        $enderecoBtn->add(new Button('web_url', 'Como chegar', 'https://www.google.com.br/maps/dir/\'\'/UniBH+Estoril+-+Av.+Professor+M%C3%A1rio+Werneck,+1480+-+Loja+100+-+Buritis,+Belo+Horizonte+-+MG,+30455-610/@-19.9705936,-44.0348857,12z/data=!3m1!4b1!4m8!4m7!1m0!1m5!1m1!1s0xa697dc1c828611:0x145abc45a3780acb!2m2!1d-43.9648453!2d-19.9706073'));

        $defaultBtn = new ButtonsTemplate($senderId);
        $defaultBtn->add(new Button('web_url', 'Site UniBH', 'http://www.unibh.br'));

        switch ($option){
            case 'saudacao';
                $callSendApi->make($text->message('Oi, eu sou a AnnyBot. No que eu posso te ajudar?'));
                break;
            case 'horario_funcionamento':
                $callSendApi->make($text->message('De segunda a sexta de 07h30 às 22:30'));
                break;
            case 'endereco':
                $callSendApi->make($enderecoBtn->message('Av. Professor Mário Werneck, 1480 - Loja 100 - Buritis, Belo Horizonte - MG, 30455-610'));
                break;
            case 'telefone':
                $callSendApi->make($text->message('(31) 3378-0043'));
                break;
            case 'objetivo_anny':
                $callSendApi->make($text->message('Fui criada com o intuito de otimizar, agilizar e facilitar o acesso dos discentes à informações, para que assim seja reduzida a lotação e  período de espera nos centros de atendimento ao aluno. '));
                break;
            case 'historia':
                $callSendApi->make($text->message('Formar profissionais competentes e conscientes de sua cidadania: é o que o UniBH busca a cada dia de sua trajetória, que já conta com cinco décadas de trabalho.'));
                $callSendApi->make($text->message('Fundado em 1964, o Centro Universitário de Belo Horizonte oferece mais de 50 cursos de Graduação, nas modalidades bacharelado, licenciatura e graduação tecnológica;'));
                $callSendApi->make($defaultBtn->message('Para saber mais de nossa história, acesse nosso site'));
                break;
            default:
                $callSendApi->make($defaultBtn->message('Desculpe-me, não possuo informações suficientes para responder sua pergunta. Para maiores informações acesse nosso site.'));
                break;
        }
    }
}
