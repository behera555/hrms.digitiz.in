<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offer Letter - Digitiz</title>
     <style>
        @page { size: A4 portrait; margin: 0; }
        html, body { margin: 0; padding: 0; width: 210mm; }
        table { border-collapse: collapse; border-spacing: 0; }
    </style>
</head>
<body style="margin: 0; padding: 0; font-family: 'Segoe UI', Arial, sans-serif; background-color: #ffffff; width: 210mm;">

<!-- Main Document Container -->
<div style="width: 210mm; margin: 0; padding: 0;">
<table width="100%" cellpadding="0" cellspacing="0" style="width: 210mm; margin: 0; background-color: #ffffff; border: none; border-collapse: collapse; table-layout: fixed;">
    
    <!-- Header Section -->
    <tr>
        <td style="padding: 30px 40px 20px; border-bottom: 3px solid #b70040;">
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
                        <h2 style="margin: 0; color: #b70040; font-size: 24px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Offer Letter</h2>
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
                        <p style="margin: 0; color: #333333; font-size: 14px; padding-left: 20px;">{{$data['address']}}</p>
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
                        <p style="margin: 0; color: #b70040; font-size: 16px; font-weight: 600;">Subject: Employment Offer Letter</p>
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
    
    <!-- Body Content - Introduction -->
    <tr>
        <td style="padding: 5px 40px 15px;">
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <p style="margin: 0 0 18px; color: #333333; font-size: 14px; line-height: 1.6; text-align: justify;">
                            We are delighted to offer you the position of <strong>{{$data['designation']}}</strong> at Digitiz, a brand of Allure-Rapt eServices Private Limited. Your skills and background have impressed us, and we are confident that you will be an asset to our growing team.
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    
    <!-- Employment Details Section -->
    <tr>
        <td style="padding: 5px 40px 15px;">
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <p style="margin: 0 0 12px; color: #333333; font-size: 14px; font-weight: 600;">Below are the details of your employment offer:</p>
                        
                        <!-- Employment Details Table -->
                        <table width="100%" cellpadding="0" cellspacing="0" style="margin: 15px 0; background-color: #f9f9f9; border: 1px solid #e0e0e0; border-radius: 5px;">
                            <tr>
                                <td style="padding: 12px 20px; border-bottom: 1px solid #e0e0e0;">
                                    <table width="100%" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="30%" style="color: #b70040; font-weight: 600; font-size: 13px;">• Position:</td>
                                            <td width="70%" style="color: #333333; font-size: 13px;">{{$data['designation']}}</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 12px 20px; border-bottom: 1px solid #e0e0e0;">
                                    <table width="100%" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="30%" style="color: #b70040; font-weight: 600; font-size: 13px;">• Department:</td>
                                            <td width="70%" style="color: #333333; font-size: 13px;">{{$data['department']}}</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 12px 20px; border-bottom: 1px solid #e0e0e0;">
                                    <table width="100%" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="30%" style="color: #b70040; font-weight: 600; font-size: 13px;">• Location:</td>
                                            <td width="70%" style="color: #333333; font-size: 13px;">Bommasandra, Bangalore</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 12px 20px; border-bottom: 1px solid #e0e0e0;">
                                    <table width="100%" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="30%" style="color: #b70040; font-weight: 600; font-size: 13px;">• Start Date:</td>
                                            <td width="70%" style="color: #333333; font-size: 13px;">{{$data['offer_letter_date']}}</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 12px 20px;">
                                    <table width="100%" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="30%" style="color: #b70040; font-weight: 600; font-size: 13px;">• Compensation:</td>
                                            <td width="70%" style="color: #333333; font-size: 13px;">₹ {{$data['salary_package']}} per month (as per Annexure)</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    
    <!-- Additional Terms -->
    <tr>
        <td style="padding: 5px 40px 20px;">
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <p style="margin: 0 0 15px; color: #333333; font-size: 14px; line-height: 1.6; text-align: justify;">
                            You will be on a probation period of <strong>3 months</strong> from your joining date. Other terms and conditions of your employment will be detailed in the Appointment Letter to be issued upon acceptance of this offer.
                        </p>
                        <p style="margin: 0; color: #333333; font-size: 14px; line-height: 1.6; text-align: justify;">
                            Please sign and return a copy of this letter as confirmation of your acceptance.
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    
    <!-- Closing Section -->
    <tr>
        <td style="padding: 30px 40px 40px;">
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <p style="margin: 0 0 8px; color: #333333; font-size: 14px;">Sincerely,</p>
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