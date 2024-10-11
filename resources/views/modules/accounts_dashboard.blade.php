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
                    <div>Accounts Dashboard
                      <div class="page-title-subheading">An Account Management System simplifies financial operations by automating account tracking, transaction management, and reporting. It helps in organizing customer accounts, handling billing and payments, and monitoring account balances.
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
                <li class="breadcrumb-item active">Accounts</li>
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
            <div class="col-4">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{ number_format($total_product_purchase_amt, 0) }} BDT</h3>
  
                  <p>Total Purchase in current month</p>
                </div>
                <div class="icon">
                  <i class="fa-solid fa-bangladeshi-taka-sign"></i>
                </div>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-4">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{ number_format($total_asset_purchase_amt, 0) }} BDT</h3>
  
                  <p>Total Asset Purchase in current month</p>
                </div>
                <div class="icon">
                  <i class="fa-solid fa-bangladeshi-taka-sign"></i>
                </div>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-4">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>{{ number_format($total_expense_amt, 0) }} BDT</h3>
  
                  <p>Total Expense in current month</p>
                </div>
                <div class="icon">
                  <i class="fa-solid fa-bangladeshi-taka-sign"></i>
                </div>
              </div>
            </div>
            <!-- ./col -->       
          </div>

          <div class="row">
          
            <!-- sale list (start)-->

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
          <!-- sale list (end)-->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
  </div>