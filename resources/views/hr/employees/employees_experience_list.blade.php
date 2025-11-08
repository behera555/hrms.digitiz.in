@extends('layouts.app')
@section('title', 'Employee Experience List')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">{{ __('Employees Experience') }}</div>
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
                <div class="btn-list">
                        @if(auth()->user()->type == 'hr')
                        <a href="{{route('employees-experience-add')}}" class="btn btn-primary me-3">Add Employees Experience</a>
                        @else
                        <a href="{{route('experience-add')}}" class="btn btn-primary me-3">Add  Experience</a>
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
                        <h4 class="card-title">{{ __('Employees Experience Summary') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom"
                                id="emp-attendance">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 text-center">#ID</th>
                                        <th class="border-bottom-0">{{ __('Employee Name') }}</th>
                                        <th class="border-bottom-0">{{ __('Company Name') }}</th>
                                        <th class="border-bottom-0">{{ __('Job Title') }}</th>
                                        <th class="border-bottom-0">{{ __('Date of Joining') }}</th>
                                        <th class="border-bottom-0">{{ __('Date of Relieving') }}</th>
                                        <th class="border-bottom-0">{{ __('Location') }}</th>
                                        <th class="border-bottom-0">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($employees_previous_experience_details as $key => $row)
                                    <tr>
                                    <td>{{ ($employees_previous_experience_details->currentpage()-1) * $employees_previous_experience_details->perpage() + $key + 1 }}</td>
                                        <td>{{\App\Models\User::where(['emp_id' => $row->emp_id])->pluck('name')->first();}}</td> 
                                        <td>{{$row->company_name}}</td>
                                        <td>{{$row->job_title}}</td>
                                        <td>{{$row->date_of_joining}}</td>
                                        <td>{{$row->date_of_relieving}}</td>
                                        <td>{{$row->location}}</td>
                                        <td>
                                        <a href="{{url('uploads/experience/'.$row->attachment)}}" class="btn btn-primary btn-icon btn-sm" target=”_blank”><i class="feather feather-eye"></i></a>
                                        <a href="{{url('uploads/experience/'.$row->attachment)}}" class="btn btn-success btn-icon btn-sm" download><i class="feather feather-download"></i></a>
                                         @if(auth()->user()->type == 'hr')
                                        <a  href="{{ route('employees-experience-edit', $row->id) }}" class="btn btn-primary btn-icon btn-sm"><i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="Edit"></i></a>
                                         @else
                                         <a  href="{{ route('experience-edit', $row->id) }}" class="btn btn-primary btn-icon btn-sm"><i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="Edit"></i></a>
                                         @endif
                                         @if(auth()->user()->type == 'hr')
                                        <a href="#" onclick="validate('{{ $row->id }}','{{ $row->job_title }}')" class="btn btn-danger btn-icon btn-sm"><i class="feather feather-trash-2"></i></a>
                                        @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation">{!! $employees_previous_experience_details->links('pagination.custom') !!}</nav>
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
                url: "{{ route('employees_experience_destroy') }}" + '/' + id,
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