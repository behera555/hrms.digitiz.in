@extends('layouts.app')
@section('title', 'Employee Add')
@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">

        <!--PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader col">
                <div class="page-title col">{{ __('View Profile') }} <br> <h5>{{ optional($employees_get)->prefix}}. {{ optional($employees_get)->first_name}} {{ optional($employees_get)->last_name}}</h5></div>
            </div>
        </div>
        <!--END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-xl-14 col-md-14 col-lg-14">
                <div class="tab-menu-heading hremp-tabs p-0 ">
                    <div class="tabs-menu1">
                        <!-- Tabs -->
                        <ul class="nav panel-tabs">
                            <li class="ms-4"><a href="#tab1" class="active"
                                    data-bs-toggle="tab">{{ __('Personal Details') }}</a></li>
                            <li><a href="#tab2" data-bs-toggle="tab">{{ __('Contact Details') }}</a></li>
                            <li><a href="#tab3" data-bs-toggle="tab">{{ __('Addresses') }}</a></li>
                            <li><a href="#tab4" data-bs-toggle="tab">{{ __('Education Details') }}</a></li>
                            <li><a href="#tab5" data-bs-toggle="tab">{{ __('Experience Details') }}</a></li>
                            <li><a href="#tab6" data-bs-toggle="tab">{{ __('Bank Details') }}</a></li>
                            <li><a href="#tab7" data-bs-toggle="tab">{{ __('Salary Package') }}</a></li>
                            <li class="" style="margin-top:10px; margin-left:18px;"><a href="#tab8" data-bs-toggle="tab">{{ __('Relation Details') }}</a></li>
                            <li style="margin-top:10px;"><a href="#tab9" data-bs-toggle="tab">{{ __('Employees PF Detail') }}</a></li>
                            <li style="margin-top:10px;"><a href="#tab10" data-bs-toggle="tab">{{ __('Identity Docs') }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body tabs-menu-body hremp-tabs1 p-0">
                    <form method="post" id="employees-store" action="" enctype="multipart/form-data">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1">
                                <div class="card-body">
                                    <h4 class="mb-4 font-weight-bold">{{ __('Personal Details') }}</h4>
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-3 text-center">
                                                    <span class="avatar avatar-md brround me-3 "
                                                    style="background-image: url({{url('').'/uploads/passport/'.$employees_get->profile_pic;}});width: 100px; height: 100px;"></span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label
                                                            class="form-label mb-0 mt-2">{{ __('Employee ID') }}</label>
                                                        <input type="text" class="form-control" readonly="readonly"
                                                            placeholder="{{ __('NA') }}" value="{{ optional($employees_get)->emp_id}}">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label
                                                            class="form-label mb-0 mt-2">{{ __('Employee Name') }}</label>
                                                            <input type="text" class="form-control" readonly="readonly"
                                                            placeholder="{{ __('NA') }}" value="{{ optional($employees_get)->prefix}}. {{ optional($employees_get)->first_name}} {{ optional($employees_get)->last_name}}">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label
                                                            class="form-label mb-0 mt-2">{{ __('Gender') }}</label>
                                                        <input type="text" class="form-control" readonly="readonly"
                                                            placeholder="{{ __('NA') }}" value="{{ optional($employees_get)->gender}}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    
                                                    <div class="col-md-3">
                                                        <label
                                                            class="form-label mb-0 mt-2">{{ __('Date of Birth') }}</label>
                                                            <input type="text" class="form-control" readonly="readonly"
                                                            placeholder="{{ __('NA') }}" value="{{ optional($employees_get)->date_of_birth}}">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label
                                                            class="form-label mb-0 mt-2">{{ __('Marital Status') }}</label>
                                                            <input type="text" class="form-control" readonly="readonly"
                                                            placeholder="{{ __('NA') }}" value="{{ optional($employees_get)->marital_status}}">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label
                                                            class="form-label mb-0 mt-2">{{ __('BLOOD GROUP') }}</label>
                                                            <input type="text" class="form-control" readonly="readonly"
                                                            placeholder="{{ __('NA') }}" value="{{ optional($employees_get)->blood_group}}">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label
                                                            class="form-label mb-0 mt-2">{{ __('Physically Handicapped') }}</label>
                                                            <input type="text" class="form-control" readonly="readonly"
                                                            placeholder="{{ __('NA') }}" value="{{ optional($employees_get)->physically_handicapped}}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    
                                                    <div class="col-md-3">
                                                        <label
                                                            class="form-label mb-0 mt-2">{{ __('Date Of Joining') }}</label>
                                                            <input type="text" class="form-control" readonly="readonly"
                                                            placeholder="{{ __('NA') }}" value="{{ optional($employees_get)->date_of_joining}}">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label
                                                            class="form-label mb-0 mt-2">{{ __('Designation') }}</label>
                                                            <input type="text" class="form-control" readonly="readonly"
                                                            placeholder="{{ __('NA') }}" value="{{ optional($employees_get)->designation}}">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label
                                                            class="form-label mb-0 mt-2">{{ __('Department') }}</label>
                                                            <input type="text" class="form-control" readonly="readonly"
                                                            placeholder="{{ __('NA') }}" value="{{ optional($employees_get)->department}}">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label
                                                            class="form-label mb-0 mt-2">{{ __('Employment Type') }}</label>
                                                            <input type="text" class="form-control" readonly="readonly"
                                                            placeholder="{{ __('NA') }}" value="{{ optional($employees_get)->employment_type}}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    
                                                    <div class="col-md-3">
                                                        <label
                                                            class="form-label mb-0 mt-2">{{ __('Reporting To') }}</label>
                                                            <input type="text" class="form-control" readonly="readonly"
                                                            placeholder="{{ __('NA') }}" value="{{ optional($employees_get)->reporting_to}}">
                                                        
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label mb-0 mt-2">{{ __('Status') }}</label>
                                                        @if(\App\Models\User::where(['emp_id' => $employees_get->emp_id])->pluck('active')->first() == 0)
                                                        <span class="badge badge-danger">Deactivate</span>
                                                        @else
                                                        <span class="badge badge-success">Active</span></td>
                                                        @endif  
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label mb-0 mt-2">{{ __('Action') }}</label>
                                                        <a class="btn btn-primary btn-icon btn-sm" href="{{ route('employees-edit', $employees_get->id) }}">
                                                            <i class="feather feather-edit" data-bs-toggle="tooltip"
                                                            data-original-title="View/Edit"></i>
                                                        </a>
                                                        @if(\App\Models\User::where(['emp_id' => $employees_get->emp_id])->pluck('active')->first() == 0)
                                                        <a href="#" onclick="validates('{{ $employees_get->emp_id }}','{{ $employees_get->display_name }}')" class="btn btn-danger btn-icon btn-sm"><i class="fa fa-toggle-off"></i></a>
                                                        @else
                                                        <a href="#" onclick="validate('{{ $employees_get->emp_id }}','{{ $employees_get->display_name }}')" class="btn btn-success btn-icon btn-sm"><i class="fa fa-toggle-on"></i></a>
                                                        @endif
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    
                                </div>
                            </div>
                            <div class="tab-pane" id="tab2">
                                 <div class="card-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <h3 class="mb-5 mt-7 font-weight-bold">{{ __('Contact Details') }}</h3>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Work Email') }}</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="email" class="form-control" readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($contact_details)->working_email}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Personal Email') }}</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="email" class="form-control" readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($contact_details)->contact_email}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Mobile Phone') }}</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="contact_phone" class="form-control" readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($contact_details)->contact_phone}}">
                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Work Phone') }}</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="working_phone" class="form-control" readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($contact_details)->working_phone}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab3">
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <h4 class="mb-5 mt-7 font-weight-bold">{{ __('CURRENT ADDRESS') }}</h4>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('ADDRESS LINE 1') }}</label>
                                                <input type="text" class="form-control" readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($addresses_details)->current_address_line_one}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('ADDRESS LINE 2') }}</label>
                                                <input type="text" class="form-control" readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($addresses_details)->current_address_line_two}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('CITY') }}</label>
                                                <input type="text" readonly="readonly"
                                                    class="form-control" placeholder="{{ __('NA') }}" value="{{ optional($addresses_details)->current_address_city}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('STATE') }}</label>
                                                <input type="text" class="form-control" readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($addresses_details)->current_address_state}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('COUNTRY') }}</label>
                                                <input type="text" class="form-control" readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($addresses_details)->current_address_country}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('PINCODE') }}</label>
                                                <input type="text" class="form-control" readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($addresses_details)->current_address_pincode}}">
                                            </div>

                                            <h4 class="mb-5 mt-7 font-weight-bold">{{ __('PERMANENT ADDRESS') }}</h4>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('ADDRESS LINE 1') }}</label>
                                                <input type="text" class="form-control" readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($addresses_details)->permanent_address_line_one}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('ADDRESS LINE 2') }}</label>
                                                <input type="text" class="form-control" readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($addresses_details)->permanent_address_line_two}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('CITY') }}</label>
                                                <input type="text" class="form-control" readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($addresses_details)->permanent_address_city}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('STATE') }}</label>
                                                <input type="text" class="form-control" readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($addresses_details)->permanent_address_state}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('COUNTRY') }}</label>
                                                <input type="text" class="form-control" readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($addresses_details)->permanent_address_country}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('PINCODE') }}</label>
                                                <input type="text" class="form-control" readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($addresses_details)->permanent_address_pincode}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab4">
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="btn-list">
                                            <a href="{{route('employees-education-add')}}" class="btn btn-primary me-3" Cstyle="margin-left:800px;">Add Employees Education Details</a>
                                        </div>
                                        @foreach($employees_education as $key => $row)
                                        <div class="row">
                                            <h4 class="mb-5 mt-7 font-weight-bold">{{ __('Education Details') }}</h4>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Degree') }}</label>
                                                <input type="text" class="form-control" readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($row)->degree}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Specialization') }}</label>
                                                <input type="text" class="form-control" readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($row)->specialization}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Year Of Joining') }}</label>
                                                <input type="text" readonly="readonly"
                                                    class="form-control" placeholder="{{ __('NA') }}" value="{{ optional($row)->year_of_joining}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Year Of Completion') }}</label>
                                                <input type="text" class="form-control" readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($row)->year_of_completion}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('CGPA / Percentage') }}</label>
                                                <input type="text" class="form-control" readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($row)->cgpa}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('University / College') }}</label>
                                                <input type="text" class="form-control" readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($row)->college}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('EducationCertificate') }}</label>
                                                <a href="{{url('uploads/education/'.optional($row)->attachment)}}" class="btn btn-success btn-icon btn-sm" download><i class="feather feather-download"></i></a>
                                                <a href="{{url('uploads/education/'.optional($row)->attachment)}}" class="btn btn-primary btn-icon btn-sm" target=”_blank”><i class="feather feather-eye"></i></a>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Action') }}</label>
                                                <a  href="{{ route('employees-education-edit',$row->id ) }}" class="btn btn-primary btn-icon btn-sm"><i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="Edit"></i></a>
                                                <a href="#"  onclick="educationdelete('{{ $row->id }}','{{ $row->degree }}')" class="btn btn-danger btn-icon btn-sm"><i class="feather feather-trash-2"></i></a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab5">
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="btn-list">
                                            <a href="{{route('employees-experience-add')}}" class="btn btn-primary me-3" Cstyle="margin-left:800px;">Add Employees Experience Details</a>
                                        </div>
                                        @foreach($employees_experience_details as $key => $row)
                                        <div class="row">
                                            <h4 class="mb-5 mt-7 font-weight-bold">{{ __('Experience Details') }}</h4>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Company Name') }}</label>
                                                <input type="text" class="form-control" readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($row)->company_name}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Job Title') }}</label>
                                                <input type="text" class="form-control" readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($row)->job_title}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Date Of Joining') }}</label>
                                                <input type="text" readonly="readonly"
                                                    class="form-control" placeholder="{{ __('NA') }}" value="{{ optional($row)->date_of_joining}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Date Of Relieving') }}</label>
                                                <input type="text" class="form-control" readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($row)->date_of_relieving}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Location') }}</label>
                                                <input type="text" class="form-control" readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($row)->location}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Description') }}</label>
                                                <input type="text" class="form-control" readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($row)->description}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Experience Certificate') }}</label>
                                                <a href="{{url('uploads/experience/'.optional($row)->attachment)}}" class="btn btn-success btn-icon btn-sm" download><i class="feather feather-download"></i></a>
                                                <a href="{{url('uploads/experience/'.optional($row)->attachment)}}" class="btn btn-primary btn-icon btn-sm" target=”_blank”><i class="feather feather-eye"></i></a>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Action') }}</label>
                                                <a  href="{{ route('employees-experience-edit', $row->id) }}" class="btn btn-primary btn-icon btn-sm"><i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="Edit"></i></a>
                                                <a href="#" onclick="experiencedelete('{{ $row->id }}','{{ $row->job_title }}')" class="btn btn-danger btn-icon btn-sm"><i class="feather feather-trash-2"></i></a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab6">
                                
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="btn-list">
                                            <a href="{{route('employees-bank-details-add')}}" class="btn btn-primary me-3" Cstyle="margin-left:800px;">Add Employees Bank Details</a>
                                        </div>
                                        @foreach($bank_details as $key => $row)
                                        <div class="row">
                                            <h4 class="mb-5 mt-7 font-weight-bold">{{ __('Bank Details') }}</h4>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Bank Name') }}</label>
                                                <input type="text" class="form-control"  readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($row)->bank_name}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('IFSC Code') }}</label>
                                                <input type="text" class="form-control" readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($row)->bank_ifsc}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Bank Account Number') }}</label>
                                                <input type="text" readonly="readonly"
                                                    class="form-control" placeholder="{{ __('NA') }}" value="{{ optional($row)->bank_account}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('PAN Card Number') }}</label>
                                                <input type="text" class="form-control" readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($row)->pan}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('UAN Number') }}</label>
                                                <input type="text" class="form-control" readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($row)->uan}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('PF Number') }}</label>
                                                <input type="text" class="form-control" readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($row)->pf_number}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Action') }}</label>
                                                <a  href="{{ route('employees-bank-details-edit', optional($row)->id) }}" class="btn btn-primary btn-icon btn-sm"><i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="Edit"></i></a>
                                                <a href="#" onclick="bankdelete('{{ optional($row)->id }}','{{ optional($row)->bank_name }}')" class="btn btn-danger btn-icon btn-sm"><i class="feather feather-trash-2"></i></a>
                                            </div>
                                        </div>
                                        @endforeach    
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab7">
                                <div class="card-body">
                                <div class="form-group">
                                    <div class="btn-list">
                                        <a href="{{route('employees-salary-package-list')}}" class="btn btn-primary me-3" Cstyle="margin-left:800px;">Add Employees Salary Package</a>
                                    </div>
                                    @foreach($employees_salary_package as $key => $row)
                                    <div class="row">
                                        <h4 class="mb-5 mt-7 font-weight-bold">{{ __('Salary Package') }}</h4>
                                        <div class="col-md-3">
                                            <label class="form-label mb-0 mt-2">{{ __('Annual Package') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="email" class="form-control" readonly="readonly"
                                                placeholder="{{ __('NA') }}" value="{{ optional($row)->annual_package}}">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label mb-0 mt-2">{{ __('Monthly Package') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="email" class="form-control" readonly="readonly"
                                                placeholder="{{ __('NA') }}" value="{{ optional($row)->monthly_package}}">
                                        </div>
                                        <div class="col-md-3" style="margin-top:10px;">
                                            <label class="form-label mb-0 mt-2">{{ __('Action') }}</label>
                                        </div>
                                        <div class="col-md-3" style="margin-top:10px;">
                                        <a  href="{{ route('employees-salary-package-edit', optional($row)->id) }}" class="btn btn-primary btn-icon btn-sm"><i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="Edit"></i></a>
                                            <a href="#" onclick="salarydelete('{{ $row->id }}','{{\App\Models\User::where(['emp_id' => $row->emp_id])->pluck('name')->first();}}')" class="btn btn-danger btn-icon btn-sm"><i class="feather feather-trash-2"></i></a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab8">
                                <div class="card-body">
                                    <div class="form-group">
                                    <div class="btn-list">
                                        <a href="{{route('employees-relations-details-add')}}" class="btn btn-primary me-3" Cstyle="margin-left:800px;">Add Employees Relation Details</a>
                                    </div>
                                        @foreach($relations_details as $key => $row)
                                        <div class="row">
                                            <h4 class="mb-5 mt-7 font-weight-bold">{{ __('Relation Details') }}</h4>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Relation Type') }}</label>
                                                <input type="text" class="form-control"readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($row)->relation_type}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Name') }}</label>
                                                <input type="text" class="form-control" readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($row)->first_name}} {{ optional($row)->last_name}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Gender') }}</label>
                                                <input type="text" class="form-control" readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($row)->gender}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Email') }}</label>
                                                <input type="text" class="form-control" readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($row)->email}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Contact Number') }}</label>
                                                <input type="text" class="form-control" readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($row)->mobile}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('profession') }}</label>
                                                <input type="text" class="form-control" readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($row)->profession}}">
                                            </div>
                                            <!--<div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Date Of Brith') }}</label>
                                                <input type="text" class="form-control" readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($row)->date_of_birth}}">
                                            </div>-->
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{ __('Action') }}</label>
                                                <a  href="{{ route('employees-relations-details-edit', $row->id) }}" class="btn btn-primary btn-icon btn-sm"><i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="Edit"></i></a>
                                                <a href="#" onclick="relationdelte('{{ $row->id }}','{{ $row->relation_type }}')" class="btn btn-danger btn-icon btn-sm"><i class="feather feather-trash-2"></i></a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab9">
                                <div class="card-body">
                                <div class="form-group">
                                    <div class="btn-list">
                                        <a href="{{route('employees-pf-details-add')}}" class="btn btn-primary me-3" Cstyle="margin-left:800px;">PF Details</a>
                                    </div>
                                        @foreach($pf_details as $key => $row)
                                    <div class="row">
                                        <h4 class="mb-5 mt-7 font-weight-bold">{{ __('PF Details') }}</h4>
                                        <div class="col-md-3">
                                            <label class="form-label mb-0 mt-2">{{ __('PF Employee') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="email" class="form-control" readonly="readonly"
                                                placeholder="{{ __('NA') }}" value="{{ optional($row)->pf_employee}}">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label mb-0 mt-2">{{ __('PF Employer') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="email" class="form-control" readonly="readonly"
                                                placeholder="{{ __('NA') }}" value="{{ optional($row)->pf_employer}}">
                                        </div>
                                        <div class="col-md-3" style="margin-top:10px;">
                                            <label class="form-label mb-0 mt-2">{{ __('Action') }}</label>
                                        </div>
                                        <div class="col-md-3" style="margin-top:10px;">
                                            <a  href="{{ route('employees-pf-details-edit', $row->id) }}" class="btn btn-primary btn-icon btn-sm"><i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="Edit"></i></a>
                                            <a href="#" onclick="pfdelete('{{ $row->id }}','{{ $row->pf_employee }}')" class="btn btn-danger btn-icon btn-sm"><i class="feather feather-trash-2"></i></a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab10">
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-label mb-0 mt-2">Driving License</div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label class="form-label"></label>
                                                    <input type="text" class="form-control" readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($documents_details)->driving_license_attachment}}">
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-3" style="margin-top:8px;">
                                                <a href="{{url('uploads/employee_document/'.optional($documents_details)->driving_license_attachment)}}" class="btn btn-success btn-icon btn-sm" download><i class="feather feather-download"></i></a>
                                                <a href="{{url('uploads/employee_document/'.optional($documents_details)->driving_license_attachment)}}" class="btn btn-primary btn-icon btn-sm" target=”_blank”><i class="feather feather-eye"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-label mb-0 mt-2">PAN Card</div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label class="form-label"></label>
                                                    <input type="text" class="form-control" readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($documents_details)->pan_card_attachment}}">
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-3" style="margin-top:8px;">
                                                <a href="{{url('uploads/employee_document/'.optional($documents_details)->pan_card_attachment)}}" class="btn btn-success btn-icon btn-sm" download><i class="feather feather-download"></i></a>
                                                <a href="{{url('uploads/employee_document/'.optional($documents_details)->pan_card_attachment)}}" class="btn btn-primary btn-icon btn-sm" target=”_blank”><i class="feather feather-eye"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-label mb-0 mt-2">Passport</div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label class="form-label"></label>
                                                    <input type="text" class="form-control" readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($documents_details)->passport_attachment}}">
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-3" style="margin-top:8px;">
                                                <a href="{{url('uploads/employee_document/'.optional($documents_details)->passport_attachment)}}" class="btn btn-success btn-icon btn-sm" download><i class="feather feather-download"></i></a>
                                                <a href="{{url('uploads/employee_document/'.optional($documents_details)->passport_attachment)}}" class="btn btn-primary btn-icon btn-sm" target=”_blank”><i class="feather feather-eye"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-label mb-0 mt-2">Aadhaar</div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label class="form-label"></label>
                                                    <input type="text" class="form-control" readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($documents_details)->aadhaar_attachment}}">
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-3" style="margin-top:8px;">
                                                <a href="{{url('uploads/employee_document/'.optional($documents_details)->aadhaar_attachment)}}" class="btn btn-success btn-icon btn-sm" download><i class="feather feather-download"></i></a>
                                                <a href="{{url('uploads/employee_document/'.optional($documents_details)->aadhaar_attachment)}}" class="btn btn-primary btn-icon btn-sm" target=”_blank”><i class="feather feather-eye"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-label mb-0 mt-2">Voter Id</div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label class="form-label"></label>
                                                    <input type="text" class="form-control" readonly="readonly"
                                                    placeholder="{{ __('NA') }}" value="{{ optional($documents_details)->voter_id_attachment}}">
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-3" style="margin-top:8px;">
                                                <a href="{{url('uploads/employee_document/'.optional($documents_details)->voter_id_attachment)}}" class="btn btn-success btn-icon btn-sm" download><i class="feather feather-download"></i></a>
                                                <a href="{{url('uploads/employee_document/'.optional($documents_details)->voter_id_attachment)}}" class="btn btn-primary btn-icon btn-sm" target=”_blank”><i class="feather feather-eye"></i></a>
                                            </div>
                                        </div>
                                    </div>
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
<script>
function validate(id, title) {
    swal({
        title: "Are you sure?",
        text: "Are you sure you want to Deactive this record" + " " + title,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Deactive it!",
        closeOnConfirm: false
    }, function() {
        $.ajax({
                type:'DELETE',
                url: "{{ route('destroy') }}" + '/' + id,
                data:{"_token": "{{ csrf_token() }}",},
                success: function (data) {
                    var jso = JSON.stringify(data); 
                    if (data.success){
                        swal({
                            title: "Deactivated!",
                            text: "Employee has been deactivated.",
                            type: "success",
                        });
                        location.reload();
                            }
                    }         
            });
    });
}
function validates(id, title) {
    swal({
        title: "Are you sure?",
        text: "Are you sure you want to Active this record" + " " + title,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Activate it!",
        closeOnConfirm: false
    }, function() {
        $.ajax({
                type:'DELETE',
                url: "{{ route('destroy') }}" + '/' + id,
                data:{"_token": "{{ csrf_token() }}",},
                success: function (data) {
                    var jso = JSON.stringify(data); 
                    if (data.success){
                        swal({
                            title: "Activate!",
                            text: "Employee has been activated.",
                            type: "success",
                        });
                        location.reload();
                            }
                    }         
            });
    });
}

</script>
<script>
function educationdelete(id, title) {
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
                url: "{{ route('employees_education_destroy') }}" + '/' + id,
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
<script>
function experiencedelete(id, title) {
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
                url: "{{ route('employees_experience_destroy') }}" + '/' + id,
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
<script>
function bankdelete(id, title) {
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
                url: "{{ route('employees-bank-details-destroy') }}" + '/' + id,
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
<script>
function salarydelete(id, title) {
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
            url: "{{ route('employees-salary-package-destroy') }}" + '/' + id,
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
<script>
function relationdelte(id, title) {
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
                url: "{{ route('employees-relations-details-destroy') }}" + '/' + id,
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
<script>
function pfdelete(id, title) {
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