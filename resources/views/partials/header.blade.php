<nav class="main-header navbar navbar-expand navbar-dark">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Navbar Search -->
   

    <!-- Messages Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        {{ Auth::user()->name }}&nbsp;<i class="far fa-user"></i>
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="{{route('add_additional_member_info')}}"><i class="fa fa-user"></i>&nbsp;Profile</a>
        <input type="hidden" id="myLoginUrl" value="{{ route('login') }}">
        <a class="dropdown-item" href="" >
          <form id="logOut">
          <button type="submit" class="btn btn-warning"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</button>
          </form>
        
        </a>
      </div>
    </li>
    
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


  axios.get('sanctum/csrf-cookie').then(response=>{
  axios.post('/osms/api/logout').then(response=>{
      if((response.data.flag) == 1){
        window.location.href = myLoginUrl;
        console.log(response);
      }else{
        console.log(response);
      }
  });
 });
});

</script>
@endpush