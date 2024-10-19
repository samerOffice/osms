@extends('master')

@section('title')
Daily Expense Report
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
            <h1>Daily Expense Report</h1>
            <br>
            <div class="report-info">
                <h6><strong style="color: green">Report Date:</strong> {{ \Carbon\Carbon::now()->format('F j, Y') }}</h6>
                <h6><strong>From Date:</strong> {{ $from_date }}</h6>
                <h6><strong>To Date:</strong> {{ $to_date }}</h6>
            </div>   
            
            <div class="table-responsive">
                <table style="font-family: 'Courier New', Courier, monospace; font-size: 18px;">
                    <thead>
                        <tr>
                            <th>Serial No.</th>
                            <th>Expense Name</th>
                            <th>Expense Amount (BDT)</th>
                            <th>Expense Pay Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1 @endphp
                        @foreach($expenses_data as $expense_data)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$expense_data->expense_name}}</td>
                            <td>{{ number_format($expense_data->expense_amount, 2) }}</td>
                            <td>{{$expense_data->expense_pay_date}}</td>
                        </tr>
                        @endforeach            
                    </tbody>
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