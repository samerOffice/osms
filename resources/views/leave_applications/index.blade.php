@extends('master')

@section('title')
Leave Applications List
@endsection

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="col-12">
                    <a class="btn btn-outline-info float-right" href="{{route('apply_leave')}}">
                        <i class="fas fa-plus"></i> Add Leave Application
                    </a>
                </div>

             
                <div class="col-12">
                    <br>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Leave Applications List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="leaveApplicationsTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Serial No.</th>
                                        <th>Applicant Name</th>
                                        <th>Leave Type</th>
                                        <th>Application Date</th>
                                        <th>Status</th>
                                        <th>Approved Date</th>
                                        <th>Declined Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1 @endphp
                                    @foreach($leaveApplications as $application)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $application->name }}</td>
                                        <td>{{ $application->leave_type }}</td>
                                        <td>{{ $application->application_date }}</td>
                                        <td>
                                            @if($application->application_status == 1)
                                            <span class="badge badge-warning">Pending</span>
                                            @elseif($application->application_status == 2)
                                            <span class="badge badge-success">Approved</span>
                                            @else
                                            <span class="badge badge-success">Declined</span>
                                            @endif
                                        </td>
                                        <td>{{ $application->application_approved_date }}</td>
                                        <td>{{ $application->application_decline_date }}</td>
                                        <td>
                                            @if($application->application_way == 1)           
                                            <a href="#" style="color: white">
                                                <button disabled class="btn btn-outline-secondary">Nope</button>
                                            </a>
                                            @else
                                            @if($application->application_status == 1)
                                            <a href="{{ route('edit_leave_application', $application->id) }}" style="color: white">
                                                <button class="btn btn-outline-primary">
                                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                                </button>
                                            </a>
                                            @else
                                            <a href="#" style="color: white">
                                                <button disabled class="btn btn-outline-secondary">Submitted</button>
                                            </a>
                                            @endif
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                
                            </table>
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
<script>
$(document).ready(function() {
    $('#leaveApplicationsTable').DataTable({
        responsive: true, // Enable responsive behavior
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                exportOptions: {
                    columns: ':not(:last-child)' // Exclude the last column (Labeling) from printing
                }
            },
            {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: ':not(:last-child)' // Exclude the last column (Labeling) from CSV
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':not(:last-child)' // Exclude the last column (Labeling) from Excel
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: ':not(:last-child)' // Exclude the last column (Labeling) from PDF
                }
            }
        ]
    });
});
</script>
@endpush
