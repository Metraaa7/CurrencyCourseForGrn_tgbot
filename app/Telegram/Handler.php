<?php

namespace App\Telegram;

use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use Illuminate\Support\Stringable;

const COURSE = 'https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid';
class Handler extends WebhookHandler
{
    public string $json = '';
    public array $arr = [];


    public function getArrCurrencies():void {
        $this->json = file_get_contents(COURSE);
        $this->arr = json_decode($this->json, true);
    }

    public function start():void {
        $this->reply("Hi, glad to see you! Lets some working");
    }

    public function buy() {
        $this->getArrCurrencies();
        $this->reply("Course for buying currencies:");
        for($i = 0; $i < count($this->arr); $i++) {
            $this->reply( $this->arr[$i]['ccy'] . ': ' . $this->arr[$i]['buy']);
        }
    }

    public function sale() {
        $this->getArrCurrencies();
        $this->reply("Course for saleing currencies:");
        for($i = 0; $i < count($this->arr); $i++) {
            $this->reply($this->arr[$i]['ccy'] . ': ' . $this->arr[$i]['sale']);
        }
    }

    public function about() {
        Telegraph::message("Choose the action: ")
        ->keyboard(
            Keyboard::make()->buttons([
                Button::make("My Github:")->url("https://github.com/Metraaa7"),
            ])
        )->send();
    }

    protected function handleChatMessage(Stringable $text): void {
        $this->reply($text);
    }
}