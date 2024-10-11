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
            
            <div class="col-12">
                <br>
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Asset List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>Serial No.</th>
                          <th>Shop Name</th>
                          <th>Branch Name</th>
                          <th>Department Name</th>
                          <th>Asset Name</th>
                          <th>Asset Type</th>
                          <th>Purchase Date</th>
                          <th>Purchase Cost</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php $i = 1 @endphp
                            @foreach($assets as $asset)
                        <tr>
                          <td>{{$i++}}</td>
                          <td>{{$asset->company_name}}</td>
                          <td>{{$asset->branch_name}}</td>
                          <td>{{$asset->department_name}}</td>
                          <td>{{$asset->asset_name}}</td>
                          <td>{{$asset->asset_type}}</td>
                          <td>{{$asset->purchase_date}}</td>
                          <td>{{$asset->cost}}</td>
                          <td> 
                            @if(($asset->status) == 1)
                            <span class="badge badge-success">Active</span>
                            @elseif(($asset->status) == 2)
                            <span class="badge badge-warning">Inactive</span>
                            @elseif(($asset->status) == 3)
                            <span class="badge badge-primary">Maintainance</span>
                           @else
                           <span class="badge badge-danger">Damaged</span>
                           @endif
                         </td>
                          <td>
                            <a href="{{route('edit_asset', $asset->id)}}" style="color: white"><button class="btn btn-outline-primary"><i class="fa-solid fa-pen-to-square"></i> Edit</button></a>
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