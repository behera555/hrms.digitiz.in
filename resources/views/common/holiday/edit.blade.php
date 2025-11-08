@extends('layouts.app')
@section('title', 'Edit Holidays')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">{{ __('Edit Holidays') }}</div>
            </div>

        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                    <form method="post" id="holidays_edit" action="" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">{{ __('Select Date') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="feather feather-calendar"></i>
                                            </div>
                                        </div><input class="form-control" name="holiday_date"
                                            data-bs-toggle="modaldatepicker" value="{{$holidays->holiday_date}}" placeholder="MM/DD/YYYY">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">{{ __('Enter Occasion') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-wifi"></i>
                                            </div>
                                        </div> <input name="holiday_name" value="{{$holidays->holiday_name}}" class="form-control"
                                            placeholder="{{ __('Enter Occasion') }}" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-2">
                                </div>
                                <div class="col-md-12 col-lg-8">
                                <button id="submit" class="btn btn-primary btn-lg" type="submit" name="submit"> Save</button>
                                    <a href="{{ route('hr-holiday') }}" class="btn btn-danger btn-lg">Cancel</a>
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
$("#holidays_edit").submit(function() {
    event.preventDefault();
    $("#submit").prop('disabled', true);
    $("#submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading....');
    axios.post("{{ route('edit-holidays',$holidays->id) }}", new FormData($("#holidays_edit")[0])).then(response => {
        var data = response.data;
        $('#holidays_edit')[0].reset();
        if (data.success)  notif({ msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b> Holidays Updated Successfully", type: "success" },setTimeout(function() { location.replace("{{ route('hr-holiday') }}"); }, 3000));
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