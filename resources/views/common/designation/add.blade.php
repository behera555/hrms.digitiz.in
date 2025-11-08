@extends('layouts.app')
@section('title', 'Designation Add')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Add Designation</div>
            </div>

        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" id="designation_add" action="" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="form-label"> Designation</label>
                                    <input type="text" class="form-control" name="designtion_name"
                                        placeholder="Designation" value="">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" onclick="javascript:window.location.reload()"
                                    class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                                <button id="submit" class="btn btn-primary" type="submit" name="update">Submit</button>
                            </div>
                            </from>
                    </div>
                </div>
                <!-- END ROW -->
            </div>
        </div>
        @endsection
        @section('script')
        <script>
        $("#designation_add").submit(function() {
            event.preventDefault();
            $("#submit").prop('disabled', true);
            $("#submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading....');
            axios.post("{{ route('designation-post') }}", new FormData($("#designation_add")[0])).then(
                response => {
                    var data = response.data;
                    $('#designation_add')[0].reset();
                    if (data.success) notif({msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b>Designation Submitted Successfully",type: "success"}, setTimeout(function() {
                        location.replace("{{ route('designation') }}");
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