@extends('master')

@section('title')
View Stock
@endsection

@push('css')
<style type="text/css">
    @media print {
        #invoice_print {
            display: none;
        }
    }
</style>
@endpush
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <br>
        <div class="row">
            <div class="col-12">
                <a class="btn btn-outline-info float-right" href="{{route('stock_list')}}">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>                       
        </div>
        <br>

        <div class="row">
            <div class="col-12">           
              <!-- Main content -->
              <div class="invoice p-3 mb-3" id="stock_details">
                <!-- title row -->
                <div class="row">
                  <div class="col-12">
                    <h4>
                      <i class="fa-solid fa-receipt"></i> Stock Product List
                      <small class="float-right"><b>Date:</b> <span style="color: green">{{ \Carbon\Carbon::now()->format('F j, Y') }}</span></small>
                    </h4>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-3 invoice-col">
                        <br>                      
                        <b>Company Name: <br></b>{{$company_name}}<br>
                        <b>Branch Name: <br></b>{{$branch_name}}<br>
                    </div>                 
                </div>
                <!-- /.row -->
        <br>
                <!-- Table row -->
                <div class="row">
                  <div class="col-12 table-responsive">
                    <table id="example1" class="table table-striped">
                      <thead>
                      <tr>
                        <th>Serial No.</th>
                        <th>Warehouse</th>
                        <th>Product</th>
                        <th>Product Weight</th>
                        <th>Product Details</th>
                        <th>Product Quantity</th>
                        <th>Unit Price</th>                      
                        <th>Subtotal</th>
                        <th>Purchase Date</th>
                        <th>Purchased By</th>
                        <th>Labeling</th>
                      </tr>
                      </thead>
                      <tbody>
                        @php $i = 1 @endphp
                        @foreach($stocks as $stock)
                      <tr>
                        <td>{{$i++}}</td>
                        <td>{{$stock->warehouse_name}}</td>
                        <td>{{$stock->stock_product_name}}</td>
                        <td>{{$stock->stock_product_weight}} {{$stock->stock_product_unit_type}}</td>
                        <td>{{$stock->stock_product_details}}</td>
                        <td>{{$stock->quantity}}</td>
                        <td>{{$stock->product_unit_price}} BDT</td>
                        <td>{{$stock->product_subtotal}} BDT</td>
                        <td>{{$stock->purchase_date}}</td>                      
                        <td>{{$stock->purchased_by}}</td>                  
                        <td>
                            @if($stock->label_status == 1)
                            <h5><span class="badge badge-secondary">Labeled</span></h5>
                            @else
                            <a href="{{route('add_label',$stock->id)}}">Add Label</a>
                            @endif
                        </td>                  
                      </tr>
                      @endforeach                
                      </tbody>
                    </table>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
        
        <br>
               
              </div>
              <!-- /.invoice -->
            </div><!-- /.col -->
          </div><!-- /.row -->
    </div>
</div>
@endsection

@push('masterScripts')
<script>
  $(document).ready(function() {
            $('#invoice_print').on('click', function() {      
                var printContent = document.getElementById('stock_details').innerHTML;
                printContentFunction(printContent);
            });
            function printContentFunction(content) {
                var originalContent = document.body.innerHTML;
                // Set body content to the content you want to print
                document.body.innerHTML = content;
                // Call window.print() to print the content
                 window.print();
                // Restore original content
                document.body.innerHTML = originalContent;
                setTimeout(function() {
                    if (!window.matchMedia('print').matches) {
                        // Redirect to a different page if print was canceled
                        window.location.href = '{{ route('requisition_view',$id) }}';
                    }
                }, 500);
            }  
        }); 



     $(document).ready(function() {
    $('#example1').DataTable({
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
  </script>
  @endpush