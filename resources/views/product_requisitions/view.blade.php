@extends('master')

@section('title')
View Order
@endsection

@push('css')
<style type="text/css">
    @media print {
        #invoice_print {
            display: none;
        }
    }
</style>
@endpush
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <br>
        <div class="row">
            <div class="col-12">
                <a class="btn btn-outline-info float-right" href="{{route('requisition_list')}}">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>                       
        </div>
        <br>

        <div class="row">
            <div class="col-12">           
              <!-- Main content -->
              <div class="invoice p-3 mb-3" id="order_details">
                <!-- title row -->
                <div class="row">
                  <div class="col-12">
                    <h4>
                      <i class="fa-solid fa-receipt"></i> Product Order List
                      <small class="float-right"><b>Date:</b> <span style="color: green">{{ \Carbon\Carbon::now()->format('F j, Y') }}</span></small>
                    </h4>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-3 invoice-col">
                        <br>
                        <b>Company Name: <br></b>{{$requisition_order->company_name}}<br>
                        <b>Warehouse: <br></b>{{$requisition_order->warehouse_name}}<br>
                      </div>
                  <div class="col-sm-3 invoice-col">
                    <br>
                    From
                    <address>
                      <strong>{{$requisition_order->requisition_order_by_name}}</strong><br>               
                      {{$requisition_order->requisition_order_by_email}}<br>
                      {{$requisition_order->designation_name}}
                    </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 invoice-col">
                    <br>
                    To
                    <address>
                      <strong>{{$requisition_order->supplier_name}}</strong><br>
                      {{-- {{$requisition_order->supplier_official_address}}<br>--}}
                      {{$requisition_order->supplier_mobile_number}}                     
                    </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 invoice-col">
                    <br>
                    <b>Order ID: <br></b><span style="color: blue">{{$requisition_order->requisition_order_id}}</span><br>
                    <b>Order Date: <br></b>{{$requisition_order->requisition_order_date}}<br>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
        <br>
                <!-- Table row -->
                <div class="row">
                  <div class="col-12 table-responsive">
                    <table class="table table-striped">
                      <thead>
                      <tr>
                        <th>Serial No.</th>
                        <th>Product</th>
                        <th>Product Track Id</th>
                        <th>Description</th>
                        <th>Product Weight</th>
                        <th>Product Unit Type</th>
                        <th>Qty</th>
                        <th>Unit Price</th>                      
                        <th>Subtotal</th>
                      </tr>
                      </thead>
                      <tbody>
                        @php $i = 1 @endphp
                        @foreach($product_requisitions as $product_requisition)
                      <tr>
                        <td>{{$i++}}</td>
                        <td>{{$product_requisition->product_name}}</td>
                        <td>{{$product_requisition->product_track_id}}</td>
                        <td>{{$product_requisition->product_details}}</td>
                        <td>{{$product_requisition->product_weight}}</td>
                        <td>{{$product_requisition->product_unit_type}}</td>
                        <td>{{$product_requisition->product_quantity}}</td>
                        <td>{{$product_requisition->product_unit_price}}</td>
                        <td>{{$product_requisition->product_subtotal}} BDT</td>                       
                      </tr>
                      @endforeach                
                      </tbody>
                    </table>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
        
                <p align="right" class="lead" style="padding-right: 50px; color:green"><b>Total: {{$requisition_order->total_amount}} BDT</b></p>
        <br>
                <!-- this row will not appear when printing -->
                <div class="row">
                  <div class="col-12">                 
                        <a  id="invoice_print" target="_blank"  class="btn btn-default float-right" style="margin-right: 5px;">
                            <i class="fas fa-print"></i> Print
                          </a>               
                    <button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#modal-default" style="margin-right: 5px;">
                    Decline
                    </button>
                    <form action="{{route('requisition_order_receive')}}" method="post">
                    @csrf
                    <input type="hidden" name="approved_requisition_id" value="{{$id}}">
                    <button type="submit" class="btn btn-primary float-right" style="margin-right: 5px;">
                     Receive
                    </button>
                    </form>
                    
                  </div>
                </div>

         {{-- decline reason modal  start--}}
      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" align="center">Order Decline</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="post" action="{{route('requisition_order_decline')}}">
                @csrf
                <div class="modal-body">
                    <label for="decline reason">Reason</label><br>
                    <textarea name="requisition_decline_reason" class="form-control"></textarea>
                    <input type="hidden" name="declined_requisition_id" value="{{$id}}">
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
            </form>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
     {{-- decline reason modal  end--}}


              </div>
              <!-- /.invoice -->
            </div><!-- /.col -->
          </div><!-- /.row -->
    </div>
</div>
@endsection

@push('masterScripts')
<script>
  $(document).ready(function() {
            $('#invoice_print').on('click', function() {      
                var printContent = document.getElementById('order_details').innerHTML;
                printContentFunction(printContent);
            });
            function printContentFunction(content) {
                var originalContent = document.body.innerHTML;
                // Set body content to the content you want to print
                document.body.innerHTML = content;
                // Call window.print() to print the content
                 window.print();
                // Restore original content
                document.body.innerHTML = originalContent;
                setTimeout(function() {
                    if (!window.matchMedia('print').matches) {
                        // Redirect to a different page if print was canceled
                        window.location.href = '{{ route('requisition_view',$id) }}';
                    }
                }, 500);
            }  
        }); 
  </script>
  @endpush