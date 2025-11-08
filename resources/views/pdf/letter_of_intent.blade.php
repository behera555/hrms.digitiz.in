<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Letter of Intent - Digitiz</title>
</head>
<body style="margin: 0; padding: 0; font-family: 'Segoe UI', Arial, sans-serif; background-color: #ffffff;">

<!-- Main Document Container -->
<div style="width: 190mm; margin: 10mm auto;">
<table width="100%" cellpadding="0" cellspacing="0" style="width: 100%; margin: 0; background-color: #ffffff; border: none; border-collapse: collapse;">
    
    <!-- Header Section with Logo -->
    <tr>
        <td style="padding: 25px 40px 15px; background-color: #ffffff;">
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="70%" style="vertical-align: top;">
                        <img src="{{ public_path('uploads/pdf/pdf_logo.jpg') }}" alt="DIGITIZ" style="height: 35px; margin: 0;">
                        <p style="margin: 5px 0 0; color: #666666; font-size: 14px; font-weight: 500;">A Brand of Allure-Rapt eServices Private Limited</p>
                    </td>
                    <td width="30%" style="text-align: right; vertical-align: top;">
                        <img src="https://hrms.digitiz.in/backend/images/brand/logo-white.png" alt="DIGITIZ" style="height: 35px;">
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    
    <!-- Document Title -->
    <tr>
        <td style="padding: 30px 40px 10px;">
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="text-align: center;">
                        <h2 style="margin: 0; color: #b70040; font-size: 24px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Letter of Intent</h2>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    
    <!-- Date Section -->
    <tr>
        <td style="padding: 10px 40px 20px;">
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <p style="margin: 0; color: #444444; font-size: 14px; font-weight: 500;">Date: <span style="border-bottom: 1px dashed #999999; padding: 0 50px 2px 5px;">{{$data['date_of_joining']}}</span></p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    
    <!-- Recipient Information -->
    <tr>
        <td style="padding: 0 40px 20px;">
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <p style="margin: 0 0 8px; color: #333333; font-size: 14px; font-weight: 500;">To,</p>
                        <p style="margin: 0 0 5px; color: #333333; font-size: 14px;">{{$data['employee_name']}}</p>
                        <p style="margin: 0 0 5px; color: #333333; font-size: 14px;">{{$data['department_name']}}</p>
                        <p style="margin: 0; color: #333333; font-size: 14px;">{{$data['address']}}</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    
    <!-- Subject Line -->
    <tr>
        <td style="padding: 15px 40px 20px;">
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="background-color: #ebd9df; padding: 12px 20px; border-left: 4px solid #b70040;">
                        <p style="margin: 0; color: #b70040; font-size: 16px; font-weight: 600;">Subject: Letter of Intent</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    
    <!-- Salutation -->
    <tr>
        <td style="padding: 10px 40px 5px;">
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <p style="margin: 0; color: #333333; font-size: 14px;">Dear {{$data['employee_name']}},</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    
    <!-- Body Content -->
    <tr>
        <td style="padding: 5px 40px 20px;">
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <p style="margin: 0 0 18px; color: #333333; font-size: 14px; line-height: 1.6; text-align: justify;">
                            We are pleased to inform you that Digitiz, a brand of Allure-Rapt eServices Private Limited, intends to engage in a potential professional association with you. This letter signifies our intent to explore mutual collaboration in alignment with our goals in digital marketing and software development services.
                        </p>
                        <p style="margin: 0 0 18px; color: #333333; font-size: 14px; line-height: 1.6; text-align: justify;">
                            Please note that this Letter of Intent is not a legally binding agreement but reflects our commitment to move forward toward a formal engagement upon mutual consent.
                        </p>
                        <p style="margin: 0; color: #333333; font-size: 14px; line-height: 1.6; text-align: justify;">
                            We look forward to your positive response.
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    
    <!-- Closing -->
    <tr>
        <td style="padding: 30px 40px 40px;">
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <p style="margin: 0 0 8px; color: #333333; font-size: 14px;">Warm Regards,</p>
                        <p style="margin: 0 0 5px; color: #b70040; font-size: 16px; font-weight: 600;">Rajkumar Natesan</p>
                        <p style="margin: 0 0 5px; color: #666666; font-size: 14px;">Managing Director</p>
                        <p style="margin: 5px 0 0; color: #666666; font-size: 14px;">Digitiz | A Brand of Allure-Rapt eServices Pvt. Ltd.</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    
    <!-- Footer Section -->
    <tr>
        <td style="padding: 25px 40px; background-color: #f8f9fa;">
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="text-align: center;">
                        <p style="margin: 0 0 10px; color: #666666; font-size: 13px; font-weight: 500;">
                            Bommasandra, Bangalore | Saravanampatti, Coimbatore
                        </p>
                        <p style="margin: 0 0 10px; color: #b70040; font-size: 13px; font-weight: 500;">
                            Email: info@digitiz.in | Website: www.digitiz.in
                        </p>
                        <p style="margin: 0; color: #888888; font-size: 11px; font-style: italic;">
                            Confidentiality Notice: This document is confidential and intended only for the recipient.
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</div>

</body>
</html>