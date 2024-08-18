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
                Daily Damaged Product Report
                @elseif($report_type == 2)
                Monthly Damaged Product Report
                @else
                Yearly Damaged Product Report
                @endif
            </h1>
            <div class="report-info">
                <h6><strong>Report Date:</strong> {{ \Carbon\Carbon::now()->format('F j, Y') }}</h6>
            </div>             
            <table style="font-family: 'Courier New', Courier, monospace; font-size: 18px;">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Damage Entry Date</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Product Unit Price (BDT)</th>
                        <th colspan="2">Total Amount (BDT)</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                        $i = 1;
                        $totalAmount = 0;
                    @endphp
                    @foreach($damages_data as $damage_data)
                    @php                    
                    $totalAmount += $damage_data->damage_amount;
                    @endphp
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$damage_data->entry_date}}</td>
                        <td>{{$damage_data->product_name}}</td>                         
                        <td>{{$damage_data->quantity}}</td>
                        <td>{{$damage_data->unit_price}}</td>
                        <td colspan="2">{{ number_format($damage_data->damage_amount, 2) }}</td>
                    </tr>
                    @endforeach            
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" style="text-align:right; color:green">Sum of Total (BDT)</td>
                        <td colspan="2" style="color: green">{{ number_format($totalAmount, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
                       
    </div>

        <!-- Print Button -->
    <button class="btn btn-danger float-right" id="print-button">Print Report</button>
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