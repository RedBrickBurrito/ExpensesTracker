<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class AttachmentMail extends Mailable
{
    use Queueable, SerializesModels;
    public $fileToSend = null;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($file)
    {
        $this->fileToSend = $file;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $today = date('m-Y');
        return $this->markdown('emails.expenses')
            ->subject("{$today} Expenses")
            ->attach($this->fileToSend, [
                'as' => "{$today}_expenses.pdf",
                'mime' => 'application/pdf'
            ]);
    }
}
