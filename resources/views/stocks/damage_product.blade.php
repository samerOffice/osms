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
                <a class="btn btn-outline-info float-right" href="{{route('stock_list')}}">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
            
            <div class="col-12">
                <br>
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Damage Product Set</h3>
                  </div>  
                    <div class="card-body">
                        <form id="updateProductQuantityForm" >
                            <div class="row">  
                                <div class="col-md-6 col-sm-6">
                                    <div  class="form-group mb-4">
                                        <label>Product Name :</label><br>
                                        <span>{{$damage_product->stock_product_name}}</span>
                                    </div> 
                                </div>
                    
                                <div class="col-md-6 col-sm-6">
                                <div  class="form-group mb-4">
                                    <label>Product Weight :</label><br>
                                    <span>{{$damage_product->stock_product_weight}} {{$damage_product->stock_product_unit_type}}</span>
                                </div>
                                </div>

                                <div class="col-md-6 col-sm-6">
                                    <div  class="form-group mb-4">
                                        <label>Quantity :</label><br>
                                        <span id="current_quantity">{{$damage_product->quantity}}</span>
                                    </div> 
                                </div>

                                @if($damage_product->product_mfg_date != '')
                                <div class="col-md-6 col-sm-6">
                                    <div  class="form-group mb-4">
                                        <label>MFG Date : </label><br>
                                        <span>{{$damage_product->product_mfg_date}}</span>
                                    </div> 
                                </div>
                                @endif

                                @if($damage_product->product_expiry_date != '')
                                <div class="col-md-6 col-sm-6">
                                    <div  class="form-group mb-4">
                                        <label>Expiry Date : </label><br>
                                        <span>{{$damage_product->product_expiry_date}}</span>
                                    </div> 
                                </div>
                                @endif

                                <div class="col-md-6 col-sm-6">
                                    <div  class="form-group mb-4">
                                        <label>Unit Price : </label><br>
                                        <span>{{$damage_product->product_unit_price}}</span>
                                    </div> 
                                </div>

                                <div class="col-md-6 col-sm-6">
                                    <div  class="form-group mb-4">
                                        <label>Sub Total : </label><br>
                                        <span>{{$damage_product->product_subtotal}}</span>
                                    </div> 
                                </div>   
                                
                              </div>

                              <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div  class="form-group mb-4">
                                        <label>Total Damaged/Burned Product : </label><br>
                                        <input type="number" class="form-control" onkeyup="damageProduct()" name="damage_product" id="damage_quantity">
                                    </div> 
                                </div>
                              </div>
                               

                            <input type="hidden" value="{{$damage_product->id}}" name="id" id="damage_product_id">
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


function damageProduct(){
    var current_quantity = $('#current_quantity').html();
    var damage_product_quantity = $('#damage_quantity').val();

    current_quantity = parseInt(current_quantity);
    damage_product_quantity = parseInt(damage_product_quantity);

    if(damage_product_quantity > current_quantity){
        Swal.fire({
                    icon: "warning",
                    title: 'Damage product quantity is greater than current product quantity!',
                    });
        return false;
    }else{

        document.getElementById('updateProductQuantityForm').addEventListener('submit',function(event){
        event.preventDefault();

        var updateProductQuantityFormData = new FormData(this);
        var damage_product_id = document.getElementById('damage_product_id').value;

    
        // Function to get CSRF token from meta tag
        function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        }
        // Set up Axios defaults
        axios.defaults.withCredentials = true;
        axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

        // axios.get('sanctum/csrf-cookie').then(response=>{
        axios.post('/api/update_damage_product/' + damage_product_id, updateProductQuantityFormData).then(response=>{
        console.log(response);
        setTimeout(function() {
            window.location.href = "{{ route('stock_list') }}";
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
    }
}


   
    
</script>
  @endpush