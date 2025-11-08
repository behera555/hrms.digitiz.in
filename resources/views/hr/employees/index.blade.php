@php 
use Carbon\Carbon;
@endphp
@extends('layouts.app')
@php
use Illuminate\Support\Facades\DB;
@endphp
@section('title', 'Employee List')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">
        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Employees</div>
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
                    <div class="btn-list">
                        <a href="{{route('employees-add')}}" class="btn btn-primary me-3">Add New Employee</a>
                        <button class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="E-mail">
                            <i class="feather feather-mail"></i> </button>
                        <button class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="Contact">
                            <i class="feather feather-phone-call"></i> </button>
                        <button class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="Info">
                            <i class="feather feather-info"></i> </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-7">
                                <div class="mt-0 text-start"> <span class="font-weight-semibold">Total Employees</span>
                                    <h3 class="mb-0 mt-1 text-success">{{DB::table('users')->whereIn('type',[3])->whereIn('active', [1])->count();}}</h3>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="icon1 bg-success-transparent my-auto  float-end"> <i
                                        class="las la-users"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-7">
                                <div class="mt-0 text-start"> <span class="font-weight-semibold">Total Male
                                        Employees</span>
                                    <h3 class="mb-0 mt-1 text-primary">{{DB::table('users')
->join('employees_primary_details', function($join)
{
  $join->on('users.emp_id', '=', 'employees_primary_details.emp_id')
  ->where('employees_primary_details.gender', '=', 'male')
  ->where('users.type','=',3)
  ->where('users.active','=',1);
})
->count();
                                    }}</h3>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="icon1 bg-primary-transparent my-auto  float-end"> <i
                                        class="las la-male"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-7">
                                <div class="mt-0 text-start"> <span class="font-weight-semibold">Total Female
                                        Employees</span>
                                    <h3 class="mb-0 mt-1 text-secondary">{{DB::table('users')
->join('employees_primary_details', function($join)
{
  $join->on('users.emp_id', '=', 'employees_primary_details.emp_id')
  ->where('employees_primary_details.gender', '=', 'female')
  ->where('users.active','=',1);
})
->count();
                                    }}</h3>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="icon1 bg-secondary-transparent my-auto  float-end"> <i
                                        class="las la-female"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-7">
                                <div class="mt-0 text-start"> <span class="font-weight-semibold">Total New
                                        Employees</span>
                                    <h3 class="mb-0 mt-1 text-danger">{{DB::table('employees_primary_details')->where('date_of_joining','>=', date('Y-m-d'))->count();}}</h3>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="icon1 bg-danger-transparent my-auto  float-end"> <i
                                        class="las la-user-friends"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END ROW -->

        <!-- ROW -->
        <div class="row">
            <div class="col-xl-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header  border-0">
                        <h4 class="card-title">Employees List</h4>
                        
                            <a class="btn btn-primary btn-icon" href="#" style="margin-left: 10px; size: 40px;">
                                               <i class="feather feather-download" data-bs-toggle="tooltip"
                                                   data-original-title="#"></i>
                                           </a>
                        
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="hr-table">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 w-5">No</th>
                                        <th class="border-bottom-0">Emp Name</th>
                                        <th class="border-bottom-0 w-10">#Emp ID</th>
                                        <th class="border-bottom-0">Department</th>
                                        <th class="border-bottom-0">Designation</th>
                                        <th class="border-bottom-0">Phone Number</th>
                                        <th class="border-bottom-0">Join Date</th>
                                        <th class="border-bottom-0">Status</th>
                                        <th class="border-bottom-0">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($employees as $key => $row)
                                    <tr>
                                    <td>{{ ($employees->currentpage()-1) * $employees->perpage() + $key + 1 }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <span class="avatar avatar-md brround me-3"
                                                    style="background-image: url({{url('').'/uploads/passport/'.$row->profile_pic;}})"></span>
                                                <div class="me-3 mt-0 mt-sm-1 d-block">
                                                    <a href="{{ route('employees-viewprofile', $row->id) }}" class="mb-1 fs-14">{{$row->display_name}}</a>

                                                </div>
                                            </div>
                                        </td>
                                        <td>{{$row->emp_id}}</td>
                                        <td>{{$row->department}}</td>
                                        <td>{{$row->designation}}</td>
                                        <td>{{DB::table('employees_contact_details')->where(['emp_id' => $row->emp_id])->pluck('working_phone')->first();}}</td>
                                        <td>{{$row->date_of_joining}}</td>
                                        <td>@if(\App\Models\User::where(['emp_id' => $row->emp_id])->pluck('active')->first() == 0)
                                        <span class="badge badge-danger">Deactivate</span>
                                        @else
                                        <span class="badge badge-success">Active</span></td>
                                        @endif    
                                        <td>
                                           <a class="btn btn-primary btn-icon btn-sm" href="{{ route('employees-edit', $row->id) }}">
                                               <i class="feather feather-edit" data-bs-toggle="tooltip"
                                                   data-original-title="View/Edit"></i>
                                           </a>
                                            @if(\App\Models\User::where(['emp_id' => $row->emp_id])->pluck('active')->first() == 0)
                                           <a href="#" onclick="validates('{{ $row->emp_id }}','{{ $row->display_name }}')" class="btn btn-danger btn-icon btn-sm"><i class="fa fa-toggle-off"></i></a>
                                           @else
                                           <a href="#" onclick="validate('{{ $row->emp_id }}','{{ $row->display_name }}')" class="btn btn-success btn-icon btn-sm"><i class="fa fa-toggle-on"></i></a>
                                           @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation">{!! $employees->links('pagination.custom') !!}</nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END ROW -->
    </div>
</div>
@endsection
@section('script')
<script>
function validate(id, title) {
    swal({
        title: "Are you sure?",
        text: "Are you sure you want to Deactive this record" + " " + title,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Deactive it!",
        closeOnConfirm: false
    }, function() {
        $.ajax({
                type:'DELETE',
                url: "{{ route('destroy') }}" + '/' + id,
                data:{"_token": "{{ csrf_token() }}",},
                success: function (data) {
                    var jso = JSON.stringify(data); 
                    if (data.success){
                        swal({
                            title: "Deactivated!",
                            text: "Employee has been deactivated.",
                            type: "success",
                        });
                        location.reload();
                            }
                    }         
            });
    });
}
function validates(id, title) {
    swal({
        title: "Are you sure?",
        text: "Are you sure you want to Active this record" + " " + title,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Activate it!",
        closeOnConfirm: false
    }, function() {
        $.ajax({
                type:'DELETE',
                url: "{{ route('destroy') }}" + '/' + id,
                data:{"_token": "{{ csrf_token() }}",},
                success: function (data) {
                    var jso = JSON.stringify(data); 
                    if (data.success){
                        swal({
                            title: "Activate!",
                            text: "Employee has been activated.",
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