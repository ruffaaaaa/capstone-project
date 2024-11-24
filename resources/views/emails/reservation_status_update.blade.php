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
            <td>
                <table class="email-container" align="center" cellspacing="0" cellpadding="0">
                    <tr>
                        <td class="header">
                            <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/217b118b72d274bf14ba41e166c1687069d0f4ed02a740948fb6bf23364d916d?placeholderIfAbsent=true&apiKey=a25d9352c0e24748b58ba2c7e0217b4a" alt="Descriptive image content" />
                            <div class="title">Facilities Reservation</div>
                        </td>
                    </tr>
                    <tr>
                        <td class="content">
                            <p>Hello,</p>
                            
                            <p>Your facility reservation status for the <strong>{{$eventName}}</strong> activity has been updated to <strong>'{{$approval_status}}'</strong> by
                                @if($admin->role_id == 1)
                                    Ms. Jamaica Quezon (AA)
                                @elseif($admin->role_id == 2)
                                    Engr. Esmael Larubis (CISSO)
                                @elseif($admin->role_id == 3)
                                    Ms. Leonila Dolor (GSO)
                                @else
                                    {{ $admin->name }} ({{ $admin->role->name }}) 
                                @endif.
                            </p>

                            @if($admin->role_id == 1)
                                <p>
                                    Please fill up the <a href="https://docs.google.com/forms/d/e/1FAIpQLScq23zRafcN9MrYX6dzfWmdrtnrxfLIFK5hW_F8kfOmJ5y4FA/viewform">LSU CAMPUS ACCESS PERMIT</a> if your event or activity is scheduled outside regular class or office hours to receive reservation approval from Engr. Esmael Larubis. Encode the names in MS Excel through the <a href="https://docs.google.com/spreadsheets/d/1l6WkiU_uATBL6z8e4Se481okwwdLQYYC6hWuMM0Pj64/edit?usp=drivesdk">link.</a>
                                </p>
                            @endif

                            @if($admin->role_id == 3)
                                <p>
                                    With the GSO's approval, your facility reservation is now complete and confirmed.
                                </p>
                            @endif 

                            <p>You can <a href="{{ url('/') }}">track your reservation status here</a>, just click the button next to "Reserve Now". </p>
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
