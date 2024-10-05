@extends('master')

@section('title')
Asset List
@endsection


@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>
        <div class="row">

          <div class="col-12">
            <a class="btn btn-outline-info float-right" href="{{route('add_asset')}}">
                <i class="fas fa-plus"></i> Add Asset
            </a>
          </div>
      
          <div class="col-12">
            <br>
            @if ($message = Session::get('success'))
            <div class="alert alert-info" role="alert">
              <div class="row">
                <div class="col-11">
                  {{ $message }}
                </div>
                <div class="col-1">
                  <button type="button" class=" btn btn-info" data-dismiss="alert" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                </div>
              </div>
            </div>
            @endif
        </div>
     
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
                            <button class="btn btn-outline-danger" onclick="deleteOperation({{$asset->id}})"><i class="fa-solid fa-trash"></i> Delete</button>
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
        <br>      
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  </div>

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

function deleteOperation(row_id)
    { 
      
      Swal.fire({
      title: 'Are you sure?',
      text: '',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes',
      cancelButtonText: 'Cancel'
    }).then((result) => {
      if (result.isConfirmed) {
       
            // Function to get CSRF token from meta tag
             function getCsrfToken() {
              return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
              }
            // Set up Axios defaults
            axios.defaults.withCredentials = true;
            axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

            axios.get('sanctum/csrf-cookie').then(response=>{
            axios.post('/api/delete_asset/'+ row_id).then(response=>{
              console.log(response);
              setTimeout(function() {
                  window.location.reload();
              }, 2000);
              Swal.fire({
                          icon: "success",
                          title: ''+ response.data.message,
                        });
                    return false;                   
              }).catch(error => Swal.fire({
                          icon: "error",
                          title: error.response.data.message,
                          }))
            });
      } else if (result.isDismissed) {
        Swal.fire('Cancelled', '', 'error');
      }
    });
    }
  </script>
  @endpush