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
                                
                                <div class="row">
                                  <div class="col-md-4 col-sm-12">
                                    <!-- Designation -->
                                  <div  class="form-group mb-4">
                                    <label for="password">Designation <small style="color: red">*</small></label>
                                    <select class="form-control select2bs4" id="designation_name"  name="designation_name" style="width: 100%;">
                                        <option selected="selected" value="">Select Designation</option>
                                        @foreach($designations as $designation)
                                        <option value="{{$designation->id}}">{{$designation->designation_name}}</option>
                                        @endforeach
                                      </select>
                                  </div>
                                  </div>
                                 
                                  <div class="col-md-4 col-sm-12">
                                    <!-- Branch select -->
                                      <div  class="form-group mb-4">
                                          <label for="password">Branch <small style="color: red">*</small></label>
                                          <select class="form-control select2bs4" id="role" name="role" style="width: 100%;">
                                              <option selected="selected" value="">Select Branch</option>
                                              @foreach($roles as $role)
                                              <option value="{{$role->id}}">{{$role->role_name}}</option>
                                              @endforeach
                                            </select>
                                      </div> 
                                    </div>

                                    <div class="col-md-4 col-sm-12">
                                        <!-- Joining Date -->
                                        <div  class="form-group mb-4">
                                         <label >Joining Date <small style="color: red">*</small></label>
                                       <input type="date"  id="joining_date" name="joining_date" class="form-control form-control-lg" />
                                     </div>
                                     </div>
   
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

document.getElementById('memberForm').addEventListener('submit',function(event){
  event.preventDefault();

var memberFormData = new FormData(this);

// Function to get CSRF token from meta tag
function getCsrfToken() {
  return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  }
// Set up Axios defaults
axios.defaults.withCredentials = true;
axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();


axios.get('sanctum/csrf-cookie').then(response=>{
 axios.post('/osms/api/member_information_store',memberFormData).then(response=>{
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
//Initialize Select2 Elements
$('.select2bs4').select2({
    theme: 'bootstrap4'
    });
//initialize summernote
$('.summernote').summernote();


</script>
@endpush

