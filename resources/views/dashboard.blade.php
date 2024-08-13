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


  //---------------------------------------
  // - MONTHLY SALES CHART (Main Dashboard)
  //---------------------------------------

  $(function () {
  'use strict';

  // Get context with jQuery - using jQuery's .get() method.
  var salesChartCanvas = $('#salesChart').get(0).getContext('2d');

  // Define salesChartData initially with dummy data
  var salesChartData = {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    datasets: [
      {
        label: 'Digital Goods',
        backgroundColor: '#16aaff',
        pointRadius: false,
        pointHighlightFill: '#fff',
        data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0] // Placeholder data
      },
      {
        label: 'Electronics',
        backgroundColor: '#d92550',
        pointRadius: false,
        pointHighlightFill: '#fff',
        data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0] // Placeholder data
      }
    ]
  };

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
  };

  // Initialize the chart
  var salesChart = new Chart(salesChartCanvas, {
    type: 'line',
    data: salesChartData,
    options: salesChartOptions
  });

  // Fetch dynamic data using Axios
  axios.get('/api/previous_and_current_monthly_sales') // Replace with your actual API endpoint
    .then(function (response) {
      var data = response.data;

      // Update the chart data with the dynamic data
      salesChartData.datasets[0].data = data.previous_month_sale; // Replace with your data keys
      salesChartData.datasets[1].data = data.current_month_sale; // Replace with your data keys

      // Re-render the chart to reflect the new data
      salesChart.update();
    })
    .catch(function (error) {
      console.error('Error fetching sales data:', error);
    });
});

  //---------------------------------------------
  // - END MONTHLY SALES CHART - (Main Dashboard)
  //---------------------------------------------





  //----------------------------------------------------
  // - Purchase vs Sale CHART Start- (Inventory Dashboard)
  //-----------------------------------------------------


  $(function () {
  'use strict'

  // Function to fetch dynamic data from API
  function getMonthlyData() {
    return axios.get('/api/monthly_sales_purchases') // Replace with your API endpoint
      .then(function (response) {
        return response.data; // Expecting { sales: [...], purchases: [...] }
      })
      .catch(function (error) {
        console.error('Error fetching data:', error);
        return {
          sales: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0], // Default data in case of error
          purchases: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
        };
      });
  }

  // Initialize the chart after fetching data
  getMonthlyData().then(function (data) {
    var ticksStyle = {
      fontColor: '#495057',
      fontStyle: 'bold'
    };

    var mode = 'index';
    var intersect = true;

    var $salesChart = $('#sales-chart');

    var salesChart = new Chart($salesChart, {
      type: 'bar',
      data: {
        labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
        datasets: [
          {
            label: 'Sales',
            backgroundColor: '#007bff',
            borderColor: '#007bff',
            data: data.sales // Dynamic sales data from API
          },
          {
            label: 'Purchases',
            backgroundColor: '#ced4da',
            borderColor: '#ced4da',
            data: data.purchases // Dynamic purchases data from API
          }
        ]
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          mode: mode,
          intersect: intersect
        },
        hover: {
          mode: mode,
          intersect: intersect
        },
        legend: {
          display: true // Display legend
        },
        scales: {
          yAxes: [{
            display: false,
            gridLines: {
              display: true,
              lineWidth: '4px',
              color: 'rgba(0, 0, 0, .2)',
              zeroLineColor: 'transparent'
            },
            ticks: $.extend({
              beginAtZero: true,
              callback: function (value) {
                if (value >= 1000) {
                  value /= 1000;
                  value += ' BDT';
                }
                return  value;
              }
            }, ticksStyle)
          }],
          xAxes: [{
            display: true,
            gridLines: {
              display: false
            },
            ticks: ticksStyle
          }]
        }
      }
    });
  });

});

  //----------------------------------------------------
  // - Purchase vs Sale CHART End- (Inventory Dashboard)
  //-----------------------------------------------------



 //-------------------- Available Product Percentage (start)---------
// Function to update the widget
function updateAvailableProducts(percentage) {
    // Update the percentage text
    document.getElementById('available-products-percentage').textContent = percentage.toFixed(2) + '%';
    
    // Update the progress bar width and aria-valuenow
    var progressBar = document.getElementById('progress-bar-available-product');
    progressBar.style.width = percentage.toFixed(2) + '%';
    progressBar.setAttribute('aria-valuenow', percentage.toFixed(2));
}

// Function to fetch data from the API using Axios
function fetchAvailableProducts() {
    return axios.get('/api/total_available_products') // Replace with your API endpoint
        .then(response => {
            // Assuming the API returns an object with a `percentage` field
            var percentage = response.data.percentage;
            updateAvailableProducts(percentage);
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            // Optionally, handle errors or show a default message
        });
}

// Call the function to fetch and update data on page load
fetchAvailableProducts();

  //-------------------- Available Product Percentage (end)---------



   //-------------------- Near-Expired Product Percentage (start)---------
  // Function to update the widget
function updateNearExpiredProducts(percentage) {
    // Update the percentage text
    document.getElementById('near-expired-products-percentage').textContent = percentage.toFixed(2) + '%';
    
    // Update the progress bar width and aria-valuenow
    var progressBar = document.getElementById('progress-bar-near-expired-product');
    progressBar.style.width = percentage.toFixed(2) + '%';
    progressBar.setAttribute('aria-valuenow', percentage.toFixed(2));
}

// Function to fetch data from the API using Axios
function fetchNearExpiredProducts() {
    return axios.get('/api/total_near_expired_products') // Replace with your API endpoint
        .then(response => {
            // Assuming the API returns an object with a `percentage` field
            var percentage = response.data.percentage;
            updateNearExpiredProducts(percentage);
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            // Optionally, handle errors or show a default message
        });
}

// Call the function to fetch and update data on page load
fetchNearExpiredProducts();
  //-------------------Near-Expired Product Percentage (end)---------




   //-------------------- Damaged Product Percentage (start)---------
   // Function to update the widget
function updateDamagedProducts(percentage) {
    // Update the percentage text
    document.getElementById('damaged-products-percentage').textContent = percentage.toFixed(2) + '%';
    
    // Update the progress bar width and aria-valuenow
    var progressBar = document.getElementById('progress-bar-damaged-product');
    progressBar.style.width = percentage.toFixed(2) + '%';
    progressBar.setAttribute('aria-valuenow', percentage.toFixed(2));
}

// Function to fetch data from the API using Axios
function fetchDamagedProducts() {
    return axios.get('/api/total_damaged_products') // Replace with your API endpoint
        .then(response => {
            // Assuming the API returns an object with a `percentage` field
            var percentage = response.data.percentage;
            updateDamagedProducts(percentage);
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            // Optionally, handle errors or show a default message
        });
}

// Call the function to fetch and update data on page load
fetchDamagedProducts();
  //-------------------Damaged Product Percentage (end)---------
</script>
@endpush


