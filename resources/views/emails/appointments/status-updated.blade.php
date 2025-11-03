<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Appointment Status Updated</title>
</head>

<body style="margin:0; padding:0; font-family: Arial, sans-serif; background:#f4f9f4;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f9f4; padding: 30px 0;">
        <tr>
            <td align="center">
                <table width="600" style="background:white; border-radius:10px; overflow:hidden;">

                    <!-- HEADER -->
                    <tr>
                        <td style="background:#1b5e20; padding:20px; text-align:center;">
                            <img src="{{ asset('images/logo.png') }}" alt="Jivanam Wellness" style="height:60px;">
                        </td>
                    </tr>

                    <!-- CONTENT -->
                    <tr>
                        <td style="padding:30px 30px 10px;">
                            <h2 style="color:#1b5e20; font-size:22px; margin:0 0 10px;">
                                Hello {{ $appointment->name }},
                            </h2>

                            <p style="font-size:15px; color:#444; margin:0 0 20px; line-height:1.6;">
                                Your appointment status has been updated.
                                Please find the details below:
                            </p>

                            <table width="100%" cellpadding="10" cellspacing="0"
                                style="background:#f9fafb; border-radius:8px; font-size:14px;">
                                <tr>
                                    <td style="font-weight:bold; color:#1b5e20;">Status</td>
                                    <td style="font-weight:bold; color:#333;">
                                        {{ ucfirst($appointment->status) }}
                                    </td>
                                </tr>

                                <tr>
                                    <td style="font-weight:bold; color:#1b5e20;">Preferred Date</td>
                                    <td>{{ $appointment->preferred ?? '—' }}</td>
                                </tr>

                                @if($appointment->confirmed_date)
                                    <tr>
                                        <td style="font-weight:bold; color:#1b5e20;">Confirmed Date</td>
                                        <td>{{ $appointment->confirmed_date }}</td>
                                    </tr>
                                @endif

                                <tr>
                                    <td style="font-weight:bold; color:#1b5e20;">Therapy</td>
                                    <td>{{ $appointment->therapy?->title ?? ($appointment->therapy_slug ?? '—') }}</td>
                                </tr>
                            </table>

                            <p style="font-size:14px; color:#555; margin-top:20px;">
                                If you have questions or need changes, feel free to contact us.
                            </p>
                        </td>
                    </tr>

                    <!-- FOOTER -->
                    <tr>
                        <td style="text-align:center; padding:25px; background:#1b5e20; color:white; font-size:13px;">
                            Jivanam Wellness<br>
                            <span style="opacity:0.8;">Holistic Healing & Ayurveda</span><br><br>

                            <a href="https://jivanamwellness.in"
                                style="color:#ffe082; text-decoration:none; font-weight:bold;">
                                Visit Website
                            </a>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>

</html>