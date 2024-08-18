@extends('master')

@section('title')
Edit Leave Application
@endsection

@push('css')
<style>
#for_permission_review{
    display: none;
}
</style>
@endpush

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>
        <div class="row">
            <div class="col-12">
                <a class="btn btn-outline-info float-right" href="{{route('leave_applications')}}">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
            
            <div class="col-12">
                <br>
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Leave Application Details</h3>
                  </div>  

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">                                
                                <label>User ID: </label>
                                <span style="color: green">{{$leaveApplication->user_id}}</span>                    
                            </div>

                            <div class="col-md-4 col-sm-12">                          
                                <label>Application Type: </label>
                                <span style="color: green">{{$leaveApplication->application_type}}</span>             
                            </div>

                            <div class="col-md-4 col-sm-12">                          
                              <label>Application Date: </label>
                              <span style="color: green">{{$leaveApplication->application_date}}</span>         
                            </div>
                            
                            <div class="col-md-4 col-sm-12">                          
                              <label>Status: </label>
                              <span style="color: green">
                                  @if($leaveApplication->application_status == 0)
                                      Rejected
                                  @elseif($leaveApplication->application_status == 1)
                                      Approved
                                  @else
                                      Pending
                                  @endif
                              </span>         
                            </div>

                            @if($leaveApplication->application_approved_user_id != '')
                              <div class="col-md-4 col-sm-12">                          
                                <label>Approved User ID: </label>
                                <span style="color: green">{{$leaveApplication->application_approved_user_id}}</span>         
                              </div>
                            @endif
                            
                            @if($leaveApplication->application_approved_date != '')
                            <div class="col-md-4 col-sm-12">                          
                              <label>Approved Date: </label>
                              <span style="color: green">{{$leaveApplication->application_approved_date}}</span>         
                            </div>
                            @endif
                          </div>                            
                    </div>

                    <div class="card-body">
                        <form id="updateLeaveApplicationForm">
                          <div class="row">
                            <div class="col-md-3 col-sm-12">
                              <!-- User ID -->
                                <div class="form-group mb-4">
                                    <label for="user_id">User ID <small style="color: red">*</small></label>
                                    <input type="text" class="form-control" id="user_id" name="user_id" value="{{ $leaveApplication->user_id }}" required>
                                </div> 
                              </div>

                            <div class="col-md-3 col-sm-12">
                              <!-- Application Type -->
                                <div class="form-group mb-4">
                                    <label for="application_type">Application Type <small style="color: red">*</small></label>
                                    <input type="text" class="form-control" id="application_type" name="application_type" value="{{ $leaveApplication->application_type }}" required>
                                </div>
                            </div>
                            
                            <div class="col-md-3 col-sm-12">
                              <!-- Application Date -->
                                <div class="form-group mb-4">
                                    <label for="application_date">Application Date <small style="color: red">*</small></label>
                                    <input type="date" class="form-control" id="application_date" name="application_date" value="{{ $leaveApplication->application_date }}" required>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-12">
                              <!-- Status -->
                                <div class="form-group mb-4">
                                    <label for="application_status">Status <small style="color: red">*</small></label>
                                    <select class="form-control select2bs4" id="application_status" name="application_status" required>
                                        <option value="2" {{ $leaveApplication->application_status == 2 ? 'selected' : '' }}>2</option>
                                        <option value="1" {{ $leaveApplication->application_status == 1 ? 'selected' : '' }}>1</option>
                                        <option value="0" {{ $leaveApplication->application_status == 0 ? 'selected' : '' }}>0</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-12">
                              <!-- Approved User ID -->
                                <div class="form-group mb-4">
                                    <label for="application_approved_user_id">Approved User ID</label>
                                    <input type="text" class="form-control" id="application_approved_user_id" name="application_approved_user_id" value="{{ $leaveApplication->application_approved_user_id }}">
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-12">
                              <!-- Approved Date -->
                                <div class="form-group mb-4">
                                    <label for="application_approved_date">Approved Date</label>
                                    <input type="date" class="form-control" id="application_approved_date" name="application_approved_date" value="{{ $leaveApplication->application_approved_date }}">
                                </div>
                            </div>
                          </div>

                            <input type="hidden" value="{{$leaveApplication->id}}" name="id" id="leave_application_id">
                            <button type="submit" id="sub" class="btn btn-info float-right mr-4">Update</button>
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

@endsection

@push('masterScripts')
<script>
 
 $(document).ready(function() {
    // Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    });
});

// Update leave application form submission
document.getElementById('updateLeaveApplicationForm').addEventListener('submit', function(event) {
    event.preventDefault();

    var updateLeaveApplicationFormData = new FormData(this);
    var leave_application_id = document.getElementById('leave_application_id').value;

    // Validate required fields
    var user_id = document.getElementById('user_id').value;
    if (user_id == '') {
        Swal.fire({
            icon: "warning",
            title: "Please enter User ID",
        });
        return false;
    }

    var application_type = document.getElementById('application_type').value;
    if (application_type == '') {
        Swal.fire({
            icon: "warning",
            title: "Please enter Application Type",
        });
        return false;
    }

    var application_date = document.getElementById('application_date').value;
    if (application_date == '') {
        Swal.fire({
            icon: "warning",
            title: "Please enter Application Date",
        });
        return false;
    }

    var application_status = document.getElementById('application_status').value;
    if (application_status == '') {
        Swal.fire({
            icon: "warning",
            title: "Please select Status",
        });
        return false;
    }

    // Function to get CSRF token from meta tag
    function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }

    // Set up Axios defaults
    axios.defaults.withCredentials = true;
    axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

    axios.post('/api/update_leave_application/' + leave_application_id, updateLeaveApplicationFormData).then(response => {
        console.log(response);
        setTimeout(function() {
            window.location.reload();
        }, 2000);
        Swal.fire({
            icon: "success",
            title: response.data.message,
        });
        return false;
    }).catch(error => Swal.fire({
        icon: "error",
        title: error.response.data.message,
    }));
});
    
</script>
@endpush
