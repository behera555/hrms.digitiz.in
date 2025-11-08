@extends('layouts.app')
@section('title', 'Interviews Edit')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Edit Interviews</div>
            </div>

        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" id="interviews_edit" action="" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Requisition ID') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-code"></i>
                                                </div>
                                            </div>
                                                <select name="requisition_id" class="form-control" placeholder="{{ __('Requisition Code') }}">
                                                <option value="">Select Job Title</option>    
                                                @foreach($recruitments as $key => $val)
                                                <option value="{{$val->requisition_code}}" {{($interviews->requisition_id === $val->requisition_code) ? 'selected' : ''}}>{{$val->job_title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Candidate  Name') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                            </div>
                                            <select name="candidate_name" class="form-control" placeholder="{{ __('Candidate  Name') }}">
                                               <option value="">Select Candidate  Name</option> 
                                                @foreach($candidates as $key => $val)
                                                <option value="{{$val->id}}" {{($interviews->candidate_name === $val->id) ? 'selected' : ''}}>{{$val->first_name}} {{$val->last_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Interview Status') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-american-sign-language-interpreting"></i>
                                                </div>
                                            </div>
                                            <select name="interview_status" value="" class="form-control" placeholder="{{ __('Interview Status') }}">
                                               <option value="">Select Interview Status</option> 
                                                <option value="In process" {{($interviews->interview_status === 'In process') ? 'selected' : ''}}>In process</option>
                                                <option value="Completed" {{($interviews->interview_status === 'Completed') ? 'selected' : ''}}>Completed</option>
                                                <option value="On hold" {{($interviews->interview_status === 'On hold') ? 'selected' : ''}}>On hold</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Interviewer') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                            </div>
                                            <select name="interviewer" class="form-control" placeholder="{{ __('Interviewer') }}">
                                               <option value="">Select Interviewer  Name</option> 
                                                @foreach($employees as $key => $val)
                                                <option value="{{$val->emp_id}}"  {{($interviews->interviewer === $val->emp_id) ? 'selected' : ''}}>{{$val->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Interview Type') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-globe"></i>
                                                </div>
                                            </div>
                                            <select name="interview_type" id="interview_type" value="" class="form-control" placeholder="{{ __('Interview Type') }}">
                                               <option value="">Select Interview Type</option> 
                                                <option value="In person" {{($interviews->interview_type === 'In person') ? 'selected' : ''}}>In person</option>
                                                <option value="Phone" {{($interviews->interview_type === 'Phone') ? 'selected' : ''}}>Phone</option>
                                                <option value="video_conference" {{($interviews->interview_type === 'video_conference') ? 'selected' : ''}}>Video conference</option>
                                            </select>
                                        </div>
                                       
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Interview Date') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control fc-datepicker hasDatepicker" name="interview_date" value="{{$interviews->interview_date}}" placeholder="{{ __('Interview Date') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Interview Time') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="feather feather-clock"></i>
                                                </div>
                                            </div><input name="interview_time" value="{{$interviews->interview_time}}" class="form-control timepicker"
                                                placeholder="{{ __('HH:MM AM/PM') }}" type="time">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Interview Name') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-ship"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" value="{{$interviews->interview_name}}" name="interview_name"
                                                placeholder="{{ __('Interview Name') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="video_conference" class="myDiv">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Interview Link') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-link"></i>
                                                </div>
                                            </div><input name="interview_link" value="{{$interviews->interview_link}}" class="form-control timepicker"
                                                placeholder="{{ __('Interview Link') }}" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 col-lg-2">
                                    </div>
                                    <div class="col-md-12 col-lg-8">
                                        <button id="submit" class="btn btn-primary btn-lg" type="submit" name="submit">
                                            Save</button>
                                        <a href="{{ route('interviews-list') }}" class="btn btn-danger btn-lg">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END ROW -->
            </div>
        </div>
        @endsection
        <style>
            .myDiv{
	display:none;
    padding:10px;
    margin-top:20px;
}  
        </style>
        @section('script')
        <script>
$(document).ready(function(){
    $('#interview_type').on('change', function(){
    	var demovalue = $(this).val(); 
        $("div.myDiv").hide();
        $("#"+demovalue).show();
    });
});
</script> 
        <script>
        $('[data-bs-toggle="modaldatepicker"]').datepicker({
            autoHide: true,
            zIndex: 999998
        });
        $("#interviews_edit").submit(function() {
            event.preventDefault();
            $("#submit").prop('disabled', true);
            $("#submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading....');
            axios.post("{{ route('interviews-edit', $interviews->id) }}", new FormData($("#interviews_edit")[0])).then(response => {
                var data = response.data;
                $('#interviews_edit')[0].reset();
                if (data.success) notif({
                    msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b> Interviews Submitted Successfully",
                    type: "success"
                }, setTimeout(function() {
                    location.replace("{{ route('interviews-list') }}");
                }, 3000));
                else {
                    $("#submit").prop('disabled', false);
                     $("#submit").html('Submit');
                    for (var a in data['error']['message']) {
                        notify(null, data['error']['message'][a][0], 'botton left');
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