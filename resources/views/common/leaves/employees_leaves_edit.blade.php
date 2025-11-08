@extends('layouts.app')
@section('title', 'Employee Leave List')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title"> Leaves Status</div>
            </div>

        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" id="apply_leaves" action="" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Leaves Dates') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-code"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" value="{{$leaves->day_type}}" name="item_name"
                                                placeholder="{{ __('Leaves Dates') }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Date from') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div><input  value="{{$leaves->start_date}}" class="form-control"
                                                placeholder="{{ __('Price') }}" type="text" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Date To') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div><input value="{{$leaves->end_date}}" class="form-control" placeholder="{{ __('Purchase Date') }}"
                                                type="text" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Reason') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-money"></i>
                                                </div>
                                            </div>
                                            <textarea id="w3review" class="form-control"
                                                name="w3review" rows="4" cols="50" readonly>{{$leaves->reason}}</textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Purchase Date') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                            <select class="form-control" name="leave_status">
                                                <option value="Pending">Pending</option>
                                                <option value="Rejected">Rejected</option>
                                                <option value="Approved">Approved</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Comment') }}</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-file-text"></i>
                                                </div>
                                            </div>
                                            <textarea class="form-control" name="leave_status_reason" rows="4" cols="50">{{$leaves->leave_status_reason}}</textarea>
                                        </div>
                                    </div>
                                </div>



                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-2">
                                        </div>
                                        <div class="col-md-12 col-lg-8">
                                            <button id="submit" class="btn btn-primary btn-lg" type="submit"
                                                name="submit"> Save</button>
                                            <a href="{{ route('employees-apply-leaves-get') }}"
                                                class="btn btn-danger btn-lg">Cancel</a>
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

        <script>
        $('[data-bs-toggle="modaldatepicker"]').datepicker({
            autoHide: true,
            zIndex: 999998
        });

        $("#apply_leaves").submit(function() {
            event.preventDefault();
            axios.post("{{ route('edit-apply-leaves', $leaves->id) }}", new FormData($("#apply_leaves")[0])).then(response => {
                var data = response.data;
                $('#apply_leaves')[0].reset();
                if (data.success) notif({ msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b> ApplyLeaves Submitted Successfully", type: "success" }, setTimeout(function() { location.replace("{{ route('employees-apply-leaves-get') }}"); }, 3000));
                else {
                    for (var a in data['error']['message']) {
                        notify(null, data['error']['message'][a][0], 'botton left');
                        if (a == 'success' | a == 'error') notify(null, data['error'][
                                'message'
                            ][a][0],
                            'botton left');
                    }
                }
            }).catch(error => {
                console.log(error);
            });
        });
        </script>
        @stop