@extends('master')

@section('title')
Supplier
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
                      <h3 class="card-title">Supplier List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>Serial No.</th>
                          <th>Supplier Name</th>
                          <th>Mobile Number</th>
                          <th>Official Address</th>
                          <th>Active Status</th>                         
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php $i = 1 @endphp
                            @foreach($suppliers as $supplier)
                        <tr>
                          <td>{{$i++}}</td>
                          <td>{{$supplier->full_name}}</td>
                          <td>{{$supplier->mobile_number}}</td>
                          <td>{{$supplier->official_address}}</td>
                          <td> 
                            @if(($supplier->active_status) == 1)
                            <span class="badge badge-success">Active</span>
                           @else
                           <span class="badge badge-danger">Inactive</span>
                           @endif
                         </td>
                         
                          <td>
                            <a href="" style="color: white"><button class="btn btn-outline-primary"><i class="fa-solid fa-pen-to-square"></i> Edit</button></a>
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