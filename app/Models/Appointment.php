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
        'clinic_id',
        'therapy_slug',
        'status',
        'confirmed_date',
          'booked_at', 
    ];
    protected $casts = [
        'preferred' => 'date',
        'booked_at' => 'datetime',
        'confirmed_date' => 'datetime',
    ];

    public function therapy()
    {
        return $this->belongsTo(Therapy::class);
    }
    public function clinic()
    {
        return $this->belongsTo(\App\Models\Clinics::class);
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
