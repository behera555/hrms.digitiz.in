@extends('layouts.app')
@section('title', 'Edit Leave Type List')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Edit Leave Settings</div>
            </div>
        </div>
        <!-- END PAGE HEADER -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" id="edit-leave" action="" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Type Of Leaves') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-code"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="type_of_leaves" value="{{$leaves->type_of_leaves}}"
                                                placeholder="{{ __('Type Of Leaves') }}">
                                        </div>
                                        <input type="hidden" class="form-control" name="id" value="{{$leaves->id}}"
                                                placeholder="{{ __('Type Of Leaves') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Number Of Days') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-briefcase"></i>
                                                </div>
                                            </div><input name="number_of_days" value="{{$leaves->number_of_days}}" class="form-control"
                                                placeholder="{{ __('Number Of Days') }}" type="text">
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
                                        <a href="{{ route('leaves') }}" class="btn btn-danger btn-lg">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END ROW -->
            </div>
        </div>

    </div>
</div><!-- end app-content-->
@endsection
@section('script')
        <script>
$("#edit-leave").submit(function() {
    event.preventDefault();
    axios.post("{{ route('edit-leaves', $leaves->id) }}", new FormData($("#edit-leave")[0])).then(response => {
        var data = response.data;
        $('#edit-leave')[0].reset();
        if (data.success)  notif({ msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b> Update Leave Submitted Successfully", type: "success" },setTimeout(function() { location.replace("{{ route('leaves') }}"); }, 3000));
        else {
            for (var a in data['error']['message']) {
                notify(null, data['error']['message'][a][0], 'botton left');
                if (a == 'success' | a == 'error') notify(null, data['error']['message'][a][0],
                    'botton left');
            }
        }
    }).catch(error => {
        console.log(error);
    });
});
</script>
        @stop