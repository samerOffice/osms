@extends('master')

@section('title')
Asset List
@endsection


@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>
        <div class="row">

          <div class="col-12">
            <a class="btn btn-outline-info float-right" href="{{route('add_asset')}}">
                <i class="fas fa-plus"></i> Add Asset
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
                      <h3 class="card-title">Asset List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>Serial No.</th>
                          <th>Shop Name</th>
                          <th>Asset Name</th>
                          <th>Asset Type</th>
                          <th>Purchase Date</th>
                          <th>Purchase Cost</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php $i = 1 @endphp
                            @foreach($assets as $asset)
                        <tr>
                          <td>{{$i++}}</td>
                          <td>{{$asset->company_name}}</td>
                          <td>{{$asset->asset_name}}</td>
                          <td>{{$asset->asset_type}}</td>
                          <td>{{$asset->purchase_date}}</td>
                          <td>{{$asset->cost}}</td>
                          <td> 
                            @if(($asset->status) == 1)
                            <span class="badge badge-success">Active</span>
                            @elseif(($asset->status) == 2)
                            <span class="badge badge-warning">Inactive</span>
                            @elseif(($asset->status) == 3)
                            <span class="badge badge-primary">Maintainance</span>
                           @else
                           <span class="badge badge-danger">Damaged</span>
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