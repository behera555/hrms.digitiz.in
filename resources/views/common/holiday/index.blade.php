@extends('layouts.app')
@section('title', 'Holidays List')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Holidays</div>
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                    @if(auth()->user()->type == 'hr')
                    <div class="btn-list">
                        <a href="{{route('holiday-post')}}" class="btn btn-primary me-3">Add Holiday</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->
        <!-- ROW -->
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header  border-0">
                        <h4 class="card-title">Holidays Lists</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom"
                                id="hr-holiday">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 w-5">No</th>
                                        <th class="border-bottom-0 w-5">Day</th>
                                        <th class="border-bottom-0">Date</th>
                                        <th class="border-bottom-0">Holidays</th>
                                         @if(auth()->user()->type == 'hr')
                                        <th class="border-bottom-0">Actions</th>
                                         @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($holidays as $key => $row)
                                    <tr>
                                        <td>{{ ($holidays->currentpage()-1) * $holidays->perpage() + $key + 1 }}</td>
                                        <td>{{date("l", strtotime($row->holiday_date));}}</td>
                                        <td>{{ $row->holiday_date }}</td>
                                        <td class="font-weight-semibold">{{ $row->holiday_name }}</td>
                                        @if(auth()->user()->type == 'hr')
                                        <td>
                                            <a class="btn btn-primary btn-icon btn-sm" href="{{ route('edit-holidays', $row['id']) }}"
                                                >
                                                <i class="feather feather-edit" data-bs-toggle="tooltip"
                                                    data-original-title="View/Edit"></i>
                                            </a>
                                            <a href="#"  onclick="validate('{{ $row->id }}','{{ $row->department_name }}')" class="btn btn-danger btn-icon btn-sm" data-bs-toggle="tooltip"
                                                data-original-title="Delete"><i class="feather feather-trash-2"></i></a>
                                        </td>
                                         @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation">{!! $holidays->links('pagination.custom') !!}</nav>
                            <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
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
$('[data-bs-toggle="modaldatepicker"]').datepicker({
    autoHide: true,
    zIndex: 999998
});

$("#holidays").submit(function() {
    event.preventDefault();
    axios.post("{{ route('hr-holiday') }}", new FormData($("#holidays")[0])).then(response => {
        var data = response.data;
        $('#holidays')[0].reset();
        // if (data.success) notify(null, 'You Are Successfully Holidays', 'top right', 'success', false);
        if (data.success)  notif({ msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b> Holidays Submitted Successfully", type: "success" });
        else {
            for (var a in data['error']['message']) {
                notify(null, data['error']['message'][a][0], 'botton left');
                if (a == 'success' | a == 'error') notify(null, data['error']['message'][a][0],
                    'botton left');
            }
        }
    }).catch(error => {
        console.log(error);
    });
});
</script>

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
                url:'{{url("hr/holidays/delete/")}}/' +id,
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

$('#enroll').on('hidden.bs.modal', function () {
 location.reload();
})
</script>
@stop