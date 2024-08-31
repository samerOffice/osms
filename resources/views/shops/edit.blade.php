@extends('master')

@section('title')
Edit Shop
@endsection

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>
        <div class="row">
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
                    <h3 class="card-title">Update Shop Details</h3>
                  </div>  
                    <div class="card-body">
                        <form id="updateShopForm" >
                            <div class="row">       
                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Shop Name <small style="color: red">*</small></label>
                                        <input type="text" required  id="company_name" value="{{$shop->company_name}}" name="company_name" class="form-control form-control-lg" />
                                    </div> 
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Official Email</label>
                                        <input type="email" id="company_email" value="{{$shop->company_email}}" name="company_email" class="form-control form-control-lg" />
                                    </div> 
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Official Contact Number <small style="color: red">*</small></label>
                                        <input type="text" required id="contact_no" value="{{$shop->contact_no}}" name="contact_no" class="form-control form-control-lg" />
                                    </div> 
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Trade License Number <small style="color: red">*</small></label>
                                        <input type="text" required id="license_no" value="{{$shop->license_no}}" name="license_no" class="form-control form-control-lg" />
                                    </div> 
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>BIN Number</label>
                                        <input type="text" id="registration_no" value="{{$shop->registration_no}}" name="registration_no" class="form-control form-control-lg" />
                                    </div> 
                                </div>
                    
                                <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>shop Address <small style="color: red">*</small></label>
                                    <textarea name="company_address" required id="company_address"  class="form-control form-control-lg">{{$shop->company_address}}</textarea>
                                </div> 
                                </div>

                                <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label >Division <small style="color: red">*</small></label>
                                    <select class="form-control select2bs4" id="division" name="division" style="width: 100%;">
                                        <option selected="selected" value="{{$shop->division}}">{{$shop->division_name}}</option>
                                        @foreach($divisions as $division)
                                        <option value="{{$division->id}}">{{$division->name}}</option>
                                        @endforeach
                                      </select>
                                </div>  
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group mb-4">
                                      <label>District <small style="color: red">*</small></label>
                                    <select class="form-control select2bs4" id="district" name="district" style="width: 100%;">
                                      <option value="{{$shop->district}}">{{$shop->district_name}}</option>
                                    </select>
                                    </div> 
                                  </div>

                              </div>

                            <input type="hidden" value="{{$shop->id}}" name="id" id="shop_id">
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


    //division and district dependancy dropdown logic start
    $('#division').on('change',function(event){
    event.preventDefault();
    var selectedDivision = $('#division').val();

    if (selectedDivision == '') {
            $('#district').html('');
            return false;
        }

    // Function to get CSRF token from meta tag
    function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }
    // Set up Axios defaults
    axios.defaults.withCredentials = true;
    axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();


    axios.get('sanctum/csrf-cookie').then(response=>{
    axios.post('/api/division',{
            data: selectedDivision
        }).then(response=>{
        $('#district').html(response.data);
            console.log(response.data);
        });
    });
    });
    //division and district dependancy dropdown logic end



    document.getElementById('updateShopForm').addEventListener('submit',function(event){
    event.preventDefault();

    var updateShopFormData = new FormData(this);
    var shop_id = document.getElementById('shop_id').value;
    
    // Function to get CSRF token from meta tag
    function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }
    // Set up Axios defaults
    axios.defaults.withCredentials = true;
    axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

    // axios.get('sanctum/csrf-cookie').then(response=>{
    axios.post('/api/update_shop/' + shop_id, updateShopFormData).then(response=>{
    console.log(response);
    setTimeout(function() {
        window.location.reload(true);
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