@extends('master')

@section('title')
Employee List
@endsection


@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>
        <div class="row">
            <div class="col-12">
                <a class="btn btn-outline-info float-right" href="{{route('add_new_employee')}}">
                    <i class="fas fa-plus"></i> Add Employee
                </a>            
            </div>

            <div class="col-12">
                <br>
                @if ($message = Session::get('success'))
                <div class="alert alert-info" role="alert">
                  <div class="row">
                    <div class="col-11">
                      {{ $message }}
                    </div>
                    <div class="col-1">
                      <button type="button" class=" btn btn-info" data-dismiss="alert" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                    </div>
                  </div>
                </div>
                @endif
            </div>

        
            <div class="col-12">
                <br>
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Employee List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>Serial No.</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Designation</th>
                          <th>Branch</th>
                          <th>Joining Date</th>
                          <th>Monthly Salary (BDT)</th>
                          <th>Action</th>                          
                        </tr>
                        </thead>
                        <tbody>
                            @php $i = 1 @endphp
                            @foreach($employees as $employee)
                        <tr>
                          <td>{{$i++}}</td>
                          <td>{{$employee->emp_name}}</td>
                          <td>{{$employee->emp_email}}</td>
                          <td>{{$employee->emp_designation_name}}</td>
                          <td>{{$employee->emp_br_name}}</td>
                          <td>{{$employee->emp_joining_date}}</td>
                          <td>{{$employee->monthly_salary}}</td>
                         <td>
                          <a href="{{route('view_employee_details',$employee->id)}}" style="color: white"><button class="btn btn-outline-info"><i class="fa-solid fa-eye"></i> View</button></a>
                          <a href="{{route('edit_employee_official_info',$employee->id)}}" style="color: white"><button class="btn btn-outline-success"><i class="fa-solid fa-pen-to-square"></i> Edit</button></a>
                        </td>
                        </tr> 
                        @endforeach              
                 
                        </tfoot>
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
    $('#example1').DataTable({
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