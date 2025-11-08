@extends('layouts.app')
@section('title', 'Employee Experience Edit')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Edit Experience</div>
            </div>

        </div>

        <!-- END ROW -->
        <div class="row">
            <div class="col-xl-12 col-md-12 col-lg-12">
                <div class="panel-body tabs-menu-body hremp-tabs1 p-0">
                    <form method="post" id="employees-experience-edit" action="" enctype="multipart/form-data">
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
                                            <option value="{{$val->emp_id}}" {{ $val->emp_id == $employees_previous_experience_details->emp_id ? 'selected' : '' }}>{{$val->name}}</option>
                                          @endforeach
                                        </select>
                                        </div>
                                    </div>
                                    @else
                                    <div class="col-md-3">
                                            <label class="form-label mb-0 mt-2"></label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="hidden" name="company_name" value="{{$employees_previous_experience_details->emp_id}}"class="form-control"
                                                placeholder="{{ __('Company Name') }}">
                                        </div>
                     
                                    @endif
                                        <div class="col-md-3">
                                            <label class="form-label mb-0 mt-2">{{ __('Company Name') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="company_name" value="{{$employees_previous_experience_details->company_name}}"class="form-control"
                                                placeholder="{{ __('Company Name') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                    <div class="col-md-3">
                                            <label class="form-label mb-0 mt-2">{{ __('Job Title') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="job_title" value="{{$employees_previous_experience_details->job_title}}" class="form-control"
                                                placeholder="{{ __('Job Title') }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label mb-0 mt-2">{{ __('Date of Joining') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="date_of_joining" value="{{$employees_previous_experience_details->date_of_joining}}"
                                                class="form-control" data-bs-toggle="modaldatepicker" placeholder="{{ __('Date of Joining') }}">
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                    <div class="col-md-3">
                                            <label class="form-label mb-0 mt-2">{{ __('Date of Relieving') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="date_of_relieving" value="{{$employees_previous_experience_details->date_of_relieving}}"
                                                class="form-control" data-bs-toggle="modaldatepicker" placeholder="{{ __('Date of Relieving') }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label mb-0 mt-2">{{ __('Location') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="location" value="{{$employees_previous_experience_details->location}}" class="form-control"
                                                placeholder="{{ __('Location') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                    <div class="col-md-3">
                                            <label class="form-label mb-0 mt-2">{{ __('Description') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <textarea type="text" name="description" class="form-control"
                                                placeholder="{{ __('Description') }}">{{$employees_previous_experience_details->location}}</textarea>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-label mb-0 mt-2">{{ __('Attachments') }}</div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label"></label>
                                                <input class="form-control" name="attachment"
                                                    type="file">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                       
                        <div class="card-footer text-end">
                            <button id="submit" class="btn btn-primary" type="submit" name="submit"> Save</button>
                            @if(auth()->user()->type == 'hr')
                            <a href="{{route('employees-experience')}}" class="btn btn-danger">Cancel</a>
                            @else
                             <a href="{{route('experience')}}" class="btn btn-danger">Cancel</a>
                            @endif
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
$("#employees-experience-edit").submit(function() {
    event.preventDefault();
     $("#submit").prop('disabled', true);
    $("#submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading....');
     @if(auth()->user()->type == 'hr')
    axios.post("{{ route('employees-experience-edit',$employees_previous_experience_details->id) }}", new FormData($("#employees-experience-edit")[0])).then(
        @else
        axios.post("{{ route('experience-edit',$employees_previous_experience_details->id) }}", new FormData($("#employees-experience-edit")[0])).then(
        @endif
        response => {
            var data = response.data;
        @if(auth()->user()->type == 'hr')
            if (data.error) 
            notif({ msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b>Employees Experience Submitted Successfully", type: "success" }, setTimeout(function() { location.replace("{{ route('employees-experience') }}"); }, 3000));
            else {
                $("#submit").prop('disabled', false);
            $("#submit").html('Submit');
                for (var a in data['error']['message']) {
                    notify(null, data['error']['message'][a][0], 'botton left');
                    if (a == 'success' | a == 'error') notify(null, data['error']['message'][a][0],
                        'botton left');
                }  
            }
        @else
        if (data.error) 
            notif({ msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b>Experience Submitted Successfully", type: "success" }, setTimeout(function() { location.replace("{{ route('experience') }}"); }, 3000));
            else {
                $("#submit").prop('disabled', false);
            $("#submit").html('Submit');
                for (var a in data['error']['message']) {
                    notify(null, data['error']['message'][a][0], 'botton left');
                    if (a == 'success' | a == 'error') notify(null, data['error']['message'][a][0],
                        'botton left');
                }  
            }
        @endif
        }).catch(error => {
            $("#submit").prop('disabled', false);
            $("#submit").html('Submit');
            notify(null, 'Something went wrong', 'top right');
            console.log(error);
        });
});
</script>
@stop