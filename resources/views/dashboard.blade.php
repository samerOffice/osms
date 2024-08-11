@extends('master')

@section('title')
Dashboard
@endsection

@section('content')
@if (Auth::check())

@if($current_module->module_status == 1) <!--general module-->
<div class="content-wrapper" style="background-image: url('{{ asset('img/2.png') }}'); background-repeat: no-repeat;background-size: cover;">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <br>
      {{-- <h4 align=center>Welcome, <b>{{Auth::user()->name}}</b>!</h4>
      <h4 align=center>To</h4>
      <div class="row" style="margin-left: 35%">
        <span style="margin-top:20px !important;"><img src="{{asset('img/otithee_logo.png')}}" height="25px" width="auto" alt="logo"></span>
        <em>
          <h1 style="color: green; font-weight: bold; margin-top: 17px">&nbsp;Shop Management System </h1>
        </em>
      </div> --}}

      <div class="row mt-4">
        <div class="col-lg-4 col-md-4 col-sm-4">
          <h4 align="center">Employee Management</h4>
          <!-- small box -->
          <div class="small-box" style="padding:150px; height:auto; background-image: url('{{ asset('img/employee_dashboard.jpg') }}');  background-size: cover;">
          </div>
          <br>
          <div style="position: relative">
            <form action="{{route('empModuleActive')}}" method="post">
              @csrf
              <input type="hidden" value="2" name="current_module_status">
              <button type="submit" class="btn employee_button_position">Click Here <i class="fas fa-arrow-circle-right"></i></button>
            </form>
          </div>
          <br>
          <br>
        </div>

        <!-- ./col -->
        <div class="col-lg-4 col-md-4 col-sm-4">
          <h4 align="center">Inventory Management</h4>
          <!-- small box -->
          <div class="small-box" style="padding:150px; height:auto; background-image: url('{{ asset('img/inventory_dashboard.jpg') }}');  background-size: cover;">
          </div>
          <br>
          <div style="position: relative;">
            <form action="{{route('inventoryModuleActive')}}" method="post">
              @csrf
              <input type="hidden" value="3" name="current_module_status">
              <button type="submit" class="btn inventory_button_position">Click Here <i class="fas fa-arrow-circle-right"></i></button>
            </form>
          </div>
          <br>
          <br>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-md-4 col-sm-4">
          <h4 align="center">Point of Sale</h4>
          <!-- small box -->
          <div class="small-box" style="padding:150px; height:auto; background-image: url('{{ asset('img/pos_dashboard.jpg') }}');  background-size: cover;">
          </div>
          <br>
          <div style="position: relative">
            <form action="{{route('posModuleActive')}}" method="post">
              @csrf
              <input type="hidden" value="4" name="current_module_status">
              <button type="submit" class="btn pos_button_position">Click Here <i class="fas fa-arrow-circle-right"></i></button>
            </form>
          </div>
        </div>

        {{-- <div class="col-lg-3 col-md-3 col-sm-3">
            <h4 align="center">Delivery Tracking System</h4>
            <!-- small box -->
            <div class="small-box" style="padding:150px; height:auto; background-image: url('{{ asset('img/tracking_dashboard.jpg') }}'); background-size: cover;" >
      </div>
      <br>
      <div style="position: relative">
        <form action="{{route('posModuleActive')}}" method="post">
          @csrf
          <input type="hidden" value="4" name="current_module_status">
          <button type="submit" class="btn tracking_button_position">Click Here <i class="fas fa-arrow-circle-right"></i></button>
        </form>
      </div>
    </div> --}}

  </div>
</div><!-- /.container-fluid -->
</div>




<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Sale Report</h5>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <div class="btn-group">
                <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                  <i class="fas fa-wrench"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" role="menu">
                  <a href="#" class="dropdown-item">Action</a>
                  <a href="#" class="dropdown-item">Another action</a>
                  <a href="#" class="dropdown-item">Something else here</a>
                  <a class="dropdown-divider"></a>
                  <a href="#" class="dropdown-item">Separated link</a>
                </div>
              </div>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-8">
                <p class="text-center">
                  <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                </p>

                <div class="chart">
                  <!-- Sales Chart Canvas -->
                  <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                </div>
                <!-- /.chart-responsive -->
              </div>
              <!-- /.col -->
              <div class="col-md-4">
                <p class="text-center">
                  <strong>Goal Completion</strong>
                </p>

                <div class="progress-group">
                  Previous Month Total Sale
                  {{-- <span class="float-right"><b>160</b>/200</span> --}}
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-info" style="width: 80%"></div>
                  </div>
                </div>
                <!-- /.progress-group -->

                <div class="progress-group">
                  This Month Total Sale
                  {{-- <span class="float-right"><b>310</b>/400</span> --}}
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-danger" style="width: 75%"></div>
                  </div>
                </div>

               
                <!-- /.progress-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- ./card-body -->
          <div class="card-footer">
            <div class="row">
              <div class="col-sm-3 col-6">
                <div class="description-block border-right">
                  <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>
                  <h5 class="description-header">$35,210.43</h5>
                  <span class="description-text">TOTAL REVENUE</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-3 col-6">
                <div class="description-block border-right">
                  <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>
                  <h5 class="description-header">$10,390.90</h5>
                  <span class="description-text">TOTAL COST</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-3 col-6">
                <div class="description-block border-right">
                  <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>
                  <h5 class="description-header">$24,813.53</h5>
                  <span class="description-text">TOTAL PROFIT</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-3 col-6">
                <div class="description-block">
                  <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span>
                  <h5 class="description-header">1200</h5>
                  <span class="description-text">GOAL COMPLETIONS</span>
                </div>
                <!-- /.description-block -->
              </div>
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-footer -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
  </div>
  <br>
  <br>
  <br>
</section>
</div>


<!-- Fahad Start Employee Module -->


@elseif($current_module->module_status == 2) <!--employee module-->

@include('modules.emp_dashboard')


@elseif($current_module->module_status == 3) <!--inventory module-->

@include('modules.inventory_dashboard')

@else <!--pos module-->

@include('modules.pos_dashboard')

@endif
@else
@php
$redirectRoute = route('login');
header("Location: $redirectRoute");
exit();
@endphp
@endif
@endsection

@push('masterScripts')
<script>

$(document).ready(function() {
    $('#example1').DataTable({
        responsive: true, // Enable responsive behavior
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                exportOptions: {
                    columns: ':not(:last-child)' // Exclude the last column (Labeling) from printing
                }
            },
            {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: ':not(:last-child)' // Exclude the last column (Labeling) from CSV
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':not(:last-child)' // Exclude the last column (Labeling) from Excel
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: ':not(:last-child)' // Exclude the last column (Labeling) from PDF
                }
            }
        ]
    });

    
});




$(function () {
  'use strict'
  //-----------------------
  // - MONTHLY SALES CHART -
  //-----------------------

  // Get context with jQuery - using jQuery's .get() method.
  var salesChartCanvas = $('#salesChart').get(0).getContext('2d')

  var salesChartData = {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July','Aug', 'Sep','Oct', 'Nov', 'Dec'],
    datasets: [
      {
        label: 'Digital Goods',
        backgroundColor: '#16aaff',
        // borderColor: 'rgba(60,141,188,0.8)',
        pointRadius: false,
        // pointColor: '#3b8bba',
        // pointStrokeColor: 'rgba(60,141,188,1)',
        pointHighlightFill: '#fff',
        // pointHighlightStroke: 'rgba(60,141,188,1)',
        data: [28, 48, 40, 19, 86, 27, 90, 81, 75, 55, 75, 10]
      },
      {
        label: 'Electronics',
        backgroundColor: '#d92550',
        // borderColor: 'rgba(210, 214, 222, 1)',
        pointRadius: false,
        // pointColor: 'rgba(210, 214, 222, 1)',
        // pointStrokeColor: '#c1c7d1',
        pointHighlightFill: '#fff',
        // pointHighlightStroke: 'rgba(220,220,220,1)',
        data: [65, 59, 80, 81, 56, 55, 40, 50, 80, 90, 95, 100]
      }
    ]
  }

  var salesChartOptions = {
    maintainAspectRatio: false,
    responsive: true,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        gridLines: {
          display: false
        }
      }],
      yAxes: [{
        gridLines: {
          display: false
        }
      }]
    }
  }
  // This will get the first returned node in the jQuery collection.
  // eslint-disable-next-line no-unused-vars
  var salesChart = new Chart(salesChartCanvas, {
    type: 'line',
    data: salesChartData,
    options: salesChartOptions
  }
  )

  //---------------------------
  // - END MONTHLY SALES CHART -
  //---------------------------
})

</script>
@endpush


