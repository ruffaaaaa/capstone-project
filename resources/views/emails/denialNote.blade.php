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
            background-color: #f3f4f6;
        }
        .email-container {
            max-width: 600px;
            width: 100%;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            overflow: hidden;
        }
        .header {
            text-align: center;
            padding: 20px;
        }
        .header img {
            width: 150px;
        }
        .header-title {
            margin-top: 10px;
            font-size: 17px;
            color: #087830;
            font-weight: bold;
        }
        .content {
            padding: 16px;
            font-size: 16px;
            line-height: 1.5;
            color: #374151;
        }
        .note {
            background-color: #EDFBF1;
            border-left: 4px solid #087830;
            padding: 15px;
            margin: 20px 0;
            color: #087830;
        }
        .footer {
            background: #0a260c;
            padding: 20px 5px;
            text-align: center;
        }
        .footer img {
            width: 70px;
        }
        .footer-text {
            margin-bottom: 10px;
            color: white;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td>
                <div class="email-container">
                    <!-- Header -->
                    <div class="header">
                        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/217b118b72d274bf14ba41e166c1687069d0f4ed02a740948fb6bf23364d916d?placeholderIfAbsent=true&apiKey=a25d9352c0e24748b58ba2c7e0217b4a" alt="Facilities Reservation">
                        <div class="header-title">Facilities Reservation</div>
                    </div>

                    <!-- Content -->
                    <div class="content">
                        <p>Hello,</p>
                        <p>We regret to inform you that your reservation request has been denied. Please see the note below for further details:</p>
                        <div class="note">
                            <p>{{ $note }}</p>
                        </div>
                        <p>If you have any questions or require further assistance, please feel free to reach out to us.</p>
                        <p>Thank you for your understanding.</p>
                    </div>

                    <!-- Footer -->
                    <div class="footer">
                        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/4bd554fbf00dbd236b74cf2e012a62c72f57b58c17af8419c1727236400fb592?placeholderIfAbsent=true&apiKey=a25d9352c0e24748b58ba2c7e0217b4a" alt="Logo">
                        <div class="footer-text">Copyright 2024. All Rights Reserved.</div>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</body>
</html>
