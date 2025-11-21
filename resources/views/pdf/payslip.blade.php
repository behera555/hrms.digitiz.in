<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Salary Slip</title>
</head>

<body style="margin:0; padding:0; font-family: DejaVu Sans, sans-serif; font-size:15px;">

    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse;">
        <tr>
            <td align="center" style="padding:10px 0;">
                <img src="{{ public_path('backend/pdf/logo.jpg') }}" alt="Logo" style="height:70px;">
            </td>
        </tr>
    </table>

    <table width="90%" align="center" cellspacing="0" cellpadding="6" border="1"
        style="border-collapse:collapse; border:1px solid #000; margin-top:5px;">
        <tr>
            <td style="width:50%; text-align:center; font-weight:bold;">Salary Slip for the Month of</td>
            @php
                $yr = \Carbon\Carbon::parse($employees_payslip_list->created_at ?? now())->format('M Y');
            @endphp
            <td style="text-align:center; font-weight:bold;">{{ $yr }}</td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:center; font-weight:bold;">Employee Details</td>
        </tr>
        <tr>
            <td style="width:30%; font-weight:bold;">Name:</td>
            <td style="text-align:center;">{{ $employees_payslip_list->employee_name ?? $employees_payslip_list->name ?? '' }}</td>
        </tr>
        <tr>
            <td style="font-weight:bold;">Designation:</td>
            <td style="text-align:center;">{{ $employees_payslip_list->designation ?? '' }}</td>
        </tr>
        <tr>
            <td style="font-weight:bold;">Total Salary:</td>
            <td style="text-align:center;">₹ {{ numberFormat($employees_payslip_list->monthly_package ?? 0,2) }}</td>
        </tr>

        <tr>
            <td colspan="2" style="text-align:center; font-weight:bold;">Attendance Details</td>
        </tr>
        <tr>
            <td colspan="2" style="padding:0;">
                <table width="100%" cellspacing="0" cellpadding="6" border="1" style="border-collapse:collapse;">
                    <tr>
                        <td style="font-weight:bold;">No.of Working Days</td>
                        <td style="text-align:center;">{{ $employees_payslip_list->days ?? 0 }}</td>
                        <td style="font-weight:bold;">Paid Leaves</td>
                        <td style="text-align:center;">0</td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;">No. of Days Present</td>
                        <td style="text-align:center;">{{ $employees_payslip_list->days ?? 0 }}</td>
                        <td style="font-weight:bold;">No. of Days Absent</td>
                        <td style="text-align:center;">0</td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;">Unpaid Leaves</td>
                        <td style="text-align:center;">0</td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <br>

    <table width="90%" align="center" cellspacing="0" cellpadding="6" border="1"
        style="border-collapse:collapse; border:1px solid #000;">
        <tr>
            <td colspan="4" style="text-align:center; font-weight:bold;">Salary Details</td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:center; font-weight:bold;">Earnings</td>
            <td colspan="2" style="text-align:center; font-weight:bold;">Deductions</td>
        </tr>
        <tr>
            <td style="font-weight:bold; text-align:center;">Salary Heads</td>
            <td style="font-weight:bold; text-align:center;">Amount</td>
            <td style="font-weight:bold; text-align:center;">Salary Heads</td>
            <td style="font-weight:bold; text-align:center;">Amount</td>
        </tr>

        <tr>
            <td>Basic</td>
            <td style="text-align:center;">₹ {{ numberFormat(optional($employees_monthly_salary_breakup)->basic ?? 0,2) }}</td>
            <td>Professional Tax</td>
            <td style="text-align:center;">₹ {{ numberFormat(optional($employees_monthly_salary_breakup)->professional_tax ?? 0,2) }}</td>
        </tr>
        <tr>
            <td>HRA</td>
            <td style="text-align:center;">₹ {{ numberFormat(optional($employees_monthly_salary_breakup)->hra_allowance ?? 0,2) }}</td>
            <td>PF Employee</td>
            <td style="text-align:center;">₹ {{ optional($employees_pf)->pf_employee }}</td>
        </tr>
        <tr>
            <td>Travel & Fuel</td>
            <td style="text-align:center;">₹ {{ numberFormat(optional($employees_monthly_salary_breakup)->travel_allowances ?? 0,2) }}</td>
            <td>PF - Employer</td>
            <td style="text-align:center;">₹ {{ optional($employees_pf)->pf_employer }}</td>
        </tr>
        <tr>
            <td>Education</td>
            <td style="text-align:center;">₹ {{ numberFormat(optional($employees_monthly_salary_breakup)->education ?? 0,2) }}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Communication</td>
            <td style="text-align:center;">₹ {{ numberFormat(optional($employees_monthly_salary_breakup)->communication ?? 0,2) }}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>LTA</td>
            <td style="text-align:center;">₹ {{ numberFormat(optional($employees_monthly_salary_breakup)->lta ?? 0,2) }}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Special Allowances</td>
            <td style="text-align:center;">₹ {{ numberFormat(optional($employees_monthly_salary_breakup)->special_allowance ?? 0,2) }}</td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td style="font-weight:bold;">Gross Earnings</td>
            <td style="text-align:center;">₹ {{ numberFormat($employees_payslip_list->monthly_package ?? 0,2) }}</td>
            <td style="font-weight:bold;">Total Deductions</td>
            <td style="text-align:center;">₹ {{ numberFormat(optional($employees_monthly_salary_breakup)->professional_tax ?? 0,2) }}</td>
        </tr>

        <tr>
            <td style="font-weight:bold;">Gross Deductions</td>
            <td style="text-align:center;">₹ {{ numberFormat(optional($employees_monthly_salary_breakup)->professional_tax ?? 0,2) }}</td>
            <td style="font-weight:bold;">Net Pay</td>
            <td style="text-align:center;">₹ {{ numberFormat(optional($employees_monthly_salary_breakup)->net_pay ?? 0,2) }}</td>
        </tr>
    </table>

    <br>

    <table width="90%" align="center" cellspacing="0" cellpadding="6" border="0">
        <tr>
            <td style="font-weight:bold; text-decoration:underline;">D.Himaja (HR Executive)</td>
        </tr>
    </table>

</body>

</html>
