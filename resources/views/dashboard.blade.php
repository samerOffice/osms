@extends('master')

@section('title')
Welcome
@endsection

@push('css')
<style>
  .employee_button_position {
    background-color: #ff5d6c; color: white; margin: 0;
    position: absolute;
    left: 40%;
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
    }

  .inventory_button_position {
    background-color: #1cdf1c; color: white; margin: 0;
    position: absolute;
    left: 40%;
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
    }

    .pos_button_position {
    background-color: #20ceea; color: white; margin: 0;
    position: absolute;
    left: 40%;
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
    }


    .tracking_button_position {
    background-color: #e6753e; color: white; margin: 0;
    position: absolute;
    left: 40%;
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
    }


    
</style>
@endpush


@section('content')
@if (Auth::check())

  @if($current_module->module_status == 1) <!--general module-->
  <div class="content-wrapper" style="background-image: url('{{ asset('public/img/2.png') }}'); background-repeat: no-repeat;background-size: cover;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>
        {{-- <h4 align=center>Welcome, <b>{{Auth::user()->name}}</b>!</h4>   
        <h4 align=center>To</h4>
        <div class="row" style="margin-left: 35%">    
            <span style="margin-top:20px !important;"><img src="{{asset('public/img/otithee_logo.png')}}"  height="25px" width="auto" alt="logo"></span>
        <em> 
          <h1 style="color: green; font-weight: bold; margin-top: 17px">&nbsp;Shop Management System </h1>
        </em>      
        </div> --}}
       
        <div class="row mt-4">
          <div class="col-lg-3 col-md-6 col-sm-12">
            <h4 align="center">Employee Management</h4>
            <!-- small box -->
              <div class="small-box" style="padding:150px; height:auto; background-image: url('{{ asset('public/img/employee_dashboard.jpg') }}');  background-size: cover;">   
              </div>
              <br> 
              <div style="position: relative">
                <form action="{{route('empModuleActive')}}" method="post">
                  @csrf
                  <input type="hidden" value="2" name="current_module_status">                
                <button type="submit" class="btn employee_button_position" >Click Here <i class="fas fa-arrow-circle-right"></i></button>
              </form>  
              </div> 
              <br>                
              <br>                
           </div>
          
          <!-- ./col -->
          <div class="col-lg-3 col-md-6 col-sm-12">
            <h4 align="center">Accounts & Inventory Management</h4>
            <!-- small box -->
            <div class="small-box" style="padding:150px; height:auto; background-image: url('{{ asset('public/img/inventory_dashboard.jpg') }}');  background-size: cover;" >      
            </div>
            <br>
              <div style="position: relative;">
                <form action="{{route('inventoryModuleActive')}}" method="post">
                  @csrf
                  <input type="hidden" value="3" name="current_module_status">           
                <button type="submit" class="btn inventory_button_position" >Click Here <i class="fas fa-arrow-circle-right"></i></button>
                </form>
              </div>
              <br>                
              <br>           
           </div>
          <!-- ./col -->
          <div class="col-lg-3 col-md-6 col-sm-12">
            <h4 align="center">Point of Sale</h4>
            <!-- small box -->
            <div class="small-box" style="padding:150px; height:auto; background-image: url('{{ asset('public/img/pos_dashboard.jpg') }}');  background-size: cover;" >
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

          <div class="col-lg-3 col-md-6 col-sm-12">
            <h4 align="center">Delivery Tracking System</h4>
            <!-- small box -->
            <div class="small-box" style="padding:150px; height:auto; background-image: url('{{ asset('public/img/tracking_dashboard.jpg') }}');  background-size: cover;" >
            </div>
             <br>
            <div style="position: relative">
              <form action="{{route('posModuleActive')}}" method="post">
                @csrf
                <input type="hidden" value="4" name="current_module_status">         
              <button type="submit" class="btn tracking_button_position">Click Here <i class="fas fa-arrow-circle-right"></i></button>
            </form>
            </div>   
          </div>
         
        </div>
      </div><!-- /.container-fluid -->
    </div>
 
    

 
<section class="content">
  <div class="container-fluid">    
    <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Monthly Recap Report</h5>

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
                      Add Products to Cart
                      <span class="float-right"><b>160</b>/200</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: 80%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->

                    <div class="progress-group">
                      Complete Purchase
                      <span class="float-right"><b>310</b>/400</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: 75%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      <span class="progress-text">Visit Premium Page</span>
                      <span class="float-right"><b>480</b>/800</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: 60%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      Send Inquiries
                      <span class="float-right"><b>250</b>/500</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" style="width: 50%"></div>
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
    </section>
  





    
  </div>
  @elseif($current_module->module_status == 2) <!--employee module-->
  <div class="content-wrapper" style="background-color: rgba(255, 206, 213, 0.18)">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div style="height: 100%;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;">
        <img src="{{'public/img/employees.jpg'}}" width="900px" alt="">
        </div>   
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @elseif($current_module->module_status == 3) <!--inventory module-->
  <div class="content-wrapper" style="background-color: rgba(202, 255, 214, 0.34)">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div style="height: 100%;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;">
        <img src="{{'public/img/inventory.jpg'}}" width="700px" alt="">
        </div>
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid"> 
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @else <!--pos module-->
  <div class="content-wrapper" style="background-color: rgba(185, 245, 255, 0.25)">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div style="height: 100%;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;">
        <img src="{{'public/img/pos.jpg'}}" width="700px" alt="">
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">  
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @endif
@else
@php
    $redirectRoute = route('login');
    header("Location: $redirectRoute");
        exit();
@endphp
@endif
@endsection