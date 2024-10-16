@extends('master')

@section('title')
Edit Branch
@endsection

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>
        <div class="row">
            <div class="col-12">
                <a class="btn btn-outline-info float-right" href="{{route('balance_transaction_list')}}">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>

               
            <div class="col-12">
                <br>
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Update Transaction Details</h3>
                  </div>  
                    <div class="card-body">
                        <form id="updateTransactionForm" >
                            <div class="row"> 
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Transaction Date</label>
                                        <input type="date"  class="form-control" id="transaction_date" name="transaction_date" value="{{$balance_transaction->transaction_date}}" required>
                                    </div> 
                                </div> 
                                
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Transaction Name</label>
                                        <input type="text"  class="form-control" id="transaction_name" name="transaction_name" value="{{$balance_transaction->transaction_name}}" required>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Transaction Type</label>
                                        <select class="form-control select2bs4" required id="transaction_type" name="transaction_type" style="width: 100%;">
                                            <option selected value="{{$balance_transaction->transaction_type}}">
                                                @if(($balance_transaction->transaction_type) == 1)
                                                Debit
                                                @else
                                                Credit
                                                @endif
                                            </option>
                                            <option value="1">Debit</option>
                                            <option value="2">Credit</option>
                                        </select>
                                      </div>
                                </div>
                                <div class="col-md-12 col-sm-12">

                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Cost Type</label>
                                        <select class="form-control select2bs4" required id="cost_type" name="cost_type" style="width: 100%;">
                                            <option selected value="{{$balance_transaction->cost_type}}">
                                                @if(($balance_transaction->cost_type) == 'A')
                                                Asset
                                                @elseif(($balance_transaction->cost_type) == 'L')
                                                Liability
                                                @else
                                                Equity
                                                @endif
                                            </option>
                                            <option value="A">Asset</option>
                                            <option value="L">Liability</option>
                                            <option value="E">Equity</option>
                                        </select>
                                      </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Cost Less</label>
                                        <select class="form-control select2bs4" required id="cost_less" name="cost_less" style="width: 100%;">
                                            <option selected value="{{$balance_transaction->cost_less}}">
                                                @if(($balance_transaction->cost_less) == 1)
                                                Yes
                                                @else
                                                No
                                                @endif
                                            </option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select>
                                      </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Amount (BDT)</label>
                                        <input type="number"  class="form-control" id="transaction_amount" step="0.01" name="transaction_amount" value="{{$balance_transaction->transaction_amount}}" required>
                                    </div>
                                </div>                               
                                </div>
                            <input type="hidden" value="{{$balance_transaction->id}}" name="id" id="transaction_id">
                            <button type="submit" id="sub" class="btn btn-info float-right mr-4">Update</button>
                          </form>
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

//Initialize Select2 Elements
$('.select2bs4').select2({
      theme: 'bootstrap4'
    })

//initialize summernote
$('.summernote').summernote();
     
  });



    document.getElementById('updateTransactionForm').addEventListener('submit',function(event){
    event.preventDefault();

    var updateTransactionFormData = new FormData(this);
    var transaction_id = document.getElementById('transaction_id').value;
    
    // Function to get CSRF token from meta tag
    function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }
    // Set up Axios defaults
    axios.defaults.withCredentials = true;
    axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

    // axios.get('sanctum/csrf-cookie').then(response=>{
    axios.post('/api/update_balance_transaction/' + transaction_id, updateTransactionFormData).then(response=>{
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
    // });

    });
    
</script>
  @endpush