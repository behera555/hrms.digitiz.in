    @extends('layouts.app')
@php
use Illuminate\Support\Facades\DB;
@endphp
@section('title', 'Employee Relations Edit')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!--PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">{{ __('Edit Employee Relations') }}</div>
            </div>
        </div>
        <!--END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-xl-12 col-md-12 col-lg-12">
                <div class="panel-body tabs-menu-body hremp-tabs1 p-0">
                    <form method="post" id="employees-relations-edit" action="" enctype="multipart/form-data">
                        <div class="tab-content">
                           <div class="card-body">
                                   
                                        <div class="form-group">
                                            <div class="row">
                                                @if(auth()->user()->type == 'hr')
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Employee  Name') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                                <select class="form-control select2-show-search custom-select" name="emp_id">
                                            <option label="Choose one"></option>
                                            @foreach($employees as $key => $val)
                                            <option value="{{$val->emp_id}}" {{ $val->emp_id == $employees_relations_details->emp_id ? 'selected' : '' }}>{{$val->name}}</option>
                                          @endforeach
                                        </select>
                                        </div>
                                    </div>
                                    @else
                                     <div class="col-md-3">
                                                    <label class="form-label mb-0 mt-2"></label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="hidden" name="emp_id" value="{{$employees_relations_details->emp_id}}" class="form-control"
                                                        placeholder="{{ __('Relation') }}">
                                                </div>
                                    @endif
                                                <div class="col-md-3">
                                                    <label class="form-label mb-0 mt-2">{{ __('Relation') }}</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" name="relation_type" value="{{$employees_relations_details->relation_type}}" class="form-control"
                                                        placeholder="{{ __('Relation') }}">
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label mb-0 mt-2">{{ __('Gender') }}</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" name="gender" value="{{$employees_relations_details->gender}}" class="form-control"
                                                        placeholder="{{ __('Gender') }}">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label mb-0 mt-2">{{ __('First Name') }}</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" name="first_name" value="{{$employees_relations_details->first_name}}" class="form-control"
                                                        placeholder="{{ __('First Name') }}">
                                                </div>

                                               
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                 <div class="col-md-3">
                                                    <label class="form-label mb-0 mt-2">{{ __('Last Name') }}

                                                    </label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" name="last_name" value="{{$employees_relations_details->last_name}}" class="form-control"
                                                        placeholder="{{ __('Last Name') }}">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label mb-0 mt-2">{{ __('Mobile') }}
                                                    </label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" name="mobile" value="{{$employees_relations_details->mobile}}" class="form-control"
                                                        placeholder="{{ __('Mobile') }}">
                                                </div>
                                                
                                            </div></div>
                                            <div class="form-group">
                                            <div class="row">
                                            <div class="col-md-3">
                                                    <label class="form-label mb-0 mt-2">{{ __('Profession') }}

                                                    </label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" name="profession" value="{{$employees_relations_details->profession}}" class="form-control"
                                                        placeholder="{{ __('Profession') }}">
                                                </div>
                                        </div></div>
                                    </div>
                            
                            <div class="card-footer text-end">
                                <button id="submit" class="btn btn-primary" type="submit" name="submit"> Save</button>
                                @if(auth()->user()->type == 'hr')
                                <a href="{{route('employees-relations-details-list')}}" class="btn btn-danger">Cancel</a>
                                 @else
                                <a href="{{route('relations-details-list')}}" class="btn btn-danger">Cancel</a>
                                @endif
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
$("#employees-relations-edit").submit(function() {
    event.preventDefault();
    $("#submit").prop('disabled', true);
    $("#submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading....');
    @if(auth()->user()->type == 'hr')
    axios.post("{{ route('employees-relations-details-edit', $employees_relations_details->id) }}", new FormData($("#employees-relations-edit")[0])).then(response => {
        @else
    axios.post("{{ route('relations-details-edit', $employees_relations_details->id) }}", new FormData($("#employees-relations-edit")[0])).then(response => {
        @endif
        var data = response.data;
         @if(auth()->user()->type == 'hr')
        if (data.success) notif({
            msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b>Employees Relations  Submitted Successfully",
            type: "success"
        }, setTimeout(function() {
            location.replace("{{ route('employees-relations-details-list') }}");
        }, 3000));
         @else
          if (data.success) notif({
            msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b>Relations  Submitted Successfully",
            type: "success"
        }, setTimeout(function() {
            location.replace("{{ route('relations-details-list') }}");
        }, 3000));
          @endif
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