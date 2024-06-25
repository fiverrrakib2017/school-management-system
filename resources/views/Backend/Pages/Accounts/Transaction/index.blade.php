@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Accounts Transaction</h4>
            </div>
            <div class="card-body">
                <form id="transaction_form" action="{{ route('admin.transaction.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="transaction_type">Transaction Type</label>
                                <select name="transaction_type" class="form-control" required>
                                    <option value="">---Select---</option>
                                    @foreach ($master_ledger as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="refer_no">Refer Number</label>
                                <input name="refer_no" class="form-control" placeholder="Enter Refer No.">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" placeholder="Enter Description" rows="1"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="ledger_id">Ledger</label>
                                <select name="ledger_id" id="ledger_id" class="form-control w-100" required>
                                    <option value="">---Select---</option>
                                    @foreach ($ledger as $item)
                                        <option value="{{ $item->id }}">{{ $item->ledger_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="sub_ledger_id">Sub Ledger</label>
                                <select name="sub_ledger_id" id="sub_ledger_id" class="form-select w-100" required>
                                    <option value="">---Select---</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3 d-flex align-items-end">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#addModal" class="btn btn-primary mt-2 btn-block w-100">Add Sub Ledger</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="qty">Quantity</label>
                                <input type="number" name="qty" class="form-control" placeholder="Enter Quantity" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="amount">Amount</label>
                                <input name="amount" class="form-control" placeholder="Enter Amount" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="total">Total</label>
                                <input readonly name="total" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-success mt-2 btn-block w-100">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Section Modal -->
<div class="modal fade bs-example-modal-lg" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <span class="mdi mdi-account-check mdi-18px"></span> &nbsp;Add New Sub Ledger
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!----- Start Add Form ------->
            <form id="addForm" action="{{ route('admin.sub_ledger.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <!----- Start Add Form input ------->
                    <div class="row">
                        <div class="form-group mb-2">
                            <label for="sectionName">Ledger:</label>
                            <select type="text" name="ledger_id" id="modal_ledger_id" class="form-control" style="width: 100%;"  required>
                            <option value="">---Select---</option>
                                @foreach ($ledger as $item)
                                    <option value="{{$item->id}}">{{ $item->ledger_name }}</option>
                                @endforeach
                           
                          </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="sectionName">Sub Ledger Name:</label>
                            <input type="text" name="sub_ledger_name" class="form-control" placeholder="Enter Sub Ledger Name" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="status">Status</label>
                            <select name="status" id="" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success tx-size-xs">Save changes</button>
                    <button type="button" class="btn btn-danger tx-size-xs" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
            <!----- End Add Form ------->
        </div>
    </div>
</div>
@endsection

@section('script')

<script type="text/javascript">
    $(document).ready(function() {
        $("select[name='transaction_type']").select2();
        $("select[id='ledger_id']").select2();
        $("select[id='sub_ledger_id']").select2();


        $("select[name='ledger_id']").on('change', function() {
            var ledger_id = $(this).val();
            if(ledger_id){
                    $.ajax({
                    url: "{{ route('admin.sub_ledger.get_sub_ledger', ':id') }}".replace(':id', ledger_id),
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.success==true) {
                            $("select[name='sub_ledger_id']").empty();
                            $("select[name='sub_ledger_id']").append('<option value="">---Select---</option>');
                            $.each(response.data, function(key, item) {
                                $("select[name='sub_ledger_id']").append('<option value="' + item.id + '">' + item.sub_ledger_name + '</option>');
                            });
                        }
                         
                        
                    }
                });
            }
        });
        function calculateTotal() {
            /*Get quantity amount*/ 
            var qty = parseFloat($("input[name='qty']").val()) || 0; 
            var amount = parseFloat($("input[name='amount']").val()) || 0; 
            var total = qty * amount; /*Calculate total*/
            $("input[name='total']").val(Math.round(total)); 
        }
        $("input[name='qty'], input[name='amount']").on('input', function() {
            calculateTotal();
        });
    });

    $('#addForm').submit(function(e) {
        e.preventDefault();

        /*Get the submit button*/
        var submitBtn = $(this).find('button[type="submit"]');

        var originalBtnText = submitBtn.html();

        submitBtn.html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">Loading...</span>`);
        submitBtn.prop('disabled', true); 

        var form = $(this);
        var url = form.attr('action');
        var formData = form.serialize();

        /*Use Ajax to send the request*/ 
        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            success: function(response) {
                if (response.success) { 
                    $('#addModal').modal('hide');
                    toastr.success(response.message);
                    form[0].reset();
                } 
            },
            error: function(xhr, status, error) {
                /*Handle errors*/ 
                console.error(xhr.responseText);
                toastr.error('An error occurred while processing the request.');
            },
            complete: function() {
                /** Reset button text and enable the button */
                submitBtn.html(originalBtnText);
                submitBtn.prop('disabled', false);
            }
        });
    });

    
    /*Transaction Form Submit*/
    $("#transaction_form").submit(function(e){
        e.preventDefault();
        /*Get the submit button*/ 
        var submitBtn =  $('form').find('button[type="submit"]');
        
        /* Save the original button text*/
        var originalBtnText = submitBtn.html();

        /*Change button text to loading state*/ 
        submitBtn.html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">Loading...</span>`);
        var form = $(this);
        var url = form.attr('action');
        var formData = form.serialize();
        /** Use Ajax to send the delete request **/
        $.ajax({
        type:'POST',
        'url':url,
        data: formData,
            success: function (response) {
                $('form')[0].reset();
                if (response.success) {
                    toastr.success(response.message);
                }
            },

            error: function (xhr, status, error) {
                /** Handle  errors **/
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                var errors = xhr.responseJSON.errors;
                var errorMessage = '';
                for (var key in errors) {
                    errorMessage += errors[key] + '<br>';
                }
                // Display error message to the user
                toastr.error(errorMessage);
                }
            },
            complete: function () {
                submitBtn.html(originalBtnText);
            }
        });
    });
  </script>


  @if(session('success'))
    <script>
        toastr.success("{{ session('success') }}");
    </script>
    @elseif(session('error'))
    <script>
        toastr.error("{{ session('error') }}");
    </script>
    @endif

@endsection
