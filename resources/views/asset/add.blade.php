@extends('layouts.app')
@section('title', 'Asset Type')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">{{ __('Add Asset Type') }}</div>
            </div>

        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" id="assets_post" action="" enctype="multipart/form-data">
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
                                            <input type="text" class="form-control" name="asset_name" value=""
                                                placeholder="{{ __('Asset Name') }}">
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Asset Type') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-code"></i>
                                                </div>
                                            </div>
                                                <select class="form-control select2-show-search custom-select"
                                                        name="asset_type">
                                                        <option label="Choose one"></option>
                                                        @foreach($asset_type as $key => $val)
                                                        <option value="{{$val->asset_types_name}}">{{$val->asset_types_name}}</option>
                                                        @endforeach
                                                    </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Asset Bill ') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-code"></i>
                                                </div>
                                            </div>
                                            <input type="file" class="form-control" name="asset_picture"
                                                placeholder="{{ __('Asset Type') }}">
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Serial Number') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-code"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="serial_number" value=""
                                                placeholder="{{ __('Serial Number') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Value') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-code"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="value" value=""
                                                placeholder="{{ __('Value') }}">
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Description') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-code"></i>
                                                </div>
                                            </div>
                                            <textarea type="text" class="form-control" name="description" value=""
                                                placeholder="{{ __('Description') }}"></textarea>
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
                                        <a href="{{ route('assets-list') }}"
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
        $("#assets_post").submit(function() {
            event.preventDefault();
            $("#submit").prop('disabled', true);
            $("#submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading....');
            axios.post("{{ route('assets-add') }}", new FormData($("#assets_post")[0])).then(
                response => {
                    var data = response.data;
                    $('#assets_post')[0].reset();
                    if (data.success) notif({
                        msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b>Assets Submitted Successfully",
                        type: "success"
                    }, setTimeout(function() {
                        location.replace("{{ route('assets-list') }}");
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