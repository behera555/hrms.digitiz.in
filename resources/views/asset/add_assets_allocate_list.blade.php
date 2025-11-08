@extends('layouts.app')
@section('title', 'Add Asset Allocate')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">{{ __('Add Asset Allocate') }}</div>
            </div>

        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" id="assets_allocate_post" action="" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Asset Name') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-code"></i>
                                                </div>
                                            </div>
                                            <select class="form-control select2-show-search custom-select"
                                                        name="asset_name">
                                                        <option label="Choose one"></option>
                                                        @foreach($assets_allocate_list as $key => $val)
                                                        <option value="{{$val->asset_name}}">{{$val->asset_name}}</option>
                                                        @endforeach
                                                    </select>
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Employee Name') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-code"></i>
                                                </div>
                                            </div>
                                                <select class="form-control select2-show-search custom-select"
                                                        name="employee_name">
                                                        <option label="Choose one"></option>
                                                        @foreach($employees_list as $key => $val)
                                                        <option value="{{$val->emp_id}}">{{$val->display_name}}</option>
                                                        @endforeach
                                                    </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Allocate Date ') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control fc-datepicker" name="allocate_date" 
                                                placeholder="{{ __('Allocate Date') }}">
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
                                        <a href="{{ route('assets-allocate-to-list') }}"
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
        $("#assets_allocate_post").submit(function() {
            event.preventDefault();
             $("#submit").prop('disabled', true);
             $("#submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading....');
            axios.post("{{ route('assets-allocate-to-add') }}", new FormData($("#assets_allocate_post")[0])).then(
                response => {
                    var data = response.data;
                    $('#assets_allocate_post')[0].reset();
                    if (data.success) notif({
                        msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b>Assets Allocate Submitted Successfully",
                        type: "success"
                    }, setTimeout(function() {
                        location.replace("{{ route('assets-allocate-to-list') }}");
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