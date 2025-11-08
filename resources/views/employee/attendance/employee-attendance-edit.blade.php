@extends('layouts.app')
@section('title', 'Attendance Edit')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Edit Attendance</div>
            </div>

        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" id="employees-attendance-edit" action="" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="row">
                                
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Employee Name') }}  <b style="color: red;">*</b> :</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                            </div><b class="form-control"> {{(\App\Models\User::where(['id' => $attendance->user_id])->pluck('name')->first())}}</b>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Login Date') }}  <b style="color: red;">*</b> :</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class='fa fa-calendar'></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="login_date"
                                                value="{{$attendance->login_date}}" placeholder="{{ __('Login Date') }}">
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Login Time') }}  <b style="color: red;">*</b> :</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class='fa fa-clock-o'></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="login_time"
                                                value="{{$attendance->login_time}}" placeholder="{{ __('Login Time') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Logout Time') }}  <b style="color: red;">*</b> :</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                   <i class='fa fa-clock-o'></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="logout_time"
                                                value="{{$attendance->logout_time}}" placeholder="{{ __('Logout Time') }}">
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
                                        <a href="{{ route('employees-attendance-list') }}"
                                            class="btn btn-danger btn-lg">Cancel</a>
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
        @section('script')
        <script>
        $('[data-bs-toggle="modaldatepicker"]').datepicker({
            autoHide: true,
            zIndex: 999998
        });
        $("#employees-attendance-edit").submit(function() {
            event.preventDefault();
              $("#submit").prop('disabled', true);
              $("#submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading....');
            axios.post("{{ route('employees-attendance-edit', $attendance->id) }}", new FormData($("#employees-attendance-edit")[
                0])).then(response => {
                var data = response.data;
                $('#employees-attendance-edit')[0].reset();
                if (data.success) notif({
                    msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b> Attendance Updated Successfully",
                    type: "success"
                }, setTimeout(function() {
                    location.replace("{{ route('employees-attendance-list') }}");
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