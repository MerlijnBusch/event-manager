<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyUserOfEventsMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $event;

    /**
     * Create a new message instance.
     *
     * @param $event
     */
    public function __construct($event)
    {
        $this->event = $event;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('mail@example.com', 'Mailtrap')
            ->subject('Mailtrap Confirmation')
            ->view('mails.NotifyUserOfEvents')
            ->with([
                'name' => $this->event->name,
                'date' => $this->event->settings->start_date,
            ]);
    }
}
