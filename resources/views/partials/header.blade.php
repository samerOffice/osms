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

<style>
[popover] {
  opacity: 0;
  transform: translateY(-20px);
  transition: all 0.25s allow-discrete;
}
[popover]::backdrop {
  background: rgba(0, 0, 0, 0);
  backdrop-filter: blur(0);
}
[popover]::backdrop {
  transition: all 0.25s allow-discrete;
}
[popover]:popover-open {
  opacity: 1;
  transform: translateY(0);
}
[popover]:popover-open::backdrop {
  background: rgba(0, 0, 0, 0.2);
  backdrop-filter: blur(10px);
}
@starting-style {
  [popover]:popover-open {
    opacity: 0;
    transform: translateY(-20px);
  }
  [popover]:popover-open::backdrop {
    background: rgba(0, 0, 0, 0);
    backdrop-filter: blur(0);
  }
}
</style>  


  <div class="calpopupbutton">
  <div class="flex justify-center my-20">
    <button
      type="button"
      popovertarget="my-popover"
      popovertargetaction="show"
      class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
      style="font-family: 'Noto Serif TC', serif; font-optical-sizing: auto;"
    >
      <img src="{{ asset('img/cal.png') }}" width="30" alt="logo">
    </button>
  </div>
</div>&nbsp;&nbsp;
<div id="my-popover" class="rounded-md sm:-top-1/4" popover="manual" style="opacity: 0; transform: translateY(-20px); transition: all 0.25s;">
  <div class="relative w-dvw h-dvh sm:h-auto sm:max-w-[50vw] sm:w-[500px]" style="background: rgba(0, 0, 0, 0); backdrop-filter: blur(0); transition: all 0.25s;">
    <div class="p-4 sm:px-6 space-y-3">
      <div class="cal" style="float: right;">
        <button
          type="button"
          popovertarget="my-popover"
          popovertargetaction="hide"
          class="text-lg absolute top-2 right-4 text-gray-700 border border-gray-700 hover:bg-gray-700 hover:text-white focus:outline-none font-medium rounded-full p-1 text-center inline-flex items-center dark:border-gray-500 dark:text-gray-500 dark:hover:text-white dark:focus:ring-gray-800 dark:hover:bg-gray-500"
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
            <path fill="currentColor" d="M18.3 5.71a.996.996 0 0 0-1.41 0L12 10.59L7.11 5.7A.996.996 0 1 0 5.7 7.11L10.59 12L5.7 16.89a.996.996 0 1 0 1.41 1.41L12 13.41l4.89 4.89a.996.996 0 1 0 1.41-1.41L13.41 12l4.89-4.89c.38-.38.38-1.02 0-1.4" />
          </svg>
        </button>
      </div>
      <form name="calc">
        <table style="margin: auto; background-color: #9dd2ea; width: 295px; height: 325px; text-align: center; border-radius: 4px;">
          <tr>
            <td>
              <input type="text" name="input" size="16" id="answer" style="left: 5px; top: 5px; margin: 5px; width: 270px; font-size: 26px; text-align: center; background-color: #F1FAEB; float: left;">
              <br>
            </td>
          </tr>
          <tr>
            <td>
              <input type="button" name="one" value="  1  " onclick="calc.input.value += '1'" style="left: 5px; top: 5px; margin: 5px; outline: 0; position: relative; border: 0; color: #495069; background-color: #fff; border-radius: 4px; width: 60px; height: 50px; float: left; font-size: 20px; box-shadow: 0 4px rgba(0,0,0,0.2);">
              <input type="button" name="two" value="  2  " onclick="calc.input.value += '2'" style="left: 5px; top: 5px; margin: 5px; outline: 0; position: relative; border: 0; color: #495069; background-color: #fff; border-radius: 4px; width: 60px; height: 50px; float: left; font-size: 20px; box-shadow: 0 4px rgba(0,0,0,0.2);">
              <input type="button" name="three" value="  3  " onclick="calc.input.value += '3'" style="left: 5px; top: 5px; margin: 5px; outline: 0; position: relative; border: 0; color: #495069; background-color: #fff; border-radius: 4px; width: 60px; height: 50px; float: left; font-size: 20px; box-shadow: 0 4px rgba(0,0,0,0.2);">
              <input type="button" class="operator" name="plus" value="  +  " onclick="calc.input.value += ' + '" style="left: 5px; top: 5px; margin: 5px; outline: 0; position: relative; border: 0; color: #495069; background-color: #f1ff92; border-radius: 4px; width: 60px; height: 50px; float: left; font-size: 20px; box-shadow: 0 4px rgba(0,0,0,0.2);">
              <br>
              <input type="button" name="four" value="  4  " onclick="calc.input.value += '4'" style="left: 5px; top: 5px; margin: 5px; outline: 0; position: relative; border: 0; color: #495069; background-color: #fff; border-radius: 4px; width: 60px; height: 50px; float: left; font-size: 20px; box-shadow: 0 4px rgba(0,0,0,0.2);">
              <input type="button" name="five" value="  5  " onclick="calc.input.value += '5'" style="left: 5px; top: 5px; margin: 5px; outline: 0; position: relative; border: 0; color: #495069; background-color: #fff; border-radius: 4px; width: 60px; height: 50px; float: left; font-size: 20px; box-shadow: 0 4px rgba(0,0,0,0.2);">
              <input type="button" name="six" value="  6  " onclick="calc.input.value += '6'" style="left: 5px; top: 5px; margin: 5px; outline: 0; position: relative; border: 0; color: #495069; background-color: #fff; border-radius: 4px; width: 60px; height: 50px; float: left; font-size: 20px; box-shadow: 0 4px rgba(0,0,0,0.2);">
              <input type="button" class="operator" name="minus" value="  -  " onclick="calc.input.value += ' - '" style="left: 5px; top: 5px; margin: 5px; outline: 0; position: relative; border: 0; color: #495069; background-color: #f1ff92; border-radius: 4px; width: 60px; height: 50px; float: left; font-size: 20px; box-shadow: 0 4px rgba(0,0,0,0.2);">
              <br>
              <input type="button" name="seven" value="  7  " onclick="calc.input.value += '7'" style="left: 5px; top: 5px; margin: 5px; outline: 0; position: relative; border: 0; color: #495069; background-color: #fff; border-radius: 4px; width: 60px; height: 50px; float: left; font-size: 20px; box-shadow: 0 4px rgba(0,0,0,0.2);">
              <input type="button" name="eight" value="  8  " onclick="calc.input.value += '8'" style="left: 5px; top: 5px; margin: 5px; outline: 0; position: relative; border: 0; color: #495069; background-color: #fff; border-radius: 4px; width: 60px; height: 50px; float: left; font-size: 20px; box-shadow: 0 4px rgba(0,0,0,0.2);">
              <input type="button" name="nine" value="  9  " onclick="calc.input.value += '9'" style="left: 5px; top: 5px; margin: 5px; outline: 0; position: relative; border: 0; color: #495069; background-color: #fff; border-radius: 4px; width: 60px; height: 50px; float: left; font-size: 20px; box-shadow: 0 4px rgba(0,0,0,0.2);">
              <input type="button" class="operator" name="times" value="  x  " onclick="calc.input.value += ' * '" style="left: 5px; top: 5px; margin: 5px; outline: 0; position: relative; border: 0; color: #495069; background-color: #f1ff92; border-radius: 4px; width: 60px; height: 50px; float: left; font-size: 20px; box-shadow: 0 4px rgba(0,0,0,0.2);">
              <br>
              <input type="button" id="clear" name="clear" value="  c  " onclick="calc.input.value = ''" style="left: 5px; top: 5px; margin: 5px; outline: 0; position: relative; border: 0; color: #495069; background-color: #ff9fa8; border-radius: 4px; width: 60px; height: 50px; float: left; font-size: 20px; margin-bottom: 15px; box-shadow: 0 4px rgba(0,0,0,0.2);">
              <input type="button" name="zero" value="  0  " onclick="calc.input.value += '0'" style="left: 5px; top: 5px; margin: 5px; outline: 0; position: relative; border: 0; color: #495069; background-color: #fff; border-radius: 4px; width: 60px; height: 50px; float: left; font-size: 20px; box-shadow: 0 4px rgba(0,0,0,0.2);">
              <input type="button" name="doit" value="  =  " onclick="calc.input.value = eval(calc.input.value)" style="left: 5px; top: 5px; margin: 5px; outline: 0; position: relative; border: 0; color: #495069; background-color: #fff; border-radius: 4px; width: 60px; height: 50px; float: left; font-size: 20px; box-shadow: 0 4px rgba(0,0,0,0.2);">
              <input type="button" class="operator" name="div" value="  /  " onclick="calc.input.value += ' / '" style="left: 5px; top: 5px; margin: 5px; outline: 0; position: relative; border: 0; color: #495069; background-color: #f1ff92; border-radius: 4px; width: 60px; height: 50px; float: left; font-size: 20px; box-shadow: 0 4px rgba(0,0,0,0.2);">
              <br>
            </td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    var popover = document.getElementById("my-popover");
    var buttons = document.querySelectorAll("[popovertarget]");

    buttons.forEach(function(button) {
      button.addEventListener("click", function() {
        var action = button.getAttribute("popovertargetaction");
        if (action === "show") {
          popover.style.opacity = "1";
          popover.style.transform = "translateY(0)";
          popover.style.background = "rgba(0, 0, 0, 0.2)";
          popover.style.backdropFilter = "blur(10px)";
        } else if (action === "hide") {
          popover.style.opacity = "0";
          popover.style.transform = "translateY(-20px)";
          popover.style.background = "rgba(0, 0, 0, 0)";
          popover.style.backdropFilter = "blur(0)";
        }
      });
    });
  });
</script>




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

const baseUrl = "{{ url('/api') }}/";

axios.post(baseUrl+'logout').then(response=>{

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