@php 
use Carbon\Carbon;
@endphp
@inject('carbon', 'Carbon\Carbon')
@extends('layouts.app')
@section('title', 'Hr Dashboard')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">
        <div class="page-header d-xl-flex d-block">
        </div>
        <!--ROW-->
        <div class="row">
            <div class="col-xl-12 col-md-12 col-lg-12">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="mt-0 text-start"> <span class="fs-14 font-weight-semibold">Total
                                                Employees</span>
                                            <h3 class="mb-0 mt-1 mb-2">{{ $data['no_of_employees'] }}</h3>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="icon1 bg-success my-auto  float-end"> <i
                                                class="feather feather-users"></i> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="mt-0 text-start"> <span
                                                class="fs-14 font-weight-semibold">Leaves Applied</span>
                                            <h3 class="mb-0 mt-1 mb-2">{{ $data['leaves_applied'] }}</h3>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="icon1 bg-primary my-auto  float-end"> <i
                                                class="feather feather-box"></i> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="mt-0 text-start"> <span
                                                class="fs-14 font-weight-semibold">Openings</span>
                                            <h3 class="mb-0 mt-1  mb-2">{{ $data['openings'] }}</h3>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="icon1 bg-secondary brround my-auto  float-end"> <i
                                                class="fa fa-th-list"></i> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="mt-0 text-start"> <span
                                                class="fs-14 font-weight-semibold">Attendances</span>
                                            <h3 class="mb-0 mt-1  mb-2">{{ $data['no_of_attendance'] }}</h3>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="icon1 bg-secondary brround my-auto  float-end"> <i
                                                class="fa fa-clock-o"></i> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-12 col-lg-6">
                        @if (!empty($notice_boards))
                        <div class="card overflow-hidden">
                            <div class="card-header border-0">
                                <h4 class="card-title">Notice Board</h4>
                            </div>
                            <div class="pt-2">
                                <div class="list-group">
                                    @foreach($notice_boards as $key => $val)
                                    <div class="list-group-item d-flex pt-3 pb-3 border-0">
                                        <div class="me-3 me-xs-0">
                                            <div class="calendar-icon icons">
                                                <div class="date_time bg-pink-transparent"> <span class="date">{{date('d', strtotime($val->created_at))}}</span>
                                                    <span class="month">{{date('M', strtotime($val->created_at))}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ms-1">
                                            <div class="h5 fs-14 mb-1">{{$val->notice_heading}}</div> <small
                                                class="text-muted">{{strip_tags($val->notice_details)}}...</small>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="col-xl-3 col-md-12 col-lg-12">
                        <div class="mb-4">
                            <div class="card-header border-bottom-0 pt-2 ps-0">
                                <h4 class="card-title">Upcoming Events</h4>
                            </div>
                            <ul class="vertical-scroll">
                               @foreach($today_events as $key => $val)
                                <li class="item">
                                    <div class="card p-4 ">
                                        <div class="d-flex comming_events calendar-icon icons">
                                            <span class="date_time bg-success-transparent bradius me-3"><span
                                                    class="date fs-18">{{ date('d') }}</span>
                                                <span class="month fs-10">{{ date('M') }}</span>
                                            </span>
                                            <div class="me-3 mt-0 mt-sm-1 d-block">
                                                <h6 class="mb-1">{{$val->event_title}}</h6>
                                                <span class="clearfix"></span>
                                                <small>{{strip_tags($val->event_description)}}...</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-12 col-lg-12">
                        <div class="mb-4">
                            <div class="card-header border-bottom-0 pt-2 ps-0">
                                <h4 class="card-title">Upcoming Birthday</h4>
                            </div>
                            <ul class="vertical-scroll">
                                @foreach($upcoming_birthdays as $key => $val)
                                <li class="item">
                                    <div class="card p-4 ">
                                        <div class="d-flex">
                                            <img src="{{ url('').'/uploads/passport/'.$val->profile_pic }}" alt="img"
                                                class="avatar avatar-md bradius me-3">
                                            <div class="me-3 mt-0 mt-sm-1 d-block">
                                                <h6 class="mb-1">{{$val->display_name}}</h6>
                                                <span class="clearfix"></span>
                                                <small>Birthday on {{date('d, F, Y', strtotime($val->date_of_birth))}}</small>
                                            </div>
                                            <span class="avatar bg-primary ms-auto bradius mt-1"> <i
                                                    class="feather feather-mail text-white"></i> </span>
                                        </div>
                                    </div>
                                </li>
                               @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-12 col-lg-12">
                        <div class="mb-4">
                            <div class="card-header border-bottom-0 pt-2 ps-0">
                                <h4 class="card-title">Working Anniversary</h4>
                            </div>
                            <ul class="vertical-scroll">
                            @foreach($working_anniversary as $key => $val)
                            <li class="item">
                                    <div class="card p-4 ">
                                        <div class="d-flex">
                                            <img src="{{ url('') . '/uploads/passport/' . $val->profile_pic }}" alt="img"
                                                class="avatar avatar-md bradius me-3">
                                            <div class="me-3 mt-0 mt-sm-1 d-block">
                                                <h6 class="mb-1">{{$val->display_name}}</h6>
                                                <span class="clearfix"></span>
                                                <small>Anniversary on {{date('d, F, Y', strtotime($val->date_of_joining))}}</small>
                                            </div>
                                            <span class="avatar bg-primary ms-auto bradius mt-1"> <i
                                                    class="feather feather-mail text-white"></i> </span>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>


            </div>


        </div>
        <!-- END ROW -->

        <!-- ROW -->
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
                                        class="date fs-20">{{ date("d", strtotime($val->holiday_date)) }}</span>
                                    <span class="month fs-13">{{ date("M", strtotime($val->holiday_date)) }}</span>
                                </span>
                                <div class="me-3 mt-0 mt-sm-1 d-block">
                                    <h6 class="mb-1 font-weight-semibold">{{$val->holiday_name}}</h6>
                                    <span class="clearfix"></span>
                                    <small>{{ date("l", strtotime($val->holiday_date)) }}</small>
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
            
            <div class="col-xl-8 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">Attendance</h3>
                    </div>
                    <div class="table-responsive attendance_table mt-4">
                        <table class="table mb-0 text-nowrap">
                            <thead>
                                <tr>
                                    <th class="text-center">S.No</th>
                                    <th class="text-start">Employee</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">CheckIn</th>
                                    <th class="text-center">CheckOut</th>
                                    <th class="text-center">Hours</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($attendance as $key => $val)
                                <tr class="border-bottom">
                                    <td class="text-center"><span
                                            class="avatar avatar-sm brround">{{ ($attendance->currentpage()-1) * $attendance->perpage() + $key + 1 }}</span>
                                    </td>
                                    <td class="font-weight-semibold fs-14">
                                        {{ \App\Models\User::where(['id' => $val->user_id])->pluck('name')->first() }}
                                    </td>
                                    <td class="text-center"><span class="badge bg-success-transparent">Present</span>
                                    </td>
                                    <td class="text-center">{{ date('h:i A', strtotime($val->login_time)) }}</td>
                                    <td class="text-center">@if($val->logout_time != null)
                                        {{ date('h:i A', strtotime($val->logout_time)) }}
                                        @endif</td>
                                        @php 
                                        $start = $carbon::parse($val->login_time);
                                        $end = $carbon::parse($val->logout_time);
                                        $diff = $start->diff($end)->format('%H:%I:%s');
                                        @endphp
                                    <td class="text-center">{{$diff}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- END ROW -->

    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('backend/js/custom.js') }}"></script>
@stop