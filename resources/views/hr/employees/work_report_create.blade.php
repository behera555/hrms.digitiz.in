@extends('layouts.app')
@section('title', 'Add Work Report')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!--PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">{{ __('Add Work Report') }}</div>
            </div>
        </div>
        <!--END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-xl-12 col-md-12 col-lg-12">
                <div class="panel-body tabs-menu-body hremp-tabs1 p-0">
                    <form method="post" id="work-report-add" action="" enctype="multipart/form-data">
                        <div class="tab-content">
                           <div class="card-body">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label mb-0 mt-2">{{ __('Work Report') }}</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <textarea id="report" name="report" rows="4" cols="100"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                            <div class="card-footer text-end">
                                <button id="submit" class="btn btn-primary" type="submit" name="submit"> Save</button>
                                <a href="{{route('employee-work-report')}}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- END ROW -->

    </div>
</div>
@endsection
@section('script')
<script>
$("#work-report-add").submit(function() {
    event.preventDefault();
     $("#submit").prop('disabled', true);
    $("#submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading....');
    axios.post("{{ route('employee-work-report-add') }}", new FormData($("#work-report-add")[0])).then(response => {
        var data = response.data;
        if (data.success) notif({
            msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b>Work Report  Submitted Successfully",
            type: "success"
        }, setTimeout(function() {
            location.replace("{{ route('employee-work-report') }}");
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
                type:'DELETE',
                url: "{{ route('employees_education_destroy') }}" + '/' + id,
                data:{"_token": "{{ csrf_token() }}",},
                success: function (data) {
                    var jso = JSON.stringify(data); 
                    if (data.success){
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