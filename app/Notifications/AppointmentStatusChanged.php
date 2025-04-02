<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class AppointmentStatusChanged extends Notification
{
    protected $appointment;
    protected $status;

    public function __construct($appointment, $status)
    {
        $this->appointment = $appointment;
        $this->status = $status;
    }

    public function toArray($notifiable)
    {
        return [
            'appointment_id' => $this->appointment->id,
            'status' => $this->status,
            'message' => "Your appointment has been {$this->status}"
        ];
    }
}