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
      <div class="container-fluid" >
        <div class="custom-container">
            <br>
            <h3 align="center">Monthly Expense Report</h3>

            <form action="{{route('monthly_expense_report_submit')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-5 col-sm-12">
                        <div class="form-group mb-4">
                            <label for="monthPicker">Select Month:</label>
                            <select class="form-control select2bs4" id="monthPicker" name="month" required>
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
                    <div class="col-md-5 col-sm-12">
                        <div class="form-group">
                            <label for="yearPicker">Select Year:</label>
                            <select class="form-control select2bs4" id="yearPicker" name="year" required>
                              <!-- JavaScript will populate this with years -->
                            </select>
                          </div>
                    </div>

                    <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                        <button type="submit" class="btn btn-success mt-4" id="search">Search</button>
                        </div>
                    </div>
                 </div>
    
            </form>     
       </div>                  
        <br> 
        </div>
        <br>
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

</script>

@endpush