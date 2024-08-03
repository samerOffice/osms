@extends('master')

@section('title')
Welcome
@endsection

@push('css')
<style>
  .employee_button_position {
    background-color: #ff5d6c; color: white; margin: 0;
    position: absolute;
    left: 40%;
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
    }

  .inventory_button_position {
    background-color: #1cdf1c; color: white; margin: 0;
    position: absolute;
    left: 40%;
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
    }

    .pos_button_position {
    background-color: #20ceea; color: white; margin: 0;
    position: absolute;
    left: 40%;
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
    }


    .tracking_button_position {
    background-color: #e6753e; color: white; margin: 0;
    position: absolute;
    left: 40%;
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
    }


    
</style>
@endpush


@section('content')
@if (Auth::check())

  @if($current_module->module_status == 1) <!--general module-->
  <div class="content-wrapper" style="background-image: url('{{ asset('img/2.png') }}'); background-repeat: no-repeat;background-size: cover;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>
        {{-- <h4 align=center>Welcome, <b>{{Auth::user()->name}}</b>!</h4>   
        <h4 align=center>To</h4>
        <div class="row" style="margin-left: 35%">    
            <span style="margin-top:20px !important;"><img src="{{asset('img/otithee_logo.png')}}"  height="25px" width="auto" alt="logo"></span>
        <em> 
          <h1 style="color: green; font-weight: bold; margin-top: 17px">&nbsp;Shop Management System </h1>
        </em>      
        </div> --}}
       
        <div class="row mt-4">
          <div class="col-lg-3 col-md-6 col-sm-12">
            <h4 align="center">Employee Management</h4>
            <!-- small box -->
              <div class="small-box" style="padding:150px; height:auto; background-image: url('{{ asset('img/employee_dashboard.jpg') }}');  background-size: cover;">   
              </div>
              <br> 
              <div style="position: relative">
                <form action="{{route('empModuleActive')}}" method="post">
                  @csrf
                  <input type="hidden" value="2" name="current_module_status">                
                <button type="submit" class="btn employee_button_position" >Click Here <i class="fas fa-arrow-circle-right"></i></button>
              </form>  
              </div> 
              <br>                
              <br>                
           </div>
          
          <!-- ./col -->
          <div class="col-lg-3 col-md-6 col-sm-12">
            <h4 align="center">Accounts & Inventory Management</h4>
            <!-- small box -->
            <div class="small-box" style="padding:150px; height:auto; background-image: url('{{ asset('img/inventory_dashboard.jpg') }}');  background-size: cover;" >      
            </div>
            <br>
              <div style="position: relative;">
                <form action="{{route('inventoryModuleActive')}}" method="post">
                  @csrf
                  <input type="hidden" value="3" name="current_module_status">           
                <button type="submit" class="btn inventory_button_position" >Click Here <i class="fas fa-arrow-circle-right"></i></button>
                </form>
              </div>
              <br>                
              <br>           
           </div>
          <!-- ./col -->
          <div class="col-lg-3 col-md-6 col-sm-12">
            <h4 align="center">Point of Sale</h4>
            <!-- small box -->
            <div class="small-box" style="padding:150px; height:auto; background-image: url('{{ asset('img/pos_dashboard.jpg') }}');  background-size: cover;" >
            </div>
             <br>
            <div style="position: relative">
              <form action="{{route('posModuleActive')}}" method="post">
                @csrf
                <input type="hidden" value="4" name="current_module_status">         
              <button type="submit" class="btn pos_button_position">Click Here <i class="fas fa-arrow-circle-right"></i></button>
            </form>
            </div>   
          </div>

          <div class="col-lg-3 col-md-6 col-sm-12">
            <h4 align="center">Delivery Tracking System</h4>
            <!-- small box -->
            <div class="small-box" style="padding:150px; height:auto; background-image: url('{{ asset('img/tracking_dashboard.jpg') }}');  background-size: cover;" >
            </div>
             <br>
            <div style="position: relative">
              <form action="{{route('posModuleActive')}}" method="post">
                @csrf
                <input type="hidden" value="4" name="current_module_status">         
              <button type="submit" class="btn tracking_button_position">Click Here <i class="fas fa-arrow-circle-right"></i></button>
            </form>
            </div>   
          </div>
         
        </div>
      </div><!-- /.container-fluid -->
    </div>
   
  </div>
  @elseif($current_module->module_status == 2) <!--employee module-->
  <div class="content-wrapper" style="background-color: rgba(255, 206, 213, 0.18)">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div style="height: 100%;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;">
        <img src="{{'img/employees.jpg'}}" width="900px" alt="">
        </div>   
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
  @elseif($current_module->module_status == 3) <!--inventory module-->
  <div class="content-wrapper" style="background-color: rgba(202, 255, 214, 0.34)">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div style="height: 100%;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;">
        <img src="{{'img/inventory.jpg'}}" width="700px" alt="">
        </div>
        
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
  @else <!--pos module-->
  <div class="content-wrapper" style="background-color: rgba(185, 245, 255, 0.25)">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div style="height: 100%;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;">
        <img src="{{'img/pos.jpg'}}" width="700px" alt="">
        </div>
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
  @endif
@else
@php
    $redirectRoute = route('login');
    header("Location: $redirectRoute");
        exit();
@endphp
@endif
@endsection