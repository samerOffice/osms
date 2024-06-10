@extends('master')

@section('title')
Welcome
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
            <a class="btn btn-outline-info float-right" href="{{route('add_warehouse')}}">
                <i class="fas fa-plus"></i> Add Warehouse
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
                      <h3 class="card-title">Warehouse List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>Serial No.</th>
                          <th>Company Name</th>
                          <th>Branch Name</th>
                          <th>Warehouse Name</th>
                          <th>Warehouse Status</th>
                          @if( (auth()->user()->role_id == 1) || (auth()->user()->role_id == 2))
                          <th>Action</th>
                          @endif
                        </tr>
                        </thead>
                        <tbody>
                            @php $i = 1 @endphp
                            @foreach($warehouses as $warehouse)
                        <tr>
                          <td>{{$i++}}</td>
                          <td>{{$warehouse->company_name}}</td>
                          <td>{{$warehouse->branch_name}}</td>
                          <td>{{$warehouse->warehouse_name}}</td>
                          <td> 
                            @if(($warehouse->warehouse_status) == 1)
                            <span class="badge badge-success">Open</span>
                           @else
                           <span class="badge badge-danger">Closed</span>
                           @endif
                         </td>
                         @if( (auth()->user()->role_id == 1) || (auth()->user()->role_id == 2))
                          <td>
                            <a href="{{route('edit_warehouse',$warehouse->id)}}" style="color: white"><button class="btn btn-outline-primary"><i class="fa-solid fa-pen-to-square"></i> Edit</button></a>
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
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });

  
    
  </script>
  @endpush