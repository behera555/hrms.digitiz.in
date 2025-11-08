@extends('layouts.app')

@section('title', ' Attendance')
@section('content')
<div class="app-content main-content">
					<div class="side-app main-container">
						
                        <!-- PAGE HEADER -->
                        <div class="page-header d-xl-flex d-block">
							<div class="page-leftheader">
								<div class="page-title">Attendance</div>
							</div>
						</div>
						<!-- END PAGE HEADER -->

						<!-- ROW -->
						<div class="row">
							<div class="col-xl-3 col-md-12 col-lg-12">
								<div class="card">
									<div class="card-body">
										<div class="countdowntimer mt-0">
											<span id="clocktimer2" class="border-0"></span>
											<label class="form-label">Current Time</label>
											<label class="form-label">Worked Hours: {{$no_of_hours->total;}}</label>	
										</div>
										@if(empty($attendance))
										<form method="post" id="attendance" action="" enctype="multipart/form-data">
										<input type="hidden" class="form-control" name="user_id" value="{{auth()->user()->id}}"
                                            placeholder="{{ __('Add Department') }}">
										<div class="btn-list text-center mt-5">
										   <button type="submit" name="submit" id="submit" class="btn ripple btn-primary">Clock in</button>
											<!-- <a  href="javascript:void(0);" class="btn ripple btn-primary disabled">Clock in</a> -->
											<a  href="javascript:void(0);" class="btn ripple btn-primary disabled">Clock Out</a>
										</div>
										</form>
										@elseif(empty($attendance->logout_time))
										<form method="post" id="attendance_update" action="" enctype="multipart/form-data">
										<input type="hidden" class="form-control" name="user_id" value="{{auth()->user()->id}}"
                                            placeholder="{{ __('Add Department') }}">
										<div class="btn-list text-center mt-5">
										<a  href="javascript:void(0);" class="btn ripple btn-primary disabled">Clock in</a>
										   <button type="submit" name="submit" id="submit" class="btn ripple btn-primary">Clock Out</button>
										</div>
										</form>
										@endif
										
									</div>
								</div>
							</div>
							<div class="col-xl-9 col-md-12 col-lg-12">
								<div class="card">
									
								</div>
							</div>
						</div>
						<!-- END ROW -->

						<!-- ROW -->
						<div class="row">
							<div class="col-xl-12 col-md-12 col-lg-12">
								<div class="card">
									<div class="card-header  border-0">
										<h4 class="card-title">Attendance Overview</h4>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="emp-attendance">
												<thead>
													<tr>
														<th class="border-bottom-0">Date</th>
														<th class="border-bottom-0">Status</th>
														<th class="border-bottom-0">Clock-In</th>
														<th class="border-bottom-0">Clock-Out</th>
														<th class="border-bottom-0">Hours</th>
													</tr>
												</thead>
												<tbody>
													@foreach($attendance_all as $key => $val)
													<tr>
														<td>{{$val->login_date}}</td>
														<td><span class="badge badge-success">Present</span></td>
														<td>{{$val->login_time}}</td>
														<td>{{$val->logout_time}}</td>
														@php
														$no_houres = \App\Models\Attendance::where('login_date', $val->login_date)->where('user_id', auth()->user()->id)->selectRaw("SEC_TO_TIME(sum(TIME_TO_SEC(TIMEDIFF(logout_time,login_time) )) ) as 'total'")->first()
														@endphp
														<td>{{$no_houres->total}}</td>
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
				</div><!-- end app-content-->

@endsection
@section('script')
<script src="{{asset('backend/plugins/jQuery-countdowntimer/jQuery.countdownTimer.js')}}"></script>
<script src="{{asset('backend/js/employee/emp-attendance.js')}}"></script>
<script>
    $("#attendance").submit(function() {
        event.preventDefault();
        $("#submit").prop('disabled', true);
        $("#submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading....');
		@if(auth()->user()->type == 'hr')
        axios.post("{{ route('attendance') }}", new FormData($("#attendance")[0])).then(response => {
		@else
		 axios.post("{{ route('employee-attendance') }}", new FormData($("#attendance")[0])).then(response => {
	    @endif
            var data = response.data;
            $('#attendance')[0].reset();
			@if(auth()->user()->type == 'hr')
            if (data.success) notif({ msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b>Attendance Submitted Successfully", type: "success" },setTimeout(function() { location.replace("{{ route('attendance') }}"); }, 3000));
            @else
			if (data.success) notif({ msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b>Attendance Submitted Successfully", type: "success" },setTimeout(function() { location.replace("{{ route('employee-attendance') }}"); }, 3000));
			@endif
			else {
			    $("#submit").prop('disabled', false);
                $("#submit").html('Submit');
				for (var a in data['error']['message']) { notify(null, data['error']['message'][a][0], 'botton left');
                    if (a == 'success' | a == 'error') notify(null, data['error']['message'][a][0],
                        'botton left');
                }
            }
        }).catch(error => {
            $("#submit").prop('disabled', false);
            $("#submit").html('Submit');
            notify(null, 'Something went wrong', 'top right');
            console.log(error);
        });
    });
</script>
<script>
    $("#attendance_update").submit(function() {
        event.preventDefault();
        $("#submit").prop('disabled', true);
        $("#submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading....');
		@if(auth()->user()->type == 'hr')
        axios.post("{{ route('attendance-edit') }}", new FormData($("#attendance_update")[0])).then(response => {
		@else
		axios.post("{{ route('employee-attendance-edit') }}", new FormData($("#attendance_update")[0])).then(response => {
	    @endif
            var data = response.data;
            $('#attendance_update')[0].reset();
			@if(auth()->user()->type == 'hr')
            if (data.success) notif({ msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b>Attendance Submitted Successfully", type: "success" },setTimeout(function() { location.replace("{{ route('attendance') }}"); }, 3000));
            @else
			if (data.success) notif({ msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b>Attendance Submitted Successfully", type: "success" },setTimeout(function() { location.replace("{{ route('employee-attendance') }}"); }, 3000));
			@endif
			else {
			    $("#submit").prop('disabled', false);
                $("#submit").html('Submit');
				for (var a in data['error']['message']) { notify(null, data['error']['message'][a][0], 'botton left');
                    if (a == 'success' | a == 'error') notify(null, data['error']['message'][a][0],
                        'botton left');
                }
            }
        }).catch(error => {
            $("#submit").prop('disabled', false);
            $("#submit").html('Submit');
            notify(null, 'Something went wrong', 'top right');
            console.log(error);
        });
    });
</script>
@stop


