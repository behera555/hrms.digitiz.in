@extends('layouts.app')
@section('title', 'Employee Leave List')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Apply Leaves</div>
            </div>
        </div>
        <!--END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-xl-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header  border-0">
                        <h4 class="card-title">Apply Leaves</h4>
                    </div>
                    <form method="post" id="apply_leave" action="" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="leave-types">
                                <div class="form-group">
                                    <label class="form-label">Leaves Dates</label>
                                    <select name="leaves_dates" class="form-control custom-select select2"
                                        id="daterange-categories">
                                        <option value="single">Single Leaves</option>
                                        <option value="multiple">Multiple Leaves</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Select available leave types</label>
                                    <select name="leave_balance" class="form-control custom-select select2">
                                    <option value="">Select Leave Type</option>    
                                    <option value="{{$leave_balance->leave_balance ?? 0}}">Paid Leave ({{$leave_balance->leave_balance ?? 0}} days balance)</option>
                                        <option value="Unpaid_Leave"> Unpaid Leave (infinite balance)</option>
                                    </select>
                                </div>
                                <div class="leave-content active" id="single">
                                    <div class="form-group">
                                        <label class="form-label">Date Range:</label>
                                        <div class="input-group">
                                            <input type="text" name="single_start_date" id="single_start_date" class="form-control fc-datepicker"
                                                placeholder="select dates" />
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <i class="bx bx-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex ms-lg-4">
                                        <label class="custom-control custom-radio">
                                            <input type="radio" name="day_type" id="day_type" value="Full_Day"
                                                class="custom-control-input" name="example-radios" value="option1"
                                                >
                                            <span class="custom-control-label">Full Day</span>
                                        </label>
                                        <label class="custom-control custom-radio">
                                            <input type="radio" name="day_type" id="day_type" value="First_Half"
                                                class="custom-control-input" name="example-radios" value="option2">
                                            <span class="custom-control-label">First Half</span>
                                        </label>
                                        <label class="custom-control custom-radio">
                                            <input type="radio" name="day_type" id="day_type" value="Second_Half"
                                                class="custom-control-input" name="example-radios" value="option2">
                                            <span class="custom-control-label">Second
                                                Half</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="leave-content" id="multiple">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Start Date:</label>
                                                <div class="input-group">
                                                    <input type="text" name="start_date" id="start_date" class="form-control fc-datepicker"
                                                        placeholder="select dates" />
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <i class="bx bx-calendar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">End Date:</label>
                                                <div class="input-group">
                                                    <input type="text" name="end_date" id="end_date" class="form-control fc-datepicker"
                                                        placeholder="select dates"/>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <i class="bx bx-calendar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Reason:</label>
                                    <textarea class="form-control" name="reason" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex">
                                <!--<div>-->
                                <!--    <label class="mb-0 font-weight-semibold text-dark">Selected Days:</label>-->
                                <!--    <span class="badge badge-danger badge-pill ms-2" id="result"></span>-->
                                <!--</div>-->
                                <div class="ms-auto">
                                    <button type="submit" class="btn btn-primary my-1" id="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--<div class="col-xl-6 col-md-12 col-lg-12">-->
            <!--    <div class="card">-->
            <!--        <div class="card-header  border-0">-->
            <!--            <h4 class="card-title">Leaves Overview</h4>-->
            <!--        </div>-->
            <!--        <div class="card-body">-->
            <!--            <div id="leavesoverview" class="mx-auto pt-2"></div>-->
            <!--            <div class="row pt-4 mx-auto text-center">-->
            <!--                <div class="col-lg-9 col-md-12 mx-auto d-block">-->
            <!--                    <div class="row">-->
            <!--                        <div class="col-md-6">-->
            <!--                            <div class="d-flex font-weight-semibold">-->
            <!--                                <span class="dot-label bg-primary me-2 my-auto"></span>Paid Leaves-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                        <div class="col-md-6 mt-3 mt-md-0">-->
            <!--                            <div class="d-flex font-weight-semibold">-->
            <!--                                <span class="dot-label badge-danger me-2 my-auto"></span>Unpaid Leaves-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
        </div>
        <!-- END ROW -->

    </div>
</div><!-- end app-content-->
@endsection
@section('script')
<script src="{{asset('backend/plugins/moment/moment.js')}}"></script>
<script src="{{asset('backend/plugins/pg-calendar-master/pignose.calendar.full.min.js')}}"></script>
<script src="{{asset('backend/plugins/daterangepicker/moment.min.js')}}"></script>
<script src="{{asset('backend/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('backend/js/employee/emp-leaves.js')}}"></script>

<script>
$("#btn").on('click', function(e) {
	var fromDate = $('#start_date').val(), 
  		toDate = $('#end_date').val(), 
		from, to, druation;
  
	from = moment(fromDate, 'DD-MM-YYYY'); 
	to = moment(toDate, 'DD-MM-YYYY'); 
	
	/* using diff */
	duration = to.diff(from, 'days')
	
	/* show the result */
	$('#result').text(duration + ' days');
});



$("#apply_leave").submit(function() {
    event.preventDefault();
    $("#submit").prop('disabled', true);
    $("#submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading....');
    @if(auth()->user()->type == 'hr')
    axios.post("{{ route('apply-leaves-post') }}", new FormData($("#apply_leave")[0])).then(
    @else
    axios.post("{{ route('employee-apply-leaves-post') }}", new FormData($("#apply_leave")[0])).then(
    @endif
    response => {
        var data = response.data;
        //$('#apply_leave')[0].reset();
        if (data.success) notif({
            msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b> Add Leave Submitted Successfully",
            type: "success"
        }, setTimeout(function() {
            @if(auth()->user()->type == 'hr')
            location.replace("{{ route('leaves') }}");
            @else
            location.replace("{{ route('employee-apply-leaves-list') }}");
            @endif
        }, 3000));
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