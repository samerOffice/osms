@extends('master')

@section('title')
Add Leave Application
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
                    <a class="btn btn-outline-info float-right" href="{{ route('home') }}">
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
                            <form id="addNewLeaveApplicationForm" method="POST" action="{{ route('leave-application.store') }}" enctype="multipart/form-data">
                                @csrf

                                <!-- User ID input -->
                                <div class="form-group mb-4">
                                    <label for="user_id">User ID <small style="color: red">*</small></label>
                                    <input type="text" placeholder="User ID" id="user_id" name="user_id" class="form-control form-control-lg" />
                                </div>

                                <!-- Application Type input -->
                                <div class="form-group mb-4">
                                    <label for="application_type">Application Type <small style="color: red">*</small></label>
                                    <input type="text" placeholder="Application Type" id="application_type" name="application_type" class="form-control form-control-lg" />
                                </div>

                                <!-- Application Date input -->
                                <div class="form-group mb-4">
                                    <label for="application_date">Application Date <small style="color: red">*</small></label>
                                    <input type="date" id="application_date" name="application_date" class="form-control form-control-lg" />
                                </div>

                                <!-- Status -->
                                <div class="form-group mb-4">
                                    <label for="application_status">Status <small style="color: red">*</small></label>
                                    <select required class="form-control select2bs4" id="application_status" name="application_status" style="width: 100%;">
                                        <option value="">Select Status</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                </div>

                                <!-- Approved User ID -->
                                <div class="form-group mb-4">
                                    <label for="application_approved_user_id">Approved User ID</label>
                                    <input type="text" placeholder="Approved User ID" id="application_approved_user_id" name="application_approved_user_id" class="form-control form-control-lg" />
                                </div>

                                <!-- Approved Date -->
                                <div class="form-group mb-4">
                                    <label for="application_approved_date">Approved Date</label>
                                    <input type="date" id="application_approved_date" name="application_approved_date" class="form-control form-control-lg" />
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
// Initialize Select2 Elements
$('.select2bs4').select2({
    theme: 'bootstrap4'
});

document.getElementById('addNewLeaveApplicationForm').addEventListener('submit', function(event) {
    event.preventDefault();

    var leaveFormData = new FormData(this);

    var user_id = document.getElementById('user_id').value;
    if (user_id == '') {
        Swal.fire({
            icon: "warning",
            title: "Please Enter User ID",
        });
        return false;
    }

    var application_type = document.getElementById('application_type').value;
    if (application_type == '') {
        Swal.fire({
            icon: "warning",
            title: "Please Enter Application Type",
        });
        return false;
    }

    var application_date = document.getElementById('application_date').value;
    if (application_date == '') {
        Swal.fire({
            icon: "warning",
            title: "Please Enter Application Date",
        });
        return false;
    }

    var application_status = document.getElementById('application_status').value;
    if (application_status == '') {
        Swal.fire({
            icon: "warning",
            title: "Please Select Status",
        });
        return false;
    }

    axios.post('{{ route('leave-application.store') }}', leaveFormData)
        .then(response => {
            console.log(response);
            window.location.reload();
            Swal.fire({
                icon: "success",
                title: response.data.message,
            });
        })
        .catch(error => {
            Swal.fire({
                icon: "error",
                title: error.response.data.message,
            });
        });
});
</script>
@endpush
