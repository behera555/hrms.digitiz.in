@extends('layouts.app')
@section('title', 'Employee Experience List')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">{{ __('Employees Bank Details') }}</div>
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
                <div class="btn-list">
                        <a href="{{route('employees-bank-details-add')}}" class="btn btn-primary me-3">Add Employees Bank Details</a>
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
                        <h4 class="card-title">{{ __('Employees Bank Details') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom"
                                id="emp-attendance">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 text-center">#ID</th>
                                        <th class="border-bottom-0">{{ __('Employee Name') }}</th>
                                        <th class="border-bottom-0">{{ __('Bank') }}</th>
                                        <th class="border-bottom-0">{{ __('BANK IFSC') }}</th>
                                        <th class="border-bottom-0">{{ __('BANK ACCOUNT') }}</th>
                                        <th class="border-bottom-0">{{ __('PAN') }}</th>
                                        <th class="border-bottom-0">{{ __('Request Received') }}</th>
                                        <th class="border-bottom-0">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($employees_bank_details as $key => $row)
                                    <tr>
                                    <td>{{ ($employees_bank_details->currentpage()-1) * $employees_bank_details->perpage() + $key + 1 }}</td>
                                        <td>{{\App\Models\User::where(['emp_id' => $row->emp_id])->pluck('name')->first();}}</td> 
                                        <td>{{$row->bank_name}}</td>
                                        <td>{{$row->bank_ifsc}}</td>
                                        <td>{{$row->bank_account}}</td>
                                        <td>{{$row->pan}}</td>
                                        <td>
                                       @if($row->active == 2)
                                       <form method="post" id="" action="{{ route('employee-bank-details-send', $row->id) }}" enctype="multipart/form-data">
                                             @csrf
                                       <button  type="submit" class="btn btn-primary btn-icon btn-sm" style="color: #fff!important;background-color: green;border-color: green;"><i class="fa fa-envelope-o"></i> Request Received</button>
                                       </form>
                                       @elseif($row->active == 3)
                                       <button   class="btn btn-primary btn-icon btn-sm" style="color: #fff!important;background-color: red;border-color: red;"><i class="fa fa-envelope-o"></i> Request Approved</button>
                                       @endif
                                       </td>
                                       <td>
                                        <a  href="{{ route('employees-bank-details-edit', $row->id) }}" class="btn btn-primary btn-icon btn-sm"><i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="Edit"></i></a>
                                        <a href="#" onclick="validate('{{ $row->id }}','{{ $row->bank_name }}')" class="btn btn-danger btn-icon btn-sm"><i class="feather feather-trash-2"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation">{!! $employees_bank_details->links('pagination.custom') !!}</nav>
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
                url: "{{ route('employees-bank-details-destroy') }}" + '/' + id,
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