<?php

use DefStudio\Telegraph\Models\TelegraphBot;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('register', function () {
    /** @var TelegraphBot $bot */
    $bot = DefStudio\Telegraph\Models\TelegraphBot::find(1);

    dd($bot->registerCommands([
            'start' => 'Start the program',
            'buy' => 'Output the available courses of currencies for buying',
            'sale' => 'Output the available courses of currencies for saleing',
            'about' => 'About author of this bot',
    ])->send());
});
