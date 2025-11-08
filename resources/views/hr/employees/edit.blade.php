@extends('layouts.app')
@section('title', 'Employee List')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!--PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">{{ __('Add Employee') }}</div>
            </div>
        </div>
        <!--END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-xl-12 col-md-12 col-lg-12">
                <div class="tab-menu-heading hremp-tabs p-0 ">
                    <div class="tabs-menu1">
                        <!-- Tabs -->
                        <ul class="nav panel-tabs">
                            <li class="ms-4"><a href="#tab5" class="active"
                                    data-bs-toggle="tab">{{ __('Personal Details') }}</a></li>
                            <li><a href="#tab6" data-bs-toggle="tab">{{ __('Contact Details') }}</a></li>
                            <li><a href="#tab7" data-bs-toggle="tab">{{ __('Addresses') }}</a></li>
                            <li><a href="#tab12" data-bs-toggle="tab">{{ __('Identity Docs') }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body tabs-menu-body hremp-tabs1 p-0">
                    <form method="post" id="employees-edit" action="" enctype="multipart/form-data">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab5">
                                <div class="card-body">
                                    <h4 class="mb-4 font-weight-bold">{{ __('Basic') }}</h4>
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label class="form-label mb-0 mt-2">{{ __('Prefix') }}:</label>
                                                        <select name="prefix" class="form-control custom-select select2"
                                                            data-placeholder="Select">
                                                            <option label="{{ __('Prefix') }}"></option>
                                                            <option value="{{ __('Mr') }}" {{ $employees_get->prefix == "Mr" ? 'selected' : '' }}>{{ __('Mr') }}</option>
                                                            <option value="{{ __('Mrs') }}" {{ $employees_get->prefix == "Mrs" ? 'selected' : '' }}>{{ __('Mrs') }}</option>
                                                            <option value="{{ __('Ms') }}" {{ $employees_get->prefix == "Ms" ? 'selected' : '' }}>{{ __('Ms') }}</option>
                                                        </select>
                                                        <span class="text-muted"></span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label
                                                            class="form-label mb-0 mt-2">{{ __('First Name') }}:</label>
                                                        <input type="text" name="first_name" class="form-control" value="{{$employees_get->first_name}}"
                                                            placeholder="{{ __('First Name') }}">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label
                                                            class="form-label mb-0 mt-2">{{ __('Last Name') }}:</label>
                                                        <input type="text" name="last_name" value="{{$employees_get->last_name}}" class="form-control"
                                                            placeholder="{{ __('Last Name') }}">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label
                                                            class="form-label mb-0 mt-2">{{ __('Role') }}:</label>
                                                            <select name="role_id" class="form-control custom-select select2"
                                                            data-placeholder="Select">
                                                            <option label="{{ __('Select Role') }}"></option>
                                                            <option value="{{ __('1') }}" {{ $user_get->type == 1 ? 'selected' : '' }}>{{ __('Admin') }}</option>
                                                            <option value="{{ __('2') }}" {{ $user_get->type == 2 ? 'selected' : '' }}>{{ __('HR Manager') }}</option>
                                                            <option value="{{ __('3') }}" {{ $user_get->type == 3 ? 'selected' : '' }} selected>{{ __('Employee') }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label class="form-label mb-0 mt-2">{{ __('Gender') }}:</label>
                                                        <select name="gender" class="form-control custom-select select2"
                                                            data-placeholder="Select">
                                                            <option label="{{ __('Select Gender') }}"></option>
                                                            <option value="{{ __('Male') }}" {{ $employees_get->gender == "Male" ? 'selected' : '' }}>{{ __('Male') }}</option>
                                                            <option value="{{ __('Female') }}" {{ $employees_get->gender == "Female" ? 'selected' : '' }}>{{ __('Female') }}
                                                            </option>
                                                            <option value="{{ __('Others') }}" {{ $employees_get->gender == "Others" ? 'selected' : '' }}>{{ __('Others') }}
                                                            </option>
                                                        </select>
                                                        <span class="text-muted"></span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label
                                                            class="form-label mb-0 mt-2">{{ __('Date of Birth') }}</label>
                                                        <input type="text" name="date_of_birth" value="{{$employees_get->date_of_birth}}"
                                                            class="form-control fc-datepicker"
                                                            placeholder="{{ __('DD-MM-YYY') }}">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label
                                                            class="form-label mb-0 mt-2">{{ __('Marital Status') }}</label>
                                                        <select name="marital_status"
                                                            class="form-control custom-select select2"
                                                            data-placeholder="Select">
                                                            <option label="Select"></option>
                                                            <option value="{{ __('Single') }}" {{ $employees_get->marital_status == "Single" ? 'selected' : '' }}>{{ __('Single') }}
                                                            </option>
                                                            <option value="{{ __('Married') }}" {{ $employees_get->marital_status == "Married" ? 'selected' : '' }}>{{ __('Married') }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label
                                                            class="form-label mb-0 mt-2">{{ __('BLOOD GROUP') }}</label>
                                                        <select name="blood_group"
                                                            class="form-control custom-select select2"
                                                            data-placeholder="Select Group">
                                                            <option label="Select Group"></option>
                                                            <option value="{{ __('A+') }}" {{ $employees_get->blood_group == "A+" ? 'selected' : '' }}>{{ __('A+') }}</option>
                                                            <option value="{{ __('B+') }}" {{ $employees_get->blood_group == "B+" ? 'selected' : '' }}>{{ __('B+') }}</option>
                                                            <option value="{{ __('O+') }}" {{ $employees_get->blood_group == "O+" ? 'selected' : '' }}>{{ __('O+') }}</option>
                                                            <option value="{{ __('AB+') }}" {{ $employees_get->blood_group == "AB+" ? 'selected' : '' }}>{{ __('AB+') }}</option>
                                                            <option value="{{ __('A-') }}" {{ $employees_get->blood_group == "A-" ? 'selected' : '' }}>{{ __('A-') }}</option>
                                                            <option value="{{ __('B-') }}" {{ $employees_get->blood_group == "B-" ? 'selected' : '' }}>{{ __('B-') }}</option>
                                                            <option value="{{ __('O-') }}" {{ $employees_get->blood_group == "O-" ? 'selected' : '' }}>{{ __('O-') }}</option>
                                                            <option value="{{ __('AB-') }}" {{ $employees_get->blood_group == "AB-" ? 'selected' : '' }}>{{ __('AB-') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label
                                                            class="form-label mb-0 mt-2">{{ __('Physically Handicapped') }}</label>
                                                        <select name="physically_handicapped"
                                                            class="form-control custom-select select2"
                                                            data-placeholder="{{ __('Physically Handicapped') }}">
                                                            <option label="Select"></option>
                                                            <option value="{{ __('Yes') }}" {{ $employees_get->physically_handicapped == "Yes" ? 'selected' : '' }}>{{ __('Yes') }}</option>
                                                            <option value="{{ __('No') }}" {{ $employees_get->physically_handicapped == "No" ? 'selected' : '' }}>{{ __('No') }}</option>
                                                        </select>
                                                        <span class="text-muted"></span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label
                                                            class="form-label mb-0 mt-2">{{ __('Date Of Joining') }}</label>
                                                        <input type="text" name="date_of_joining" value="{{$employees_get->first_name}}"
                                                            class="form-control fc-datepicker"
                                                            placeholder="{{ __('Date Of Joining') }}">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label
                                                            class="form-label mb-0 mt-2">{{ __('Designation') }}</label>
                                                        <select name="designation" class="form-control custom-select select2" data-placeholder="{{ __('Designation') }}">
                                                            <option label="Select"></option>
                                                            @foreach($designtion as $key => $val)
                                                            <option value="{{$val->designtion_name}}" {{ $val->designtion_name == $employees_get->designation ? 'selected' : '' }}>
                                                                {{$val->designtion_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label mb-0 mt-2">{{ __('Department') }}</label>
                                                        <select name="department" class="form-control custom-select select2" data-placeholder="{{ __('Department') }}">
                                                            <option label="Select"></option>
                                                             @foreach($department as $key => $val)
                                                            <option value="{{$val->department_name}}"  {{ $val->department_name == $employees_get->department ? 'selected' : '' }}>{{$val->department_name}}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label
                                                            class="form-label mb-0 mt-2">{{ __('Employment Type') }}</label>
                                                        <select name="employment_type"
                                                            class="form-control custom-select select2"
                                                            data-placeholder="{{ __('Employment Type') }}">
                                                            <option label="Select"></option>
                                                            <option value="Full Time" {{ $employees_get->employment_type == "Full Time" ? 'selected' : '' }}>Full Time</option>
                                                            <option value="Part Time" {{ $employees_get->employment_type == "Part Time" ? 'selected' : '' }}>Part Time</option>
                                                            <option value="On Contract" {{ $employees_get->employment_type == "On Contract" ? 'selected' : '' }}>On Contract</option>
                                                            <option value="Internship" {{ $employees_get->employment_type == "Internship" ? 'selected' : '' }}>Internship</option>
                                                            <option value="Trainee" {{ $employees_get->employment_type == "Trainee" ? 'selected' : '' }}>Trainee</option>
                                                        </select>
                                                        <span class="text-muted"></span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label
                                                            class="form-label mb-0 mt-2">{{ __('Reporting To') }}</label>
                                                        <select name="reporting_to"
                                                            class="form-control custom-select select2"
                                                            data-placeholder="{{ __('Reporting To') }}">
                                                            <option label="Select"></option>
                                                            @foreach($employees as $key => $val)
                                                            <option value="{{$val->emp_id}}"  {{ $val->emp_id == $employees_get->reporting_to ? 'selected' : '' }}>{{$val->display_name}}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label
                                                            class="form-label mb-0 mt-2">{{ __('Profile Picture') }}</label>
                                                        <input class="form-control" id="imageUpload" name="profile_pic"
                                                            type="file">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label
                                                            class="form-label mb-0 mt-2">{{ __('Profile Picture View') }}</label>
                                                        <img src="{{asset('backend/images/no_image.png')}}"
                                                            class="profile-user-img img-responsive img-circle"
                                                            id="imagePreview" style="height: 100px;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab6">
                                 <div class="card-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Work Email') }}</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="working_email" value="{{$contact_details->working_email}}" class="form-control"
                                                    placeholder="{{ __('Work Email') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Personal Email') }}</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="contact_email" value="{{$contact_details->contact_email}}" class="form-control"
                                                    placeholder="{{ __('Personal Email') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Mobile Phone') }}</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="working_phone" value="{{$contact_details->working_phone}}" class="form-control"
                                                    placeholder="{{ __('Mobile Phone') }}">
                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Work Phone') }}</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="contact_phone" value="{{$contact_details->contact_phone}}" class="form-control"
                                                    placeholder="{{ __('Work Phone') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Residence Phone') }}</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="residence_phone" class="form-control"
                                                    placeholder="{{ __('Residence Phone') }}">
                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Skype') }}</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="skype_id" class="form-control"
                                                    placeholder="{{ __('Skype') }}">
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                            <div class="tab-pane" id="tab7">
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <h4 class="mb-5 mt-7 font-weight-bold">{{ __('CURRENT ADDRESS') }}</h4>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('ADDRESS LINE 1') }}</label>
                                                <input type="text" class="form-control" id="current_address_line_one"
                                                    name="current_address_line_one" value="{{$addresses_details->current_address_line_one}}"
                                                    placeholder="{{ __('CURRENT ADDRESS LINE 1') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('ADDRESS LINE 2') }}</label>
                                                <input type="text" id="current_address_line_two"
                                                    name="current_address_line_two" value="{{$addresses_details->current_address_line_two}}" class="form-control"
                                                    placeholder="{{ __('CURRENT ADDRESS LINE 2') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('CITY') }}</label>
                                                <input type="text" id="current_address_city" value="{{$addresses_details->current_address_city}}" name="current_address_city"
                                                    class="form-control" placeholder="{{ __('CURRENT ADDRESS CITY') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('STATE') }}</label>
                                                <input type="text" id="current_address_state" value="{{$addresses_details->current_address_state}}"
                                                    name="current_address_state" class="form-control"
                                                    placeholder="{{ __('CURRENT ADDRESS STATE') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('COUNTRY') }}</label>
                                                <input type="text" id="current_address_country" value="{{$addresses_details->current_address_country}}"
                                                    name="current_address_country" class="form-control"
                                                    placeholder="{{ __('CURRENT ADDRESS COUNTRY') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('PINCODE') }}</label>
                                                <input type="text" id="current_address_pincode" value="{{$addresses_details->current_address_pincode}}"
                                                    name="current_address_pincode" class="form-control"
                                                    placeholder="{{ __('CURRENT ADDRESS PINCODE') }}">
                                            </div>

                                            <h4 class="mb-5 mt-7 font-weight-bold">{{ __('PERMANENT ADDRESS') }}</h4>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('ADDRESS LINE 1') }}</label>
                                                <input type="text" id="permanent_address_line_one" value="{{$addresses_details->permanent_address_line_one}}"
                                                    name="permanent_address_line_one" class="form-control"
                                                    placeholder="{{ __('PERMANENT ADDRESS LINE 1') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('ADDRESS LINE 2') }}</label>
                                                <input type="text" id="permanent_address_line_two" value="{{$addresses_details->permanent_address_line_two}}"
                                                    name="permanent_address_line_two" class="form-control"
                                                    placeholder="{{ __('PERMANENT ADDRESS LINE 2') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('CITY') }}</label>
                                                <input type="text" id="permanent_address_city" value="{{$addresses_details->permanent_address_city}}"
                                                    name="permanent_address_city" class="form-control"
                                                    placeholder="{{ __('PERMANENT ADDRESS CITY') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('STATE') }}</label>
                                                <input type="text" id="permanent_address_state" value="{{$addresses_details->permanent_address_state}}"
                                                    name="permanent_address_state" class="form-control"
                                                    placeholder="{{ __('PERMANENT ADDRESS STATE') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('COUNTRY') }}</label>
                                                <input type="text" id="permanent_address_country" value="{{$addresses_details->permanent_address_country}}"
                                                    name="permanent_address_country" class="form-control"
                                                    placeholder="{{ __('PERMANENT ADDRESS COUNTRY') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('PINCODE') }}</label>
                                                <input type="text" id="permanent_address_pincode" value="{{$addresses_details->permanent_address_pincode}}"
                                                    name="permanent_address_pincode" class="form-control"
                                                    placeholder="{{ __('CURRENT ADDRESS PINCODE') }}">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label">{{ __('Same as Current Address') }}:</label>
                                            </div>
                                            <div class="col-md-9">
                                                <label class="custom-switch">
                                                    <input id="sameadd" name="sameadd" type="checkbox" value="Sameadd" onchange="CopyAdd();" class="custom-switch-input" checked>
                                                    <span class="custom-switch-indicator"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                           
                            <div class="tab-pane" id="tab12">
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-label mb-0 mt-2">Driving License</div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="form-label"></label>
                                                    <input class="form-control" name="driving_license_attachment" type="file">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-label mb-0 mt-2">PAN Card</div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="form-label"></label>
                                                    <input class="form-control" name="pan_card_attachment" type="file">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-label mb-0 mt-2">Passport</div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="form-label"></label>
                                                    <input class="form-control" name="passport_attachment" type="file">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-label mb-0 mt-2">Aadhaar</div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="form-label"></label>
                                                    <input class="form-control" name="aadhaar_attachment" type="file">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-label mb-0 mt-2">Voter Id</div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="form-label"></label>
                                                    <input class="form-control" name="voter_id_attachment" type="file">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button id="submit" class="btn btn-primary" type="submit" name="submit"> Save</button>
                                <a href="{{route('employees-list')}}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- END ROW -->

    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
var i = 0;
$("#add-btn").click(function() {
    ++i;
     $("#dynamicAddRemove").append('<div class="form-group"><div class="form-group"><div class="row"><div class="col-md-3"><label class="form-label mb-0 mt-2">{{ __('Relation ') }}</label></div><div class="col-md-3"><input type="text" name="moreFields['+i+'][relation_type]" class="form-control" placeholder="{{ __('Relation') }}"></div><div class="col-md-3"><label class="form-label mb-0 mt-2">{{ __('Gender') }}</label></div><div class="col-md-3"><input type="text" name="moreFields['+i+'][gender]" class="form-control"placeholder="{{ __('Gender') }}"></div></div></div><div class="form-group"><div class="row"><div class="col-md-3"><label class="form-label mb-0 mt-2">{{ __('First Name ') }}</label></div><div class="col-md-3"><input type="text" name="moreFields['+i+'][first_name]" class="form-control" placeholder="{{ __('First Name ') }}"></div><div class="col-md-3"><label class="form-label mb-0 mt-2">{{ __('Last Name ') }}</label></div><div class="col-md-3"><input type="text" name="moreFields['+i+'][last_name]" class="form-control" placeholder="{{ __('Last Name ') }}"></div></div></div><div class="form-group"><div class="row"><div class="col-md-3"><label class="form-label mb-0 mt-2">{{ __('Mobile ') }}</label></div><div class="col-md-3"><input type="text" name="moreFields['+i+'][mobile]" class="form-control" placeholder="{{ __('Mobile ') }}"></div><div class="col-md-3"><label class="form-label mb-0 mt-2">{{ __('Profession ') }}</label></div><div class="col-md-3"><input type="text" name="moreFields['+i+'][profession]" class="form-control" placeholder="{{ __('Profession ') }}"></div></div></div><div class="form-group"></div><button type="button" class="btn btn-danger remove-tr">Remove</button></div>');
});
$(document).on('click', '.remove-tr', function() {
    $(this).parents('.form-group').remove();
});
</script>
<script>
$(document).ready(function() {
    $("#imageUpload").change(function(data) {
        var imageFile = data.target.files[0];
        var reader = new FileReader();
        reader.readAsDataURL(imageFile);
        reader.onload = function(evt) {
            $('#imagePreview').attr('src', evt.target.result);
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
    });
});
</script>
<script>
$('#random_password').click(function() {
    const randPassword = Math.random().toString(36).substr(2, 12);
    $('#password').val(randPassword);
});

function CopyAdd() {
    var cb1 = document.getElementById('sameadd');
    var a1 = document.getElementById('current_address_line_one');
    var al1 = document.getElementById('permanent_address_line_one');
    var a2 = document.getElementById('current_address_line_two');
    var al2 = document.getElementById('permanent_address_line_two');
    var a3 = document.getElementById('current_address_city');
    var al3 = document.getElementById('permanent_address_city');
    var v1 = document.getElementById('current_address_state');
    var vl1 = document.getElementById('permanent_address_state');
    var t1 = document.getElementById('current_address_country');
    var tl1 = document.getElementById('permanent_address_country');
    var c1 = document.getElementById('current_address_pincode');
    var cl1 = document.getElementById('permanent_address_pincode');
    var d1 = document.getElementById('stu_pre_dist');
    var dl1 = document.getElementById('stu_pre_dist_permanent');

    if (cb1.checked) {
        al1.value = a1.value;
        al2.value = a2.value;
        al3.value = a3.value;
        vl1.value = v1.value;
        tl1.value = t1.value;
        cl1.value = c1.value;
        dl1.value = d1.value;

    } else {
        al1.value = '';
        al2.value = '';
        al3.value = '';
        vl1.value = '';
        tl1.value = '';
        cl1.value = '';
        dl1.value = '';

    }
}
</script>
<script>
$("#employees-edit").submit(function() {
    event.preventDefault();
    $("#submit").prop('disabled', true);
    $("#submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading....');
    axios.post("{{ route('employees-edit', $employees_get->id) }}", new FormData($("#employees-edit")[0])).then(response => {
        var data = response.data;
        if (data.success) notif({
            msg: "<b><i class='fa fa-check-circle-o fs-20 me-2'></i></b>Employees Submitted Successfully",
            type: "success"
        }, setTimeout(function() {
            location.replace("{{ route('employees-list') }}");
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