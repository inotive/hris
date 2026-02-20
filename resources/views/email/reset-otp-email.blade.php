<x-mail.email-base>
    <!-- Logo Header -->
    <div style="text-align: center; margin-bottom: 30px;">
        <img src="{{ asset('logo-withtext.png') }}" alt="PeopleC" style="height: 50px; max-width: 200px;">
    </div>

    <!-- Indonesian Version -->
    <div style="margin-bottom: 40px;">
        <h2 style="color: #1a202c; font-size: 24px; margin-bottom: 16px; font-weight: 600;">Reset Kata Sandi Anda</h2>

        <p style="color: #4a5568; line-height: 1.6;">Halo,</p>

        <p style="color: #4a5568; line-height: 1.6;">
            Kami menerima permintaan untuk mereset kata sandi akun Anda. Gunakan kode OTP berikut untuk melanjutkan
            proses reset kata sandi:
        </p>

        <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="margin: 30px 0;">
            <tbody>
                <tr>
                    <td align="center">
                        <div
                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 20px 40px; border-radius: 12px; display: inline-block; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                            <span
                                style="color: white; font-size: 32px; font-weight: bold; letter-spacing: 8px; font-family: 'Courier New', monospace;">
                                {{ $otpData['otp'] }}
                            </span>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <p style="color: #4a5568; line-height: 1.6;">
            Kode OTP ini berlaku untuk satu kali penggunaan dan akan kedaluwarsa dalam waktu singkat.
        </p>

        <div
            style="background-color: #fff5f5; border-left: 4px solid #f56565; padding: 16px; margin: 20px 0; border-radius: 4px;">
            <p style="color: #742a2a; margin: 0; font-size: 14px; line-height: 1.6;">
                <strong>⚠️ Perhatian Keamanan:</strong><br>
                Jika Anda tidak meminta reset kata sandi, abaikan email ini. Jangan bagikan kode OTP ini kepada siapa
                pun.
            </p>
        </div>
    </div>

    <!-- Divider -->
    <hr style="border: none; border-top: 2px solid #e2e8f0; margin: 40px 0;">

    <!-- English Version -->
    <div style="margin-bottom: 20px;">
        <h2 style="color: #1a202c; font-size: 24px; margin-bottom: 16px; font-weight: 600;">Reset Your Password</h2>

        <p style="color: #4a5568; line-height: 1.6;">Hello,</p>

        <p style="color: #4a5568; line-height: 1.6;">
            We received a request to reset your account password. Use the following OTP code to continue the password
            reset process:
        </p>

        <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="margin: 30px 0;">
            <tbody>
                <tr>
                    <td align="center">
                        <div
                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 20px 40px; border-radius: 12px; display: inline-block; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                            <span
                                style="color: white; font-size: 32px; font-weight: bold; letter-spacing: 8px; font-family: 'Courier New', monospace;">
                                {{ $otpData['otp'] }}
                            </span>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <p style="color: #4a5568; line-height: 1.6;">
            This OTP code is valid for one-time use only and will expire shortly.
        </p>

        <div
            style="background-color: #fff5f5; border-left: 4px solid #f56565; padding: 16px; margin: 20px 0; border-radius: 4px;">
            <p style="color: #742a2a; margin: 0; font-size: 14px; line-height: 1.6;">
                <strong>⚠️ Security Notice:</strong><br>
                If you did not request a password reset, please ignore this email. Do not share this OTP code with
                anyone.
            </p>
        </div>
    </div>

    <!-- Footer -->
    <p style="color: #718096; font-size: 14px; margin-top: 40px; padding-top: 20px; border-top: 1px solid #e2e8f0;">
        Salam hormat / Best regards,<br>
        <strong style="color: #667eea;">Tim PeopleC / PeopleC Team</strong>
    </p>
</x-mail.email-base>