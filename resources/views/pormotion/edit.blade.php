@extends('layouts.app')
@section('title', 'Edit Promotion')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">{{ __('Add Promotion') }}</div>
            </div>

        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" id="pormotion_edit" action="" enctype="multipart/form-data">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{ __('Add Promotion') }}</h5>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label">{{ __('Select Employee') }}:</label></p>
                                                    <select class="form-control select2-show-search custom-select"
                                                        name="employee_name">
                                                        <option label="Choose one"></option>
                                                        @foreach($employees as $key => $val)
                                                        <option value="{{$val->emp_id}}" {{ $val->emp_id == $pormotion->employee_name ? 'selected' : '' }}>{{$val->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label
                                                        class="form-label mb-0 mt-2">{{ __('Current Department') }}:</label>
                                                    <select name="current_department"
                                                        class="form-control custom-select select2"
                                                        data-placeholder="{{ __('Current Department') }}">
                                                        <option label="Select"></option>
                                                        @foreach($department as $key => $val)
                                                        <option value="{{$val->department_name}}" {{ $val->department_name == $pormotion->current_department ? 'selected' : '' }}>
                                                            {{$val->department_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label
                                                        class="form-label mb-0 mt-2">{{ __('Current Designation') }}:</label>
                                                    <select name="current_designation"
                                                        class="form-control custom-select select2"
                                                        data-placeholder="{{ __('Current Designation') }}">
                                                        <option label="Select"></option>
                                                        @foreach($designtion as $key => $val)
                                                        <option value="{{$val->designtion_name}}" {{ $val->designtion_name == $pormotion->current_designation ? 'selected' : '' }}>
                                                            {{$val->designtion_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label
                                                        class="form-label mb-0 mt-2">{{ __('Current Salary') }}:</label>
                                                    <input type="text" name="current_salary" class="form-control"
                                                        placeholder="{{ __('Current Salary') }}" value="{{$pormotion->current_salary}}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label
                                                        class="form-label mb-0 mt-2">{{ __('Promotion New Salary') }}:</label>
                                                    <input type="text" name="promotion_new_salary" class="form-control"
                                                        placeholder="{{ __('Promotion New Salary') }}" value="{{$pormotion->promotion_new_salary}}">
                                                </div>
                                                <div class="col-md-3">
                                                    <label
                                                        class="form-label mb-0 mt-2">{{ __('Promoted Department') }}</label>
                                                    <select name="promoted_department"
                                                        class="form-control custom-select select2"
                                                        data-placeholder="{{ __('Promoted Department') }}">
                                                        <option label="Select"></option>
                                                        @foreach($department as $key => $val)
                                                        <option value="{{$val->department_name}}"  {{ $val->department_name == $pormotion->promoted_department ? 'selected' : '' }}>
                                                            {{$val->department_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label
                                                        class="form-label mb-0 mt-2">{{ __('Promoted Designation') }}</label>
                                                    <select name="promoted_designation"
                                                        class="form-control custom-select select2"
                                                        data-placeholder="{{ __('Promoted Designation') }}">
                                                        <option label="Select"></option>
                                                        @foreach($designtion as $key => $val)
                                                        <option value="{{$val->designtion_name}}" {{ $val->designtion_name == $pormotion->promoted_designation ? 'selected' : '' }}>
                                                            {{$val->designtion_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label
                                                        class="form-label mb-0 mt-2">{{ __('Promoted Date') }}</label>
                                                    <input type="text" name="promotion_date"
                                                        class="form-control fc-datepicker"
                                                        placeholder="{{ __('Promoted Date') }}" value="{{$pormotion->promotion_date}}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                <label
                                                        class="form-label mb-0 mt-2">{{ __('Description') }}:</label>
                                                    <textarea type="text" name="description" class="form-control"
                                                        placeholder="{{ __('Description') }}">{{$pormotion->description}}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button id="submit" class="btn btn-primary" type="submit" name="submit">
                                                    Save</button>
                                                <a href="{{route('pormotion-list')}}" class="btn btn-danger">Cancel</a>
                                            </div>
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
        <script src="{{asset('backend/plugins/multipleselect/multiple-select.js')}}"></script>
        <script src="{{asset('backend/plugins/multipleselect/multi-select.js')}}"></script>

        <script src="{{asset('backend/js/formelementadvnced.js')}}"></script>
        <script src="{{asset('backend/js/form-elements.js')}}"></script>
        <script src="{{asset('backend/js/select2.js')}}"></script>
        <script>
        $('[data-bs-toggle="modaldatepicker"]').datepicker({
            autoHide: true,
            zIndex: 999998
        });

        $("#pormotion_edit").submit(function() {
            event.preventDefault();
            $("#submit").prop('disabled', true);
            $("#submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading....');
            axios.post("{{ route('pormotion-edit', $pormotion->id) }}", new FormData($("#pormotion_edit")[0])).then(response => {
                var data = response.data;
                $('#pormotion_edit')[0].reset();
                if (data.success) notif({
                    msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b> Promotion Submitted Successfully",
                    type: "success"
                }, setTimeout(function() {
                    location.replace("{{ route('pormotion-list') }}");
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