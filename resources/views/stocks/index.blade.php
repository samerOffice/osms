@extends('master')

@section('title')
Stock List
@endsection


@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>
        <div class="row">   
            <div class="col-12">
                <br>
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Stock List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>Serial No.</th>
                          <th>Company Name</th>
                          <th>Warehouse Name</th>
                          <th>Product</th>
                          <th>Quantity</th>
                          <th>Purchase Date</th>
                          <th>Stored By</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php $i = 1 @endphp
                            @foreach($stocks as $stock)
                        <tr>
                          <td>{{$i++}}</td>
                          <td>{{$stock->company_name}}</td>
                          <td>{{$stock->warehouse_name}}</td>
                          <td>{{$stock->product_name}}</td>
                          <td>{{$stock->quantity}}</td>
                          <td>{{$stock->purchase_date}}</td>
                          <td>{{$stock->stored_by}}</td>                     
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