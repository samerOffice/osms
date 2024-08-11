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
            <div class="col-md-6 col-xl-4">
              <div class="card mb-3 widget-content bg-midnight-bloom">
                <div class="widget-content-wrapper text-white">
                  <div class="widget-content-left">
                    <div class="widget-heading">Total Employees</div>
                    <div class="widget-subheading">Last year expenses</div>
                  </div>
                  <div class="widget-content-right">
                    <div class="widget-numbers text-white"><span>1896</span></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-4">
              <div class="card mb-3 widget-content bg-arielle-smile">
                <div class="widget-content-wrapper text-white">
                  <div class="widget-content-left">
                    <div class="widget-heading">Total Attendance</div>
                    <div class="widget-subheading">Total Clients Profit</div>
                  </div>
                  <div class="widget-content-right">
                    <div class="widget-numbers text-white"><span>568</span></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-4">
              <div class="card mb-3 widget-content bg-grow-early">
                <div class="widget-content-wrapper text-white">
                  <div class="widget-content-left">
                    <div class="widget-heading">Total Leave Applications</div>
                    <div class="widget-subheading">People Interested</div>
                  </div>
                  <div class="widget-content-right">
                    <div class="widget-numbers text-white"><span>46%</span></div>
                  </div>
                </div>
              </div>
            </div>
           
          </div>
         

          {{-- <div class="row">
            <div class="col-md-6 col-xl-4">
              <div class="card mb-3 widget-content">
                <div class="widget-content-outer">
                  <div class="widget-content-wrapper">
                    <div class="widget-content-left">
                      <div class="widget-heading">Total Orders</div>
                      <div class="widget-subheading">Last year expenses</div>
                    </div>
                    <div class="widget-content-right">
                      <div class="widget-numbers text-success">1896</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-4">
              <div class="card mb-3 widget-content">
                <div class="widget-content-outer">
                  <div class="widget-content-wrapper">
                    <div class="widget-content-left">
                      <div class="widget-heading">Products Sold</div>
                      <div class="widget-subheading">Revenue streams</div>
                    </div>
                    <div class="widget-content-right">
                      <div class="widget-numbers text-warning">$3M</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-4">
              <div class="card mb-3 widget-content">
                <div class="widget-content-outer">
                  <div class="widget-content-wrapper">
                    <div class="widget-content-left">
                      <div class="widget-heading">Followers</div>
                      <div class="widget-subheading">People Interested</div>
                    </div>
                    <div class="widget-content-right">
                      <div class="widget-numbers text-danger">45,9%</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="d-xl-none d-lg-block col-md-6 col-xl-4">
              <div class="card mb-3 widget-content">
                <div class="widget-content-outer">
                  <div class="widget-content-wrapper">
                    <div class="widget-content-left">
                      <div class="widget-heading">Income</div>
                      <div class="widget-subheading">Expected totals</div>
                    </div>
                    <div class="widget-content-right">
                      <div class="widget-numbers text-focus">$147</div>
                    </div>
                  </div>
                  <div class="widget-progress-wrapper">
                    <div class="progress-bar-sm progress-bar-animated-alt progress">
                      <div class="progress-bar bg-info" role="progressbar" aria-valuenow="54" aria-valuemin="0" aria-valuemax="100" style="width: 54%;"></div>
                    </div>
                    <div class="progress-sub-label">
                      <div class="sub-label-left">Expenses</div>
                      <div class="sub-label-right">100%</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> --}}

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
                        <a href="{{route('edit_employee_official_info',$employee->id)}}" style="color: white"><button class="btn btn-outline-primary"><i class="fa-solid fa-pen-to-square"></i> Edit</button></a>
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