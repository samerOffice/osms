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

            <h1>Sales Report</h1>
            <div class="report-info">
                <p><strong>Report Date:</strong> August 17, 2024</p>
                <p><strong>Period:</strong> August 2024</p>
            </div>
        
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Quantity Sold</th>
                        <th>Purchase Price (BDT)</th>
                        <th>Selling Price (BDT)</th>
                        <th>Total Purchase (BDT)</th>
                        <th>Total Sales (BDT)</th>            
                        <th>Profit (BDT)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Lenovo 203 tablet</td>
                        <td>3</td>
                        <td>45,000</td>
                        <td>47,000</td>
                        <td>1,35,000</td>
                        <td>1,41,000</td>
                        <td>6,000</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Otobi Wooden Table</td>
                        <td>4</td>
                        <td>12,500</td>
                        <td>13,000</td>
                        <td>50,000</td>
                        <td>52,000</td>
                        <td>2,000</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Hatil Table</td>
                        <td>2</td>
                        <td>11,000</td>
                        <td>11,500</td>
                        <td>22,000</td>
                        <td>23,000</td>
                        <td>1,000</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">Total</td>
                        <td>2,07,000</td>
                        <td>2,16,000</td>
                        <td>9,000</td>
                    </tr>
                </tfoot>
            </table>
    </div>


        <!-- Print Button -->
    <button id="print-button">Print Report</button>

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
    axios.post('/api/profit_and_loss_report_result',{
            year: $selectedYear,
            month: $selectedMonth
        }).then(response=>{
            console.log(response.data);
            $('#total_sale').html(response.data.total_sale.toFixed(2));
            $('#total_due').html(response.data.total_customer_due.toFixed(2))
            $('#total_purchase').html(response.data.total_purchase.toFixed(2))
            $('#total_rent').html(response.data.total_rent.toFixed(2))
            $('#total_utility').html(response.data.total_utility.toFixed(2))
            $('#total_salary').html(response.data.total_salary.toFixed(2))
            $('#total_damaged_product_value').html(response.data.total_damaged_product_value.toFixed(2))

            /// Total revenue calculation start
            var total_sale = parseFloat(response.data.total_sale); // Ensure it's a number
            var total_due = parseFloat(response.data.total_customer_due); // Ensure it's a number
            var total_revenue = total_sale + total_due;
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
            var rent = parseFloat(response.data.total_rent);
            var utility = parseFloat(response.data.total_utility);
            var salary = parseFloat(response.data.total_salary);
            var damage_or_burn = parseFloat(response.data.total_damaged_product_value);

            var total_expense = rent+utility+salary+damage_or_burn;
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