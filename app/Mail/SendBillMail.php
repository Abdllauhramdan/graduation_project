<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendBillMail extends Mailable
{
    use Queueable, SerializesModels;

    public $id;
    public $date;
    public $employee;
    public $customer;
    public $medicines;
    public $quantity_sold;
    public $total_price;
    public $created_at;
    public $updated_at;
    public $support_number;

    /**
     * Create a new message instance.
     */
    public function __construct($id, $date, $employee, $customer, $medicines, $quantity_sold, $total_price, $created_at, $updated_at, $support_number)
    {
        $this->id = $id;
        $this->date = $date;
        $this->employee = $employee;
        $this->customer = $customer;
        $this->medicines = $medicines;
        $this->quantity_sold = $quantity_sold;
        $this->total_price = $total_price;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->support_number = $support_number;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Invoice Details',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.bill',
        );
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

// <!DOCTYPE html>
// <html>
// <head>
//     <title>Your Invoice Details</title>
// </head>
// <body>
//     <h1>Invoice Details</h1>
//     <p>Dear {{ $customer->name }},</p>
//     <p>Thank you for your purchase. Here are the details of your invoice:</p>
//     <ul>
//         <li><strong>Invoice ID:</strong> {{ $id }}</li>
//         <li><strong>Date:</strong> {{ $date }}</li>
//         <li><strong>Employee:</strong> {{ $employee->name }}</li>
//         <li><strong>Customer:</strong> {{ $customer->name }}</li>
//         <li><strong>Medicines:</strong>
//             <ul>
//                 @foreach ($medicines as $medicine)
//                     <li>{{ $medicine->name }} - Quantity: {{ $medicine->pivot->quantity }}</li>
//                 @endforeach
//             </ul>
//         </li>
//         <li><strong>Quantity Sold:</strong> {{ $quantity_sold }}</li>
//         <li><strong>Total Price:</strong> {{ $total_price }}</li>
//         <li><strong>Created At:</strong> {{ $created_at }}</li>
//         <li><strong>Updated At:</strong> {{ $updated_at }}</li>
//     </ul>
//     <p>If you have any questions, please contact our support team at {{ $support_number }}.</p>
//     <p>Thank you for choosing our service!</p>
// </body>
// </html>
