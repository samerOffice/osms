@extends('master')

@section('title')
Supplier Due List
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
            <a class="btn btn-outline-info float-right" href="{{route('add_supplier')}}">
                <i class="fas fa-plus"></i> Add Supplier
            </a>
          </div>
          @endif
           
          <div class="col-12">
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
                      <h3 class="card-title">Supplier Due List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>Serial No.</th>
                          <th>Supplier Name</th>
                          <th>Mobile Number</th> 
                          <th>Total Due (BDT)</th>                
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php $i = 1 @endphp
                            @foreach($due_list as $due)
                        <tr>
                          <td>{{$i++}}</td>
                          <td>{{$due->supplier_name}}</td>
                          <td>{{$due->supplier_mobile_number}}</td>
                          <td>{{$due->total_due}}</td>                                     
                        
                          <td>
                            @if(!empty($due->supplier_mobile_number))
                            <a href="{{route('supplier_due_details',$due->supplier_mobile_number)}}" style="color: white"><button class="btn btn-outline-primary"><i class="fa-solid fa-pen-to-square"></i> Details</button></a>
                            @else
                                <span>No Details Available</span>
                            @endif
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