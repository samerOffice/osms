<div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="app-main">
            <div class="app-main__inner">
            <div class="app-page-title">
              <div class="page-title-wrapper">
                <div class="page-title-heading">
                  <div class="page-title-icon">
                    <span><img src="{{ asset('dist/img/emp.png') }}" width="35px" alt="logo"></span>
                  </div>
                  <div>Inventory Dashboard
                    <div class="page-title-subheading"> An Inventory Management System simplifies logistics processes by automating stock tracking, order management, and inventory data handling.
                    </div>
                  </div>
                </div>      
              </div>
            </div>
              </div>
              </div>

            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Inventory</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
  
      <!-- Main content -->
      <section class="content" style="margin-top: -2%">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-4">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>150</h3>
  
                  <p>Total Item Categories</p>
                </div>
                <div class="icon">
                  <i class="fa fa-layer-group"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-4">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>53<sup style="font-size: 20px">%</sup></h3>
  
                  <p>Total Product Categories</p>
                </div>
                <div class="icon">
                  <i class="ionicons ion-android-list"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-4">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>44</h3>
  
                  <p>Total Products</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
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
                <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title">Stock Chart</h3>
    
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <canvas id="sales-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                  <!-- /.card-body -->
                </div><!-- /.card-body -->
              
              <!-- /.card -->          
            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 connectedSortable">
              <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                  <div class="card-shadow-danger mb-3 widget-chart widget-chart2 text-left card">
                    <div class="widget-content">
                      <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                          <div class="widget-content-left pr-2 fsize-1">
                            <div class="widget-numbers mt-0 fsize-3 text-info">71%</div>
                          </div>
                          <div class="widget-content-right w-100">
                            <div class="progress-bar-xs progress">
                              <div class="progress-bar bg-info" role="progressbar" aria-valuenow="71" aria-valuemin="0" aria-valuemax="100" style="width: 71%;"></div>
                            </div>
                          </div>
                        </div>
                        <div class="widget-content-left fsize-1">
                          <div class="text-muted opacity-6">Available Products</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12">
                  <div class="card-shadow-success mb-3 widget-chart widget-chart2 text-left card">
                    <div class="widget-content">
                      <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                          <div class="widget-content-left pr-2 fsize-1">
                            <div class="widget-numbers mt-0 fsize-3 text-secondary">54%</div>
                          </div>
                          <div class="widget-content-right w-100">
                            <div class="progress-bar-xs progress">
                              <div class="progress-bar bg-secondary" role="progressbar" aria-valuenow="54" aria-valuemin="0" aria-valuemax="100" style="width: 54%;"></div>
                            </div>
                          </div>
                        </div>
                        <div class="widget-content-left fsize-1">
                          <div class="text-muted opacity-6">Near-Expired Products</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12">
                  <div class="card-shadow-warning mb-3 widget-chart widget-chart2 text-left card">
                    <div class="widget-content">
                      <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                          <div class="widget-content-left pr-2 fsize-1">
                            <div class="widget-numbers mt-0 fsize-3 text-danger">32%</div>
                          </div>
                          <div class="widget-content-right w-100">
                            <div class="progress-bar-xs progress">
                              <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="32" aria-valuemin="0" aria-valuemax="100" style="width: 32%;"></div>
                            </div>
                          </div>
                        </div>
                        <div class="widget-content-left fsize-1">
                          <div class="text-muted opacity-6">Damaged Products</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
              </div>
            </section>
            <!-- right col -->
          </div>
          <!-- /.row (main row) -->
         
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
  </div>