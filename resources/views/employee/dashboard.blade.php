@php 
use Carbon\Carbon;
@endphp
@extends('layouts.app')
@section('title', 'Employee Dashboard')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Weclome Back <span class="font-weight-normal text-muted ms-2">{{auth()->user()->name}}</span></div>
            </div>
        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-7">
                                <div class="mt-0 text-start">
                                    <h5 class="">Completed Projects</h5>
                                    <h3 class="mb-0 mt-auto text-success">0</h3>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="icon1 bg-success my-auto  float-end"> <i
                                        class="feather feather-file-text"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-7">
                                <div class="mt-0 text-start">
                                    <h5 class="">Total Attendance</h5>
                                    <h3 class="mb-0 mt-auto text-primary">{{DB::table('attendances')->where(['user_id' => auth()->user()->id])->whereMonth('login_date', date('m'))->count();}}</h3>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="icon1 bg-primary my-auto  float-end"> <i class="feather feather-box"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-7">
                                <div class="mt-0 text-start">
                                    <h5 class="">Absent</h5>
                                    <h3 class="mb-0 mt-auto text-secondary">{{DB::table('apply_leave')->where(['created_by' => auth()->user()->id])->where('leave_status','=','Approved')->count();}}</h3>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="icon1 bg-secondary my-auto  float-end"> <i
                                        class="feather feather-briefcase"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-7">
                                <div class="mt-0 text-start">
                                    <h5 class="">Awards</h5>
                                    <h3 class="mb-0 mt-auto text-danger">{{DB::table('awards')->where(['employee_name' => auth()->user()->emp_id])->count();}}</h3>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="icon1 bg-danger my-auto  float-end"> <i class="feather feather-award"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END ROW -->
        <div class="row">
            <div class="col-xl-4 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header border-0">
                        <h4 class="card-title">Up Coming Holidays</h4>
                    </div>
                    <div class="card-body mt-1">
                        @foreach($holidays as $key => $val)
                        <div class="mb-5">
                            <div class="d-flex comming_holidays calendar-icon icons">
                                <span class="date_time bg-success-transparent bradius me-3"><span
                                        class="date fs-20">{{date("d", strtotime($val->holiday_date));}}</span>
                                    <span class="month fs-13">{{date("M", strtotime($val->holiday_date));}}</span>
                                </span>
                                <div class="me-3 mt-0 mt-sm-1 d-block">
                                    <h6 class="mb-1 font-weight-semibold">{{$val->holiday_name}}</h6>
                                    <span class="clearfix"></span>
                                    <small>{{date("l", strtotime($val->holiday_date));}}</small>
                                </div>
                                @php 
                                $start = Carbon::now();
                                $end =  Carbon::parse($val->holiday_date);
                                @endphp
                                @if($start->diffInDays($end) != 0)
                                <p class="float-end text-muted  mb-0 fs-13 ms-auto bradius my-auto">{{
                                    $diff = $start->diffInDays($end);}} days to left</p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header border-0">
                        <h4 class="card-title">Leave Balance</h4>
                        <div class="card-options me-3">
                            <a href="{{route('employee-apply-leaves')}}" class="btn btn-block btn-primary pe-3 ps-3">Apply For
                                Leave</a>
                        </div>
                    </div>
                    <div class="table-responsive leave_table fs-13 mt-5">
                        <table class="table mb-0 text-nowrap">
                            <thead class="border-top">
                                <tr>
                                    <th class="text-start">Balance</th>
                                    <th class="text-start">Used</th>
                                    <th class="text-center">Available</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-bottom fs-15">
                                    <td class="text-center d-flex"><span
                                            class="bg-primary brround d-block me-3 mt-1 h-3 w-3"></span><span
                                            class="font-weight-semibold fs-15">Paid Leave</span></td>
                                    <td class="font-weight-semibold fs-15">{{$used_leave}}</td>
                                    <td class="text-center text-muted fs-15">{{$available}}</td>
                                </tr>
                                <tr class="border-bottom fs-15">
                                    <td class="text-center d-flex"><span
                                            class="bg-orange brround d-block me-3 mt-1 h-3 w-3"></span><span
                                            class="font-weight-semibold fs-15">Unpaid Leave</span></td>
                                    <td class="font-weight-semibold">4.5</td>
                                    <td class="text-center text-muted">0</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row mb-0 pb-0">
                        <div class="col-4 text-center py-5 border-end">
                            <h5>Vacation</h5>
                            <div class="justify-content-center text-center d-flex my-auto"><span
                                    class="text-primary fs-20 font-weight-semibold">8 <span
                                        class="my-auto fs-14 font-weight-normal text-light">/</span> 16</span></div>
                        </div>
                        <div class="col-4 text-center py-5 border-end">
                            <h5>Sick leave</h5>
                            <div class="justify-content-center text-center d-flex my-auto"><span
                                    class="text-danger fs-20 font-weight-semibold">4.5 <span
                                        class="my-auto fs-14 font-weight-normal text-light">/</span> 10</span></div>
                        </div>
                        <div class="col-4 text-center py-5">
                            <h5>Unpaid leave</h5>
                            <div class="justify-content-center text-center d-flex my-auto"><span
                                    class="fs-20 font-weight-semibold">5 <span
                                        class="my-auto fs-14 font-weight-normal text-light">/</span> 365</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header border-bottom-0">
                        <h4 class="card-title">Up Coming Birthdays</h4>
                    </div>
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0 text-nowrap">
                                <tbody>
                                    @foreach($emp_date_of_birth as $key => $val)
                                    <tr>
                                        <td class="d-flex">
                                            <img class="w-8 h-8 bradius me-3" src="{{$val->profile_pic}}"
                                                alt="media1">
                                            <div class="my-auto">
                                                <a href="javascript:void(0);"
                                                    class="mb-1 font-weight-semibold fs-16">{{$val->display_name}}</a>
                                                <p class="text-muted fs-13 mb-0">{{date("d", strtotime($val->holiday_date));}} {{date("M", strtotime($val->holiday_date));}} {{date("Y", strtotime($val->holiday_date));}} {{Carbon::parse($val->date_of_birth)->age  .' years',}}</p>
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <a class="text-success d-block fs-16" href="javascript:void(0);">Today</a>
                                            <a class="btn btn-outline-orange mt-1" href="javascript:void(0);"><i
                                                    class="fa fa-birthday-cake me-2"></i>Wish Now</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- end app-content-->
@endsection