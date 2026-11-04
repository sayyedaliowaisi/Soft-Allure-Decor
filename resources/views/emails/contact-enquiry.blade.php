
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Contact Enquiry</title>
</head>

<body style="margin:0;padding:25px;background:#faf8f4;
             font-family:Arial,sans-serif;color:#24211e;">

    <div style="max-width:650px;margin:auto;
                background:#ffffff;padding:30px;
                border:1px solid #e8e0d5;">

        <h2 style="color:#98713b;margin-top:0;">
            Soft Allure Décor
        </h2>

        <p style="color:#77716b;">
            A new enquiry has been submitted through the website.
        </p>

        <hr style="border:0;border-top:1px solid #eee5da;">

        <p><strong>Name:</strong>
            {{ $enquiry['name'] }}
        </p>

        <p><strong>Email:</strong>
            {{ $enquiry['email'] }}
        </p>

        <p><strong>Phone:</strong>
            {{ $enquiry['phone'] ?? 'Not provided' }}
        </p>

        <p><strong>Enquiry Type:</strong>
            {{ $enquiry['subject'] }}
        </p>

        <p><strong>Message:</strong></p>

        <div style="padding:15px;background:#faf8f4;
                    line-height:1.7;white-space:pre-wrap;">{{ $enquiry['message'] }}</div>

        <p style="margin-top:25px;font-size:12px;color:#77716b;">
            This message was submitted through the Soft Allure Décor website.
        </p>

    </div>

</body>
</html>
