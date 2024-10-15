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
            <h3 align="center">Purchase Report</h3>

            <form action="{{route('account_purchase_report_submit')}}" method="POST">
                @csrf
                <div class="row">     
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="yearPicker">Select Type:</label>
                            <select class="form-control select2bs4" id="purchase_type" name="purchase_type" required>
                                <option value="">--Select--</option>
                                <option value="1">Daily</option>
                                <option value="2">Monthly</option>
                                <option value="3">Yearly</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                        <label for="client" class="col-form-label text-start">Supplier</label>         
                        <select class="form-control select2bs4" id="supplier_id" required name="supplier_id" style="width: 100%;">
                            <option value="">--Select--</option>
                            <option value="">All</option>
                            @foreach($suppliers as $supplier)
                            <option value="{{$supplier->id}}">{{$supplier->full_name}}</option>
                            @endforeach
                        </select>
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