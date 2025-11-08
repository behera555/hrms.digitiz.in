@extends('layouts.app')
@section('title', 'Document Management')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">{{ __('Document Management') }}</div>
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
                <div class="btn-list">
                        <a href="{{route('document-management-add')}}" class="btn btn-primary me-3">Add Document</a>
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
                        <h4 class="card-title">{{ __('Document Summary') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom"
                                id="emp-attendance">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 text-center">#ID</th>
                                        <th class="border-bottom-0">{{ __('Document Name') }}</th>
                                        <th class="border-bottom-0">{{ __('View The Document') }}</th>
                                        <th class="border-bottom-0">{{ __('Download The Document') }}</th>
                                        <th class="border-bottom-0">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($document_list as $key => $row)
                                    <tr>
                                    <td>{{ ($document_list->currentpage()-1) * $document_list->perpage() + $key + 1 }}</td>
                                        <td>{{$row->document_name}}</td>
                                        <td><a href="{{url('uploads/document/'.$row->document_upload)}}" class="btn btn-primary btn-icon btn-sm" target=”_blank”><i class="feather feather-eye"></i></a></td>
                                        <td> <a href="{{url('uploads/document/'.$row->document_upload)}}" class="btn btn-success btn-icon btn-sm" download><i class="feather feather-download"></i></a></td>
                                        <td><a  href="{{ route('document-management-edit', $row->id) }}" class="btn btn-primary btn-icon btn-sm"><i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="Edit"></i></a>
                                        <a href="#" onclick="validate('{{ $row->id }}','{{ $row->document_name }}')" class="btn btn-danger btn-icon btn-sm"><i class="feather feather-trash-2"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation">{!! $document_list->links('pagination.custom') !!}</nav>
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
            type: 'DELETE',
            url:"{{ route('document-management-destroy') }}" + '/' + id,
            data: {
                "_token": "{{ csrf_token() }}",
            },
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