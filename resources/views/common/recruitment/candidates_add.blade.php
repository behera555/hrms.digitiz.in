@extends('layouts.app')
@section('title', 'Candidates Add')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Add Candidates</div>
            </div>

        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" id="candidates_add" action="" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Candidate First Name') }}  <b style="color: red;">*</b> :</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                            </div><input name="first_name" value="" class="form-control"
                                                placeholder="{{ __('Candidate First Name') }}" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Candidate Last Name') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                            </div><input name="last_name" value="" class="form-control"
                                                placeholder="{{ __('Candidate Last Name') }}" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Position') }}  <b style="color: red;">*</b> :</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class='fa fa-id-badge'></i>
                                                </div>
                                            </div>
                                                <select name="requisition_id" value="" class="form-control" placeholder="{{ __('Position') }}">
                                                <option value="">Select Job Title</option>    
                                                @foreach($recruitments as $key => $val)
                                                <option value="{{$val->job_title}}">{{$val->job_title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Platform') }}  <b style="color: red;">*</b> :</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-globe"></i>
                                                </div>
                                            </div>
                                            
                                            <input type="text" class="form-control" name="source"
                                                value="" placeholder="{{ __('Source') }}"
                                                value="dayone">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">

                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Education Details') }}  <b style="color: red;">*</b> :</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class='fa fa-graduation-cap'></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="education_details" placeholder="{{ __('Education Details') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Interview Scheduled') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                   <i class='fa fa-black-tie'></i>
                                                </div>
                                            </div><input name="interview_scheduled" value="" class="form-control"
                                                placeholder="{{ __('Interview Scheduled') }}" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Employee Status') }}  <b style="color: red;">*</b> :</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class='fa fa-vcard'></i>
                                                </div>
                                            </div>
                                            <select name="employment_status" value="" class="form-control" placeholder="{{ __('Employee Status') }}">
                                                <option value="" selected>Select Employee Status </option>
                                                <option value="Looking_For_Job">Looking For Job</option>
                                                <option value="Working">Currently Working</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Current Company') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class='fa fa-building'></i>
                                                </div>
                                            </div><input name="current_company" value="" class="form-control"
                                                placeholder="{{ __('Current Company') }}" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Current CTC') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class='fa fa-rupee'></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="ctc"
                                                value="" placeholder="{{ __('Current CTC') }}"
                                                value="dayone">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Expected CTC') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class='fa fa-rupee'></i>
                                                </div>
                                            </div><input name="expected_ctc" value="" class="form-control"
                                                placeholder="{{ __('Expected CTC') }}" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Contact Number') }}  <b style="color: red;">*</b> :</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-mobile"></i>
                                                </div>
                                            </div><input name="contact_number" value="" class="form-control"
                                                placeholder="{{ __('Contact Number') }}" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Email') }}  <b style="color: red;">*</b> :</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-envelope-o"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="email" placeholder="{{ __('Email') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Skill Set') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class='fa fa-search'></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="skill_set"
                                                value="" placeholder="{{ __('Skill Set') }}"
                                                value="dayone">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Notice Period') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class='fa fa-envelope-open-o'></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="notice_period" placeholder="{{ __('Notice Period') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Comments') }}  <b style="color: red;">*</b> :</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class='fa fa-comments'></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="comments"
                                                value="" placeholder="{{ __('Comments') }}"
                                                value="dayone">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Follow Up') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class='fa fa-exchange'></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="followup" placeholder="{{ __('Follow Up') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Status') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class='fa fa-question'></i>
                                                </div>
                                            </div>
                                            <select name="shortlisted_candidates" value="" class="form-control" placeholder="{{ __('Status') }}">
                                               <option value="" selected>Select Status</option> 
                                                <option value="shortlisted_candidates">Good</option>
                                                <option value="neutral_candidate">Neutral</option>
                                                <option value="rejected_candidates">Rejected</option>
                                            </select>
                                            <!--<input type="text" class="form-control" name="status"
                                                value="" placeholder="{{ __('Status') }}"
                                                value="dayone">-->
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('UPLOAD RESUME') }}  <b style="color: red;">*</b> :</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-upload"></i>
                                                </div>
                                            </div>
                                            <input type="file" class="form-control" name="resume"
                                                value="" placeholder="{{ __('Required Experience Range') }}"
                                                value="dayone">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    
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
        $("#candidates_add").submit(function() {
            event.preventDefault();
            $("#submit").prop('disabled', true);
            $("#submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading....');
            axios.post("{{ route('candidates-add') }}", new FormData($("#candidates_add")[0])).then(response => {
                var data = response.data;
                $('#candidates_add')[0].reset();
                if (data.success) notif({
                    msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b> Candidate Added Successfully",
                    type: "success"
                }, setTimeout(function() {
                    location.replace("{{ route('candidates-list') }}");
                }, 3000));
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