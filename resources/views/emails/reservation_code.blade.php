<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email</title>
</head>
<body style="margin: 0; padding: 0; font-family: 'Helvetica', 'Arial', sans-serif;">
    <table width="100%" cellspacing="0" cellpadding="0" style="background-color: #f3f4f6;">
        <tr>
            <td style="padding: 20px;">
                <table align="center" width="100%" cellspacing="0" cellpadding="0" style="max-width: 600px; width: 100%; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                    <tr>
                        <td style="text-align: center; padding: 20px;">
                          <div class="m_-6882499225859232211main-container">
                              <img loading="lazy" style="width:150px"src="https://cdn.builder.io/api/v1/image/assets/TEMP/217b118b72d274bf14ba41e166c1687069d0f4ed02a740948fb6bf23364d916d?placeholderIfAbsent=true&apiKey=a25d9352c0e24748b58ba2c7e0217b4a" class="object-contain w-full aspect-[2.86]" alt="Descriptive image content" />
                            <div class="m_-6882499225859232211text-center" style="margin-top:10px;font-size:17px;color:#087830; font-weight:bold">Facilities Reservation</div>
                          </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px; font-size: 16px; line-height: 1.5; color: #374151;">
                            <p style="margin: 0;">Hello,</p>
                            <p style="margin: 16px 0;">Thank you for making a reservation with us. Your reservation code is provided below. Please keep this code safe as you will need it to track the status of your reservation.</p>
                            
                            <div style="text-align: center;">
                                <span style="background-color: #05481C; border-radius: 4px;display: inline-block; padding: 12px 24px; color: #ffffff; font-weight: bold;">{{ $reservationCode }}</span>
                            </div>
                            <p style="margin: 16px 0;">You can <a href="{{ url('/') }}" style="color: #1d4ed8; text-decoration: underline;">track your reservation status here</a>, just click the button next to "Reserve Now". If you wish to cancel your reservation, you can do so by clicking <a href="{{ url('/cancel-reservation/' . $reservationCode) }}" style="color:red;"> this.</a> </p>
                            <p>Thank you so much!</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px; text-align: center; font-size: 14px; color: #6b7280;">
                            <div style="background:#0a260c;padding:20px 5px 5px 5px">
                                <div class="m_-6882499225859232211footer-content">
                                <img loading="lazy" style="width:70px" src="https://cdn.builder.io/api/v1/image/assets/TEMP/4bd554fbf00dbd236b74cf2e012a62c72f57b58c17af8419c1727236400fb592?placeholderIfAbsent=true&apiKey=a25d9352c0e24748b58ba2c7e0217b4a" class="object-contain w-full aspect-[2.33]" alt="Descriptive image content" />
                                <div style="margin-bottom:10px;color:white">
                                    Copyright 2024. All Rights Reserved.
                                </div>
                                </div>
                            </div>                        
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
