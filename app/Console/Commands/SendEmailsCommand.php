<?php

namespace App\Console\Commands;

use App\Models\Capsule;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Mail;

class SendEmailsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-emails-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $capsules = Capsule::with(['user:id,email'])
        ->where('reveal_at' ,'=', Carbon::now(timezone: 'Asia/Beirut'))->get();
        foreach($capsules as $capsule ){
            // dd($capsule->user->email);
            $text = "Your Time Capsule Has Been Revealed!\n\n";
            $text .= "Hello {$capsule->user->username},\n\n";
            $text .= "Your capsule '{$capsule->title}' is now available.\n\n";
            $text .= "Thanks,\nDear Me Team";

            Mail::to($capsule->user->email)->send($text);
        }
    }
}
