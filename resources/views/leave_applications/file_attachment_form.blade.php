@extends('master')

@section('title')
Leave Application | File Attachment
@endsection

@section('content')
@if (Auth::check())
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>
        <div class="row">
            <div class="col-12">
                <a class="btn btn-outline-info float-right" href="{{route('apply_leave')}}">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>  
            <div class="col-12">
                <br>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Attach Leave Application</h3>
                      </div>
                    <div class="card-body">

                        <form id="leaveApplicationForm">                          
                            <div class="card-body">

                                <div class="form-group mb-4">
                                    <label>Leave Type <small style="color: red">*</small></label>
                                    <select required class="form-control select2bs4" id="leave_type" name="leave_type" style="width: 100%;">                                  
                                        <option value="">--Select--</option>
                                        @foreach ($leave_types as $leave_type)
                                        <option value="{{$leave_type->id}}">{{$leave_type->type_name}}</option>
                                        @endforeach                                                             
                                    </select>
                                </div>
                                
                                <h5>Leave Duration</h5>
                                <br>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group mb-4">
                                            <label >Application From <small style="color: red">*</small></label>
                                            <input type="date" required id="application_from" name="application_from" value="{{ date('Y-m-d') }}" class="form-control form-control-lg" />
                                        </div> 
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group mb-4">
                                            <label >Application To <small style="color: red">*</small></label>
                                            <input type="date" required id="application_to" name="application_to" value="{{ date('Y-m-d') }}" class="form-control form-control-lg" />
                                        </div> 
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group mb-4">
                                            <label for="duration">Duration (days)</label>
                                            <input type="text" id="duration" name="duration" readonly class="form-control form-control-lg" />
                                        </div> 
                                    </div>
                                </div>

                              <div class="form-group">
                                <label>Attach Your Application</label>
                                <input type="file" required class="form-control" id="attach_leave_application" name="attach_leave_application">
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

$(document).ready(function() {

//Initialize Select2 Elements
$('.select2bs4').select2({
      theme: 'bootstrap4'
    })


});


// Execute the function (duration between application from and application to) when the page loads
document.addEventListener('DOMContentLoaded', validateAndCalculateDuration);

 // Get today's date
 const today = new Date().toISOString().split('T')[0];
// Set the minimum date to today
document.getElementById('application_from').setAttribute('min', today);
document.getElementById('application_to').setAttribute('min', today);

// Attach the function to the 'change' event of the 'application_to' input
document.getElementById('application_from').addEventListener('change', clearApplicationToDate);
document.getElementById('application_to').addEventListener('change', validateDates);
document.getElementById('application_to').addEventListener('change', validateAndCalculateDuration);


//clear 'Application To' date is 'Application From' is changing
 function clearApplicationToDate(){
    document.getElementById('application_to').value = ''; // Clear the 'application_to' field
    document.getElementById('duration').value = ''; // Clear the 'duration' field
 }

 // Function to compare the dates and show alert
 function validateDates() {
        const fromDate = document.getElementById('application_from').value;
        const toDate = document.getElementById('application_to').value;
        
        if (toDate < fromDate) {
                Swal.fire({
                icon: "warning",
                title: " 'Application To' date cannot be earlier than 'Application From' date.",
            });
            
            document.getElementById('application_to').value = ''; // Clear the 'application_to' field
        }
    }


 // Function to compare dates, show alert, clear 'application_to', and calculate duration
 function validateAndCalculateDuration() {
        const fromDate = new Date(document.getElementById('application_from').value);
        const toDate = new Date(document.getElementById('application_to').value);
        
        if (toDate < fromDate) {
            alert('The "Application To" date cannot be earlier than the "Application From" date.');
            document.getElementById('application_to').value = ''; // Clear the 'application_to' field
            document.getElementById('duration').value = ''; // Clear the duration field
        } else {
            // Calculate the duration in days
            const durationInMilliseconds = toDate - fromDate;
            // const durationInDays = durationInMilliseconds / (1000 * 60 * 60 * 24);
            const durationInDays = (durationInMilliseconds / (1000 * 60 * 60 * 24)) + 1; // Add 1 to count the first day
            document.getElementById('duration').value = durationInDays; // Display duration
        }
    }

document.getElementById('leaveApplicationForm').addEventListener('submit',function(event){
  event.preventDefault();

      var fileInput = $('#attach_leave_application')[0];
      var filePath = fileInput.value;
      var allowedExtensions = /(\.pdf)$/i;
      var maxSize = 500 * 1024; // 500 KB
      
      //file format
      if (!allowedExtensions.exec(filePath)) {
        Swal.fire({
            icon: "warning",
            title: "Invalid file type. Only pdf file is allowed.",
            });
            $('#attach_leave_application').val(''); // Clear the input
            e.preventDefault(); // Prevent the form from submitting
            return false;
    }

    // Validate file size
    if (fileInput.files.length > 0 && fileInput.files[0].size > maxSize) {
        Swal.fire({
            icon: "warning",
            title: "File size must be less than 500 KB.",
            });
        $('#attach_leave_application').val(''); // Clear the input
        e.preventDefault(); // Prevent the form from submitting
        return false;
      }
        
  
var leaveApplicationFormData = new FormData(this);
// Function to get CSRF token from meta tag
function getCsrfToken() {
  return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  }
// Set up Axios defaults
axios.defaults.withCredentials = true;
axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();


axios.get('sanctum/csrf-cookie').then(response=>{
 axios.post('/api/leave_application_attach_file_store',leaveApplicationFormData).then(response=>{
  console.log(response);
//   window.location.reload();
  window.location.href = "{{ route('leave_applications') }}";
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

