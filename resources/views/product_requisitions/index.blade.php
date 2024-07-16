@extends('master')

@section('title')
Item Category List
@endsection



@push('css')
<style>
    .color-palette {
      height: 35px;
      line-height: 35px;
      text-align: right;
      padding-right: .75rem;
    }

    .color-palette.disabled {
      text-align: center;
      padding-right: 0;
      display: block;
    }

    .color-palette-set {
      margin-bottom: 15px;
    }

    .color-palette span {
      display: none;
      font-size: 12px;
    }

    .color-palette:hover span {
      display: block;
    }

    .color-palette.disabled span {
      display: block;
      text-align: left;
      padding-left: .75rem;
    }

    .color-palette-box h4 {
      position: absolute;
      left: 1.25rem;
      margin-top: .75rem;
      color: rgba(255, 255, 255, 0.8);
      font-size: 12px;
      display: block;
      z-index: 7;
    }
  </style>
@endpush


@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>
        <br>      
            <div class="row" style="width: 60%;margin: 0 auto;">
                <div class="col-6">
                    <!-- small box -->
                    <div class="small-box" style="background-color: #d5eaff">
                      <div class="inner">
                        <h3><i class="ion ion-ios-compose-outline"></i></h3>
                        <h5>Request New Product</h5>
                      </div>
                      <div class="icon">
                        <i class="ion ion-plus"></i>
                      </div>
                      <a href="{{route('new_stock')}}" class="small-box-footer" style="color: black">Click here</a>
                    </div>
                  </div>

                  <div class="col-6">
                    <!-- small box -->
                    <div class="small-box" style="background-color: #d4ff76">
                      <div class="inner">
                        <h3><i class="ion ion-bag"></i></h3>
                        <h5>Request Inventory Refill</h5>
                      </div>
                      <div class="icon">
                        <i class="ion ion-plus"></i>
                      </div>
                      <a href="#" class="small-box-footer" style="color: black">Click here</a>
                    </div>
                  </div>      
            </div>

    <br>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Requested Product List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                              <th>Serial No.</th>
                              <th>Product Category Name</th>
                              <th>Item Category Name</th>
                              <th>Status</th>
                              @if( (auth()->user()->role_id == 1) || (auth()->user()->role_id == 2))
                              <th>Action</th>
                              @endif
                            </tr>
                            </thead>
                            <tbody>
                                @php $i = 1 @endphp
                                @foreach($product_categories as $product_category)
                            <tr>
                              <td>{{$i++}}</td>
                              <td>{{$product_category->name}}</td>
                              <td>{{$product_category->item_category_name}}</td>
                              <td> 
                                @if(($product_category->active_status) == 1)
                                <span class="badge badge-success">Active</span>
                               @else
                               <span class="badge badge-danger">Inactive</span>
                               @endif
                             </td>
                              @if( (auth()->user()->role_id == 1) || (auth()->user()->role_id == 2))
                              <td>
                                <a href="{{route('edit_product_category',$product_category->id)}}" style="color: white"><button class="btn btn-success">Receive</button></a>
                                <a href="{{route('edit_product_category',$product_category->id)}}" style="color: white"><button class="btn btn-danger">Decline</button></a>
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