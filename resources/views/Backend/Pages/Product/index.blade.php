@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')
@section('style')
@endsection
@section('content')
<div class="row">
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-body">
                <button data-bs-toggle="modal" data-bs-target="#productModal" type="button" class="btn-sm btn btn-success mb-2"><i class="mdi mdi-account-plus"></i>
                    Add New Product</button>

                <div class="table-responsive" id="tableStyle">
                    <table id="datatable1" class="table table-striped table-bordered    " cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Purchase Price</th>
                                <th>Sale Price</th>
                                <th>unit</th>
                                <th>Store</th>
                                <th>Quantity</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@include('Backend.Modal.product_modal')
@include('Backend.Modal.delete_modal')


@endsection

@section('script')
<script  src="{{ asset('Backend/assets/js/__handle_submit.js') }}"></script>
<script  src="{{ asset('Backend/assets/js/delete_data.js') }}"></script>

  <script type="text/javascript">
    $(document).ready(function(){
    handleSubmit('#productForm','#productModal');
    var table=$("#datatable1").DataTable({
    "processing":true,
    "responsive": true,
    "serverSide":true,
    beforeSend: function () {},
    complete: function(){},
    ajax: "{{ route('admin.product.get_all_data') }}",
    language: {
        searchPlaceholder: 'Search...',
        sSearch: '',
        lengthMenu: '_MENU_ items/page',
    },
    "columns":[
          {
            "data":"id"
          },
          {
            "data":"name"
          },
          {
            "data":"purchase_price"
          },
          {
            "data":"sale_price"
          },
          {
            "data":"unit.unit_name"
          },
          {
            "data":"store.name"
          },
          {
            "data":"qty"
          },

          {
            data:null,
            render: function (data, type, row) {



              return `<button  class="btn btn-primary btn-sm mr-3 edit-btn" data-id="${row.id}"><i class="fa fa-edit"></i></button>

              <button class="btn btn-danger btn-sm mr-3 delete-btn"  data-id="${row.id}"><i class="fa fa-trash"></i></button>
              `;
            }

          },
        ],
    order:[
        [0, "desc"]
    ],

    });

    });








    /** Handle Edit button click **/
    $('#datatable1 tbody').on('click', '.edit-btn', function () {
        var id = $(this).data('id');

        // AJAX call to fetch unit data
        $.ajax({
            url: "{{ route('admin.product.edit', ':id') }}".replace(':id', id),
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    $('#productForm').attr('action', "{{ route('admin.unit.update', ':id') }}".replace(':id', id));
                    $('#productModalLabel').html('<span class="mdi mdi-account-edit mdi-18px"></span> &nbsp;Edit Product');
                    $('#productForm input[name="name"]').val(response.data.name);

                    // Show the modal
                    $('#productModal').modal('show');
                } else {
                    toastr.error('Failed to fetch Supplier data.');
                }
            },
            error: function() {
                toastr.error('An error occurred. Please try again.');
            }
        });
    });

    /** Handle Delete button click**/
    $('#datatable1 tbody').on('click', '.delete-btn', function () {
        var id = $(this).data('id');
        var deleteUrl = "{{ route('admin.product.delete', ':id') }}".replace(':id', id);

        $('#deleteForm').attr('action', deleteUrl);
        $('#deleteModal').find('input[name="id"]').val(id);
        $('#deleteModal').modal('show');
    });





  </script>
@endsection
