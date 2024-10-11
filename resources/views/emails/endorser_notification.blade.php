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
                            <div>
                                <img src="https://ci3.googleusercontent.com/meips/ADKq_NaQfG-TngAqMOdjBLhiF9mCfQaupdFfkoWw_oz4OjNNfWvRlDJcY2l53PTxr2j_61WXiytBmnAvM5bRvE06hcjfw_7gMmoSuZ7iyjKAjeEUsloSESubUd93OhHx7LZmLUBBvCqqbYeSHy-yM55PZyJx8aN0Ng=s0-d-e1-ft#https://lsu-media-styles.sgp1.digitaloceanspaces.com/lsu-public-images/banners/logo/lsu-b-v.png" style="width: 200px; height: auto;">
                                <div style="color: black; font-size: 15px; color: #0a260c;">Facilities Reservation</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px; font-size: 16px; line-height: 1.5; color: #374151;">
                            <p style="margin: 0;">Hello <span style="font-weight: bold;">{{ $endorsedBy }}</span>,</p>
                            <p style="margin: 0; margin-top: 15px;">We hope this message finds you well.</p>
                            <p style="margin: 16px 0;">We are reaching out to ask for your confirmation regarding a specific reservation made by <span style="font-weight: bold;">{{$reserveeName}}</span> on <span style="font-weight: bold;">{{ $eventStartDate }}</span> for <span style="font-weight: bold;">{{ $eventName }}</span> at 
                            <span style="font-weight: bold;">{{ $chosenFacilityList }}</span>. They have indicated that you are the endorser for this reservation.</p>
                            <p style="margin: 16px 0;">If you can confirm this, please click the "Confirm Reservation" button below:</p>

                            <div style="text-align: center;">
                                <a href="{{ route('confirm.endorsement', ['token' => $confirmationToken]) }}" style="background-color: #05481C; border-radius: 4px; display: inline-block; padding: 12px 24px; color: #ffffff; font-weight: bold; text-decoration: none;">Confirm Endorsement</a>
                            </div>

                            <p style="margin: 0;">If you have any questions or need to make changes to your reservation, feel free to <a href="https://example.com/contact" style="color: #4f46e5; text-decoration: none;">contact us</a>.</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px; text-align: center; font-size: 14px; color: #6b7280; background: #0a260c;">
                            <div>
                                <img src="https://ci3.googleusercontent.com/meips/ADKq_NbEQL7HFsy1Ul8qYlJxpX1vZ51jLOeFw-ynG34VeDidgWRJdYRAMLJJDiXibgDRMcT4jfU13HnTok7b1hk2CX8IbuJo0ej9GgkB-vLxPiAIpYHQVXQmsU2nmeXeSET9DZx0RFr0h8GtE5mKOkL_SV-xooZRdg=s0-d-e1-ft#https://lsu-media-styles.sgp1.digitaloceanspaces.com/lsu-public-images/banners/logo/lsu-w-v.png" style="height: 50px;">
                                <div style="margin-bottom: 10px; color: white;">Copyright 2024. All Rights Reserved.</div>
                                <div style="color: white; padding: 5px 10px 15px 10px; text-align: center; font-size: 10px;">
                                    Disregard this email if you are not the abovenamed person or if you are done with the verification process.
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
