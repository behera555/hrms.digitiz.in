@extends('layouts.app')
@section('title', 'Candidates List')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Candidates</div>
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                    <div class="btn-list">
                        <a href="{{route('candidates-add')}}" class="btn btn-primary me-3"><i class="fa fa-plus sidemenu_icon"></i>Add Candidates</a>
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
                        <h4 class="card-title">Candidates Lists</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom"
                                id="hr-holiday">
                                <thead>
                                    <tr><th class="border-bottom-0 w-5">S.NO</th>
                                        <th class="border-bottom-0">Candidate Name</th>
                                        <th class="border-bottom-0 w-5">Position</th>
                                        <th class="border-bottom-0">Platform</th>
                                        <th class="border-bottom-0">Education Details</th>
                                        <th class="border-bottom-0">Interview Scheduled</th>
                                        <th class="border-bottom-0">Employnment Status</th>
                                        <th class="border-bottom-0">Current Company</th>
                                        <th class="border-bottom-0">Current CTC</th>
                                        <th class="border-bottom-0">Expected CTC</th>
                                        <th class="border-bottom-0">Contact Number</th>
                                        <th class="border-bottom-0">Email</th>
                                        <th class="border-bottom-0">Skill Set</th>
                                        <th class="border-bottom-0">Notice Period</th>
                                        <th class="border-bottom-0">Comments</th>
                                        <th class="border-bottom-0">Follow up</th>
                                        <th class="border-bottom-0">Status</th>
                                        <th class="border-bottom-0">Resume Download </th>
                                        <th class="border-bottom-0">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
												@foreach($candidates as $key => $row)
                                                    <tr>
													<td>{{ ($candidates->currentpage()-1) * $candidates->perpage() + $key + 1 }}</td>
													<td>{{ $row->first_name }} {{ $row->last_name }}</td>
														<td>{{ $row->requisition_id }}</td>
                                                        <td>{{ $row->source }}</td>
                                                        <td>{{ $row->education_details }}</td>
                                                        <td>{{ $row->interview_scheduled }}</td>
                                                        <td>{{ $row->employment_status }}</td>
                                                        <td>{{ $row->current_company }}</td>
                                                        <td>{{ $row->ctc }}</td>
                                                        <td>{{ $row->expected_ctc }}</td>
                                                        <td>{{ $row->contact_number }}</td>
                                                        <td>{{ $row->email }}</td>
                                                        <td>{{ $row->skill_set }}</td>
                                                        <td>{{ $row->notice_period }}</td>
                                                        <td>{{ $row->comments }}</td>
                                                        <td>{{ $row->followup }}</td>
                                                        <td>{{ $row->shortlisted_candidates }}</td>
                                                        <td> <a href="{{ url('').'/uploads/resume/'.$row->resume;}}" class="btn btn-danger" download><i class="fa fa-download"></i></a></td>
														<td>
															<div class="d-flex">
																<a  href="{{ route('candidates-edit', $row->id) }}" class="action-btns1" ><i class="feather feather-edit primary text-primary"></i></a>
																<a onclick="validate('{{ $row->id }}','{{ $row->requisition_id }}')" class="action-btns1"  title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
															</div>
                                                            
														</td>
													</tr>
													@endforeach
												</tbody>
											</table>
											<nav aria-label="Page navigation">{!! $candidates->links('pagination.custom') !!}</nav>
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
				url:"{{ route('candidates-destroy') }}" + '/' + id,
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