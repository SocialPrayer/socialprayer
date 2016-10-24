<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\PrayerController;

class SendPrayerReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminders:prayers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send out all prayer reminders';

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
        $users = App\User::all();
        foreach($users as $user){
            $prayersForLater = PrayerController::prayersForLater($user->id);
            $numOfSavedPrayers = count($prayersForLater);
            if ($numOfSavedPrayers) {
                $user->notify(new SavedPrayers($numOfSavedPrayers, $user->id));
            }
        }
    }
}
