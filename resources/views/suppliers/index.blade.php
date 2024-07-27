@extends('master')

@section('title')
Supplier
@endsection


@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>
        <div class="row">

          @if( (auth()->user()->role_id == 1) || (auth()->user()->role_id == 2))
          <div class="col-12">
            <a class="btn btn-outline-info float-right" href="{{route('add_supplier')}}">
                <i class="fas fa-plus"></i> Add Supplier
            </a>
          </div>
          @endif
           
          <div class="col-12">
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
                      <h3 class="card-title">Supplier List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>Serial No.</th>
                          <th>Supplier Name</th>
                          <th>Mobile Number</th>
                          {{-- <th>Official Address</th> --}}
                          <th>Active Status</th>                         
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php $i = 1 @endphp
                            @foreach($suppliers as $supplier)
                        <tr>
                          <td>{{$i++}}</td>
                          <td>{{$supplier->full_name}}</td>
                          <td>{{$supplier->mobile_number}}</td>
                          {{-- <td>{{$supplier->official_address}}</td> --}}
                          <td> 
                            @if(($supplier->active_status) == 1)
                            <span class="badge badge-success">Active</span>
                           @else
                           <span class="badge badge-danger">Inactive</span>
                           @endif
                         </td>
                         
                          <td>
                            <a href="{{route('edit_supplier',$supplier->id)}}" style="color: white"><button class="btn btn-outline-primary"><i class="fa-solid fa-pen-to-square"></i> Edit</button></a>
                            <button class="btn btn-outline-danger" onclick="deleteOperation({{$supplier->id}})"><i class="fa-solid fa-trash"></i> Delete</button>
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
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
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
            axios.post('/osms/api/delete_supplier/'+ row_id).then(response=>{
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