<?php

namespace App\Mail;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewBookingNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    public function __construct(Appointment $booking)
    {
        $this->booking = $booking;
    }

    public function build()
    {
        return $this->subject('New Booking Received')
            ->view('emails.new-booking');
    }
}
