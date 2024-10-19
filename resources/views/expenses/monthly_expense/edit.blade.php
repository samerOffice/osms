@extends('master')

@section('title')
Monthly Expense
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>
        <div class="row">
            <div class="col-12">
                <a class="btn btn-outline-info float-right" href="{{route('monthly_expense_list')}}">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
               
            <div class="col-12">
                <br>
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Update Expense Details</h3>
                  </div>  
                    <div class="card-body">
                        <form id="updateMonthlyExpenseForm">
                            <div class="card-body">
                                <div class="form-group">
                                  <label for="product_category_name">Expense Name</label>
                                  <input type="text" required class="form-control" id="expense_name" name="expense_name" value="{{$expense->expense_name}}">
                                </div>

                                <div class="form-group">
                                    <label>Expense Amount (BDT)</label>
                                    <input type="number" step="0.01" required  class="form-control" id="expense_amount" name="expense_amount" value="{{$expense->expense_amount}}">
                                </div>

                                <div class="form-group">
                                    <label>Payment Date</label>
                                    <input type="date" required  class="form-control" id="expense_pay_date" name="expense_pay_date" value="{{$expense->expense_pay_date}}">
                                </div>

                              </div>
                            <!-- /.card-body -->
                            <input type="hidden" value="{{$expense->id}}" name="id" id="expense_id">
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
   
});


    document.getElementById('updateMonthlyExpenseForm').addEventListener('submit',function(event){
    event.preventDefault();


    var updateMonthlyExpenseFormData = new FormData(this);
    var expense_id = document.getElementById('expense_id').value;

   
    // Function to get CSRF token from meta tag
    function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }
    // Set up Axios defaults
    axios.defaults.withCredentials = true;
    axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

    // axios.get('sanctum/csrf-cookie').then(response=>{
    axios.post('/api/update_monthly_expense/' + expense_id, updateMonthlyExpenseFormData).then(response=>{
    console.log(response);
    setTimeout(function() {
        window.location.href = "{{ route('monthly_expense_list') }}";
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