<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'notes',
        'preferred',
        'therapy_id',
        'therapy_slug',
        'status',
        'confirmed_date'
    ];

    public function therapy()
    {
        return $this->belongsTo(Therapy::class);
    }
    protected static function booted()
    {
        static::updated(function ($appointment) {

            if ($appointment->wasChanged('status')) {
                \Mail::to($appointment->email)->send(
                    new \App\Mail\AppointmentStatusUpdated($appointment)
                );
            }
        });
        static::created(function ($booking) {
            \Mail::to('jeevanamwellnessdigital@gmail.com')->send(new \App\Mail\NewBookingNotification($booking));
        });
    }

}
