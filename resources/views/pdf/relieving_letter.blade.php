<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relieving Letter - Digitiz</title>
</head>
<body style="margin: 0; padding: 20px; font-family: 'Segoe UI', Arial, sans-serif; background-color: #f8f9fa;">

<!-- Main Document Container -->
<table width="100%" cellpadding="0" cellspacing="0" style="max-width: 800px; margin: 0 auto; background-color: #ffffff; box-shadow: 0 0 20px rgba(0,0,0,0.1); border: 1px solid #e0e0e0;">
    
    <!-- Header Section -->
    <tr>
        <td style="padding: 30px 40px 20px; border-bottom: 3px solid #b70040;">
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="70%" style="vertical-align: top;">
                        <h1 style="margin: 0; color: #b70040; font-size: 32px; font-weight: 700; letter-spacing: 1.5px;">DIGITIZ</h1>
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
                        <h2 style="margin: 0; color: #b70040; font-size: 24px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Relieving Letter</h2>
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
                        <p style="margin: 0; color: #444444; font-size: 14px; font-weight: 500;">Date: <span style="border-bottom: 1px dashed #999999; padding: 0 80px 2px 5px; margin-left: 10px;">{{date('d-m-Y')}}</span></p>
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
                        <p style="margin: 0 0 5px; color: #333333; font-size: 14px; padding-left: 20px;">{{$data['employee_name']}}</p>
                        <p style="margin: 0; color: #333333; font-size: 14px; padding-left: 20px;">[Address]</p>
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
                    <td style="background-color: #f0f5ff; padding: 12px 20px; border-left: 4px solid #b70040;">
                        <p style="margin: 0; color: #b70040; font-size: 16px; font-weight: 600;">Subject: Relieving Letter</p>
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
                            This is to formally acknowledge that you have been relieved from your duties at Digitiz, a brand of Allure-Rapt eServices Private Limited, effective from <strong style="color: #b70040;">{{$data['relieved_date']}}</strong>.
                        </p>
                        
                        <!-- Tenure Details -->
                        <table width="100%" cellpadding="0" cellspacing="0" style="margin: 20px 0; background-color: #f9f9f9; border: 1px solid #e0e0e0; border-radius: 5px;">
                            <tr>
                                <td style="padding: 15px 20px; text-align: center;">
                                    <p style="margin: 0; color: #333333; font-size: 14px; line-height: 1.6;">
                                        During your tenure from <strong style="color: #b70040;">{{$data['date_of_joining']}}</strong> to <strong style="color: #b70040;">{{$data['relieved_date']}}</strong>, we found your performance and conduct satisfactory.
                                    </p>
                                </td>
                            </tr>
                        </table>
                        
                        <p style="margin: 0 0 18px; color: #333333; font-size: 14px; line-height: 1.6; text-align: justify;">
                            We take this opportunity to thank you for your contributions and wish you success in your future endeavors.
                        </p>
                        
                        <p style="margin: 0; color: #333333; font-size: 14px; line-height: 1.6; text-align: justify;">
                            For any clarification, please feel free to contact the HR Department.
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    
    <!-- Closing Section -->
    <tr>
        <td style="padding: 40px 40px 50px;">
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <p style="margin: 0 0 8px; color: #333333; font-size: 14px;">With best wishes,</p>
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
        <td style="padding: 25px 40px; background-color: #f8f9fa; border-top: 1px solid #eaeaea;">
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

</body>
</html>