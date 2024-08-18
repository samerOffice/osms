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
                Daily Top Seller Report
                @elseif($report_type == 2)
                Monthly Top Seller Report
                @else
                Yearly Top Seller Report
                @endif
            </h1>
            <div class="report-info">
                <h6><strong>Report Date:</strong> {{ \Carbon\Carbon::now()->format('F j, Y') }}</h6>
            </div>             
            <table style="font-family: 'Courier New', Courier, monospace; font-size: 18px;">
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Employee Name</th>
                        <th>Total Selling Amount (BDT)</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                        $i = 1;
                        $totalAmount = 0;
                    @endphp
                    @foreach($top_sellers as $top_seller)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$top_seller->emp_name}}</td>
                        <td>{{$top_seller->total_paid_amount}}</td>
                    </tr>
                    @endforeach            
                </tbody>
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