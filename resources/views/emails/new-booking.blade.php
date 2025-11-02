<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>New Booking Notification</title>
</head>

<body style="font-family: 'Arial', sans-serif; background:#f7f7f7; padding:30px;">

    <div
        style="max-width:600px; margin:0 auto; background:#ffffff; border-radius:10px; overflow:hidden; box-shadow:0 4px 12px rgba(0,0,0,0.1);">

        {{-- Header --}}
        <div style="background:#005e3a; padding:20px; text-align:center;">
            <img src="{{ asset('images/logo.png') }}" alt="Jivanam Wellness"
                style="max-width:180px; margin-bottom:5px;">
            <h2 style="color:#ffffff; margin:0; font-size:20px; letter-spacing:1px;">
                New Appointment Request
            </h2>
        </div>

        {{-- Content --}}
        <div style="padding:25px; color:#333;">
            <p style="font-size:15px;">Hello Admin,</p>
            <p style="font-size:15px;">
                A new consultation booking request has been submitted.
            </p>

            <table cellpadding="6" style="font-size:14px;">
                <tr>
                    <td><strong>Name:</strong></td>
                    <td>{{ $booking->name }}</td>
                </tr>
                <tr>
                    <td><strong>Email:</strong></td>
                    <td>{{ $booking->email }}</td>
                </tr>
                <tr>
                    <td><strong>Phone:</strong></td>
                    <td>{{ $booking->phone }}</td>
                </tr>
                @if(!empty($booking->preferred))
                    <tr>
                        <td><strong>Preferred Date:</strong></td>
                        <td>{{ $booking->preferred }}</td>
                    </tr>
                @endif
                <tr>
                    <td><strong>Therapy:</strong></td>
                    <td>{{ $booking->therapy?->title ?? $booking->therapy_slug }}</td>
                </tr>

                @if(!empty($booking->notes))
                    <tr>
                        <td valign="top"><strong>Notes:</strong></td>
                        <td>{{ $booking->notes }}</td>
                    </tr>
                @endif
            </table>

            <p style="margin-top:20px; font-size:14px;">
                Please login to your admin panel to manage this booking.
            </p>

            {{-- Button --}}
            <div style="text-align:center; margin-top:25px;">
                <a href="{{ env('APP_URL') }}jivanam-admin/appointments"
                    style="background:#008f5b; color:#fff; padding:12px 22px; text-decoration:none; font-size:14px; font-weight:bold; border-radius:6px; display:inline-block;">
                    Go to Admin Panel
                </a>
            </div>
        </div>

        {{-- Footer --}}
        <div style="background:#eef8f3; padding:12px; text-align:center; font-size:12px; color:#666;">
            © {{ date('Y') }} Jivanam Wellness. All rights reserved.
        </div>
    </div>

</body>

</html>