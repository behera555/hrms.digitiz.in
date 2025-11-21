@extends('layouts.app')
@section('title', 'Employee Letter Of Intent')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">
        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Employees Letter Of Intent</div>
            </div>

        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" id="letter_of_intent" action="" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Employee  Name') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                        <select class="form-control select2-show-search custom-select" name="emp_id">
                                            <option label="Choose one"></option>
                                            @foreach($employees as $key => $val)
                                            <option value="{{$val->emp_id}}">{{$val->name}}</option>
                                          @endforeach
                                        </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Date of Joining') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div><input name="date_of_joining" class="form-control" data-bs-toggle="modaldatepicker" placeholder="MM/DD/YYYY" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Internship Period') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                    <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-clock-o"></i>
                                                </div>
                                            </div><input name="probation_period" class="form-control" placeholder="{{ __('Internship Period') }}" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Stipend') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-money"></i>
                                                </div>
                                            </div><input name="stipend" class="form-control" placeholder="{{ __('Stipend') }}" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 col-lg-2">
                                    </div>
                                    <div class="col-md-12 col-lg-8">
                                        <button id="submit" class="btn btn-primary btn-lg" type="submit" name="submit">
                                            Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END ROW -->
            </div>
        </div>
        <div class="row">
							<div class="col-xl-12 col-md-12 col-lg-12">
								<div class="card">
									<div class="card-header  border-0">
										<h4 class="card-title">Letter Of Intent Summary</h4>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="emp-attendance">
												<thead>
													<tr>
														<th class="border-bottom-0 text-center">#ID</th>
														<th class="border-bottom-0">Employee Name</th>
														<th class="border-bottom-0">Employee Id</th>
														<th class="border-bottom-0">Employee Department</th>
														<th class="border-bottom-0">Employee Probation Period</th>
														<th class="border-bottom-0">Employee Stipend</th>
														<th class="border-bottom-0">Action</th>
													</tr>
												</thead>
												<tbody>
												    @foreach($employees_letter_of_intent as $key => $val)
													<tr>
														<td>{{ ($employees_letter_of_intent->currentpage()-1) * $employees_letter_of_intent->perpage() + $key + 1 }}</td>
														<td>{{ $val->employee_name }}</td>
														<td>{{ $val->emp_id }}</td>
														<td>{{ $val->department_name }}</td>
														<td class="font-weight-semibold">{{ $val->probation_period }}</td>
														<td>{{ numberFormat($val->stipend,2) }}</td>
														<td>
														    {{-- <a href="{{url('pdf/letter_of_intent/'.$val->file)}}" class="btn btn-primary btn-icon btn-sm" target=”_blank”><i class="feather feather-eye"></i></a> --}}  
                                                            {{-- new --}}  
                                                            <a href="{{ route('employees-letter-of-intent-preview', $val->id) }}" class="btn btn-primary btn-icon btn-sm" target="_blank"><i class="feather feather-eye"></i></a>
															<a href="{{url('pdf/letter_of_intent/'.$val->file)}}" class="btn btn-success btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Download" download><i class="feather feather-download"></i></a>
															<a href="{{ route('employees-letter-of-intent-edit', $val->id) }}" class="btn btn-primary btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Download"><i class="feather feather-edit"></i></a>
															<a href="#" onclick="validate('{{ $val->id }}','{{ $val->employee_name }}')" class="btn btn-danger btn-icon btn-sm"><i class="feather feather-trash-2"></i></a>
														</td>
													</tr>
												 @endforeach
												</tbody>
											</table>
											 <nav aria-label="Page navigation">{!! $employees_letter_of_intent->links('pagination.custom') !!}</nav>
										</div>
									</div>
								</div>
							</div>
						</div>
        @endsection
        @section('script')
        <script src="{{asset('backend/plugins/wysiwyag/jquery.richtext.js')}}"></script>
        <script src="{{asset('backend/js/form-editor.js')}}"></script>
        <script src="{{asset('backend/plugins/multipleselect/multiple-select.js')}}"></script>
		<script src="{{asset('backend/plugins/multipleselect/multi-select.js')}}"></script>

        <script src="{{asset('backend/js/formelementadvnced.js')}}"></script>
		<script src="{{asset('backend/js/form-elements.js')}}"></script>
		<script src="{{asset('backend/js/select2.js')}}"></script>
        <script>
            $('[data-bs-toggle="modaldatepicker"]').datepicker({
                autoHide: true,
                zIndex: 999998,
            dateFormat: 'yy-mm-dd'
            });
        $("#letter_of_intent").submit(function() {
            event.preventDefault();
            $("#submit").prop('disabled', true);
            $("#submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading....');
            axios.post("{{ route('employees-letter-of-intent') }}", new FormData($("#letter_of_intent")[0])).then(response => {
                var data = response.data;
                if (data.success) 
                    notif({msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b>Letter Of Intent Submitted Successfully",
                    type: "success"}, setTimeout(function() { location.replace("{{ route('employees-letter-of-intent') }}"); }, 3000));
                else {
                     $("#submit").prop('disabled', false);
                     $("#submit").html('Submit');
                    for (var a in data['error']['message']) {
                        notify(null, data['error']['message'][a][0], 'botton left');
                        if (a == 'success' | a == 'error') notify(null, data['error']['message'][a][0],
                            'botton left');
                    }
                }
            }).catch(error => {
            $("#submit").prop('disabled', false);
            $("#submit").html('Submit');
            notify(null, 'Something went wrong', 'top right');
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
            type: 'DELETE',
            url: "{{ route('employees-letter-of-intent-destroy') }}" + '/' + id,
            data: {"_token": "{{ csrf_token() }}",},
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