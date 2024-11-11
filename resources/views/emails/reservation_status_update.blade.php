<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email</title>
</head>
<body style="margin: 0; padding: 0; font-family: 'Helvetica', 'Arial', sans-serif;">
    <table style="width: 100%; background-color: #f3f4f6;">
        <tr>
            <td>
                <table align="center" style="max-width: 600px; width: 100%; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);" cellspacing="0" cellpadding="0">
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
                            <p style="margin: 0;">Hello <span style="font-weight: bold;">{{ $reservationApproval->reservee->reserveeName }}</span>,</p>
                            
                            <p style="margin: 16px 0;">Your reservation status has been updated by
                                @if($admin->role_id == 1)
                                    Ms. Jamaica Quezon (AA)
                                @elseif($admin->role_id == 2)
                                    Engr. Esmael Larubis (CISSO)
                                @elseif($admin->role_id == 3)
                                    Ms. Leonila Dolor (GSO)
                                @else
                                    {{ $admin->name }} ({{ $admin->role->name }}) 
                                @endif
                                .
                            </p>
                            @if($admin->role_id == 1)

                                <p style="margin: 16px 0; color: black;">
                                    Please fill up the <a href="https://docs.google.com/forms/d/e/1FAIpQLScq23zRafcN9MrYX6dzfWmdrtnrxfLIFK5hW_F8kfOmJ5y4FA/viewform" style="color: #1d4ed8; text-decoration: underline;">LSU CAMPUS ACCESS PERMIT</a> if your event or activity is scheduled outside regular class or office hours to receive reservation approval from Engr. Esmael Larubis.
                                </p>

                            @endif

                            <p style="margin: 16px 0;">You can <a href="{{ url('/') }}" style="color: #1d4ed8; text-decoration: underline;">track your reservation status here</a>, just click the button next to "Reserve Now". </p>
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
