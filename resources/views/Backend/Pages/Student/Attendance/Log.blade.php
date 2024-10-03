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
                                <th class="">Id</th>
                                <th class="">Student Name </th>
                                <th class="">Class </th>
                                <th class="">Section</th>
                                <th class="">Status</th>
                                <th class="">Time In</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
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
    sections.forEach(function(item) {
        section_filter += '<option value="' + item.id + '">' + item.name + '</option>';
    });
    section_filter += '</select></label>';

    setTimeout(() => {
        $('.dataTables_length').append(section_filter);
        $('.select2').select2(); 
    }, 100);

    // Initialize DataTable
    var table = $("#datatable1").DataTable({
        "processing": true,
        "responsive": true,
        "serverSide": true,
        ajax: {
            url: "{{ route('admin.student.attendence.log.all_data') }}",
            type: 'GET',
            data: function(d) {
                d.class_id = $('#search_class_id').val();
                d.section_id = $('#search_section_id').val();
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
            { "data": "id" },
            {
                "data": "student.name",
                render: function(data, type, row) {
                    return `<a href="{{ route('admin.student.view', '') }}/${row.student.id}">${data}</a>`;
                }
            },
            { 
                "data": "student.current_class.name", 
                render: function(data, type, row) {
                    return data ? data : 'N/A';
                }
            },
            { 
                "data": "student.section.name", 
                render: function(data, type, row) {
                    return data ? data : 'N/A';
                }
            },
            {
                "data": "status",
               render:function(data,type,row){
                   return `<span class="badge bg-${data === 'Present' ? 'success' : 'danger'}">${data}</span>`
                  
               }
            },
            { "data": "time_in",
                render:function(data,type,row){
                    if (data) {
                        let date = new Date(`1970-01-01T${data}Z`); 
                        let hours = date.getUTCHours();
                        let minutes = date.getUTCMinutes();
                        let ampm = hours >= 12 ? 'PM' : 'AM';
                        hours = hours % 12; 
                        hours = hours ? hours : 12; 
                        minutes = minutes < 10 ? '0' + minutes : minutes;
                        let strTime = hours + ':' + minutes + ' ' + ampm;
                        return strTime;
                    }
                return 'N/A';
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

