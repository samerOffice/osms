@extends('auth_master')

@section('title')
Registration
@endsection

@section('content')

@if(Auth::check())
@php
$redirectRoute = route('home');
header("Location: $redirectRoute");
    exit();
@endphp
@else
<section >
    <div class="container mt-1" style="background-color: white; animation: 1.5s fadeIn; border-radius: 15px;" >
      <div class="row d-flex align-items-center justify-content-center h-80"  style="padding: 20px">
        <div class="col-md-8 col-lg-7 col-xl-6">
          <img src="{{asset('public/img/login_side_image1.jpg')}}"
            class="img-fluid" alt="Phone image">
        </div>
        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
          <img src="{{asset('public/img/otithee_logo.png')}}"  height="auto" width="103px" alt="logo" style="align-content: center">
            <h4 style="font-family: system-ui;"><a href="" class="h4"><em style="color: green; font-weight: bold"> Shop Management System</em> </a></h4>    
            <br>
             <input type="hidden" id="myDashboardUrl" value="{{ route('home') }}">
            <form id="registerForm">
            <!-- Name input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <label for="Name">Full Name <small style="color: red">*</small></label>
              <input type="text"  placeholder="Full Name" id="name" name="name" class="form-control form-control-lg" />
            </div> 

            <!-- Email input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <label for="Email">Email <small style="color: red">*</small></label>
              <input type="email"  placeholder="Email" id="email" name="email" class="form-control form-control-lg" />
            </div> 

            <!-- Password input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <label for="password">Password <small style="color: red">*</small></label>
              <input type="password"  placeholder="Password" onkeyup="typePassword()" id="password" name="password" class="form-control form-control-lg" />
            </div>

            <!-- Cofirm password input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <label for="password">Confirm Password <small style="color: red">*</small></label>
              <input type="password"   placeholder="Confirm Password" onkeyup="machPassword()"  id="confirm_password" name="" class="form-control form-control-lg" />
              <p id="message"></p>
            </div>
            
            <div class="row">
              <div class="col-md-6 col-sm-12">
                <!-- Designation -->
              <div data-mdb-input-init class="form-outline mb-4">
                <label for="password">Designation <small style="color: red">*</small></label>
                <select class="form-control select2bs4" id="designation_name"  name="designation_name" style="width: 100%;">
                    <option selected="selected" value="">Select Designation</option>
                    @foreach($designations as $designation)
                    <option value="{{$designation->id}}">{{$designation->designation_name}}</option>
                    @endforeach
                  </select>
              </div>
              </div>
              <div class="col-md-6 col-sm-12">
                 <!-- Joining Date -->
                 <div data-mdb-input-init class="form-outline mb-4">
                  <label >Joining Date <small style="color: red">*</small></label>
                <input type="date"  id="joining_date" name="joining_date" class="form-control form-control-lg" />
              </div>
              </div>
            </div>
             

           

            <div class="row">
                <!-- Company -->
                <div class="col-md-6 col-sm-12">
                <div data-mdb-input-init class="form-outline mb-4">
                    <button type="button" class="btn btn-lg btn-outline-primary" data-toggle="modal" data-target="#modal-company">
                        Company Details
                    </button>
                </div> 
                </div>
                <!-- Branch -->
                <div class="col-md-6 col-sm-12">
                <div data-mdb-input-init class="form-outline mb-4">
                    <button type="button" class="btn btn-lg btn-outline-info" data-toggle="modal" data-target="#modal-branch">
                        Branch Details
                    </button>
                </div>
                </div>
                
            </div>

            <div class="row">
              <div class="col-6">
              <!-- Role select -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label for="password">Role <small style="color: red">*</small></label>
                    <select class="form-control select2bs4" id="role" name="role" style="width: 100%;">
                        <option selected="selected" value="">Select Role</option>
                        @foreach($roles as $role)
                        <option value="{{$role->id}}">{{$role->role_name}}</option>
                        @endforeach
                      </select>
                </div> 
              </div>
              <div class="col-6">
            <!-- Business Type select -->
              <div data-mdb-input-init class="form-outline mb-4">
                  <label for="password">Business Type <small style="color: red">*</small></label>
                  {{-- <input type="text" required placeholder="Ex. Super shop" id="business_type" name="business_type" class="form-control form-control-lg" /> --}}
                  <select class="form-control select2bs4" id="business_type"  name="business_type" style="width: 100%;">
                    <option selected="selected" value="">Select Business Type</option>
                    @foreach($business_types as $business_type)
                    <option value="{{$business_type->id}}">{{$business_type->business_type}}</option>
                    @endforeach
                  </select>
              </div> 
              </div>
          </div>

            
                
            <!-- modal company -->
            <div class="modal fade" id="modal-company">
             <div class="modal-dialog modal-lg">        
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" style="color:blueviolet">Company Details</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row">

                    <div class="col-md-6 col-sm-12">
                     <div data-mdb-input-init class="form-outline mb-4">
                        <label>Company Name <small style="color: red">*</small></label>
                      <input type="text"  placeholder="Company Name" id="company_name" name="company_name" class="form-control form-control-lg" />
                     </div> 
                    </div>

                    <div class="col-md-6 col-sm-12">
                     <div data-mdb-input-init class="form-outline mb-4">
                        <label>Company Email</label>
                      <input type="email" placeholder="Company Email" id="company_email" name="company_email" class="form-control form-control-lg" />
                     </div> 
                    </div>

                    <div class="col-md-6 col-sm-12">
                     <div data-mdb-input-init class="form-outline mb-4">
                        <label>Company Contact Number <small style="color: red">*</small></label>
                      <input type="text"  placeholder="Contact No." id="company_contact_no" name="company_contact_no" class="form-control form-control-lg" />
                     </div> 
                    </div>

                    <div class="col-md-6 col-sm-12">
                     <div data-mdb-input-init class="form-outline mb-4">
                        <label>Company Trade License Number <small style="color: red">*</small></label>
                      <input type="text"  placeholder="License No." id="company_license_no" name="company_license_no" class="form-control form-control-lg" />
                     </div> 
                    </div>


                    <div class="col-md-6 col-sm-12">
                     <div data-mdb-input-init class="form-outline mb-4">
                        <label>Company Registration Number</label>
                      <input type="text" placeholder="Registration No." id="company_reg_no" name="company_reg_no" class="form-control form-control-lg" />
                     </div> 
                    </div>

                    <div class="col-md-6 col-sm-12">
                     <div data-mdb-input-init class="form-outline mb-4">
                        <label>Company Address</label>
                      <textarea name="company_address"  id="company_address"  class="form-control form-control-lg"></textarea>
                     </div> 
                    </div>

                    <div class="col-md-6 col-sm-12">
                     <div data-mdb-input-init class="form-outline mb-4">
                        <label>Division</label>
                <select class="form-control select2bs4" id="division" name="division" style="width: 100%;">
                  <option selected="selected" value="">Select Division</option>
                  @foreach($divisions as $division)
                  <option value="{{$division->id}}">{{$division->name}}</option>
                  @endforeach
                </select>
                     </div> 
                    </div>

                  <div class="col-md-6 col-sm-12">
                    <div data-mdb-input-init class="form-outline mb-4">
                      <label>District</label>
                    <select class="form-control select2bs4" id="district" name="district" style="width: 100%;">
                      <option value="" >Select District</option>
                    </select>
                    </div> 
                  </div>

                    <div class="col-md-6 col-sm-12">
                     <div data-mdb-input-init class="form-outline mb-4">
                        <label>Country</label>
                      <input type="text" placeholder="Country Name" id="company_country" name="company_country" class="form-control form-control-lg" />
                     </div> 
                    </div>

                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button"  class="btn btn-outline-danger btn-lg float-right" data-dismiss="modal">Close</button>
                </div>
              </div>
             </div> 
          </div>
          <!-- modal company ends -->

          <!-- modal branch -->
          <div class="modal fade" id="modal-branch">
            <div class="modal-dialog modal-lg">        
             <div class="modal-content">
               <div class="modal-header">
                 <h4 class="modal-title" style="color:blueviolet">Branch Details</h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               <div class="modal-body">
                 <div class="row">

                   <div class="col-md-12 col-sm-12">
                    <div data-mdb-input-init class="form-outline mb-4">
                       <label>Branch Name</label>
                     <input type="text" placeholder="Branch Name" id="br_name" name="br_name" class="form-control form-control-lg" />
                    </div> 
                   </div>

                   <div class="col-md-12 col-sm-12">
                    <div data-mdb-input-init class="form-outline mb-4">
                       <label>Branch Address</label>
                     <textarea name="br_address" id="br_address"  class="form-control form-control-lg"></textarea>
                    </div> 
                   </div>

                   <div class="col-md-12 col-sm-12">
                    <div data-mdb-input-init class="form-outline mb-4">
                      <label for="password">Branch Type</label>
                      <select class="form-control select2bs4" name="br_type" style="width: 100%;">
                          <option selected="selected" value="1">Head Office</option>
                          <option value="2">Single Branch</option>
                        </select>
                    </div>  
                   </div>

                   <div class="col-md-12 col-sm-12">
                    <div data-mdb-input-init class="form-outline mb-4">
                       <label>Department Name</label>
                     <input type="text" placeholder="Department Name" id="dept_name" name="dept_name" class="form-control form-control-lg" />
                    </div> 
                   </div>

                   
                 </div>
               </div>
               <div class="modal-footer">
                 <button type="button" class="btn btn-outline-danger btn-lg float-right" data-dismiss="modal">Close</button>
               </div>
             </div>
            </div> 
         </div>
          <!-- modal branch ends -->
        <!-- Submit button -->
        <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-success btn-lg btn-block">Register</button>
        <br>
          </form>
        </div>
      </div>
    </div>
  </section>
  @endif
@endsection


@push('myScripts')
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

var myDashboardUrl = document.getElementById('myDashboardUrl').value;

//division and district dependancy dropdown logic start
$('#division').on('change',function(event){
  event.preventDefault();
  var selectedDivision = $('#division').val();

  if (selectedDivision == '') {
        $('#district').html('');
        return false;
      }
  axios.get('sanctum/csrf-cookie').then(response=>{
 axios.post('/osms/api/division',{
        data: selectedDivision
      }).then(response=>{
      $('#district').html(response.data);
        console.log(response.data);
      });
 });
});
//division and district dependancy dropdown logic end


//registration form submission start
document.getElementById('registerForm').addEventListener('submit', function(event){
event.preventDefault();
var registerFormData = new FormData(this);

// --------------Alert the form data starts--------------
// var registerFormDataObject = {};
// registerFormData.forEach(function(value, key){
//   registerFormDataObject[key] = value;
// });
// alert(JSON.stringify(registerFormDataObject));
// return false;
// --------------Alert the form data ends----------------   


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


      var designation_name = document.getElementById('designation_name').value;
      if(designation_name == ''){
        Swal.fire({
                icon: "warning",
                title: "Please Enter Designation",
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

      var company_name = document.getElementById('company_name').value;
      if(company_name == ''){
        Swal.fire({
                icon: "warning",
                title: "Please Enter Company Name",
              });
          return false;
      }


      var company_contact_no = document.getElementById('company_contact_no').value;
      if(company_contact_no == ''){
        Swal.fire({
                icon: "warning",
                title: "Please Enter Company Contact Number",
              });
          return false;
      }

      var company_license_no = document.getElementById('company_license_no').value;
      if(company_license_no == ''){
        Swal.fire({
                icon: "warning",
                title: "Please Enter Company Trade License Number",
              });
          return false;
      }

      var user_role = document.getElementById('role').value;
      if(user_role == ''){
        Swal.fire({
                icon: "warning",
                title: "Please Enter User Role",
              });
          return false;
      }

      var business_type = document.getElementById('business_type').value;
      if(business_type == ''){
        Swal.fire({
                icon: "warning",
                title: "Please Enter Company Business Type",
              });
          return false;
      }

   
 axios.get('sanctum/csrf-cookie').then(response=>{
 axios.post('/osms/api/register',registerFormData).then(response=>{
  window.location.href = myDashboardUrl;
  }).catch(error => Swal.fire({
              icon: "error",
              title: error.response.data.message.email,
              }))
 });

});
//registration form submission start

</script>
@endpush