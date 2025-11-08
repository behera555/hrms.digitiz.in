
@extends('layouts.app')
@section('title', 'Notice Board')
@section('content')
@php
use Illuminate\Support\Facades\DB;
@endphp
<div class="app-content main-content">
    <div class="side-app main-container">

        <!--PAGE HEADER-->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Notice Board</div>
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
                    @if(auth()->user()->type == 'hr')
                    <div class="btn-list">
                        <a href="{{route('notice-board-add')}}" class="btn btn-primary me-3">Add Notice Board</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <!--END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-xl-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header  border-0">
                        <h4 class="card-title">Notice Board</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="hr-table">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 w-5">#ID</th>
                                        <th class="border-bottom-0">Notice</th>
                                        <th class="border-bottom-0">Description</th>
                                        <th class="border-bottom-0">Date</th>
                                        <th class="border-bottom-0">To</th>
                                        @if(auth()->user()->type == 'hr')
                                        <th class="border-bottom-0">Actions</th>
                                         @endif
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($notice_boards as $key => $row)
                                    <tr>
                                        <td>{{ ($notice_boards->currentpage()-1) * $notice_boards->perpage() + $key + 1 }}</td>
                                        <td>{{ $row->notice_heading }}</td> 
                                        <td>{{ $row->notice_details }}</td>
                                        <td>{{ $row->Date }}</td>
                                        <td>{{DB::table('users')->where(['emp_id' => $row->department])->pluck('name')->first();}}</td>
                                         @if(auth()->user()->type == 'hr')
                                        <td>
                                            <a  href="{{ route('notice-board-edit', $row->id) }}" class="btn btn-primary btn-icon btn-sm" >
                                                <i class="feather feather-edit" data-bs-toggle="tooltip"
                                                    data-original-title="Edit"></i>
                                            </a>
                                            <a href="#" onclick="validate('{{ $row->id }}')" class="btn btn-danger btn-icon btn-sm"><i class="feather feather-trash-2"></i></a>
                                        </td>
                                         @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation">{!! $notice_boards->links('pagination.custom') !!}</nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END ROW -->

    </div>
</div><!-- end app-content-->

@endsection
@section('script')
<script>
function validate(id, title) {
    swal({
        title: "Are you sure?",
        text: "Are you sure you want to delete this record",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Delete it!",
        closeOnConfirm: false
    }, function() {
        $.ajax({
                type:'DELETE',
                url: "{{ route('notice-board-destroy') }}" + '/' + id,
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