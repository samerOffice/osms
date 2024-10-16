@extends('master')

@section('title')
Purchase Report
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
            <h3 align="center">Balance Sheet</h3>

            <form action="{{route('balance_transaction_report_submit')}}" method="POST">
                @csrf
                <div class="row">     
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="yearPicker">Select Year:</label>
                            <select class="form-control select2bs4" id="yearPicker" name="year" required>
                                {{-- <option value="">--Select--</option> --}}
                              <!-- JavaScript will populate this with years -->
                            </select>
                          </div>
                    </div>
                    </div>
                
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                        <button type="submit" class="btn btn-success float-right ml-2" id="search">Submit</button>
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