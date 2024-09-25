@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')

@section('content')
<div class="row">
    <div class="col-md-12 ">
        <div class="card">
        <div class="card-header">
          <button data-bs-toggle="modal" data-bs-target="#addModal"  class="btn btn-success "><i class="mdi mdi-account-plus"></i>
          Add Bill Collection</button>
          </div>
            <div class="card-body">
                <div class="table-responsive" id="tableStyle">
                    <table id="datatable1" class="table table-striped table-bordered    " cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="">No.</th>
                                <th class="">Student Name </th>
                                <th class="">Amount </th>
                                <th class="">Paid Amount</th>
                                <th class="">Due Amount</th>
                                <th class="">Payment Status</th>
                                <th class="">Note</th>
                                <th class=""></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Add Modal -->
<div class="modal fade bs-example-modal-lg" id="addModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content col-md-12">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span
                        class="mdi mdi-account-check mdi-18px"></span> &nbsp;Add New Bill Collection</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.student.bill_collection.store')}}" method="POST" enctype="multipart/form-data" id="Request_form">@csrf
                        <div class="form-group mb-2">
                            <label>Student Name</label>
                            <select name="student_id" class="form-select" type="text" style="width: 100%;" required>
                              @foreach ($student as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                              @endforeach
                            </select>
                        </div>           
                        <div class="form-group mb-2">
                            <label>Bill Date</label>
                            <input name="bill_date" class="form-control" type="date" required>
                        </div>
                        <div class="form-group mb-2">
                            <label>Amount </label>
                            <input name="amount" placeholder="Enter Amount" class="form-control" type="number" required />
                        </div>        
                        <div class="form-group mb-2">
                            <label>Paid Amount </label>
                            <input name="paid_amount" placeholder="Enter Paid Amount" class="form-control" type="number" required />
                        </div>        
                        <div class="form-group mb-2">
                            <label>Due Amount </label>
                            <input name="due_amount" class="form-control" type="number" required />
                        </div>        
                        <div class="form-group mb-2">
                            <label>Payment Status </label>
                            <select name="payment_status" class="form-control" type="text" required>
                              <option >---Select---</option>
                              <option value="paid">Paid</option>
                              <option value="partial">Partial</option>
                              <option value="due">Unpaid</option>
                            </select>
                        </div>        
                        <div class="form-group mb-2">
                          <label>Payment Method </label>
                          <input name="payment_method" class="form-control" placeholder="Enter Payment Method Here" type="text" />
                        </div>          
                        <div class="form-group mb-2">
                          <label>Note</label>
                          <input name="note" class="form-control" placeholder="Enter Note Here" type="text"  />
                        </div>          
                        <div class="modal-footer ">
                            <button data-bs-dismiss="modal" type="button" class="btn btn-danger">Cancel</button>
                            <button type="submit" class="btn btn-success">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



<!-- Edit Modal -->
<div class="modal fade bs-example-modal-lg" id="editModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content col-md-12">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span
                    class="mdi mdi-account-check mdi-18px"></span> &nbsp;Update Bill Collection</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{route('admin.student.bill_collection.update')}}" method="POST" enctype="multipart/form-data" id="Request_form">@csrf
                          <div class="form-group mb-2">
                              <label>Student Name</label>
                              <input type="text" name="id" class="d-none">
                              <select name="student_id" class="form-select" type="text" style="width: 100%;" required>
                                @foreach ($student as $item)
                                  <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                              </select>
                          </div>           
                          <div class="form-group mb-2">
                              <label>Bill Date</label>
                              <input name="bill_date" class="form-control" type="date" required>
                          </div>
                          <div class="form-group mb-2">
                              <label>Amount </label>
                              <input name="amount" placeholder="Enter Amount" class="form-control" type="number" required />
                          </div>        
                          <div class="form-group mb-2">
                              <label>Paid Amount </label>
                              <input name="paid_amount" placeholder="Enter Paid Amount" class="form-control" type="number" required />
                          </div>        
                          <div class="form-group mb-2">
                              <label>Due Amount </label>
                              <input name="due_amount" class="form-control" type="number" />
                          </div>        
                          <div class="form-group mb-2">
                              <label>Payment Status </label>
                              <select type="text" name="payment_status" class="form-select" type="text" required>
                                <option >---Select---</option>
                                <option value="paid">Paid</option>
                                <option value="partial">Partial</option>
                                <option value="due">Unpaid</option>
                              </select>
                          </div>        
                          <div class="form-group mb-2">
                            <label>Payment Method </label>
                            <input name="payment_method" class="form-control" placeholder="Enter Payment Method Here" type="text" />
                          </div>          
                          <div class="form-group mb-2">
                            <label>Note</label>
                            <input name="note" class="form-control" placeholder="Enter Note Here" type="text"  />
                          </div>          
                          <div class="modal-footer ">
                              <button data-bs-dismiss="modal" type="button" class="btn btn-danger">Cancel</button>
                              <button type="submit" class="btn btn-success">Save Changes</button>
                          </div>
                      </form>
              </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script  src="{{ asset('Backend/assets/js/__handle_submit.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    var table; 
    var table=$("#datatable1").DataTable({
      "processing":true,
      "responsive": true,
      "serverSide":true,
      ajax: {
            url: "{{ route('admin.student.bill_collection.all_data') }}",
            type: 'GET',
            data: function(d) {
              d.class_id = $('#search_class_id').val();
            },
            beforeSend: function(request) {
                request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
            }
        },
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
          "data": "student.name",
          render: function(data, type, row){
              return '<a href="{{ route('admin.student.view', '') }}/' + row.id + '">' + data + '</a>';
          }
        },
        {
          "data":"amount"
        },
        {
          "data":"paid_amount"
        },
        {
          "data":"due_amount"
        },
        {
          "data":"payment_status", 
          render:function(data,type,row){
              if(data == 'paid'){
                return '<span class="badge bg-success">Paid</span>';
              }else{
                return '<span class="badge bg-danger">Due</span>';
              }
          }
        },
        {
          "data":"note"
        },
        {
          "data":null,
          render:function(data,type,row){
              var viewUrl = "{{ route('admin.student.view', ':id') }}".replace(':id', row.id);
              return `

              <a href="${viewUrl}" class="btn btn-success btn-sm mr-3 edit-btn"><i class="fa fa-eye"></i></a>
              <button type="button" class="btn btn-danger btn-sm" name="edit_button" data-id="${row.id}"><i class="fa fa-edit"></i></button> 
            `;
          }
        },
      ],
      order:[
        [0, "desc"]
      ],
    });
      $('#search_class_id').change(function() {
        $('#datatable1').DataTable().ajax.reload( null , false);
      });
  });
  $("#addModal").on('show.bs.modal', function (event) {
    /*Check if select2 is already initialized*/
    if (!$("select[name='student_id']").hasClass("select2-hidden-accessible")) {
        $("select[name='student_id']").select2({
            dropdownParent: $("#addModal"),
            placeholder: "Select Student"
        });
    }
  });
  $("#editModal").on('show.bs.modal', function (event) {
    /*Check if select2 is already initialized*/
    if (!$("select[name='student_id']").hasClass("select2-hidden-accessible")) {
        $("select[name='student_id']").select2({
            dropdownParent: $("#editModal"),
            placeholder: "Select Student"
        });
    }
  });
  /** Add **/
  $('#addModal form').submit(function(e){
        e.preventDefault();
        /* Get the submit button */
        var submitBtn = $(this).find('button[type="submit"]');
        var originalBtnText = submitBtn.html();

        submitBtn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden"></span>');
        submitBtn.prop('disabled', true);

        var form = $(this);
        var formData = new FormData(this);
        $.ajax({
          type: form.attr('method'),
          url: form.attr('action'),
          data: formData,
          processData: false,
          contentType: false,
          success: function (response) {
            if (response.success) {
              toastr.success(response.message);
              $('#datatable1').DataTable().ajax.reload( null , false);
              $("#addModal").modal('hide');
              form[0].reset();
            }
          },
          error: function(xhr) {
            if (xhr.status === 422) { 
                  /* Validation error*/
                var errors = xhr.responseJSON.errors;

                /* Loop through the errors and show them using toastr*/
                $.each(errors, function(field, messages) {
                    $.each(messages, function(index, message) {
                        /* Display each error message*/
                        toastr.error(message); 
                    });
                });
            } else {
                /*General error message*/ 
                toastr.error('An error occurred. Please try again.');
            }
          },
          complete: function() {
              submitBtn.html(originalBtnText);
              submitBtn.prop('disabled', false);
          }
        });
    });
  /** Leave Edit **/
  $(document).on("click", "button[name='edit_button']", function() {
        var _id = $(this).data("id");
        var editUrl = '{{ route("admin.student.bill_collection.get_bill_collection", ":id") }}';
        var url = editUrl.replace(':id', _id);
        $.ajax({
          url: url,
          type: "GET",
          dataType:'json',
          success: function(response) {
                if (response.success) {
                  console.log(response.data.student_id);
                $('#editModal').modal('show');
                 $('#editModal input[name="id"]').val(response.data.id);
                 $('#editModal select[name="student_id"]').val(response.data.student_id);
                 $('#editModal input[name="bill_date"]').val(response.data.bill_date);
                 $('#editModal input[name="amount"]').val(response.data.amount);
                 $('#editModal input[name="paid_amount"]').val(response.data.paid_amount);
                 $('#editModal input[name="due_amount"]').val(response.data.due_amount);
                 $('#editModal select[name="payment_status"]').val(response.data.payment_status);
                 $('#editModal input[name="payment_method"]').val(response.data.payment_method);
                 $('#editModal input[name="note"]').val(response.data.note);
                } else {
                    toastr.error("Error fetching data for edit: " + response.message);
                }
            },
            error: function(xhr, status, error) {
                toastr.error('Failed to fetch department details');
            }
        });
    });

    $('#editModal form').submit(function(e){
        e.preventDefault();
        /* Get the submit button */
        var submitBtn = $(this).find('button[type="submit"]');
        var originalBtnText = submitBtn.html();

        submitBtn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden"></span>');
        submitBtn.prop('disabled', true);

        var form = $(this);
        var formData = new FormData(this);
        $.ajax({
          type: form.attr('method'),
          url: form.attr('action'),
          data: formData,
          processData: false,
          contentType: false,
          success: function (response) {
            if (response.success) {
              toastr.success(response.message);
              $('#datatable1').DataTable().ajax.reload( null , false);
              $("#editModal").modal('hide');
              form[0].reset();
            }
          },
          error: function(xhr) {
            if (xhr.status === 422) { 
                  /* Validation error*/
                var errors = xhr.responseJSON.errors;

                /* Loop through the errors and show them using toastr*/
                $.each(errors, function(field, messages) {
                    $.each(messages, function(index, message) {
                        /* Display each error message*/
                        toastr.error(message); 
                    });
                });
            } else {
                /*General error message*/ 
                toastr.error('An error occurred. Please try again.');
            }
          },
          complete: function() {
              submitBtn.html(originalBtnText);
              submitBtn.prop('disabled', false);
          }
        });
    });


  </script>
  

@endsection
