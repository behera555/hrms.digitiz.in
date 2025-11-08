                      @php 
                      use App\Models\Employees;
                      $users = Employees::where('emp_id',auth()->user()->emp_id)->first();
                      @endphp
                      <aside class="app-sidebar ">
                          <div class="app-sidebar__logo">
                              @if(auth()->user()->type == 'super_admin')
                              <a class="header-brand" href="{{route('super-admin-dashboard')}}">
                                  @elseif(auth()->user()->type == 'admin')
                                  <a class="header-brand" href="{{route('admin-dashboard')}}">
                                      @elseif(auth()->user()->type == 'hr')
                                      <a class="header-brand" href="{{route('hr-dashboard')}}">
                                          @endif
                                          <img src="{{asset('backend/images/brand/logo.png')}}"
                                              class="header-brand-img desktop-lgo" alt="Dayonelogo">
                                          <img src="{{asset('backend/images/brand/logo-white.png')}}"
                                              class="header-brand-img dark-logo" alt="Dayonelogo" style="height: 35px;">
                                          <img src="{{asset('backend/images/brand/logo-white.png')}}"
                                              class="header-brand-img mobile-logo" alt="Dayonelogo">
                                          <img src="{{asset('backend/images/brand/logo-white.png')}}"
                                              class="header-brand-img darkmobile-logo" alt="Dayonelogo">
                                      </a>
                          </div>
                          <div class="app-sidebar3">
                              <div class="main-menu">
                                  <div class="app-sidebar__user">
                                      <div class="dropdown user-pro-body text-center">
                                          <div class="user-pic">
                                            @php
                                            $profile_pic = url('').'/uploads/passport/'.$users->profile_pic;
                                            @endphp
                                              <img src="https://avatar.iran.liara.run/public/boy?username=Ash" alt="user-img"
                                                  class="avatar-xxl rounded-circle mb-1">
                                          </div>
                                          <div class="user-info">
                                              <h5 class=" mb-2">{{auth()->user()->name}}</h5>
                                              <span class="text-muted app-sidebar__user-name text-sm">{{$users->designation}}</span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="slide-left disabled" id="slide-left"><svg
                                          xmlns="http://www.w3.org/2000/svg" fill="#000" width="24" height="24"
                                          viewBox="0 0 24 24">
                                          <path
                                              d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                                      </svg></div>
                                  <ul class="side-menu">
                                      @if(auth()->user()->type == 'super_admin')
                                      <li class="slide">
                                          <a class="side-menu__item" data-bs-toggle="slide"
                                              href="{{route('super-admin-dashboard')}}">
                                              <i class="feather feather-home  sidemenu_icon"></i>
                                              <span class="side-menu__label">{{ __('Dashboards') }}</span></a>
                                      </li>
                                      <li class="slide">
                                          <a class="side-menu__item" data-bs-toggle="slide"
                                              href="{{route('super-admin-settings')}}">
                                              <i class="feather feather-settings  fe-spin  sidemenu_icon"></i>
                                              <span class="side-menu__label">{{ __('Organization Info') }}</span></a>
                                      </li>
                                      <li class="slide">
                                          <a class="side-menu__item" data-bs-toggle="slide"
                                              href="{{route('allow-ip-list')}}">
                                              <i class="fa fa-ioxhost  sidemenu_icon"></i>
                                              <span class="side-menu__label">{{ __('Allow Ip Address') }}</span></a>
                                      </li>
                                      <!-- <li class="slide">
                                          <a class="side-menu__item" data-bs-toggle="slide"
                                              href="">
                                              <i class="fa fa-puzzle-piece sidemenu_icon"></i>
                                              <span class="side-menu__label">{{ __('Assets') }}</span></a>
                                      </li> -->
                                      <li class="slide">
                                          <a class="side-menu__item" data-bs-toggle="sub-slide"
                                              href="javascript:void(0);"> <i class="fa fa-clipboard sidemenu_icon"></i>
                                              <span class="side-menu__label">{{ __('Notice Board') }}</span><i
                                                  class="sub-angle fa fa-angle-right"></i>
                                          </a>
                                          <ul class="sub-slide-menu">
                                              <li><a href="{{route('recruitments')}}" class="sub-slide-item">{{ __('Job Post') }} </a></li>
                                              <li><a href="{{route('events')}}" class="sub-slide-item">{{ __('Job Candidate') }} </a></li>
                                          </ul>
                                      </li>
                                      <li class="slide">
                                          <a class="side-menu__item" data-bs-toggle="slide"
                                              href="{{route('super.admin.cache.clear')}}">
                                              <i class="feather feather-cpu fe-spin sidemenu_icon"></i>
                                              <span class="side-menu__label">{{ __('Clear Cache') }}</span></a>
                                      </li>
                                      @elseif(auth()->user()->type == 'admin')
                                      <li class="slide">
                                          <a class="side-menu__item" data-bs-toggle="slide"
                                              href="{{route('admin-dashboard')}}">
                                              <i class="feather feather-home  sidemenu_icon"></i>
                                              <span class="side-menu__label">{{ __('Dashboards') }}</span></a>
                                      </li>
                                      @elseif(auth()->user()->type == 'employee')
                                      <li class="slide">
                                          <a class="side-menu__item" data-bs-toggle="slide"
                                              href="{{route('employee-dashboard')}}">
                                              <i class="feather feather-home  sidemenu_icon"></i>
                                              <span class="side-menu__label">{{ __('Dashboards') }}</span></a>
                                      </li>
                                      <li class="slide">
                                          <a class="side-menu__item" data-bs-toggle="slide"
                                              href="{{route('employee-work-report')}}">
                                              <i class="feather feather-home  sidemenu_icon"></i>
                                              <span class="side-menu__label">{{ __('Work Report') }}</span></a>
                                      </li>
                                      <!--<li class="slide">-->
                                      <!--    <a class="side-menu__item" data-bs-toggle="slide"-->
                                      <!--        href="{{route('leads-list')}}">-->
                                      <!--        <i class="feather feather-file-plus  sidemenu_icon"></i>-->
                                      <!--        <span class="side-menu__label">{{ __('Leads') }}</span></a>-->
                                      <!--</li>-->
            <!--                          <li class="slide">-->
            <!--                              <a class="side-menu__item" data-bs-toggle="sub-slide"-->
            <!--                                  href="javascript:void(0);"> <i class="fa fa-leaf sidemenu_icon"></i>-->
            <!--                                  <span class="side-menu__label">{{ __('Work') }}</span><i-->
            <!--                                      class="sub-angle fa fa-angle-right"></i>-->
            <!--                              </a>-->
            <!--                              <ul class="sub-slide-menu">-->
            <!--                              <li><a href="{{route('employee-apply-leaves-list')}}" class="sub-slide-item">{{ __('Projects') }}</a></li>-->
										  <!--<li><a href="{{route('employee-attendance')}}" class="sub-slide-item">{{ __('Tasks') }}</a></li>-->
            <!--                              <li><a href="{{route('holiday-list')}}" class="sub-slide-item">{{ __('Timesheet') }}</a></li>-->
            <!--                              </ul>-->
            <!--                          </li>-->
                                      <li class="slide">
                                          <a class="side-menu__item" data-bs-toggle="sub-slide"
                                              href="javascript:void(0);"> <i class="fa fa-audio-description sidemenu_icon"></i>
                                              <span class="side-menu__label">{{ __('HR') }}</span><i
                                                  class="sub-angle fa fa-angle-right"></i>
                                          </a>
                                          <ul class="sub-slide-menu">
                                          <li><a href="{{route('employee-apply-leaves-list')}}" class="sub-slide-item">{{ __('Leaves') }}</a></li>
										  <li><a href="{{route('employee-attendance')}}" class="sub-slide-item">{{ __('Attendance') }}</a></li>
                                          <li><a href="{{route('holiday-list')}}" class="sub-slide-item">{{ __('Holidays') }}</a></li>
                                          <li><a href="{{route('employee-bank-details-list')}}" class="sub-slide-item">{{ __('Bank Details') }}</a></li>
                                           <li><a href="{{route('relations-details-list')}}" class="sub-slide-item">{{ __('Employees Relations Details') }}</a></li>
                                            <li><a href="{{route('experience')}}" class="sub-slide-item">{{ __('Employees Experience') }}</a></li>
                                             <li><a href="{{route('education')}}" class="sub-slide-item">{{ __('Employees Education') }}</a></li>
                                          <!--<li><a href="{{route('hr-holiday')}}" class="sub-slide-item">{{ __('Appreciation') }}</a></li>-->
                                          </ul>
                                      </li>
                                      <li class="slide">
                                          <a class="side-menu__item" data-bs-toggle="sub-slide"
                                              href="javascript:void(0);"> <i class="fa fa-leaf sidemenu_icon"></i>
                                              <span class="side-menu__label">{{ __('Finance') }}</span><i
                                                  class="sub-angle fa fa-angle-right"></i>
                                          </a>
                                          <ul class="sub-slide-menu">
                                         <li><a href="{{route('expenses-list')}}" class="sub-slide-item">{{ __('Expenses') }}</a></li>
										  <!--<li><a href="{{route('employee-attendance')}}" class="sub-slide-item">{{ __('Pay Slips') }}</a></li>-->
            <!--                              <li><a href="{{route('holiday-list')}}" class="sub-slide-item">{{ __('My Salary') }}</a></li>-->
                                          </ul>
                                      </li>
                                      <!--<li class="slide">-->
                                      <!--    <a class="side-menu__item" data-bs-toggle="slide"-->
                                      <!--        href="{{route('employee-attendance')}}">-->
                                      <!--        <i class="feather feather-file-plus  sidemenu_icon"></i>-->
                                      <!--        <span class="side-menu__label">{{ __('Tickets') }}</span></a>-->
                                      <!--</li>-->
                                      <!--<li class="slide">-->
                                      <!--    <a class="side-menu__item" data-bs-toggle="slide"-->
                                      <!--        href="{{route('employee-attendance')}}">-->
                                      <!--        <i class="feather feather-file-plus  sidemenu_icon"></i>-->
                                      <!--        <span class="side-menu__label">{{ __('Events') }}</span></a>-->
                                      <!--</li>-->
                                      <li class="slide">
                                          <a class="side-menu__item" data-bs-toggle="slide"
                                              href="{{route('notice-board-list')}}">
                                              <i class="feather feather-file-plus  sidemenu_icon"></i>
                                              <span class="side-menu__label">{{ __('Notice Board') }}</span></a>
                                      </li>
                                      @elseif(auth()->user()->type == 'hr')
                                      <li class="slide">
                                          <a class="side-menu__item" data-bs-toggle="slide"
                                              href="{{route('hr-dashboard')}}">
                                              <i class="feather feather-home  sidemenu_icon"></i>
                                              <span class="side-menu__label">{{ __('Dashboards') }}</span></a>
                                      </li>
                                      <li class="slide">
                                          <a class="side-menu__item" data-bs-toggle="sub-slide"
                                              href="javascript:void(0);"> <i class="fa fa-file sidemenu_icon"></i>
                                              <span class="side-menu__label">{{ __('Document') }} <span class="nav-list">{{ __('Management') }}</span></span><i
                                                  class="sub-angle fa fa-angle-right"></i>
                                          </a>
                                          <ul class="sub-slide-menu">
                                          <li><a href="{{route('document-management-add')}}" class="sub-slide-item">{{ __('Add Document') }}</a></li>
                                          <li><a href="{{route('document-management-list')}}" class="sub-slide-item">{{ __('Document Summary') }}</a></li>
                                          </ul>
                                      </li>
                                      <li class="slide">
                                          <a class="side-menu__item" data-bs-toggle="sub-slide"
                                              href="javascript:void(0);"> <i class="mdi mdi-account-multiple-plus sidemenu_icon"></i>
                                              <span class="side-menu__label">{{ __('Employee') }} <span class="nav-list">{{ __('Management') }}</span></span><i
                                                  class="sub-angle fa fa-angle-right"></i>
                                          </a>
                                          <ul class="sub-slide-menu">
                                          <li><a href="{{route('employees-list')}}" class="sub-slide-item">{{ __('Employees') }}</a></li>
                                          <!--<li><a href="{{route('employees-bank-details-list')}}" class="sub-slide-item">{{ __('Employees Bank Details') }}</a></li>-->
                                          <!--<li><a href="{{route('employees-relations-details-list')}}" class="sub-slide-item">{{ __('Employees Relations Details') }}</a></li>-->
                                          <!--<li><a href="{{route('employees-pf-details-list')}}" class="sub-slide-item">{{ __('Employees PF Details') }}</a></li>-->
                                          <!--<li><a href="{{route('employees-experience')}}" class="sub-slide-item">{{ __('Employees Experience') }}</a></li>-->
                                          <!--<li><a href="{{route('employees-education')}}" class="sub-slide-item">{{ __('Employees Education') }}</a></li>-->
                                          <!--<li><a href="{{route('employees-salary-package-list')}}" class="sub-slide-item">{{ __('Employees Salary Package') }}</a></li>-->
                                          <li><a href="{{route('employees-offer-letter')}}" class="sub-slide-item">{{ __('Employees Appointment Letter') }}</a></li>
                                          <li><a href="{{route('employees-offere-letter')}}" class="sub-slide-item">{{ __('Employees Offer Letter') }}</a></li>
                                          <li><a href="{{route('employees-reliving-letter')}}" class="sub-slide-item">{{ __('Employees Relieving Letter') }}</a></li>
                                          <li><a href="{{route('employees-letter-of-intent')}}" class="sub-slide-item">{{ __('Employees Letter of Intent') }}</a></li>
										  <li><a href="{{route('hr-department')}}" class="sub-slide-item">{{ __('Department') }}</a></li>
                                          <li><a href="{{route('designation')}}" class="sub-slide-item">{{ __('Designation') }}</a></li>
                                          <li><a href="{{route('hr-holiday')}}" class="sub-slide-item">{{ __('Holidays') }} </a></li>
                                          <li><a href="{{route('pormotion-list')}}" class="sub-slide-item">{{ __('Promotion') }} </a></li>
                                          <li><a href="{{route('award-list')}}" class="sub-slide-item">{{ __('Award') }} </a></li>
                                              
                                          </ul>
                                      </li>

                                      <li class="slide">
                                          <a class="side-menu__item" data-bs-toggle="sub-slide"
                                              href="javascript:void(0);"> <i class="mdi mdi-format-line-weight sidemenu_icon"></i>
                                              <span class="side-menu__label">{{ __('Leave') }} <span class="nav-list">{{ __('Management') }}</span></span><i
                                                  class="sub-angle fa fa-angle-right"></i>
                                          </a>
                                          <ul class="sub-slide-menu">
                                          <!--<li><a href="{{route('apply-leaves-list')}}" class="sub-slide-item">{{ __('Apply for Leave') }}</a></li>-->
										     <li><a href="{{route('apply-leaves-get')}}" class="sub-slide-item">{{ __('Leave Request') }}</a></li>
										    <li><a href="{{route('employees-apply-leaves-get')}}" class="sub-slide-item">{{ __('Employees Leave Request') }}</a></li>
										    <!--<li><a href="{{route('leave-balance')}}" class="sub-slide-item">{{ __('Employees Leave Balance') }}</a></li>-->
                                          </ul>
                                      </li>
                                      <li class="slide">
                                          <a class="side-menu__item" data-bs-toggle="sub-slide"
                                              href="javascript:void(0);"> <i class="mdi mdi-clock-fast sidemenu_icon"></i>
                                              <span class="side-menu__label">{{ __('Attendance') }} <span class="nav-list">{{ __('Management') }}</span></span><i
                                                  class="sub-angle fa fa-angle-right"></i>
                                          </a>
                                          <ul class="sub-slide-menu">
                                          <li><a href="{{route('attendance')}}" class="sub-slide-item">{{ __('Apply Attendance') }}</a></li>
										    <li><a href="{{route('employees-attendance-list')}}" class="sub-slide-item">{{ __('List Employees Attendance') }}</a></li>
                                          </ul>
                                      </li>
                                      <li class="slide">
                                          <a class="side-menu__item" data-bs-toggle="sub-slide"
                                              href="javascript:void(0);"> <i class="mdi mdi-newspaper sidemenu_icon"></i>
                                              <span class="side-menu__label">{{ __('HR') }} <span class="nav-list">{{ __('Management') }}</span></span><i
                                                  class="sub-angle fa fa-angle-right"></i>
                                          </a>
                                          <ul class="sub-slide-menu">
                                              <li><a href="{{route('recruitments')}}" class="sub-slide-item">{{ __('Openings/Positions') }} </a></li>
                                              <li><a href="{{route('candidates-list')}}" class="sub-slide-item">{{ __('Candidates') }} </a></li>
                                              <li><a href="{{route('interviews-list')}}" class="sub-slide-item">{{ __('Interviews') }} </a></li>
                                              <li><a href="{{route('shortlisted-list')}}" class="sub-slide-item">{{ __('Shortlisted & Selected Candidates') }} </a></li>
                                              <!-- <li><a href="{{route('events')}}" class="sub-slide-item">{{ __('Approved Requisitions') }} </a></li> -->
                                              <li><a href="{{route('rejected-candidates')}}" class="sub-slide-item">{{ __('Rejected Candidates') }} </a></li>
                                          </ul>
                                      </li>
                                      <li class="slide">
                                          <a class="side-menu__item" data-bs-toggle="sub-slide"
                                              href="javascript:void(0);"> <i class="fa fa-th-list sidemenu_icon"></i>
                                              <span class="side-menu__label">{{ __('Company') }} <span class="nav-list">{{ __('Properties') }}</span></span><i
                                                  class="sub-angle fa fa-angle-right"></i>
                                          </a>
                                          <ul class="sub-slide-menu">
                                          <li><a href="{{route('asset-type-list')}}" class="sub-slide-item">{{ __('Asset Type') }}</a></li>
										     <li><a href="{{route('assets-list')}}" class="sub-slide-item">{{ __('Assets') }}</a></li>
                                             <li><a href="{{route('assets-allocate-to-list')}}" class="sub-slide-item">{{ __('Assets Allocate') }}</a></li>
                                          </ul>
                                      </li>
                                      <li class="slide">
                                          <a class="side-menu__item" data-bs-toggle="slide"
                                              href="{{route('notice-board')}}">
                                              <i class="fa fa-clipboard  sidemenu_icon"></i>
                                              <span class="side-menu__label">{{ __('Notice Board') }}</span></a>
                                      </li>
                                      <li class="slide">
                                          <a class="side-menu__item" data-bs-toggle="slide"
                                              href="{{route('events')}}">
                                              <i class="fa fa-calendar  sidemenu_icon"></i>
                                              <span class="side-menu__label">{{ __('Event') }}</span></a>
                                      </li>
                                      <li class="slide">
                                          <a class="side-menu__item" data-bs-toggle="sub-slide"
                                              href="javascript:void(0);"> <i class="fa fa-money sidemenu_icon"></i>
                                              <span class="side-menu__label">{{ __('Finance') }}</span><i
                                                  class="sub-angle fa fa-angle-right"></i>
                                          </a>
                                          <ul class="sub-slide-menu">
                                         <li><a href="{{route('hr-expenses-list')}}" class="sub-slide-item">{{ __('Expenses') }}</a></li>
                                         <li><a href="{{route('employees-payslip-list')}}" class="sub-slide-item">{{ __('Payslip') }}</a></li>
                                        <li><a href="{{route('payroll-list')}}" class="sub-slide-item">{{ __('Payroll Structure') }}</a></li>
                                         <li><a href="{{route('all-payroll-list')}}" class="sub-slide-item">{{ __('All Payroll') }}</a></li>
                                         <li><a href="{{route('all-expenses-list')}}" class="sub-slide-item">{{ __('All Expenses') }}</a></li>
                                          </ul>
                                      </li>
                                      <!--<li class="slide">-->
                                      <!--    <a class="side-menu__item" data-bs-toggle="sub-slide"-->
                                      <!--        href="javascript:void(0);"> <i class="mdi mdi-cash sidemenu_icon"></i>-->
                                      <!--        <span class="side-menu__label">{{ __('Payroll') }}</span><i-->
                                      <!--            class="sub-angle fa fa-angle-right"></i>-->
                                      <!--    </a>-->
                                      <!--    <ul class="sub-slide-menu">-->
                                      <!--        <li><a href="{{route('recruitments')}}" class="sub-slide-item">{{ __('Recruitment') }} </a></li>-->
                                      <!--        <li><a href="{{route('events')}}" class="sub-slide-item">{{ __('Events') }} </a></li>-->
                                      <!--    </ul>-->
                                      <!--</li>-->
                                      <li class="slide">
                                          <a class="side-menu__item" data-bs-toggle="slide"
                                              href="{{route('logout')}}">
                                              <i class="feather feather-power  sidemenu_icon"></i>
                                              <span class="side-menu__label">{{ __('Sign Out') }}</span></a>
                                      </li>
                                      @endif
                                  </ul>
                              </div>
                          </div>
                      </aside>