@extends('master')

@section('title')
Welcome
@endsection

@push('css')
<style>

@media (min-width: 992px) {
  .sidebar-collapse .fahadsidebar {
    display: none;
}

}




  .employee_button_position {
    background-color: #ff5d6c;
    color: white;
    margin: 0;
    position: absolute;
    left: 40%;
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
  }

  .inventory_button_position {
    background-color: #1cdf1c;
    color: white;
    margin: 0;
    position: absolute;
    left: 40%;
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
  }

  .pos_button_position {
    background-color: #20ceea;
    color: white;
    margin: 0;
    position: absolute;
    left: 40%;
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
  }


  .tracking_button_position {
    background-color: #e6753e;
    color: white;
    margin: 0;
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
  <br>
  <br>
  <br>
</section>
</div>


<!-- Fahad Start Employee Module -->


@elseif($current_module->module_status == 2) <!--employee module-->


<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
  <div class="app-main">
    <div class="app-main__outer">
      <div class="app-main__inner">
        <div class="app-page-title">
          <div class="page-title-wrapper">
            <div class="page-title-heading">
              <div class="page-title-icon">
                <span><img src="{{ asset('dist/img/emp.png') }}" width="35px" alt="logo"></span>
              </div>
              <div>Employee Dashboard
                <div class="page-title-subheading"> An Employee Management System simplifies HR processes by automating payroll, attendance, and employee data management.
                </div>
              </div>
            </div>
            <div class="page-title-actions">
              <button type="button" data-toggle="tooltip" title="Example Tooltip" data-placement="bottom" class="btn-shadow mr-3 btn btn-dark">
                <i class="fa fa-star"></i>
              </button>
              <div class="d-inline-block dropdown">
                <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn-shadow dropdown-toggle btn btn-info">
                  <span class="btn-icon-wrapper pr-2 opacity-7">
                    <i class="fa fa-business-time fa-w-20"></i>
                  </span>
                  Buttons
                </button>
                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                  <ul class="nav flex-column">
                    <li class="nav-item">
                      <a href="javascript:void(0);" class="nav-link">
                        <i class="nav-link-icon lnr-inbox"></i>
                        <span>
                          Inbox
                        </span>
                        <div class="ml-auto badge badge-pill badge-secondary">86</div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="javascript:void(0);" class="nav-link">
                        <i class="nav-link-icon lnr-book"></i>
                        <span>
                          Book
                        </span>
                        <div class="ml-auto badge badge-pill badge-danger">5</div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="javascript:void(0);" class="nav-link">
                        <i class="nav-link-icon lnr-picture"></i>
                        <span>
                          Picture
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a disabled href="javascript:void(0);" class="nav-link disabled">
                        <i class="nav-link-icon lnr-file-empty"></i>
                        <span>
                          File Disabled
                        </span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content bg-midnight-bloom">
              <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                  <div class="widget-heading">Total Employees</div>
                  <div class="widget-subheading">Last year expenses</div>
                </div>
                <div class="widget-content-right">
                  <div class="widget-numbers text-white"><span>1896</span></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content bg-arielle-smile">
              <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                  <div class="widget-heading">Total Attendance</div>
                  <div class="widget-subheading">Total Clients Profit</div>
                </div>
                <div class="widget-content-right">
                  <div class="widget-numbers text-white"><span>568</span></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content bg-grow-early">
              <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                  <div class="widget-heading">Total Leave Applications</div>
                  <div class="widget-subheading">People Interested</div>
                </div>
                <div class="widget-content-right">
                  <div class="widget-numbers text-white"><span>46%</span></div>
                </div>
              </div>
            </div>
          </div>
          <div class="d-xl-none d-lg-block col-md-6 col-xl-4">
            <div class="card mb-3 widget-content bg-premium-dark">
              <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                  <div class="widget-heading">Products Sold</div>
                  <div class="widget-subheading">Revenue streams</div>
                </div>
                <div class="widget-content-right">
                  <div class="widget-numbers text-warning"><span>$14M</span></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 col-lg-6">
            <div class="mb-3 card">
              <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                  <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                  Sales Report
                </div>
                <ul class="nav">
                  <li class="nav-item"><a href="javascript:void(0);" class="active nav-link">Last</a></li>
                  <li class="nav-item"><a href="javascript:void(0);" class="nav-link second-tab-toggle">Current</a></li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane fade show active" id="tabs-eg-77">
                    <div class="card mb-3 widget-chart widget-chart2 text-left w-100">
                      <div class="widget-chat-wrapper-outer">
                        <div class="widget-chart-wrapper widget-chart-wrapper-lg opacity-10 m-0">
                          <canvas id="canvas"></canvas>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted text-uppercase font-size-md opacity-5 font-weight-normal">Top Authors</h6>
                    <div class="scroll-area-sm">
                      <div class="scrollbar-container">
                        <ul class="rm-list-borders rm-list-borders-scroll list-group list-group-flush">
                          <li class="list-group-item">
                            <div class="widget-content p-0">
                              <div class="widget-content-wrapper">
                                <div class="widget-content-left mr-3">
                                  <img width="42" class="rounded-circle" src="assets/images/avatars/9.jpg" alt="">
                                </div>
                                <div class="widget-content-left">
                                  <div class="widget-heading">Ella-Rose Henry</div>
                                  <div class="widget-subheading">Web Developer</div>
                                </div>
                                <div class="widget-content-right">
                                  <div class="font-size-xlg text-muted">
                                    <small class="opacity-5 pr-1">$</small>
                                    <span>129</span>
                                    <small class="text-danger pl-2">
                                      <i class="fa fa-angle-down"></i>
                                    </small>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="widget-content p-0">
                              <div class="widget-content-wrapper">
                                <div class="widget-content-left mr-3">
                                  <img width="42" class="rounded-circle" src="assets/images/avatars/5.jpg" alt="">
                                </div>
                                <div class="widget-content-left">
                                  <div class="widget-heading">Ruben Tillman</div>
                                  <div class="widget-subheading">UI Designer</div>
                                </div>
                                <div class="widget-content-right">
                                  <div class="font-size-xlg text-muted">
                                    <small class="opacity-5 pr-1">$</small>
                                    <span>54</span>
                                    <small class="text-success pl-2">
                                      <i class="fa fa-angle-up"></i>
                                    </small>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="widget-content p-0">
                              <div class="widget-content-wrapper">
                                <div class="widget-content-left mr-3">
                                  <img width="42" class="rounded-circle" src="assets/images/avatars/4.jpg" alt="">
                                </div>
                                <div class="widget-content-left">
                                  <div class="widget-heading">Vinnie Wagstaff</div>
                                  <div class="widget-subheading">Java Programmer</div>
                                </div>
                                <div class="widget-content-right">
                                  <div class="font-size-xlg text-muted">
                                    <small class="opacity-5 pr-1">$</small>
                                    <span>429</span>
                                    <small class="text-warning pl-2">
                                      <i class="fa fa-dot-circle"></i>
                                    </small>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="widget-content p-0">
                              <div class="widget-content-wrapper">
                                <div class="widget-content-left mr-3">
                                  <img width="42" class="rounded-circle" src="assets/images/avatars/3.jpg" alt="">
                                </div>
                                <div class="widget-content-left">
                                  <div class="widget-heading">Ella-Rose Henry</div>
                                  <div class="widget-subheading">Web Developer</div>
                                </div>
                                <div class="widget-content-right">
                                  <div class="font-size-xlg text-muted">
                                    <small class="opacity-5 pr-1">$</small>
                                    <span>129</span>
                                    <small class="text-danger pl-2">
                                      <i class="fa fa-angle-down"></i>
                                    </small>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="widget-content p-0">
                              <div class="widget-content-wrapper">
                                <div class="widget-content-left mr-3">
                                  <img width="42" class="rounded-circle" src="assets/images/avatars/2.jpg" alt="">
                                </div>
                                <div class="widget-content-left">
                                  <div class="widget-heading">Ruben Tillman</div>
                                  <div class="widget-subheading">UI Designer</div>
                                </div>
                                <div class="widget-content-right">
                                  <div class="font-size-xlg text-muted">
                                    <small class="opacity-5 pr-1">$</small>
                                    <span>54</span>
                                    <small class="text-success pl-2">
                                      <i class="fa fa-angle-up"></i>
                                    </small>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12 col-lg-6">
            <div class="mb-3 card">
              <div class="card-header-tab card-header">
                <div class="card-header-title">
                  <i class="header-icon lnr-rocket icon-gradient bg-tempting-azure"> </i>
                  Bandwidth Reports
                </div>
                <div class="btn-actions-pane-right">
                  <div class="nav">
                    <a href="javascript:void(0);" class="border-0 btn-pill btn-wide btn-transition active btn btn-outline-alternate">Tab 1</a>
                    <a href="javascript:void(0);" class="ml-1 btn-pill btn-wide border-0 btn-transition  btn btn-outline-alternate second-tab-toggle-alt">Tab 2</a>
                  </div>
                </div>
              </div>
              <div class="tab-content">
                <div class="tab-pane fade active show" id="tab-eg-55">
                  <div class="widget-chart p-3">
                    <div style="height: 350px">
                      <canvas id="line-chart"></canvas>
                    </div>
                    <div class="widget-chart-content text-center mt-5">
                      <div class="widget-description mt-0 text-warning">
                        <i class="fa fa-arrow-left"></i>
                        <span class="pl-1">175.5%</span>
                        <span class="text-muted opacity-8 pl-1">increased server resources</span>
                      </div>
                    </div>
                  </div>
                  <div class="pt-2 card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="widget-content">
                          <div class="widget-content-outer">
                            <div class="widget-content-wrapper">
                              <div class="widget-content-left">
                                <div class="widget-numbers fsize-3 text-muted">63%</div>
                              </div>
                              <div class="widget-content-right">
                                <div class="text-muted opacity-6">Generated Leads</div>
                              </div>
                            </div>
                            <div class="widget-progress-wrapper mt-1">
                              <div class="progress-bar-sm progress-bar-animated-alt progress">
                                <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="63" aria-valuemin="0" aria-valuemax="100" style="width: 63%;"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="widget-content">
                          <div class="widget-content-outer">
                            <div class="widget-content-wrapper">
                              <div class="widget-content-left">
                                <div class="widget-numbers fsize-3 text-muted">32%</div>
                              </div>
                              <div class="widget-content-right">
                                <div class="text-muted opacity-6">Submitted Tickers</div>
                              </div>
                            </div>
                            <div class="widget-progress-wrapper mt-1">
                              <div class="progress-bar-sm progress-bar-animated-alt progress">
                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="32" aria-valuemin="0" aria-valuemax="100" style="width: 32%;"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="widget-content">
                          <div class="widget-content-outer">
                            <div class="widget-content-wrapper">
                              <div class="widget-content-left">
                                <div class="widget-numbers fsize-3 text-muted">71%</div>
                              </div>
                              <div class="widget-content-right">
                                <div class="text-muted opacity-6">Server Allocation</div>
                              </div>
                            </div>
                            <div class="widget-progress-wrapper mt-1">
                              <div class="progress-bar-sm progress-bar-animated-alt progress">
                                <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="71" aria-valuemin="0" aria-valuemax="100" style="width: 71%;"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="widget-content">
                          <div class="widget-content-outer">
                            <div class="widget-content-wrapper">
                              <div class="widget-content-left">
                                <div class="widget-numbers fsize-3 text-muted">41%</div>
                              </div>
                              <div class="widget-content-right">
                                <div class="text-muted opacity-6">Generated Leads</div>
                              </div>
                            </div>
                            <div class="widget-progress-wrapper mt-1">
                              <div class="progress-bar-sm progress-bar-animated-alt progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="41" aria-valuemin="0" aria-valuemax="100" style="width: 41%;"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content">
              <div class="widget-content-outer">
                <div class="widget-content-wrapper">
                  <div class="widget-content-left">
                    <div class="widget-heading">Total Orders</div>
                    <div class="widget-subheading">Last year expenses</div>
                  </div>
                  <div class="widget-content-right">
                    <div class="widget-numbers text-success">1896</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content">
              <div class="widget-content-outer">
                <div class="widget-content-wrapper">
                  <div class="widget-content-left">
                    <div class="widget-heading">Products Sold</div>
                    <div class="widget-subheading">Revenue streams</div>
                  </div>
                  <div class="widget-content-right">
                    <div class="widget-numbers text-warning">$3M</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content">
              <div class="widget-content-outer">
                <div class="widget-content-wrapper">
                  <div class="widget-content-left">
                    <div class="widget-heading">Followers</div>
                    <div class="widget-subheading">People Interested</div>
                  </div>
                  <div class="widget-content-right">
                    <div class="widget-numbers text-danger">45,9%</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="d-xl-none d-lg-block col-md-6 col-xl-4">
            <div class="card mb-3 widget-content">
              <div class="widget-content-outer">
                <div class="widget-content-wrapper">
                  <div class="widget-content-left">
                    <div class="widget-heading">Income</div>
                    <div class="widget-subheading">Expected totals</div>
                  </div>
                  <div class="widget-content-right">
                    <div class="widget-numbers text-focus">$147</div>
                  </div>
                </div>
                <div class="widget-progress-wrapper">
                  <div class="progress-bar-sm progress-bar-animated-alt progress">
                    <div class="progress-bar bg-info" role="progressbar" aria-valuenow="54" aria-valuemin="0" aria-valuemax="100" style="width: 54%;"></div>
                  </div>
                  <div class="progress-sub-label">
                    <div class="sub-label-left">Expenses</div>
                    <div class="sub-label-right">100%</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="main-card mb-3 card">
              <div class="card-header">Active Users
                <div class="btn-actions-pane-right">
                  <div role="group" class="btn-group-sm btn-group">
                    <button class="active btn btn-focus">Last Week</button>
                    <button class="btn btn-focus">All Month</button>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th>Name</th>
                      <th class="text-center">City</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-center text-muted">#345</td>
                      <td>
                        <div class="widget-content p-0">
                          <div class="widget-content-wrapper">
                            <div class="widget-content-left mr-3">
                              <div class="widget-content-left">
                                <img width="40" class="rounded-circle" src="assets/images/avatars/4.jpg" alt="">
                              </div>
                            </div>
                            <div class="widget-content-left flex2">
                              <div class="widget-heading">John Doe</div>
                              <div class="widget-subheading opacity-7">Web Developer</div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td class="text-center">Madrid</td>
                      <td class="text-center">
                        <div class="badge badge-warning">Pending</div>
                      </td>
                      <td class="text-center">
                        <button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm">Details</button>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-center text-muted">#347</td>
                      <td>
                        <div class="widget-content p-0">
                          <div class="widget-content-wrapper">
                            <div class="widget-content-left mr-3">
                              <div class="widget-content-left">
                                <img width="40" class="rounded-circle" src="assets/images/avatars/3.jpg" alt="">
                              </div>
                            </div>
                            <div class="widget-content-left flex2">
                              <div class="widget-heading">Ruben Tillman</div>
                              <div class="widget-subheading opacity-7">Etiam sit amet orci eget</div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td class="text-center">Berlin</td>
                      <td class="text-center">
                        <div class="badge badge-success">Completed</div>
                      </td>
                      <td class="text-center">
                        <button type="button" id="PopoverCustomT-2" class="btn btn-primary btn-sm">Details</button>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-center text-muted">#321</td>
                      <td>
                        <div class="widget-content p-0">
                          <div class="widget-content-wrapper">
                            <div class="widget-content-left mr-3">
                              <div class="widget-content-left">
                                <img width="40" class="rounded-circle" src="assets/images/avatars/2.jpg" alt="">
                              </div>
                            </div>
                            <div class="widget-content-left flex2">
                              <div class="widget-heading">Elliot Huber</div>
                              <div class="widget-subheading opacity-7">Lorem ipsum dolor sic</div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td class="text-center">London</td>
                      <td class="text-center">
                        <div class="badge badge-danger">In Progress</div>
                      </td>
                      <td class="text-center">
                        <button type="button" id="PopoverCustomT-3" class="btn btn-primary btn-sm">Details</button>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-center text-muted">#55</td>
                      <td>
                        <div class="widget-content p-0">
                          <div class="widget-content-wrapper">
                            <div class="widget-content-left mr-3">
                              <div class="widget-content-left">
                                <img width="40" class="rounded-circle" src="assets/images/avatars/1.jpg" alt="">
                              </div>
                            </div>
                            <div class="widget-content-left flex2">
                              <div class="widget-heading">Vinnie Wagstaff</div>
                              <div class="widget-subheading opacity-7">UI Designer</div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td class="text-center">Amsterdam</td>
                      <td class="text-center">
                        <div class="badge badge-info">On Hold</div>
                      </td>
                      <td class="text-center">
                        <button type="button" id="PopoverCustomT-4" class="btn btn-primary btn-sm">Details</button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="d-block text-center card-footer">
                <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i class="pe-7s-trash btn-icon-wrapper"> </i></button>
                <button class="btn-wide btn btn-success">Save</button>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 col-lg-3">
            <div class="card-shadow-danger mb-3 widget-chart widget-chart2 text-left card">
              <div class="widget-content">
                <div class="widget-content-outer">
                  <div class="widget-content-wrapper">
                    <div class="widget-content-left pr-2 fsize-1">
                      <div class="widget-numbers mt-0 fsize-3 text-danger">71%</div>
                    </div>
                    <div class="widget-content-right w-100">
                      <div class="progress-bar-xs progress">
                        <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="71" aria-valuemin="0" aria-valuemax="100" style="width: 71%;"></div>
                      </div>
                    </div>
                  </div>
                  <div class="widget-content-left fsize-1">
                    <div class="text-muted opacity-6">Income Target</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="card-shadow-success mb-3 widget-chart widget-chart2 text-left card">
              <div class="widget-content">
                <div class="widget-content-outer">
                  <div class="widget-content-wrapper">
                    <div class="widget-content-left pr-2 fsize-1">
                      <div class="widget-numbers mt-0 fsize-3 text-success">54%</div>
                    </div>
                    <div class="widget-content-right w-100">
                      <div class="progress-bar-xs progress">
                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="54" aria-valuemin="0" aria-valuemax="100" style="width: 54%;"></div>
                      </div>
                    </div>
                  </div>
                  <div class="widget-content-left fsize-1">
                    <div class="text-muted opacity-6">Expenses Target</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="card-shadow-warning mb-3 widget-chart widget-chart2 text-left card">
              <div class="widget-content">
                <div class="widget-content-outer">
                  <div class="widget-content-wrapper">
                    <div class="widget-content-left pr-2 fsize-1">
                      <div class="widget-numbers mt-0 fsize-3 text-warning">32%</div>
                    </div>
                    <div class="widget-content-right w-100">
                      <div class="progress-bar-xs progress">
                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="32" aria-valuemin="0" aria-valuemax="100" style="width: 32%;"></div>
                      </div>
                    </div>
                  </div>
                  <div class="widget-content-left fsize-1">
                    <div class="text-muted opacity-6">Spendings Target</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="card-shadow-info mb-3 widget-chart widget-chart2 text-left card">
              <div class="widget-content">
                <div class="widget-content-outer">
                  <div class="widget-content-wrapper">
                    <div class="widget-content-left pr-2 fsize-1">
                      <div class="widget-numbers mt-0 fsize-3 text-info">89%</div>
                    </div>
                    <div class="widget-content-right w-100">
                      <div class="progress-bar-xs progress">
                        <div class="progress-bar bg-info" role="progressbar" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100" style="width: 89%;"></div>
                      </div>
                    </div>
                  </div>
                  <div class="widget-content-left fsize-1">
                    <div class="text-muted opacity-6">Totals Target</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
  </div>
</div><br><br><br>


<!-- <div class="content-wrapper" style="background-color: rgba(255, 206, 213, 0.18)">
   
    <div class="content-header">
      <div class="container-fluid">
        <div style="height: 100%;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;">
        <img src="{{'img/employees.jpg'}}" width="900px" alt="">
        </div>   
      </div>
    </div>
  </div> -->

<!-- Fahad End Employee Module -->

@elseif($current_module->module_status == 3) <!--inventory module-->

<!-- Fahad Start Inventory Module -->

<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>150</h3>

                <p>New Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>

                <p>Bounce Rate</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>44</h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Sales
                </h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                    </li>
                  </ul>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
                  <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                    <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                  </div>
                  <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                    <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                  </div>
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- DIRECT CHAT -->
            <div class="card direct-chat direct-chat-primary">
              <div class="card-header">
                <h3 class="card-title">Direct Chat</h3>

                <div class="card-tools">
                  <span title="3 New Messages" class="badge badge-primary">3</span>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">
                    <i class="fas fa-comments"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- Conversations are loaded here -->
                <div class="direct-chat-messages">
                  <!-- Message. Default to the left -->
                  <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-left">Alexander Pierce</span>
                      <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                      Is this template really for free? That's unbelievable!
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  <!-- /.direct-chat-msg -->

                  <!-- Message to the right -->
                  <div class="direct-chat-msg right">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-right">Sarah Bullock</span>
                      <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img" src="dist/img/user3-128x128.jpg" alt="message user image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                      You better believe it!
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  <!-- /.direct-chat-msg -->

                  <!-- Message. Default to the left -->
                  <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-left">Alexander Pierce</span>
                      <span class="direct-chat-timestamp float-right">23 Jan 5:37 pm</span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                      Working with AdminLTE on a great new app! Wanna join?
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  <!-- /.direct-chat-msg -->

                  <!-- Message to the right -->
                  <div class="direct-chat-msg right">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-right">Sarah Bullock</span>
                      <span class="direct-chat-timestamp float-left">23 Jan 6:10 pm</span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img" src="dist/img/user3-128x128.jpg" alt="message user image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                      I would love to.
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  <!-- /.direct-chat-msg -->

                </div>
                <!--/.direct-chat-messages-->

                <!-- Contacts are loaded here -->
                <div class="direct-chat-contacts">
                  <ul class="contacts-list">
                    <li>
                      <a href="#">
                        <img class="contacts-list-img" src="dist/img/user1-128x128.jpg" alt="User Avatar">

                        <div class="contacts-list-info">
                          <span class="contacts-list-name">
                            Count Dracula
                            <small class="contacts-list-date float-right">2/28/2015</small>
                          </span>
                          <span class="contacts-list-msg">How have you been? I was...</span>
                        </div>
                        <!-- /.contacts-list-info -->
                      </a>
                    </li>
                    <!-- End Contact Item -->
                    <li>
                      <a href="#">
                        <img class="contacts-list-img" src="dist/img/user7-128x128.jpg" alt="User Avatar">

                        <div class="contacts-list-info">
                          <span class="contacts-list-name">
                            Sarah Doe
                            <small class="contacts-list-date float-right">2/23/2015</small>
                          </span>
                          <span class="contacts-list-msg">I will be waiting for...</span>
                        </div>
                        <!-- /.contacts-list-info -->
                      </a>
                    </li>
                    <!-- End Contact Item -->
                    <li>
                      <a href="#">
                        <img class="contacts-list-img" src="dist/img/user3-128x128.jpg" alt="User Avatar">

                        <div class="contacts-list-info">
                          <span class="contacts-list-name">
                            Nadia Jolie
                            <small class="contacts-list-date float-right">2/20/2015</small>
                          </span>
                          <span class="contacts-list-msg">I'll call you back at...</span>
                        </div>
                        <!-- /.contacts-list-info -->
                      </a>
                    </li>
                    <!-- End Contact Item -->
                    <li>
                      <a href="#">
                        <img class="contacts-list-img" src="dist/img/user5-128x128.jpg" alt="User Avatar">

                        <div class="contacts-list-info">
                          <span class="contacts-list-name">
                            Nora S. Vans
                            <small class="contacts-list-date float-right">2/10/2015</small>
                          </span>
                          <span class="contacts-list-msg">Where is your new...</span>
                        </div>
                        <!-- /.contacts-list-info -->
                      </a>
                    </li>
                    <!-- End Contact Item -->
                    <li>
                      <a href="#">
                        <img class="contacts-list-img" src="dist/img/user6-128x128.jpg" alt="User Avatar">

                        <div class="contacts-list-info">
                          <span class="contacts-list-name">
                            John K.
                            <small class="contacts-list-date float-right">1/27/2015</small>
                          </span>
                          <span class="contacts-list-msg">Can I take a look at...</span>
                        </div>
                        <!-- /.contacts-list-info -->
                      </a>
                    </li>
                    <!-- End Contact Item -->
                    <li>
                      <a href="#">
                        <img class="contacts-list-img" src="dist/img/user8-128x128.jpg" alt="User Avatar">

                        <div class="contacts-list-info">
                          <span class="contacts-list-name">
                            Kenneth M.
                            <small class="contacts-list-date float-right">1/4/2015</small>
                          </span>
                          <span class="contacts-list-msg">Never mind I found...</span>
                        </div>
                        <!-- /.contacts-list-info -->
                      </a>
                    </li>
                    <!-- End Contact Item -->
                  </ul>
                  <!-- /.contacts-list -->
                </div>
                <!-- /.direct-chat-pane -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <form action="#" method="post">
                  <div class="input-group">
                    <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                    <span class="input-group-append">
                      <button type="button" class="btn btn-primary">Send</button>
                    </span>
                  </div>
                </form>
              </div>
              <!-- /.card-footer-->
            </div>
            <!--/.direct-chat -->

            <!-- TO DO List -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  To Do List
                </h3>

                <div class="card-tools">
                  <ul class="pagination pagination-sm">
                    <li class="page-item"><a href="#" class="page-link">&laquo;</a></li>
                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">&raquo;</a></li>
                  </ul>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <ul class="todo-list" data-widget="todo-list">
                  <li>
                    <!-- drag handle -->
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <!-- checkbox -->
                    <div class="icheck-primary d-inline ml-2">
                      <input type="checkbox" value="" name="todo1" id="todoCheck1">
                      <label for="todoCheck1"></label>
                    </div>
                    <!-- todo text -->
                    <span class="text">Design a nice theme</span>
                    <!-- Emphasis label -->
                    <small class="badge badge-danger"><i class="far fa-clock"></i> 2 mins</small>
                    <!-- General tools such as edit or delete-->
                    <div class="tools">
                      <i class="fas fa-edit"></i>
                      <i class="fas fa-trash-o"></i>
                    </div>
                  </li>
                  <li>
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <div class="icheck-primary d-inline ml-2">
                      <input type="checkbox" value="" name="todo2" id="todoCheck2" checked>
                      <label for="todoCheck2"></label>
                    </div>
                    <span class="text">Make the theme responsive</span>
                    <small class="badge badge-info"><i class="far fa-clock"></i> 4 hours</small>
                    <div class="tools">
                      <i class="fas fa-edit"></i>
                      <i class="fas fa-trash-o"></i>
                    </div>
                  </li>
                  <li>
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <div class="icheck-primary d-inline ml-2">
                      <input type="checkbox" value="" name="todo3" id="todoCheck3">
                      <label for="todoCheck3"></label>
                    </div>
                    <span class="text">Let theme shine like a star</span>
                    <small class="badge badge-warning"><i class="far fa-clock"></i> 1 day</small>
                    <div class="tools">
                      <i class="fas fa-edit"></i>
                      <i class="fas fa-trash-o"></i>
                    </div>
                  </li>
                  <li>
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <div class="icheck-primary d-inline ml-2">
                      <input type="checkbox" value="" name="todo4" id="todoCheck4">
                      <label for="todoCheck4"></label>
                    </div>
                    <span class="text">Let theme shine like a star</span>
                    <small class="badge badge-success"><i class="far fa-clock"></i> 3 days</small>
                    <div class="tools">
                      <i class="fas fa-edit"></i>
                      <i class="fas fa-trash-o"></i>
                    </div>
                  </li>
                  <li>
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <div class="icheck-primary d-inline ml-2">
                      <input type="checkbox" value="" name="todo5" id="todoCheck5">
                      <label for="todoCheck5"></label>
                    </div>
                    <span class="text">Check your messages and notifications</span>
                    <small class="badge badge-primary"><i class="far fa-clock"></i> 1 week</small>
                    <div class="tools">
                      <i class="fas fa-edit"></i>
                      <i class="fas fa-trash-o"></i>
                    </div>
                  </li>
                  <li>
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <div class="icheck-primary d-inline ml-2">
                      <input type="checkbox" value="" name="todo6" id="todoCheck6">
                      <label for="todoCheck6"></label>
                    </div>
                    <span class="text">Let theme shine like a star</span>
                    <small class="badge badge-secondary"><i class="far fa-clock"></i> 1 month</small>
                    <div class="tools">
                      <i class="fas fa-edit"></i>
                      <i class="fas fa-trash-o"></i>
                    </div>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <button type="button" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add item</button>
              </div>
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">

            <!-- Map card -->
            <div class="card bg-gradient-primary">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-map-marker-alt mr-1"></i>
                  Visitors
                </h3>
                <!-- card tools -->
                <div class="card-tools">
                  <button type="button" class="btn btn-primary btn-sm daterange" title="Date range">
                    <i class="far fa-calendar-alt"></i>
                  </button>
                  <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <div class="card-body">
                <div id="world-map" style="height: 250px; width: 100%;"></div>
              </div>
              <!-- /.card-body-->
              <div class="card-footer bg-transparent">
                <div class="row">
                  <div class="col-4 text-center">
                    <div id="sparkline-1"></div>
                    <div class="text-white">Visitors</div>
                  </div>
                  <!-- ./col -->
                  <div class="col-4 text-center">
                    <div id="sparkline-2"></div>
                    <div class="text-white">Online</div>
                  </div>
                  <!-- ./col -->
                  <div class="col-4 text-center">
                    <div id="sparkline-3"></div>
                    <div class="text-white">Sales</div>
                  </div>
                  <!-- ./col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.card -->

            <!-- solid sales graph -->
            <div class="card bg-gradient-info">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-th mr-1"></i>
                  Sales Graph
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
              <div class="card-footer bg-transparent">
                <div class="row">
                  <div class="col-4 text-center">
                    <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60" data-fgColor="#39CCCC">

                    <div class="text-white">Mail-Orders</div>
                  </div>
                  <!-- ./col -->
                  <div class="col-4 text-center">
                    <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60" data-fgColor="#39CCCC">

                    <div class="text-white">Online</div>
                  </div>
                  <!-- ./col -->
                  <div class="col-4 text-center">
                    <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60" data-fgColor="#39CCCC">

                    <div class="text-white">In-Store</div>
                  </div>
                  <!-- ./col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->

            <!-- Calendar -->
            <div class="card bg-gradient-success">
              <div class="card-header border-0">

                <h3 class="card-title">
                  <i class="far fa-calendar-alt"></i>
                  Calendar
                </h3>
                <!-- tools card -->
                <div class="card-tools">
                  <!-- button with a dropdown -->
                  <div class="btn-group">
                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                      <i class="fas fa-bars"></i>
                    </button>
                    <div class="dropdown-menu" role="menu">
                      <a href="#" class="dropdown-item">Add new event</a>
                      <a href="#" class="dropdown-item">Clear events</a>
                      <div class="dropdown-divider"></div>
                      <a href="#" class="dropdown-item">View calendar</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /. tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body pt-0">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</div>


<!-- <div class="content-wrapper" style="background-color: rgba(202, 255, 214, 0.34)">
    <div class="content-header">
      <div class="container-fluid">
        <div style="height: 100%;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;">
        <img src="{{'img/inventory.jpg'}}" width="700px" alt="">
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid"> 
      </div>
    </section>
  </div> -->


<!-- Fahad End Inventory Module -->



@else
<!--pos module-->

<!-- Fahad Start POS Module -->

<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Point Of Sale</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">POS</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Online Store Visitors</h3>
                  <a href="javascript:void(0);">View Report</a>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg">820</span>
                    <span>Visitors Over Time</span>
                  </p>
                  <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                      <i class="fas fa-arrow-up"></i> 12.5%
                    </span>
                    <span class="text-muted">Since last week</span>
                  </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="visitors-chart" height="200"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> This Week
                  </span>

                  <span>
                    <i class="fas fa-square text-gray"></i> Last Week
                  </span>
                </div>
              </div>
            </div>
            <!-- /.card -->

            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Products</h3>
                <div class="card-tools">
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-download"></i>
                  </a>
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-bars"></i>
                  </a>
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                    <tr>
                      <th>Product</th>
                      <th>Price</th>
                      <th>Sales</th>
                      <th>More</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                        Some Product
                      </td>
                      <td>$13 USD</td>
                      <td>
                        <small class="text-success mr-1">
                          <i class="fas fa-arrow-up"></i>
                          12%
                        </small>
                        12,000 Sold
                      </td>
                      <td>
                        <a href="#" class="text-muted">
                          <i class="fas fa-search"></i>
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                        Another Product
                      </td>
                      <td>$29 USD</td>
                      <td>
                        <small class="text-warning mr-1">
                          <i class="fas fa-arrow-down"></i>
                          0.5%
                        </small>
                        123,234 Sold
                      </td>
                      <td>
                        <a href="#" class="text-muted">
                          <i class="fas fa-search"></i>
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                        Amazing Product
                      </td>
                      <td>$1,230 USD</td>
                      <td>
                        <small class="text-danger mr-1">
                          <i class="fas fa-arrow-down"></i>
                          3%
                        </small>
                        198 Sold
                      </td>
                      <td>
                        <a href="#" class="text-muted">
                          <i class="fas fa-search"></i>
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                        Perfect Item
                        <span class="badge bg-danger">NEW</span>
                      </td>
                      <td>$199 USD</td>
                      <td>
                        <small class="text-success mr-1">
                          <i class="fas fa-arrow-up"></i>
                          63%
                        </small>
                        87 Sold
                      </td>
                      <td>
                        <a href="#" class="text-muted">
                          <i class="fas fa-search"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Sales</h3>
                  <a href="javascript:void(0);">View Report</a>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg">$18,230.00</span>
                    <span>Sales Over Time</span>
                  </p>
                  <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                      <i class="fas fa-arrow-up"></i> 33.1%
                    </span>
                    <span class="text-muted">Since last month</span>
                  </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="sales-chart" height="200"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> This year
                  </span>

                  <span>
                    <i class="fas fa-square text-gray"></i> Last year
                  </span>
                </div>
              </div>
            </div>
            <!-- /.card -->

            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Online Store Overview</h3>
                <div class="card-tools">
                  <a href="#" class="btn btn-sm btn-tool">
                    <i class="fas fa-download"></i>
                  </a>
                  <a href="#" class="btn btn-sm btn-tool">
                    <i class="fas fa-bars"></i>
                  </a>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                  <p class="text-success text-xl">
                    <i class="ion ion-ios-refresh-empty"></i>
                  </p>
                  <p class="d-flex flex-column text-right">
                    <span class="font-weight-bold">
                      <i class="ion ion-android-arrow-up text-success"></i> 12%
                    </span>
                    <span class="text-muted">CONVERSION RATE</span>
                  </p>
                </div>
                <!-- /.d-flex -->
                <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                  <p class="text-warning text-xl">
                    <i class="ion ion-ios-cart-outline"></i>
                  </p>
                  <p class="d-flex flex-column text-right">
                    <span class="font-weight-bold">
                      <i class="ion ion-android-arrow-up text-warning"></i> 0.8%
                    </span>
                    <span class="text-muted">SALES RATE</span>
                  </p>
                </div>
                <!-- /.d-flex -->
                <div class="d-flex justify-content-between align-items-center mb-0">
                  <p class="text-danger text-xl">
                    <i class="ion ion-ios-people-outline"></i>
                  </p>
                  <p class="d-flex flex-column text-right">
                    <span class="font-weight-bold">
                      <i class="ion ion-android-arrow-down text-danger"></i> 1%
                    </span>
                    <span class="text-muted">REGISTRATION RATE</span>
                  </p>
                </div>
                <!-- /.d-flex -->
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
</div>


<!-- <div class="content-wrapper" style="background-color: rgba(185, 245, 255, 0.25)">
    <div class="content-header">
      <div class="container-fluid">
        <div style="height: 100%;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;">
        <img src="{{'img/pos.jpg'}}" width="700px" alt="">
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">  
      </div>
    </section>
  </div> -->

@endif
@else
@php
$redirectRoute = route('login');
header("Location: $redirectRoute");
exit();
@endphp
@endif

@endsection


<!-- Fahad End POS Module -->