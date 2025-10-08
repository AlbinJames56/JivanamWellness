<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AppointmentController extends Controller
{
    public function store(Request $request)
    {
        // Basic validation
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'email' => 'nullable|email|max:255',
            'notes' => 'nullable|string|max:2000',
        ]);

        // If you have an Appointment model & table, save to DB
        if (class_exists(\App\Models\Appointment::class)) {
            try {
                \App\Models\Appointment::create(
                    $data + [
                        'status' => 'new', // optional
                    ]
                );
                Session::flash(
                    'success',
                    'Thanks — your appointment request has been received. We will contact you shortly.'
                );
            } catch (\Exception $e) {
                Log::error('Appointment save failed: ' . $e->getMessage());
                Session::flash(
                    'error',
                    'Unable to save appointment right now. We have logged the issue.'
                );
            }

            return redirect()->back();
        }

        // Otherwise fallback: save to session (temporary) and log
        $appointments = Session::get('appointments', []);
        $appointments[] = array_merge($data, [
            'created_at' => now()->toDateTimeString(),
        ]);
        Session::put('appointments', $appointments);

        // Also log the appointment for the developer/admin
        Log::info('New appointment (session fallback):', $data);

        Session::flash(
            'success',
            'Thanks — your appointment request has been recorded (temp).'
        );

        return redirect()->back();
    }
}
