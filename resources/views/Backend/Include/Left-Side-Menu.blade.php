<div class="left-side-menu">
    <div class="h-100" data-simplebar>
       <!--- Sidemenu -->
       <div id="sidebar-menu">
          <ul id="side-menu">
             <li>
                <a href="{{ route('admin.dashboard') }}">
                <i class="mdi mdi-view-dashboard-outline"></i>
                <span> Dashboard </span>
                </a>
             </li>
             <li>
                <a href="#student_management" data-bs-toggle="collapse">
                    <i class="menu-item-icon fas fa-receipt "></i>
                <span> Student Management </span>
                <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="student_management">
                   <ul class="nav-second-level">
                      <li>
                         <a href="{{ route('admin.student.section.index') }}">Section List</a>
                      </li>
                      <li>
                         <a href="{{ route('admin.student.class.index') }}">Class List</a>
                      </li>
                      <li>
                         <a href="{{ route('admin.student.index') }}">Student List</a>
                      </li>
                   </ul>
                </div>
             </li>
             <li>
                <a href="#teacher_management" data-bs-toggle="collapse">
                    <i class="menu-item-icon fas fa-receipt "></i>
                <span> Teacher Management </span>
                <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="teacher_management">
                   <ul class="nav-second-level">
                      <li>
                         <a href="{{ route('admin.teacher.index') }}">Teacher List</a>
                      </li>
                   </ul>
                </div>
             </li>
             
             <li>
                <a href="#customer_management" data-bs-toggle="collapse">
                    <i class="menu-item-icon fas fa-receipt "></i>
                <span> Customer Management </span>
                <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="customer_management">
                   <ul class="nav-second-level">
                      <li>
                        <a href="{{ route('admin.customer.create') }}">Customer Create</a>
                      </li>
                      <li>
                        <a href="{{ route('admin.customer.index') }}">Customer List</a>
                      </li>
                      <li>
                        <a href="{{ route('admin.customer.invoice.create_invoice') }}">Invoice Create</a>
                      </li>
                      <li>
                        <a href="{{ route('admin.customer.invoice.show_invoice') }}">Invoice Management</a>
                      </li>
                   </ul>
                </div>
             </li>
             <li>
                <a href="#product_management" data-bs-toggle="collapse">
                    <i class="menu-item-icon fas fa-receipt "></i>
                <span> Product Management </span>
                <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="product_management">
                   <ul class="nav-second-level">
                      <li>
                        <a href="{{ route('admin.brand.index') }}">Brand</a>
                      </li>
                      <li>
                        <a href="{{ route('admin.category.index') }}">Category</a>
                      </li>
                      <!-- <li>
                        <a href="{{ route('admin.subcategory.index') }}">Sub Category</a>
                      </li>
                      <li>
                        <a href="{{ route('admin.childcategory.index') }}">Child Category</a>
                      </li> -->
                      <li>
                        <a href="{{ route('admin.product.color.index') }}">Color</a>
                      </li>
                      <li>
                        <a href="{{ route('admin.product.size.index') }}">Size</a>
                      </li>
                      <li>
                        <a href="{{ route('admin.products.create') }}">Product Create</a>
                      </li>
                      <li>
                        <a href="{{ route('admin.products.index') }}">Product List</a>
                      </li>
                      <li>
                        <a href="{{ route('admin.product.stock.index') }}">Stock</a>
                      </li>
                   </ul>
                </div>
             </li>
             <li>
                <a href="#accounts_management" data-bs-toggle="collapse">
                    <i class="menu-item-icon fas fa-receipt "></i>
                <span> Accounts Management </span>
                <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="accounts_management">
                   <ul class="nav-second-level">
                      <li>
                        <a href="{{ route('admin.master_ledger.index') }}">Master Ledger</a>
                     </li>
                      <li>
                        <a href="{{ route('admin.ledger.index') }}">Ledger</a>
                     </li>
                     <li>
                        <a href="{{ route('admin.sub_ledger.index') }}">Sub Ledger</a>
                     </li>
                     <li>
                        <a href="{{ route('admin.transaction.index') }}">Transaction</a>
                     </li>
                   </ul>
                </div>
             </li>
          </ul>
       </div>
       <!-- End Sidebar -->
       <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
 </div>









