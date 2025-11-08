@extends('layouts.app')
@section('title', 'Employee PF List')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">{{ __('Employees PF Details') }}</div>
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
                <div class="btn-list">
                        <a href="{{route('employees-pf-details-add')}}" class="btn btn-primary me-3">Add Employees PF Details</a>
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
                        <h4 class="card-title">{{ __('Employees PF Details') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom"
                                id="emp-attendance">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 text-center">#ID</th>
                                        <th class="border-bottom-0">{{ __('Employee Name') }}</th>
                                        <th class="border-bottom-0">{{ __('PF Employee') }}</th>
                                        <th class="border-bottom-0">{{ __('PF Employer') }}</th>
                                        <th class="border-bottom-0">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($employees_pf_details as $key => $row)
                                    <tr>
                                    <td>{{ ($employees_pf_details->currentpage()-1) * $employees_pf_details->perpage() + $key + 1 }}</td>
                                        <td>{{\App\Models\User::where(['emp_id' => $row->emp_id])->pluck('name')->first();}}</td> 
                                        <td>{{$row->pf_employee}}</td>
                                        <td>{{$row->pf_employer}}</td>
                                        <td>
                                        <a  href="{{ route('employees-pf-details-edit', $row->id) }}" class="btn btn-primary btn-icon btn-sm"><i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="Edit"></i></a>
                                        <a href="#" onclick="validate('{{ $row->id }}','{{ $row->pf_employee }}')" class="btn btn-danger btn-icon btn-sm"><i class="feather feather-trash-2"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation">{!! $employees_pf_details->links('pagination.custom') !!}</nav>
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
<script src="{{asset('backend/plugins/wysiwyag/jquery.richtext.js')}}"></script>
<script src="{{asset('backend/js/form-editor.js')}}"></script>
<script src="{{asset('backend/plugins/multipleselect/multiple-select.js')}}"></script>
<script src="{{asset('backend/plugins/multipleselect/multi-select.js')}}"></script>
<script src="{{asset('backend/js/formelementadvnced.js')}}"></script>
<script src="{{asset('backend/js/form-elements.js')}}"></script>
<script src="{{asset('backend/js/select2.js')}}"></script>
<script type="text/javascript">
var i = 0;
$("#add_btn_Experience").click(function() {
    ++i;
    $("#dynamicAddRemove_Experience").append('<div class="form-group"><div class="form-group"><div class="row"><div class="col-md-3"><label class="form-label mb-0 mt-2">{{ __('Company Name') }}</label></div><div class="col-md-3"><input type="text" name="experience['+i+'][company_name]" class="form-control" placeholder="{{ __('Company Name') }}"></div><div class="col-md-3"><label class="form-label mb-0 mt-2">{{ __('Job Title') }}</label></div><div class="col-md-3"><input type="text" name="experience['+i+'][job_title]" class="form-control" placeholder="{{ __('Job Title') }}"></div></div></div><div class="form-group"><div class="row"><div class="col-md-3"><label class="form-label mb-0 mt-2">{{ __('Date of Joining') }}</label></div><div class="col-md-3"><input type="text" name="experience['+i+'][date_of_joining]" class="form-control" placeholder="{{ __('Date of Joining') }}"></div><div class="col-md-3"><label class="form-label mb-0 mt-2">{{ __('Date of Relieving') }}</label></div><div class="col-md-3"><input type="text" name="experience['+i+'][date_of_relieving]" class="form-control" placeholder="{{ __('Date of Relieving') }}"></div></div></div><div class="form-group"><div class="row"><div class="col-md-3"><label class="form-label mb-0 mt-2">{{ __('Location') }}</label></div><div class="col-md-3"><input type="text" name="experience['+i+'][location]" class="form-control" placeholder="{{ __('Location') }}"></div><div class="col-md-3"><label class="form-label mb-0 mt-2">{{ __('Description') }}</label></div><div class="col-md-3"><textarea type="text" name="experience['+i+'][description]" class="form-control" placeholder="{{ __('Description') }}"></textarea></div></div></div><div class="form-group"><div class="row"><div class="col-md-3"><div class="form-label mb-0 mt-2">{{ __('Attachments') }}</div></div><div class="col-md-3"><div class="form-group"><label class="form-label"></label><input class="form-control" name="experience['+i+'][attachment]" type="file"></div></div></div></div><button type="button" class="btn btn-danger remove-tr">Remove</button></div>');
});
$(document).on('click', '.remove-tr', function() {
    $(this).parents('.form-group').remove();
});
</script>


<script>
    $("#employees-experience").submit(function() {
        event.preventDefault();
        axios.post("{{ route('employees-experience-add') }}", new FormData($("#employees-experience")[0])).then(response => {
            var data = response.data;
            if (data.success) notif({ msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b>Department Submitted Successfully", type: "success" },setTimeout(function() { location.replace("{{ route('employees-experience') }}"); }, 3000));
            else {
				for (var a in data['error']['message']) { notify(null, data['error']['message'][a][0], 'botton left');
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
                url: "{{ route('employees-pf-details-destroy') }}" + '/' + id,
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