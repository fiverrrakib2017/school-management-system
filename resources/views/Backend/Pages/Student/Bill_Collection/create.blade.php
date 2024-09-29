@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')
@section('style')
<style>
    /* Custom styling for professional look */
    .table-bordered th, .table-bordered td {
        border: 1px solid #dee2e6;
    }

    .table thead th {
        background-color: #17a2b8;
        color: white;
    }

    .table tfoot th {
        background-color: #f8f9fa;
    }

    .form-control {
        border: none;
        border-bottom: 2px solid #17a2b8;
        box-shadow: none;
    }

    .form-control:focus {
        border-bottom: 2px solid #117a8b;
        box-shadow: none;
    }
    
    .table tfoot .form-control[readonly] {
        background-color: transparent;
    }

    .table tfoot th {
        font-weight: normal;
    }
</style>

@endsection
@section('content')
<div class="container">
   <div class="card shadow-sm">
      <div class="card-header ">
         <h4>Student Bill Collection</h4>
      </div>
      <div class="card-body">
         <form id="form-data" action="" method="post">@csrf
            <div class="row">
               <div class="col-md-4 col-sm-12 mb-3">
                  <label class="form-label">Student Name</label>
                  <select name="student_id" class="form-select" style="width:100%">
                     <option>---Select---</option>
                    @foreach ($student as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                  </select>
               </div>

                <div class="col-md-4 col-sm-12 mb-3">
                  <label for="" class="form-label">Note</label>
                  <textarea id="note" class="form-control" style="height: 38px;" placeholder="Enter Note"></textarea>
                </div>

                <div class="col-md-4 col-sm-12 mb-3">
                  <label for="date" class="form-label">Date</label>
                  <input type="date" id="date" class="form-control"/>
                </div>

               <div class="col-md-4 col-sm-12 mb-3">
                  <label for="" class="form-label">Billing Item Name</label>
                  <select type="text" id="billing_item" class="form-control" style="width:100%">
                        <option>---Select---</option>
                        @foreach ($fess_type as $item)
                            <option value="{{$item->id}}">{{$item->type_name}}</option>
                        @endforeach
                  </select>
               </div>

               

               <div class="col-md-4 col-sm-12 mb-3">
                  <label for="" class="form-label">Amount</label>
                  <input type="text" class="form-control" name="amount" id="amount" placeholder="Enter Amount"/>
               </div>

               <div class="col-md-4 col-sm-12 d-flex align-items-end mb-3">
                  <button type="button" id="submitBtn" class="btn btn-primary w-100">Add Now</button>
               </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered  table-sm">
                    <thead class="text-center">
                        <tr>
                            <th>Billing Item Name</th>
                            <th>Amount</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableRow" class="text-center">
                    <tr>
                        <td>
                            <input type="hidden" name="billing_item_id[]" value="">
                            Exam Free 
                        </td>
                        <td>
                            <input type="hidden" type="number" name="amount[]" class="form-control" value="2500">2500
                        </td>
                        <td>
                            <input type="hidden" name="total_price[]" class="form-control" value="2500">2500
                        </td>
                        <td>
                            <a class="btn-sm btn-danger" type="button" id="itemRow"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-right" colspan="2">Total Amount</th>
                            <th colspan="2">
                                <input type="text" readonly  class="form-control total_amount text-right" name="total_amount" value="2500">
                            </th>
                        </tr>
                        <tr>
                            <th class="text-right" colspan="2">Paid Amount</th>
                            <th colspan="2">
                                <input type="text" class="form-control paid_amount text-right" name="paid_amount" placeholder="Enter paid amount">
                            </th>
                        </tr>
                        <tr>
                            <th class="text-right" colspan="2">Due Amount</th>
                            <th colspan="2">
                                <input type="text" readonly class="form-control due_amount text-right" name="due_amount" placeholder="Due amount will be calculated">
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="text-end">
               <button type="submit" class="btn btn-success mt-3"><i class="fas fa-dollar-sign"></i> Create Now</button>
            </div>
         </form>
      </div>
   </div>
</div>

@endsection

@section('script')
<script  src="{{ asset('Backend/assets/js/__handle_submit.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    
    $("select[name='student_id']").select2();
    $("#billing_item").select2();

    /* Handle form submit */
    handleFormSubmit('#form-data', '#submitBtn');

    /* General form submission handler*/
    function handleFormSubmit(modalId, form) {
        $(modalId + ' form').submit(function(e){
            e.preventDefault();
            var submitBtn = $(this).find('button[type="submit"]');
            var originalBtnText = submitBtn.html();
            submitBtn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
            submitBtn.prop('disabled', true);

            var formData = new FormData(this);
            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.success) {
                        toastr.success(response.message);
                        table.ajax.reload(null, false);
                        $(modalId).modal('hide');
                        form[0].reset();
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) { 
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(field, messages) {
                            $.each(messages, function(index, message) {
                                toastr.error(message); 
                            });
                        });
                    } else {
                        toastr.error('An error occurred. Please try again.');
                    }
                },
                complete: function() {
                    submitBtn.html(originalBtnText);
                    submitBtn.prop('disabled', false);
                }
            });
        });
    }

   
});

  </script>
  

@endsection
