@extends('master')

@section('title')
Welcome
@endsection


@push('css')
<style>
#for_warehouse{
    display: none;
}

#for_outlet{
    display: none;
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
                <a class="btn btn-outline-info float-right" href="{{route('department_list')}}">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>         
            <div class="col-12">
                <br>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add Department</h3>
                      </div>
                    <div class="card-body">
                        <form id="addDepartmentForm">
                        <div class="row">       
                            <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>Department Name <small style="color: red">*</small></label>
                                    <input type="text" required placeholder="Department Name" id="dept_name" name="dept_name" class="form-control form-control-lg" />
                                </div> 
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div class="form-group mb-4">
                                    <label>Assign To <small style="color: red">*</small></label>
                                    <select required class="form-control select2bs4" onchange="showDiv()" id="assign_to" name="assign_to" style="width: 100%;">                                  
                                      <option value="">Select</option>
                                      <option value="1">Warehouse</option>
                                      <option value="2">Outlet</option>
                                      <option value="3">None</option>                                                        
                                  </select>
                                  </div> 
                            </div> 
                
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group mb-4">
                                    <label>Branch <small style="color: red">*</small></label>
                                    <select required class="form-control select2bs4" id="branch_id" name="branch_id" style="width: 100%;">                                  
                                      <option value="">Select Branch</option>
                                      @foreach ($branches as $branch)
                                      <option value="{{$branch->id}}">{{$branch->br_name}}</option>
                                      @endforeach                                                             
                                  </select>
                                  </div> 
                            </div>
                            
                            <div class="col-md-12 col-sm-12" id="for_warehouse">
                                <div class="form-group mb-4">
                                    <label>Warehouse <small style="color: red">*</small></label>
                                    <select required class="form-control select2bs4" id="warehouse_id" name="warehouse_id" style="width: 100%;">                                  
                                        <option value="" >Select Warehouse</option>                                                            
                                  </select>
                                  </div> 
                            </div>

                            <div class="col-md-12 col-sm-12" id="for_outlet">
                                <div class="form-group mb-4">
                                    <label>Outlet <small style="color: red">*</small></label>
                                    <select required class="form-control select2bs4" id="outlet_id" name="outlet_id" style="width: 100%;">                                  
                                      <option value="">Select Outlet</option>
                                      @foreach ($branches as $branch)
                                      <option value="{{$branch->id}}">{{$branch->br_name}}</option>
                                      @endforeach                                                             
                                  </select>
                                  </div> 
                            </div>

                                       
                          </div>
                          <button type="submit" class="btn btn-success float-right">Submit</button>
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

$(document).ready(function() {
    //Initialize Select2 Elements
    $('.select2bs4').select2({
          theme: 'bootstrap4'
        })

    //initialize summernote
    $('.summernote').summernote();
});

function showDiv() {
    var dropdown = document.getElementById("assign_to");
    var warehouseDiv = document.getElementById("for_warehouse");
    var outletDiv = document.getElementById("for_outlet");
   
    if((dropdown.value) == 1) {
        warehouseDiv.style.display = "block";
        outletDiv.style.display = "none";
        document.getElementById("warehouse_id").disabled = false;
        document.getElementById("outlet_id").disabled = true;
    }else if((dropdown.value) == 2){
        outletDiv.style.display = "block";
        warehouseDiv.style.display = "none";
        document.getElementById("warehouse_id").disabled = true;
        document.getElementById("outlet_id").disabled = false;
    }else{
        warehouseDiv.style.display = "none";
        outletDiv.style.display = "none";
        document.getElementById("warehouse_id").disabled = true;
        document.getElementById("outlet_id").disabled = true;
    }
}

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
 axios.post('/osms/api/branch_warehouse_dependancy',{
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
 axios.post('/osms/api/branch_outlet_dependancy',{
        data: selectedBranch
      }).then(response=>{
      $('#outlet_id').html(response.data);
        console.log(response.data);
      });
 });
});
//branch and outlet dependancy dropdown logic end



document.getElementById('addDepartmentForm').addEventListener('submit',function(event){
  event.preventDefault();

    var addDepartmentFormData = new FormData(this);

    var dept_name = document.getElementById('dept_name').value;
    if(dept_name == ''){
    Swal.fire({
            icon: "warning",
            title: "Please Enter Outlet Name",
            });
        return false;
    }


    var assign_to = document.getElementById('assign_to').value;
    if(assign_to == ''){
    Swal.fire({
            icon: "warning",
            title: "Please Select an option",
            });
        return false;
    }
 

    var branch_id = document.getElementById('branch_id').value;
    if(branch_id == ''){
    Swal.fire({
            icon: "warning",
            title: "Please Enter Branch",
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
 axios.post('/osms/api/department_store',addDepartmentFormData).then(response=>{
  console.log(response);
  window.location.reload();
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

});

</script>
@endpush

