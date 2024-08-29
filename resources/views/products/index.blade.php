@extends('master')

@section('title')
Product List
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
              <a class="btn btn-outline-info float-right" href="{{route('add_product')}}">
                  <i class="fas fa-plus"></i> Add Product
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
                          <h3 class="card-title">Product List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                              <th>Sl.</th>
                              <th>Item Category</th>
                              <th>Product Category</th>
                              <th>Product Name</th>
                              {{-- <th>Tag Number</th> --}}
                              <th>Weight</th>
                              <th>Unit</th>
                              <th>Status</th>
                              {{-- @if((auth()->user()->role_id == 1) || (auth()->user()->role_id == 2)) --}}
                              <th>Action</th>
                              {{-- @endif --}}
                            </tr>
                            </thead>
                            <tbody>
                                @php $i = 1 @endphp
                                @foreach($products as $product)
                            <tr>
                              <td>{{$i++}}</td>
                              <td>{{$product->item_category_name}}</td>               
                              <td>{{$product->product_category_name}}</td>                
                              <td>{{$product->product_name}}</td> 
                              {{-- <td>{{$product->product_tag_number}}</td>--}}
                              <td>{{$product->product_weight}}</td>
                              <td>{{$product->product_unit_type}}</td>                             
                              <td>
                              @if($product->product_status == 1)
                              <h5><span class="badge badge-success">Available</span></h5>                        
                              @elseif($product->product_status == 2)
                              <h5><span class="badge badge-secondary">Not Available</span></h5>   
                              @else
                              <h5><span class="badge badge-danger">Damaged</span></h5>
                              @endif
                              </td>                             
          
                              {{-- @if( (auth()->user()->role_id == 1) || (auth()->user()->role_id == 2)) --}}
                              
                                <td>
                                  <a href="{{route('edit_product',$product->id)}}" style="color: white"><button class="btn btn-primary"> <i class="fa-solid fa-pen-to-square"></i>Edit</button></a>
                                  <button class="btn btn-outline-danger" onclick="deleteOperation({{$product->id}})"><i class="fa-solid fa-trash"></i> Delete</button>
                                </td>
                                                         
                              {{-- @endif --}}

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
            axios.post('/api/delete_product/'+ row_id).then(response=>{
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