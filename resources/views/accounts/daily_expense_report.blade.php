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
      <div class="container-fluid" >
        <div class="custom-container">
            <br>
            <h3 align="center">Daily Expense Report</h3>

            <form action="{{route('daily_expense_report_submit')}}" method="POST">
                @csrf
                <div class="row">     
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="yearPicker">From:</label>
                            <input required type="date" class="form-control" name="from_date" id="from_date">
                        </div>
                    </div> 

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="yearPicker">To:</label>
                            <input required type="date" class="form-control" name="to_date" id="to_date">
                        </div>
                    </div> 
                    </div>
                
                    <div class="row">
                        {{-- <div class="col-md-5"></div> --}}
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

</script>

@endpush