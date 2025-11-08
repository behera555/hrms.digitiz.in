@extends('layouts.app')
@php
use Illuminate\Support\Facades\DB;
@endphp
@section('title', 'Employee Relations Add')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!--PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">{{ __('Add Employee Relations') }}</div>
            </div>
        </div>
        <!--END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-xl-12 col-md-12 col-lg-12">
                <div class="panel-body tabs-menu-body hremp-tabs1 p-0">
                    <form method="post" id="employees-relations" action="" enctype="multipart/form-data">
                        <div class="tab-content">
                           <div class="card-body">
                                    <div id="dynamicAddRemove">
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
                                            <option value="{{$val->emp_id}}">{{$val->name}}</option>
                                          @endforeach
                                        </select>
                                        </div>
                                    </div>
                                    @endif
                                                <div class="col-md-3">
                                                    <label class="form-label mb-0 mt-2">{{ __('Relation') }}</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" name="moreFields[0][relation_type]" class="form-control"
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
                                                    <input type="text" name="moreFields[0][gender]" class="form-control"
                                                        placeholder="{{ __('Gender') }}">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label mb-0 mt-2">{{ __('First Name') }}</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" name="moreFields[0][first_name]" class="form-control"
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
                                                    <input type="text" name="moreFields[0][last_name]" class="form-control"
                                                        placeholder="{{ __('Last Name') }}">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label mb-0 mt-2">{{ __('Mobile') }}
                                                    </label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" name="moreFields[0][mobile]" class="form-control"
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
                                                    <input type="text" name="moreFields[0][profession]" class="form-control"
                                                        placeholder="{{ __('Profession') }}">
                                                </div>
                                        </div></div>
                                        <button type="button" name="add" id="add-btn" class="btn btn-primary">Add
                                            More</button>
                                    </div>
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

<script type="text/javascript">
var i = 0;
$("#add-btn").click(function() {
    ++i;
     $("#dynamicAddRemove").append('<div class="form-group"><div class="form-group"><div class="row"><div class="col-md-3"><label class="form-label mb-0 mt-2">{{ __('Relation ') }}</label></div><div class="col-md-3"><input type="text" name="moreFields['+i+'][relation_type]" class="form-control" placeholder="{{ __('Relation') }}"></div><div class="col-md-3"><label class="form-label mb-0 mt-2">{{ __('Gender') }}</label></div><div class="col-md-3"><input type="text" name="moreFields['+i+'][gender]" class="form-control"placeholder="{{ __('Gender') }}"></div></div></div><div class="form-group"><div class="row"><div class="col-md-3"><label class="form-label mb-0 mt-2">{{ __('First Name ') }}</label></div><div class="col-md-3"><input type="text" name="moreFields['+i+'][first_name]" class="form-control" placeholder="{{ __('First Name ') }}"></div><div class="col-md-3"><label class="form-label mb-0 mt-2">{{ __('Last Name ') }}</label></div><div class="col-md-3"><input type="text" name="moreFields['+i+'][last_name]" class="form-control" placeholder="{{ __('Last Name ') }}"></div></div></div><div class="form-group"><div class="row"><div class="col-md-3"><label class="form-label mb-0 mt-2">{{ __('Mobile ') }}</label></div><div class="col-md-3"><input type="text" name="moreFields['+i+'][mobile]" class="form-control" placeholder="{{ __('Mobile ') }}"></div><div class="col-md-3"><label class="form-label mb-0 mt-2">{{ __('Profession ') }}</label></div><div class="col-md-3"><input type="text" name="moreFields['+i+'][profession]" class="form-control" placeholder="{{ __('Profession ') }}"></div></div></div><div class="form-group"></div><button type="button" class="btn btn-danger remove-tr">Remove</button></div>');
});
$(document).on('click', '.remove-tr', function() {
    $(this).parents('.form-group').remove();
});
</script>

<script>
$("#employees-relations").submit(function() {
    event.preventDefault();
    $("#submit").prop('disabled', true);
    $("#submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading....');
    @if(auth()->user()->type == 'hr')
    axios.post("{{ route('employees-relations-details-add') }}", new FormData($("#employees-relations")[0])).then(response => {
    @else
     axios.post("{{ route('relations-details-add') }}", new FormData($("#employees-relations")[0])).then(response => {
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