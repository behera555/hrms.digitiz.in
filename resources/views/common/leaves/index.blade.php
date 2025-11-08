@extends('layouts.app')
@section('title', 'Leave Types List')
@section('content')
<div class="app-content main-content">
					<div class="side-app main-container">
						
                        <!-- PAGE HEADER -->
                        <div class="page-header d-xl-flex d-block">
							<div class="page-leftheader">
								<div class="page-title">Leave Settings</div>
							</div>
							<div class="page-rightheader ms-md-auto">
								<div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
									<div class="btn-list">
										<a  href="{{ route('add-leaves') }}" class="btn btn-primary me-3">Add Leave Type</a>
									</div>
								</div>
							</div>
						</div>
						<!-- END PAGE HEADER -->

						<!-- ROW -->
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header  border-0">
										<h4 class="card-title">Leaves Types</h4>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="hr-leavestypes">
												<thead>
													<tr><th class="border-bottom-0 w-5">#ID</th>
														<th class="border-bottom-0">Leaves Type</th>
														<th class="border-bottom-0 text-center">No.of Leaves</th>
														<th class="border-bottom-0">Actions</th>
													</tr>
												</thead>
												<tbody>
												@foreach($leaves as $key => $row)
													<tr>
													<td>{{ ($leaves->currentpage()-1) * $leaves->perpage() + $key + 1 }}</td>
													<td>{{ $row->type_of_leaves }}</td>
														<td class="text-center font-weight-semibold">{{ $row->number_of_days }}</td>
														<td>
															<div class="d-flex">
																<a  href="{{ route('edit-leaves', $row['id']) }}" class="action-btns1" ><i class="feather feather-edit primary text-primary"></i></a>
																<a onclick="validate('{{ $row->id }}','{{ $row->department_name }}')" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
															</div>
														</td>
													</tr>
													@endforeach
												</tbody>
											</table>
											<nav aria-label="Page navigation">{!! $leaves->links('pagination.custom') !!}</nav>
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
				url:"{{ route('leaves.delete') }}" + '/' + id,
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