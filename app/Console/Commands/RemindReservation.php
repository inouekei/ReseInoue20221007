<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailMain;
use App\Models\Reservation;
use Carbon\Carbon;

class RemindReservation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:reservation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remind reservations on the day';

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
     * @return int
     */
    public function handle()
    {
        $reservations = Reservation::whereDate('reservation_datetime', Carbon::Today()->format('Y-m-d'))->get();
        foreach($reservations as $reservation){
            $user = $reservation->customer->user;
            $data = [
                'from' => 'Rese自動送信',
                'subject' => '【'. $reservation->restaurant->name . '　' . Carbon::Parse($reservation->reservation_datetime)->format('H:i') . 'より】本日のご来店お待ちしております。',
                'message' => '本日のご来店お待ちしております。',
            ];
            Mail::to($user->email, $user->name . '様')
                    ->send(new MailMain($data));    
        }
        return 0;
    }
}
