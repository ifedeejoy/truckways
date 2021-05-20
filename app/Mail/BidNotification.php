<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BidNotification extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $amount;
    public $load;
    public $driver;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $name, string $amount, string $load, string $driver)
    {
        $this->name = $name;
        $this->amount = $amount;
        $this->load = $load;
        $this->driver = $driver;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->from("hellp@truckwaysng.com", "Truckways")
        ->markdown('emails.notifications.bids');
    }
}
