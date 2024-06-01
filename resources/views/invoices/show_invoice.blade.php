@extends('master')

@section('title')
Invoice
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
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>

        <div class="invoice p-3 mt-3" id="payroll_details">         
            <div class="row">          
                <div class="col-12">
                    <br>
                    <div class="card">

                        <div class="card-header">
                            <h1>Invoice</h1>
                            <br>
                          <h3 class="card-title">{{ \Carbon\Carbon::now()->format('F j, Y') }}</h3><br>
                          {{-- <h3 class="card-title">{{$member_designation_name}}</h3> --}}
                        </div>

                        <div class="card-body">
                            <table id="" class="table table-bordered table-striped">
                                <thead>
                                    @foreach($filteredData as $key => $value)
                                    @if( ($key !== '_token')
                                    && 
                                    ($key !== 'id')
                                    && 
                                    ($key !== 'product_id')
                                    && 
                                    ($key !== 'emp_id')
                                    && 
                                    ($key !== 'invoice_date')
                                    && 
                                    ($key !== 'company_id')
                                    && 
                                    ($key !== 'payment_method_id')
                                    && 
                                    ($key !== 'created_at')
                                    && 
                                    ($key !== 'updated_at')
                                    )
                                    <tr>
                                        <th>
                                           
                                            @if($key === 'product_name')
                                            Product
                                            @elseif($key === 'sub_total')
                                            Price (BDT)
                                            @elseif($key === 'discount_amount')
                                            Discount (BDT)
                                            @elseif($key === 'total_amount')
                                            Total (BDT)
                                            
                                            
                                            @else
                                            {{$key}}
                                            @endif
                                        </th>
                                        <td>{{ $value }}</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </thead>                          
                              </table>
                        </div>
                      </div>
                </div>            
            </div>  
                
            <div class="row no-print">
                <div class="col-12">
                  <a  id="invoice_print" target="_blank"  class="btn btn-danger float-right" style="margin-right: 5px;">
                    <i class="fas fa-print"></i> Print
                  </a>
                  
                </div>
            </div>
        </div>
        
        <br>       
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection

@push('masterScripts')
<script>
$(document).ready(function() {
            $('#invoice_print').on('click', function() {      
                var printContent = document.getElementById('payroll_details').innerHTML;
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
                        window.location.href = '{{ route('invoice_show_data') }}';
                    }
                }, 500);

            }
   
        });
  
           
  
  </script>
  @endpush