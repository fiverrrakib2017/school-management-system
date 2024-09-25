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
                    <i class="menu-item-icon fas fa-user-graduate"></i>
                <span> Students </span>
                <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="student_management">
                   <ul class="nav-second-level">
                        <li>
                           <a href="{{ route('admin.student.index') }}">Student</a>
                        </li>
                        <li>
                         <a href="{{ route('admin.student.class.index') }}">Class</a>
                        </li>
                        <li>
                         <a href="{{ route('admin.student.section.index') }}">Section</a>
                        </li>
                        <li>
                           <a href="{{route('admin.student.bill_collection.index')}}">Bill Collection</a>
                        </li>
                   </ul>
                </div>
             </li>
             <li>
                <a href="#teacher_management" data-bs-toggle="collapse">
                    <i class="menu-item-icon fas fa-chalkboard-teacher"></i>
                <span> Teachers </span>
                <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="teacher_management">
                   <ul class="nav-second-level">
                      <li>
                         <a href="{{ route('admin.teacher.index') }}">Teacher </a>
                      </li>
                   </ul>
                </div>
             </li>
             
             <li>
                <a href="#customer_management" data-bs-toggle="collapse">
                    <i class="menu-item-icon fas fa-users"></i>
                <span> Customers </span>
                <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="customer_management">
                   <ul class="nav-second-level">
                      <li>
                        <a href="{{ route('admin.customer.index') }}">Customer </a>
                      </li>
                   </ul>
                </div>
             </li>
             <li>
                <a href="#supplier_management" data-bs-toggle="collapse">
                    <i class="menu-item-icon fas fa-truck"></i>
                <span> Suppliers </span>
                <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="supplier_management">
                   <ul class="nav-second-level">
                      <li>
                        <a href="{{ route('admin.supplier.index') }}">Supplier </a>
                      </li>
                   </ul>
                </div>
             </li>
             <li>
                <a href="#product_management" data-bs-toggle="collapse">
                    <i class="menu-item-icon fas fa-box"></i>
                <span> Products </span>
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
                        <a href="{{ route('admin.products.index') }}">Product </a>
                      </li>
                      <li>
                        <a href="{{ route('admin.product.stock.index') }}">Stock</a>
                      </li>
                   </ul>
                </div>
             </li>
             <li>
                <a href="#sales_management" data-bs-toggle="collapse">
                    <i class="menu-item-icon fas fa-shopping-cart"></i>
                <span>Sales </span>
                <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sales_management">
                   <ul class="nav-second-level">
                      <li>
                        <a href="{{ route('admin.customer.invoice.create_invoice') }}">Sale</a>
                      </li>
                      <li>
                        <a href="{{ route('admin.customer.invoice.show_invoice') }}">Sales Invoice</a>
                      </li>
                   </ul>
                </div>
             </li>
             <li>
                <a href="#purchase_management" data-bs-toggle="collapse">
                    <i class="menu-item-icon fas fa-shopping-bag"></i>
                <span>Purchases </span>
                <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="purchase_management">
                   <ul class="nav-second-level">
                      <li>
                        <a href="{{ route('admin.supplier.invoice.create_invoice') }}">Purchase</a>
                      </li>
                      <li>
                        <a href="{{ route('admin.supplier.invoice.show_invoice') }}">Purchase Invoice</a>
                      </li>
                   </ul>
                </div>
             </li>
             <li>
                <a href="#accounts_management" data-bs-toggle="collapse">
                    <i class="menu-item-icon fas fa-file-invoice-dollar"></i>
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
