<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password - {{ config('app.name') }}</title>
    <!--[if mso]>
    <noscript>
        <xml>
            <o:OfficeDocumentSettings>
                <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
    </noscript>
    <![endif]-->
    <style>
        body {
            margin: 0;
            padding: 0;
            width: 100% !important;
            height: 100% !important;
            background-color: #f8fafc;
            font-family: 'Instrument Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        table {
            border-spacing: 0;
            border-collapse: collapse;
        }

        img {
            border: 0;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        .wrapper {
            width: 100%;
            table-layout: fixed;
            background-color: #f8fafc;
            padding-bottom: 40px;
        }

        .main {
            background-color: #ffffff;
            margin: 0 auto;
            width: 100%;
            max-width: 600px;
            border-spacing: 0;
            font-family: sans-serif;
            color: #1e293b;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .header {
            padding: 40px 0 20px;
            text-align: center;
            background-color: #ffffff;
            border-bottom: 1px solid #f1f5f9;
        }

        .logo {
            font-size: 28px;
            font-weight: 800;
            letter-spacing: -0.025em;
            color: #ffffff;
            text-decoration: none;
            text-transform: uppercase;
            max-width: 100px;
            margin: 0 auto;
        }

        .content {
            padding: 40px;
        }

        h1 {
            font-size: 24px;
            font-weight: 700;
            margin-top: 0;
            margin-bottom: 20px;
            color: #0f172a;
            text-align: center;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 24px;
            color: #475569;
        }

        .button-container {
            text-align: center;
            padding: 20px 0;
        }

        .button {
            background-color: #396430;
            /* Primary Brand Green */
            color: #ffffff !important;
            padding: 16px 36px;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 700;
            font-size: 16px;
            display: inline-block;
            transition: background-color 0.2s;
            box-shadow: 0 4px 6px -1px rgba(57, 100, 48, 0.2), 0 2px 4px -1px rgba(57, 100, 48, 0.1);
        }

        .link-text {
            word-break: break-all;
            background-color: #f1f5f9;
            padding: 16px;
            border-radius: 12px;
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            font-size: 13px;
            color: #64748b;
            border: 1px solid #e2e8f0;
        }

        .warning-box {
            background-color: #f0f4ef;
            /* Light Green tint from brand color */
            border-left: 4px solid #396430;
            padding: 20px;
            margin: 32px 0;
            border-radius: 4px 12px 12px 4px;
        }

        .warning-box strong {
            color: #396430;
            display: block;
            margin-bottom: 4px;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.1em;
        }

        .warning-box p {
            margin-bottom: 0;
            font-size: 14px;
            color: #475569;
        }

        .footer {
            padding: 32px 40px;
            text-align: center;
            font-size: 13px;
            color: #64748b;
        }

        .footer a {
            color: #475569;
            text-decoration: underline;
        }

        .divider {
            height: 1px;
            background: linear-gradient(to right, transparent, #e2e8f0, transparent);
            margin: 32px 0;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <center>
            <table class="main" width="100%">
                <tr>
                    <td class="header">
                        <a href="{{ config('app.url') }}">
                            <img src="{{ asset('admin/assets/images/logo2.png') }}" height="60"
                                alt="{{ config('app.name') }}" style="display: block; margin: 0 auto;">
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="content">
                        <h1>Reset Your Password</h1>
                        <p>Hello {{ $user->name ?? 'there' }},</p>
                        <p>We received a request to reset the password for your account. If you didn't make this
                            request, you can safely ignore this email.</p>

                        <div class="button-container">
                            <a href="{{ config('app.frontend_url') . '/reset-password?token=' . $token . '&email=' . $email }}"
                                class="button">
                                Reset Password
                            </a>
                        </div>

                        <div class="warning-box">
                            <strong>Security Notice</strong>
                            <p>This password reset link will expire in 60 minutes for your security.</p>
                        </div>

                        <p>If the button above doesn't work, copy and paste the following link into your browser:</p>
                        <div class="link-text">
                            {{ config('app.frontend_url') . '/reset-password?token=' . $token . '&email=' . $email }}
                        </div>

                        <div class="divider"></div>

                        <p style="text-align: center; margin-bottom: 0;">
                            Best regards,<br>
                            <strong>The {{ config('app.name') }} Team</strong>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="footer">
                        <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                        <p>You're receiving this because a password reset was requested for your account.<br>Please do
                            not reply to this automated message.</p>
                    </td>
                </tr>
            </table>
        </center>
    </div>
</body>

</html>
