@extends('master')

@section('title')
Sales Report
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
                Daily Sales Report
                @elseif($report_type == 2)
                Monthly Sales Report
                @else
                Yearly Sales Report
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
                            <th>Selling Date</th>
                            <th>Selling Time</th>
                            <th>Product Name</th>
                            <th>Quantity Sold</th>
                            <th>Purchase Price (BDT)</th>
                            <th>Selling Price (BDT)</th>
                            <th>Total Purchase (BDT)</th>
                            <th>Total Sales (BDT)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php 
                            $i = 1;
                            $totalPurchase = 0;
                            $totalSales = 0;
                            // $totalDue = 0;
                        @endphp
                        @foreach($sales_data as $sale_data)
                        @php
                            $purchaseAmount = $sale_data->sold_stock_quantity * $sale_data->purchase_price;
                            $salesAmount = $sale_data->sold_stock_quantity * $sale_data->selling_price;
                            $totalPurchase += $purchaseAmount;
                            $totalSales += $salesAmount;
                            // $totalDue += $sale_data->total_due;
                        @endphp
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$sale_data->selling_date}}</td>
                            <td>{{$sale_data->selling_time}}</td>
                            <td>{{$sale_data->product_name}}</td>                         
                            <td>{{$sale_data->sold_stock_quantity}}</td>
                            <td>{{$sale_data->purchase_price}}</td>
                            <td>{{$sale_data->selling_price}}</td>
                            <td>{{ number_format($purchaseAmount, 2) }}</td>
                            <td>{{ number_format($salesAmount, 2) }}</td>
                        </tr>
                        @endforeach            
                    </tbody>
                    <tfoot>
                        @php
                            $totalProfit = $totalSales - $totalPurchase;
                            $netProfit = $totalProfit - $total_due;
                        @endphp
                        <tr>
                            <td colspan="7" style="text-align:right">Total Purchase (BDT)</td>
                            <td>{{ number_format($totalPurchase, 2) }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="7" style="text-align:right">Total Sales (BDT)</td>
                            <td></td>
                            <td>{{ number_format($totalSales, 2) }}</td>
                        </tr>
                        <tr>
                            <td colspan="7" style="text-align:right">Total Profit (BDT)</td>
                            <td >{{ number_format($totalProfit, 2) }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="7" style="text-align:right">Total Due (BDT)</td>
                            <td>{{ number_format($total_due, 2) }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="7" style="text-align:right">Net Profit (BDT)</td>
                            <td>{{ number_format($netProfit, 2) }}</td>
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