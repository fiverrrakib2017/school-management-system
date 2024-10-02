@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')

@section('content')
<div class="row">
    <div class="col-md-12 ">
        <div class="card">
        <div class="card-header">
          <!-- <button data-bs-toggle="modal" data-bs-target="#addModal"  class="btn btn-success "><i class="mdi mdi-account-plus"></i>
          Add New Attendance</button> -->
          </div>
            <div class="card-body">
                <div class="table-responsive" id="tableStyle">
                    <table id="datatable1" class="table table-striped table-bordered    " cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="form-check-input" id="selectAll"> </th>
                                <th class="">Student Name </th>
                                <th class="">Class </th>
                                <th class="">Section</th>
                                <th class="">Religion</th>
                                <th class="">Phone Number</th>
                                <th class=""></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="button" id="submitAttendance" class="btn btn-success">Submit Attendance</button>
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
                    class="mdi mdi-account-check mdi-18px"></span> &nbsp;Add New Attendance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.student.attendence.store')}}" method="POST" enctype="multipart/form-data">@csrf
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
                        <label>Attendance Date</label>
                        <input name="attendance_date" class="form-control" type="date" value="2024-09-28" required>
                    </div>
                    <div class="form-group mb-2">
                        <label>Shift </label>
                        <select name="shift_id" class="form-select" type="text" required>
                            <option >---Select---</option>
                            @foreach ($shift as $item)
                                <option value="{{$item->id}}">{{$item->shift_name}}</option>
                            @endforeach
                        </select>
                    </div>        
                    <div class="form-group mb-2">
                        <label>Time In</label>
                        <input name="time_in" class="form-control" type="time"  required>
                    </div>           
                    <div class="form-group mb-2">
                        <label>Time Out</label>
                        <input name="time_out" class="form-control" type="time"  required>
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
                        class="mdi mdi-account-check mdi-18px"></span> &nbsp;Update Attendance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="{{route('admin.student.attendence.update')}}" method="POST" enctype="multipart/form-data">@csrf
                    <div class="form-group mb-2">
                        <label>Student Name</label>
                        <input type="text" class="d-none" name="id">
                        <select name="student_id" class="form-select" type="text" style="width: 100%;" required>
                            <option value="">---Select---</option>
                            @foreach ($student as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>           
                    <div class="form-group mb-2">
                        <label>Attendance Date</label>
                        <input name="attendance_date" class="form-control" type="date" value="2024-09-28" required>
                    </div>
                    <div class="form-group mb-2">
                        <label>Shift </label>
                        <select name="shift_id" class="form-select" type="text" required>
                            <option >---Select---</option>
                            @foreach ($shift as $item)
                                <option value="{{$item->id}}">{{$item->shift_name}}</option>
                            @endforeach
                        </select>
                    </div>        
                    <div class="form-group mb-2">
                        <label>Time In</label>
                        <input name="time_in" class="form-control" type="time"  required>
                    </div>           
                    <div class="form-group mb-2">
                        <label>Time Out</label>
                        <input name="time_out" class="form-control" type="time"  required>
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
        <form action="{{route('admin.student.attendence.delete')}}" method="post" enctype="multipart/form-data">
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
    var classes = @json($classes);

    // Create Class Filter
    var class_filter = '<label style="margin-left: 10px;">';
    class_filter += '<select id="search_class_id" class="form-select select2">';
    class_filter += '<option value="">--Select Class--</option>';
    classes.forEach(function(item) {
        class_filter += '<option value="' + item.id + '">' + item.name + '</option>';
    });
    class_filter += '</select></label>';

    setTimeout(() => {
        $('.dataTables_length').append(class_filter);
        $('.select2').select2(); 
    }, 100);

    // Initialize DataTable
    var table = $("#datatable1").DataTable({
        "processing": true,
        "responsive": true,
        "serverSide": true,
        ajax: {
            url: "{{ route('admin.student.attendence.all_data') }}",
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
        "columns": [
            {
                "data": "id",
                render: function(data, type, row) {
                    return '<input type="checkbox" name="student_ids[]" value="' + row.id + '" class="student-checkbox form-check-input" ' + (row.attendance_status === 'Present' ? 'checked' : '') + '>';
                }
            },
            {
                "data": "name",
                render: function(data, type, row) {
                    return '<a href="{{ route('admin.student.view', '') }}/' + row.id + '">' + data + '</a>';
                }
            },
            { "data": "current_class.name" },
            { "data": "section.name" },
            { "data": "religion" },
            { "data": "phone" },
            {
                "data": null,
                render: function(data, type, row) {
                    var viewUrl = "{{ route('admin.student.view', ':id') }}".replace(':id', row.id);
                    return `
                        <a href="${viewUrl}" class="btn btn-success btn-sm mr-3 edit-btn"><i class="fa fa-eye"></i></a>
                    `;
                }
            },
        ],
        order: [
            [0, "desc"]
        ],
    });

    // Trigger AJAX reload when the class filter changes
    $(document).on('change', '#search_class_id', function() {
        table.ajax.reload(null, false);
    });

    // Select or Deselect All Checkboxes
    $(document).on('click', '#selectAll', function() {
        if ($(this).is(':checked')) {
            $('.student-checkbox').prop('checked', true);
        } else {
            $('.student-checkbox').prop('checked', false);
        }
    });

    // Ensure checkboxes inside DataTable are properly selected on redraw
    table.on('draw.dt', function() {
        if ($('#selectAll').is(':checked')) {
            $('.student-checkbox').prop('checked', true);
        } else {
            $('.student-checkbox').prop('checked', false);
        }
    });
    $(document).on('click', '#submitAttendance', function() {
        var selectedStudents = [];
        $('.student-checkbox:checked').each(function() {
            selectedStudents.push($(this).val());
        });
        if(selectedStudents.length > 0) {
            $.ajax({
                url: "{{ route('admin.student.attendence.store') }}",
                type: "POST",
                data: {
                    student_ids: selectedStudents,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    toastr.success(response.message);
                    table.ajax.reload(null, false);
                },
                error: function(xhr, status, error) {
                    toastr.error('An error occurred. Please try again.');
                }
            });
        } else {
            toastr.error('Please select at least one student!');
        }
    });
});
</script>
@endsection

