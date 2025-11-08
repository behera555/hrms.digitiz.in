@extends('layouts.app')
@section('title', 'Department Edit')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Edit Department</div>
            </div>

        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                    <form method="post" id="department-edit" action="" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">{{ __('Edit Department') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-code"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="department_name" value="{{ $department->department_name }}"
                                            placeholder="{{ __('Department') }}">
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
                                    <a href="{{ route('hr-department') }}" class="btn btn-danger btn-lg">Cancel</a>
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
    $("#department-edit").submit(function() {
        event.preventDefault();
         $("#submit").prop('disabled', true);
         $("#submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading....');
        axios.post("{{ route('department-edit', $department->id) }}", new FormData($("#department-edit")[0])).then(response => {
            var data = response.data;
            $('#department-edit')[0].reset();
            if (data.success) notif({ msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b>Department Updated Successfully", type: "success" },setTimeout(function() { location.replace("{{ route('hr-department') }}"); }, 3000));
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