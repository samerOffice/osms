<li class="nav-item nav-link 
            @if(Request::is('asset_management_module_active')) nav-link active
            @endif
            " style="@if(Request::is('asset_management_module_active')) background-color: #ea2ccc;
              @endif
              ">
        <a href="{{route('home')}}">
          <i class="nav-icon fas fa-tachometer-alt" style="@if(Request::is('asset_management_module_active')) color: white;
              @endif
              ">
          </i>
          <p style="@if(Request::is('asset_management_module_active')) color:white;
              @endif
              ">
            Dashboard
          </p>
        </a>
      </li>

      <li class="nav-item nav-link 
          @if(Request::is('add_asset')) nav-link active
          @endif
          " style="@if(Request::is('add_asset')) background-color: #ea2ccc;
            @endif
            ">
      <a href="{{route('add_asset')}}">
        <i class="nav-icon fa-solid fa-plus" style="@if(Request::is('add_asset')) color: white;
            @endif
            ">
        </i>
        <p style="@if(Request::is('add_asset')) color:white;
            @endif
            ">
          Add Asset
        </p>
      </a>
    </li>

     
    <li class="nav-item nav-link 
          @if(Request::is('asset_list')) nav-link active
          @endif
          " style="@if(Request::is('asset_list')) background-color: #ea2ccc;
            @endif
            ">
      <a href="{{route('asset_list')}}">
        <i class="nav-icon fa-solid fa-computer" style="@if(Request::is('asset_list')) color: white;
            @endif
            ">
        </i>
        <p style="@if(Request::is('asset_list')) color:white;
            @endif
            ">
          Asset List
        </p>
      </a>
    </li>
  