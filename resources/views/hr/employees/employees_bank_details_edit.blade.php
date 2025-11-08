@extends('layouts.app')
@section('title', 'Employee  Education Add')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Edit Bank Details</div>
            </div>

        </div>

        <!-- END ROW -->
        <div class="row">
            <div class="col-xl-12 col-md-12 col-lg-12">
                <div class="panel-body tabs-menu-body hremp-tabs1 p-0">
                    <form method="post" id="employees-bank-edit" action="" enctype="multipart/form-data">
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
                                                    <option value="{{$val->emp_id}}" {{ $val->emp_id == $bank_details->emp_id ? 'selected' : '' }}>{{$val->name}}</option>
                                                  @endforeach
                                                </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Bank') }}</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="bank_name" class="form-control" value="{{$bank_details->bank_name}}" placeholder="{{ __('Bank') }}">
                                            </div>

                                            
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('BANK IFSC') }}</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="bank_ifsc" value="{{$bank_details->bank_ifsc}}" class="form-control"
                                                    placeholder="{{ __('BANK IFSC') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('BANK ACCOUNT') }}</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="bank_account" value="{{$bank_details->bank_account}}" class="form-control"
                                                    placeholder="{{ __('BANK ACCOUNT') }}">
                                            </div>

                                            
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('PAN') }}</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="pan" class="form-control" value="{{$bank_details->bank_name}}" placeholder="{{ __('PAN') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('UAN') }}
                                                    <span class="form-help" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="Employees' Provident Fund Organisation">?</span>
                                                </label>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="uan" class="form-control" value="{{$bank_details->uan}}" placeholder="{{ __('UAN') }}">
                                            </div>
                                         
                                    </div>
                                </div>
                                <div class="form-group">
                                        <div class="row">
                                <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('PF NUMBER') }}
                                                    <span class="form-help" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="Employee PF Number can be defined as an account number">?</span>
                                                </label>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="pf_number" value="{{$bank_details->pf_number}}" class="form-control"
                                                    placeholder="{{ __('PF NUMBER') }}">
                                            </div>
                                             </div>
                                </div>
                        <div class="card-footer text-end">
                            <button id="submit" class="btn btn-primary" type="submit" name="submit"> Save</button>
                            <a href="{{route('employees-bank-details-list')}}" class="btn btn-danger">Cancel</a>
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
$("#employees-bank-edit").submit(function() {
    event.preventDefault();
     $("#submit").prop('disabled', true);
    $("#submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading....');
    axios.post("{{ route('employees-bank-details-edit', $bank_details->id) }}", new FormData($("#employees-bank-edit")[0])).then(
        response => {
            var data = response.data;
            if (data.success) 
            notif({ msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b>Employees Bank Details Submitted Successfully", type: "success" }, setTimeout(function() { location.replace("{{ route('employees-bank-details-list') }}"); }, 3000));
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