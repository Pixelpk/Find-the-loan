<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Invoice extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $data = '';

    public function __construct($para)
    {
        $this->data = $para;
        $this->invoice = $para['invoice'];
        $this->company = $para['company'];
        $this->issued_date = $para['issued_date'];
        $this->due_date = $para['due_date'];
        $this->all_shifts = $para['all_shifts'];
        $this->total_due_amount = $para['total_due_amount'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.invoices.invoice_page', [
            'company' => $this->company,
            'invoice' => $this->invoice,
            'issued_date' => $this->issued_date,
            'due_date' => $this->due_date,
            'all_shifts' => $this->all_shifts,
            'total_due_amount' => $this->total_due_amount,
            ]);
    }
}
