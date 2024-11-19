@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')
@section('style')
@endsection
@section('content')
<div class="row">
    <div class="col-md-12 ">
        <div class="card">
        <div class="card-header">
          <div class="row" id="search_box">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Class</label>
                        <select name="find_class_id"  class="form-select">
                            <option value="">---Select---</option>
                            @php
                                $classes = \App\Models\Student_class::latest()->get();
                            @endphp
                            @if($classes->isNotEmpty())
                                @foreach($classes as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mt-2">
                    <button type="button" name="submit_btn" class="btn btn-success mt-1"><i class="mdi mdi-magnify"></i> Find Examination Routine</button>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mt-2">
                    <button data-bs-toggle="modal" data-bs-target="#routineModal" type="button" class="btn btn-primary mt-1">Create Examination Routine</button>
                    </div>
                </div>
            </div>
        </div>
            <div class="card-body">
                <div class="table-responsive responsive-table">
                    <table id="datatable1" class="table table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead >
                            <tr>
                                <th>No.</th>
                                <th>Examination Name</th>
                                <th>Class Name</th>
                                <th>Subject Name</th>
                                <th>Exam Date</th>

                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Room Number</th>
                                <th>Invigilator</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="routine_data">
                        <tr id="no-data">
                            <td colspan="10" class="text-center">No data available</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@include('Backend.Modal.Student.routine_modal')
@include('Backend.Modal.delete_modal')


@endsection

@section('script')
<script  src="{{ asset('Backend/assets/js/__handle_submit.js') }}"></script>
<script  src="{{ asset('Backend/assets/js/delete_data.js') }}"></script>
<script  src="{{ asset('Backend/assets/js/custom_select.js') }}"></script>
  <script type="text/javascript">
    $(document).ready(function(){
    $("select[name='find_class_id']").select2();
    custom_select2('#routineModal');
    handleSubmit('#routineForm','#routineModal');
    $("#datatable1").DataTable();
    var table=$("#datatable12").DataTable({
    "processing":true,
    "responsive": true,
    "serverSide":true,
    beforeSend: function () {},
    complete: function(){},
    ajax: "{{ route('admin.tickets.get_all_data') }}",
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
            "data":"status",
            render:function(data,type,row){
                if(row.status == 0){
                    return '<span class="badge bg-danger">Active</span>';
                }else if(row.status == 2){
                    return '<span class="badge bg-warning">Pending</span>';
                }else if(row.status==1){
                    return '<span class="badge bg-success">Completed</span>';
                }
            }
          },
          {
            "data":"created_at",
            render: function (data, type, row) {
                return moment(row.created_at).format('D MMMM YYYY');
            }
          },
          {
            "data": "priority_id",
            render: function (data, type, row) {
                let priorityLabel = '';
                switch (row.priority_id) {
                    case 1:
                        priorityLabel = 'Low';
                        break;
                    case 2:
                        priorityLabel = 'Normal';
                        break;
                    case 3:
                        priorityLabel = 'Standard';
                        break;
                    case 4:
                        priorityLabel = 'Medium';
                        break;
                    case 5:
                        priorityLabel = 'High';
                        break;
                    case 6:
                        priorityLabel = 'Very High';
                        break;
                    default:
                        priorityLabel = 'Unknown';
                        break;
                }
                return priorityLabel;
            }

          },
          {
            "data":"student.name"
          },
          {
            "data":"student.phone"
          },
          {
            "data":"complain_type.name"
          },
          {
            "data":"assign.name"
          },
          {
            "data":"ticket_for",
            render: function (data, type, row) {
                if (row.ticket_for == 1) {
                    return `Default`;
                }
            }
          },
          {
            "data":null,
            render: function (data, type, row) {
                if(row.updated_at == row.created_at){
                    return 'N/A';
                }
                if (row.updated_at && row.created_at) {
                    let start = moment(row.created_at);
                    let end = moment(row.updated_at);

                    return end.from(start);
                } else {
                    return 'N/A';
                }
            }
          },
          {
            "data":"percentage"
          },
          {
            "data":"note"
          },

          {
            data:null,
            render: function (data, type, row) {
              return `<button  class="btn btn-primary btn-sm mr-3 edit-btn" data-id="${row.id}"><i class="fa fa-edit"></i></button>

                <button class="btn btn-danger btn-sm mr-3 delete-btn"  data-id="${row.id}"><i class="fa fa-trash"></i></button>`;
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
        $.ajax({
            url: "{{ route('admin.tickets.edit', ':id') }}".replace(':id', id),
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    $('#ticketForm').attr('action', "{{ route('admin.tickets.update', ':id') }}".replace(':id', id));
                    $('#ticketModalLabel').html('<span class="mdi mdi-account-edit mdi-18px"></span> &nbsp;Edit Ticket');
                    $('#ticketForm select[name="student_id"]').val(response.data.student_id);
                    $('#ticketForm select[name="ticket_for"]').val(response.data.ticket_for);
                    $('#ticketForm select[name="ticket_assign_id"]').val(response.data.ticket_assign_id);
                    $('#ticketForm select[name="ticket_complain_id"]').val(response.data.ticket_complain_id);
                    $('#ticketForm select[name="priority_id"]').val(response.data.priority_id);
                    $('#ticketForm input[name="subject"]').val(response.data.subject);
                    $('#ticketForm textarea[name="description"]').val(response.data.description);
                    $('#ticketForm input[name="note"]').val(response.data.note);
                    $('#ticketForm select[name="status_id"]').val(response.data.status);
                    $('#ticketForm select[name="percentage"]').val(response.data.percentage);

                    // Show the modal
                    $('#ticketModal').modal('show');
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
        var deleteUrl = "{{ route('admin.tickets.delete', ':id') }}".replace(':id', id);

        $('#deleteForm').attr('action', deleteUrl);
        $('#deleteModal').find('input[name="id"]').val(id);
        $('#deleteModal').modal('show');
    });

    $(document).on('change','select[name="class_id"]',function(){
        var class_id = $(this).val();
        $.ajax({
            url: "{{ route('admin.student.subject.get_subject_by_class') }}",
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                class_id: class_id
            },
            success: function(response) {
                var subjectOptions = '<option value="">--Select Subject--</option>';
                response.data.forEach(function(subject) {
                    subjectOptions += '<option value="' + subject.id + '">' + subject.name + '</option>';
                });
                $('select[name="subject_id"]').html(subjectOptions);
            },
            error: function() {
                toastr.error('An error occurred. Please try again.');
            }
        });
    });

    $("button[name='submit_btn']").on('click',function(e){
        e.preventDefault();
        var class_id = $("select[name='find_class_id']").val();
        var submitBtn =  $('#search_box').find('button[name="submit_btn"]');
        submitBtn.html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">Loading...</span>`);
        submitBtn.prop('disabled', true);
        $.ajax({
            type: 'GET',
            url: "{{ route('admin.transaction.show') }}",
            cache: true,
            success: function(response) {
            var _number = 1;
            var html = '';

            /*Check if the response data is an array*/
            if (Array.isArray(response.data) && response.data.length > 0) {
                response.data.forEach(function(transaction) {
                    html += '<tr>';
                    html += '<td>' + (_number++) + '</td>';
                    html += '<td>' +
                            (transaction.sub_ledger ? transaction.sub_ledger.sub_ledger_name : '') +
                            '<br><i>' + (transaction.note ? transaction.note : '') + '</i></td>';
                    html += '<td>' + transaction.qty + '</td>';
                    html += '<td>' + transaction.value + '</td>';
                    html += '<td>' + transaction.total + '</td>';
                    html += '</tr>';
                });
            } else {
                html += '<tr>';
                html += '<td colspan="5" style="text-align: center;">No Data Available</td>';
                html += '</tr>';
            }

            $("#routine_data").html(html);
        }

        });
    });



  </script>
@endsection
