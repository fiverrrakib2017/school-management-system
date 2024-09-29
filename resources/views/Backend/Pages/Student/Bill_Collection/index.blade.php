@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')

@section('content')
<div class="row">
    <div class="col-md-12 ">
        <div class="card">
        <div class="card-header">
          <a href="{{route('admin.student.bill_collection.create')}}" class="btn btn-success "><i class="mdi mdi-account-plus"></i>
          Add Bill Collection</a>
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
                                <th class="">Status</th>
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

<div id="deleteModal" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <form action="{{route('admin.student.bill_collection.delete')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
            <div class="modal-header flex-column">
                <div class="icon-box">
                    <i class="fas fa-trash"></i>
                </div>
                <h4 class="modal-title w-100">Are you sure?</h4>
                <input type="hidden" name="id" value="">
                <a class="close" data-bs-dismiss="modal" aria-hidden="true"><i class="mdi mdi-close"></i></a>
            </div>
            <div class="modal-body">
                <p>Do you really want to delete these records? This process cannot be undone.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('script')
<script  src="{{ asset('Backend/assets/js/__handle_submit.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    var table = $("#datatable1").DataTable({
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
        {"data":"id"},
        {
          "data": "student.name",
          render: function(data, type, row){
              return '<a href="{{ route('admin.student.view', '') }}/' + row.id + '">' + data + '</a>';
          }
        },
        {"data":"amount"},
        {"data":"paid_amount"},
        {"data":"due_amount"},
        {
          "data":"payment_status", 
          render:function(data,type,row){
              return data === 'paid' 
                ? '<span class="badge bg-success">Paid</span>' 
                : '<span class="badge bg-danger">Due</span>';
          }
        },
        {"data":"note"},
        {
          "data":null,
          render:function(data,type,row){
              return `
              <button type="button" class="btn btn-primary btn-sm" name="edit_button" data-id="${row.id}"><i class="fa fa-edit"></i></button> 
              <button class="btn btn-danger btn-sm delete-btn" data-toggle="modal" data-target="#deleteModal" data-id="${row.id}"><i class="fa fa-trash"></i></button>
            `;
          }
        },
      ],
      order:[ [0, "desc"] ],
    });

    /* Search filter reload*/
    $('#search_class_id').change(function() {
        table.ajax.reload(null, false);
    });

    /* Initialize select2 for modal dropdowns*/
    function initializeSelect2(modalId) {
      $(modalId).on('show.bs.modal', function (event) {
        if (!$("select[name='student_id']").hasClass("select2-hidden-accessible")) {
            $("select[name='student_id']").select2({
                dropdownParent: $(modalId),
                placeholder: "Select Student"
            });
        }
      });
    }
    
    /* Initialize modals*/
    initializeSelect2("#addModal");
    initializeSelect2("#editModal");

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

    /* Handle Add and Edit Form */
    handleFormSubmit("#addModal", $('#addModal form'));
    handleFormSubmit("#editModal", $('#editModal form'));

    /* Edit button click handler*/
    $(document).on("click", "button[name='edit_button']", function() {
        var _id = $(this).data("id");
        var editUrl = '{{ route("admin.student.bill_collection.get_bill_collection", ":id") }}';
        var url = editUrl.replace(':id', _id);
        $.ajax({
          url: url,
          type: "GET",
          dataType: 'json',
          success: function(response) {
              if (response.success) {
                  var data = response.data;
                  $('#editModal').modal('show');
                  $('#editModal input[name="id"]').val(data.id);
                  $('#editModal select[name="student_id"]').val(data.student_id).trigger('change');
                  $('#editModal input[name="bill_date"]').val(data.bill_date);
                  $('#editModal input[name="amount"]').val(data.amount);
                  $('#editModal input[name="paid_amount"]').val(data.paid_amount);
                  $('#editModal input[name="due_amount"]').val(data.due_amount);
                  $('#editModal select[name="payment_status"]').val(data.payment_status);
                  $('#editModal input[name="payment_method"]').val(data.payment_method);
                  $('#editModal input[name="note"]').val(data.note);
              } else {
                  toastr.error("Error fetching data for edit: " + response.message);
              }
          },
          error: function(xhr) {
              toastr.error('Failed to fetch bill collection details.');
          }
        });
    });

    /* Handle Delete button click and form submission*/
    $('#datatable1 tbody').on('click', '.delete-btn', function () {
        var id = $(this).data('id');
        $('#deleteModal').modal('show');
        $("input[name*='id']").val(id);
    });

    $('#deleteModal form').submit(function(e){
        e.preventDefault();
        var submitBtn = $(this).find('button[type="submit"]');
        var originalBtnText = submitBtn.html();
        submitBtn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
        var form = $(this);
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: form.serialize(),
            success: function(response) {
                if (response.success) {
                    toastr.success(response.message);
                    table.ajax.reload(null, false);
                    $('#deleteModal').modal('hide');
                }
            },
            error: function(xhr) {
                toastr.error(xhr.responseText);
            },
            complete: function() {
                submitBtn.html(originalBtnText);
            }
        });
    });
});

  </script>
  

@endsection
