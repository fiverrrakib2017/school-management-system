@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')
@section('style')
 <!-- vendor css -->
	<link href="{{asset('Backend/lib/highlightjs/styles/github.css')}}" rel="stylesheet">
  
    <link href="{{asset('Backend/lib/datatables.net-dt/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('Backend/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css')}}" rel="stylesheet">

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="{{asset('Backend/css/bracket.css')}}">
    <style>
        .loading-spinner {
        border:4px solid #f1f1f1;
        border-left-color: #000000;;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        animation: spin 1s linear infinite;
        }

        @keyframes spin {
        to {
            transform: rotate(360deg);
        }
        }

    </style>
@endsection
@section('content')
      <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
          <span class="breadcrumb-item active">Transaction</span>
        </nav>
      </div><!-- br-pageheader -->
<div class="br-section-wrapper" style="padding: 0px !important;"> 
  <div class="table-wrapper">
    <div class="card">
      <div class="card-header">
       
      </div>
      <div class="card-body">
        <form id="transaction_form" action="{{route('admin.transaction.store')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Transaction Type</label>
                        <select name="transaction_type" class="form-control" style="width: 100%;"  required>
                            <option value="">---Select---</option>
                            @foreach ($master_ledger as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Refer Number</label>
                        <input name="refer_no"  class="form-control" placeholder="Enter Refer No.">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description"  class="form-control" placeholder="Enter Description" style="height: 43px;"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Ledger</label>
                        <select name="ledger_id" id="ledger_id"  class="form-control" style="width: 100%;"  required>
                            <option value="">---Select---</option>
                                @foreach ($ledger as $item)
                                    <option value="{{$item->id}}">{{ $item->ledger_name }}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Sub Ledger</label>
                        <select name="sub_ledger_id" id="sub_ledger_id" style="width: 100%;"   class="form-control" required>
                            <option value="">---Select---</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for=""></label>
                        <button type="button" data-toggle="modal" data-target="#addModal" class="btn-block btn btn-primary" style="margin-top: 5px;">Add Sub Ledger</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Quantity</label>
                        <input type="number" name="qty" class="form-control" placeholder="Enter Quantity" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Amount</label>
                        <input name="amount" placeholder="Enter Amount"  class="form-control" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Total</label>
                        <input readonly name="total"  class="form-control" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for=""></label>
                        <button type="submit" class="btn-block btn btn-success" style="margin-top: 5px;">Submit</button>
                    </div>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div><!-- table-wrapper -->
</div><!-- br-section-wrapper -->

<div id="addModal" class="modal fade effect-scale">
        <div class="modal-dialog modal-lg modal-dialog-top mt-4" role="document">
            <div class="modal-content tx-size-sm">
            <div class="modal-header pd-x-20">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add New Sub Ledger</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <!----- Start Add  Form ------->
        <form id="addSubLedgerForm" action="{{route('admin.sub_ledger.store')}}" method="post">
        @csrf

        <div class="modal-body ">
            <!----- Start Add  Form input ------->
            <div class="col-xl-12">
                <div class="form-layout form-layout-4">

                    <div class="row mb-4">
                        <label class="col-sm-3 form-control-label">Ledger: <span class="tx-danger">*</span></label>
                        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                          <select type="text" name="ledger_id" id="modal_ledger_id" class="form-control" style="width: 100%;"  required>
                            <option value="">---Select---</option>
                                @foreach ($ledger as $item)
                                    <option value="{{$item->id}}">{{ $item->ledger_name }}</option>
                                @endforeach
                           
                          </select>
                        </div>
                    </div><!-- row -->
                    <div class="row mb-4">
                        <label class="col-sm-3 form-control-label">Sub Ledger Name: <span class="tx-danger">*</span></label>
                        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                          <input type="text" name="sub_ledger_name" class="form-control" placeholder="Enter Sub Ledger Name" required>
                        </div>
                    </div><!-- row -->

                    <div class="row mb-4">
                        <label class="col-sm-3 form-control-label">Status: <span class="tx-danger">*</span></label>
                        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                          <select type="text" name="status" id="modal_status" class="form-control" required>
                            <option value="">---Select---</option>
                            <option value="1">Active</option>
                            <option value="0">InActive</option>
                          </select>
                        </div>
                    </div><!-- row -->

                    

                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success tx-size-xs">Save changes</button>
            <button type="button" class="btn btn-danger tx-size-xs" data-dismiss="modal">Close</button>
        </div>

        </form>
        <!----- End Add Form ------->
        </div>
    </div>
  </div>

  
<!----- Edit Modal ------->
  
<!----- Edit Modal ------->
@endsection

@section('script')
    <script src="{{asset('Backend/lib/highlightjs/highlight.pack.min.js')}}"></script>
    <script src="{{asset('Backend/lib/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('Backend/lib/datatables.net-dt/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{asset('Backend/lib/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('Backend/lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js')}}"></script>
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

    $('#addSubLedgerForm').submit(function(e) {
        e.preventDefault();

        /*Get the submit button*/
        var submitBtn = $(this).find('button[type="submit"]');

        var originalBtnText = submitBtn.html();

        submitBtn.html('<div class="loading-spinner"></div>');
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
        submitBtn.html(`<div class="loading-spinner"></div>`);
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