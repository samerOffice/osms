@extends('master')

@section('title')
Shop Details
@endsection


@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>
        <div class="row">
            <div class="col-12">
                <a class="btn btn-outline-info float-right" href="{{route('shop_list')}}">
                    <i class="fas fa-arrow-left"></i> Back
                </a>            
            </div>
            <div class="col-1"></div>
            <div class="col-10">
                <br>
                      <!-- Profile Image -->
            <div class="card">
              <div class="card-body">
              
                <h6><i class="fa-solid fa-shop"></i> Shop Name</h6>
                <h5 class="ml-4" style="color: #908ec4">{{$shop->company_name}}</h5>           
                <hr>
                @if($shop->company_email != '')
                <h6><i class="fa-solid fa-envelope"></i> Official Email</h6>
                <h5 class="ml-4" style="color: #908ec4">{{$shop->company_email}}</h5>      
                <hr>
                @endif
                <h6><i class="fa-solid fa-mobile"></i> Official Contact Number</h6>
                {{-- <h6 class="ml-4">{{$shop->contact_no}}</h6> --}}
                <h5 class="ml-4" style="color: #908ec4">{{$shop->contact_no}}</h5>        
                <hr>

                <h6><i class="fa-solid fa-id-card"></i> Licence Number</h6>
                {{-- <h6 class="ml-4">{{$shop->license_no}}</h6>--}}
                <h5 class="ml-4" style="color: #908ec4">{{$shop->license_no}}</h5>  
                <hr>

                @if($shop->registration_no != '')
                <h6><i class="fa-solid fa-id-card"></i> BIN Number</h6>
                {{-- <h6 class="ml-4">{{$shop->registration_no}}</h6> --}}
                <h5 class="ml-4" style="color: #908ec4">{{$shop->registration_no}}</h5>
                <hr>
                @endif

                @if($shop->company_address != '')
                <h6><i class="fas fa-map-marker-alt mr-1"></i> Shop Address</h6>
                {{-- <h6 class="ml-4">{{$shop->company_address}}</h6> --}}
                <h5 class="ml-4" style="color: #908ec4">{{$shop->company_address}}</h5>
                <hr>
                @endif

                @if($shop->division_name != '')
                <h6><i class="fas fa-map-marker-alt mr-1"></i> Division</h6>
                {{-- <h6 class="ml-4">{{$shop->division_name}}</h6> --}}
                <h5 class="ml-4" style="color: #908ec4">{{$shop->division_name}}</h5>
                <hr>
                @endif

                @if($shop->district_name != '')
                <h6><i class="fas fa-map-marker-alt mr-1"></i> District</h6>
                {{-- <h6 class="ml-4">{{$shop->district_name}}</h6> --}}
                <h5 class="ml-4" style="color: #908ec4">{{$shop->district_name}}</h5>
                <hr>
                @endif

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>  
            <div class="col-1"></div>         
        </div>       
        <br>       
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

  </div>

@endsection
