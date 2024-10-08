@extends('master')

@section('title')
Add Employee
@endsection

@push('css')
<style>
#for_permission_review{
    display: none;
}

#for_warehouse{
    display: none;
}

#for_outlet{
    display: none;
}

/* Hide the default checkbox */
input[type="checkbox"] {
      appearance: none;
      -webkit-appearance: none;
      -moz-appearance: none;
      width: 20px;
      height: 20px;
      border: 1px solid #ccc;
      border-radius: 1px;
      outline: none;
  }
  
  /* Define the custom checkbox */
  input[type="checkbox"]::before {
      content: '';
      display: inline-block;
      width: 16px;
      height: 16px;
      background-color: white;
      border-radius: 1px;
      /* margin-right: 1px; */
      border: 1px solid #ccc;
  }
  
  /* Change the color of the custom checkbox when checked */
  input[type="checkbox"]:checked::before {
      background-color: #0098ef; /* Change the color here */
  }
</style>
@endpush

@section('content')
@if (Auth::check())
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <a class="btn btn-outline-info float-right" href="{{route('home')}}">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>         
            <div class="col-12">
                <br>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add Employee</h3>
                      </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">                  
                                <form id="addNewEmployeeForm">
                                <!-- Name input -->
                                <div class="form-group mb-4">
                                    <label for="Name">Full Name <small style="color: red">*</small></label>
                                  <input type="text"  placeholder="Full Name" id="name" name="name" class="form-control form-control-lg" />
                                </div> 
                    
                                <!-- Email input -->
                                <div  class="form-group mb-4">
                                    <label for="Email">Email <small style="color: red">*</small></label>
                                  <input type="email"  placeholder="Email" id="email" name="email" class="form-control form-control-lg" />
                                </div> 
                    
                                <!-- Password input -->
                                <div  class="form-group mb-4">
                                    <label for="password">Password <small style="color: red">*</small></label>
                                  <input type="password"  placeholder="Password" onkeyup="typePassword()" id="password" name="password" class="form-control form-control-lg" />
                                </div>
                    
                                <!-- Cofirm password input -->
                                <div  class="form-group mb-4">
                                    <label for="password">Confirm Password <small style="color: red">*</small></label>
                                  <input type="password" placeholder="Confirm Password" onkeyup="machPassword()"  id="confirm_password" name="" class="form-control form-control-lg" />
                                  <p id="message"></p>
                                </div>


                                
                                  <!-- Joining Date -->
                                  <div  class="form-group mb-4">
                                   <label >Joining Date <small style="color: red">*</small></label>
                                 <input type="date"  id="joining_date" name="joining_date" class="form-control form-control-lg" />
                               </div>
                              

                              
                                <!-- Monthly Salary -->
                                <div  class="form-group mb-4">
                                 <label >Monthly Salary <small style="color: red">*</small></label>
                               <input type="number" step="0.01"  id="monthly_salary" name="monthly_salary" class="form-control form-control-lg" />
                             </div>
                           

                            
                                
                                <div class="row">
                                  <div class="col-md-3 col-sm-12">
                                    <!-- Level select -->
                                      <div  class="form-group mb-4">
                                          <label for="password">Level <small style="color: red">*</small></label>
                                          <select required class="form-control select2bs4" id="level" name="level" style="width: 100%;">                                  
                                            <option value="">Select Level</option>                                      
                                            <option value="1">Managing Level</option>                                   
                                            <option value="2">Operational Level</option>                                   
                                            <option value="3">Support Level</option>                                   
                                          </select>
                                      </div> 
                                    </div>


                                  <div class="col-md-3 col-sm-12">
                                    <!-- Designation -->
                                  <div  class="form-group mb-4">
                                    <label for="password">Designation <small style="color: red">*</small></label>
                                    <select required class="form-control select2bs4" id="designation_name" name="designation_name" style="width: 100%;">                                  
                                      <option value="" >Select Designation</option>                                                            
                                    </select>
                                  </div>
                                  </div>
                                 

                                    <div class="col-md-3 col-sm-12">
                                      <!-- Branch select -->
                                        <div  class="form-group mb-4">
                                            <label for="password">Branch <small style="color: red">*</small></label>
                                            <select class="form-control select2bs4" id="branch_id" name="branch_id" style="width: 100%;">
                                                <option selected="selected" value="">Select Branch</option>
                                                @foreach($branches as $branch)
                                                <option value="{{$branch->id}}">{{$branch->br_name}}</option>
                                                @endforeach
                                              </select>
                                        </div> 
                                      </div>


                                        <div class="col-md-3 col-sm-12">
                                        <!-- Assign To -->
                                          <div  class="form-group mb-4">
                                              <label for="password">Assign To <small style="color: red">*</small></label>
                                              <select class="form-control select2bs4" onchange="showDiv()" id="assign_to" name="assign_to" style="width: 100%;">
                                                  <option selected="selected" value="">Select</option>                                                 
                                                  <option value="0">Employee</option>                                       
                                                  <option value="1">Inventory</option>                                       
                                                  <option value="2">POS</option>                                       
                                                  <option value="3">Inventory & POS</option>                           
                                                </select>
                                          </div> 
                                        </div>

                                        <div class="col-md-12 col-sm-12" id="for_permission_review">
                                          <div  class="form-group mb-4">
                                              <label for="password">Permission To Review Requisition </label>
                                              <select class="form-control select2bs4" id="review_requisition" name="review_requisition" style="width: 100%;">
                                                  <option selected="selected" value="">Select</option>                   
                                                  <option value="1">Yes</option>
                                                  <option value="2">No</option>
                                                </select>
                                          </div> 
                                        </div>

                                        <div class="col-md-12 col-sm-12" id="for_warehouse">
                                          <div class="form-group mb-4">
                                              <label>Warehouse </label>
                                              <select  class="form-control select2bs4" id="warehouse_id" name="warehouse_id" style="width: 100%;">                                  
                                                  <option value="" >Select Warehouse</option>                                                            
                                            </select>
                                            </div> 
                                      </div>
          
                                      <div class="col-md-12 col-sm-12" id="for_outlet">
                                          <div class="form-group mb-4">
                                              <label>Outlet </label>
                                              <select  class="form-control select2bs4" id="outlet_id" name="outlet_id" style="width: 100%;">                                  
                                                <option value="">Select Outlet</option>                                                            
                                            </select>
                                            </div> 
                                      </div>                               
   
                                </div>
                    
                              <br>
                              <h3 align='center' style="color: #0098ef">Menu Permission</h3>
                            <hr>
                            <br>
                            <div class="row">
                              @foreach($groupedMenus as $moduleType => $menus)
                                  <div class="col-md-3 col-sm-12">
                                      <h5>
                                        @if($moduleType == 1)
                                        <span style="color: #0fd71c">Dashboards</span>
                                        @elseif($moduleType == 2)
                                        <span style="color: #0fd71c">Employee Module</span>
                                        @elseif($moduleType == 3)
                                        <span style="color: #0fd71c">Inventory Module</span>
                                        @else
                                        <span style="color: #0fd71c">POS Module</span>
                                        @endif
                                      </h5>
                                      <br>
                                      @foreach($menus as $menu)
                                          <div class="form-group mb-4">
                                              <input type="checkbox" id="item{{ $menu->id }}" name="menu[]" value="{{ $menu->id }}" checked>
                                              <label for="item{{ $menu->id }}">{{ $menu->menu_name }}</label>
                                          </div>
                                      @endforeach
                                  </div>
                              @endforeach
                          </div>
                            <!-- Submit button -->
                            <button type="submit" class="btn btn-success btn-lg float-right">Register</button>
                            <br>
                              </form>
                            </div>
                          </div>
                    </div>
                    <!-- /.card-body -->
                  </div>
            </div>           
        </div>      
        <br>      
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @else
@php
    $redirectRoute = route('login');
    header("Location: $redirectRoute");
        exit();
@endphp
@endif
@endsection

@push('masterScripts')
<script type="text/javascript">
//Initialize Select2 Elements
$('.select2bs4').select2({
      theme: 'bootstrap4'
    })

const given_passoword = document.getElementById('password');
const confirm_password = document.getElementById('confirm_password');
const message = document.getElementById('message');

function typePassword() {
  confirm_password.value = '';
  message.style.color = 'white';                 
    };

function machPassword() {   
        // Check if passwords match
        if (given_passoword.value === confirm_password.value){
            message.textContent = 'Passwords match!';
            message.style.color = 'green';
        }else{
            message.textContent = 'Passwords do not match!';
            message.style.color = 'red';
        }             
    };



    function showDiv() {
    var dropdown = document.getElementById("assign_to");
    var warehouseDiv = document.getElementById("for_warehouse");
    var permissionDiv = document.getElementById("for_permission_review");
    var outletDiv = document.getElementById("for_outlet");
   
    //Employee Selected
    if((dropdown.value) == 0) {
        permissionDiv.style.display = "none";
        warehouseDiv.style.display = "none";
        outletDiv.style.display = "none";
        document.getElementById("warehouse_id").disabled = true;
        document.getElementById("for_permission_review").disabled = true;
        document.getElementById("outlet_id").disabled = true;
    //Inventory selected
    }else if((dropdown.value) == 1){
        permissionDiv.style.display = "block";
        warehouseDiv.style.display = "block";
        outletDiv.style.display = "none";
        document.getElementById("warehouse_id").disabled = false;
        document.getElementById("for_permission_review").disabled = false;
        document.getElementById("outlet_id").disabled = true;
    //POS selected
    }else if((dropdown.value) == 2){
        outletDiv.style.display = "block";
        warehouseDiv.style.display = "none";
        permissionDiv.style.display = "none";
        document.getElementById("warehouse_id").disabled = true;
        document.getElementById("for_permission_review").disabled = true;
        document.getElementById("outlet_id").disabled = false;
    //Both Selected
    }else{
        permissionDiv.style.display = "block";
        warehouseDiv.style.display = "block";
        outletDiv.style.display = "block";
        document.getElementById("for_permission_review").disabled = false;
        document.getElementById("warehouse_id").disabled = false;
        document.getElementById("outlet_id").disabled = false;
    }
  }

    //level and designation dependancy dropdown logic start
    $('#level').on('change',function(event){
      event.preventDefault();
      var selectedLevel = $('#level').val();

      if (selectedLevel == '') {
            $('#designation_name').html('');
            return false;
          }
      // Function to get CSRF token from meta tag
    function getCsrfToken() {
      return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      }
    // Set up Axios defaults
    axios.defaults.withCredentials = true;
    axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

    axios.get('sanctum/csrf-cookie').then(response=>{
    axios.post('/api/level_designation_dependancy',{
            data: selectedLevel
          }).then(response=>{
          $('#designation_name').html(response.data);
            console.log(response.data);
          });
    });
    });
    //level and designation dependancy dropdown logic end


    //branch and warehouse dependancy dropdown logic start
    $('#branch_id').on('change',function(event){
      event.preventDefault();
      var selectedBranch = $('#branch_id').val();

      if (selectedBranch == '') {
            $('#warehouse_id').html('');
            return false;
          }
      // Function to get CSRF token from meta tag
    function getCsrfToken() {
      return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      }
    // Set up Axios defaults
    axios.defaults.withCredentials = true;
    axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();


    axios.get('sanctum/csrf-cookie').then(response=>{
    axios.post('/api/branch_warehouse_dependancy',{
            data: selectedBranch
          }).then(response=>{
          $('#warehouse_id').html(response.data);
            console.log(response.data);
          });
    });
    });
    //branch and warehouse dependancy dropdown logic end


    //branch and outlet dependancy dropdown logic start
    $('#branch_id').on('change',function(event){
      event.preventDefault();
      var selectedBranch = $('#branch_id').val();

      if (selectedBranch == '') {
            $('#outlet_id').html('');
            return false;
          }
      // Function to get CSRF token from meta tag
    function getCsrfToken() {
      return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      }
    // Set up Axios defaults
    axios.defaults.withCredentials = true;
    axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();


    axios.get('sanctum/csrf-cookie').then(response=>{
    axios.post('/api/branch_outlet_dependancy',{
            data: selectedBranch
          }).then(response=>{
          $('#outlet_id').html(response.data);
            console.log(response.data);
          });
    });
    });
    //branch and outlet dependancy dropdown logic end



document.getElementById('addNewEmployeeForm').addEventListener('submit',function(event){
  event.preventDefault();

var empFormData = new FormData(this);


var full_name = document.getElementById('name').value;
    if(full_name == ''){
      Swal.fire({
              icon: "warning",
              title: "Please Enter Full Name",
            });
        return false;
    }

    var email = document.getElementById('email').value;
    if(email == ''){
      Swal.fire({
              icon: "warning",
              title: "Please Enter Email Address",
            });
        return false;
    }

      var g_passoword = document.getElementById('password').value;  
      if(g_passoword.length < 8){
        Swal.fire({
              icon: "warning",
              title: "Password must be at least 8 characters",
            });
        return false;
      }

      var c_password = document.getElementById('confirm_password').value;
      if(c_password == ''){
        Swal.fire({
                icon: "warning",
                title: "Password Confirmation must not be empty",
              });
          return false;
      }

      var joining_date = document.getElementById('joining_date').value;
      if(joining_date == ''){
        Swal.fire({
                icon: "warning",
                title: "Please Enter Joining Date",
              });
          return false;
      }


      var monthly_salary = document.getElementById('monthly_salary').value;
      if(monthly_salary == ''){
        Swal.fire({
                icon: "warning",
                title: "Please Enter Monthly Salary",
              });
          return false;
      }


      var level = document.getElementById('level').value;
      if(level == ''){
        Swal.fire({
                icon: "warning",
                title: "Please Select Level",
              });
          return false;
      }


      var designation_name = document.getElementById('designation_name').value;
      if(designation_name == ''){
        Swal.fire({
                icon: "warning",
                title: "Please Enter Designation",
              });
          return false;
      }

      
      var branch = document.getElementById('branch_id').value;
      if(branch == ''){
        Swal.fire({
                icon: "warning",
                title: "Please Enter Branch",
              });
          return false;
      }

      var assign_to = document.getElementById('assign_to').value;
      if(assign_to == ''){
        Swal.fire({
                icon: "warning",
                title: "Please Select Assign To",
              });
          return false;
      }

// Function to get CSRF token from meta tag
function getCsrfToken() {
  return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  }
// Set up Axios defaults
axios.defaults.withCredentials = true;
axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();


axios.get('sanctum/csrf-cookie').then(response=>{
 axios.post('/api/store_employee',empFormData).then(response=>{
  console.log(response);
  // window.location.reload();
  window.location.href = "{{ route('employee_list') }}";
  Swal.fire({
              icon: "success",
              title: ''+ response.data.message,
            });
        return false;
        
  }).catch(error => Swal.fire({
              icon: "error",
              title: error.response.data.message.email,
              }))
 });

});
//Initialize Select2 Elements
$('.select2bs4').select2({
    theme: 'bootstrap4'
    });
//initialize summernote
$('.summernote').summernote();


</script>
@endpush

