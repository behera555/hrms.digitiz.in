@extends('layouts.app')
@php
use Illuminate\Support\Facades\DB;
@endphp
@section('title', 'Employee PF Add')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!--PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">{{ __('Add Employee PF') }}</div>
            </div>
        </div>
        <!--END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-xl-12 col-md-12 col-lg-12">
                <div class="panel-body tabs-menu-body hremp-tabs1 p-0">
                    <form method="post" id="employees-pf" action="" enctype="multipart/form-data">
                        <div class="tab-content">
                           <div class="card-body">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Employee  Name') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                                <select class="form-control select2-show-search custom-select" name="emp_id">
                                            <option label="Choose one"></option>
                                            @foreach($employees as $key => $val)
                                            <option value="{{$val->emp_id}}">{{$val->name}}</option>
                                          @endforeach
                                        </select>
                                        </div>
                                    </div>
                                                <div class="col-md-3">
                                                    <label class="form-label mb-0 mt-2">{{ __('PF Employee') }}</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" name="pf_employee" class="form-control"
                                                        placeholder="{{ __('PF Employee') }}">
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label mb-0 mt-2">{{ __('PF  Employer') }}</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" name="pf_employer" class="form-control"
                                                        placeholder="{{ __('PF  Employer') }}">
                                                </div>
                                               
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            <div class="card-footer text-end">
                                <button id="submit" class="btn btn-primary" type="submit" name="submit"> Save</button>
                                <a href="{{route('employees-relations-details-list')}}" class="btn btn-danger">Cancel</a>
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
<script src="{{asset('backend/plugins/multipleselect/multiple-select.js')}}"></script>
<script src="{{asset('backend/plugins/multipleselect/multi-select.js')}}"></script>
<script src="{{asset('backend/js/formelementadvnced.js')}}"></script>
<script src="{{asset('backend/js/form-elements.js')}}"></script>
<script src="{{asset('backend/js/select2.js')}}"></script>


<script>
$("#employees-pf").submit(function() {
    event.preventDefault();
     $("#submit").prop('disabled', true);
    $("#submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading....');
    axios.post("{{ route('employees-pf-details-add') }}", new FormData($("#employees-pf")[0])).then(response => {
        var data = response.data;
        if (data.success) notif({
            msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b>Employees PF  Submitted Successfully",
            type: "success"
        }, setTimeout(function() {
            location.replace("{{ route('employees-pf-details-list') }}");
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
                url: "{{ route('destroy') }}" + '/' + id,
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