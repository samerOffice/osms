@extends('master')

@section('title')
Supplier Due List
@endsection


@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>
        <div class="row">
            <div class="col-12">
                <a class="btn btn-outline-info float-right" href="{{route('supplier_due_list')}}">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
            
          <div class="col-12">
            <br>
            <div class="card">
                <div class="card-header">
                    <h5>Supplier Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <p><label for="">Supplier Name :</label> {{$supplier_details->full_name}}</p>
                        </div>
                        <div class="col-md-6 col-sm-12">
                           <p><label for="">Mobile Number :</label> {{$supplier_details->mobile_number}}</p>
                        </div>
                        <div class="col-md-6 col-sm-12">
                           <p><label for="">Total Due Amount (BDT) :</label> <span style="color:red">{{$total_due_amount->total_due}} </span></p>
                        </div>
                    </div>
                  
                </div>
            </div>
           
          </div>
     
            <div class="col-12">
               
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Due List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>Serial No.</th>
                          <th>Purchase Date</th>
                          <th>Order Number</th>         
                          <th>Due (BDT)</th>                
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php $i = 1 @endphp
                            @foreach($due_details as $due)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$due->requisition_order_date}}</td>
                                <td><a href="{{route('requisition_view', $due->id)}}" target="_blank">{{$due->requisition_order_id}}</a></td>
                                <td>{{$due->due_amount}}</td>                        
                                <td>
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default-{{$due->id}}" style="margin-right: 5px;">
                                        Clear Due
                                    </button>
                                </td>
                            </tr>
                        
                            {{-- Clear Due Modal --}}
                            <div class="modal fade" id="modal-default-{{$due->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" align="center">Clear Due</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="post" action="{{route('supplier_due_clear')}}" onsubmit="return validateClearAmount({{$due->due_amount}}, 'clear_due_amount_{{$due->id}}')">
                                            @csrf
                                            <div class="modal-body">
                                                <label for="">Due Amount: <span style="color: red">{{$due->due_amount}} BDT</span></label><br>
                                                
                                                <label class="">Clear Amount</label><br>
                                                <input type="text" id="clear_due_amount_{{$due->id}}" name="clear_due_amount" class="form-control"><br>
                                                <input type="hidden" name="order_id" value="{{$due->id}}">
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            {{-- Clear Due Modal End --}}
                            @endforeach
                        </tbody>
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

  
function validateClearAmount(dueAmount, clearAmountId) {
    let clearAmount = document.getElementById(clearAmountId).value;
    clearAmount = parseFloat(clearAmount);

    if (clearAmount > dueAmount) {
        // alert('The clear amount cannot be greater than the due amount.');
        Swal.fire({
                    icon: "warning",
                    title: 'Given amount can not be more than the due amount.',
                    });
                    return false;
        
    }

    return true; // Allow form submission
}
    
  </script>
  @endpush