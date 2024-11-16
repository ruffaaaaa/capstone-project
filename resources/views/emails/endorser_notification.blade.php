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

        .container {
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

        .content p {
            margin: 16px 0;
        }

        .content p:first-of-type {
            margin: 0;
        }

        .content .highlight {
            font-weight: bold;
        }

        .button-container {
            text-align: center;
            margin-top: 16px;
        }

        .button-container a {
            background-color: #05481C;
            border-radius: 4px;
            display: inline-block;
            padding: 12px 24px;
            color: #ffffff;
            font-weight: bold;
            text-decoration: none;
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
            <td>
                <table class="container" align="center" cellspacing="0" cellpadding="0">
                    <tr>
                        <td class="header">
                            <div>
                                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/217b118b72d274bf14ba41e166c1687069d0f4ed02a740948fb6bf23364d916d?placeholderIfAbsent=true&apiKey=a25d9352c0e24748b58ba2c7e0217b4a" alt="Descriptive image content">
                                <div class="title">Facilities Reservation</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="content">
                            <p>Hello <span class="highlight">{{ $endorsedBy }}</span>,</p>
                            <p>We hope this message finds you well.</p>
                            <p>We are reaching out to ask for your confirmation regarding a specific reservation made by <span class="highlight">{{ $reserveeName }}</span> on <span class="highlight">{{ $eventStartDate }}</span> for <span class="highlight">{{ $eventName }}</span> at 
                            <span class="highlight">{{ $chosenFacilityList }}</span>. They have indicated that you are the endorser for this reservation.</p>
                            <p>If you can confirm this, please click the "Confirm Endorsement" button below:</p>
                            <div class="button-container">
                                <a href="{{ route('confirm.endorsement', ['token' => $confirmationToken]) }}">Confirm Endorsement</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="footer">
                            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/4bd554fbf00dbd236b74cf2e012a62c72f57b58c17af8419c1727236400fb592?placeholderIfAbsent=true&apiKey=a25d9352c0e24748b58ba2c7e0217b4a" alt="Descriptive image content">
                            <div>Copyright 2024. All Rights Reserved.</div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
