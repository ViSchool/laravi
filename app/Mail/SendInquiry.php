<?php

namespace App\Mail;

use App\Inquiry;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Lang;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendInquiry extends Mailable
{
    use Queueable, SerializesModels;

    public $inquiry;
    public $url;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($inquiry)
    {
        $this->inquiry = $inquiry;
        $this->url = "mailto:{$inquiry->email}?subject=Deine Anfrage%20an%20ViSchool&bcc=info@vischool.de&body=Hallo%20{$inquiry->lehrername},";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to('info@vischool.de')
                    ->from('info@vischool.de')
                    ->subject('Neue Anfrage von der ViSchool App')
                    ->markdown('emails.send-inquiry');
    }
}
