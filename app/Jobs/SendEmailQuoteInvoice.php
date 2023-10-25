<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Quote;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Notifications\QuoteInvoiceNotification;

class SendEmailQuoteInvoice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user, $quote;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $quote)
    {
        $this->user=$user;
        $this->quote=$quote;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user=User::where('slug', $this->user)->first();
        $quote=Quote::where('id', $this->quote)->first();
        $user->email='sistema.envio23@gmail.com';
        $user->quote=$quote->id;
        $user->notify(new QuoteInvoiceNotification());
    }
}
