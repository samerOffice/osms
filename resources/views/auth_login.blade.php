@extends('auth_master')

@section('title')
Login
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
            <form id="loginForm">
            <!-- Email input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <label for="Email">Email</label>
              <input type="email" placeholder="Email" id="email" name="email" class="form-control form-control-lg" />
            </div> 
            <!-- Password input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <label for="password">Password</label>
              <input type="password" placeholder="Password" id="password" name="password" class="form-control form-control-lg" />
            </div>       
            <!-- Submit button -->
            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block">Login</button>
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


var myDashboardUrl = document.getElementById('myDashboardUrl').value;

// const form = document.getElementById('loginForm');
document.getElementById('loginForm').addEventListener('submit', function(event) {
event.preventDefault();

var loginFormData = new FormData(this);

      // Alert the form data starts

      // var loginFormDataObject = {};
      // loginFormData.forEach(function(value, key){
      //   loginFormDataObject[key] = value;
      // });

      // alert(JSON.stringify(loginFormDataObject));

       // Alert the form data ends


// Function to get CSRF token from meta tag
function getCsrfToken() {
  return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  }
// Set up Axios defaults
axios.defaults.withCredentials = true;
axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();


 axios.post('api/login',loginFormData).then(response=>{

      if((response.data.flag) == 1){
        window.location.href = myDashboardUrl;
      }else{
        console.log(response);
         swal.fire(' '+ response.data.message, '', 'warning');
        return false;
       
      }
  });


});

</script>
@endpush