<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Crypt;

class EmailVerify extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // $en = Crypt::encryptString($this->data['data']['email']);
        // $dy = Crypt::decryptString($en);
        // dd($dy);
        return $this->subject('Email Verify')->view('emails.email-verify', [
            'email' =>  Crypt::encryptString($this->data['data']['email']),
            'id' => $this->data['data']['id'],
        ]);
    }
}
