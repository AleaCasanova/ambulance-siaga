<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran {{ $accountType }} Baru - Ambulans Siaga</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f1f5f9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; -webkit-font-smoothing: antialiased;">
    <table role="presentation" width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #f1f5f9; padding: 30px 15px;">
        <tr>
            <td align="center">
                <!-- Card Container -->
                <table role="presentation" width="100%" border="0" cellspacing="0" cellpadding="0" style="max-width: 540px; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 25px rgba(15, 39, 71, 0.08); border: 1px solid #e2e8f0;">
                    
                    <!-- Header Bar -->
                    <tr>
                        <td style="background-color: #0F2747; padding: 25px 30px; text-align: center;">
                            <div style="display: inline-block; background-color: #009CA6; color: #ffffff; font-weight: 900; font-size: 16px; padding: 8px 18px; border-radius: 8px; letter-spacing: 1px; text-transform: uppercase;">
                                🚑 AMBULANS SIAGA ADMIN
                            </div>
                            <div style="margin-top: 10px; color: #94a3b8; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">
                                Pemberitahuan Registrasi Akun Baru
                            </div>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 35px 30px; color: #334155;">
                            <div style="display: inline-block; background-color: #fef3c7; color: #92400e; padding: 4px 12px; border-radius: 9999px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 12px;">
                                ⚠️ Menunggu Verifikasi Admin
                            </div>

                            <h2 style="margin: 0 0 12px 0; color: #0F2747; font-size: 18px; font-weight: 800;">
                                Pendaftaran {{ $accountType }} Baru
                            </h2>
                            
                            <p style="margin: 0 0 20px 0; font-size: 13px; line-height: 1.6; color: #475569;">
                                Ada pengguna baru yang baru saja mendaftar sebagai <strong>{{ $accountType }}</strong> di sistem Ambulans Siaga dan memerlukan persetujuan/verifikasi dari Administrator agar dapat login dan bertugas.
                            </p>

                            <!-- Detail Card -->
                            <table role="presentation" width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; margin-bottom: 25px;">
                                <tr>
                                    <td style="padding: 16px 20px;">
                                        <table role="presentation" width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td style="padding: 6px 0; font-size: 12px; color: #64748b; font-weight: 600; width: 40%;">Nama Lengkap:</td>
                                                <td style="padding: 6px 0; font-size: 13px; color: #0f172a; font-weight: 700;">{{ $user->name }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 6px 0; font-size: 12px; color: #64748b; font-weight: 600;">Email:</td>
                                                <td style="padding: 6px 0; font-size: 13px; color: #0f172a; font-weight: 600;">{{ $user->email }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 6px 0; font-size: 12px; color: #64748b; font-weight: 600;">Telepon / WA:</td>
                                                <td style="padding: 6px 0; font-size: 13px; color: #0f172a; font-weight: 600;">{{ $user->phone ?: '-' }}</td>
                                            </tr>
                                            @foreach($extraInfo as $label => $value)
                                                <tr>
                                                    <td style="padding: 6px 0; font-size: 12px; color: #64748b; font-weight: 600;">{{ $label }}:</td>
                                                    <td style="padding: 6px 0; font-size: 13px; color: #0f172a; font-weight: 600;">{{ $value }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td style="padding: 6px 0; font-size: 12px; color: #64748b; font-weight: 600;">Waktu Daftar:</td>
                                                <td style="padding: 6px 0; font-size: 12px; color: #64748b;">{{ now()->translatedFormat('d F Y - H:i') }} WIB</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <!-- CTA Button -->
                            <div style="text-align: center; margin: 25px 0;">
                                <a href="{{ $verificationUrl }}" style="display: inline-block; background-color: #009CA6; color: #ffffff; text-decoration: none; padding: 12px 28px; border-radius: 10px; font-weight: 700; font-size: 14px; box-shadow: 0 4px 12px rgba(0, 156, 166, 0.25);">
                                    Buka Panel Verifikasi Pengguna &rarr;
                                </a>
                            </div>

                            <p style="margin: 0; font-size: 12px; color: #94a3b8; line-height: 1.5; text-align: center;">
                                Silakan login ke panel admin untuk meninjau identitas pendaftar dan mengaktifkan status akun.
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8fafc; padding: 18px 30px; border-top: 1px solid #e2e8f0; text-align: center;">
                            <p style="margin: 0; font-size: 11px; color: #94a3b8;">
                                Sistem Otomasi Ambulans Siaga &copy; {{ date('Y') }}. All Rights Reserved.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
