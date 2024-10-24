@extends('master')

@section('title')
Attendance Report
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid" >
        <div class="custom-container">
            <br>
            <h3 align="center">Attendance Report</h3>

            <form action="{{route('attendance_type_submit')}}" method="POST">
                @csrf
                <div class="row">     
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="yearPicker">Select Type:</label>
                            <select class="form-control select2bs4" id="attendance_type" name="attendance_type" required>
                                <option value="">--Select--</option>
                                <option value="1">Daily</option>
                                <option value="2">Monthly</option>
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