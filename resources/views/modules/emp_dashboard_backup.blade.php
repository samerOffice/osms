<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
    <div class="app-main">
      <div class="app-main__outer">
        <div class="app-main__inner">
          <div class="app-page-title">
            <div class="page-title-wrapper">
              <div class="page-title-heading">
                <div class="page-title-icon">
                  <span><img src="{{ asset('dist/img/emp.png') }}" width="35px" alt="logo"></span>
                </div>
                <div>Employee Dashboard
                  <div class="page-title-subheading"> An Employee Management System simplifies HR processes by automating payroll, attendance, and employee data management.
                  </div>
                </div>
              </div>
        
            </div>
          </div>
          <div class="row">
            <div class="col-4">
              <img src="{{asset('/dist/img/notice_board.png')}}" height="auto" width="450px" alt="notice board">
            </div>
            <div class="col-4">
              <div class="row">      
                <div class="col-md-12 col-xl-12">
                  <div class="card mb-3 widget-content bg-midnight-bloom">
                    <div class="widget-content-wrapper text-white">
                      <div class="widget-content-left">
                        <div class="widget-heading">Total Employees</div>
                        <div class="widget-subheading">Total Working Employees On My Shop</div>
                      </div>
                      <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>{{$total_employees}}</span></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 col-xl-12">
                  <div class="card mb-3 widget-content bg-arielle-smile">
                    <div class="widget-content-wrapper text-white">
                      <div class="widget-content-left">
                        <div class="widget-heading">Total Attendance</div>
                        <div class="widget-subheading">Total Attendance In This Month</div>
                      </div>
                      <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>{{$total_attendances}}</span></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 col-xl-12">
                  <div class="card mb-3 widget-content bg-grow-early">
                    <div class="widget-content-wrapper text-white">
                      <div class="widget-content-left">
                        <div class="widget-heading">Total Leave Applications</div>
                        <div class="widget-subheading">Total Submitted Application</div>
                      </div>
                      <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>4</span></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-2"></div>   
          </div>     
          <div class="row">
            <div class="col-12">
              <br>
              <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Employee List</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Serial No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Designation</th>
                        <th>Branch</th>
                        <th>Joining Date</th>
                        <th>Action</th>                          
                      </tr>
                      </thead>
                      <tbody>
                          @php $i = 1 @endphp
                          @foreach($employees as $employee)
                      <tr>
                        <td>{{$i++}}</td>
                        <td>{{$employee->emp_name}}</td>
                        <td>{{$employee->emp_email}}</td>
                        <td>{{$employee->emp_designation_name}}</td>
                        <td>{{$employee->emp_br_name}}</td>
                        <td>{{$employee->emp_joining_date}}</td>
                        <td>
                          <a href="{{route('view_employee_details',$employee->id)}}" style="color: white"><button class="btn btn-outline-info"><i class="fa-solid fa-eye"></i> View</button></a>
                          <a href="{{route('edit_employee_official_info',$employee->id)}}" style="color: white"><button class="btn btn-outline-success"><i class="fa-solid fa-pen-to-square"></i> Edit</button></a>
                        </td>
                      </tr> 
                      @endforeach              
               
                      </tfoot>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
          </div>
          </div>

          
        </div>
      </div>
      <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
    </div>
  </div><br><br><br>