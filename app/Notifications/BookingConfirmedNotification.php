<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class BookingConfirmedNotification extends Notification
{
    use Queueable;

    protected $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Booking Anda untuk kamar ' . $this->booking->kamar->nomor_kamar . ' telah dikonfirmasi!',
            'booking_id' => $this->booking->id,
            'created_at' => now(),
        ];
    }
}