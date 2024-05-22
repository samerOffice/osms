@extends('master')

@section('title')
Welcome
@endsection


@section('content')

@if (Auth::check())

  @if($current_module->module_status == 1) <!--general module-->
  <div class="content-wrapper" style="background-color: rgb(254, 255, 238)">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <h4 align=center>Welcome, <b>{{Auth::user()->name}}</b>!</h4>
        
        <h4 align=center>To</h4>
        <div class="row" style="margin-left: 35%">    
            <span style="margin-top:20px !important;"><img src="{{asset('public/img/otithee_logo.png')}}"  height="25px" width="auto" alt="logo"></span>
        <em> 
          <h1 style="color: green; font-weight: bold; margin-top: 17px">&nbsp;Shop Management System </h1>
        </em>      
        </div>
       
        <div class="row mt-4">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color: #b9f5ff">
              <div class="inner">
                <br>
                <br>
                <h4 align="center">Point of Sale</h4>
                <br>
              </div>
              <div class="icon">
                <i class="ion ion-bag" style="color: #20ceea"></i>
              </div>
              <form action="{{route('posModuleActive')}}" method="post">
                @csrf
                <input type="hidden" value="4" name="current_module_status">
                
              <button type="submit" class="btn" style="background-color: #20ceea; color: white">Click Here <i class="fas fa-arrow-circle-right"></i></button>
            </form>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color: #b4ffc5">
              <div class="inner">
                <br>
                <br>
                <h4 align="center">Inventory Management</h4>
                <br>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph" style="color: #1cdf1c"></i>
              </div>

              <form action="{{route('inventoryModuleActive')}}" method="post">
                @csrf
                <input type="hidden" value="3" name="current_module_status">
                
              <button type="submit" class="btn" style="background-color: #1cdf1c; color: white">Click Here <i class="fas fa-arrow-circle-right"></i></button>
            </form>
              {{-- <a href="#" class="small-box-footer" style="background-color: #1cdf1c">Click Here <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color: #ffced5">
              <div class="inner">
                <br>
                <br>
                <h4 align="center">Employee Management</h4>
                <br>
              </div>
              <div class="icon">
                <i class="ion ion-person-add" style="color: #ff5d6c"></i>
              </div>

              <form action="{{route('empModuleActive')}}" method="post">
                @csrf
                <input type="hidden" value="2" name="current_module_status">
                
              <button type="submit" class="btn" style="background-color: #ff5d6c; color: white">Click Here <i class="fas fa-arrow-circle-right"></i></button>
            </form>
            </div>
          </div>
          <!-- ./col -->
          
          <!-- ./col -->
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
        <img src="{{'public/img/employees.jpg'}}" width="900px" alt="">
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
        <img src="{{'public/img/inventory.jpg'}}" width="700px" alt="">
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
        <img src="{{'public/img/pos.jpg'}}" width="700px" alt="">
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