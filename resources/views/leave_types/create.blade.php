@extends('master')

@section('title')
Leave Type
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>
        <div class="row">
          <div class="col-12">
            <a class="btn btn-outline-info float-right" href="{{route('leave_types')}}">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
               
            <div class="col-12">
                <br>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add Leave Type</h3>
                      </div>
                    <div class="card-body">
                        <form id="leaveTypeForm">                             
                            <div class="card-body">
                              <div class="form-group">
                                <label >Type Name</label>
                                <input type="text" required class="form-control" id="type_name" name="type_name" >
                              </div> 
                              
                            </div>
                            <!-- /.card-body -->
                            <button type="submit" class="btn btn-info float-right mr-4">Submit</button>
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




document.getElementById('leaveTypeForm').addEventListener('submit',function(event){
  event.preventDefault();

var leaveTypeFormData = new FormData(this);
// const submitBtn = document.getElementById('submitBtn');

// Function to get CSRF token from meta tag
function getCsrfToken() {
  return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  }
// Set up Axios defaults
axios.defaults.withCredentials = true;
axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

axios.get('sanctum/csrf-cookie').then(response=>{
 axios.post('/api/submit_leave_tpye',leaveTypeFormData).then(response=>{
  console.log(response);
  setTimeout(function() {
    window.location.href = "{{ route('leave_types') }}";
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

