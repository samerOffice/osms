@extends('master')

@section('title')
Profiit & Loss Report
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
      <div class="container-fluid" style="max-width: 800px">
        <div class="custom-container">
            <br>
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <div class="form-group mb-4">
                    <label for="monthPicker">Select Month:</label>
                    <select class="form-control select2bs4" id="monthPicker" required>
                        <option value="">--Select--</option>
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                  </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <label for="yearPicker">Select Year:</label>
                    <select class="form-control select2bs4" id="yearPicker" required>
                        {{-- <option value="">--Select--</option> --}}
                      <!-- JavaScript will populate this with years -->
                    </select>
                  </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-3">
                <button type="button" class="btn btn-primary" id="search">Search</button>
            <button type="button" class="btn btn-success" id="refresh">Refresh</button>
            </div>     
        </div>

       <br>
        <div id="print-section">

        <h1>Profit and Loss Report</h1>
        
        <h4>Revenue</h4>
        <table style="font-family: 'Courier New', Courier, monospace; font-size: 20px;">
            <thead>
                <tr>
                    <th>Description</th>
                    <th class="text-right">Amount (BDT)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Sales</td>
                    <td class="text-right" id="total_sale">0.00</td>
                </tr>
               
                {{-- <tr>
                    <td>Total Due (from Customers)</td>
                    <td class="text-right" id="total_due">0.00</td>
                </tr> --}}
                
                <tr class="total-row">
                    <td>Total Revenue</td>
                    <td class="text-right" id="total_revenue">0.00</td>
                </tr>
            </tbody>
        </table>

        <h4>Cost of Goods Sold (COGS)</h4>
        <table style="font-family: 'Courier New', Courier, monospace; font-size: 20px; ">
            <thead>
                <tr>
                    <th>Description</th>
                    <th class="text-right">Amount (BDT)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Purchases</td>
                    <td class="text-right" id="total_purchase">0.00</td>
                </tr>
                <!-- <tr>
                    <td>Direct Labor</td>
                    <td class="text-right">$2,000</td>
                </tr> -->
                <tr class="total-row">
                    <td>Total COGS</td>
                    <td class="text-right" id="total_cogs">0.00</td>
                </tr>
                <tr class="total-row">
                    <td>Gross Profit</td>
                    <td class="text-right" id="gross_profit">0.00</td>
                </tr>
            </tbody>
        </table>

        <h4>Expenses</h4>
        <table style="font-family: 'Courier New', Courier, monospace; font-size: 20px;">
            <thead>
                <tr>
                    <th>Description</th>
                    <th class="text-right">Amount (BDT)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Total Daily Expenses</td>
                    <td class="text-right" id="total_daily_expense">0.00</td>
                </tr>
                <tr>
                    <td>Total Monthly Other Expenses</td>
                    <td class="text-right" id="total_monthly_other_expense">0.00</td>
                </tr>
                <tr>
                    <td>Yearly Expenses</td>
                    <td class="text-right" id="total_yearly_expense">0.00</td>
                </tr>
                <tr>
                    <td>Rent</td>
                    <td class="text-right" id="total_rent">0.00</td>
                </tr>
                <tr>
                    <td>Utilities</td>
                    <td class="text-right" id="total_utility">0.00</td>
                </tr>
                <tr>
                    <td>Salaries</td>
                    <td class="text-right" id="total_salary">0.00</td>
                </tr>

                <tr>
                    <td>Total Burned/Damaged product value</td>
                    <td class="text-right" id="total_damaged_product_value">0.00</td>
                </tr>


                <tr class="total-row">
                    <td>Total Expenses</td>
                    <td class="text-right" id="total_expense">0.00</td>
                </tr>
                <tr class="total-row">
                    <td>Net Profit</td>
                    <td class="text-right" id="net_profit">0.00</td>
                </tr>
                <tr class="total-row">
                    <td>Net Loss</td>
                    <td class="text-right" id="net_loss">0.00</td>
                </tr>
            </tbody>
        </table>
    </div>


        <!-- Print Button -->
    <button id="print-button" class="btn btn-danger float-right">Print Report</button>
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
//Initialize Select2 Elements
$('.select2bs4').select2({
      theme: 'bootstrap4'
    })


document.addEventListener('DOMContentLoaded', function() {
  const yearPicker = document.getElementById('yearPicker');
  const currentYear = new Date().getFullYear();
  const startYear = 2000;  // Define the starting year
  const endYear = currentYear;  // You can adjust the end year if needed

  // Populate year dropdown
  for (let year = startYear; year <= endYear; year++) {
    const option = document.createElement('option');
    option.value = year;
    option.text = year;
    yearPicker.appendChild(option);
  }

  // Pre-select current year
  yearPicker.value = currentYear;

  yearPicker.addEventListener('change', function() {
    const selectedYear = yearPicker.value;
    console.log('Selected year:', selectedYear);
    // Perform actions based on the selected year
  });
});

$('#search').on('click',function(){

    var $selectedYear = $('#yearPicker').val();
    var $selectedMonth = $('#monthPicker').val();

    // Function to get CSRF token from meta tag
    function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }
    // Set up Axios defaults
    axios.defaults.withCredentials = true;
    axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

    axios.get('sanctum/csrf-cookie').then(response=>{
    axios.post('/api/account_profit_and_loss_report_result',{
            year: $selectedYear,
            month: $selectedMonth
        }).then(response=>{
            console.log(response.data);
            $('#total_sale').html(response.data.total_sale.toFixed(2));
            // $('#total_due').html(response.data.total_customer_due.toFixed(2));
            $('#total_purchase').html(response.data.total_purchase.toFixed(2));
            $('#total_daily_expense').html(response.data.total_daily_expense.toFixed(2));
            $('#total_monthly_other_expense').html(response.data.total_monthly_other_expense.toFixed(2));
            $('#total_yearly_expense').html(response.data.total_yearly_expense.toFixed(2));
            $('#total_rent').html(response.data.total_rent.toFixed(2));
            $('#total_utility').html(response.data.total_utility.toFixed(2));
            $('#total_salary').html(response.data.total_salary.toFixed(2));
            $('#total_damaged_product_value').html(response.data.total_damaged_product_value.toFixed(2));

            /// Total revenue calculation start
            var total_sale = parseFloat(response.data.total_sale); // Ensure it's a number
            // var total_due = parseFloat(response.data.total_customer_due); // Ensure it's a number
            // var total_revenue = total_sale + total_due;
            var total_revenue = total_sale;
            $('#total_revenue').html(total_revenue.toFixed(2));
            // Total revenue calculation end

            // Total COGS calculation start
            var total_purchase = parseFloat(response.data.total_purchase); // Ensure it's a number
            $('#total_cogs').html(total_purchase.toFixed(2));
            // Total COGS calculation end

            // Gross profit calculation start
            var gross_profit = total_revenue - total_purchase;
            $('#gross_profit').html(gross_profit.toFixed(2));
            // Gross profit calculation end

            //total expense calculation start
            var total_daily_expense = parseFloat(response.data.total_daily_expense);
            var total_monthly_other_expense = parseFloat(response.data.total_monthly_other_expense);
            var total_yearly_expense = parseFloat(response.data.total_yearly_expense);
            var rent = parseFloat(response.data.total_rent);
            var utility = parseFloat(response.data.total_utility);
            var salary = parseFloat(response.data.total_salary);
            var damage_or_burn = parseFloat(response.data.total_damaged_product_value);

            var total_expense = total_daily_expense+total_monthly_other_expense+total_yearly_expense+rent+utility+salary+damage_or_burn;
            $('#total_expense').html(total_expense.toFixed(2));
            //total expense calculation end

            //net profit and net loss calculation start
            if(total_expense > gross_profit){
                var net_loss = total_expense - gross_profit;
                $('#net_loss').html(net_loss.toFixed(2));
            }else{
                var net_profit = gross_profit - total_expense;
                $('#net_profit').html(net_profit.toFixed(2));
            }
            //net profit and net loss calculation end

        });
    });

})


$('#refresh').on('click',function(){
    window.location.reload(true);
})


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