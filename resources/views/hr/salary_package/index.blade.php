@php
use Carbon\Carbon;
@endphp
@extends('layouts.app')
@section('title', 'Employee Salary Package Dashboard')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Employees Salary Package</div>
            </div>

        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" id="salary_package" action="" enctype="multipart/form-data">
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
                                            <option value="{{$val->emp_id}}">{{$val->name}}</option>
                                          @endforeach
                                        </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Annual package') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-money"></i>
                                                </div>
                                            </div><input name="annual_package" value="" id="annual_package" class="form-control calculate"
                                                placeholder="{{ __('Annual package') }}" type="text">
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
                                        <a href="{{ route('employees-salary-package-list') }}"
                                            class="btn btn-danger btn-lg">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- END ROW -->
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header  border-0">
                        <h4 class="card-title">Employees Salary Package Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom"
                                id="emp-attendance">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 text-center">#ID</th>
                                        <th class="border-bottom-0">Employees Name</th>
                                        <th class="border-bottom-0">Annual Package</th>
                                        <th class="border-bottom-0">Monthly Package</th>
                                        <th class="border-bottom-0">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($employees_salary_package as $key => $row)
                                    <tr>
                                    <td>{{ ($employees_salary_package->currentpage()-1) * $employees_salary_package->perpage() + $key + 1 }}</td>
                                        <td>{{\App\Models\User::where(['emp_id' => $row->emp_id])->pluck('name')->first();}}</td>
                                        <td>{{ numberFormat($row->annual_package,2)}}</td>
                                        <td class="font-weight-semibold">{{ numberFormat($row->monthly_package,2)}}</td>
                                        <td>
                                            <a  href="{{ route('employees-salary-package-edit', $row->id) }}" class="btn btn-primary btn-icon btn-sm" >
                                                <i class="feather feather-edit" data-bs-toggle="tooltip"
                                                    data-original-title="Edit"></i>
                                            </a>
                                            <a href="#" onclick="validate('{{ $row->id }}','{{\App\Models\User::where(['emp_id' => $row->emp_id])->pluck('name')->first();}}')" class="btn btn-danger btn-icon btn-sm"><i class="feather feather-trash-2"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation">{!! $employees_salary_package->links('pagination.custom') !!}</nav>
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
        $("#salary_package").submit(function() {
            event.preventDefault();
            $("#submit").prop('disabled', true);
            $("#submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading....');
            axios.post("{{ route('employees-salary-package-add') }}", new FormData($("#salary_package")[0])).then(response => {
                var data = response.data;
                if (data.success) notif({
                    msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b> Salary Package Submitted Successfully",
                    type: "success"
                }, setTimeout(function() {
                    location.replace("{{ route('employees-salary-package-list') }}");
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
            type: 'DELETE',
            url: "{{ route('employees-salary-package-destroy') }}" + '/' + id,
            data: {"_token": "{{ csrf_token() }}",},
            success: function(data) {
                var jso = JSON.stringify(data);
                if (data.success) {
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