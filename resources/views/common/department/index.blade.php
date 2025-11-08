@extends('layouts.app')
@section('title', 'Departments')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!--PAGE HEADER-->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Department</div>
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
                    <div class="btn-list">
                        <a href="{{route('department-post')}}" class="btn btn-primary me-3">Add Department</a>
                    </div>
                </div>
            </div>
        </div>
        <!--END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-xl-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header  border-0">
                        <h4 class="card-title">Department Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="hr-table">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 w-5">#ID</th>
                                        <th class="border-bottom-0">Department Name</th>
                                        <th class="border-bottom-0">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($department as $key => $row)
                                    <tr>
                                        <td>{{ ($department->currentpage()-1) * $department->perpage() + $key + 1 }}</td>
                                        <td>{{ $row->department_name }}</td>
                                        <td>
                                            <a  href="{{ route('department-edit', $row->id) }}" class="btn btn-primary btn-icon btn-sm" >
                                                <i class="feather feather-edit" data-bs-toggle="tooltip"
                                                    data-original-title="Edit"></i>
                                            </a>
                                            <a href="#" onclick="validate('{{ $row->id }}','{{ $row->department_name }}')" class="btn btn-danger btn-icon btn-sm"><i class="feather feather-trash-2"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation">{!! $department->links('pagination.custom') !!}</nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END ROW -->

    </div>
</div><!-- end app-content-->
<!-- ADD DEPARTMENT MODAL -->
<div class="modal fade" id="adddepartmentmodal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Department</h5>
                <button class="btn-close" onclick="javascript:window.location.reload()" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" >×</span>
                </button>
            </div>
			<form method="post" id="enroll" action="" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Add Department</label>
                    <input type="text" class="form-control" name="department_name" placeholder="Department" value="">
                </div>
            </div>
            <div class="modal-footer">
                <button id="submit" class="btn btn-primary" type="submit" name="submit">
                Save
                </button>
                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- END ADD DEPARTMENT MODAL -->

<!-- EDIT DEPARTMENT MODAL -->
<div class="modal fade" id="editdepartmentmodal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Department</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Edit Department</label>
                    <input type="text" class="form-control" placeholder="Department" value="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                <a href="javascript:void(0);" class="btn btn-primary">Save</a>
            </div>
        </div>
    </div>
</div>
<!-- END EDIT DEPARTMENT MODAL  -->
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
                url:'{{url("hr/department/delete/")}}/' +id,
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