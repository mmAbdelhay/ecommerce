<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class MailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $mail;
    private $data;
    private $user_email;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mail, $data, $user_email)
    {
        $this->mail = 'App\Mail\\' . $mail;
        $this->data = $data;
        $this->user_email = $user_email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->user_email)->send(new $this->mail($this->data));
    }
}
