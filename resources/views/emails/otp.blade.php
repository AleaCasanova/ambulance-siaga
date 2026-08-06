<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode OTP Verifikasi Akun - Ambulance Siaga</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f1f5f9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; -webkit-font-smoothing: antialiased;">
    <table role="presentation" width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #f1f5f9; padding: 30px 15px;">
        <tr>
            <td align="center">
                <!-- Card Container -->
                <table role="presentation" width="100%" border="0" cellspacing="0" cellpadding="0" style="max-width: 520px; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 25px rgba(15, 39, 71, 0.08); border: 1px solid #e2e8f0;">
                    
                    <!-- Header Bar (Brand Theme) -->
                    <tr>
                        <td style="background-color: #0F2747; padding: 25px 30px; text-align: center;">
                            <table role="presentation" width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="center">
                                        <!-- Ambulance Siaga Logo Badge -->
                                        <div style="display: inline-block; background-color: #009CA6; color: #ffffff; font-weight: 900; font-size: 18px; padding: 10px 20px; border-radius: 10px; letter-spacing: 1px; text-transform: uppercase;">
                                            🚑 AMBULANCE SIAGA
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="padding-top: 10px;">
                                        <span style="color: #94a3b8; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">
                                            Verifikasi Keamanan Akun
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 35px 30px; color: #334155;">
                            <h2 style="margin: 0 0 12px 0; color: #0F2747; font-size: 20px; font-weight: 800;">
                                Halo, {{ $name }}! 👋
                            </h2>
                            <p style="margin: 0 0 20px 0; font-size: 14px; line-height: 1.6; color: #475569;">
                                Terima kasih telah mendaftar di <strong>Ambulance Siaga</strong>. Untuk menyelesaikan pendaftaran dan mengaktifkan akun Anda, silakan gunakan kode OTP (One-Time Password) di bawah ini:
                            </p>

                            <!-- OTP Box -->
                            <table role="presentation" width="100%" border="0" cellspacing="0" cellpadding="0" style="margin: 25px 0;">
                                <tr>
                                    <td align="center" style="background-color: #f0fdfa; border: 2px dashed #009CA6; border-radius: 12px; padding: 20px;">
                                        <span style="font-size: 12px; text-transform: uppercase; font-weight: 700; color: #009CA6; letter-spacing: 1.5px; display: block; margin-bottom: 8px;">
                                            Kode Verifikasi Anda
                                        </span>
                                        <div style="font-family: 'Courier New', Courier, monospace; font-size: 36px; font-weight: 900; color: #0F2747; letter-spacing: 10px; margin-left: 10px;">
                                            {{ $otpCode }}
                                        </div>
                                        <span style="font-size: 12px; color: #64748b; margin-top: 10px; display: block; font-weight: 600;">
                                            ⏱️ Berlaku selama <strong>{{ $expiryMinutes }} menit</strong>
                                        </span>
                                    </td>
                                </tr>
                            </table>

                            <!-- Security Warning -->
                            <div style="background-color: #fffbe6; border-left: 4px solid #f59e0b; padding: 12px 16px; border-radius: 6px; margin-bottom: 25px;">
                                <p style="margin: 0; font-size: 12px; color: #92400e; line-height: 1.5; font-weight: 600;">
                                    <strong>⚠️ Peringatan Keamanan:</strong> Jangan berikan kode OTP ini kepada siapa pun, termasuk pihak yang mengatasnamakan Ambulance Siaga.
                                </p>
                            </div>

                            <p style="margin: 0; font-size: 13px; color: #64748b; line-height: 1.5;">
                                Jika Anda tidak merasa melakukan pendaftaran ini, silakan abaikan email ini secara aman.
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8fafc; padding: 20px 30px; border-top: 1px solid #e2e8f0; text-align: center;">
                            <p style="margin: 0 0 6px 0; font-size: 12px; font-weight: 700; color: #0F2747;">
                                Ambulance Siaga — Layanan Gawat Darurat & Medis
                            </p>
                            <p style="margin: 0; font-size: 11px; color: #94a3b8;">
                                Dikembangkan oleh Yayasan Gerak Sedekah Cilacap (GSC). &copy; {{ date('Y') }} All Rights Reserved.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
