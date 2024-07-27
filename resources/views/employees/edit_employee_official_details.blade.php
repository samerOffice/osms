@extends('master')

@section('title')
Welcome
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
</style>
@endpush

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
            
            <div class="col-12">
                <br>
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Employee Details</h3>
                  </div>  

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">                                
                                <label>Full Name: </label>
                                <span style="color: green">{{$employee->name}}</span>                    
                            </div>

                            <div class="col-md-4 col-sm-12">                          
                                <label>Email: </label>
                                <span style="color: green">{{$employee->email}}</span>             
                            </div>

                            <div class="col-md-4 col-sm-12">                          
                              <label>Joining Date: </label>
                              <span style="color: green">{{$employee->joining_date}}</span>         
                            </div>
                            
                            <div class="col-md-4 col-sm-12">                          
                              <label>Designation: </label>
                              <span style="color: green">{{$employee->designation_name}}</span>         
                            </div>

                            <div class="col-md-4 col-sm-12">                          
                              <label>Branch: </label>
                              <span style="color: green">{{$employee->branch_name}}</span>         
                            </div>

                            @if($employee->warehouse_name != '')
                              <div class="col-md-4 col-sm-12">                          
                                <label>Warehouse: </label>
                                <span style="color: green">{{$employee->warehouse_name}}</span>         
                              </div>
                            @endif
                            
                            @if($employee->outlet_name != '')
                            <div class="col-md-4 col-sm-12">                          
                              <label>Outlet: </label>
                              <span style="color: green">{{$employee->outlet_name}}</span>         
                            </div>
                            @endif
                          </div>                            
                    </div>

                    <div class="card-body">
                        <form id="updateEmpOfficialInfoForm" >
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
                                            <option value="1">Inventory</option>                                        
                                            <option value="2">POS</option>                                       
                                            <option value="3">Both</option>                           
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

                            <input type="hidden" value="{{$employee->id}}" name="id" id="emp_id">
                            <button type="submit" id="sub" class="btn btn-info float-right mr-4">Update</button>
                          </form>
                    </div>
                    <!-- /.card-body -->
                  </div>
            </div>           
        </div>      
        <br>
         
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

  </div>

@endsection

@push('masterScripts')
<script>
 
 $(document).ready(function() {
//Initialize Select2 Elements
$('.select2bs4').select2({
      theme: 'bootstrap4'
    })    
});



function showDiv() {
    var dropdown = document.getElementById("assign_to");
    var warehouseDiv = document.getElementById("for_warehouse");
    var permissionDiv = document.getElementById("for_permission_review");
    var outletDiv = document.getElementById("for_outlet");
   
    //Inventory Selected
    if((dropdown.value) == 1) {
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

    axios.post('/osms/api/level_designation_dependancy',{
            data: selectedLevel
          }).then(response=>{
          $('#designation_name').html(response.data);
            console.log(response.data);
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


    axios.post('/osms/api/branch_warehouse_dependancy',{
            data: selectedBranch
          }).then(response=>{
          $('#warehouse_id').html(response.data);
            console.log(response.data);
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


    axios.post('/osms/api/branch_outlet_dependancy',{
            data: selectedBranch
          }).then(response=>{
          $('#outlet_id').html(response.data);
            console.log(response.data);
          });
    });
    //branch and outlet dependancy dropdown logic end


    document.getElementById('updateEmpOfficialInfoForm').addEventListener('submit',function(event){
    event.preventDefault();


    var updateEmpOfficialInfoFormData = new FormData(this);
    var emp_id = document.getElementById('emp_id').value;


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

   
    axios.post('/osms/api/update_employee_official_info/' + emp_id, updateEmpOfficialInfoFormData).then(response=>{
    console.log(response);
    setTimeout(function() {
            window.location.reload();
        }, 2000);
    Swal.fire({
                icon: "success",
                title: ''+ response.data.message,
                });
            return false;
            
    }).catch(error => Swal.fire({
                icon: "error",
                title: error.response.data.message,
                }))

    });
    
</script>
  @endpush