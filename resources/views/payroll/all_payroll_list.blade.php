@extends('layouts.app')
@php
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
@endphp
@section('title', 'Pay Roll List')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">PayRoll List</div>
            </div>
        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-xl-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header  border-0">
                        <h4 class="card-title">PayRoll List Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom"
                                id="emp-attendance">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">EMPLOYEE NAME</th>
                                        <th class="border-bottom-0">Employee ID</th>
                                        <th class="border-bottom-0">NET SAL/MONTH</th>
                                        <th class="border-bottom-0">DAYS PRESENT</th>
                                        <th class="border-bottom-0">PAID LEAVES</th>
                                        <th class="border-bottom-0">LEAVES APPLIED</th>
                                        <th class="border-bottom-0">UNPAID LEAVES (includes Late Login)	</th>
                                        <!--<th class="border-bottom-0">No.of Working Days</th>-->
                                        <th class="border-bottom-0">LOP</th>
                                        <th class="border-bottom-0">SAL TO BE PAID</th>
                                        <th class="border-bottom-0">CFS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($list_emp as $key => $row)
                                    <tr>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->emp_id}}</td>
                                        <td>{{$row->total_monthly_salary_breakup}}</td>
                                        <td>{{DB::table('attendances')->where(['user_id' => $row->id])->whereMonth('login_date', date('m'))->count();}}</td>
                                        <td>{{DB::table('apply_leave')->where(['emp_id' => $row->emp_id])->where('leave_balance','!=','Unpaid_Leave')->where('leave_status','Approved')->count();}}</td>
                                        <td>{{DB::table('apply_leave')->where(['emp_id' => $row->emp_id])->count();}}</td>
                                        <td>{{DB::table('apply_leave')->where(['emp_id' => $row->emp_id])->where('leave_balance','=','Unpaid_Leave')->where('leave_status','Approved')->count();}}</td>
                                        <!--<td>{{Carbon::now()->addMonths(2)->daysInMonth}}</td>-->
                                        @php 
                                        $total  = round(DB::table('employees_monthly_salary_breakup')->where(['emp_id' => $row->emp_id])->pluck('total_monthly_salary_breakup')->first()/30, 2);
                                        $value = $total * DB::table('apply_leave')->where(['emp_id' => $row->emp_id])->where('leave_balance','=','Unpaid_Leave')->where('leave_status','Approved')->count()
                                        @endphp
                                         <td>{{$value}}</td>
                                        <td>{{DB::table('employees_monthly_salary_breakup')->where(['emp_id' => $row->emp_id])->pluck('total_monthly_salary_breakup')->first()- $value}}</td>
                                        <td></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END ROW -->


    </div>

</div>
</div><!-- end app-content-->
@endsection
@section('script')
@stop