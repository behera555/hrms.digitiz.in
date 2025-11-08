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
@stop