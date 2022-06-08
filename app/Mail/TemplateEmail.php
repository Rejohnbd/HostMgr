<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TemplateEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData)
    {
        // dd(env('MAIL_FROM_ADDRESS', 'leosoftapplication@mail.com'), $mailData);
        $this->data = $mailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS', 'leosoftapplication@mail.com'), 'CoderRiver Applications')
            ->subject($this->data['email_subject'] . ' ' . $this->data['domain_name'])
            ->to($this->data['customer_email'])
            ->view('mail.email-template', $this->data);
    }
}
