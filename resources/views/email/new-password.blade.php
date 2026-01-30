<x-mail.email-base>
    <p>Hello,</p>

    <p>Here is your password:</p>

    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
        <tbody>
            <tr>
                <td align="center">
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td style="background-color: #3490dc; padding: 10px 20px; border-radius: 5px;">
                                    <span style="color: white; font-size: 18px; font-weight: bold;">
                                        {{ $password }}
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <p>Please keep this password secure. We recommend changing it after login.</p>

    <p>Thanks,<br>{{ config('app.name') }}</p>
</x-mail.email-base>
