@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')

@section('content')
<div class="row">
    <div class="col-md-12 ">
        <div class="card">
        <div class="card-header">
          <button data-bs-toggle="modal" data-bs-target="#addModal"  class="btn btn-success "><i class="mdi mdi-account-plus"></i>
          Add New Leave</button>
          </div>
            <div class="card-body">
                <div class="table-responsive" id="tableStyle">
                    <table id="datatable1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Student Name</th>
                                <th>Leave Type</th>
                                <th>Leave Reason</th>
                                <th>Status</th>
                                <th>Start Time</th>
                                <th>End Time</th>
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
 <!-- Add Modal -->
 <div class="modal fade bs-example-modal-lg" id="addModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content col-md-12">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span
                        class="mdi mdi-account-check mdi-18px"></span> &nbsp;Add New Leave</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.student.leave.store')}}" method="POST" enctype="multipart/form-data">@csrf
                        <div class="form-group mb-2">
                            <label>Student Name</label>
                            <select name="student_id" class="form-select" type="text" style="width: 100%;" required>
                                <option >---Select---</option>
                                @foreach ($student as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>           
                        <div class="form-group mb-2">
                            <label>Leave Type</label>
                            <select name="leave_type" class="form-select" type="text" required>
                                <option >---Select---</option>
                                <option value="full_day">Full Day</option>
                                <option value="Sick">Sick</option>
                                <option value="half_day">Half Day</option>
                                <option value="Unpaid">Unpaid</option>
                            </select>
                        </div>           
                        <div class="form-group mb-2">
                            <label>Leave Reason</label>
                            <textarea name="leave_reason" class="form-control" type="text" placeholder="Enter Leave Reason" required></textarea>
                        </div>    
                        <div class="form-group mb-2">
                            <label>Leave Status</label>
                            <select name="leave_status" class="form-select" type="text" required>
                                <option >---Select---</option>
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>        
                        <div class="form-group mb-2">
                            <label>Start Date</label>
                            <input name="start_date" class="form-control" type="date"  required>
                        </div>           
                        <div class="form-group mb-2">
                            <label>End Date</label>
                            <input name="end_date" class="form-control" type="date"  required>
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
        <div class="modal-dialog " role="document">
            <div class="modal-content col-md-12">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span
                        class="mdi mdi-account-check mdi-18px"></span> &nbsp;Update Leave</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="{{route('admin.student.leave.update')}}" method="POST" enctype="multipart/form-data">@csrf
                        <div class="form-group mb-2">
                            <label>Student Name</label>
                            <input type="text" class="d-none" name="id">
                            <select name="student_id" class="form-select" type="text" style="width: 100%;" required>
                                @foreach ($student as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>           
                        <div class="form-group mb-2">
                            <label>Leave Type</label>
                            <select name="leave_type" class="form-select" type="text" required>
                                <option >---Select---</option>
                                <option value="Sick">Sick</option>
                                <option value="Casual">Casual</option>
                                <option value="Paid">Paid</option>
                                <option value="Unpaid">Unpaid</option>
                            </select>
                        </div>           
                        <div class="form-group mb-2">
                            <label>Leave Reason</label>
                            <textarea name="leave_reason" class="form-control" type="text" placeholder="Enter Leave Reason" required></textarea>
                        </div>    
                        <div class="form-group mb-2">
                            <label>Leave Status</label>
                            <select name="leave_status" class="form-select" type="text" required>
                                <option >---Select---</option>
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>        
                        <div class="form-group mb-2">
                            <label>Start Date</label>
                            <input name="start_date" class="form-control" type="date"  required>
                        </div>           
                        <div class="form-group mb-2">
                            <label>End Date</label>
                            <input name="end_date" class="form-control" type="date"  required>
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
        <form action="{{route('admin.student.leave.delete')}}" method="post" enctype="multipart/form-data">
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
<script type="text/javascript">
  $(document).ready(function(){
    var table = $("#datatable1").DataTable({
      "processing":true,
      "responsive": true,
      "serverSide":true,
      ajax: {
            url: "{{ route('admin.student.leave.all_data') }}",
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
        },
        {
          "data": "leave_type",
        },
        {
          "data": "leave_reason",
          "render":function(data,type,row){
            if(data.length > 50){
                return data.substring(0, 30) + '...';
            }else{
                return data
            }
          }
        },
        {
          "data": "leave_status",
            "render":function(data, type, row){
                if(data=='pending'){
                    return '<span class="badge bg-warning">Pending</span>';
                }
                if(data=='approved'){
                    return '<span class="badge bg-success">Approved</span>';
                }
                if(data=='rejected'){
                    return '<span class="badge bg-danger">Rejected</span>';
                }
                
            }
        },
        {"data":"start_date",
        "render": function(data, type, row) {
            return formatDate(data);
          }
        },
        {"data":"end_date",
        "render": function(data, type, row) {
            return formatDate(data);
        }
        },
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
    function formatDate(dateString) {
        if (dateString) {
            const dateObj = new Date(dateString);
            const options = { year: 'numeric', month: 'short', day: 'numeric' };
            const formattedDate = dateObj.toLocaleDateString('en-US', options);
            const [day, month, year] = formattedDate.split(' ');

            return `${day} ${month} ${year}`; 
        }
        return '';
    }
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
    
    /* Initialize select2 modals*/
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
        var editUrl = '{{ route("admin.student.leave.get_leave", ":id") }}';
        var url = editUrl.replace(':id', _id);
        $.ajax({
          url: url,
          type: "GET",
          dataType: 'json',
          success: function(response) {
              if (response.success) {
                //var data = response.data;
                $('#editModal').modal('show');
                $('#editModal input[name="id"]').val(response.data.id);
                $('#editModal select[name="employee_id"]').val(response.data.student_id);
                $('#editModal select[name="leave_type"]').val(response.data.leave_type);
                $('#editModal textarea[name="leave_reason"]').val(response.data.leave_reason);
                $('#editModal select[name="leave_status"]').val(response.data.leave_status);
                $('#editModal input[name="start_date"]').val(response.data.start_date);
                $('#editModal input[name="end_date"]').val(response.data.end_date);
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