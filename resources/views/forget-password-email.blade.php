<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            text-align: center;
            padding: 20px 0;
            background-color: #82ae46;
            color: #ffffff;
            border-radius: 8px 8px 0 0;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .email-body {
            padding: 20px;
            color: #333333;
        }
        .email-body p {
            font-size: 16px;
            line-height: 1.6;
        }
        .email-footer {
            text-align: center;
            padding: 20px;
            font-size: 14px;
            color: #777777;
        }
        .reset-button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #82ae46;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            margin: 20px 0;
        }
        .reset-button:hover {
            background-color: #82ae46;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Email Header -->
        <div class="email-header">
            <h1>Reset Your Password</h1>
        </div>

        <!-- Email Body -->
        <div class="email-body">
            <p>Hello,</p>
            <p>We received a request to reset your password. Click the button below to reset it:</p>
            <a style="color: #f4f4f4" href="{{ $url }}" class="reset-button">Reset Password</a>
            <p>If you did not request a password reset, you can safely ignore this email.</p>
            <p>This password reset link will expire in 60 minutes.</p>
        </div>

        <!-- Email Footer -->
        <div class="email-footer">
            <p>If you have any questions, feel free to contact us at <a href="mailto:support@wellnezmart.net">support@wellnezmart.net</a>.</p>
            <p>Thank you,<br>Wellnez Mart</p>
        </div>
    </div>
</body>
</html>
