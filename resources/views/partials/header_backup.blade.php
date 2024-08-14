<nav class="main-header navbar navbar-expand" style="background-color: white">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  
    {{-- <div class="row" style="margin-left:5%;">    
      <span style="padding-top:5px"><img src="{{asset('img/otithee_logo.png')}}"  height="17px" width="auto" alt="logo"></span>
    <em> 
      <h5 style="color: green; font-weight: bold; margin-top:1px">&nbsp;Shop Management System </h5>
    </em>      
    </div> --}}
  
    <div class="row" style="margin-left:2%;">    
      <span style="padding-top:5px"><img src="{{asset('img/osmslogo.png')}}"  height="40px" width="auto" alt="logo"></span>
        
    </div>
  
  
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <form id="logOut">
        <button type="submit" class="btn btn-warning"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</button>
        <input type="hidden" id="myLoginUrl" value="{{ route('login') }}">
      </form>
      <!-- Navbar Search -->
      <!-- Messages Dropdown Menu -->
     
    </ul>
  </nav>
  
  @push('masterScripts')
  <script type="text/javascript">
  
    document.getElementById('logOut').addEventListener('submit',function(event){
    event.preventDefault();
    
    var myLoginUrl = document.getElementById('myLoginUrl').value;
  
    // Function to get CSRF token from meta tag
  function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }
  // Set up Axios defaults
  axios.defaults.withCredentials = true;
  axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();
    axios.post('api/logout').then(response=>{
  
        if((response.data.flag) == 1){
          window.location.href = myLoginUrl;
          console.log(response);
        }else{
          console.log(response);
        }
  });
  });
  
  </script>
  @endpush