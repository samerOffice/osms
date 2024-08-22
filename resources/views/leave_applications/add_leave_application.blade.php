@extends('master')

@section('title')
Leave Application | Form Submission
@endsection

@push('css')
<style>
#for_permission_review {
    display: none;
}

#for_warehouse {
    display: none;
}

#for_outlet {
    display: none;
}
</style>
@endpush

@section('content')
@if (Auth::check())
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <a class="btn btn-outline-info float-right" href="{{ route('apply_leave') }}">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
                <div class="col-12">
                    <br>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add Leave Application</h3>
                        </div>
                        <div class="card-body">
                            <form id="addNewLeaveApplicationForm">             
                                <!-- Application Type input -->
                                <div class="form-group mb-4">
                                    <label>Leave Type <small style="color: red">*</small></label>
                                    <select required class="form-control select2bs4" id="application_type" name="application_type" style="width: 100%;">                                  
                                        <option value="">--Select--</option>
                                        @foreach ($leave_types as $leave_type)
                                        <option value="{{$leave_type->id}}">{{$leave_type->type_name}}</option>
                                        @endforeach                                                             
                                    </select>
                                </div> 

                                <!-- Application Date input -->
                                <div class="form-group mb-4">
                                    <label for="application_date">Application Date <small style="color: red">*</small></label>
                                    <input type="date" readonly id="application_date" name="application_date" value="{{ date('Y-m-d') }}" class="form-control form-control-lg" />
                                </div>
                                
                                <div class="form-group">
                                    <label>Application Body</label>
                                    <textarea class="form-control" name="application_msg" id="application_msg"></textarea>
                                </div>

                                <!-- Submit button -->
                                <button type="submit" class="btn btn-success btn-lg float-right">Submit</button>
                                <br>
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

//initialize summernote
$('.summernote').summernote();

});


document.getElementById('addNewLeaveApplicationForm').addEventListener('submit', function(event) {
    event.preventDefault();

    var leaveFormData = new FormData(this);

    var application_type = document.getElementById('application_type').value;
    if (application_type == '') {
        Swal.fire({
            icon: "warning",
            title: "Please Enter Application Type",
        });
        return false;
    }

    var application_msg = document.getElementById('application_msg').value;
    if (application_msg == '') {
        Swal.fire({
            icon: "warning",
            title: "Please Enter Application Body",
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


        // axios.get('sanctum/csrf-cookie').then(response=>{
        axios.post('{{ route('leave-application.store') }}', leaveFormData).then(response=>{
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
        // });
});
</script>
@endpush
