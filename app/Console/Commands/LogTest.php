<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


class LogTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prueba de Task Scheduling';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $words = [
            'aberration' => 'a state or condition markedly different from the norm',
            'convivial' => 'occupied with or fond of the pleasures of good company',
            'diaphanous' => 'so thin as to transmit light',
            'elegy' => 'a mournful poem; a lament for the dead',
            'ostensible' => 'appearing as such but not necessarily so'
        ];

        // Finding a random word
        $key = array_rand($words);
        $value = $words[$key];

        $users = User::all();
        foreach ($users as $user) {
            Log::info($user->email);
            /*  Mail::raw("{$key} -> {$value}", function ($mail) use ($user) {
                $mail->from('guslopezcallejas@gmail.com');
                $mail->to('guslopezcallejas@gmail.com')
                    ->subject('Word of the Day');
            });*/
        }

        $this->info('Word of the Day sent to All Users');
        Log::info('Mi Comando Funciona!');
    }
}
