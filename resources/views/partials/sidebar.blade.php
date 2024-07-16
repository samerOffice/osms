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
          <li class="nav-item nav-link {{ Request::is('dashboard') ? 'nav-link active' : ''}}" style="{{ Request::is('dashboard') ? 'background-color: #908ec4; !important' : ''}}">
          <a href="{{route('home')}}">
            <i class="nav-icon fas fa-tachometer-alt" style="{{ Request::is('dashboard') ? 'color: white; !important' : ''}}"></i>
            <p style="{{ Request::is('dashboard') ? 'color: white; !important' : ''}}">
              Dashboard
            </p>
          </a>
        </li>

        <li class="nav-item nav-link @if(Request::is('branch_list')) nav-link active @endif" 
            style="@if(Request::is('branch_list')) background-color: #908ec4; @endif">
           <a href="{{route('branch_list')}}" >
            <i class="nav-icon fa-solid fa-building" style=" @if(Request::is('branch_list')) color: white; @endif"></i>
            <p style="@if(Request::is('branch_list')) color:white; @endif"> Branch</p>
          </a>
        </li>


      <li class="nav-item nav-link @if(Request::is('outlet_list')) nav-link active @endif" 
          style="@if(Request::is('outlet_list')) background-color: #908ec4; @endif">
        <a href="{{route('outlet_list')}}" >
          <i class="nav-icon fa-solid fa-store" style=" @if(Request::is('outlet_list')) color: white; @endif"></i>
          <p style="@if(Request::is('outlet_list')) color:white; @endif"> Outlet</p>
        </a>
      </li>

      <li class="nav-item nav-link @if(Request::is('warehouse_list')) nav-link active @endif" 
          style="@if(Request::is('warehouse_list')) background-color: #908ec4; @endif">
        <a href="{{route('warehouse_list')}}" >
          <i class="nav-icon fa-solid fa-warehouse" style=" @if(Request::is('warehouse_list')) color: white; @endif"></i>
          <p style="@if(Request::is('warehouse_list')) color:white; @endif">Warehouse</p>
        </a>
      </li>


        <li class="nav-item nav-link @if(Request::is('department_list')) nav-link active @endif" 
            style="@if(Request::is('department_list')) background-color: #908ec4; @endif">
           <a href="{{route('department_list')}}" >
            <i class="nav-icon fa-solid fa-hotel" style=" @if(Request::is('department_list')) color: white; @endif"></i>
            <p style="@if(Request::is('department_list')) color:white; @endif"> Department</p>
          </a>
        </li>

        <li class="nav-item nav-link @if(Request::is('supplier_list')) nav-link active @endif" 
            style="@if(Request::is('supplier_list')) background-color: #908ec4; @endif">
           <a href="{{route('supplier_list')}}" >
            <i class="nav-icon fa-solid fa-user" style=" @if(Request::is('supplier_list')) color: white; @endif"></i>
            <p style="@if(Request::is('supplier_list')) color:white; @endif"> Supplier</p>
          </a>
        </li>

        

          {{-- <li class="nav-item ">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
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
          </li> --}}


          @if((auth()->user()->role_id == 1))
          <li class="nav-item @if(Request::is('designation_list')) menu-open 
                              @elseif(Request::is('business_type_list')) menu-open
                              @elseif(Request::is('user_list')) menu-open
          @endif">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cog"></i>
            <p>
              Settings
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="{{route('designation_list')}}" class="nav-link {{ Request::is('designation_list') ? 'nav-link active' : ''}}" style="{{ Request::is('designation_list') ? 'background-color: #908ec4; !important' : ''}}">
                  <i class="far fa-circle nav-icon" style="{{ Request::is('designation_list') ? 'color: white; !important' : ''}}"></i>
                  <p style="{{ Request::is('designation_list') ? 'color: white; !important' : ''}}">Designation</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('business_type_list')}}" class="nav-link {{ Request::is('business_type_list') ? 'nav-link active' : ''}}" style="{{ Request::is('business_type_list') ? 'background-color: #908ec4; !important' : ''}}">
                  <i class="far fa-circle nav-icon" style="{{ Request::is('business_type_list') ? 'color: white; !important' : ''}}"></i>
                  <p style="{{ Request::is('business_type_list') ? 'color: white; !important' : ''}}">Business Type</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('user_list')}}" class="nav-link {{ Request::is('user_list') ? 'nav-link active' : ''}}" style="{{ Request::is('user_list') ? 'background-color: #908ec4; !important' : ''}}">
                  <i class="far fa-circle nav-icon" style="{{ Request::is('user_list') ? 'color: white; !important' : ''}}"></i>
                  <p style="{{ Request::is('user_list') ? 'color: white; !important' : ''}}">Users</p>
                </a>
              </li>
              
            </ul>
          </li>
          @endif


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


      @if((Auth::user()->role_id == 1) ||  (Auth::user()->role_id == 2))
      <li class="nav-item @if(Request::is('add_payroll')) menu-open 
      @elseif(Request::is('payroll_list')) menu-open 
      @endif">
      <a href="#" class="nav-link">
        <i class="nav-icon fa-solid fa-wallet"></i>
        <p>
          Payrolls
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('add_payroll')}}" class="nav-link {{ Request::is('add_payroll') ? 'nav-link active' : ''}}" style="{{ Request::is('add_payroll') ? 'background-color: #ff5d6c; !important' : ''}}">
              <i class="far fa-circle nav-icon" style="{{ Request::is('add_payroll') ? 'color: white; !important' : ''}}"></i>
              <p style="{{ Request::is('add_payroll') ? 'color: white; !important' : ''}}">Add Payroll</p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{route('payroll_list')}}" class="nav-link {{ Request::is('payroll_list') ? 'nav-link active' : ''}}" style="{{ Request::is('payroll_list') ? 'background-color: #ff5d6c; !important' : ''}}">
              <i class="far fa-circle nav-icon" style="{{ Request::is('payroll_list') ? 'color: white; !important' : ''}}"></i>
              <p style="{{ Request::is('payroll_list') ? 'color: white; !important' : ''}}">Payroll List</p>
            </a>
          </li>      
        </ul>
      </li>
      @endif

      @if((Auth::user()->role_id == 1) ||  (Auth::user()->role_id == 2))
      <li class="nav-item @if(Request::is('add_new_employee')) menu-open 
      @elseif(Request::is('employee_list')) menu-open 
      @endif">
      <a href="#" class="nav-link">
        <i class="nav-icon fa-solid fa-user"></i>
        <p>
          Employees
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('add_new_employee')}}" class="nav-link {{ Request::is('add_new_employee') ? 'nav-link active' : ''}}" style="{{ Request::is('add_new_employee') ? 'background-color: #ff5d6c; !important' : ''}}">
              <i class="far fa-circle nav-icon" style="{{ Request::is('add_new_employee') ? 'color: white; !important' : ''}}"></i>
              <p style="{{ Request::is('add_new_employee') ? 'color: white; !important' : ''}}">Add new Employee</p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{route('employee_list')}}" class="nav-link {{ Request::is('employee_list') ? 'nav-link active' : ''}}" style="{{ Request::is('employee_list') ? 'background-color: #ff5d6c; !important' : ''}}">
              <i class="far fa-circle nav-icon" style="{{ Request::is('employee_list') ? 'color: white; !important' : ''}}"></i>
              <p style="{{ Request::is('employee_list') ? 'color: white; !important' : ''}}">Employee List</p>
            </a>
          </li>       
        </ul>
      </li>
      @endif

      {{-- @if((Auth::user()->role_id == 1) ||  (Auth::user()->role_id == 2))
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
      @endif --}}
      
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


            <li class="nav-item @if(Request::is('add_item_category')) menu-open 
            @elseif(Request::is('item_category_list')) menu-open 
            @endif">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-layer-group"></i>
              <p>
                Item Category
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('add_item_category')}}" class="nav-link {{ Request::is('add_item_category') ? 'nav-link active' : ''}}" style="{{ Request::is('add_item_category') ? 'background-color: #1cdf1c; !important' : ''}}">
                    <i class="far fa-circle nav-icon" style="{{ Request::is('add_item_category') ? 'color: white; !important' : ''}}"></i>
                    <p style="{{ Request::is('add_item_category') ? 'color: white; !important' : ''}}">Add Item Category</p>
                  </a>
                </li>
                
                <li class="nav-item">
                  <a href="{{route('item_category_list')}}" class="nav-link {{ Request::is('item_category_list') ? 'nav-link active' : ''}}" style="{{ Request::is('item_category_list') ? 'background-color: #1cdf1c; !important' : ''}}">
                    <i class="far fa-circle nav-icon" style="{{ Request::is('item_category_list') ? 'color: white; !important' : ''}}"></i>
                    <p style="{{ Request::is('item_category_list') ? 'color: white; !important' : ''}}">Item Category List</p>
                  </a>
                </li>       
              </ul>
            </li>

            <li class="nav-item @if(Request::is('add_product_category')) menu-open 
            @elseif(Request::is('product_category_list')) menu-open 
            @endif">
            <a href="#" class="nav-link">
              <i class="nav-icon fa-solid fa-window-restore"></i>
              <p>
                Product Category
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('add_product_category')}}" class="nav-link {{ Request::is('add_product_category') ? 'nav-link active' : ''}}" style="{{ Request::is('add_product_category') ? 'background-color: #1cdf1c; !important' : ''}}">
                    <i class="far fa-circle nav-icon" style="{{ Request::is('add_product_category') ? 'color: white; !important' : ''}}"></i>
                    <p style="{{ Request::is('add_product_category') ? 'color: white; !important' : ''}}">Add Product Category</p>
                  </a>
                </li>
                
                <li class="nav-item">
                  <a href="{{route('product_category_list')}}" class="nav-link {{ Request::is('product_category_list') ? 'nav-link active' : ''}}" style="{{ Request::is('product_category_list') ? 'background-color: #1cdf1c; !important' : ''}}">
                    <i class="far fa-circle nav-icon" style="{{ Request::is('product_category_list') ? 'color: white; !important' : ''}}"></i>
                    <p style="{{ Request::is('product_category_list') ? 'color: white; !important' : ''}}">Product Category List</p>
                  </a>
                </li>       
              </ul>
            </li>


            <li class="nav-item @if(Request::is('requisition_list')) menu-open 
            
            @endif">
            <a href="#" class="nav-link">
              <i class="nav-icon fa-solid fa-box"></i>
              <p>
                Product Request
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
              <ul class="nav nav-treeview">
                
              
                <li class="nav-item">
                  <a href="{{route('requisition_list')}}" class="nav-link {{ Request::is('requisition_list') ? 'nav-link active' : ''}}" style="{{ Request::is('requisition_list') ? 'background-color: #1cdf1c; !important' : ''}}">
                    <i class="far fa-circle nav-icon" style="{{ Request::is('requisition_list') ? 'color: white; !important' : ''}}"></i>
                    <p style="{{ Request::is('requisition_list') ? 'color: white; !important' : ''}}">Requested Products</p>
                  </a>
                </li>       
              </ul>
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
              <i class="nav-icon fas fa-gem" 
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