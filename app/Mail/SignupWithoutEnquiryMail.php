<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SignupWithoutEnquiryMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
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
        return $this->subject('Enquiry not made')->view('emails.signup-without-enquiry', [
            'first_name' => $this->data['first_name'],
            'last_name' => $this->data['last_name'],
            'email' =>  $this->data['email'],
            // 'phone' => $this->data['phone'],
        ]);
    }
}
