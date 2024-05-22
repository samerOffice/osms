@extends('master')

@section('title')
Welcome
@endsection

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>
        <div class="row">
            <div class="col-12">
                <a class="btn btn-outline-info float-right" href="">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>

            <div class="col-2"></div>
           
            <div class="col-7">
                <br>
                <!-- Profile Image -->
            <div class="card card-success card-outline">
                <form id="attendanceForm">
                    <div class="card-body box-profile">
                        <div class="text-center">
                          <img class="profile-user-img img-fluid img-circle"
                               src="{{asset('public/dist/img/avatar5.png')}}"
                               alt="User profile picture">
                        </div>
        
                        <h3 class="profile-username text-center">{{auth()->user()->name}}</h3>
                        <p class="text-muted text-center">{{$designation->designation_name}}</p>
        
                        <ul class="list-group list-group-unbordered mb-3">
                          <li class="list-group-item">
                            <b>Date</b> <a class="float-right">{{ \Carbon\Carbon::now()->format('l, F j, Y') }}</a>
                          </li>
                          <li class="list-group-item">
                            <b>Time</b> 
                            @php
                            use Carbon\Carbon;
                            $currentTime = Carbon::now()->format('h:i A');
                            @endphp
                          <a class="float-right">{{ $currentTime }}</a>
                          </li>
                        </ul>
                        <button type="submit" id="submitBtn" class="btn btn-success float-right">Give Attendance</button>
                      </div>
                </form>          
             
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

@endsection

@push('masterScripts')
<script type="text/javascript">

document.getElementById('attendanceForm').addEventListener('submit',function(event){
  event.preventDefault();

var attendanceFormData = new FormData(this);
// const submitBtn = document.getElementById('submitBtn');

axios.get('sanctum/csrf-cookie').then(response=>{
 axios.post('/osms/api/submit_attendance',attendanceFormData).then(response=>{
  console.log(response);
  setTimeout(function() {
         window.location.reload();
      }, 2000);
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

