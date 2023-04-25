<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GenericEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $msg;
    private $subject1;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($msg,$subject)
    {
        $this->msg = $msg;
        $this->subject1 = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('admin@citnl.navcaru.com')
        ->subject($this->subject1)
            ->view('emails.generic',["msg"=>$this->msg]);
    }
}
