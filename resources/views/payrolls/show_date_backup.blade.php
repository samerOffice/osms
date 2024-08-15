@extends('master')

@section('title')
Payroll
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
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>

        <div class="invoice p-3 mt-3" id="payroll_details">         
            <div class="row">          
                <div class="col-12">
                    <br>
                    <div class="card">

                        <div class="card-header">
                          <h3 class="card-title">{{$member_name}}</h3><br>
                          <h3 class="card-title">{{$member_designation_name}}</h3>
                        </div>

                        <div class="card-body">
                            <table id="" class="table table-bordered table-striped">
                                <thead>
                                    @foreach($filteredData as $key => $value)
                                    @if( ($key !== '_token')
                                    && 
                                    ($key !== 'id')
                                    && 
                                    ($key !== 'employee')
                                    && 
                                    ($key !== 'company')
                                    && 
                                    ($key !== 'member_joining_date')
                                    && 
                                    ($key !== 'member_id')
                                    && 
                                    ($key !== 'created_at')
                                    && 
                                    ($key !== 'updated_at')
                                    )
                                    <tr>
                                        <th>
                                            @if($key === 'member_name')
                                            Name
                                            @elseif($key === 'member_designation_name')
                                            Designation
                                            @elseif($key === 'member_br_name')
                                            Branch
                                            @elseif($key === 'joining_date')
                                            Joining Date
                                            @elseif($key === 'salary_date')
                                            Salary Date
                                            @elseif($key === 'total_working_day')
                                            Total Working Days (Days)
                                            @elseif($key === 'total_leave')
                                            Total Leave Days (Days)
                                            @elseif($key === 'total_number_of_pay_day')
                                            Total Number of Payable Days (Days)
                                            @elseif($key === 'per_day_salary')
                                            Per Day Salary (BDT)
                                            @elseif($key === 'monthly_salary')
                                            Monthly Salary (BDT)
                                            @elseif($key === 'monthly_holiday_bonus')
                                            Monthly Holiday Bonus (BDT)
                                            @elseif($key === 'total_daily_allowance')
                                            Total Daily Allowance (BDT)
                                            @elseif($key === 'total_travel_allowance')
                                            Total Travel Allowance (BDT)
                                            @elseif($key === 'rental_cost_allowance')
                                            Rental Cost Allowance (BDT)
                                            @elseif($key === 'hospital_bill_allowance')
                                            Hospital Bill Allowance (BDT)
                                            @elseif($key === 'insurance_allowance')
                                            Insurance Allowance (BDT)
                                            @elseif($key === 'sales_commission')
                                            Sales Commission (BDT)
                                            @elseif($key === 'retail_commission')
                                            Retail Commission (BDT)
                                            @elseif($key === 'total_others')
                                            Total Others (BDT)
                                            @elseif($key === 'total_salary')
                                            Total Salary (BDT)
                                            @elseif($key === 'yearly_bonus')
                                            Yearly Bonus (BDT)
                                            @elseif($key === 'total_payable_salary')
                                            Total Payable Salary (BDT)
                                            @elseif($key === 'advance_less')
                                            Advance Less (BDT)
                                            @elseif($key === 'any_deduction')
                                            Any Deduction (BDT)
                                            @elseif($key === 'final_pay_amount')
                                            <span style="color: green">Final Amount (BDT)</span>
                                            @elseif($key === 'loan_advance')
                                            Loan Advance (BDT)
                                            @else
                                            {{$key}}
                                            @endif
                                        </th>
                                        <td>{{ $value }}</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </thead>                          
                              </table>
                        </div>
                      </div>
                </div>            
            </div>  
                
            <div class="row no-print">
                <div class="col-12">
                  <a  id="invoice_print" target="_blank"  class="btn btn-danger float-right" style="margin-right: 5px;">
                    <i class="fas fa-print"></i> Print
                  </a>
                  <form method="post" action="{{route('generate-csv')}}">
                    @csrf
                    <input type="hidden" name="payroll" value="{{$payroll_id}}" id="payroll_id">
                  <button type="submit" class="btn btn-success"><i class="fas fa-download"></i> Download CSV</button>
                </form>
                </div>
            </div>
        </div>
        
        <br>       
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection

@push('masterScripts')
<script>
$(document).ready(function() {
            $('#invoice_print').on('click', function() {      
                var printContent = document.getElementById('payroll_details').innerHTML;
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
                        var payroll_id = $('#payroll_id').val();
                        window.location.href = "{{ route('payroll_show_data', ':id') }}".replace(':id', payroll_id);
                    }
                }, 100);

            }
   
        });
  
           
  
  </script>
  @endpush