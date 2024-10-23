<li class="nav-item nav-link 
@if(Request::is('emp_module_active')) nav-link active
@elseif(Request::is('add_additional_member_info')) nav-link active
@endif
" style="@if(Request::is('emp_module_active')) background-color: #ff5d6c;
@elseif(Request::is('add_additional_member_info')) background-color: #ff5d6c;
@endif
">
<a href="{{route('home')}}">
<i class="nav-icon fas fa-tachometer-alt" style="@if(Request::is('emp_module_active')) color: white;
@elseif(Request::is('add_additional_member_info')) color: white;
@endif
">
</i>
<p style="@if(Request::is('emp_module_active')) color:white;
@elseif(Request::is('add_additional_member_info')) color:white;
@endif
">
Dashboard
</p>
</a>
</li>

{{-- <li class="nav-item nav-link     
@if(Request::is('give_attendance')) nav-link active
@endif" style="
@if(Request::is('give_attendance')) background-color: #ff5d6c;
@endif">
<a href="{{route('give_attendance')}}">
<i class="nav-icon fa-solid fa-person-chalkboard" style="
@if(Request::is('give_attendance')) color: white;
@endif
"></i>
<p style="
@if(Request::is('give_attendance')) color:white;
@endif
"> Give Attendance</p>
</a>
</li> --}}

<li class="nav-item @if(Request::is('set_fingerprint_device_ip')) menu-open 
@elseif(Request::is('give_attendance')) menu-open 
@elseif(Request::is('exit_attendance')) menu-open 
@endif">
<a href="#" class="nav-link">
<i class="nav-icon fa-solid fa-fingerprint"></i>
<p>
 FingerPrint
<i class="fas fa-angle-left right"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li class="nav-item" style="padding-left : 15px">
    <a href="{{route('set_fingerprint_device_ip')}}" class="nav-link {{ Request::is('set_fingerprint_device_ip') ? 'nav-link active' : ''}}" style="{{ Request::is('set_fingerprint_device_ip') ? 'background-color: #ff5d6c; !important' : ''}}">
    <i class="far fa-circle nav-icon" style="{{ Request::is('set_fingerprint_device_ip') ? 'color: white; !important' : ''}}"></i>
    <p style="{{ Request::is('set_fingerprint_device_ip') ? 'color: white; !important' : ''}}">Set IP</p>
    </a>
</li>

<li class="nav-item" style="padding-left : 15px">
<a href="{{route('add_fingerprint_user')}}" class="nav-link {{ Request::is('add_fingerprint_user') ? 'nav-link active' : ''}}" style="{{ Request::is('add_fingerprint_user') ? 'background-color: #ff5d6c; !important' : ''}}">
<i class="far fa-circle nav-icon" style="{{ Request::is('add_fingerprint_user') ? 'color: white; !important' : ''}}"></i>
<p style="{{ Request::is('add_fingerprint_user') ? 'color: white; !important' : ''}}">Add User</p>
</a>
</li>

<li class="nav-item" style="padding-left : 15px">
<a href="{{route('exit_attendance')}}" class="nav-link {{ Request::is('exit_attendance') ? 'nav-link active' : ''}}" style="{{ Request::is('exit_attendance') ? 'background-color: #ff5d6c; !important' : ''}}">
<i class="far fa-circle nav-icon" style="{{ Request::is('exit_attendance') ? 'color: white; !important' : ''}}"></i>
<p style="{{ Request::is('exit_attendance') ? 'color: white; !important' : ''}}">Attendance List</p>
</a>
</li>
</ul>
</li>


<li class="nav-item @if(Request::is('set_fingerprint_device_ip')) menu-open 
@elseif(Request::is('give_attendance')) menu-open 
@elseif(Request::is('exit_attendance')) menu-open 
@endif">
<a href="#" class="nav-link">
<i class="nav-icon fa-solid fa-person-chalkboard"></i>
<p>
 Attendance
<i class="fas fa-angle-left right"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li class="nav-item" style="padding-left : 15px">
<a href="{{route('give_attendance')}}" class="nav-link {{ Request::is('give_attendance') ? 'nav-link active' : ''}}" style="{{ Request::is('give_attendance') ? 'background-color: #ff5d6c; !important' : ''}}">
<i class="far fa-circle nav-icon" style="{{ Request::is('give_attendance') ? 'color: white; !important' : ''}}"></i>
<p style="{{ Request::is('give_attendance') ? 'color: white; !important' : ''}}">Entry</p>
</a>
</li>

<li class="nav-item" style="padding-left : 15px">
<a href="{{route('exit_attendance')}}" class="nav-link {{ Request::is('exit_attendance') ? 'nav-link active' : ''}}" style="{{ Request::is('exit_attendance') ? 'background-color: #ff5d6c; !important' : ''}}">
<i class="far fa-circle nav-icon" style="{{ Request::is('exit_attendance') ? 'color: white; !important' : ''}}"></i>
<p style="{{ Request::is('exit_attendance') ? 'color: white; !important' : ''}}">Exit</p>
</a>
</li>
</ul>
</li>


<li class="nav-item nav-link     
@if(Request::is('attendance_list')) nav-link active
@endif" style="
@if(Request::is('attendance_list')) background-color: #ff5d6c;
@endif">
<a href="{{route('attendance_list')}}">
<i class="nav-icon fa-solid fa-list" style="
@if(Request::is('attendance_list')) color: white;
@endif
"></i>
<p style="
@if(Request::is('attendance_list')) color:white;
@endif
">Attendance List</p>
</a>
</li>


@if((Auth::user()->role_id == 1) || (Auth::user()->role_id == 2) || (in_array(8, $permitted_menus_array)))
<li class="nav-item @if(Request::is('add_payroll')) menu-open 
@elseif(Request::is('payroll_list')) menu-open 
@endif">
<a href="#" class="nav-link">
<i class="nav-icon fa-solid fa-wallet"></i>
<p>
Payrolls
<i class="fas fa-angle-left right"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li class="nav-item" style="padding-left : 15px">
<a href="{{route('add_payroll')}}" class="nav-link {{ Request::is('add_payroll') ? 'nav-link active' : ''}}" style="{{ Request::is('add_payroll') ? 'background-color: #ff5d6c; !important' : ''}}">
<i class="far fa-circle nav-icon" style="{{ Request::is('add_payroll') ? 'color: white; !important' : ''}}"></i>
<p style="{{ Request::is('add_payroll') ? 'color: white; !important' : ''}}">Add Payroll</p>
</a>
</li>

<li class="nav-item" style="padding-left : 15px">
<a href="{{route('payroll_list')}}" class="nav-link {{ Request::is('payroll_list') ? 'nav-link active' : ''}}" style="{{ Request::is('payroll_list') ? 'background-color: #ff5d6c; !important' : ''}}">
<i class="far fa-circle nav-icon" style="{{ Request::is('payroll_list') ? 'color: white; !important' : ''}}"></i>
<p style="{{ Request::is('payroll_list') ? 'color: white; !important' : ''}}">Payroll List</p>
</a>
</li>
</ul>
</li>
@endif

@if((Auth::user()->role_id == 1) || (Auth::user()->role_id == 2) || (in_array(9, $permitted_menus_array)))
<li class="nav-item @if(Request::is('add_new_employee')) menu-open 
@elseif(Request::is('employee_list')) menu-open 
@endif">
<a href="#" class="nav-link">
<i class="nav-icon fa-solid fa-user"></i>
<p>
Employees
<i class="fas fa-angle-left right"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li class="nav-item" style="padding-left : 15px">
<a href="{{route('add_new_employee')}}" class="nav-link {{ Request::is('add_new_employee') ? 'nav-link active' : ''}}" style="{{ Request::is('add_new_employee') ? 'background-color: #ff5d6c; !important' : ''}}">
<i class="far fa-circle nav-icon" style="{{ Request::is('add_new_employee') ? 'color: white; !important' : ''}}"></i>
<p style="{{ Request::is('add_new_employee') ? 'color: white; !important' : ''}}">Add new Employee</p>
</a>
</li>

<li class="nav-item" style="padding-left : 15px">
<a href="{{route('employee_list')}}" class="nav-link {{ Request::is('employee_list') ? 'nav-link active' : ''}}" style="{{ Request::is('employee_list') ? 'background-color: #ff5d6c; !important' : ''}}">
<i class="far fa-circle nav-icon" style="{{ Request::is('employee_list') ? 'color: white; !important' : ''}}"></i>
<p style="{{ Request::is('employee_list') ? 'color: white; !important' : ''}}">Employee List</p>
</a>
</li>
</ul>
</li>
@endif


<li class="nav-item @if(Request::is('leave_types')) menu-open 
@elseif(Request::is('apply_leave')) menu-open
@elseif(Request::is('leave_applications')) menu-open
@elseif(Request::is('leave_application_approval_list')) menu-open
@endif">
<a href="#" class="nav-link">
<i class="nav-icon fa-solid fa-person-walking-arrow-right"></i>
<p>
Leave Management
<i class="fas fa-angle-left right"></i>
</p>
</a>
<ul class="nav nav-treeview">

@if((Auth::user()->role_id == 1) || (Auth::user()->role_id == 2) || (in_array(10, $permitted_menus_array)))
<li class="nav-item" style="padding-left : 15px">
<a href="{{route('leave_types')}}" class="nav-link {{ Request::is('leave_types') ? 'nav-link active' : ''}}" style="{{ Request::is('leave_types') ? 'background-color: #ff5d6c; !important' : ''}}">
<i class="far fa-circle nav-icon" style="{{ Request::is('leave_types') ? 'color: white; !important' : ''}}"></i>
<p style="{{ Request::is('leave_types') ? 'color: white; !important' : ''}}">Leave Type</p>
</a>
</li>
@endif

<li class="nav-item" style="padding-left : 15px">
<a href="{{route('apply_leave')}}" class="nav-link {{ Request::is('apply_leave') ? 'nav-link active' : ''}}" style="{{ Request::is('apply_leave') ? 'background-color: #ff5d6c; !important' : ''}}">
<i class="far fa-circle nav-icon" style="{{ Request::is('apply_leave') ? 'color: white; !important' : ''}}"></i>
<p style="{{ Request::is('apply_leave') ? 'color: white; !important' : ''}}">Apply Leave</p>
</a>
</li>

<li class="nav-item" style="padding-left : 15px">
<a href="{{route('leave_applications')}}" class="nav-link {{ Request::is('leave_applications') ? 'nav-link active' : ''}}" style="{{ Request::is('leave_applications') ? 'background-color: #ff5d6c; !important' : ''}}">
<i class="far fa-circle nav-icon" style="{{ Request::is('leave_applications') ? 'color: white; !important' : ''}}"></i>
<p style="{{ Request::is('leave_applications') ? 'color: white; !important' : ''}}">Leave Application List</p>
</a>
</li>

@if((Auth::user()->role_id == 1) || (Auth::user()->role_id == 2) || (in_array(11, $permitted_menus_array)))
<li class="nav-item" style="padding-left : 15px">
<a href="{{route('leave_application_approval_list')}}" class="nav-link {{ Request::is('leave_application_approval_list') ? 'nav-link active' : ''}}" style="{{ Request::is('leave_application_approval_list') ? 'background-color: #ff5d6c; !important' : ''}}">
<i class="far fa-circle nav-icon" style="{{ Request::is('leave_application_approval_list') ? 'color: white; !important' : ''}}"></i>
<p style="{{ Request::is('leave_application_approval_list') ? 'color: white; !important' : ''}}">Leave Approval List</p>
</a>
</li>
@endif

</ul>
</li>



@if((Auth::user()->role_id == 1) ||  (Auth::user()->role_id == 2))
<li class="nav-item @if(Request::is('add_payroll')) menu-open 
@endif">
<a href="#" class="nav-link">
<i class="nav-icon fa-solid fa-file-pen"></i>
<p>
Reports
<i class="fas fa-angle-left right"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li class="nav-item" style="padding-left : 15px">
<a href="{{route('top_seller_report')}}" class="nav-link {{ Request::is('top_seller_report') ? 'nav-link active' : ''}}" style="{{ Request::is('top_seller_report') ? 'background-color: #ff5d6c; !important' : ''}}">
<i class="far fa-circle nav-icon" style="{{ Request::is('top_seller_report') ? 'color: white; !important' : ''}}"></i>
<p style="{{ Request::is('top_seller_report') ? 'color: white; !important' : ''}}">Top Seller Report</p>
</a>
</li>   
</ul>
</li>
@endif