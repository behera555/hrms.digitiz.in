@extends('layouts.app')
@section('title', 'Interviews List')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Interviews</div>
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                    <div class="btn-list">
                        <a href="{{route('interviews-add')}}" class="btn btn-primary me-3"><i class="fa fa-plus sidemenu_icon"></i>Add Interviews</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->
        <!-- ROW -->
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header  border-0">
                        <h4 class="card-title">Interviews Lists</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom"
                                id="hr-holiday">
                                <thead>
                                    <tr><th class="border-bottom-0 w-5">#ID</th>
                                        <th class="border-bottom-0 w-5">Candidate Name</th>
                                        <th class="border-bottom-0">Interviewer</th>
                                        <th class="border-bottom-0">Interview Type</th>
                                        <th class="border-bottom-0">Interview Date</th>
                                        <th class="border-bottom-0">Interview Time</th>
                                        <th class="border-bottom-0">Interview Name</th>
                                        <th class="border-bottom-0">Interview Link </th>
                                        <th class="border-bottom-0">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
												@foreach($interviews as $key => $row)
													<tr>
													<td>{{ ($interviews->currentpage()-1) *$interviews->perpage() + $key + 1 }}</td>
													<td>{{DB::table('candidates')->where(['id' => $row->candidate_name])->pluck('first_name')->first();}}</td>
														<td>{{DB::table('users')->where(['emp_id' => $row->interviewer])->pluck('name')->first();}}</td>
                                                        <td>{{ $row->interview_type }}</td>
                                                        <td>{{ $row->interview_date }}</td>
                                                        <td>{{ $row->interview_time }}</td>
                                                        <td>{{ $row->interview_name }}</td>
                                                        <td> <a href="{{ $row->interview_link }}" class="btn btn-danger" target=”_blank”><i class="fa fa-handshake-o"></i></a></td>
														<td>
															<div class="d-flex">
																<a  href="{{ route('interviews-edit', $row->id) }}" class="action-btns1" ><i class="feather feather-edit primary text-primary"></i></a>
																<a onclick="validate('{{ $row->id }}','{{ $row->requisition_id }}')" class="action-btns1"  title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
															</div>
														</td>
													</tr>
													@endforeach
												</tbody>
											</table>
											<nav aria-label="Page navigation">{!! $interviews->links('pagination.custom') !!}</nav>
                            </table>
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
        text: "Are you sure you want to delete this record" + " " + title,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Delete it!",
        closeOnConfirm: false
    }, function() {
        $.ajax({
                type:'DELETE',
				url:"{{ route('interviews-destroy') }}" + '/' + id,
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