@extends('auth_master')

@section('title')
Registration
@endsection

@section('content')
<section >
    <div class="container mt-1" style="background-color: white; animation: 1.5s fadeIn; border-radius: 15px;" >
      <div class="row d-flex align-items-center justify-content-center h-80"  style="padding: 20px">
        <div class="col-md-8 col-lg-7 col-xl-6">
          <img src="{{asset('img/login_side_image1.jpg')}}"
            class="img-fluid" alt="Phone image">
        </div>
        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
          <img src="{{asset('img/otithee_logo.png')}}"  height="auto" width="103px" alt="logo" style="align-content: center">
            <h4 style="font-family: system-ui;"><a href="" class="h4"><em style="color: green; font-weight: bold"> Shop Management System</em> </a></h4>    
            <br>
             <input type="hidden" id="myDashboardUrl" value="{{ route('welcome2') }}">
            <form id="loginForm">
            <!-- Name input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <label for="Name">Full Name <small style="color: red">*</small></label>
              <input type="text" placeholder="Full Name" id="name" name="name" class="form-control form-control-lg" />
            </div> 

            <!-- Email input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <label for="Email">Email <small style="color: red">*</small></label>
              <input type="email" placeholder="Email" id="email" name="email" class="form-control form-control-lg" />
            </div> 

            <!-- Password input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <label for="password">Password <small style="color: red">*</small></label>
              <input type="password" placeholder="Password" id="password" name="password" class="form-control form-control-lg" />
            </div>

            <!-- Cofirm password input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <label for="password">Confirm Password <small style="color: red">*</small></label>
              <input type="password"  placeholder="Confirm Password" onkeyup="machPassword()"  id="confirm_password" name="" class="form-control form-control-lg" />
              <p id="message"></p>
            </div>
            
             <!-- Designation -->
             <div data-mdb-input-init class="form-outline mb-4">
                <label for="password">Designation</label>
              <input type="text" placeholder="Designation" id="designation" name="" class="form-control form-control-lg" />
            </div>

            <div class="row">
                <!-- Company -->
                <div class="col-4">
                <div data-mdb-input-init class="form-outline mb-4">
                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-lg">
                        Company
                    </button>
                </div> 
                </div>
                <!-- Branch -->
                <div class="col-4">
                <div data-mdb-input-init class="form-outline mb-4">
                    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#modal-lg">
                        Branch
                    </button>
                </div>
                </div>
                <!-- Department -->
                <div class="col-4">
                <div data-mdb-input-init class="form-outline mb-4">
                    <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#modal-lg">
                        Department
                    </button>
                </div>
                </div>
            </div>

            

            <div class="row">
                <div class="col-6">
                <!-- Role select -->
            <div data-mdb-input-init class="form-outline mb-4">
                <label for="password">Role <small style="color: red">*</small></label>
                <select class="form-control select2bs4" style="width: 100%;">
                    <option selected="selected">Alabama</option>
                    <option>Alaska</option>
                    <option>California</option>
                    <option>Delaware</option>
                    <option>Tennessee</option>
                    <option>Texas</option>
                    <option>Washington</option>
                  </select>
            </div> 
                </div>
                <div class="col-6">
              <!--  select -->
            <div data-mdb-input-init class="form-outline mb-4">
                <label for="password">Company Business Type</label>
                <select class="form-control select2bs4" style="width: 100%;">
                    <option selected="selected">Alabama</option>
                    <option>Alaska</option>
                    <option>California</option>
                    <option>Delaware</option>
                    <option>Tennessee</option>
                    <option>Texas</option>
                    <option>Washington</option>
                  </select>
            </div> 
                </div>
            </div>
                 
            <!-- Submit button -->
            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block">Register</button>
            <br>  
          </form>
        </div>
      </div>
      <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Large Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    </div>
  </section>
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


function machPassword() {   
        // Check if passwords match
        if (given_passoword.value === confirm_password.value){
            message.textContent = 'Passwords match!';
            message.style.color = 'green';

        }else if(confirm_password.value == ''){
        
            message.style.display = 'none';

        }else {
            message.textContent = 'Passwords do not match!';
            message.style.color = 'red';
        }
        
        
    };



var myDashboardUrl = document.getElementById('myDashboardUrl').value;
// const form = document.getElementById('loginForm');
document.getElementById('loginForm').addEventListener('submit', function(event) {
event.preventDefault();

var formData = new FormData(this);


      var formDataObject = {};
      formData.forEach(function(value, key){
        formDataObject[key] = value;
      });

      // Alert the form data

      // alert(JSON.stringify(formDataObject));


 axios.get('sanctum/csrf-cookie').then(response=>{
  axios.post('/osms/api/login',formData).then(response=>{

      if((response.data.flag) == 1){
        window.location.href = myDashboardUrl;
      }else{
        console.log(response);
      }
  });
 });

});

</script>
@endpush