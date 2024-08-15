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
                    <div>POS Dashboard
                      <div class="page-title-subheading"> A Point of Sale (POS) Management System simplifies retail operations by automating sales transactions, inventory updates, and customer data management.
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
                <li class="breadcrumb-item active">POS</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
  
      <!-- Main content -->
      <div class="content" style="margin-top: -2%">
        <div class="container-fluid">
          <div class="row">
            
            <!-- /.col-md-6 -->
            <div class="col-md-8 col-sm-12">
              <div class="card">
                <div class="card-header border-0">
                  <div class="d-flex justify-content-between">
                    <h3 class="card-title">Sale vs Purchase</h3>                   
                  </div>
                </div>
                <div class="card-body">
                  <div class="position-relative mb-4">
                    <canvas id="sales-chart" height="200"></canvas>
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>

            <div class="col-md-4 col-sm-12">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header border-0" style="margin-bottom: -5%">
                      <h3 class="card-title">Top Seller of this month</h3>                     
                    </div>
                    <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center">
                        <p class="text-success text-xl">
                          {{-- <i class="ion ion-ios-people-outline"></i> --}}
                          <i class="ion ion-ios-person-outline" style="font-size: 50px"></i>
                        </p>
                        <p class="d-flex flex-column text-right">
                          <span class="font-weight-bold" style="font-size: 20px">{{$top_seller_name}}</span>
                          <span class="text-muted">{{$top_seller_designation}}</span>
                        
                          <span class="text-muted" style="margin-top: 10px; margin-bottom: -15px; font-size: 15px"><span style="color: blue">Maximum Selling Amount :</span> <span style="color: green">{{ number_format($max_selling_amount, 0) }} BDT</span></span>
                        </p>
                       
                      </div>
                      <!-- /.d-flex -->
                      
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="card">
                    <div class="card-header border-0" style="margin-bottom: -3%">
                      <h3 class="card-title">Top Selling Product of this month</h3>                     
                    </div>
                    <div class="card-body">
                     
                      <div class="d-flex justify-content-between align-items-center">
                        <p class="text-warning text-xl">
                          <i class="ion ion-ios-cart-outline" style="font-size: 50px"></i>
                        </p>
                        <p class="d-flex flex-column text-right">
                          <span class="font-weight-bold" style="font-size: 20px"> {{$top_selling_product_name}} </span>
                          <span class="text-muted"> <span style="color: blue">Description :</span> {{$top_selling_product_desc}}</span>
                        </p>
                      </div>
                      <!-- /.d-flex -->
                     
                    </div>
                  </div>
                </div>
                <div class="col-12"></div>
              </div>
             
            </div>
            <!-- /.col-md-6 -->

            <div class="col-12">
              <br>
              <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Sale List</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Serial No.</th>
                        <th>Date of Sale</th>
                        <th>Invoice Number</th>               
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                          @php $i = 1 @endphp
                          @foreach($sales as $sale)
                      <tr>
                        <td>{{$i++}}</td>
                        <td>{{$sale->invoice_date}}</td>
                        <td>{{$sale->invoice_track_id}}</td>
                       
                        <td>
                          <a href="{{route('invoice_show_data', $sale->id)}}" style="color: white"><button class="btn btn-outline-primary"><i class="fa-solid fa-eye"></i> Details</button></a>
                          {{-- <button class="btn btn-outline-danger" onclick="deleteOperation({{$sale->id}})"><i class="fa-solid fa-trash"></i> Delete</button> --}}
                        </td>
                      
                      </tr> 
                      @endforeach              
               
                      </tfoot>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
          </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
  </div>