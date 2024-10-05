@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')
@section('style')
<style>
   @media (min-width: 768px) {
    .col-md-6{
        width: 100% !important;
    }    
   }
</style>

@endsection
@section('content')
<div class="row">
    <div class="col-md-12 ">
        <div class="card">
        <div class="card-header">
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
                        <tbody id="table_data"></tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="button" id="submitAttendance" class="btn btn-success">Submit Attendance</button>
            </div>
        </div>

    </div>
</div>




@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function(){
    var classes = @json($classes);
    var sections = @json($sections);

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

    // Create Section Filter
    var section_filter = '<label style="margin-left: 10px;">';
    section_filter += '<select id="search_section_id" class="form-select select2">';
    section_filter += '<option value="">--Select Section--</option>';
    // sections.forEach(function(item) {
    //     section_filter += '<option value="' + item.id + '">' + item.name + '</option>';
    // });
    section_filter += '</select></label>';

    setTimeout(() => {
        $('.dataTables_length').append(section_filter);
        $('.select2').select2(); 
    }, 100);
    $(document).on('change','#search_class_id',function(){
        var selectedClassId = $(this).val();
        var filteredSections = sections.filter(function(section) {
            /*Filter sections by class_id*/ 
            return section.class_id == selectedClassId; 
        });

        /* Update Section dropdown*/
        var sectionOptions = '<option value="">--Select Section--</option>';
        filteredSections.forEach(function(section) {
            sectionOptions += '<option value="' + section.id + '">' + section.name + '</option>';
        });

        $('#search_section_id').html(sectionOptions); 
        $('#search_section_id').select2(); 
    });
    /*Initialize DataTable*/ 
    var table = $("#datatable1").DataTable({
        "processing": true,
        "responsive": true,
        "serverSide": true,
        ajax: {
            url: "{{ route('admin.student.attendence.all_data') }}",
            type: 'GET',
            data: function(d) {
                d.class_id = $('#search_class_id').val();
                d.section_id = $('#search_section_id').val();
            },
            beforeSend: function(request) {
                request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
            },
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

    /*** Class filter changes */ 
    $(document).on('change', '#search_class_id', function() {
        table.ajax.reload(null, false);
    });
    /*section filter changes*/
    $(document).on('change', '#search_section_id', function() {
        table.ajax.reload(null, false);
        $("#table_data").removeClass('d-none');
    });

    /* Select or Deselect All Checkboxes*/
    $(document).on('click', '#selectAll', function() {
        if ($(this).is(':checked')) {
            $('.student-checkbox').prop('checked', true);
        } else {
            $('.student-checkbox').prop('checked', false);
        }
    });

    /*** Select or Deselect Individual Checkboxes ***/
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

