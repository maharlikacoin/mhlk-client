<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUs extends Mailable
{
    use Queueable, SerializesModels;
    protected $request;

    /**
     * Create a new message instance.
     *
     * @param $request
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $request = $this->request;
        return $this
            ->from(env('MAIL_FROM_ADDRESS'), $request->name)
            ->to(env('MAIL_TO_ADDRESS'), env('MAIL_FROM_NAME'))
            ->subject("Message from $request->name")
            ->markdown('emails.contactUs')
            ->with([
                'name' => $request->name,
                'message' => $request->message,
                'email' => $request->email,
            ]);
    }
}
