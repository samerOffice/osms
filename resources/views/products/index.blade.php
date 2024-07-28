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
                        <h5>Existing Product Add</h5>
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
                        <h5>New Product Add</h5>
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
                              <th>Sl.</th>
                              <th>Order ID</th>
                              <th>Order Type</th>
                              <th>Order Date</th>
                              <th>Deliver Date</th>
                              <th>Supplier</th>
                              <th>Ordered By</th>
                              <th>Status</th>
                              @if((auth()->user()->role_id == 1) || (auth()->user()->role_id == 2))
                              <th>Action</th>
                              @endif
                            </tr>
                            </thead>
                            <tbody>
                                @php $i = 1 @endphp
                                @foreach($requisition_orders as $requisition_order)
                            <tr>
                              <td>{{$i++}}</td>
                              <td>{{$requisition_order->requisition_order_id}}</td>
                              <td>
                                @if($requisition_order->requisition_type == 1)
                                New Stock
                                @else
                                Refill Stock
                                @endif
                              </td>                
                              <td>{{$requisition_order->requisition_order_date}}</td>                
                              <td>{{$requisition_order->requisition_deliver_date}}</td>                
                              <td>{{$requisition_order->supplier_name}}</td>                
                              <td>{{$requisition_order->order_by}}</td>             
                              <td>
                                @if($requisition_order->requisition_status == 1)
                                <h5><span class="badge badge-warning">Pending</span></h5>                        
                                @elseif($requisition_order->requisition_status == 2)
                                <h5><span class="badge badge-danger">Declined</span></h5>   
                                @else
                                <h5><span class="badge badge-success">Delivered</span></h5>
                                @endif
                              </td>             
                              @if( (auth()->user()->role_id == 1) || (auth()->user()->role_id == 2))

                              @if($requisition_order->requisition_status == 2)
                              <td>
                                <button type="button" disabled class="btn btn-secondary">Declined</button>
                              </td>
                              @elseif($requisition_order->requisition_status == 3)
                              <td>
                                <button type="button" disabled class="btn btn-success">Delivered</button>
                              </td>
                              @else
                              <td>
                                <a href="{{route('requisition_edit_data',$requisition_order->id)}}" style="color: white"><button class="btn btn-success"> <i class="fa-solid fa-pen-to-square"></i>Edit</button></a>
                                <a href="{{route('requisition_view',$requisition_order->id)}}" style="color: white"><button class="btn btn-primary">Approval</button></a>
                              </td>
                              @endif

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