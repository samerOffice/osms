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
                <a class="btn btn-outline-info float-right" href="{{route('designation_list')}}">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>         
            <div class="col-12">
                <br>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add Designation</h3>
                      </div>
                    <div class="card-body">
                        <form id="addDesignationForm">
                        <div class="row">                          
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group mb-4">
                                    <label>Designation Level <small style="color: red">*</small></label>
                                    <select required class="form-control select2bs4" id="level" name="level" style="width: 100%;">                                  
                                      <option value="">Select Level</option>                                      
                                      <option value="1">Managing Level</option>                                   
                                      <option value="2">Operational Level</option>                                   
                                      <option value="3">Support Level</option>                                   
                                  </select>
                                  </div> 
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>Designation Name <small style="color: red">*</small></label>
                                    <input type="text" required placeholder="Designation Name" id="designation_name" name="designation_name" class="form-control form-control-lg" />
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


document.getElementById('addDesignationForm').addEventListener('submit',function(event){
  event.preventDefault();

    var addDesignationFormData = new FormData(this);

    var level = document.getElementById('level').value;
    if(level == ''){
    Swal.fire({
            icon: "warning",
            title: "Please Enter Designation Level",
            });
        return false;
    }

    var designation_name = document.getElementById('designation_name').value;
    if(designation_name == ''){
    Swal.fire({
            icon: "warning",
            title: "Please Enter Designation Name",
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
axios.post('/osms/api/designation_store',addDesignationFormData).then(response=>{
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

