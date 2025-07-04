<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invoice;
    public $pdfContent;

    // Terima data invoice dan isi PDF dalam bentuk binary
    public function __construct($invoice, $pdfContent)
    {
        $this->invoice = $invoice;
        $this->pdfContent = $pdfContent;
    }

    public function build()
    {
        return $this->subject('Invoice Anda dari Servis Kendaraan')
                    ->view('emails.invoice') // ini view email (kamu buat di resources/views/emails/invoice.blade.php)
                    ->attachData($this->pdfContent, 'invoice.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
