@extends('layouts.app')
@section('title', 'Candidates Edit')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Edit Candidates</div>
            </div>

        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" id="candidates_edit" action="" enctype="multipart/form-data">
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
                                            </div><input name="first_name" value="{{$candidates->first_name}}"
                                                class="form-control" placeholder="{{ __('Candidate First Name') }}"
                                                type="text">
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
                                            </div><input name="last_name" value="{{$candidates->last_name}}"
                                                class="form-control" placeholder="{{ __('Candidate Last Name') }}"
                                                type="text">
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
                                            <select name="requisition_id" value="" class="form-control"
                                                placeholder="{{ __('Position') }}">
                                                <option value="">Select Job Title</option>
                                                @foreach($recruitments as $key => $val)
                                                <option value="{{$val->job_title}}"
                                                    {{($candidates->requisition_id === $val->job_title) ? 'selected' : ''}}>
                                                    {{$val->job_title}}</option>
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
                                                value="{{$candidates->source}}" placeholder="{{ __('Source') }}">
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
                                            <input type="text" class="form-control" name="education_details"
                                                value="{{$candidates->education_details}}" placeholder="{{ __('Education Details') }}">
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
                                            </div><input name="interview_scheduled" value="{{$candidates->interview_scheduled}}"
                                                class="form-control" placeholder="{{ __('Interview Scheduled') }}"
                                                type="text">
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
                                            <select class="form-control" name="employment_status"
                                                    onchange="this.form.submit()">
                                                    <option value="">Select Employee Status</option>
                                                    <option value="Looking_For_Job" @if($candidates->employment_status =='Looking_For_Job'){{'selected="selected"'}}@endif>Looking For Job</option>
                                                    <option value="Working" @if($candidates->employment_status=='Working'){{'selected="selected"'}}@endif>Working</option>
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
                                            </div><input name="contact_number" value="{{$candidates->current_company}}"
                                                class="form-control" placeholder="{{ __('Current Company') }}"
                                                type="text">
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
                                                value="{{$candidates->skill_set}}" placeholder="{{ __('Current CTC') }}">
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
                                            </div><input name="expected_ctc" value="{{$candidates->expected_ctc}}"
                                                class="form-control" placeholder="{{ __('Expected CTC') }}"
                                                type="text">
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
                                            </div><input name="contact_number" value="{{$candidates->contact_number}}"
                                                class="form-control" placeholder="{{ __('Contact Number') }}"
                                                type="text">
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
                                            <input type="text" class="form-control" name="email"
                                                value="{{$candidates->email}}" placeholder="{{ __('Email') }}">
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
                                                value="{{$candidates->skill_set}}" placeholder="{{ __('Skill Set') }}">
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
                                            <input type="text" class="form-control" name="notice_period" value="{{$candidates->notice_period}}"
                                                placeholder="{{ __('Notice Period') }}" value="dayone">
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
                                            </div><input name="comments" value="{{$candidates->comments}}"
                                                class="form-control" placeholder="{{ __('Comments') }}"
                                                type="text">
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
                                            <input type="text" class="form-control" name="followup"
                                                value="{{$candidates->followup}}" placeholder="{{ __('Follow Up') }}">
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Shortlisted Candidates') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <i class='fa fa-question'></i>
                                            </div>
                                                <select class="form-control" name="shortlisted_candidates"
                                                    onchange="this.form.submit()">
                                                    <option value="">Select Shortlisted Candidates</option>
                                                    <option value="shortlisted_candidates" @if($candidates->shortlisted_candidates =='shortlisted_candidates'){{'selected="selected"'}}@endif>Shortlisted Candidates
                                                        </option>
                                                    <option value="neutral_candidate" @if($candidates->shortlisted_candidates=='neutral_candidate'){{'selected="selected"'}}@endif>Neutral
                                                        Candidate</option>
                                                    <option value="rejected_candidates" @if($candidates->shortlisted_candidates=='rejected_candidates'){{'selected="selected"'}}@endif>Rejected
                                                        Candidate</option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('UPLOAD RESUME') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-upload"></i>
                                                </div>
                                            </div>
                                            <input type="file" class="form-control" name="resume" value=""
                                                placeholder="{{ __('Required Experience Range') }}" value="dayone">
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="form-group">
                                <div class="row">
                                    
                                    <div class="col-md-3">
                                        <label class="form-label mb-0 mt-2">{{ __('Download Resume ') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <a href="{{ url('').'/uploads/resume/'.$candidates->resume;}}"
                                                class="btn btn-danger" download><i class="fa fa-download"></i></a>
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
                                        <a href="{{ route('candidates-list') }}"
                                            class="btn btn-danger btn-lg">Cancel</a>
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
        $("#candidates_edit").submit(function() {
            event.preventDefault();
              $("#submit").prop('disabled', true);
              $("#submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading....');
            axios.post("{{ route('candidates-edit', $candidates->id) }}", new FormData($("#candidates_edit")[
                0])).then(response => {
                var data = response.data;
                $('#candidates_edit')[0].reset();
                if (data.success) notif({
                    msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b> Candidates Updated Successfully",
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