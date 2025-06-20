<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Contact Form Submission</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; padding: 20px;">
    <h2 style="color: #2c3e50;">📩 Client Inquiry Received</h2>

    <table cellpadding="8" cellspacing="0" border="0" style="background-color: #f9f9f9; border: 1px solid #ddd; width: 100%; max-width: 600px;">
        <tr>
            <td style="width: 120px;"><strong>Name:</strong></td>
            <td>{{ $name }}</td>
        </tr>
        <tr>
            <td><strong>Email:</strong></td>
            <td>{{ $email }}</td>
        </tr>
        <tr>
            <td><strong>Subject:</strong></td>
            <td>{{ $subject }}</td>
        </tr>
        <tr>
            <td valign="top"><strong>Message:</strong></td>
            <td style="white-space: pre-line;">{{ $message_content }}</td>
        </tr>
    </table>

    <p style="font-size: 14px; color: #777; margin-top: 30px;">
        This email was generated from your website’s contact form. Please do not reply directly to this message unless necessary.
    </p>
</body>
</html>
