<aside class="main-sidebar sidebar-dark-info elevation-4">
    <!-- Brand Logo -->
    
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="pb-3 mb-3">
      
      </div>



      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
      @if($current_module->module_status == 1) <!--general module-->
          <li class="nav-item nav-link {{ Request::is('dashboard') ? 'nav-link active' : ''}}" style="{{ Request::is('dashboard') ? 'background-color: #c0c48e; !important' : ''}}">
          <a href="{{route('home')}}">
            <i class="nav-icon fas fa-tachometer-alt" style="{{ Request::is('dashboard') ? 'color: white; !important' : ''}}"></i>
            <p style="{{ Request::is('dashboard') ? 'color: white; !important' : ''}}">
              Dashboard
            </p>
          </a>
        </li>
          <li class="nav-item ">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Departments</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Designations</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Roles</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Business Types</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>
            </ul>
          </li>

      @elseif($current_module->module_status == 2) <!--employee module-->
        <li class="nav-item nav-link 
                @if(Request::is('emp_module_active')) nav-link active
                @elseif(Request::is('add_additional_member_info')) nav-link active
                @endif
                " 
        style="@if(Request::is('emp_module_active')) background-color: #ff5d6c;
               @elseif(Request::is('add_additional_member_info')) background-color: #ff5d6c;
               @endif
        ">
        <a href="{{route('home')}}">
          <i class="nav-icon fas fa-tachometer-alt" 
          style="@if(Request::is('emp_module_active')) color: white;
          @elseif(Request::is('add_additional_member_info')) color: white;
          @endif
          ">
          </i>
          <p style="@if(Request::is('emp_module_active')) color:white;
          @elseif(Request::is('add_additional_member_info')) color:white;
          @endif
          ">
            Dashboard
          </p>
        </a>
      </li>

      {{-- <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fa-solid fa-users"></i>
          <p> Employees</p>
        </a>
      </li> --}}

      <li class="nav-item nav-link     
      @if(Request::is('give_attendance')) nav-link active
      @endif" 
      style="
               @if(Request::is('give_attendance')) background-color: #ff5d6c;
               @endif">
        <a href="{{route('give_attendance')}}" >
          <i class="nav-icon fa-solid fa-person-chalkboard" 
          style="
          @if(Request::is('give_attendance')) color: white;
          @endif
          "></i>
          <p style="
          @if(Request::is('give_attendance')) color:white;
          @endif
          "> Give Attendance</p>
        </a>
      </li>

      <li class="nav-item nav-link     
      @if(Request::is('attendance_list')) nav-link active
      @endif"
      style="
      @if(Request::is('attendance_list')) background-color: #ff5d6c;
      @endif">
        <a href="{{route('attendance_list')}}">
          <i class="nav-icon fa-solid fa-list" style="
          @if(Request::is('attendance_list')) color: white;
          @endif
          "></i> 
          <p style="
          @if(Request::is('attendance_list')) color:white;
          @endif
          ">Attendance List</p>
        </a>
      </li>

      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fa-solid fa-wallet"></i>
          <p> Payrolls</p>
        </a>
      </li>

      <li class="nav-item ">
        <a href="#" class="nav-link ">
          <i class="nav-icon fa-solid fa-file-pen"></i>
          <p>
            Reports
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Attendance Reports</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="far fa-circle nav-icon"></i>
              <p>Performance Reports</p>
            </a>
          </li>
          
        </ul>
      </li>
      
      @elseif($current_module->module_status == 3) <!--inventory module-->

            <li class="nav-item nav-link 
            @if(Request::is('inventory_module_active')) nav-link active
            @endif
            " 
          style="@if(Request::is('inventory_module_active')) background-color: #1cdf1c;
              @endif
              ">
              <a href="{{route('home')}}">
              <i class="nav-icon fas fa-tachometer-alt" 
              style="@if(Request::is('inventory_module_active')) color: white;
              @endif
              ">
              </i>
              <p style="@if(Request::is('inventory_module_active')) color:white;
              @endif
              ">
                Dashboard
              </p>
              </a>
            </li>


            <li class="nav-item nav-link 
            @if(Request::is('add_item_category')) nav-link active
            @endif
            " 
          style="@if(Request::is('add_item_category')) background-color: #1cdf1c;
              @endif
              ">
              <a href="{{route('add_item_category')}}">
              <i class="nav-icon fas fa-tachometer-alt" 
              style="@if(Request::is('add_item_category')) color: white;
              @endif
              ">
              </i>
              <p style="@if(Request::is('add_item_category')) color:white;
              @endif
              ">
                Item Category
              </p>
              </a>
            </li>


            
            <li class="nav-item nav-link 
            @if(Request::is('add_product_category')) nav-link active
            @endif
            " 
          style="@if(Request::is('add_product_category')) background-color: #1cdf1c;
              @endif
              ">
              <a href="{{route('add_product_category')}}">
              <i class="nav-icon fas fa-tachometer-alt" 
              style="@if(Request::is('add_product_category')) color: white;
              @endif
              ">
              </i>
              <p style="@if(Request::is('add_product_category')) color:white;
              @endif
              ">
                Product Category
              </p>
              </a>
            </li>


      {{-- <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Product Requisition</p>
        </a>
      </li> --}}


         <li class="nav-item nav-link 
            @if(Request::is('add_product')) nav-link active
            @endif
            " 
          style="@if(Request::is('add_product')) background-color: #1cdf1c;
              @endif
              ">
              <a href="{{route('add_product')}}">
              <i class="nav-icon fas fa-tachometer-alt" 
              style="@if(Request::is('add_product')) color: white;
              @endif
              ">
              </i>
              <p style="@if(Request::is('add_product')) color:white;
              @endif
              ">
                Product Entry
              </p>
              </a>
            </li>


      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Warehouses</p>
        </a>
      </li>

      <li class="nav-item ">
        <a href="#" class="nav-link ">
          <i class="nav-icon fa-solid fa-file-pen"></i>
          <p>
            Reports
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Inventory Reports</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link active">
              <i class="far fa-circle nav-icon"></i>
              <p>Inventory Forecast</p>
            </a>
          </li>
          
        </ul>
      </li>

     

      @else <!--pos module-->
     
      <li class="nav-item nav-link 
            @if(Request::is('pos_module_active')) nav-link active
            @endif
            " 
          style="@if(Request::is('pos_module_active')) background-color: #20ceea;
              @endif
              ">
              <a href="{{route('home')}}">
              <i class="nav-icon fas fa-tachometer-alt" 
              style="@if(Request::is('pos_module_active')) color: white;
              @endif
              ">
              </i>
              <p style="@if(Request::is('pos_module_active')) color:white;
              @endif
              ">
                Dashboard
              </p>
              </a>
            </li>


      <li class="nav-item nav-link 
            @if(Request::is('add_invoice')) nav-link active
            @endif
            " 
          style="@if(Request::is('add_invoice')) background-color: #20ceea;
              @endif
              ">
              <a href="{{route('add_invoice')}}">
              <i class="nav-icon fa-solid fa-receipt" 
              style="@if(Request::is('add_invoice')) color: white;
              @endif
              ">
              </i>
              <p style="@if(Request::is('add_invoice')) color:white;
              @endif
              ">
                Invoices
              </p>
              </a>
            </li>

      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fa-solid fa-users"></i>
          <p> Customers</p>
        </a>
      </li>


      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fa-regular fa-credit-card"></i>
          <p> Payment Methods</p>
        </a>
      </li>

      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fa-solid fa-gem"></i>
          <p> Offers</p>
        </a>
      </li>

      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fa-solid fa-store"></i>
          <p> Outlets</p>
        </a>
      </li>

      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fa-solid fa-list"></i>
          <p> Policies</p>
        </a>
      </li>

      <li class="nav-item ">
        <a href="#" class="nav-link ">
          <i class="nav-icon fa-solid fa-file-pen"></i>
          <p>
            Reports
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Sale Reports</p>
            </a>
          </li>          
        </ul>
      </li>

    

      
      @endif  
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>