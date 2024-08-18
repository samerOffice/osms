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

        <div id="payroll_details"> 
        <div class="payroll-slip">

          <div class="header">
            <h3 align="center">Payroll Slip</h3>       
        </div>
          
          <div class="row">
            <div class="col-8">
              <h4>{{$shop_name}}</h4>
            </div>
            <div class="col-4">
              <h6><span style="color: blue">Salary Date: </span>{{ \Carbon\Carbon::parse($member_payroll_info->salary_date)->format('j F, Y') }}</h6>
            </div>
          </div>
          <br>
          <div class="payroll_details" style="font-size: 16px">
              <div><span>Employee Name: </span>{{$employee_name}}</div>
              <div><span>Designation: </span>{{$designation_name}}</div>
              @if($branch && $branch->br_name != '')
              <div><span>Branch: </span>{{$branch->br_name}}</div>
              @endif
              @if($warehouse && $warehouse->warehouse_name != '')
              <div><span>Warehouse: </span>{{$warehouse->warehouse_name}}</div>
              @endif
              @if($outlet && $outlet->outlet_name != '')
            <div><span>Outlet: </span>{{$outlet->outlet_name}}</div>
              @endif
          </div>
          
             <div class="table-container">
              <table style="font-size: 16px">
                <tbody>
                    <tr>
                      <td>Total Working Days (Days)</td>
                      <td>{{$member_payroll_info->total_working_day}}</td>
                    </tr>

                  <tr>
                    <td>Total Leave Days (Days)</td>
                    <td>{{$member_payroll_info->total_leave}}</td>
                  </tr>

                  <tr>
                    <td>Total Number of Payable Days (Days)</td>
                    <td>{{$member_payroll_info->total_number_of_pay_day}}</td>
                  </tr>

                  <tr>
                    <td>Per Day Salary (BDT)</td>
                    <td>{{$member_payroll_info->per_day_salary}}</td>
                  </tr>

                  <tr>
                    <td>Monthly Salary (BDT)</td>
                    <td>{{$member_payroll_info->monthly_salary}}</td>
                  </tr>

                  {{-- <tr>
                    <td>Monthly Holiday Bonus (BDT)</td>
                    <td>{{$member_payroll_info->monthly_holiday_bonus}}</td>
                  </tr> --}}

                  @if(($member_payroll_info->total_daily_allowance != 0))
                  <tr>
                    <td>Total Daily Allowance (BDT)</td>
                    <td>{{$member_payroll_info->total_daily_allowance}}</td>
                  </tr>
                  @endif

                  @if(($member_payroll_info->total_travel_allowance != 0))
                  <tr>
                    <td>Total Travel Allowance (BDT)</td>
                    <td>{{$member_payroll_info->total_travel_allowance}}</td>
                  </tr>
                  @endif

                  @if(($member_payroll_info->rental_cost_allowance != 0))
                  <tr>
                    <td>Rental Cost Allowance (BDT)</td>
                    <td>{{$member_payroll_info->rental_cost_allowance}}</td>
                  </tr>
                  @endif

                  @if(($member_payroll_info->hospital_bill_allowance != 0))
                  <tr>
                    <td>Hospital Bill Allowance (BDT)</td>
                    <td>{{$member_payroll_info->hospital_bill_allowance}}</td>
                  </tr>
                  @endif

                  @if(($member_payroll_info->insurance_allowance != 0))
                  <tr>
                    <td>Insurance Allowance (BDT)</td>
                    <td>{{$member_payroll_info->insurance_allowance}}</td>
                  </tr>
                  @endif

                  @if(($member_payroll_info->sales_commission != 0))
                  <tr>
                    <td>Sales Commission (BDT)</td>
                    <td>{{$member_payroll_info->sales_commission}}</td>
                  </tr>
                  @endif

                  @if(($member_payroll_info->retail_commission != 0))
                  <tr>
                    <td>Retail Commission (BDT)</td>
                    <td>{{$member_payroll_info->retail_commission}}</td>
                  </tr>
                  @endif

                  @if(($member_payroll_info->total_others != 0))
                  <tr>
                    <td>Total Others (BDT)</td>
                    <td>{{$member_payroll_info->total_others}}</td>
                  </tr>
                  @endif

                  <tr>
                    <td>Total Salary (BDT)</td>
                    <td>{{$member_payroll_info->total_salary}}</td>
                  </tr>

                  @if(($member_payroll_info->yearly_bonus != 0))
                  <tr>
                    <td>Yearly Bonus (BDT)</td>
                    <td>{{$member_payroll_info->yearly_bonus}}</td>
                  </tr>
                  @endif

                  @if(($member_payroll_info->total_payable_salary != 0))
                  <tr>
                    <td>Total Payable Salary (BDT)</td>
                    <td>{{$member_payroll_info->total_payable_salary}}</td>
                  </tr>
                  @endif

                  @if(($member_payroll_info->advance_less != 0))
                  <tr>
                    <td>Advance Less (BDT)</td>
                    <td>{{$member_payroll_info->advance_less}}</td>
                  </tr>
                  @endif

                  @if(($member_payroll_info->any_deduction != 0))
                  <tr>
                    <td>Any Deduction (BDT)</td>
                    <td>{{$member_payroll_info->any_deduction}}</td>
                  </tr>
                  @endif

                  <tr>
                    <td style="color: green"><strong>Final Amount (BDT)</strong></td>
                    <td>{{$member_payroll_info->final_pay_amount}}</td>
                  </tr>

                  @if(($member_payroll_info->loan_advance != 0))
                  <tr>
                    <td>Loan Advance (BDT)</td>
                    <td>{{$member_payroll_info->loan_advance}}</td>
                  </tr>   
                  @endif         
                    
                </tbody>
            </table>
             </div>
             
        
          <div class="payroll_footer">
              <p>This is a system-generated payroll slip and does not require a signature.</p>
          </div>

          <div class="row no-print">
            <div class="col-12">
              <a  id="invoice_print" target="_blank"  class="btn btn-danger float-right" style="margin-right: 5px;">
                <span style="color: white"><i class="fas fa-print"></i> Print</span>
              </a>
              <form method="post" action="{{route('generate-csv')}}">
                @csrf
                <input type="hidden" name="payroll" value="{{$payroll_id}}" id="payroll_id">
              <button type="submit" class="btn btn-success"><i class="fas fa-download"></i> Download CSV</button>
            </form>
            </div>
        </div>

      </div>

      
      </div><!-- payroll div end -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
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