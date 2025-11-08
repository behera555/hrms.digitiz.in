@extends('layouts.app')
@section('title', 'Employee  Education Add')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Add Attendance</div>
            </div>

        </div>

        <!-- END ROW -->
        <div class="row">
            <div class="col-xl-12 col-md-12 col-lg-12">
                <div class="panel-body tabs-menu-body hremp-tabs1 p-0">
                    <form method="post" id="add-attendance" action="" enctype="multipart/form-data">
                        <div class="card-body">
                        <div id="dynamicAddRemove_Education">
                                    <div class="form-group">
                                        <div class="row">
                                        <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Employee  Name') }} <b style="color: red;">*</b> :</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <select class="form-control select2-show-search custom-select" name="user_id">
                                            <option label="Choose one"></option>
                                            @foreach($employees as $key => $val)
                                            <option value="{{$val->id}}">{{$val->name}}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                    </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Login Date') }} <b style="color: red;">*</b> :</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="login_date" class="form-control"
                                                    placeholder="{{ __('Login Date') }}">
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                        <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Login Time') }} <b style="color: red;">*</b> :</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="login_time" class="form-control"
                                                    placeholder="{{ __('Login Time') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Logout Time') }} <b style="color: red;">*</b> :</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="logout_time" class="form-control"
                                                    placeholder="{{ __('Logout Time') }}">
                                            </div>
                                            
                                        </div>
                                    </div>

                                    
                                </div>
                        </div>
                        <div class="card-footer text-end">
                            <button id="submit" class="btn btn-primary" type="submit" name="submit"> Save</button>
                            <a href="{{route('employees-attendance-list')}}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
$("#add-attendance").submit(function() {
    event.preventDefault();
    $("#submit").prop('disabled', true);
    $("#submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading....');
    axios.post("{{ route('add-attendance') }}", new FormData($("#add-attendance")[0])).then(
        response => {
            var data = response.data;
            if (data.success) 
            notif({ msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b>Employees Attendance Submitted Successfully", type: "success" }, setTimeout(function() { location.replace("{{ route('employees-attendance-list') }}"); }, 3000));
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