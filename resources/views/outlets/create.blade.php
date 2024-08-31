@extends('master')

@section('title')
Add Outlet
@endsection

@section('content')
@if (Auth::check())
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <a class="btn btn-outline-info float-right" href="{{route('outlet_list')}}">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>         
            <div class="col-12">
                <br>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add Outlet</h3>
                      </div>
                    <div class="card-body">
                        <form id="addOutletForm">
                        <div class="row">       
                            <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>Outlet Name <small style="color: red">*</small></label>
                                    <input type="text" required placeholder="Outlet Name" id="outlet_name" name="outlet_name" class="form-control form-control-lg" />
                                </div> 
                            </div>
                
                            <div class="col-md-12 col-sm-12">
                            <div  class="form-group mb-4">
                                <label>Outlet Address <small style="color: red">*</small></label>
                                <textarea name="outlet_address" required id="outlet_address"  class="form-control form-control-lg summernote"></textarea>
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

                            <div class="col-md-12 col-sm-12">
                              <div class="form-group mb-4">
                                  <label>Outlet Status <small style="color: red">*</small></label>
                                  <select required class="form-control select2bs4" id="outlet_status" name="outlet_status" style="width: 100%;">                                  
                                    <option value="1">Open</option>
                                    <option value="2">Closed</option>                                                          
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


document.getElementById('addOutletForm').addEventListener('submit',function(event){
  event.preventDefault();

    var addOutletFormData = new FormData(this);

    var outlet_name = document.getElementById('outlet_name').value;
    if(outlet_name == ''){
    Swal.fire({
            icon: "warning",
            title: "Please Enter Outlet Name",
            });
        return false;
    }

    var outlet_address = document.getElementById('outlet_address').value;
    if(outlet_address == ''){
    Swal.fire({
            icon: "warning",
            title: "Please Enter Outlet Address",
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

    var outlet_status = document.getElementById('outlet_status').value;
    if(outlet_status == ''){
    Swal.fire({
            icon: "warning",
            title: "Please Select Status",
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
 axios.post('/api/outlet_store',addOutletFormData).then(response=>{
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

