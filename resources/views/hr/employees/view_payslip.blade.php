<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payslip</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <style>
    body {
        font-family: 'Agency FB';
    }

    .main {
        width: 100%;
        max-width: 950px;
        margin: 10px auto;
    }

    @media print {
     @page {
        margin-left: 0.5in;
        margin-right: 0.5in;
        margin-top: 0;
        margin-bottom: 0;
      }
}

@media print {
  #printPageButton {
    display: none;
  }
}
    </style>
    <style type="text/css" media="print">
    @page 
    {
        size: auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
    }
</style>
</head>

<body onload="window.print()">

    <div class="main">
    <div id="dvContainer">
        <div style="text-align: center;margin-bottom: 15px;"><img src="{{asset('backend/pdf/logo.jpg')}}"></div>
        <table width="100%" style="border:solid 2px #000;border-bottom: 0px;" cellspacing="0">
            <tbody>
                <tr>
                    <td
                        style="height: 35px;text-align: center;font-weight: bold;font-size: 18px;border-right: solid 2px #000;width: 50%;">
                        Salary Slip for the Month of</td>@php
            $yrdata= strtotime($employees_payslip_list->created_at);
            @endphp
                    <td style="height: 35px;text-align: center;font-weight: bold;font-size: 18px;">{{date('M Y', $yrdata)}}</td>
                </tr>
                <tr>
                    <td colspan="2"
                        style="height: 35px;text-align: center;font-weight: bold;font-size: 18px;border-top: solid 2px #000;">
                        Employee Details
                    </td>
                </tr>
                <tr>
                    <table width="100%" style="border:solid 2px #000;" cellspacing="0">
                        <tr>
                            <td
                                style="height: 35px;text-align: center;font-weight: bold;font-size: 18px;border-right: solid 2px #000;width: 30%;border-bottom: solid 2px #000;">
                                Name:</td>
                            <td
                                style="width:70%;height: 35px;text-align: center;font-size: 18px;border-bottom: solid 2px #000;">
                                {{$employees_payslip_list->employee_name}}</td>
                        </tr>
                        <tr>
                            <td
                                style="height: 35px;text-align: center;font-weight: bold;font-size: 18px;border-right: solid 2px #000;width: 30%;border-bottom: solid 2px #000;">
                                Designation:
                            </td>
                            <td
                                style="width:70%;height: 35px;text-align: center;font-size: 18px;border-bottom: solid 2px #000;">
                                {{$employees_payslip_list->designation}} </td>
                        </tr>
                        <tr>
                            <td
                                style="height: 35px;text-align: center;font-weight: bold;font-size: 18px;border-right: solid 2px #000;width: 30%;border-bottom: solid 2px #000;">
                                Total Salary:</td>
                            <td
                                style="width:70%;height: 35px;text-align: center;font-size: 18px;border-bottom: solid 2px #000;">
                                {{numberFormat($employees_payslip_list->monthly_package,2)}}</td>
                        </tr>
                        <tr>
                            <td
                                style="height: 35px;text-align: center;font-weight: bold;font-size: 18px;border-bottom: solid 2px #000;">
                                Attendance Details
                            </td>
                            <td
                                style="width:70%;height: 35px;text-align: center;font-size: 18px;border-bottom: solid 2px #000;">
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <table width="100%" style="border:solid 0px #000;" cellspacing="0">
                                    <tr>
                                        <td
                                            style="height: 35px;font-weight: bold;font-size: 18px;border-right: solid 2px #000;width: 30%;border-bottom: solid 2px #000;border-left: 0;padding-left: 5px;">
                                            No.of Working Days </td>
                                        <td
                                            style="height: 35px;text-align: center;font-size: 18px;border-right: solid 2px #000;width: 20%;border-bottom: solid 2px #000;border-left: 0;">
                                            {{$employees_payslip_list->days}}</td>
                                        <td
                                            style="height: 35px;font-weight: bold;font-size: 18px;border-right: solid 2px #000;width: 30%;border-bottom: solid 2px #000;border-left: 0;padding-left: 5px;">
                                            Paid Leaves</td>
                                        <td
                                            style="height: 35px;text-align: center;font-weight: bold;font-size: 18px;width: 30%;border-bottom: solid 2px #000;border-left: 0;">
                                            0</td>
                                    </tr>

                                    <tr>
                                        <td
                                            style="height: 35px;font-weight: bold;font-size: 18px;border-right: solid 2px #000;width: 30%;border-bottom: solid 2px #000;border-left: 0;padding-left: 5px;">
                                            No. of Days Present </td>
                                        <td
                                            style="height: 35px;text-align: center;font-size: 18px;border-right: solid 2px #000;width: 20%;border-bottom: solid 2px #000;border-left: 0;">
                                            {{$employees_payslip_list->days}}</td>
                                        <!--<td-->
                                        <!--    style="height: 35px;font-weight: bold;font-size: 18px;border-right: solid 2px #000;width: 30%;border-bottom: solid 2px #000;border-left: 0;padding-left: 5px;">-->
                                        <!--    Loss Of Pay</td>-->
                                        <!--<td-->
                                        <!--    style="height: 35px;text-align: center;font-weight: bold;font-size: 18px;width: 30%;border-bottom: solid 2px #000;border-left: 0;">-->
                                        <!--    Rs -</td>-->
                                    </tr>

                                    <tr>
                                        <td
                                            style="height: 35px;font-weight: bold;font-size: 18px;border-right: solid 2px #000;width: 30%;border-bottom: solid 2px #000;border-left: 0;padding-left: 5px;">
                                            No. of Days Absent </td>
                                        <td
                                            style="height: 35px;text-align: center;font-size: 18px;border-right: solid 2px #000;width: 20%;border-bottom: solid 2px #000;border-left: 0;">
                                            0</td>
                                        <td
                                            style="height: 35px;font-weight: bold;font-size: 18px;width: 30%;border-left: 0;">
                                            &nbsp;</td>
                                        <td
                                            style="height: 35px;text-align: center;font-weight: bold;font-size: 18px;width: 30%;border-left: 0;">
                                            &nbsp;</td>
                                    </tr>

                                    <tr>
                                        <td
                                            style="height: 35px;font-weight: bold;font-size: 18px;border-right: solid 2px #000;width: 30%;border-left: 0;padding-left: 5px;">
                                            Unpaid leaves </td>
                                        <td
                                            style="height: 35px;text-align: center;font-size: 18px;border-right: solid 2px #000;width: 20%;border-left: 0;">
                                            0</td>
                                        <td
                                            style="height: 35px;font-weight: bold;font-size: 18px;width: 30%;border-left: 0;">
                                            &nbsp;</td>
                                        <td
                                            style="height: 35px;text-align: center;font-weight: bold;font-size: 18px;width: 30%;border-left: 0;">
                                            &nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>



                    </table>

                </tr>
            </tbody>
        </table>

        <table width="100%" cellspacing="0" style="margin-top: 20px;">

            <tr>
                <table width="100%" cellspacing="0"
                    style="margin-top: 20px;border:solid 2px #000;border-bottom: 0px;margin-bottom: 30px;">
                    <tr>
                        <td
                            style="height: 35px;text-align: center;font-weight: bold;font-size: 18px;border-right: solid 2px #000;width: 30%;border-bottom:solid 2px #000;">
                            Salary Details
                        </td>
                        <td colspan="3"
                            style="height: 35px;text-align: center;font-weight: bold;font-size: 18px;width: 20%;border-bottom:solid 2px #000;">
                        </td>

                    </tr>
                    <tr>
                        <td
                            style="height: 35px;text-align: center;font-weight: bold;font-size: 18px;border-right: solid 2px #000;width: 30%;border-bottom:solid 2px #000;">
                            Earnings</td>
                        <td
                            style="height: 35px;text-align: center;font-weight: bold;font-size: 18px;border-right: solid 2px #000;width: 20%;border-bottom:solid 2px #000;">
                        </td>
                        <td
                            style="height: 35px;text-align: center;font-weight: bold;font-size: 18px;border-right: solid 2px #000;width: 30%;border-bottom:solid 2px #000;">
                            Deductions</td>
                        <td
                            style="height: 35px;text-align: center;font-weight: bold;font-size: 18px;border-right: solid 0px #000;width: 30%;border-bottom:solid 2px #000;">
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="height: 35px;text-align: center;font-weight: bold;font-size: 18px;border-right: solid 2px #000;width: 30%;border-bottom:solid 2px #000;">
                            Salary Heads</td>
                        <td
                            style="height: 35px;text-align: center;font-weight: bold;font-size: 18px;border-right: solid 2px #000;width: 20%;border-bottom:solid 2px #000;">
                            Amount</td>
                        <td
                            style="height: 35px;text-align: center;font-weight: bold;font-size: 18px;border-right: solid 2px #000;width: 30%;border-bottom:solid 2px #000;">
                            Salary Heads</td>
                        <td
                            style="height: 35px;text-align: center;font-weight: bold;font-size: 18px;border-right: solid 0px #000;width: 30%;border-bottom:solid 2px #000;">
                            Amount</td>
                    </tr>
                    <tr>
                        <td
                            style="height: 35px;padding-left:5px;font-weight: bold;font-size: 18px;border-right: solid 2px #000;width: 30%;border-bottom:solid 2px #000;">
                            Basic</td>
                        <td
                            style="height: 35px;text-align: center;font-size: 18px;border-right: solid 2px #000;width: 20%;border-bottom:solid 2px #000;">
                            <i class="fa fa-rupee"></i> {{numberFormat(optional($employees_monthly_salary_breakup)->basic ?? 0,2)}}</td>
                        <td
                            style="height: 35px;padding-left:5px;font-weight: bold;font-size: 18px;border-right: solid 2px #000;width: 30%;border-bottom:solid 2px #000;">
                            Professional Tax</td>
                        <td
                            style="height: 35px;text-align: center;font-size: 18px;border-right: solid 0px #000;width: 30%;border-bottom:solid 2px #000;">
                            <i class="fa fa-rupee"></i> {{numberFormat(optional($employees_monthly_salary_breakup)->professional_tax ?? 0,2)}}</td>
                    </tr>
                    <tr>
                        <td
                            style="height: 35px;padding-left:5px;font-weight: bold;font-size: 18px;border-right: solid 2px #000;width: 30%;border-bottom:solid 2px #000;">
                            HRA</td>
                        <td
                            style="height: 35px;text-align: center;font-size: 18px;border-right: solid 2px #000;width: 20%;border-bottom:solid 2px #000;">
                            <i class="fa fa-rupee"></i> {{numberFormat(optional($employees_monthly_salary_breakup)->hra_allowance ?? 0,2)}}</td>
                        <td
                            style="height: 35px;padding-left:5px;font-weight: bold;font-size: 18px;border-right: solid 2px #000;width: 30%;border-bottom:solid 2px #000;">
                            PF Employee</td>
                        <td
                            style="height: 35px;text-align: center;font-size: 18px;border-right: solid 0px #000;width: 30%;border-bottom:solid 2px #000;">
                            {{ optional($employees_pf)->pf_employee }}</td>
                            
                    </tr>
                    <tr>
                        <td
                            style="height: 35px;padding-left:5px;font-weight: bold;font-size: 18px;border-right: solid 2px #000;width: 30%;border-bottom:solid 2px #000;">
                            Travel & Fuel</td>
                        <td
                            style="height: 35px;text-align: center;font-size: 18px;border-right: solid 2px #000;width: 20%;border-bottom:solid 2px #000;">
                            <i class="fa fa-rupee"></i> {{numberFormat(optional($employees_monthly_salary_breakup)->travel_allowances ?? 0,2)}}</td>
                            
                        <td style="height: 35px;padding-left:5px;font-weight: bold;font-size: 18px;border-right: solid 2px #000;width: 30%;border-bottom:solid 2px #000;">PF - Employer</td>
                        <td style="height: 35px;text-align: center;font-size: 18px;border-right: solid 2px #000;width: 20%;border-bottom:solid 2px #000;">
                            {{ optional($employees_pf)->pf_employer }}</td>
                    </tr>
                    <tr>
                        <td
                            style="height: 35px;padding-left:5px;font-weight: bold;font-size: 18px;border-right: solid 2px #000;width: 30%;border-bottom:solid 2px #000;">
                            Education</td>
                        <td
                            style="height: 35px;text-align: center;font-size: 18px;border-right: solid 2px #000;width: 20%;border-bottom:solid 2px #000;">
                            <i class="fa fa-rupee"></i> {{numberFormat(optional($employees_monthly_salary_breakup)->education ?? 0,2)}}</td>

                    </tr>
                    <tr>
                        <td
                            style="height: 35px;padding-left:5px;font-weight: bold;font-size: 18px;border-right: solid 2px #000;width: 30%;border-bottom:solid 2px #000;">
                            Communication</td>
                        <td
                            style="height: 35px;text-align: center;font-size: 18px;border-right: solid 2px #000;width: 20%;border-bottom:solid 2px #000;">
                            <i class="fa fa-rupee"></i> {{numberFormat(optional($employees_monthly_salary_breakup)->communication ?? 0,2)}}</td>

                    </tr>
                    <tr>
                        <td
                            style="height: 35px;padding-left:5px;font-weight: bold;font-size: 18px;border-right: solid 2px #000;width: 30%;border-bottom:solid 2px #000;">
                            LTA </td>
                        <td
                            style="height: 35px;text-align: center;font-size: 18px;border-right: solid 2px #000;width: 20%;border-bottom:solid 2px #000;">
                            <i class="fa fa-rupee"></i> {{numberFormat(optional($employees_monthly_salary_breakup)->lta ?? 0,2)}}</td>

                    </tr>
                    <tr>
                        <td
                            style="height: 35px;padding-left:5px;font-weight: bold;font-size: 18px;border-right: solid 2px #000;width: 30%;border-bottom:solid 2px #000;">
                            Special Allowances </td>
                        <td
                            style="height: 35px;text-align: center;font-size: 18px;border-right: solid 2px #000;width: 20%;border-bottom:solid 2px #000;">
                            <i class="fa fa-rupee"></i> {{numberFormat(optional($employees_monthly_salary_breakup)->special_allowance ?? 0,2)}}</td>

                    </tr>

                    <tr>
                        <td
                            style="height: 35px;padding-left:5px;font-weight: bold;font-size: 18px;width: 30%;border-bottom:solid 0px #000;">
                            &nbsp;</td>
                        <td
                            style="height: 35px;text-align: center;font-weight: bold;font-size: 18px;width: 20%;border-bottom:solid 0px #000;">
                            &nbsp;</td>

                    </tr>

                    <tr>
                        <td
                            style="height: 35px;text-align: center;font-weight: bold;font-size: 18px;border-right: solid 2px #000;width: 30%;border-bottom:solid 2px #000;border-top:solid 2px #000;">
                            Gross Earnings </td>
                        <td
                            style="height: 35px;text-align: center;font-size: 18px;border-right: solid 2px #000;width: 20%;border-bottom:solid 2px #000;border-top:solid 2px #000;">
                            <i class="fa fa-rupee"></i> {{numberFormat($employees_payslip_list->monthly_package,2)}} </td>
                        <td
                            style="height: 36px;text-align: center;font-weight: bold;font-size: 18px;border-right: solid 2px #000;width: 30%;border-bottom:solid 2px #000;border-top:solid 2px #000;">
                            Total Deductions</td>
                        <td
                            style="height: 35px;text-align: center;font-size: 18px;border-right: solid 0px #000;width: 30%;border-bottom:solid 2px #000;border-top:solid 2px #000;">
                            <i class="fa fa-rupee"></i> {{numberFormat(optional($employees_monthly_salary_breakup)->professional_tax ?? 0,2)}}</td>
                    </tr>

                    <tr>
                        <td
                            style="height: 35px;text-align: center;font-weight: bold;font-size: 18px;border-right: solid 2px #000;width: 30%;border-bottom:solid 2px #000;">
                            Gross Deductions </td>
                        <td
                            style="height: 35px;text-align: center;font-size: 18px;border-right: solid 2px #000;width: 20%;border-bottom:solid 2px #000;">
                            <i class="fa fa-rupee"></i> {{numberFormat(optional($employees_monthly_salary_breakup)->professional_tax ?? 0,2)}} </td>
                        <td
                            style="height: 35px;text-align: center;font-size: 18px;width: 30%;border-bottom:solid 2px #000;">
                        </td>
                        <td
                            style="height: 35px;text-align: center;font-weight: bold;font-size: 18px;border-right: solid 0px #000;width: 30%;border-bottom:solid 2px #000;">
                        </td>
                    </tr>

                    <tr>
                        <td
                            style="height: 35px;text-align: center;font-weight: bold;font-size: 18px;border-right: solid 2px #000;width: 30%;border-bottom:solid 2px #000;">
                            Net Pay</td>
                        <td
                            style="height: 35px;text-align: center;font-size: 18px;border-right: solid 2px #000;width: 20%;border-bottom:solid 2px #000;">
                            <i class="fa fa-rupee"></i>
                            {{numberFormat(optional($employees_monthly_salary_breakup)->net_pay ?? 0,2)}}
                        </td>
                        <td
                            style="height: 35px;text-align: center;font-weight: bold;font-size: 18px;width: 30%;border-bottom:solid 2px #000;">
                        </td>
                        <td
                            style="height: 35px;text-align: center;font-weight: bold;font-size: 18px;border-right: solid 0px #000;width: 30%;border-bottom:solid 2px #000;">
                        </td>
                    </tr>

                </table>
            </tr>
            <tr>
                <table style="margin-bottom: 40px;">
                    <tr>
                        <td style="font-weight: bold;font-size: 18px;text-decoration: underline;">D.Himaja (HR
                            Executive)</td>
                    </tr>
                </table>
                <button id="printPageButton" onClick="window.print();">Print</button>
            </tr>
        </table>
    </div>
    </div>
</body>
@section('script')
<script type="text/javascript">
      window.onload = function() { window.print(); }
 </script>
@stop

</html>