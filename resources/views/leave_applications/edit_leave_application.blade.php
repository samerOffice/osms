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
                        <form id="updateLeaveApplicationForm">
                          <div class="row">
                            <div class="col-md-12 col-sm-12">
                              <!-- Application Type -->
                                <div class="form-group mb-4">
                                  <label>Leave Type <small style="color: red">*</small></label>
                                  <select required class="form-control select2bs4" id="application_type" name="application_type" style="width: 100%;">                                  
                                      <option value="{{$leaveApplication->application_type}}">{{$leaveApplication->leave_type}}</option>
                                      @foreach ($leave_types as $leave_type)
                                      <option value="{{$leave_type->id}}">{{$leave_type->type_name}}</option>
                                      @endforeach                                                             
                                  </select>
                              </div> 
                            </div>

                            <div class="col-md-12 col-sm-12">
                              <!-- Approved User ID -->
                          <div class="form-group mb-4">
                            <label>Application Body</label>
                            <textarea required class="form-control" name="application_msg" id="application_msg">{{$leaveApplication->application_msg}}</textarea>
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



    var application_type = document.getElementById('application_type').value;
    if (application_type == '') {
        Swal.fire({
            icon: "warning",
            title: "Please Select Application Type",
        });
        return false;
    }

    var application_msg = document.getElementById('application_msg').value;
    if (application_msg == '') {
        Swal.fire({
            icon: "warning",
            title: "Please Fillup Application Body",
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
            // window.location.reload();
            window.location.href = "{{ route('leave_applications') }}";
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
