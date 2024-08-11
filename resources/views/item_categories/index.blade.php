@extends('master')

@section('title')
Item Category List
@endsection


@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>
        <div class="row">

         
          <div class="col-12">
            <a class="btn btn-outline-info float-right" href="{{route('add_item_category')}}">
                <i class="fas fa-plus"></i> Add Item Category
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
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Item Category List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>Serial No.</th>
                          <th>Item Category Name</th>
                          <th>Status</th>
                          @if( (auth()->user()->role_id == 1) || (auth()->user()->role_id == 2))
                          <th>Action</th>
                          @endif
                        </tr>
                        </thead>
                        <tbody>
                            @php $i = 1 @endphp
                            @foreach($item_categories as $item_category)
                        <tr>
                          <td>{{$i++}}</td>
                          <td>{{$item_category->name}}</td>
                          <td> 
                            @if(($item_category->active_status) == 1)
                            <span class="badge badge-success">Active</span>
                           @else
                           <span class="badge badge-danger">Inactive</span>
                           @endif
                         </td>
                          @if( (auth()->user()->role_id == 1) || (auth()->user()->role_id == 2))
                          <td>
                            <a href="{{route('edit_item_category',$item_category->id)}}" style="color: white"><button class="btn btn-outline-primary"><i class="fa-solid fa-pen-to-square"></i> Edit</button></a>
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