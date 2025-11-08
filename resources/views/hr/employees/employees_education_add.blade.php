@extends('layouts.app')
@section('title', 'Employee  Education Add')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Add Education</div>
            </div>

        </div>

        <!-- END ROW -->
        <div class="row">
            <div class="col-xl-12 col-md-12 col-lg-12">
                <div class="panel-body tabs-menu-body hremp-tabs1 p-0">
                    <form method="post" id="employees-education" action="" enctype="multipart/form-data">
                        <div class="card-body">
                        <div id="dynamicAddRemove_Education">
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
                                    @else
                                    <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2"></label>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="hidden" name="emp_id" value="{{auth()->user()->emp_id}}" class="form-control"
                                                    placeholder="">
                                            </div>
                                    @endif
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Degree') }}</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="education[0][degree]" class="form-control"
                                                    placeholder="{{ __('Degree') }}">
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                        <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Branch / Specialization') }}</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="education[0][specialization]" class="form-control"
                                                    placeholder="{{ __('Branch / Specialization') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Year of Joining') }}</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="education[0][year_of_joining]" class="form-control"
                                                    placeholder="{{ __('Year of Joining') }}">
                                            </div>
                                            
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                        <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Year of Completion') }}</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="education[0][year_of_completion]" class="form-control"
                                                    placeholder="{{ __('Year of Completion') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('CGPA / Percentage') }}</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="education[0][cgpa]" class="form-control"
                                                    placeholder="{{ __('CGPA / Percentage') }}">
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                        <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('University / College') }}</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="education[0][college]" class="form-control"
                                                    placeholder="{{ __('University / College') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-label mb-0 mt-2">{{ __('Attachments') }}</div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label"></label>
                                                    <input class="form-control" name="education[0][attachment]" type="file">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" name="add" id="add_btn_Education" class="btn btn-primary">Add More</button>
                                </div>
                        </div>
                        <div class="card-footer text-end">
                            <button id="submit" class="btn btn-primary" type="submit" name="submit"> Save</button>
                            @if(auth()->user()->type == 'hr')
                            <a href="{{route('employees-education')}}" class="btn btn-danger">Cancel</a>
                            @else
                            <a href="{{route('education')}}" class="btn btn-danger">Cancel</a>
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
<script type="text/javascript">
var i = 0;
$("#add_btn_Education").click(function() {
    ++i;
    $("#dynamicAddRemove_Education").append('<div class="form-group"><div class="form-group"> <div class="row"> <div class="col-md-3"> <label class="form-label mb-0 mt-2">{{ __('Degree') }}</label> </div> <div class="col-md-3"> <input type="text"  name="education['+i+'][degree]" class="form-control" placeholder="{{ __('Degree') }}"> </div> <div class="col-md-3"> <label class="form-label mb-0 mt-2">{{ __('Branch / Specialization') }}</label> </div> <div class="col-md-3"> <input type="text" name="education['+i+'][specialization]" class="form-control" placeholder="{{ __('Branch / Specialization') }}"> </div> </div> </div> <div class="form-group"> <div class="row"> <div class="col-md-3"> <label class="form-label mb-0 mt-2">{{ __('Year of Joining') }}</label> </div> <div class="col-md-3"> <input type="text" name="education['+i+'][year_of_joining]" class="form-control" placeholder="{{ __('Year of Joining') }}"> </div> <div class="col-md-3"> <label class="form-label mb-0 mt-2">{{ __('Year of Completion') }}</label> </div> <div class="col-md-3"> <input type="text" name="education['+i+'][year_of_completion]" class="form-control" placeholder="{{ __('Year of Completion') }}"> </div> </div> </div> <div class="form-group"> <div class="row"> <div class="col-md-3"> <label class="form-label mb-0 mt-2">{{ __('CGPA / Percentage') }}</label> </div> <div class="col-md-3"> <input type="text"  name="education['+i+'][cgpa]" class="form-control" placeholder="{{ __('CGPA / Percentage') }}"> </div> <div class="col-md-3"> <label class="form-label mb-0 mt-2">{{ __('University / College') }}</label> </div> <div class="col-md-3"> <input type="text" name="education['+i+'][college]" class="form-control" placeholder="{{ __('University / College') }}"> </div> </div> </div> <div class="form-group"> <div class="row"> <div class="col-md-3"> <div class="form-label mb-0 mt-2">{{ __('Attachments') }}</div> </div> <div class="col-md-3"> <div class="form-group"> <label class="form-label"></label> <input class="form-control" name="education['+i+'][attachment]" type="file"> </div> </div> </div> </div><button type="button" class="btn btn-danger remove-tr">Remove</button></div>');
});
$(document).on('click', '.remove-tr', function() {
    $(this).parents('.form-group').remove();
});
</script>
<script>
$("#employees-education").submit(function() {
    event.preventDefault();
    $("#submit").prop('disabled', true);
    $("#submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading....');
    @if(auth()->user()->type == 'hr')
    axios.post("{{ route('employees-education-add') }}", new FormData($("#employees-education")[0])).then(
    @else
    axios.post("{{ route('education-add') }}", new FormData($("#employees-education")[0])).then(
    @endif
        response => {
            var data = response.data;
            @if(auth()->user()->type == 'hr')
            if (data.success) 
            notif({ msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b>Employees Education Submitted Successfully", type: "success" }, setTimeout(function() { location.replace("{{ route('employees-education') }}"); }, 3000));
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
             if (data.success) 
            notif({ msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b>Education Submitted Successfully", type: "success" }, setTimeout(function() { location.replace("{{ route('education') }}"); }, 3000));
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