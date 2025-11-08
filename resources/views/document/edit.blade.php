@extends('layouts.app')
@section('title', 'Edit Document Management')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Edit Documents</div>
            </div>

        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                    <form method="post" id="edit_document" action="" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">{{ __('Document Name') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-code"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="document_name" value="{{$documents->document_name}}"
                                            placeholder="{{ __('Document Name') }}" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">{{ __('Documents Upload') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-money"></i>
                                            </div>
                                        </div><input name="document_upload" value="" class="form-control"
                                            placeholder="{{ __('Documents Upload') }}" type="file">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">{{ __('View Documents ') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">

                                    <a href="{{url('uploads/document/'.$documents->document_upload)}}" class="btn btn-primary btn-icon btn-sm" target=”_blank”><i class="feather feather-eye"></i></a>
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
                                    <a href="{{ route('document-management-list') }}" class="btn btn-danger btn-lg">Cancel</a>
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

$("#edit_document").submit(function() {
    event.preventDefault();
     $("#submit").prop('disabled', true);
    $("#submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading....');
    axios.post("{{ route('document-management-edit', $documents->id) }}", new FormData($("#edit_document")[0])).then(response => {
        var data = response.data;
        $('#edit_document')[0].reset();
        if (data.success)  notif({ msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b> Document Submitted Successfully", type: "success" },setTimeout(function() { location.replace("{{ route('document-management-list') }}"); }, 3000));
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
