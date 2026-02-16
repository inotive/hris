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
            Kami menerima permintaan untuk mereset kata sandi akun Anda. Klik tombol di bawah ini untuk melanjutkan
            proses reset kata sandi:
        </p>

        <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="margin: 30px 0;">
            <tbody>
                <tr>
                    <td align="center">
                        <a href="{{ $url }}"
                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 16px 40px; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 16px; display: inline-block; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                            Reset Kata Sandi
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>

        <p style="color: #4a5568; line-height: 1.6; font-size: 14px;">
            Link reset password ini akan kedaluwarsa dalam 60 menit.
        </p>

        <div
            style="background-color: #fff5f5; border-left: 4px solid #f56565; padding: 16px; margin: 20px 0; border-radius: 4px;">
            <p style="color: #742a2a; margin: 0; font-size: 14px; line-height: 1.6;">
                <strong>⚠️ Perhatian Keamanan:</strong><br>
                Jika Anda tidak meminta reset kata sandi, abaikan email ini. Akun Anda tetap aman.
            </p>
        </div>

        <p style="color: #718096; font-size: 13px; line-height: 1.6; margin-top: 20px;">
            Jika Anda mengalami masalah mengklik tombol "Reset Kata Sandi", salin dan tempel URL berikut ke browser
            Anda:<br>
            <a href="{{ $url }}" style="color: #667eea; word-break: break-all;">{{ $url }}</a>
        </p>
    </div>

    <!-- Divider -->
    <hr style="border: none; border-top: 2px solid #e2e8f0; margin: 40px 0;">

    <!-- English Version -->
    <div style="margin-bottom: 20px;">
        <h2 style="color: #1a202c; font-size: 24px; margin-bottom: 16px; font-weight: 600;">Reset Your Password</h2>

        <p style="color: #4a5568; line-height: 1.6;">Hello,</p>

        <p style="color: #4a5568; line-height: 1.6;">
            We received a request to reset your account password. Click the button below to continue the password reset
            process:
        </p>

        <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="margin: 30px 0;">
            <tbody>
                <tr>
                    <td align="center">
                        <a href="{{ $url }}"
                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 16px 40px; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 16px; display: inline-block; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                            Reset Password
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>

        <p style="color: #4a5568; line-height: 1.6; font-size: 14px;">
            This password reset link will expire in 60 minutes.
        </p>

        <div
            style="background-color: #fff5f5; border-left: 4px solid #f56565; padding: 16px; margin: 20px 0; border-radius: 4px;">
            <p style="color: #742a2a; margin: 0; font-size: 14px; line-height: 1.6;">
                <strong>⚠️ Security Notice:</strong><br>
                If you did not request a password reset, please ignore this email. Your account remains secure.
            </p>
        </div>

        <p style="color: #718096; font-size: 13px; line-height: 1.6; margin-top: 20px;">
            If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web
            browser:<br>
            <a href="{{ $url }}" style="color: #667eea; word-break: break-all;">{{ $url }}</a>
        </p>
    </div>

    <!-- Footer -->
    <p style="color: #718096; font-size: 14px; margin-top: 40px; padding-top: 20px; border-top: 1px solid #e2e8f0;">
        Salam hormat / Best regards,<br>
        <strong style="color: #667eea;">Tim PeopleC / PeopleC Team</strong>
    </p>
</x-mail.email-base>