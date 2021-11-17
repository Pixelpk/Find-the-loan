<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Crypt;

class IncompleteSignupReminder extends Mailable
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
        // dd($data['last_name']);
        // dd($data);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Complete Signup Reminder')->view('emails.incomplete-signup', [
            'first_name' => $this->data['first_name'],
            'last_name' => $this->data['last_name'],
            'email' =>  Crypt::encryptString($this->data['email']),
            'id' => Crypt::encryptString($this->data['id']),
            // 'phone' => $this->data['phone'],
        ]);
    }
}
