<?php

namespace App\Http\Controllers;

use App\Mail\AppointmentSubmitted;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AppointmentController extends Controller
{

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'nullable|email',
            'notes' => 'nullable',
            'preferred' => 'nullable|date',
            'therapy_slug' => 'nullable',
            'clinic_id' => 'nullable|exists:clinics,id',
        ]);

        if (!empty($data['therapy_slug']) && class_exists(\App\Models\Therapy::class)) {
            $therapy = \App\Models\Therapy::where('slug', $data['therapy_slug'])->first();
            if ($therapy) {
                $data['therapy_id'] = $therapy->id;
            }
        }
        $data['booked_at'] = now();
        $appointment = Appointment::create($data);
        // send confirmation email if email provided
        if (!empty($data['email'])) {
            Mail::to($data['email'])->send(new AppointmentSubmitted($appointment));
        }

        // ✅ Notify admin (will configure below)
        \Filament\Notifications\Notification::make()
            ->title('New Appointment Request')
            ->body("From: {$appointment->name}")
            ->sendToDatabase(\App\Models\User::first());

        Session::flash('success', '✅ Your request is received! You will get a confirmation email soon.');
        return redirect()->back();

    }
}
