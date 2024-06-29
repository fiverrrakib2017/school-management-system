@extends('Backend.Layout.App')

@section('title','Dashboard | School Management System ')

@section('content')
<div class="row">
  <div class="col-md-2 offset-md-10 mt-3 mb-2">
    <div>
      <select name="dateFilter" class="form-select select2" data-placeholder="Choose location">
        <option label="Choose one"></option>
        <option value="today" selected>Today</option>
        <option value="last7days">Last 7 Days</option>
        <option value="this_month">This Month</option>
        <option value="last_month">Last Month</option>
        <option value="this_year">This Year</option>
        <option value="last_year">Last Year</option>
        <option value="last_two_years">Last 2 Years</option>
      </select>
    </div>
  </div>
</div>

<div class="row">
  <!-- Total Sales -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card shadow py-2" style="border-left:3px solid #27F10F;">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Sales</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">৳ <span id="total_sales_amount">0</span></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Total Purchase -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card shadow py-2" style="border-left:3px solid #4e73df;">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Purchase</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">৳ <span id="total_purchase_amount">0</span></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-cart-plus fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Total Customer Orders -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card shadow py-2" style="border-left:3px solid #27F10F;">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Customer Orders</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">৳ <span id="total_customer_order">0</span></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-file-invoice-dollar fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Net Profit -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card shadow py-2" style="border-left:3px solid #27F10F;">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Net Profit</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">৳ <span id="net_profit">0</span></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="row">
  <!-- Total Customer -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card shadow py-2" style="border-left:3px solid #27F10F;">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Customer</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="total_customer">0</span></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-users fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Total Suppliers -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card shadow py-2" style="border-left:3px solid #36b9cc;">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Suppliers</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">৳ <span id="total_supplier">0</span></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-truck fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Total Products -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card shadow py-2" style="border-left:3px solid #4e73df;">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Products</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">৳ <span id="total_products">0</span></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-boxes fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Total Stock -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card shadow py-2" style="border-left:3px solid #f6c23e;">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Stock</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="total_stock">0</span></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-box-open fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">        
        <!-- Total Students Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card shadow py-2" style="border-left:3px solid #4e73df;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Students
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                               00
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Total Teachers Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card shadow py-2" style="border-left:3px solid #f6c23e;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Teachers
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                               00
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Total Classes Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card shadow py-2" style="border-left:3px solid #e74a3b;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Total Classes
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                               00
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-school fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
  <!-- Latest Customers -->
  <div class="col-lg-6 mb-4">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Latest Customers</h6>
      </div>
      <div class="card-body">
        <div id="latest_customer_loading">
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">Loading...</span>
        </div>
        <table id="customer_table" class="table table-striped d-none">
          <thead>
            <tr>
              <th>Photo</th>
              <th>Customer Name</th>
              <th>Phone Number</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
      <div class="card-footer text-center">
        <a href="{{ route('admin.customer.index') }}" class="m-0 small text-primary">View All Customer Data</a>
      </div>
    </div>
  </div>

  <!-- Top Rated Products -->
  <div class="col-lg-6 mb-4">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Top Rated Products</h6>
      </div>
      <div class="card-body">
        <div id="top_rated_product_loading">
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">Loading...</span>
        </div>
        <table id="__top_rated_product" class="table table-striped ">
          <thead>
            <tr>
              <th>Image</th>
              <th>Item Name</th>
              <th>Total Sold</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
      <div class="card-footer text-center">
        <a href="{{route('admin.products.index')}}" class="m-0 small text-primary">View All Products</a>
      </div>
    </div>
  </div>
</div>
   
    
    <div class="row">
        <!-- Latest Students -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Latest Students</h6>
                </div>
                <div class="card-body">
                    <div id="latest_students">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">Loading...</span>
                    </div>
                    <table id="table_students" class="table d-none table-responsive-md">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Grade</th>
                                <th>Date Joined</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Top Performing Students -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Top Performing Students</h6>
                </div>
                <div class="card-body">
                    <div id="top_rated_product_loading">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <table id="__top_rated_product" class="table table-striped d-none">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Item Name</th>
                                <th>Total Sold</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function(){
      /*get top rated product*/
      __top_rated_product();
       /*get Latest Customer Data Dashboard Page*/
      __customer_data();


      /* get dashboard calcualtion data*/
      /* Call the function and default value "today"*/
      __fetch_data("today");

$('select[name="dateFilter"]').on('change', function () {
  var data = $(this).val();
  __fetch_data(data);
});

function __fetch_data(date) {
  $.ajax({
    url: "{{ route('admin.dashboard_get_all_data') }}",
    type: 'POST',
    data: { date: date },
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
    success: function (response) {
      $('#total_sales_amount').text(response.total_sales_amount);
      $('#total_purchase_amount').text(response.total_purchase_amount);
      $('#total_customer').text(response.total_customer);
      $('#total_supplier').text(response.total_supplier);
      $('#total_products').text(response.total_products);
      $('#total_customer_invoice').text(response.total_customer_invoice);
      $('#net_profit').text(response.net_profit);
      $('#total_customer_order').text(response.total_customer_order);
      $('#total_stock').text(response.total_quantity);
    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
    }
  });
}
      /*get Latest Customer Data Dashboard Page*/
      function __customer_data(){
        $.ajax({
            url: "{{ route('admin.dashboard_get_all_data') }}",
            type: 'POST',
            data: { data: 'customer_data' },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function(response){
                $("#latest_customer_loading").addClass('d-none');
                $("#customer_table").removeClass('d-none');
                var __baseUrl = '{{ url("/") }}';
                var __tbody = $("#customer_table tbody");
                __tbody.empty();
                for (let i = 0; i < response.length; i++) {
                    var customer = response[i];
                    var formatted_date = new Date(customer.created_at);
                    var __month_names = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                    var __formated_string = __month_names[formatted_date.getMonth()] + ' ' +
                    formatted_date.getDate() + ', ' +
                    formatted_date.getFullYear() + ' ' +
                    formatted_date.toLocaleTimeString([], { hour: 'numeric', minute: '2-digit' });
                    var __profile_image = customer.profile_image == null ? 
                        'https://via.placeholder.com/500' : 
                        __baseUrl + '/Backend/uploads/photos/' + customer.profile_image;

                    var newRow = $("<tr>");
                    newRow.append('<td class="pd-l-20"><img src="'+__profile_image+'" class="wd-36 " alt="Image" style="height:50px"></td>');
                    newRow.append('<td><a href="' + __baseUrl + '/admin/customer/view/' + customer.id + '" class="tx-inverse tx-14 tx-medium d-block">' + customer.fullname + '</a></td>');

                    newRow.append('<td>' + customer.phone_number + '</td>');

                    __tbody.append(newRow);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                $("#latest_customer_loading").addClass('d-none');
                $("#customer_table").removeClass('d-none');
            }
        });
    }
      /*get Latest Customer Data Dashboard Page*/
      function __top_rated_product() {
        $.ajax({
            url: "{{ route('admin.dashboard_get_all_data') }}",
            type: 'POST',
            data: { data: 'get_top_rated_product' },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function(response) {
                $('#__top_rated_product tbody').empty();
                var __baseUrl = '{{ url("/") }}';
                var tableBody = '';

                // Append new data
                $.each(response, function(index, product) {
                    var __product_image = __baseUrl + '/uploads/product/' + product.product_image;
                    var __max_length = 50;
                    var __short_tittle = product.product_title.length > __max_length ? product.product_title.substring(0, __max_length) + '...' : product.product_title;

                    tableBody += '<tr>';
                    tableBody += '<td class=""><img src="' + __product_image + '" class="w-55" alt="Image" style="height:50px"></td>';
                    tableBody += '<td><a href="#" class="" title="' + product.product_title + '">' + __short_tittle + '</a></td>';
                    tableBody += '<td class="">' + product.total_qty + '</td>';
                    tableBody += '</tr>';
                });

                $('#__top_rated_product tbody').html(tableBody);
                $('#top_rated_product_loading').addClass('d-none');
                $('#__top_rated_product').removeClass('d-none');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
    });
  </script>
@endsection
