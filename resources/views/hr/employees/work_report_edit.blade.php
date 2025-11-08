@extends('layouts.app')
@section('title', 'Work Report Letter')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">
        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Employees Work Report Edit</div>
            </div>

        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" id="offer_letter_edit" action="" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="row">
                                    
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Work Report') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <textarea id="report" name="report" rows="4" cols="100">{{$work_report_details->report ?? ''}}</textarea>
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
        <script src="{{asset('backend/plugins/wysiwyag/jquery.richtext.js')}}"></script>
        <script src="{{asset('backend/js/form-editor.js')}}"></script>
        <script src="{{asset('backend/plugins/multipleselect/multiple-select.js')}}"></script>
		<script src="{{asset('backend/plugins/multipleselect/multi-select.js')}}"></script>

        <script src="{{asset('backend/js/formelementadvnced.js')}}"></script>
		<script src="{{asset('backend/js/form-elements.js')}}"></script>
		<script src="{{asset('backend/js/select2.js')}}"></script>
        <script>
            $('[data-bs-toggle="modaldatepicker"]').datepicker({
                autoHide: true,
                zIndex: 999998,
            dateFormat: 'yy-mm-dd'
            });
        $("#offer_letter_edit").submit(function() {
            event.preventDefault();
            $("#submit").prop('disabled', true);
            $("#submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading....');
            axios.post("{{ route('employee-work-report-edit', $work_report_details->id) }}", new FormData($("#offer_letter_edit")[0])).then(response => {
                var data = response.data;
                if (data.success) notif({msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b> Work Report Submitted Successfully",
                    type: "success"}, setTimeout(function() { location.replace("{{ route('employee-work-report') }}"); }, 3000));
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

<script>
function validate(id, title) {
    swal({
        title: "Are you sure?",
        text: "Are you sure you want to delete this record" + " " + title,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Delete it!",
        closeOnConfirm: false
    }, function() {
        $.ajax({
            type: 'DELETE',
            url: "{{ route('employees-offer-letter-destroy') }}" + '/' + id,
            data: {"_token": "{{ csrf_token() }}",},
            success: function(data) {
                var jso = JSON.stringify(data);
                if (data.success) {
                    swal({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        type: "success",
                    });
                    location.reload();
                }
            }
        });
    });
}
</script>

@stop