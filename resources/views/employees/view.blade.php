@extends('master')

@section('title')
Employee List
@endsection


@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>
        <div class="row">
            <div class="col-12">
                <a class="btn btn-outline-info float-right" href="{{route('employee_list')}}">
                    <i class="fas fa-arrow-left"></i> Back
                </a>            
            </div>
            <div class="col-1"></div>
            <div class="col-10">
                <br>
                      <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{asset('/dist/img/avatar5.png')}}"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{$employee->emp_name}}</h3>
                <h5 class="text-muted text-center">{{$employee->emp_designation_name}}</h5>
                
                <h5><i class="fa-solid fa-envelope"></i> E-mail</h5>
                <h6 class="text-muted ml-4">{{$employee->emp_email}}</h6>           
                <hr>
                @if($employee->emp_mobile_number != '')
                <h5><i class="fas fa-book mr-1"></i> Contact Number</h5>
                <h6 class="text-muted ml-4">{{$employee->emp_mobile_number}}</h6>      
                <hr>
                @endif
                <h5><i class="fa-solid fa-calendar-days"></i> Joining Date</h5>
                <h6 class="text-muted ml-4">{{$employee->emp_joining_date}}</h6>           
                <hr>

                <h5><i class="fa-solid fa-bangladeshi-taka-sign"></i> Monthly Salary</h5>
                <h6 class="text-muted ml-4">{{$employee->emp_monthly_salary}} BDT</h6>           
                <hr>

                @if($employee->emp_branch_name != '')
                <h5><i class="fas fa-map-marker-alt mr-1"></i> Branch Details</h5>
                <h6 class="text-muted ml-4">{{$employee->emp_branch_name}}</h6>   
                <h6 class="text-muted ml-4">{{$employee->emp_branch_address}}</h6>   
                <hr>
                @endif

                @if($employee->emp_warehouse_name != '')
                <h5><i class="fas fa-map-marker-alt mr-1"></i> Warehouse Details</h5>
                <h6 class="text-muted ml-4">{{$employee->emp_warehouse_name}}</h6>   
                <h6 class="text-muted ml-4">{{$employee->emp_warehouse_address}}</h6>   
                <hr>
                @endif

                @if($employee->emp_outlet_name != '')
                <h5><i class="fas fa-map-marker-alt mr-1"></i> Outlet Details</h5>
                <h6 class="text-muted ml-4">{{$employee->emp_outlet_name}}</h6>   
                <h6 class="text-muted ml-4">{{$employee->emp_outlet_address}}</h6>   
                <hr>
                @endif

                @if($employee->emp_nid_number != '')
                <h5><i class="fa-solid fa-id-card"></i> NID Number</h5>
                <h6 class="text-muted ml-4">{{$employee->emp_nid_number}}</h6>
                <hr>
                @endif

                @if($employee->emp_birth_date != '')
                <h5><i class="fa-solid fa-calendar-days"> Date of Birth</h5>
                <h6 class="text-muted ml-4">{{$employee->emp_birth_date}}</h6>
                <hr>
                @endif

                @if($employee->emp_blood_group != '')
                <h5><i class="fa-solid fa-droplet"></i> Blood Group</h5>
                <h6 class="text-muted ml-4">{{$employee->emp_blood_group}}</h6>
                <hr>
                @endif

                @if($employee->emp_present_address != '')
                <h5><i class="fas fa-map-marker-alt mr-1"></i> Present Address</h5>
                <h6 class="text-muted ml-4">{{$employee->emp_present_address}}</h6>
                <hr>
                @endif

                @if($employee->emp_permanent_address != '')
                <h5><i class="fas fa-map-marker-alt mr-1"></i> Permanenet Address</h5>
                <h6 class="text-muted ml-4">{{$employee->emp_permanent_address}}</h6>
                <hr>
                @endif
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>  
            <div class="col-1"></div>         
        </div>       
        <br>       
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

  </div>

@endsection
