@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')
@section('style')
<style>
button#submitButton {
    margin-top: 26px;
}

</style>

@endsection
@section('content')
<!-- br-pageheader -->
<div class="row">
    <div class="container-fluid">
        <form id="form-data" action="{{ route('admin.customer.invoice.store_invoice') }}" method="post">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header">
                        <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="refer_no" class="form-label">Refer No:</label>
                                        <input class="form-control" type="text" placeholder="Type Your Refer No" id="refer_no" name="refer_no">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group mt-2">
                                        <label>Client Name</label>
                                        <div class="input-group">
                                        <select type="text" id="client_name" name="client_id" class="form-select select2">
                                            <option value="">---Select---</option>
                                            @php
                                            $customers = \App\Models\Customer::latest()->get();
                                            @endphp
                                            @if($customers->isNotEmpty())
                                                @foreach($customers as $item)
                                                    <option value="{{ $item->id }}">{{ $item->fullname }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                            <button type="button" class="btn btn-primary add-client-btn" data-bs-toggle="modal" data-bs-target="#CustomerModal"><span>+</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="note" class="form-label">Note:</label>
                                        <input class="form-control" type="text" placeholder="Notes" id="note" name="note">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="currentDate" class="form-label">Invoice Date</label>
                                        <input class="form-control" type="date" id="currentDate" name="date">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="product_item" class="form-label">Product</label>
                                        <div class="input-group">
                                            <select id="product_name" class="form-select select2" aria-label="Product Name">
                                                <option value="">---Select---</option>
                                                @php
                                                $products = \App\Models\Product::latest()->get();
                                                @endphp
                                                @if($products->isNotEmpty())
                                                    @foreach($products as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <button type="button" class="btn btn-primary add-product-btn" data-bs-toggle="modal" data-bs-target="#productModal">
                                                <span>+</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="qty" class="form-label">Quantity</label>
                                        <input type="number" id="qty" class="form-control" min="1" value="1">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="text" class="form-control price" id="price" placeholder="00">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="total_price" class="form-label">Total Price</label>
                                        <input id="total_price" type="text" class="form-control total_price" placeholder="00">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="details" class="form-label">Notes</label>
                                        <input id="details" type="text" class="form-control" placeholder="Notes">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group ">
                                    <button type="button" id="submitButton" class="btn btn-primary">Add Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered" id="invoiceTable">
                    <thead class="bg bg-info text-white">
                        <th>Product List</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th></th>
                    </thead>
                    <tbody id="tableRow"></tbody>

                    </table>
                    <div class="form-group text-end">
                        <button type="button" name="finished_btn" class="btn btn-success"><i class="fe fe-dollar"></i>Process</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@include('Backend.Modal.customer_modal')
@include('Backend.Modal.product_modal')
@endsection


@section('script')
<script  src="{{ asset('Backend/assets/js/__handle_submit.js') }}"></script>
<script  src="{{ asset('Backend/assets/js/custom_select.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        custom_select2_without_modal('#form-data');
        custom_select2('#productModal');
        custom_select2('#CustomerModal');
        handleSubmit('#CustomerForm','#CustomerModal');
        handleSubmit('#productForm','#productModal');
    });
    function __get_short_string(str,num){
        if(str.length <=num){
          return str;
        }
       return str.slice(0,num)+'...';
    }
</script>


@endsection



