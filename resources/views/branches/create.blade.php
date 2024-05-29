@extends('master')

@section('title')
Welcome
@endsection

@push('css')
<style>
    .switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
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
                <a class="btn btn-outline-info float-right" href="{{route('branch_list')}}">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>         
            <div class="col-12">
                <br>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add Branch</h3>
                      </div>
                    <div class="card-body">
                        <form id="addBranchForm">
                        <div class="row">       
                            <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>Branch Name <small style="color: red">*</small></label>
                                    <input type="text" required placeholder="Branch Name" id="br_name" name="br_name" class="form-control form-control-lg" />
                                </div> 
                            </div>
                
                            <div class="col-md-12 col-sm-12">
                            <div  class="form-group mb-4">
                                <label>Branch Address <small style="color: red">*</small></label>
                                <textarea name="br_address" required id="br_address"  class="form-control form-control-lg summernote"></textarea>
                            </div> 
                            </div>
                
                            <div class="col-md-12 col-sm-12">
                            <div  class="form-group mb-4">
                                <label for="password">Branch Type <small style="color: red">*</small></label>
                                <select class="form-control select2bs4" required id="br_type" name="br_type" style="width: 100%;">
                                    <option selected="selected" value="1">Head Office</option>
                                    <option value="2">Single Branch</option>
                                </select>
                            </div>  
                            </div>

                            <div class="col-md-12 col-sm-12">
                            <div class="form-group mb-4">
                                <label>Branch Status</label>
                                <label class="switch">
                                    <input type="checkbox" id="toggleButton" checked name="br_status" value="" class="toggle-switch-checkbox">
                                    <span class="slider round"></span>
                                  </label>
                              </div>
                            </div>
                
                            {{-- <div class="col-md-12 col-sm-12">
                            <div  class="form-group mb-4">
                                <label>Department Name</label>
                                <input type="text" placeholder="Department Name" id="dept_name" name="dept_name" class="form-control form-control-lg" />
                            </div> 
                            </div> --}}                                       
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
//Initialize Select2 Elements
$('.select2bs4').select2({
      theme: 'bootstrap4'
    })

//initialize summernote
$('.summernote').summernote();

// Event listener to toggle the input value when the switch is clicked
$('.toggle-switch-checkbox').change(function() {
           
           if ($(this).is(':checked')) {
               // Checkbox is checked and '1' is for activate
               $('#toggleButton').val(1);
           } else {
               // Checkbox is unchecked and '2' is for deactivate
               $('#toggleButton').val(2);
           }
       });  

document.getElementById('addBranchForm').addEventListener('submit',function(event){
  event.preventDefault();

var branchFormData = new FormData(this);


    var br_name = document.getElementById('br_name').value;
    if(br_name == ''){
    Swal.fire({
            icon: "warning",
            title: "Please Enter Branch Name",
            });
        return false;
    }

    var br_address = document.getElementById('br_address').value;
    if(br_address == ''){
    Swal.fire({
            icon: "warning",
            title: "Please Enter Branch Address",
            });
        return false;
    }

    var br_type = document.getElementById('br_type').value;
    if(br_type == ''){
    Swal.fire({
            icon: "warning",
            title: "Please Enter Branch Type",
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
 axios.post('/osms/api/branch_store',branchFormData).then(response=>{
  console.log(response);
  window.location.reload();
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




</script>
@endpush

