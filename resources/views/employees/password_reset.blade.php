@extends('master')

@section('title')
Password Reset
@endsection


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
                        <h3 class="card-title">Password Reset</h3>
                      </div>
                    <div class="card-body">
                        <form id="passwordResetForm">
                        <div class="row">       
                            <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>Current Password <small style="color: red">*</small></label>
                                    <input type="password"   id="current_password" name="current_password" class="form-control form-control-lg" />
                                </div> 
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>New Password <small style="color: red">*</small></label>
                                    <input type="password"   id="new_password" name="new_password" class="form-control form-control-lg" />
                                </div> 
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>Confirm New Password <small style="color: red">*</small></label>
                                    <input type="password"   id="confirm_password" name="confirm_password" class="form-control form-control-lg" />
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
//Initialize Select2 Elements
$('.select2bs4').select2({
      theme: 'bootstrap4'
    })

//initialize summernote
$('.summernote').summernote();

document.getElementById('passwordResetForm').addEventListener('submit',function(event){
  event.preventDefault();

var passwordResetFormData = new FormData(this);


    var current_password = document.getElementById('current_password').value;
    if(current_password == ''){
    Swal.fire({
            icon: "warning",
            title: "Please Enter Current Password",
            });
        return false;
    }

    var new_password = document.getElementById('new_password').value;
    if(new_password == ''){
    Swal.fire({
            icon: "warning",
            title: "Please Enter New Password",
            });
        return false;
    }

    var confirm_password = document.getElementById('confirm_password').value;
    if(confirm_password == ''){
    Swal.fire({
            icon: "warning",
            title: "Confirm password can not be null",
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
 axios.post('/osms/api/new_password_set',passwordResetFormData).then(response=>{
  console.log(response);
//   window.location.reload();
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

