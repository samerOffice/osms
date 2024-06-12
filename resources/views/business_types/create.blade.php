@extends('master')

@section('title')
Welcome
@endsection

@section('content')
@if (Auth::check())
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <a class="btn btn-outline-info float-right" href="{{route('business_type_list')}}">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>         
            <div class="col-12">
                <br>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add Business Type</h3>
                      </div>
                    <div class="card-body">
                        <form id="addBusinessTypeForm">
                        <div class="row"> 
                            
                            <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>Business Type <small style="color: red">*</small></label>
                                    <input type="text" required placeholder="Business Type" id="business_type" name="business_type" class="form-control form-control-lg" />
                                </div> 
                            </div> 

                            <div class="col-md-12 col-sm-12">
                                <div class="form-group mb-4">
                                    <label>Status <small style="color: red">*</small></label>
                                    <select required class="form-control select2bs4" id="business_status" name="business_status" style="width: 100%;">                                  
                                      <option value="">Select</option>        
                                      <option value="1">Active</option>                    
                                      <option value="2">Inactive</option>                            
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


document.getElementById('addBusinessTypeForm').addEventListener('submit',function(event){
  event.preventDefault();

    var addBusinessTypeFormData = new FormData(this);

    var business_type = document.getElementById('business_type').value;
    if(business_type == ''){
    Swal.fire({
            icon: "warning",
            title: "Please Enter Business Type",
            });
        return false;
    }

    var business_status = document.getElementById('business_status').value;
    if(business_status == ''){
    Swal.fire({
            icon: "warning",
            title: "Please Enter Status",
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
axios.post('/osms/api/business_type_store',addBusinessTypeFormData).then(response=>{
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

