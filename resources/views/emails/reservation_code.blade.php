<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Helvetica', 'Arial', sans-serif;
        }
        table {
            width: 100%;
            background-color: #f3f4f6;
        }
        .email-container {
            max-width: 600px;
            width: 100%;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding: 20px;
        }
        .header img {
            width: 150px;
        }
        .header .title {
            margin-top: 10px;
            font-size: 17px;
            color: #087830;
            font-weight: bold;
        }
        .content {
            padding: 20px;
            font-size: 16px;
            line-height: 1.5;
            color: #374151;
        }
        .content a {
            color: #1d4ed8;
            text-decoration: underline;
        }
        .content a.cancel-link {
            color: red;
        }
        .reservation-code {
            text-align: center;
        }
        .reservation-code span {
            background-color: #05481C;
            border-radius: 4px;
            display: inline-block;
            padding: 12px 24px;
            color: #ffffff;
            font-weight: bold;
        }
        .content p {
            margin: 16px 0;
        }
        .footer {
            padding: 20px;
            text-align: center;
            font-size: 14px;
            color: #6b7280;
            background: #0a260c;
        }
        .footer img {
            width: 70px;
        }
        .footer div {
            margin-bottom: 10px;
            color: white;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <td style="padding: 20px;">
                <table class="email-container" align="center" cellspacing="0" cellpadding="0">
                    <tr>
                        <td class="header">
                            <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/217b118b72d274bf14ba41e166c1687069d0f4ed02a740948fb6bf23364d916d?placeholderIfAbsent=true&apiKey=a25d9352c0e24748b58ba2c7e0217b4a" alt="Descriptive image content" />
                            <div class="title">Facilities Reservation</div>
                        </td>
                    </tr>
                    <tr>
                        <td class="content">
                            <p style="margin: 0;">Hello,</p>
                            <p>Thank you for making a reservation with us. Your reservation code is provided below. Please keep this code safe as you will need it to track the status of your reservation.</p>
                            <div class="reservation-code">
                                <span>{{ $reservationCode }}</span>
                            </div>
                            <p>You can <a href="{{ url('/') }}">track your reservation status here</a>, just click the button next to "Reserve Now". If you wish to cancel your reservation, you can do so by clicking <a href="{{ url('/cancel-reservation/' . $reservationCode) }}" class="cancel-link">this.</a></p>
                            <p>
                                <strong>Note:</strong> If you've added an endorser to your reservation, please ensure that your endorser confirms the endorsement via the email they received.
                            </p>
                            <p>Thank you so much!</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="footer">
                            <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/4bd554fbf00dbd236b74cf2e012a62c72f57b58c17af8419c1727236400fb592?placeholderIfAbsent=true&apiKey=a25d9352c0e24748b58ba2c7e0217b4a" alt="Descriptive image content" />
                            <div>Copyright 2024. All Rights Reserved.</div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
