@extends('layouts.app')
@section('title', 'Work Report')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">{{ __('Employees WorkReport') }}</div>
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
                <div class="btn-list">
                     @if(auth()->user()->type == 'hr')
                        <a href="{{route('employees-education-add')}}" class="btn btn-primary me-3">Add WorkReport</a>
                        @else
                        <a href="{{route('employee-work-report-add')}}" class="btn btn-primary me-3">Add  WorkReport</a>
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
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom"
                                id="emp-attendance">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 text-center">#ID</th>
                                        <th class="border-bottom-0">{{ __('Employee Name') }}</th>
                                        <th class="border-bottom-0">{{ __('Date') }}</th>
                                        <th class="border-bottom-0">{{ __('Report') }}</th>
                                        <th class="border-bottom-0">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <tbody>
                                @foreach($work_report_details as $key => $row)
                                    <tr>
                                    <td>{{ ($work_report_details->currentpage()-1) * $work_report_details->perpage() + $key + 1 }}</td>
                                    <td>{{\App\Models\User::where(['id' => $row->emp_id])->pluck('name')->first();}}</td> 
                                    <td>{{$row->report_date}}</td>
                                    <td>{{$row->report}}</td>
                                    <td>
                                        @if(auth()->user()->type == 'hr')
                                        <a  href="{{ route('employees-education-edit', $row->id) }}" class="btn btn-primary btn-icon btn-sm"><i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="Edit"></i></a>
                                         @else
                                        <a  href="{{ route('employee-work-report-edit', $row->id) }}" class="btn btn-primary btn-icon btn-sm"><i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="Edit"></i></a> 
                                         @endif
                                        @if(auth()->user()->type == 'hr')
                                        <a href="#" onclick="validate('{{ $row->id }}','{{ $row->report_date }}')" class="btn btn-danger btn-icon btn-sm"><i class="feather feather-trash-2"></i></a>
                                        @endif
                                    </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation">{!! $work_report_details->links('pagination.custom') !!}</nav>
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