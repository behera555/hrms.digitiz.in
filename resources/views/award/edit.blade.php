@extends('layouts.app')
@section('title', 'Award Edit')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">{{ __('Edit Award') }}</div>
            </div>

        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" id="award_edit" action="" enctype="multipart/form-data">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{ __('Edit Award') }}</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Award Name') }}</label>
                                        <input class="form-control" placeholder="{{ __('Award Name') }}" name="{{ __('award_name') }}" value="{{ $award->award_name }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Select Employee') }}:</label></p>
                                            <select class="form-control select2-show-search custom-select" name="employee_name">
                                            <option label="Choose one"></option>
                                            @foreach($employees as $key => $val)
                                            <option value="{{$val->emp_id}}" {{ $val->emp_id == $award->employee_name ? 'selected' : '' }}>{{$val->name}}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Gift Item') }}</label>
                                        <input class="form-control" placeholder="{{ __('Gift Item') }}" name="{{ __('gift_item') }}"  value="{{ $award->gift_item }}">
                                    </div>
                                     <div class="form-group">
                                        <label class="form-label">{{ __('Gift Item issued Date') }}:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="feather feather-calendar"></i>
                                                </div>
                                            </div><input name="gift_item_issued_date" class="form-control fc-datepicker" placeholder="{{ __('DD-MM-YYYY') }}"
                                                type="text"  value="{{ $award->gift_item_issued_date }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                <button id="submit" class="btn btn-primary" type="submit" name="submit"> Save</button>
                                <a href="{{route('award-list')}}" class="btn btn-danger">Cancel</a>
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

        $("#award_edit").submit(function() {
            event.preventDefault();
            $("#submit").prop('disabled', true);
            $("#submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading....');
            axios.post("{{ route('award-edit', $award->id) }}", new FormData($("#award_edit")[0])).then(response => {
                var data = response.data;
                $('#award_edit')[0].reset();
                if (data.success) notif({
                    msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b> Award Updated Successfully",
                    type: "success"
                }, setTimeout(function() {
                    location.replace("{{ route('award-list') }}");
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