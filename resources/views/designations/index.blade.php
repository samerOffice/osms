@extends('master')

@section('title')
Welcome
@endsection


@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>
        <div class="row">

          <div class="col-12">
            <a class="btn btn-outline-info float-right" href="{{route('add_designation')}}">
                <i class="fas fa-plus"></i> Add Designation
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
                      <h3 class="card-title">Department List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>Serial No.</th>
                          <th>Level</th>
                          <th>Designation Name</th>
                          @if( (auth()->user()->role_id == 1) || (auth()->user()->role_id == 2))
                          <th>Action</th>
                          @endif
                        </tr>
                        </thead>
                        <tbody>
                            @php $i = 1 @endphp
                            @foreach($designations as $designation)
                        <tr>
                          <td>{{$i++}}</td>
                          <td>
                            @if($designation->level == 1)
                            Managing Level
                            @elseif($designation->level == 2)
                            Operational Level
                            @else
                            Support Level
                            @endif
                          </td>
                          <td>{{$designation->designation_name}}</td>
                        
                          <td>
                            <a href="{{route('edit_designation',$designation->id)}}" style="color: white"><button class="btn btn-outline-primary"><i class="fa-solid fa-pen-to-square"></i> Edit</button></a> | 
                            <button class="btn btn-outline-danger" onclick="deleteOperation({{$designation->id}})"><i class="fa-solid fa-trash"></i> Delete</button>
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
            axios.post('/api/delete_designation/'+ row_id).then(response=>{
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