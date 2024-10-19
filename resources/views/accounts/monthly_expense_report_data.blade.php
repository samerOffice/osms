@extends('master')

@section('title')
Monthly Expense Report
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
            <h1>Monthly Expense Report</h1>
            <br>
            <div class="report-info">
                <h6><strong style="color: green">Report Date:</strong> {{ \Carbon\Carbon::now()->format('F j, Y') }}</h6>
                <h6><strong style="color: blue">Reporting Month:</strong> 
                    @if($month == 1)
                    January
                    @elseif($month == 2)
                    February
                    @elseif($month == 3)
                    March
                    @elseif($month == 4)
                    April
                    @elseif($month == 5)
                    May
                    @elseif($month == 6)
                    June
                    @elseif($month == 7)
                    July
                    @elseif($month == 8)
                    August
                    @elseif($month == 9)
                    September
                    @elseif($month == 10)
                    October
                    @elseif($month == 11)
                    November
                    @else
                    December
                    @endif
                </h6>
                <h6><strong style="color: blue">Reporting Year:</strong> {{$year}}</h6>
            </div>   
            
            <div class="table-responsive">
                <h3>Salaries</h3>
                <br>
                <table style="font-family: 'Courier New', Courier, monospace; font-size: 18px;">
                    <thead>
                        <tr>
                            <th>Serial No.</th>
                            <th>Employee Name</th>
                            <th>Designation</th>
                            <th>Branch</th>
                            <th >Amount (BDT)</th>
                            <th>Salary Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1 @endphp
                        @foreach($salaries as $salary)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$salary->employee_name}}</td>
                            <td>{{$salary->designation_name}}</td>
                            <td>{{$salary->employee_branch_name}}</td>
                            <td>{{ number_format($salary->final_pay_amount, 2) }}</td>
                            <td>{{$salary->last_salary_date}}</td>                            
                        </tr>
                        @endforeach            
                    </tbody>
                    <tfoot>                       
                        <tr>
                            <td colspan="4" style="text-align:right">Total Salaries (BDT)</td>
                            <td >{{ number_format($total_salary, 2) }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
                <br>

            <div class="table-responsive">
                <h3>Rents</h3>
                <br>
                <table style="font-family: 'Courier New', Courier, monospace; font-size: 18px;">
                    <thead>
                        <tr>
                            <th>Serial No.</th>
                            <th>Rent Pay Date</th>
                            <th colspan="2">Amount (BDT)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1 @endphp
                        @foreach($rents as $rent)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$rent->rent_pay_date}}</td>
                            <td colspan="2">{{ number_format($rent->rent_amount, 2) }}</td>
                        </tr>
                        @endforeach            
                    </tbody>
                    <tfoot>                       
                        <tr>
                            <td colspan="2" style="text-align:right">Total Rents (BDT)</td>
                            <td >{{ number_format($total_rent, 2) }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
                <br>
            <div class="table-responsive">
                <h3>Utilities</h3>
                <br>
                <table style="font-family: 'Courier New', Courier, monospace; font-size: 18px;">
                    <thead>
                        <tr>
                            <th>Serial No.</th>
                            <th>Utility Type</th>
                            <th>Utility Pay Date</th>
                            <th colspan="3">Amount (BDT)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1 @endphp
                        @foreach($utilities as $utility)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$utility->utility_type}}</td>
                            <td>{{$utility->utility_pay_date}}</td>
                            <td colspan="3">{{ number_format($utility->utility_amount, 2) }}</td>
                        </tr>
                        @endforeach            
                    </tbody>
                    <tfoot>                       
                        <tr>
                            <td colspan="4" style="text-align:right">Total Utilities (BDT)</td>
                            <td >{{ number_format($total_utility, 2) }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
                <br>

            <div class="table-responsive">
                <h3>Others</h3>
                <br>
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