@extends('master')

@section('title')
Application Submission Types
@endsection



@push('css')
<style>
    .color-palette {
      height: 35px;
      line-height: 35px;
      text-align: right;
      padding-right: .75rem;
    }

    .color-palette.disabled {
      text-align: center;
      padding-right: 0;
      display: block;
    }

    .color-palette-set {
      margin-bottom: 15px;
    }

    .color-palette span {
      display: none;
      font-size: 12px;
    }

    .color-palette:hover span {
      display: block;
    }

    .color-palette.disabled span {
      display: block;
      text-align: left;
      padding-left: .75rem;
    }

    .color-palette-box h4 {
      position: absolute;
      left: 1.25rem;
      margin-top: .75rem;
      color: rgba(255, 255, 255, 0.8);
      font-size: 12px;
      display: block;
      z-index: 7;
    }
  </style>
@endpush


@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>
        <br>  
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Application Submission Types</h3>
              </div>
              <div class="card-body">
                <div class="row">
                    <div class="col-md-2 col-xl-2"></div>
                    <div class="col-md-4 col-xl-4 col-sm-12">
                        <!-- small box -->
                        <div class="small-box" style="background-color: #fff17f">
                          <div class="inner">
                            <h3><i class="ionicons ion-android-attach"></i></h3>
                            <h5>File Attachment</h5>
                          </div>
                          <div class="icon">
                            <i class="ion ion-plus"></i>
                          </div>
                          <a href="{{route('leave_application_file_attachment')}}" class="small-box-footer" style="color: black">Click here</a>
                        </div>
                      </div>
                  
                      <div class="col-md-4 col-xl-4 col-sm-12">
                        <!-- small box -->
                        <div class="small-box" style="background-color: #d4ff76">
                          <div class="inner">
                            <h3><i class="ion ion-ios-compose-outline"></i></h3>
                            <h5>Application Form Fillup</h5>
                          </div>
                          <div class="icon">
                            <i class="ion ion-plus"></i>
                          </div>
                          <a href="{{route('leave-application.create')}}" class="small-box-footer" style="color: black">Click here</a>
                        </div>
                      </div>
                      <div class="col-md-2 col-xl-2"></div>
                </div>
              </div>
        </div>    
          
     
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  </div>

@endsection

@push('masterScripts')
<script>
     
</script>
  @endpush