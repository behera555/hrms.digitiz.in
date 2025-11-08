@extends('layouts.app')
@section('title', 'Expenses List')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Expenses</div>
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
                    <div class="btn-list">
                        <a href="{{route('hr-expenses-add')}}" class="btn btn-primary me-3">Add Expenses</a>
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
                        <h4 class="card-title">My Expenses Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom"
                                id="emp-attendance">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">#ID</th>
                                        <th class="border-bottom-0">Title</th>
                                        <th class="border-bottom-0">Amount</th>
                                        <th class="border-bottom-0">Date</th>
                                      
                                        <th class="border-bottom-0">Approved by</th>
                                        <th class="border-bottom-0">Aprroval Status</th>
                                        <th class="border-bottom-0">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($expenses as $key => $row)
                                    <tr>
                                        <td>{{ ($expenses->currentpage()-1) * $expenses->perpage() + $key + 1 }}</td>
                                        <td>{{$row->item_name}}</td>
                                        <td>₹ {{$row->price}}</td>
                                        <td>{{$row->purchase_date}}</td>
                                       
                                        <td>{{$row->paid_by}}</td>
                                        <td>
                                            @if($row->aprroval_status == 'Pending')
                                            <span class="badge badge-warning">Pending</span>
                                            @elseif($row->aprroval_status == 'Rejected')
                                            <span class="badge badge-danger">Rejected</span>
                                            @elseif($row->aprroval_status == 'Approved')
                                            <span class="badge badge-success">Approved</span>
                                            @elseif($row->aprroval_status == '')
                                            <span class="badge badge-primary">New</span>
                                            @endif
                                        </td>
                                        <td class="text-start d-flex">
                                            <a href="javascript:void(0);" class="action-btns1" data-bs-toggle="modal"
                                                data-bs-target="#editexpensemodal{{$row->id}}">
                                                <i class="feather feather-eye  text-primary" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="view"></i>
                                            </a>
                                            @if(auth()->user()->type == 'hr')
                                            <a  href="{{ route('hr-expenses-edit', $row->id) }}" class="btn btn-primary btn-icon btn-sm"><i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="Edit"></i></a>
                                            @else
                                            <a  href="{{ route('expenses-edit', $row->id) }}" class="btn btn-primary btn-icon btn-sm"><i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="Edit"></i></a>
                                             @endif
                                           
                                            @if(auth()->user()->type == 'hr')
                                            <a href="#" onclick="validate('{{ $row->id }}','{{ $row->item_name }}')" class="btn btn-danger btn-icon btn-sm"><i class="feather feather-trash-2"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="editexpensemodal{{$row->id}}">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">View Expense</h5>
                                                    <button class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="leave-types">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Item Name :</label>
                                                                    {{$row->item_name}}
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label">Price:</label>
                                                                        ₹ {{$row->price}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Purchase Date :</label>
                                                                    {{$row->purchase_date}}
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label">Bill:</label>
                                                                        
                                                                        <a href="{{url('uploads/expenses/'.$row->bill)}}" class="action-btns1" target=”_blank”><i class="feather feather-eye  text-primary"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">Description:</label>
                                                        {{$row->description}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation">{!! $expenses->links('pagination.custom') !!}</nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END ROW -->


    </div>

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
            type: 'DELETE',
            url: "{{ route('hr-expenses-destroy') }}" + '/' + id,
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