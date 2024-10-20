@extends('master')

@section('title')
Transaction List
@endsection

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>
        <div class="row">

          <div class="col-12">
            <a class="btn btn-outline-info float-right" href="{{route('add_balance_transaction')}}">
                <i class="fas fa-plus"></i> Add Transaction
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
                      <h3 class="card-title">Transaction List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>Serial No.</th>
                          <th>Shop Name</th>
                          <th>Transaction Date</th>
                          <th>Transaction Name</th>
                          <th>Transaction Type</th>
                          <th>Cost Type</th>
                          <th>Transaction Amount</th>
                          @if( (auth()->user()->role_id == 1) || (auth()->user()->role_id == 2))
                          <th>Action</th>
                          @endif
                        </tr>
                        </thead>
                        <tbody>
                            @php $i = 1 @endphp
                            @foreach($balance_transactions as $balance_transaction)
                        <tr>
                          <td>{{$i++}}</td>
                          <td>{{$balance_transaction->company_name}}</td>
                          <td>{{$balance_transaction->transaction_date}}</td>
                          <td>{{$balance_transaction->transaction_name}}</td>
                          <td>
                            @if(($balance_transaction->transaction_type) == 1)
                              Debit
                            @else
                              Credit
                            @endif
                          </td>

                          <td>
                            @if(($balance_transaction->cost_type) == 'A')
                            Asset
                            @elseif(($balance_transaction->cost_type) == 'L')
                            Liability
                            @else
                            Equity
                            @endif
                          </td>
                          <td>{{$balance_transaction->transaction_amount}}</td>
                         @if( (auth()->user()->role_id == 1) || (auth()->user()->role_id == 2))
                          <td>
                            <a href="{{route('edit_balance_transaction', $balance_transaction->id)}}" style="color: white"><button class="btn btn-outline-primary"><i class="fa-solid fa-pen-to-square"></i> Edit</button></a>
                            <button class="btn btn-outline-danger" onclick="deleteOperation({{$balance_transaction->id}})"><i class="fa-solid fa-trash"></i> Delete</button>
                          </td>
                          @endif
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
            axios.post('/api/delete_balance_transaction/'+ row_id).then(response=>{
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