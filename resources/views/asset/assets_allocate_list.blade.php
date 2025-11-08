@extends('layouts.app')
@section('title', 'Asset Allocate List')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!--PAGE HEADER-->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">{{ __('Assets Allocate') }}</div>
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
                    <div class="btn-list">
                        <a href="{{route('assets-allocate-to-add')}}" class="btn btn-primary me-3">{{ __('Add Assets Allocate') }}</a>
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
                        <h4 class="card-title">{{ __('Asset Allocate Summary') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="hr-table">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 w-5">#ID</th>
                                        <th class="border-bottom-0">{{ __('Asset Name') }}</th>
                                        <th class="border-bottom-0">{{ __('Employee Name') }}</th>
                                        <th class="border-bottom-0">{{ __('Allocate Date') }}</th>
                                        <th class="border-bottom-0">{{ __('Return Date') }}</th>
                                        <th class="border-bottom-0">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($assets_allocate_list as $key => $row)
                                    <tr>
                                        <td>{{ ($assets_allocate_list->currentpage()-1) * $assets_allocate_list->perpage() + $key + 1 }}</td>
                                        <td>{{ $row->asset_name }}</td>
                                        <td>{{\App\Models\User::where(['emp_id' => $row->employee_name])->pluck('name')->first();}}</td>
                                        <td>{{ $row->allocate_date }}</td>
                                        <td>{{ $row->return_date }}</td>
                                        <td>
                                            <a  href="{{ route('assets-allocate-to-edit', $row->id) }}" class="btn btn-primary btn-icon btn-sm" >
                                                <i class="feather feather-edit" data-bs-toggle="tooltip"
                                                    data-original-title="Edit"></i>
                                            </a>
                                            <a href="#" onclick="validate('{{ $row->id }}','{{ $row->asset_name }}')" class="btn btn-danger btn-icon btn-sm"><i class="feather feather-trash-2"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation">{!! $assets_allocate_list->links('pagination.custom') !!}</nav>
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
                url: "{{ route('assets-allocate-to-destroy') }}" + '/' + id,
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