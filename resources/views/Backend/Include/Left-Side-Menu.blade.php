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
                         <a href="{{ route('admin.student.subject.index') }}">Subject</a>
                        </li>
                        <li>
                         <a href="{{ route('admin.student.class.routine.index') }}">Class Routine</a>
                        </li>
                        <li>
                         <a href="{{ route('admin.student.section.index') }}">Section</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.student.exam.index') }}">Examination</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.student.exam.routine.index') }}">Examination Routine</a>
                        </li>
                        <li>
                            <a href="#">Examination Result</a>
                        </li>
                        <li>
                         <a href="{{ route('admin.student.shift.index') }}">Shift</a>
                        </li>
                        <li>
                         <a href="{{ route('admin.student.leave.index') }}">Leave</a>
                        </li>

                        <li>
                           <a href="{{ route('admin.student.attendence.index') }}">Attendance</a>
                        </li>
                        <li>
                           <a href="{{ route('admin.student.attendence.log') }}">Attendance Report</a>
                        </li>
                        <li>
                           <a href="{{route('admin.student.fees_type.index')}}">Fees Type</a>
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
                      <li>
                         <a href="{{ route('admin.teacher.transaction.index') }}">Transaction</a>
                      </li>
                      <li>
                         <a href="{{ route('admin.teacher.transaction.report') }}">Report</a>
                      </li>
                      <li>
                           <a href="{{ route('admin.teacher.attendence.index') }}">Attendance</a>
                        </li>
                      <li>
                      <a href="{{ route('admin.teacher.attendence.log') }}">Attendance Report</a>
                        </li>
                   </ul>
                </div>
             </li>
             <li>
                <a href="#ticket_management" data-bs-toggle="collapse">
                    <i class="menu-item-icon fas fa-ticket-alt"></i>
                <span> Tickets </span>
                <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="ticket_management">
                   <ul class="nav-second-level">
                        <li><a href="{{ route('admin.tickets.index') }}">Ticket List </a> </li>
                        <li> <a href="{{ route('admin.tickets.complain_type.index') }}">Complain Type </a> </li>
                        <li> <a href="{{ route('admin.tickets.assign.index') }}">Ticket Assign</a> </li>
                   </ul>
                </div>
             </li>
             <li>
                <a href="#inventory_management" data-bs-toggle="collapse">
                    <i class="menu-item-icon fas fa-boxes"></i>
                <span>Inventory</span>
                <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="inventory_management">
                   <ul class="nav-second-level">
                        <li>
                            <a href="{{ route('admin.customer.invoice.create_invoice') }}">Sale</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.customer.invoice.show_invoice') }}">Sales Invoice</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.supplier.invoice.create_invoice') }}">Purchase</a>
                          </li>
                        <li>
                            <a href="{{ route('admin.supplier.invoice.show_invoice') }}">Purchase Invoice</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.brand.index') }}">Brand</a>
                          </li>
                          <li>
                            <a href="{{ route('admin.category.index') }}">Category</a>
                          </li>
                          <li>
                            <a href="{{ route('admin.unit.index') }}">Units</a>
                          </li>
                          <li>
                            <a href="{{ route('admin.store.index') }}">Store</a>
                          </li>
                          <li>
                            <a href="{{ route('admin.product.index') }}">Products</a>
                          </li>
                          <li>
                            <a href="{{ route('admin.supplier.index') }}">Supplier </a>
                          </li>
                          <li>
                            <a href="{{ route('admin.customer.index') }}">Customer </a>
                          </li>
                          <li>
                            <a href="{{ route('admin.customer.tickets.index') }}">Customer Ticket</a>
                          </li>
                   </ul>
                </div>
             </li>
             <li>
                <a href="#accounts_management" data-bs-toggle="collapse">
                    <i class="menu-item-icon fas fa-file-invoice-dollar"></i>
                <span>Accounts</span>
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
                     <li>
                        <a href="{{ route('admin.transaction.report.index') }}">Report</a>
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
