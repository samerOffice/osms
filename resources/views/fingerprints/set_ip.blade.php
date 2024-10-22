@extends('master')

@section('title')
Set Device IP
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid" >
        <div class="custom-container">
            <br>
            <h3 align="center">Fingerprint Device Setup</h3>

            @php
            if (function_exists('socket_create')) {
                echo "Sockets extension is enabled.";
            } else {
                echo "Sockets extension is not enabled.";
            }
            @endphp

            <form action="{{route('store_ip')}}" method="POST">
                @csrf
                <div class="row">     
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label>Set Device IP</label>
                            <input type="text" class="form-control" name="device_ip" id="device_ip" required>
                        </div>
                    </div> 
                    </div>
                
                    <div class="row">
                        {{-- <div class="col-md-5"></div> --}}
                        <div class="col-md-12 col-sm-12">
                        <button type="submit" class="btn btn-success float-right ml-2">Submit</button>
                        </div>     
                    </div>
            </form>

            @if(session('message'))
                <p>{{ session('message') }}</p>
            @endif
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