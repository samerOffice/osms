@extends('master')

@section('title')
Purchase Report
@endsection

@push('css')
<style>
    /* Optional: Hide the print button when printing */
    @media print {
        #print-button {
            display: none;
        }
    }
</style>
@endpush

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="custom-container">
            <br>

        <div id="print-section">

            <h1>
                @if($report_type == 1)
                Daily Purchase Report
                @elseif($report_type == 2)
                Monthly Purchase Report
                @else
                Yearly Purchase Report
                @endif
            </h1>
            <br>
            <div class="report-info">
                <h6><strong>Report Date:</strong> {{ \Carbon\Carbon::now()->format('F j, Y') }}</h6>
            </div>   
            
              <div class="table-responsive">
                <table style="font-family: 'Courier New', Courier, monospace; font-size: 18px;">
                    <thead>
                        <tr>
                            <th>Serial No.</th>
                            <th>Order Date</th>
                            <th>Receive Date</th>
                            <th>Supplier</th>
                            <th>Product Name</th>
                            <th>Product Weight</th>
                            <th>Purchase Quantity</th>
                            <th>Unit Price (BDT)</th>
                            <th>Total (BDT)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php 
                            $i = 1;
                            $totalPurchase = 0;
                        @endphp
                        @foreach($purchases_data as $purchase_data)
                        @php
                            $purchaseAmount = $purchase_data->product_subtotal;
                            $totalPurchase += $purchaseAmount;                        
                        @endphp
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$purchase_data->order_date}}</td>
                            <td>{{$purchase_data->purchase_receive_date}}</td>
                            <td>{{$purchase_data->supplier_name}}</td>
                            <td>{{$purchase_data->product_name}}</td>                      
                            <td>{{$purchase_data->product_weight}} {{$purchase_data->product_unit_type}}</td>                      
                            <td>{{$purchase_data->product_quantity}}</td>
                            <td>{{$purchase_data->product_unit_price}}</td>
                            <td >{{ number_format($purchaseAmount, 2) }}</td>
                        </tr>
                        @endforeach            
                    </tbody>
                    <tfoot>                       
                        <tr>
                            <td colspan="8" style="text-align:right">Total Purchase (BDT)</td>
                            <td >{{ number_format($totalPurchase, 2) }}</td>
                            <td></td>
                        </tr>

                        <tr>
                            <td colspan="8" style="text-align:right">Total Paid (BDT)</td>
                            <td >{{ number_format($total_paid, 2) }}</td>
                            <td></td>
                        </tr>

                        <tr>
                            <td colspan="8" style="text-align:right">Total Due (BDT)</td>
                            <td >{{ number_format($total_due, 2) }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
              </div>
                  
    </div>

        <!-- Print Button -->
    <button class="btn btn-danger float-right a4-print" id="print-button">Print Report</button>
<br>
       </div>                  
        <br>     
        </div>
         
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  </div>
@endsection


@push('masterScripts')
<script type="text/javascript">

$('#print-button').click(function(){
    // Trigger print for the specified section
    var printContents = $('#print-section').html();
    var originalContents = $('body').html();

    $('body').html(printContents);
    window.print();
    $('body').html(originalContents);
});

</script>
@endpush