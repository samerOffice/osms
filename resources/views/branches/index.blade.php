@extends('master')

@section('title')
Branch List
@endsection


@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>
        <div class="row">

          @if( (auth()->user()->role_id == 1) || (auth()->user()->role_id == 2))
          <div class="col-12">
            <a class="btn btn-outline-info float-right" href="{{route('add_branch')}}">
                <i class="fas fa-plus"></i> Add Branch
            </a>
          </div>
          @endif
           
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
                      <h3 class="card-title">Branch List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>Serial No.</th>
                          <th>Shop Name</th>
                          <th>Branch Name</th>
                          <th>Branch Type</th>
                          <th>Branch Status</th>
                          @if( (auth()->user()->role_id == 1) || (auth()->user()->role_id == 2))
                          <th>Action</th>
                          @endif
                        </tr>
                        </thead>
                        <tbody>
                            @php $i = 1 @endphp
                            @foreach($branches as $branch)
                        <tr>
                          <td>{{$i++}}</td>
                          <td>{{$branch->company_name}}</td>
                          <td>{{$branch->br_name}}</td>
                          <td>
                            @if(($branch->br_type) == 1)
                              Head Office
                            @else
                              Single Branch
                            @endif
                          </td>
                          <td> 
                            @if(($branch->br_status) == 1)
                            <span class="badge badge-success">Active</span>
                           @else
                           <span class="badge badge-danger">Inactive</span>
                           @endif
                         </td>
                         @if( (auth()->user()->role_id == 1) || (auth()->user()->role_id == 2))
                          <td>
                            <a href="{{route('edit_branch', $branch->id)}}" style="color: white"><button class="btn btn-outline-primary"><i class="fa-solid fa-pen-to-square"></i> Edit</button></a>
                          </td>
                          @endif
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