@inject('carbon', 'Carbon\Carbon')
@extends('layouts.app')
@section('title', 'Employee Attendance Report')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">{{ __('Employees Attendance Report') }}</div>
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-xl-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header  border-0">
                        <h4 class="card-title">{{ __('Employees Attendance Report') }}</h4>
                        <div class="btn-list" style="margin-left:850px;">
                        <a href="{{route('add-attendance')}}" class="btn btn-primary me-3"><i class='fa fa-plus'></i></a>
                    </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                        <form method="post" action="{{ route('employees-attendance-list') }}">
                        {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">{{ __('Select Date From') }}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="feather feather-calendar"></i>
                                            </div>
                                        </div><input class="form-control" value="" name="start_from"
                                            data-bs-toggle="modaldatepicker" placeholder="MM/DD/YYYY">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>{{ __('Select Date To') }}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="feather feather-calendar"></i>
                                            </div>
                                        </div><input class="form-control" value="" name="end_to"
                                            data-bs-toggle="modaldatepicker" placeholder="MM/DD/YYYY">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>{{ __('Select Employee') }}</label>
                                    <div class="input-group">
                                        <select class="form-control select2-show-search custom-select"
                                            name="user_id">
                                            <option label="Choose one"></option>
                                            @foreach($employees as $key => $val)
                                            <option value="{{$val->id}}" >{{$val->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                <label> &nbsp;</label>
                                    <div class="input-group">
                                        <button class="btn btn-primary" type="submit" name="submit">filter</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom"
                                id="emp-attendance">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 text-center">#ID</th>
                                        <th class="border-bottom-0">{{ __('Employee Name') }}</th>
                                        <th class="border-bottom-0">{{ __('Login Date') }}</th>
                                        <th class="border-bottom-0">{{ __('Login Time') }}</th>
                                        <th class="border-bottom-0">{{ __('Logout Time') }}</th>
                                        <th class="border-bottom-0">{{ __('Hours') }}</th>
                                        <th class="border-bottom-0">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($attendance))
                                    @foreach($attendance as $key => $row)
                                    <tr>
                                        <td>{{ ($attendance->currentpage()-1) * $attendance->perpage() + $key + 1 }}
                                        </td>
                                        <td>{{(\App\Models\User::where(['id' => $row->user_id])->pluck('name')->first())}}
                                        </td>
                                        <td>{{$row->login_date}}</td>
                                        <td>{{$row->login_time}}</td>
                                        <td>{{$row->logout_time}}</td>
                                        @php 
                                        $time= $carbon.now();
                                        $start = $carbon::parse($row->login_time);
                                        $end = $carbon::parse($row->logout_time);
                                        $diff = $start->diff($end)->format('%H:%I:%s');
                                        @endphp
                                        <td>{{$diff}}</td>
                                        <td>
                                        <a href="{{route('employees-attendance-edit', $row->id)}}" class="btn btn-primary btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Download"><i class="feather feather-edit"></i></a>
                                        <!--<a href="#" onclick="validate('{{ $row->id }}','{{(\App\Models\User::where(['id' => $row->user_id])->pluck('name')->first())}}')" class="btn btn-danger btn-icon btn-sm"><i class="feather feather-trash-2"></i></a>-->
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr><td colspan="6">No Record Found</td></tr>
                                    @endif
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation">{!! $attendance->links('pagination.custom') !!}</nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END ROW -->

    </div>
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog"
   aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <h4 class="modal-title" id="myModalLabel">Edit Details</h4>
              
           </div>
           <div class="modal-body">
               <div class="row">
                    <div class="col-12">
                        
                           <form id="edit-form">
                               <div class="mb-4">
                                   <label for="product_name" class="form-label">Login Date</label>
                                   <input type="text" name="login_date" placeholder="Type here" class="form-control" id="product_name">
                               </div>
                               <input name="xxrpz" type="hidden">
                               <div class="mb-4">
                                   <label class="form-label">Login Time</label>
                                   <input type="time" name="email" placeholder="Enter Login Time" class="form-control" ></textarea>
                               </div>
                               <!--<div class="mb-4">
                                   <label class="form-label">Contact Number</label>
                                   <input type="number" name="phone_no" placeholder="Enter Phone Number" class="form-control" >
                               </div>-->
                               <div class="form-group">
                                    <label class="form-label">Logout Time</label> 
                                    <input type="time" class="form-control" name="phone_no" placeholder="Enter Logout Time">
                                </div>                            
                       </div>
               </div>
           </div>
           <div class="modal-footer">
              
               <button type="submit" class="btn btn-primary">Update</button>
           </div>
           </form>
       </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
</div>
@endsection
@section('script')
<script src="{{asset('backend/plugins/jQuery-countdowntimer/jQuery.countdownTimer.js')}}"></script>
<script src="{{asset('backend/js/employee/emp-attendance.js')}}"></script>
<script src="{{asset('backend/plugins/multipleselect/multiple-select.js')}}"></script>
<script src="{{asset('backend/plugins/multipleselect/multi-select.js')}}"></script>
<script src="{{asset('backend/js/formelementadvnced.js')}}"></script>
<script src="{{asset('backend/js/form-elements.js')}}"></script>
<script src="{{asset('backend/js/select2.js')}}"></script>
<script>
$('[data-bs-toggle="modaldatepicker"]').datepicker({
    autoHide: true,
    zIndex: 999998
});
</script>
<script>
function validate(id, title) {
    swal({
        title: "Are you sure?",
        text: "Are you sure you want to delete this attendance record of" + " " + title,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Delete it!",
        closeOnConfirm: false
    }, function() {
        $.ajax({
                type:'DELETE',
                url: "{{ route('destroy_attendance') }}" + '/' + id,
                data:{"_token": "{{ csrf_token() }}",},
                success: function (data) {
                    var jso = JSON.stringify(data); 
                    if (data.success){
                        swal({
                            title: "Deleted!",
                            text: "Your attendance has been deleted.",
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