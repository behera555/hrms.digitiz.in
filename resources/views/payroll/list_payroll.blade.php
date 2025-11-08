@extends('layouts.app')
@section('title', 'Pay Roll List')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">
        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">{{ __('Payroll Structure') }}</div>
            </div>
        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <form method="post" id="payroll_post" action="" enctype="multipart/form-data">
                        <div class="card-body">
                            <h4 class="card-title">{{ __('Salary Information') }}</h4>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-md-12 col-lg-2">
                                        <label class="form-label mb-0 mt-2">{{ __('Basic Salary') }}</label>
                                    </div>
                                    <div class="col-md-12 col-lg-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="basic_salary"
                                                placeholder="{{ __('Basic Salary') }}"
                                                value="{{$payroll->basic_salary}}">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-percent"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">{{ __('Allowances') }}</h4>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12 col-lg-2">
                                        <label class="form-label mb-0 mt-2">{{ __('HRA Allowance') }}</label>
                                    </div>
                                    <div class="col-md-12 col-lg-4">
                                        <div class="input-group">

                                            <input type="text" name="hra_allowance" class="form-control"
                                                placeholder="{{ __('HRA Allowance') }}"
                                                value="{{$payroll->hra_allowance}}">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-percent"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-12 col-lg-2">
                                        <label class="form-label mb-0 mt-2">{{ __('Travel Allowances') }}</label>
                                    </div>
                                    <div class="col-md-12 col-lg-4">
                                        <div class="input-group">
                                            <input type="text" name="travel_allowances" class="form-control"
                                                placeholder="{{ __('Travel Allowances') }}"
                                                value="{{$payroll->travel_allowances}}">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-percent"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12 col-lg-2">
                                        <label class="form-label mb-0 mt-2">{{ __('Education') }}</label>
                                    </div>
                                    <div class="col-md-12 col-lg-4">
                                        <div class="input-group">
                                            <input type="text" name="education" class="form-control"
                                                value="{{$payroll->education}}" placeholder="{{ __('Education') }}">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-percent"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-2">
                                        <label class="form-label mb-0 mt-2">{{ __('Communication') }}</label>
                                    </div>
                                    <div class="col-md-12 col-lg-4">
                                        <div class="input-group">
                                            <input type="text" name="communication" class="form-control"
                                                value="{{$payroll->communication}}"
                                                placeholder="{{ __('Communication') }}">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-percent"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12 col-lg-2">
                                        <label class="form-label mb-0 mt-2">{{ __('LTA') }}</label>
                                    </div>
                                    <div class="col-md-12 col-lg-4">
                                        <div class="input-group">
                                            <input type="text" name="lta" class="form-control"
                                                placeholder="{{ __('LTA') }}" value="{{$payroll->lta}}">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-percent"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-lg-2">
                                        <label class="form-label mb-0 mt-2">{{ __('Special Allowance') }}</label>
                                    </div>
                                    <div class="col-md-12 col-lg-4">
                                        <div class="input-group">
                                            <input type="text" name="special_allowance" class="form-control"
                                                placeholder="{{ __('Special Allowance') }}"
                                                value="{{$payroll->special_allowance}}">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-percent"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">{{ __('Deduction') }}</h4>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12 col-lg-2">
                                        <label class="form-label mb-0 mt-2">{{ __('Professional Tax') }}</label>
                                    </div>
                                    <div class="col-md-12 col-lg-8">
                                        <div class="input-group">
                                            <input type="text" name="professional_tax" class="form-control"
                                                placeholder="{{ __('Professional Tax') }}"
                                                value="{{$payroll->professional_tax}}">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-percent"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-2">
                                </div>
                                <div class="col-md-12 col-lg-8">
                                    <button id="submit" class="btn btn-primary btn-lg" type="submit" name="submit">
                                        Save</button>
                                </div>
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
<script>
$("#payroll_post").submit(function() {
    event.preventDefault();
    $("#submit").prop('disabled', true);
    $("#submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading....');
    axios.post("{{ route('payroll-add', $payroll->id) }}", new FormData($("#payroll_post")[0])).then(
        response => {
            var data = response.data;
            if (data.success) notif({
                msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b>Pay Roll Structure Updated Successfully",
                type: "success"
            }, setTimeout(function() {
                location.replace("{{ route('payroll-list') }}");
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