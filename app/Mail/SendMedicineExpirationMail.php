<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMedicineExpirationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $medicineName;
    public $expirationDate;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($medicineName, $expirationDate)
    {
        $this->medicineName = $medicineName;
        $this->expirationDate = $expirationDate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Medicine Expiration Notification')
                    ->view('emails.medicineNotification')
                    ->with([
                        'medicineName' => $this->medicineName,
                        'expirationDate' => $this->expirationDate,
                    ]);
    }
}
