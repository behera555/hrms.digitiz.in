@extends('layouts.app')
@section('title', 'Employee Add')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">{{ __('Employees Education') }}</div>
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
                <div class="btn-list">
                     @if(auth()->user()->type == 'hr')
                        <a href="{{route('employees-education-add')}}" class="btn btn-primary me-3">Add Employees Education</a>
                        @else
                        <a href="{{route('education-add')}}" class="btn btn-primary me-3">Add  Education</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-xl-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header  border-0">
                        <h4 class="card-title">{{ __('Employees Education Summary') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom"
                                id="emp-attendance">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 text-center">#ID</th>
                                        <th class="border-bottom-0">{{ __('Employee Name') }}</th>
                                        <th class="border-bottom-0">{{ __('Degree') }}</th>
                                        <th class="border-bottom-0">{{ __('Specialization') }}</th>
                                        <th class="border-bottom-0">{{ __('Year of Joining') }}</th>
                                        <th class="border-bottom-0">{{ __('Year of Completion') }}</th>
                                        <th class="border-bottom-0">{{ __('CGPA / Percentage') }}</th>
                                        <th class="border-bottom-0">{{ __('University / College') }}</th>
                                        <th class="border-bottom-0">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($employees_education_details as $key => $row)
                                    <tr>
                                    <td>{{ ($employees_education_details->currentpage()-1) * $employees_education_details->perpage() + $key + 1 }}</td>
                                    <td>{{\App\Models\User::where(['emp_id' => $row->emp_id])->pluck('name')->first();}}</td> 
                                    <td>{{$row->degree}}</td>
                                    <td>{{$row->specialization}}</td>
                                    <td>{{$row->year_of_joining}}</td>
                                    <td>{{$row->year_of_completion}}</td>
                                    <td>{{$row->cgpa}}</td>
                                    <td>{{$row->college}}</td>
                                    <td><a href="{{url('uploads/education/'.$row->attachment)}}" class="btn btn-success btn-icon btn-sm" download><i class="feather feather-download"></i></a>
                                        <a href="{{url('uploads/education/'.$row->attachment)}}" class="btn btn-primary btn-icon btn-sm" target=”_blank”><i class="feather feather-eye"></i></a>
                                        @if(auth()->user()->type == 'hr')
                                        <a  href="{{ route('employees-education-edit', $row->id) }}" class="btn btn-primary btn-icon btn-sm"><i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="Edit"></i></a>
                                         @else
                                        <a  href="{{ route('education-edit', $row->id) }}" class="btn btn-primary btn-icon btn-sm"><i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="Edit"></i></a> 
                                         @endif
                                        @if(auth()->user()->type == 'hr')
                                        <a href="#" onclick="validate('{{ $row->id }}','{{ $row->degree }}')" class="btn btn-danger btn-icon btn-sm"><i class="feather feather-trash-2"></i></a>
                                        @endif
                                    </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation">{!! $employees_education_details->links('pagination.custom') !!}</nav>
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
        text: "Are you sure you want to delete this record" + " " + title,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Delete it!",
        closeOnConfirm: false
    }, function() {
        $.ajax({
                type:'DELETE',
                url: "{{ route('employees_education_destroy') }}" + '/' + id,
                data:{"_token": "{{ csrf_token() }}",},
                success: function (data) {
                    var jso = JSON.stringify(data); 
                    if (data.success){
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