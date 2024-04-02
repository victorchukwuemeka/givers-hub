<?php
namespace App\Jobs;

use App\Mail\ContactUsMailable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendContactEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $contactMessage;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($contactMessage)
    {
        $this->contactMessage = $contactMessage;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (settings('support_email')&&filter_var(settings('support_email'), FILTER_VALIDATE_EMAIL)) {
        $adminEmail = settings('support_email')??settings('email'); // Make sure you have 
        Mail::to($adminEmail)->send(new ContactUsMailable($this->contactMessage));
        }
    }
}