@extends('layouts.app')
@section('title', 'Recruitments Edit')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Add Recruitment</div>
            </div>
        </div>
        <!-- END PAGE HEADER -->
        <!-- ROW -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                    <form method="post" id="recruitment-edit" action="" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">{{ __('Requisition Code') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-code"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="requisition_code" value="{{$recruitments->requisition_code}}"
                                            placeholder="{{ __('Requisition Code') }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">{{ __('Job Title') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-briefcase"></i>
                                            </div>
                                        </div><input name="job_title" value="{{$recruitments->job_title}}" class="form-control"
                                            placeholder="{{ __('Job Title') }}" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">{{ __('Position') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div><input name="position" value="{{$recruitments->position}}" class="form-control"
                                            placeholder="{{ __('Position') }}" type="text">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">{{ __('Required no. of Positions') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-meh-o"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="no_of_positions" value="{{$recruitments->no_of_positions}}"
                                            placeholder="{{ __('Required Experience Range') }}" value="dayone">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">{{ __('Job Description') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-certificate"></i>
                                            </div>
                                        </div>
                                        <textarea id="w3review" class="form-control" name="job_description"
                                            name="w3review" rows="4" cols="50">{{$recruitments->job_description}}</textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">{{ __('Required Skills') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-certificate"></i>
                                            </div>
                                        </div>
                                        <textarea id="w3review" class="form-control" name="required_skills"
                                         rows="4" cols="50">{{$recruitments->required_skills}}</textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">{{ __('Required Qualification') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-graduation-cap"></i>
                                            </div>
                                        </div><input name="required_qualification" value="{{$recruitments->required_qualification}}" class="form-control"
                                            placeholder="{{ __('Required Qualification') }}" type="text">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">{{ __('Required Experience Range') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-history"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="required_experience_range" value="{{$recruitments->required_experience_range}}"
                                            placeholder="{{ __('Required Experience Range') }}" value="dayone">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">{{ __('Employment Status') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-superpowers"></i>
                                            </div>
                                        </div>
                                        <select name="employment_status" value="" class="form-control"
                                            placeholder="{{ __('Employment Status') }}">
                                            <option value="Contract" {{($recruitments->employment_status ==='Contract') ? 'selected' : ''}}>Contract</option>
                                            <option value="Full Time" {{($recruitments->employment_status ==='Full Time') ? 'selected' : ''}}>Full Time</option>
                                            <option value="Part Time" {{($recruitments->employment_status ==='Part Time') ? 'selected' : ''}}>Part Time</option>
                                            <option value="Permanent" {{($recruitments->employment_status ==='Permanent') ? 'selected' : ''}}>Permanent</option>
                                            <option value="Temporary" {{($recruitments->employment_status ==='Temporary') ? 'selected' : ''}}>Temporary</option>
                                            <option value="Internship" {{($recruitments->employment_status ==='Internship') ? 'selected' : ''}}>Internship</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">{{ __('Priority') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-level-up"></i>
                                            </div>
                                        </div>
                                        <select name="priority" value="" class="form-control"
                                            placeholder="{{ __('Employment Status') }}">
                                            <option value="">Select Priority</option>
                                            <option value="High" {{($recruitments->priority ==='High') ? 'selected' : ''}}>High</option>
                                            <option value="Low" {{($recruitments->priority ==='Low') ? 'selected' : ''}}>Low</option>
                                            <option value="Medium" {{($recruitments->priority ==='Medium') ? 'selected' : ''}}>Medium</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">{{ __('Due Date') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="feather feather-calendar"></i>
                                            </div>
                                        </div><input class="form-control" name="due_date" value="{{$recruitments->due_date}}"
                                            data-bs-toggle="modaldatepicker" placeholder="MM/DD/YYYY">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">{{ __('Recruitment Status') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-wifi"></i>
                                            </div>
                                        </div> <select name="recruitment_status" value="" class="form-control"
                                            placeholder="{{ __('Employment Status') }}">
                                            <option value="">Select Recruitment Status</option>
                                            <option value="Open" {{($recruitments->recruitment_status ==='Open') ? 'selected' : ''}}>Open</option>
                                            <option value="Close" {{($recruitments->recruitment_status ==='Close') ? 'selected' : ''}}>Close</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-2">
                                </div>
                                <div class="col-md-12 col-lg-8">
                                <button id="submit" class="btn btn-primary btn-lg" type="submit" name="submit"> Save</button>
                                    <a href="{{route('recruitments')}}" class="btn btn-danger btn-lg">Cancel</a>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <!-- END ROW -->
            </div>
        </div>
@endsection
@section('script')
<script>
$('[data-bs-toggle="modaldatepicker"]').datepicker({
    autoHide: true,
    zIndex: 999998
});

$("#recruitment-edit").submit(function() {
    event.preventDefault();
    $("#submit").prop('disabled', true);
    $("#submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading....');
    axios.post("{{ route('edit-recruitment',$recruitments->id) }}", new FormData($("#recruitment-edit")[0])).then(response => {
        var data = response.data;
        $('#recruitment-edit')[0].reset();
        if (data.success)  notif({ msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b> Update Recruitment Submitted Successfully", type: "success" },setTimeout(function() { location.replace("{{ route('recruitments') }}"); }, 3000));
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
@stop