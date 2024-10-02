<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Template</title>
</head>
<body style="margin: 0; padding: 0; font-family: 'Helvetica', 'Arial', sans-serif;">
    <table width="100%" cellspacing="0" cellpadding="0" style="background-color: #f3f4f6;">
        <tr>
            <td style="padding: 20px;">
                <table align="center" width="100%" cellspacing="0" cellpadding="0" style="max-width: 600px; width: 100%; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                    <tr>
                        <td style="text-align: center; padding: 20px;">
                          <div class="m_-6882499225859232211main-container">
                            <img src="https://ci3.googleusercontent.com/meips/ADKq_NaQfG-TngAqMOdjBLhiF9mCfQaupdFfkoWw_oz4OjNNfWvRlDJcY2l53PTxr2j_61WXiytBmnAvM5bRvE06hcjfw_7gMmoSuZ7iyjKAjeEUsloSESubUd93OhHx7LZmLUBBvCqqbYeSHy-yM55PZyJx8aN0Ng=s0-d-e1-ft#https://lsu-media-styles.sgp1.digitaloceanspaces.com/lsu-public-images/banners/logo/lsu-b-v.png" width="200" height="auto" class="m_-6882499225859232211logo-center CToWUd" data-bit="iit">
                            <div class="m_-6882499225859232211text-center" style="color:black;font-size:15px;color:#0a260c">Facilities Reservation</div>
                          </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px; font-size: 16px; line-height: 1.5; color: #374151;">
                            <p style="margin: 0;">Hello {{ $endorsedBy }},</p>
                            <p style="margin: 0; margin-top: 15px;">We hope this message finds you well.</p>

                            <p style="margin: 16px 0;">We are reaching out to ask for your confirmation regarding a specific reservation made by {{$reserveeName}} on {{ $eventStartDate }} for {{ $eventName }} at {{ $chosenFacilityList }}.
                            They have indicated that you are the endorser for this reservation.</p>
                            
                            <p style="margin: 16px 0;">If you can confirm this, please click the "Confirm Reservation" button below:</p>
                            <table align="center" cellspacing="0" cellpadding="0" style="margin: 20px 0;">
                                <tr>
                                    <td style=" background-color: #05481C; border-radius: 4px;">
                                        <span style="display: inline-block; padding: 12px 24px; color: #ffffff; font-weight: bold;">Confirm Reservation Button</span>
                                    </td>
                                </tr>
                            </table>
                            <p style="margin: 0;">If you have any questions or need to make changes to your reservation, feel free to <a href="https://example.com/contact" style="color: #4f46e5; text-decoration: none;">contact us</a>.</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px; text-align: center; font-size: 14px; color: #6b7280;">
                            <div style="background:#0a260c;padding:20px 5px 5px 5px">
                                <div class="m_-6882499225859232211footer-content">
                                <img src="https://ci3.googleusercontent.com/meips/ADKq_NbEQL7HFsy1Ul8qYlJxpX1vZ51jLOeFw-ynG34VeDidgWRJdYRAMLJJDiXibgDRMcT4jfU13HnTok7b1hk2CX8IbuJo0ej9GgkB-vLxPiAIpYHQVXQmsU2nmeXeSET9DZx0RFr0h8GtE5mKOkL_SV-xooZRdg=s0-d-e1-ft#https://lsu-media-styles.sgp1.digitaloceanspaces.com/lsu-public-images/banners/logo/lsu-w-v.png" style="height:50px" class="CToWUd" data-bit="iit">
                                <div style="margin-bottom:10px;color:white">
                                    Copyright 2024. All Rights Reserved.
                                </div>
                                <div style="color:white;padding:5px 10px 15px 10px;text-align:center;font-size:10px">
                                    Disregard this email if you are not the abovenamed person or if you are done with the verification process.
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
