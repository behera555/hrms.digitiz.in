@extends('layouts.app')
@php
use Illuminate\Support\Facades\DB;
@endphp
@section('title', 'Employee Leave  List')
@section('content')
<div class="app-content main-content">
					<div class="side-app main-container">
						
                        <!-- PAGE HEADER -->
                        <div class="page-header d-xl-flex d-block">
							<div class="page-leftheader">
								<div class="page-title">Employee Leaves</div>
							</div>
						</div>
						<!--END PAGE HEADER -->

						<!-- ROW -->
						<div class="row">
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
														<th class="border-bottom-0">Leave Date</th>
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
														<td>{{$row->start_date}}</td>
														<td>
														@if($row->leave_status == 'Pending')
														<span class="badge badge-warning">Pending</span>
														@elseif($row->leave_status == 'Rejected')
														<span class="badge badge-danger">Rejected</span>
														@elseif($row->leave_status == 'Approved')
														<span class="badge badge-success">Approved</span>
														@elseif($row->leave_status == '')
														<span class="badge badge-primary">New</span>
														@endif	
														</td>
														<td>{{DB::table('employees_primary_details')->where(['emp_id' => $row->emp_id])->pluck('display_name')->first();}}</td>
														<td>{{$row->reason}}</td>
														<td class="text-start d-flex">
                                                            <a  href="{{ route('edit-apply-leaves', $row['id']) }}" class="action-btns1" ><i class="feather feather-edit primary text-primary"></i></a>
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