@extends('Backend.Layout.App')
@section('title','Product Profile | Admin Panel')
@section('style')
<style>
   #product_info > li {
   border-bottom: 1px dashed;
   }
   .section-header {
   background-color: #007bff;
   color: white;
   padding: 5px 10px;
   margin-bottom: 5px;
   border-radius: 5px;
   }
</style>
@endsection
@section('content')
<div class="row">
   <div class="row">
      <div class="">
         <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6">
               <div class="d-flex py-2" style="float:right;">
                  <abbr title="Complain">
                  <button type="button" data-bs-target="#ComplainModalCenter" data-bs-toggle="modal"
                     class="btn-sm btn btn-warning">
                  <i class="mdi mdi-alert-outline"></i>
                  </button>
                  </abbr>
                  &nbsp;
                  <abbr title="Payment received">
                  <button type="button" data-bs-target="#paymentModal" data-bs-toggle="modal"
                     class="btn-sm btn btn-info">
                  <i class="mdi mdi mdi-cash-multiple"></i>
                  </button>
                  </abbr>
                  &nbsp;
                  <abbr title="Disable">
                  <button type="button" class="btn-sm btn btn-danger">
                  <i class="mdi mdi mdi-wifi-off "></i>
                  </button>
                  </abbr>
                  &nbsp;
                  <abbr title="Reconnect">
                  <button type="button" class="btn-sm btn btn-success">
                  <i class="mdi mdi-sync"></i>
                  </button>
                  </abbr>
                  &nbsp;
                  <abbr title="Edit Customer">
                  <a href="{{ route('admin.products.edit', $product->id) }}">
                  <button type="button" class="btn-sm btn btn-info">
                  <i class="mdi mdi-account-edit"></i>
                  </button>
                  </a>
                  </abbr>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="container">
         <div class="main-body">
            <div class="row gutters-sm">
               <div class="col-md-4 mb-3">
                  <div class="card" style="height: 80vh; overflow-y: auto;">
                     <div class="card-header">
                        @php
                        $productImage = $product->product_image->first();
                        @endphp
                        <img src="{{ asset('uploads/product/' . $productImage->image) }}" alt='Product Image' class="img-fluid" style="max-width: 300px; max-height:200px;"/>
                     </div>
                     <div class="card-body" style="padding: 0 !important">
                        <ul class="list-group" id="product_info">
                           <li class="section-header">
                              <strong>Product Information</strong>
                           </li>
                           <li class="list-group-item list-group-item-action list-group-item-primary">
                              <strong>Title:</strong> {{ $product->title }}
                           </li>
                           <li class="list-group-item list-group-item-action list-group-item-primary">
                              <strong>SKU:</strong> {{ $product->sku }}
                           </li>
                           <li class="list-group-item list-group-item-action list-group-item-primary">
                              <strong>Barcode:</strong> {{ $product->barcode }}
                           </li>
                           <li class="list-group-item list-group-item-action list-group-item-primary">
                              <strong>Category:</strong> {{ $product->category->category_name }}
                           </li>
                           <li class="list-group-item list-group-item-action list-group-item-primary">
                              <strong>Brand:</strong> {{ $product->brand->brand_name }}
                           </li>
                           <li class="section-header">
                              <strong>Pricing Details</strong>
                           </li>
                           <li class="list-group-item list-group-item-action list-group-item-primary">
                              <strong>Purchase Price:</strong> {{ $product->p_price }}
                           </li>
                           <li class="list-group-item list-group-item-action list-group-item-primary">
                              <strong>Selling Price:</strong> {{ $product->s_price }}
                           </li>
                           <li class="list-group-item list-group-item-action list-group-item-primary">
                              <strong>Tax:</strong> {{ $product->tax }}
                           </li>
                           <li class="list-group-item list-group-item-action list-group-item-primary">
                              <strong>Delivery Charge:</strong> {{ $product->delivery_charge }}
                           </li>
                           <li class="section-header">
                              <strong>Product Details</strong>
                           </li>
                           <li class="list-group-item list-group-item-action list-group-item-primary">
                              <strong>Size:</strong> {{ $product->size }}
                           </li>
                           <li class="list-group-item list-group-item-action list-group-item-primary">
                              <strong>Color:</strong> {{ $product->color }}
                           </li>
                           <li class="list-group-item list-group-item-action list-group-item-primary">
                              <strong>Type:</strong> {{ $product->product_type }}
                           </li>
                           <li class="list-group-item list-group-item-action list-group-item-primary">
                              <strong>Description:</strong> {!! $product->description !!}
                           </li>
                           <li class="list-group-item list-group-item-action list-group-item-primary">
                              <strong>Short Description:</strong> {!! $product->short_description !!}
                           </li>
                           <li class="list-group-item list-group-item-action list-group-item-primary">
                              <strong>Shipping & Returns:</strong> {!! $product->shipping_returns !!}
                           </li>
                           <li class="list-group-item list-group-item-action list-group-item-primary">
                              <strong>Quantity:</strong> {{ $product->qty }}
                           </li>
                           <li class="list-group-item list-group-item-action list-group-item-primary">
                              <strong>Status:</strong> {{ $product->status ? 'Active' : 'Inactive' }}
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="col-md-8">
                  <div class="row">
                     <!-- Earnings (Monthly) Card Example -->
                     <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card shadow  py-2" style="border-left:3px solid #27F10F;">
                           <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                 <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                       Total Payable
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                       00
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card shadow  py-2" style="border-left:3px solid #27F10F;">
                           <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                 <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                       Total Paid
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                       00
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- Pending Requests Card Example -->
                     <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card shadow  py-2" style="border-left:3px solid red;">
                           <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                 <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                       Total Due
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                       00
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="container">
                     <div class="row">
                        <div class="card">
                           <div class="card-body">
                              <!-- Nav tabs -->
                              <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                 <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#transaction"
                                       role="tab">
                                    <span class="d-none d-md-block">Transaction
                                    </span><span class="d-block d-md-none"><i
                                       class="mdi mdi-home-variant h5"></i></span>
                                    </a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#invoice"
                                       role="tab">
                                    <span class="d-none d-md-block">Invoice</span><span
                                       class="d-block d-md-none"><i
                                       class="mdi mdi-account h5"></i></span>
                                    </a>
                                 </li>
                              </ul>
                              <!-- Tab panes -->
                              <div class="tab-content">
                                 <div class="tab-pane active p-3" id="transaction" role="tabpanel">
                                    <div class="card">
                                       <div class="card-body">
                                          <div class="row">
                                             <div class="table-responsive">
                                                <table id="transaction_datatable"
                                                   class="table table-bordered dt-responsive nowrap"
                                                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                   <thead>
                                                      <tr>
                                                         <th>ID</th>
                                                         <th>Amount</th>
                                                         <th>Date</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody>
                                                      <!--  -->
                                                   </tbody>
                                                </table>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="tab-pane  p-3" id="invoice" role="tabpanel">
                                    <div class="card">
                                       <div class="card-body">
                                          <div class="row">
                                             <div class="table-responsive">
                                                <table id="invoice_datatable"
                                                   class="table table-bordered dt-responsive nowrap"
                                                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                   <thead>
                                                      <tr>
                                                         <th>Invoice id</th>
                                                         <th>Sub Total</th>
                                                         <th>Discount</th>
                                                         <th>Grand Total</th>
                                                         <th>Create Date</th>
                                                         <th></th>
                                                      </tr>
                                                   </thead>
                                                   <tbody id="ticket-list">
                                                   </tbody>
                                                </table>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
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