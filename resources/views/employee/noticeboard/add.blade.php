@extends('layouts.app')
@section('title', 'Notice Board Add')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">{{ __('Add Notice Board') }}</div>
            </div>

        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" id="notice_board" action="" enctype="multipart/form-data">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{ __('Add Notice Board') }}</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Notice Heading') }}</label>
                                        <input class="form-control" placeholder="{{ __('Notice Heading') }}" name="{{ __('notice_heading') }}">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-controls-stacked d-md-flex">
                                            <label class="custom-control custom-radio success me-4">
                                                <input type="radio" class="custom-control-input" id="show" name="type"
                                                    value="employees" checked>
                                                <span class="custom-control-label">{{ __('To Employees') }}</span>
                                            </label>
                                            <label class="custom-control custom-radio success">
                                                <input type="radio" class="custom-control-input" id="hide" name="type"
                                                    value="clients">
                                                <span class="custom-control-label">{{ __('To Clients') }}</span>
                                            </label>
                                           
                                        </div>
                                        <p><label class="form-label">{{ __('Select Employee') }}:</label></p>
                                            <p>
                                            <select class="form-control select2-show-search custom-select" name="department">
                                            <option label="Choose one"></option>
                                             <option value="all">All</option>
                                            @foreach($employees as $key => $val)
                                            <option value="{{$val->emp_id}}">{{$val->name}}</option>
                                          @endforeach
                                        </select>
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Select Date') }}:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="feather feather-calendar"></i>
                                                </div>
                                            </div><input name="date" class="form-control fc-datepicker" placeholder="{{ __('DD-MM-YYYY') }}"
                                                type="text">
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Notice Details') }}:</label>
                                        <textarea name="notice_details" class="form-control content" placeholder="{{ __('Notice Details') }}"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                <button id="submit" class="btn btn-primary" type="submit" name="submit"> Save</button>
                                <a href="{{route('notice-board')}}" class="btn btn-danger">Cancel</a>
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
        $(document).ready(function(){
        $("#hide").click(function(){
            $("p").hide(1000);
        });
        $("#show").click(function(){
            $("p").show(1000);
        });
        });
        </script>
        <script>
        $('[data-bs-toggle="modaldatepicker"]').datepicker({
            autoHide: true,
            zIndex: 999998
        });

        $("#notice_board").submit(function() {
            event.preventDefault();
             $("#submit").prop('disabled', true);
             $("#submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading....');
            axios.post("{{ route('notice-board-add') }}", new FormData($("#notice_board")[0])).then(response => {
                var data = response.data;
                $('#notice_board')[0].reset();
                if (data.success) notif({
                    msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b> Notice Board Submitted Successfully",
                    type: "success"
                }, setTimeout(function() {
                    location.replace("{{ route('notice-board') }}");
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