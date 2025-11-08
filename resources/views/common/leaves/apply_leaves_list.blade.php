@extends('layouts.app')
@section('title', 'Employee Leave  List')
@section('content')
<div class="app-content main-content">
					<div class="side-app main-container">
						
                        <!-- PAGE HEADER -->
                        <div class="page-header d-xl-flex d-block">
							<div class="page-leftheader">
								<div class="page-title">My Leaves</div>
							</div>
							<div class="page-rightheader ms-md-auto">
								<div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
									<div class="btn-list">
									    @if(auth()->user()->type == 'hr')
									    <a  href="{{route('apply-leaves-list')}}" class="btn btn-primary me-3">Apply Leaves</a>
									    @else
									    <a  href="{{route('employee-apply-leaves')}}" class="btn btn-primary me-3">Apply Leaves</a>
									    @endif
										
									</div>
								</div>
							</div>
						</div>
						<!--END PAGE HEADER -->

						<!-- ROW -->
						<div class="row">
						<!--<div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-3">-->
						<!--		<div class="card">-->
						<!--			<div class="card-header  border-0">-->
						<!--				<h4 class="card-title">Leaves Overview</h4>-->
						<!--			</div>-->
						<!--			<div class="card-body">-->
						<!--				<div id="leavesoverview" class="mx-auto pt-2"></div>-->
						<!--				<div class="row pt-7 pb-5  mx-auto text-center">-->
						<!--					<div class="col-md-7 mx-auto d-block">-->
						<!--						<div class="row">-->
						<!--							<div class="col-md-12">-->
						<!--								<div class="d-flex font-weight-semibold">-->
						<!--									<span class="dot-label bg-primary me-2 my-auto"></span>Casual Leaves-->
						<!--								</div>-->
						<!--							</div>-->
						<!--							<div class="col-md-12 mt-3">-->
						<!--								<div class="d-flex font-weight-semibold">-->
						<!--									<span class="dot-label badge-danger me-2 my-auto"></span>Sick Leaves-->
						<!--								</div>-->
						<!--							</div>-->
						<!--							<div class="col-md-12 mt-3">-->
						<!--								<div class="d-flex font-weight-semibold">-->
						<!--									<span class="dot-label bg-secondary me-2 my-auto"></span>Gifted Leaves-->
						<!--								</div>-->
						<!--							</div>-->
						<!--							<div class="col-md-12 mt-3">-->
						<!--								<div class="d-flex font-weight-semibold">-->
						<!--									<span class="dot-label bg-success me-2 my-auto"></span>Remaining Leaves-->
						<!--								</div>-->
						<!--							</div>-->
						<!--						</div>-->
						<!--					</div>-->
						<!--				</div>-->
						<!--			</div>-->
						<!--		</div>-->
						<!--	</div>-->
							<div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-9">
								<div class="card">
									<div class="card-header  border-0">
										<h4 class="card-title">Leaves Summary</h4>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="emp-attendance">
												<thead>
													<tr>
														<th class="border-bottom-0 text-center">#ID</th>
														<th class="border-bottom-0">Leave Dates</th>
														<th class="border-bottom-0">Leave Type</th>
														<th class="border-bottom-0">Status</th>
														<th class="border-bottom-0">Requested By</th>
														<th class="border-bottom-0">Leave Note</th>
														<th class="border-bottom-0">Action</th>
													</tr>
												</thead>
												<tbody>
												@foreach($apply_leave as $key => $row)
													<tr>
														<td class="text-center">{{ ($apply_leave->currentpage()-1) * $apply_leave->perpage() + $key + 1 }}</td>
														@if($row->leave_status_reason == 'Unpaid_Leave')
														<td>Unpaid Leave</td>
                                                        @else
														<td>paid Leave</td>
														@endif
														<td>16-01-2021</td>
														<td>
														@if($row->leave_status_reason == 'Pending')
														<span class="badge badge-warning">Pending</span>
														@elseif($row->leave_status_reason == 'Rejected')
														<span class="badge badge-danger">Rejected</span>
														@elseif($row->leave_status_reason == 'Approved')
														<span class="badge badge-success">Approved</span>
														@elseif($row->leave_status_reason == '')
														<span class="badge badge-primary">New</span>
														@endif	
														</td>
														<td>Personal</td>
														<td>05-01-2021</td>
														<td class="text-start d-flex">
															<a  href="javascript:void(0);" class="action-btns1" data-bs-toggle="modal" data-bs-target="#leaveapplictionmodal">
																<i class="feather feather-eye  text-primary"  data-bs-toggle="tooltip" data-bs-placement="top" title="view"></i>
															</a>
														</td>
													</tr>
													@endforeach
												</tbody>
											</table>
											<nav aria-label="Page navigation">{!! $apply_leave->links('pagination.custom') !!}</nav>
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
<script src="{{asset('backend/plugins/moment/moment.js')}}"></script>
<script src="{{asset('backend/plugins/pg-calendar-master/pignose.calendar.full.min.js')}}"></script>
<script src="{{asset('backend/plugins/daterangepicker/moment.min.js')}}"></script>
<script src="{{asset('backend/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('backend/js/employee/emp-leaves.js')}}"></script>
@stop