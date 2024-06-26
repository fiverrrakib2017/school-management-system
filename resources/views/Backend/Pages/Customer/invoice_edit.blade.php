@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')
@section('content')
<!-- br-pageheader -->
<div class="row">
<div class="row d-flex">
   <div class="col-md-12">
      <div class="row d-flex">
         <div class="col-md-7  ">
            <div class="card card-body">
               <form id="form-data" action="{{route('admin.customer.invoice.update_invoice')}}" method="post">@csrf
                  @foreach ($data as $item)
                      <input type="text" value="{{$item->id}}" name="id" class="d-none">
                  @endforeach
                  <div class="input-group mb-2">
                     <label><span class="input-group-text" id="inputGroupPrepend" style="display: inline-block;"><i class="fa fa-barcode"></i></span></label>
                     <input type="text"  placeholder="Enter Your QR Bar code here" class="form-control" autofocus>
                  </div>
                  <div class="form-group mb-2">
                     <label>Product Name</label>
                     <select type="text" id="product_name"  class="form-select" style="width:100%">
                        <option>Select</option>
                        @foreach ($product as $item)
                            <option value="{{$item->id}}">{{ $item->title }}</option>
                        @endforeach

                     </select>
                  </div>
                  <div class="form-group mb-2">
                     <label>Customer Name</label>
                     <select type="text" id="customer_name" name="customer_id" class="form-select" style="width:100%">
                        <option>---Select---</option>
                        @foreach ($customer as $customerItem)
                           @foreach ($data as $invoice)
                                 @if ($invoice->customer->id == $customerItem->id)
                                    <option value="{{ $customerItem->id }}" selected>{{ $customerItem->fullname }}</option>
                                 @else
                                    <option value="{{ $customerItem->id }}">{{ $customerItem->fullname }}</option>
                                 @endif
                           @endforeach
                        @endforeach 
                     </select>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <table class="table table-bordered">
                           <thead class="bg bg-info text-white">
                              <th>Product List</th>
                              <th>Qty</th>
                              <th>Price</th>
                              <th>Total</th>
                              <th></th>
                           </thead>
                           <tbody id="tableRow">
                           @foreach ($data as $invoice)
                              @foreach ($invoice->items as $item)
                                 <tr>
                                    <td>
                                    @foreach ($product as $productItem)
                                       @if ($productItem->id == $item->product_id)
                                          @php
                                             $title = strlen($productItem->title) > 50 ? substr($productItem->title, 0, 50) . '...' : $productItem->title;
                                          @endphp
                                          {{ $title }}
                                          <input type="hidden" name="product_id[]" value="{{ $productItem->id }}">
                                       @endif
                                    @endforeach
                                    </td>
                                    <td>
                                          <input type="number" class="form-control qty" name="qty[]" value="{{ intval($item->qty) }}">
                                    </td>
                                    <td>
                                          <input readonly type="number" class="form-control" name="price[]" value="{{ intval($item->price) }}">
                                    </td>
                                    <td>
                                          <input readonly type="number" class="form-control" id="total_price" name=total_price[]  value="{{ intval($item->total_price )}}">
                                    </td>
                                    <td>
                                       <a  type="button" id="itemRow"><i class="mdi mdi-close" ></i></a>
                                    </td>
                                 </tr>
                              @endforeach
                        @endforeach
                           </tbody>
                           <tfoot class="">
                           @foreach ($data as $data)
                              <tr>
                                 <th class="text-center" colspan="2"></th>
                                 <th class="text-left" colspan="3">
                                    Total Amount <input readonly class="form-control total_amount" name="total_amount" type="text" value="{{ intval($data->total_amount) }}">
                                 </th>
                              </tr>
                              <tr>
                                 <th class="text-center" colspan="2"></th>
                                 <th class="text-left" colspan="3">
                                    Paid Amount <input  type="text" class="form-control paid_amount" name="paid_amount" value="{{ intval($data->paid_amount) }}">
                                 </th>
                              </tr>
                              <tr>
                                 <th class="text-center" colspan="2"></th>
                                 <th class="text-left" colspan="3">
                                    Due Amount <input type="text" readonly class="form-control due_amount" name="due_amount" value="{{ intval($data->due_amount) }}">
                                 </th>
                              </tr>
                              @endforeach
                           </tfoot>
                        </table>
                        <div class="form-group text-center">
                           <button type="submit"  class="btn btn-success"><i class="fe fe-dollar"></i> Update Now</button>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
         <div class="col-md-5">
            <div class="card ">
               <div class="card-header">
                  <input type="search-input" name="product_name_search" class="form-control" placeholder="Type Your Search product Name">
               </div>
               <div class="card-body">
                  <div class="container">
                     <div class="row" id="search-results">
                        @foreach ($products as $product)
                           <div class="col-sm-6 py-1">
                              <div class="product-list-box card p-2">
                                 <a href="javascript:void(0);"   onclick="__get_product({{ $product->id }})">
                                 <img src="{{ asset('uploads/product/' . $product->product_image[0]->image ) }}" class="img-fluid" alt="work-thumbnail" style="height: 150px; width: 150px; ">
                                 </a>
                                 <div class="detail">
                                 <h6 class="font-size-10 mt-2"><a href="#" onclick="__get_product({{ $product->id }})" class="text-dark">{{ Illuminate\Support\Str::limit($product->title, 40) }}</a> </h6>
                                    <span>Price: {{ $product->s_price }}</span><br>
                                    <span>Stock: {{ $product->qty }}</span>
                                 </div>
                              </div>
                           </div>
                        @endforeach
                     </div>
                     <div class="row mt-4">
                        <nav aria-label="Page navigation">
                           <ul class="pagination pagination-basic mg-b-0">
                                 <li class="page-item {{ $products->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $products->previousPageUrl() }}" aria-label="Previous">
                                       <span aria-hidden="true">&laquo;</span>
                                    </a>
                                 </li>
                                 @for ($i = 1; $i <= $products->lastPage(); $i++)
                                    <li class="page-item {{ $i === $products->currentPage() ? 'active' : '' }}">
                                       <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
                                    </li>
                                 @endfor
                                 <li class="page-item {{ $products->hasMorePages() ? '' : 'disabled' }}">
                                    <a class="page-link" href="{{ $products->nextPageUrl() }}" aria-label="Next">
                                       <span aria-hidden="true">&raquo;</span>
                                    </a>
                                 </li>
                           </ul>
                        </nav>
                     </div>

                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
      $("#customer_name").select2();
      $(document).on('change','#product_name',function(){
         var product_id = $(this).val();
         __get_product(product_id);
      });
      /*Show Product item */
      __get_product=(product_id)=>{
         $.ajax({
            url: "{{ route('admin.products.get_product', ':id') }}".replace(':id', product_id),
            method: "GET",
            success: function(response) {

            $.each(response, function(index, product) {
               var product_exists=false;
               /*Check if the product already exists in the table*/
               $("#tableRow tr").each(function(){
                  var existing_product_id=$(this).find('input[name="product_id[]"]').val();
                  if (existing_product_id==product_id) {
                     product_exists=true;
                     return false;
                  }
               });
               if (product_exists) {
                  toastr.error("Product already added. Please increase the quantity.");
                  return false;
               }
               /* Create table row with product details*/
               var row = '<tr>' +
                     '<td><input type="hidden" name="product_id[]" value="'+product.id+'">'+__get_short_string(product.title,50)+'</td>'+

                     '<td><input type="number" min="1" name="qty[]"  value="1" class="form-control qty"></td>' +

                     '<td><input readonly type="number"  name=price[] class="form-control " value="' + product.s_price + '"></td>' +

                     '<td><input readonly type="number" id="total_price"  name=total_price[] class="form-control" value="' + product.s_price+ '"></td>' +

                     '<td><a class="btn-sm  btn-danger" type="button" id="itemRow"><i class="mdi mdi-close" ></i></a></td>' +
                     '</tr>';

               // Append row to the table body
               $('#tableRow').append(row);
               calculateTotalPrice();
            });
            }
         });
      }


      $(document).on('change', '[name="qty[]"]', function() {
         var quantity = $(this).val();
         var price = $(this).closest('tr').find('[name="price[]"]').val();
         var total_price = Number(quantity * price);
         $(this).closest('tr').find('[name="total_price[]"]').val(total_price);
         calculateTotalPrice();
      });



      $(document).on('click', '#itemRow', function() {
         $(this).closest('tr').remove();
         $(".paid_amount").val('');
         $(".due_amount").val('');
         calculateTotalPrice();
      });



      function calculateTotalPrice() {
         var totalPrice = 0;
         $('[name="total_price[]"]').each(function() {
            totalPrice += parseFloat($(this).val() || 0);
         });
         $('.total_amount').val(totalPrice);
      }

      $(document).on('keyup','.paid_amount',function(){
         var paid_amount=$(this).val();
         var total_amount=$('.total_amount').val();
         var totalDue=Number(total_amount-paid_amount);
         /*check don't give much more money*/
         if (Number(paid_amount) > Number(total_amount)) {
            $(this).val(total_amount);
            total_due=0;
            $('.due_amount').val(total_due);
            return false;
         }
         $(".due_amount").val(totalDue);

      });
      $("form").submit(function(e){
         e.preventDefault();

         var form = $(this);
         form.find('button[type="submit"]').prop('disabled',true).html(`<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>`);
         var url = form.attr('action');
         var formData = form.serialize();
            /** Use Ajax to send the  request **/
            $.ajax({
            type:'POST',
            'url':url,
            data: formData,
            success: function (response) {
               if (response.success==true) {
                  toastr.success(response.message);
                     setTimeout(() => {
                     location.reload();
                  }, 500);
               }
               if(response.success==false){
                  toastr.success(response.message);
               }
            },

            error: function (xhr, status, error) {
               /** Handle  errors **/
               if (xhr.status === 400) {
                  toastr.error(xhr.responseJSON.message);
                  return false;
               }
               if (xhr.responseJSON && xhr.responseJSON.errors) {
                  var errors = xhr.responseJSON.errors;
                  Object.values(errors).forEach(function(errorMessage) {
                     toastr.error(errorMessage);
                  });
                  return false;
               }
                else {
                  console.error(xhr.responseText);
                  toastr.error('Server Problem');
               }
            },complete: function() {
               form.find('button[type="submit"]').prop('disabled',false).html('Create Now');
            }
         });
      });

      $(document).on('keyup', '[name="product_name_search"]', function() {
         var search = $(this).val();
         if (search.trim() === '') {
            fetchAllProducts();
         } else {
            searchProducts(search);
         }
      });
      function fetchAllProducts(){
         $.ajax({
            url: "{{ route('admin.customer.invoice.search_product_data') }}",
            method: 'POST',
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            data: { search: '' },
            success: function(response) {
               if (response.success) {
                  displayProducts(response.data);
               }
            },
            error: function(xhr, status, error) {
               console.error(xhr.responseText);
            }
         });
      }
      function searchProducts(search) {
         $.ajax({
            url: "{{ route('admin.customer.invoice.search_product_data') }}",
            method: 'POST',
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            data: { search: search },
            success: function(response) {
               if (response.success) {
                  displayProducts(response.data);
               }
            },
            error: function(xhr, status, error) {
               console.error(xhr.responseText);
            }
         });
      }
      function displayProducts(products) {
         var products_container = $('#search-results');
         products_container.empty();
         $.each(products, function(index, product) {
            var imageUrl = product.product_image.length > 0 ? product.product_image[0].image : '';
            var newImageUrl = imageUrl !== '' ? "{{ asset('uploads/product/') }}/" + imageUrl : '';
            products_container.append(
                  `<div class="col-sm-6 py-1">
                     <div class="product-list-box card p-2">
                        <a href="javascript:void(0);" onclick="__get_product(${product.id})">
                              <img src="${newImageUrl}" class="img-fluid" alt="work-thumbnail" style="height: 150px; width: 150px;">
                        </a>
                        <div class="detail">
                              <h6 class="font-size-10 mt-2"><a href="#" onclick="__get_product(${product.id})" class="text-dark">${__get_short_string (product.title,40)}</a></h6>
                              <span>Price: ${ product.s_price}</span><br>
                              <span>Stock: ${product.qty}</span>
                        </div>
                     </div>
                  </div>`
            );
         });
      }
      function __get_short_string(str,num){
         if(str.length <=num){
            return str;
         }
         return str.slice(0,num)+'...';
      }
    });
</script>


@endsection



