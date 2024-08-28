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
      <h4 align=center>Welcome To, <b style="color: #16aaff">{{$shop_name}}</b></h4>
      <br>
      {{-- <h4 align=center>To</h4>
      <div class="row" style="margin-left: 35%">
        <span style="margin-top:20px !important;"><img src="{{asset('img/otithee_logo.png')}}" height="25px" width="auto" alt="logo"></span>
        <em>
          <h1 style="color: green; font-weight: bold; margin-top: 17px">&nbsp;Shop Management System </h1>
        </em>
      </div> --}}

      <div class="row mt-4">

        @if((Auth::user()->role_id == 1) || in_array(1, $permitted_menus_array))
        <div class="col-lg-4 col-md-4 col-sm-4">
          <h4 align="center">Employee Management</h4>
          <!-- small box -->
          <div class="small-box" style="padding:150px; height:auto; background-image: url('{{ asset('img/employee_dashboard.jpg') }}');  background-size: cover;">
          </div>
          <br>
          <div style="position: relative">
                   
              <a href="{{route('empModuleActive')}}"><button type="submit" class="btn employee_button_position">Click Here <i class="fas fa-arrow-circle-right"></i></button></a>  
          </div>
          <br>
          <br>
        </div>
       @endif

        
       @if((Auth::user()->role_id == 1) || in_array(2, $permitted_menus_array))
        <div class="col-lg-4 col-md-4 col-sm-4">
          <h4 align="center">Inventory Management</h4>
          <!-- small box -->
          <div class="small-box" style="padding:150px; height:auto; background-image: url('{{ asset('img/inventory_dashboard.jpg') }}');  background-size: cover;">
          </div>
          <br>
          <div style="position: relative;">
                    
              <a href="{{route('inventoryModuleActive')}}"><button type="submit" class="btn inventory_button_position">Click Here <i class="fas fa-arrow-circle-right"></i></button></a>   
          </div>
          <br>
          <br>
        </div>
        @endif

        @if((Auth::user()->role_id == 1) || in_array(3, $permitted_menus_array))
        <div class="col-lg-4 col-md-4 col-sm-4">
          <h4 align="center">Point of Sale</h4>
          <!-- small box -->
          <div class="small-box" style="padding:150px; height:auto; background-image: url('{{ asset('img/pos_dashboard.jpg') }}');  background-size: cover;">
          </div>
          <br>
          <div style="position: relative">
                 
              <a href="{{route('posModuleActive')}}"><button type="submit" class="btn pos_button_position">Click Here <i class="fas fa-arrow-circle-right"></i></button></a>        
          </div>
        </div>
        @endif

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
      <div class="col-md-6 col-sm-6">
        <!-- Monthly Sales (over the year) CHART -->
            <div class="card">
              <div class="card-header" style="background-color: #16aaff; color : white">
                <h3 class="card-title">Monthly Sales Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" style="color: white">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove" style="color: white">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- Monthly Sales (over the year) CHART -->
      </div>
      <!-- /.col -->

      <div class="col-md-6 col-sm-6">
                  <!-- Small boxes (Stat box) -->
                  <div class="row">
                    <div class="col-6">
                      <!-- small box -->
                      <div class="small-box bg-info">
                        <div class="inner">
                          <h3>{{$total_branch}}</h3>
          
                          <p>Total Branches</p>
                        </div>
                        <div class="icon">
                          <i class="fa-solid fa-building"></i>
                        </div>
                        <a href="{{route('branch_list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-6">
                      <!-- small box -->
                      <div class="small-box bg-danger">
                        <div class="inner">
                          <h3>{{$total_outlet}}</h3>
          
                          <p>Total Outlets</p>
                        </div>
                        <div class="icon">
                          <i class="fa-solid fa-store"></i>
                        </div>
                        <a href="{{route('outlet_list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->

                    <div class="col-6">
                      <!-- small box -->
                      <div class="small-box bg-warning">
                        <div class="inner">
                          <h3>{{$total_warehouse}}</h3>
          
                          <p>Total Warehouses</p>
                        </div>
                        <div class="icon">
                          <i class="fa-solid fa-warehouse"></i>
                        </div>
                        <a href="{{route('warehouse_list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->

                    <div class="col-6">
                      <!-- small box -->
                      <div class="small-box bg-primary">
                        <div class="inner">
                          <h3>{{$total_department}}</h3>
          
                          <p>Total Departments</p>
                        </div>
                        <div class="icon">
                          <i class="fa-solid fa-hotel"></i>
                        </div>
                        <a href="{{route('department_list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    
                    
                  </div>
                  <!-- /.row -->
      </div>
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


  //-------------------------------------------------------
  // - MONTHLY SALES CHART (OVER THE YEAR) (Main Dashboard)
  //--------------------------------------------------------

  $(function () {
  'use strict';

  // Function to fetch data from API
  function fetchDataAndRenderChart() {
    axios.get('/api/current_year_sales') // Replace with your actual API endpoint
      .then(function (response) {
        const salesData = response.data; // Assuming API returns data in the format you need

        // Prepare the data for the chart
        const donutData = {
          labels: salesData.labels, // ['January', 'February', ...]
          datasets: [
            {
              data: salesData.values, // [700, 500, ...]
              backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', 'green', 'blue', 'orange', 'red', 'powderblue', 'yellow'],
            }
          ]
        };

        const donutOptions = {
          maintainAspectRatio: false,
          responsive: true,
        };

        // Get context with jQuery - using jQuery's .get() method.
        const donutChartCanvas = $('#donutChart').get(0).getContext('2d');

        // Create the chart with the dynamic data
        new Chart(donutChartCanvas, {
          type: 'doughnut',
          data: donutData,
          options: donutOptions
        });
      })
      .catch(function (error) {
        console.error('Error fetching sales data:', error);
      });
  }

  // Fetch data and render chart on page load
  fetchDataAndRenderChart();
});

  //--------------------------------------------------------------
  // - END MONTHLY SALES CHART (OVER THE YEAR) - (Main Dashboard)
  //----------------------------------------------------------------





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


