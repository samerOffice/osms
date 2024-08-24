@extends('master')

@section('title')
Review Leave Application
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
                <a class="btn btn-outline-info float-right" href="{{route('leave_application_approval_list')}}">
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
                            <div class="col-md-6 col-sm-6">
                              <!-- Application Type -->
                                <div class="form-group mb-4">
                                  <label>Leave Type </label><br>
                                  <span>{{$leaveApplication->leave_type_name}}</span>
                              </div> 
                            </div>

                            <div class="col-md-6 col-sm-6">
                                <!-- Application Date -->
                                <div class="form-group mb-4">
                                  <label>Application Date </label><br>
                                  <span>{{ \Carbon\Carbon::parse($leaveApplication->application_date)->format('j F, Y') }}</span>
                              </div> 
                            </div>

                            <div class="col-md-6 col-sm-6">
                              <!-- Application From -->
                              <div class="form-group mb-4">
                                <label>Application From </label><br>
                                <span>{{ \Carbon\Carbon::parse($leaveApplication->application_from)->format('j F, Y') }}</span>
                              </div> 
                            </div>

                            <div class="col-md-6 col-sm-6">
                              <!-- Application To -->
                              <div class="form-group mb-4">
                                <label>Application To </label><br>
                                <span>{{ \Carbon\Carbon::parse($leaveApplication->application_to)->format('j F, Y') }}</span>
                              </div> 
                            </div>

                            <div class="col-md-6 col-sm-6">
                              <!-- Duration-->
                              <div class="form-group mb-4">
                                <label for="duration">Duration (days)</label><br>
                                <span id="duration">{{$leaveApplication->duration}}</span>
                            </div> 
                            </div>

                            <div class="col-md-12 col-sm-12">
                              @if($leaveApplication->application_type == 1)
                                <label style="display: flex; margin-top: 20px"><strong>Application File @if(!empty($leaveApplication->application_file)) (<a href="{{ asset('/uploads/'.$leaveApplication->application_file) }}" download >Download Leave Application</a>) @endif</strong></label>
                              @else
                                <!-- Application Body -->
                                <div class="form-group mb-4">
                                <label>Application Body</label>
                                <textarea readonly id="application_msg" class="form-control">{{$leaveApplication->application_msg}}</textarea>
                                </div>
                             @endif
                            </div>
                          </div>
                                                   
                          <form action="{{route('decline_leave')}}" method="POST">
                            @csrf
                            <input type="hidden" value="{{$leaveApplication->id}}" name="leave_application_id" id="leave_application_id">
                            <button type="submit" class="btn btn-danger float-right" style="margin-right: 5px;">
                             Decline
                            </button>
                          </form>

                          <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#modal-default" style="margin-right: 5px;">
                            Approve
                        </button>

                         {{-- Approve modal  start--}}
                            <div class="modal fade" id="modal-default">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" align="center">Approved Duration (Days)</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <form action="{{route('approve_leave')}}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <label for="decline reason">Enter the approved leave days. <small style="color: red">*</small></label><br>
                                            <input type="number" required  class="form-control" onkeyup="approvedDuration()" id="approved_duration" name="approved_duration" id="approved_duration">
                                            <input type="hidden" value="{{$leaveApplication->id}}" name="leave_application_id" id="leave_application_id">
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                    
                                </div>
                                <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        {{-- Approve modal  end--}}
                          
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

function adjustTextareaHeight() {
        const textarea = document.getElementById('application_msg');
        textarea.style.height = 'auto'; // Reset height to auto
        textarea.style.height = `${textarea.scrollHeight}px`; // Set height to match scrollHeight
    }

    // Call the function after the content is loaded
    window.addEventListener('load', adjustTextareaHeight);
    
    // Optional: Call the function if content can be changed dynamically
    // Uncomment this if content might change dynamically
    // const observer = new MutationObserver(adjustTextareaHeight);
    // observer.observe(document.getElementById('applicationMsg'), { childList: true, subtree: true });

    


    function approvedDuration(){
    var applied_duration = $('#duration').html();
    var approved_duration = $('#approved_duration').val();

    if(approved_duration > applied_duration){
        Swal.fire({
                    icon: "warning",
                    title: 'Approved days can not be more than applied days.',
                    });
                    return false;
    }

    }










// Update leave application form submission
document.getElementById('updateLeaveApplicationForm').addEventListener('submit', function(event) {
    event.preventDefault();

    var updateLeaveApplicationFormData = new FormData(this);
    var leave_application_id = document.getElementById('leave_application_id').value;



    

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
