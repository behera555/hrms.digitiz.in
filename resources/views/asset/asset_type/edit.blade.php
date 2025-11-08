@extends('layouts.app')
@section('title', 'Edit Asset Type')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">{{ __('Edit Asset Type') }}</div>
            </div>

        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                    <form method="post" id="asset_types_edit" action="" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">{{ __('Asset Type') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-code"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="asset_types_name" value="{{$asset_type->asset_types_name}}"
                                            placeholder="{{ __('Add Asset Type') }}">
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
                                    <a href="{{ route('asset-type-list') }}" class="btn btn-danger btn-lg">Cancel</a>
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
    $("#asset_types_edit").submit(function() {
        event.preventDefault();
             $("#submit").prop('disabled', true);
             $("#submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading....');
        axios.post("{{ route('asset-type-edit', $asset_type->id) }}", new FormData($("#asset_types_edit")[0])).then(response => {
            var data = response.data;
            $('#asset_types_edit')[0].reset();
            if (data.success) notif({ msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b>Asset Types Updated Successfully", type: "success" },setTimeout(function() { location.replace("{{ route('asset-type-list') }}"); }, 3000));
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